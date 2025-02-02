<?php
/**
 * Protector module for XCL
 *
 * @package    Protector
 * @version    XCL 2.3.1
 * @author     Other authors Gigamaster, 2020 XCL PHP7
 * @author     Gijoe (Peak)
 * @copyright  (c) 2005-2022 Authors
 * @license    GPL v2.0
 */

class protector {
	public $mydirname;

	public $_conn = null;
	public $_conf = [];
	public $_conf_serialized = '';

	public $_bad_globals = [];

	public $message = '';
	public $warning = false;
	public $error = false;
	public $_doubtful_requests = [];
	public $_bigumbrella_doubtfuls = [];

	public $_dblayertrap_doubtfuls = [];
	public $_dblayertrap_doubtful_needles = [
		'information_schema',
		'select',
		"'",
		'"',
	];

	public $_logged = false;

	public $_done_badext = false;
	public $_done_intval = false;
	public $_done_dotdot = false;
	public $_done_nullbyte = false;
	public $_done_contami = false;
	public $_done_isocom = false;
	public $_done_union = false;
	public $_done_dos = false;

	public $_safe_badext = true;
	public $_safe_contami = true;
	public $_safe_isocom = true;
	public $_safe_union = true;

	public $_spamcount_uri = 0;

	public $_should_be_banned_time0 = false;
	public $_should_be_banned = false;

	public $_dos_stage = null;

	public $ip_matched_info = null;

	public $last_error_type = 'UNKNOWN';

	public $is_ipv6 = false;
	public $remote_ip = '';

	// Constructor
	public function __construct() {
		return $this->Protector();
	}

	public function Protector() {
		$this->mydirname = 'protector';

		// Preferences from configs/cache
		$this->_conf_serialized = @file_get_contents( $this->get_filepath4confighcache() );
		$this->_conf            = @unserialize( $this->_conf_serialized );
		if ( empty( $this->_conf ) ) {
			$this->_conf = [];
		}

		if ( ! empty( $this->_conf['global_disabled'] ) ) {
			return true;
		}

		$this->_bad_globals = [
			'GLOBALS',
			'_SESSION',
			'HTTP_SESSION_VARS',
			'_GET',
			'HTTP_GET_VARS',
			'_POST',
			'HTTP_POST_VARS',
			'_COOKIE',
			'HTTP_COOKIE_VARS',
			'_SERVER',
			'HTTP_SERVER_VARS',
			'_REQUEST',
			'_ENV',
			'_FILES',
			'xoopsDB',
			'xoopsUser',
			'xoopsUserId',
			'xoopsUserGroups',
			'xoopsUserIsAdmin',
			'xoopsConfig',
			'xoopsOption',
			'xoopsModule',
			'xoopsModuleConfig'
		];

		$this->remote_ip = $this->get_remote_ip();
		if ( false !== strpos( $this->remote_ip, ':' ) ) {
			$this->is_ipv6 = true;
		}

		$this->_initial_recursive( $_GET, 'G' );
		$this->_initial_recursive( $_POST, 'P' );
		$this->_initial_recursive( $_COOKIE, 'C' );
	}

	public function _initial_recursive( $val, $key ) {
		if ( is_array( $val ) ) {
			foreach ( $val as $subkey => $subval ) {
				// check bad globals
				if ( in_array( $subkey, $this->_bad_globals, true ) ) {
					$this->message         .= "Attempt to inject '$subkey' was found.\n";
					$this->_safe_contami   = false;
					$this->last_error_type = 'CONTAMI';
				}
				$this->_initial_recursive( $subval, $key . '_' . base64_encode( $subkey ) );
			}
		} else {
			// check nullbyte attack
			if ( @$this->_conf['san_nullbyte'] && strstr( $val, chr( 0 ) ) ) {
				$val = str_replace( chr( 0 ), ' ', $val );
				$this->replace_doubtful( $key, $val );
				$this->message .= "Injecting Null-byte '$val' found.\n";
				$this->output_log( 'NullByte', 0, false, 32 );
				// $this->purge() ;
			}

			// register as doubtful requests against SQL Injections
			if ( preg_match( '?[\s\'"`/]?', $val ) ) {
				$this->_doubtful_requests[ (string) $key ] = $val;
			}
		}
	}

	public static function getInstance() {
		static $instance;
		if ( ! isset( $instance ) ) {
			$instance = new self();
		}

		return $instance;
	}

	public function updateConfIntoDb( $name, $value ) {
		$constpref = '_MI_' . strtoupper( $this->mydirname );

		$db = &Database::getInstance();
		$db->queryF( 'UPDATE `' . $db->prefix( 'config' ) . "` SET `conf_value`='" . addslashes( $value ) . "' WHERE `conf_title` like '" . $constpref . "%' AND `conf_name`='" . addslashes( $name ) . "' LIMIT 1" );
		$this->updateConfFromDB();
	}

	public function updateConfFromDb() {
		$constpref = '_MI_' . strtoupper( $this->mydirname );

		if ( empty( $this->_conn ) ) {
			return false;
		}

		$query   = 'SELECT `conf_name`,`conf_value` FROM `' . XOOPS_DB_PREFIX . "_config` WHERE `conf_title` like '" . $constpref . "%'";
		$db_conf = [];
		if ( is_object( $this->_conn ) && $this->_conn instanceof \mysqli ) {
			$result = @mysqli_query( $this->_conn, $query );
			if ( ! $result || mysqli_num_rows( $result ) < 5 ) {
				return false;
			}
			while ( list( $key, $val ) = mysqli_fetch_row( $result ) ) {
				$db_conf[ $key ] = $val;
			}
		}

		$db_conf_serialized = serialize( $db_conf );

		// update config cache
		if ( $db_conf_serialized != $this->_conf_serialized ) {
			$fp = fopen( $this->get_filepath4confighcache(), 'w' );
			fwrite( $fp, $db_conf_serialized );
			fclose( $fp );
			$this->_conf = $db_conf;
		}

		return true;
	}

	public function setConn( $conn ) {
		$this->_conn = $conn;
	}

	public function getConf() {
		return $this->_conf;
	}

	public function purge( $redirect_to_top = false ) {
		// clear all session values
		if ( isset( $_SESSION ) ) {
			foreach ( $_SESSION as $key => $val ) {
				$_SESSION[ $key ] = '';
				if ( isset( $GLOBALS[ $key ] ) ) {
					$GLOBALS[ $key ] = '';
				}
			}
		}

		if ( ! headers_sent() ) {
			// clear typical session id of PHP
			setcookie( 'PHPSESSID', '', time() - 3600, '/', '', 0 );
			if ( isset( $_COOKIE[ session_name() ] ) ) {
				setcookie( session_name(), '', time() - 3600, '/', '', 0 );
			}

			// clear autologin cookie
			$xoops_cookie_path = defined( 'XOOPS_COOKIE_PATH' ) ? XOOPS_COOKIE_PATH : preg_replace( '?https://[^/]+(/.*)$?', '$1', XOOPS_URL );
			if ( XOOPS_URL == $xoops_cookie_path ) {
				$xoops_cookie_path = '/';
			}
			setcookie( 'autologin_uname', '', time() - 3600, $xoops_cookie_path, '', 0 );
			setcookie( 'autologin_pass', '', time() - 3600, $xoops_cookie_path, '', 0 );
		}

		if ( $redirect_to_top ) {
			header( 'Location: ' . XOOPS_URL . '/' );
			exit;
		} else {
			$ret = $this->call_filter( 'prepurge_exit' );
			if ( false == $ret ) {
				die( 'Protector detects attacking actions' );
			}
		}
	}

	public function output_log( $type = 'UNKNOWN', $uid = 0, $unique_check = false, $level = 1 ) {
		if ( $this->_logged ) {
			return true;
		}

		if ( ! ( $this->_conf['log_level'] & $level ) ) {
			return true;
		}

		if ( ! is_object( $this->_conn ) || ! $this->_conn instanceof \mysqli ) {
			$this->_conn = @mysqli_connect( XOOPS_DB_HOST, XOOPS_DB_USER, XOOPS_DB_PASS );
			if ( ! $this->_conn ) {
				die( 'db connection failed.' );
			}
			if ( ! mysqli_select_db( $this->_conn, XOOPS_DB_NAME ) ) {
				die( 'db selection failed.' );
			}
		}

		$ip    = $this->remote_ip;
		$agent = @$_SERVER['HTTP_USER_AGENT'];

		if ( $unique_check ) {
			$result = mysqli_query( $this->_conn, 'SELECT ip,type FROM ' . XOOPS_DB_PREFIX . '_' . $this->mydirname . '_log ORDER BY timestamp DESC LIMIT 1' );
			list( $last_ip, $last_type ) = mysqli_fetch_row( $result );
			if ( $last_ip == $ip && $last_type == $type ) {
				$this->_logged = true;

				return true;
			}
		}

		mysqli_query( $this->_conn, 'INSERT INTO ' . XOOPS_DB_PREFIX . '_' . $this->mydirname . "_log SET ip='" . addslashes( $ip ) . "',agent='" . addslashes( $agent ) . "',type='" . addslashes( $type ) . "',description='" . addslashes( $this->message ) . "',uid='" . (int) $uid . "',timestamp=NOW()" );
		$this->_logged = true;

		return true;
	}

	public function write_file_bwlimit( $expire ) {
		$expire = min( (int) $expire, time() + 300 );

		$fp = @fopen( $this->get_filepath4bwlimit(), 'w' );
		if ( $fp ) {
			@flock( $fp, LOCK_EX );
			fwrite( $fp, $expire . "\n" );
			@flock( $fp, LOCK_UN );
			fclose( $fp );

			return true;
		} else {
			return false;
		}
	}

	public function get_bwlimit() {
		list( $expire ) = @file( self::get_filepath4bwlimit() );
		$expire = min( (int) $expire, time() + 300 );

		return $expire;
	}

	public function get_filepath4bwlimit() {
		return XOOPS_TRUST_PATH . '/modules/protector/configs/bwlimit' . substr( md5( XOOPS_ROOT_PATH . XOOPS_DB_USER . XOOPS_DB_PREFIX ), 0, 6 );
	}

	public function write_file_badips( $bad_ips ) {
		asort( $bad_ips );

		$fp = @fopen( $this->get_filepath4badips(), 'w' );
		if ( $fp ) {
			@flock( $fp, LOCK_EX );
			fwrite( $fp, serialize( $bad_ips ) . "\n" );
			@flock( $fp, LOCK_UN );
			fclose( $fp );

			return true;
		} else {
			return false;
		}
	}

	public function register_bad_ips( $jailed_time = 0, $ip = null ) {
		if ( empty( $ip ) ) {
			$ip = $this->get_remote_ip( @$this->_conf['banip_ipv6prefix'] );
		}
		if ( empty( $ip ) ) {
			return false;
		}

		$bad_ips        = $this->get_bad_ips( true );
		$bad_ips[ $ip ] = $jailed_time ?: 0x7fffffff;

		return $this->write_file_badips( $bad_ips );
	}

	public function get_bad_ips( $with_jailed_time = false ) {
		list( $bad_ips_serialized ) = @file( self::get_filepath4badips() );
		$bad_ips = empty( $bad_ips_serialized ) ? [] : @unserialize( $bad_ips_serialized );
		if ( ! is_array( $bad_ips ) || isset( $bad_ips[0] ) ) {
			$bad_ips = [];
		}

		// expire jailed_time
		$pos = 0;
		foreach ( $bad_ips as $bad_ip => $jailed_time ) {
			if ( $jailed_time >= time() ) {
				break;
			}
			++ $pos;
		}
		$bad_ips = array_slice( $bad_ips, $pos );

		if ( $with_jailed_time ) {
			return $bad_ips;
		} else {
			return array_keys( $bad_ips );
		}
	}

	public function get_filepath4badips() {
		return XOOPS_TRUST_PATH . '/modules/protector/configs/badips' . substr( md5( XOOPS_ROOT_PATH . XOOPS_DB_USER . XOOPS_DB_PREFIX ), 0, 6 );
	}

	/**
	 * @param bool $with_info
	 *
	 * @return array|mixed
	 */

	public function get_group1_ips( $with_info = false ) {
		list( $group1_ips_serialized ) = @file( self::get_filepath4group1ips() );
		$group1_ips = empty( $group1_ips_serialized ) ? [] : @unserialize( $group1_ips_serialized );
		if ( ! is_array( $group1_ips ) ) {
			$group1_ips = [];
		}

		if ( $with_info ) {
			$group1_ips = array_flip( $group1_ips );
		}

		return $group1_ips;
	}

	/**
	 * @return string
	 */
	public static function get_filepath4group1ips() {
		return XOOPS_TRUST_PATH . '/modules/protector/configs/group1ips' . substr( md5( XOOPS_ROOT_PATH . XOOPS_DB_USER . XOOPS_DB_PREFIX ), 0, 6 );
	}

	/**
	 * @return string
	 */
	public function get_filepath4confighcache() {
		return XOOPS_TRUST_PATH . '/modules/protector/configs/configcache' . substr( md5( XOOPS_ROOT_PATH . XOOPS_DB_USER . XOOPS_DB_PREFIX ), 0, 6 );
	}

	/**
	 * @param $ips
	 *
	 * @return bool
	 */
	public function ip_match( $ips ) {
		foreach ( $ips as $ip => $info ) {
			if ( $ip ) {
				$last = substr( $ip, - 1 );
				if ( $this->is_ipv6 ) {
					$ip = strtolower( $ip );
					if ( preg_match( '/^[0-9a-f:]$/', $last ) ) {
						$last = '';
					}
				}
				switch ( $last ) {
					case '':
					case '.':
						// foward match
						if ( substr( $this->remote_ip, 0, strlen( $ip ) ) === $ip ) {
							$this->ip_matched_info = $info;

							return true;
						}
						break;
					case '0':
					case '1':
					case '2':
					case '3':
					case '4':
					case '5':
					case '6':
					case '7':
					case '8':
					case '9':
						// full match
						if ( $this->remote_ip === $ip ) {
							$this->ip_matched_info = $info;

							return true;
						}
						break;
					default:
						// perl regex
						if ( @preg_match( $ip, $this->remote_ip ) ) {
							$this->ip_matched_info = $info;

							return true;
						}
						break;
				}
			}
		}
		$this->ip_matched_info = null;

		return false;
	}

	public function deny_by_htaccess( $ip = null ) {
		if ( empty( $ip ) ) {
			$ip = $this->remote_ip;
		}
		if ( empty( $ip ) ) {
			return false;
		}
		if ( ! function_exists( 'file_get_contents' ) ) {
			return false;
		}

		$target_htaccess = XOOPS_ROOT_PATH . '/.htaccess';
		$backup_htaccess = XOOPS_ROOT_PATH . '/uploads/.htaccess.bak';

		$ht_body = file_get_contents( $target_htaccess );

		// make backup as uploads/.htaccess.bak automatically
		if ( $ht_body && ! file_exists( $backup_htaccess ) ) {
			$fw = fopen( $backup_htaccess, 'w' );
			fwrite( $fw, $ht_body );
			fclose( $fw );
		}

		// if .htaccess is broken, restore from backup
		if ( ! $ht_body && file_exists( $backup_htaccess ) ) {
			$ht_body = file_get_contents( $backup_htaccess );
		}

		// new .htaccess
		if ( false === $ht_body ) {
			$ht_body = '';
		}

		if ( preg_match( "/^(.*)#PROTECTOR#\s+(DENY FROM .*)\n#PROTECTOR#\n(.*)$/si", $ht_body, $regs ) ) {
			if ( substr( $regs[2], - strlen( $ip ) ) == $ip ) {
				return true;
			}
			$new_ht_body = $regs[1] . "#PROTECTOR#\n" . $regs[2] . " $ip\n#PROTECTOR#\n" . $regs[3];
		} else {
			$new_ht_body = "#PROTECTOR#\nDENY FROM $ip\n#PROTECTOR#\n" . $ht_body;
		}

		// error_log( "$new_ht_body\n" , 3 , "/tmp/error_log" ) ;

		$fw = fopen( $target_htaccess, 'w' );
		@flock( $fw, LOCK_EX );
		fwrite( $fw, $new_ht_body );
		@flock( $fw, LOCK_UN );
		fclose( $fw );

		return true;
	}

	public function getDblayertrapDoubtfuls() {
		return $this->_dblayertrap_doubtfuls;
	}

	public function _dblayertrap_check_recursive( $val ) {
		if ( is_array( $val ) ) {
			foreach ( $val as $subval ) {
				$this->_dblayertrap_check_recursive( $subval );
			}
		} else {
			if ( strlen( $val ) < 6 ) {
				return;
			}
			foreach ( $this->_dblayertrap_doubtful_needles as $needle ) {
				if ( stristr( $val, $needle ) ) {
					$this->_dblayertrap_doubtfuls[] = $val;
				}
			}
		}
	}

	/**
	 * @param bool $force_override
	 *
	 * @return null
	 */

	public function dblayertrap_init( $force_override = false ) {
		if ( ! empty( $GLOBALS['xoopsOption']['nocommon'] ) || defined( '_LEGACY_PREVENT_EXEC_COMMON_' ) || defined( '_LEGACY_PREVENT_LOAD_CORE_' ) ) {
			return;
		} // skip

		$this->_dblayertrap_doubtfuls = [];
		$this->_dblayertrap_check_recursive( $_GET );
		$this->_dblayertrap_check_recursive( $_POST );
		$this->_dblayertrap_check_recursive( $_COOKIE );
		if ( empty( $this->_conf['dblayertrap_wo_server'] ) ) {
			$this->_dblayertrap_check_recursive( $_SERVER );
		}

		if ( ! empty( $this->_dblayertrap_doubtfuls ) || $force_override ) {
			@define( 'XOOPS_DB_ALTERNATIVE', 'ProtectorMysqlDatabase' );
			require_once dirname( __DIR__ ) . '/class/ProtectorMysqlDatabase.class.php';
		}
	}

	/**
	 * @param $val
	 */
	protected function _bigumbrella_check_recursive( $val ) {
		if ( is_array( $val ) ) {
			foreach ( $val as $subval ) {
				$this->_bigumbrella_check_recursive( $subval );
			}
		} else {
			if ( preg_match( '/[<\'"].{15}/s', $val, $regs ) ) {
				$this->_bigumbrella_doubtfuls[] = $regs[0];
			}
		}
	}

	public function bigumbrella_init() {
		$this->_bigumbrella_doubtfuls = [];
		$this->_bigumbrella_check_recursive( $_GET );
		$this->_bigumbrella_check_recursive( @$_SERVER['PHP_SELF'] );

		if ( ! empty( $this->_bigumbrella_doubtfuls ) ) {
			ob_start( [ $this, 'bigumbrella_outputcheck' ] );
		}
	}

	/**
	 * @param $s
	 *
	 * @return string
	 */
	public function bigumbrella_outputcheck( $s ) {
		if ( defined( 'BIGUMBRELLA_DISABLED' ) ) {
			return $s;
		}

		if ( function_exists( 'headers_list' ) ) {
			foreach ( headers_list() as $header ) {
				if ( stristr( $header, 'Content-Type:' ) && ! stristr( $header, 'text/html' ) ) {
					return $s;
				}
			}
		}

		if ( ! is_array( $this->_bigumbrella_doubtfuls ) ) {
			return 'bigumbrella injection found.';
		}

		foreach ( $this->_bigumbrella_doubtfuls as $doubtful ) {
			if ( strstr( $s, $doubtful ) ) {
				return 'XSS found by Protector.';
			}
		}

		return $s;
		/**
		 * @return bool
		 */
	}

	public function intval_allrequestsendid() {
		global $HTTP_GET_VARS, $HTTP_POST_VARS, $HTTP_COOKIE_VARS;

		if ( $this->_done_intval ) {
			return true;
		} else {
			$this->_done_intval = true;
		}

		foreach ( $_GET as $key => $val ) {
			if ( 'id' == substr( $key, - 2 ) && ! is_array( $_GET[ $key ] ) ) {
				$newval = preg_replace( '/[^0-9a-zA-Z_-]/', '', $val );
				if ( isset( $_REQUEST[ $key ] ) && $_REQUEST[ $key ] == $_GET[ $key ] ) {
					$_REQUEST[ $key ] = $newval;
				}
				$_GET[ $key ] = $HTTP_GET_VARS[ $key ] = $newval;
			}
		}
		foreach ( $_POST as $key => $val ) {
			if ( 'id' == substr( $key, - 2 ) && ! is_array( $_POST[ $key ] ) ) {
				$newval = preg_replace( '/[^0-9a-zA-Z_-]/', '', $val );
				if ( isset( $_REQUEST[ $key ] ) && $_REQUEST[ $key ] == $_POST[ $key ] ) {
					$_REQUEST[ $key ] = $newval;
				}
				$_POST[ $key ] = $HTTP_POST_VARS[ $key ] = $newval;
			}
		}
		foreach ( $_COOKIE as $key => $val ) {
			if ( 'id' == substr( $key, - 2 ) && ! is_array( $_COOKIE[ $key ] ) ) {
				$newval = preg_replace( '/[^0-9a-zA-Z_-]/', '', $val );
				if ( isset( $_REQUEST[ $key ] ) && $_REQUEST[ $key ] == $_COOKIE[ $key ] ) {
					$_REQUEST[ $key ] = $newval;
				}
				$_COOKIE[ $key ] = $HTTP_COOKIE_VARS[ $key ] = $newval;
			}
		}

		return true;
	}

	/**
	 * @return bool
	 */
	public function eliminate_dotdot() {
		global $HTTP_GET_VARS, $HTTP_POST_VARS, $HTTP_COOKIE_VARS;

		if ( $this->_done_dotdot ) {
			return true;
		} else {
			$this->_done_dotdot = true;
		}

		foreach ( $_GET as $key => $val ) {
			if ( is_array( $_GET[ $key ] ) ) {
				continue;
			}
			if ( '../' == substr( trim( $val ), 0, 3 ) || strstr( $val, '../../' ) ) {
				$this->last_error_type = 'DirTraversal';
				$this->message         .= "Directory Traversal '$val' found.\n";
				$this->output_log( $this->last_error_type, 0, false, 64 );
				$sanitized_val = str_replace( chr( 0 ), '', $val );
				if ( ' .' != substr( $sanitized_val, - 2 ) ) {
					$sanitized_val .= ' .';
				}
				$_GET[ $key ] = $HTTP_GET_VARS[ $key ] = $sanitized_val;
				if ( $_REQUEST[ $key ] == $_GET[ $key ] ) {
					$_REQUEST[ $key ] = $sanitized_val;
				}
			}
		}

		return true;
	}

	/**
	 * @param $current
	 * @param $indexes
	 *
	 * @return bool
	 */

	public function &get_ref_from_base64index( &$current, $indexes ) {
		foreach ( $indexes as $index ) {
			$index = base64_decode( $index );
			if ( ! is_array( $current ) ) {
				return false;
			}
			$current = &$current[ $index ];
		}

		return $current;
	}

	/**
	 * @param $key
	 * @param $val
	 */
	public function replace_doubtful( $key, $val ) {
		global $HTTP_GET_VARS, $HTTP_POST_VARS, $HTTP_COOKIE_VARS;

		$index_expression = '';
		$indexes          = explode( '_', $key );
		$base_array       = array_shift( $indexes );

		switch ( $base_array ) {
			case 'G':
				$main_ref   = &$this->get_ref_from_base64index( $_GET, $indexes );
				$legacy_ref = &$this->get_ref_from_base64index( $HTTP_GET_VARS, $indexes );
				break;
			case 'P':
				$main_ref   = &$this->get_ref_from_base64index( $_POST, $indexes );
				$legacy_ref = &$this->get_ref_from_base64index( $HTTP_POST_VARS, $indexes );
				break;
			case 'C':
				$main_ref   = &$this->get_ref_from_base64index( $_COOKIE, $indexes );
				$legacy_ref = &$this->get_ref_from_base64index( $HTTP_COOKIE_VARS, $indexes );
				break;
			default:
				exit;
		}
		if ( ! isset( $main_ref ) ) {
			exit;
		}
		$request_ref = &$this->get_ref_from_base64index( $_REQUEST, $indexes );
		if ( false !== $request_ref && $main_ref == $request_ref ) {
			$request_ref = $val;
		}
		$main_ref   = $val;
		$legacy_ref = $val;
	}

	/**
	 * @return bool
	 */
	public function check_uploaded_files() {
		if ( $this->_done_badext ) {
			return $this->_safe_badext;
		} else {
			$this->_done_badext = true;
		}

		// extensions never uploaded
		$bad_extensions = [ 'php', 'phtml', 'phtm', 'php3', 'php4', 'cgi', 'pl', 'asp' ];
		// extensions needed image check (anti-IE Content-Type XSS)
		$image_extensions = [
			1  => 'gif',
			2  => 'jpg',
			3  => 'png',
			4  => 'swf',
			5  => 'psd',
			6  => 'bmp',
			7  => 'tif',
			8  => 'tif',
			9  => 'jpc',
			10 => 'jp2',
			11 => 'jpx',
			12 => 'jb2',
			13 => 'swc',
			14 => 'iff',
			15 => 'wbmp',
			16 => 'xbm'
		];

		foreach ( $_FILES as $_file ) {
			if ( ! empty( $_file['error'] ) ) {
				continue;
			}
			if ( ! empty( $_file['name'] ) && is_string( $_file['name'] ) ) {
				$ext = strtolower( substr( strrchr( $_file['name'], '.' ), 1 ) );
				if ( 'jpeg' == $ext ) {
					$ext = 'jpg';
				} elseif ( 'tiff' == $ext ) {
					$ext = 'tif';
				} elseif ( 'swc' == $ext ) {
					$ext = 'swf';
				}

				// anti multiple dot file (Apache mod_mime.c)
				if ( count( explode( '.', str_replace( '.tar.gz', '.tgz', $_file['name'] ) ) ) > 2 ) {
					$this->message         .= "Attempt to multiple dot file {$_file['name']}.\n";
					$this->_safe_badext    = false;
					$this->last_error_type = 'UPLOAD';
				}

				// anti dangerous extensions
				if ( in_array( $ext, $bad_extensions ) ) {
					$this->message         .= "Attempt to upload {$_file['name']}.\n";
					$this->_safe_badext    = false;
					$this->last_error_type = 'UPLOAD';
				}

				// anti camouflaged image file
				if ( in_array( $ext, $image_extensions ) ) {
					$image_attributes = @getimagesize( $_file['tmp_name'] );
					if ( false === $image_attributes && is_uploaded_file( $_file['tmp_name'] ) ) {
						// open_basedir restriction
						$temp_file = XOOPS_ROOT_PATH . '/uploads/protector_upload_temporary' . md5( time() );
						move_uploaded_file( $_file['tmp_name'], $temp_file );
						$image_attributes = @getimagesize( $temp_file );
						@unlink( $temp_file );
					}

					$imagetype = (int) $image_attributes[2];
					if ( IMAGETYPE_SWC == $imagetype ) {
						$imagetype = IMAGETYPE_SWF;
					}
					if ( false === $image_attributes || $image_extensions[ $imagetype ] != $ext ) {
						$this->message         .= "Attempt to upload camouflaged image file {$_file['name']}.\n";
						$this->_safe_badext    = false;
						$this->last_error_type = 'UPLOAD';
					}
				}
			}
		}

		return $this->_safe_badext;
	}

	/**
	 * @return bool
	 */
	public function check_contami_systemglobals() {

		return $this->_safe_contami;
	}

	public function check_sql_isolatedcommentin( $sanitize = true ) {
		if ( $this->_done_isocom ) {
			return $this->_safe_isocom;
		} else {
			$this->_done_isocom = true;
		}

		foreach ( $this->_doubtful_requests as $key => $val ) {
			$str = $val;
			while ( $str = strstr( $str, '/*' ) ) {
				$str = strstr( substr( $str, 2 ), '*/' );
				if ( false === $str ) {
					$this->message .= "Isolated comment-in found. ($val)\n";
					if ( $sanitize ) {
						$this->replace_doubtful( $key, $val . '*/' );
					}
					$this->_safe_isocom    = false;
					$this->last_error_type = 'ISOCOM';
				}
			}
		}

		return $this->_safe_isocom;
	}

	/**
	 * @param bool $sanitize
	 *
	 * @return bool
	 */
	public function check_sql_union( $sanitize = true ) {
		if ( $this->_done_union ) {
			return $this->_safe_union;
		} else {
			$this->_done_union = true;
		}

		foreach ( $this->_doubtful_requests as $key => $val ) {
			$str = str_replace( [ '/*', '*/' ], '', preg_replace( '?/\*.+\*/?sU', '', $val ) );
			if ( preg_match( '/\sUNION\s+(ALL|SELECT)/i', $str ) ) {
				$this->message .= "Pattern like SQL injection found. ($val)\n";
				if ( $sanitize ) {
					$this->replace_doubtful( $key, preg_replace( '/union/i', 'uni-on', $val ) );
				}
				$this->_safe_union     = false;
				$this->last_error_type = 'UNION';
			}
		}

		return $this->_safe_union;
	}

	public function check_dos_attack( $uid = 0, $can_ban = false ) {
		global $xoopsDB;

		if ( $this->_done_dos ) {
			return true;
		}

		$ip      = $this->remote_ip;
		$uri     = @$_SERVER['REQUEST_URI'];
		$ip4sql  = addslashes( $ip );
		$uri4sql = addslashes( substr( $uri, 0, 191 ) );
		if ( empty( $ip ) || '' == $ip ) {
			return true;
		}

		// garbage collection
		$result = $xoopsDB->queryF( 'DELETE FROM ' . $xoopsDB->prefix( $this->mydirname . '_access' ) . ' WHERE expire < UNIX_TIMESTAMP()' );

		// for older versions before updating this module
		if ( false === $result ) {
			$this->_done_dos = true;

			return true;
		}

		// sql for recording access log (INSERT should be placed after SELECT)
		$sql4insertlog = 'INSERT INTO ' . $xoopsDB->prefix( $this->mydirname . '_access' ) . " SET ip='$ip4sql',request_uri='$uri4sql',expire=UNIX_TIMESTAMP()+'" . (int) $this->_conf['dos_expire'] . "'";

		// bandwidth limitation
		if ( @$this->_conf['bwlimit_count'] >= 10 ) {
			$result = $xoopsDB->query( 'SELECT COUNT(*) FROM ' . $xoopsDB->prefix( $this->mydirname . '_access' ) );
			list( $bw_count ) = $xoopsDB->fetchRow( $result );
			if ( $bw_count > $this->_conf['bwlimit_count'] ) {
				$this->write_file_bwlimit( time() + $this->_conf['dos_expire'] );
			}
		}

		// F5 attack check (High load & same URI)
		$result = $xoopsDB->query( 'SELECT COUNT(*) FROM ' . $xoopsDB->prefix( $this->mydirname . '_access' ) . " WHERE ip='$ip4sql' AND request_uri='$uri4sql'" );
		list( $f5_count ) = $xoopsDB->fetchRow( $result );
		if ( $f5_count > $this->_conf['dos_f5count'] ) {

			// delayed insert
			$xoopsDB->queryF( $sql4insertlog );

			// extends the expires of the IP with 5 minutes at least (pending)
			// $result = $xoopsDB->queryF( "UPDATE ".$xoopsDB->prefix($this->mydirname."_access")." SET expire=UNIX_TIMESTAMP()+300 WHERE ip='$ip4sql' AND expire<UNIX_TIMESTAMP()+300" ) ;

			// call the filter first
			$ret = $this->call_filter( 'f5attack_overrun' );

			// actions for F5 Attack
			$this->_done_dos       = true;
			$this->last_error_type = 'DoS';
			switch ( $this->_conf['dos_f5action'] ) {
				default:
				case 'exit':
					$this->output_log( $this->last_error_type, $uid, true, 16 );
					exit;
				case 'none':
					$this->output_log( $this->last_error_type, $uid, true, 16 );

					return true;
				case 'biptime0':
					if ( $can_ban ) {
						$this->register_bad_ips( time() + $this->_conf['banip_time0'] );
					}
					break;
				case 'bip':
					if ( $can_ban ) {
						$this->register_bad_ips();
					}
					break;
				case 'hta':
					if ( $can_ban ) {
						$this->deny_by_htaccess();
					}
					break;
				case 'sleep':
					sleep( 5 );
					break;
			}

			return false;
		}

		// Check its Agent
		if ( '' != trim( $this->_conf['dos_crsafe'] ) && preg_match( $this->_conf['dos_crsafe'], @$_SERVER['HTTP_USER_AGENT'] ) ) {
			// welcomed crawler
			$this->_done_dos = true;

			return true;
		}

		// Crawler check (High load & different URI)
		$result = $xoopsDB->query( 'SELECT COUNT(*) FROM ' . $xoopsDB->prefix( $this->mydirname . '_access' ) . " WHERE ip='$ip4sql'" );
		list( $crawler_count ) = $xoopsDB->fetchRow( $result );

		// delayed insert
		$xoopsDB->queryF( $sql4insertlog );

		if ( $crawler_count > $this->_conf['dos_crcount'] ) {

			// call the filter first
			$ret = $this->call_filter( 'crawler_overrun' );

			// actions for bad Crawler
			$this->_done_dos       = true;
			$this->last_error_type = 'CRAWLER';
			switch ( $this->_conf['dos_craction'] ) {
				default:
				case 'exit':
					$this->output_log( $this->last_error_type, $uid, true, 16 );
					exit;
				case 'none':
					$this->output_log( $this->last_error_type, $uid, true, 16 );

					return true;
				case 'biptime0':
					if ( $can_ban ) {
						$this->register_bad_ips( time() + $this->_conf['banip_time0'] );
					}
					break;
				case 'bip':
					if ( $can_ban ) {
						$this->register_bad_ips();
					}
					break;
				case 'hta':
					if ( $can_ban ) {
						$this->deny_by_htaccess();
					}
					break;
				case 'sleep':
					sleep( 5 );
					break;
			}

			return false;
		}

		return true;
	}

	public function check_brute_force() {
		global $xoopsDB;

		$ip      = $this->remote_ip;
		$uri     = @$_SERVER['REQUEST_URI'];
		$ip4sql  = addslashes( $ip );
		$uri4sql = addslashes( substr( $uri, 0, 191 ) );
		if ( empty( $ip ) || '' == $ip ) {
			return true;
		}

		$victim_uname = empty( $_COOKIE['autologin_uname'] ) ? $_POST['uname'] : $_COOKIE['autologin_uname'];
		// some UA send 'deleted' as a value of the deleted cookie.
		if ( 'deleted' == $victim_uname ) {
			return;
		}
		$mal4sql = addslashes( "BRUTE FORCE: $victim_uname" );

		// gargage collection
		$result = $xoopsDB->queryF( 'DELETE FROM ' . $xoopsDB->prefix( $this->mydirname . '_access' ) . ' WHERE expire < UNIX_TIMESTAMP()' );

		// sql for recording access log (INSERT should be placed after SELECT)
		$sql4insertlog = 'INSERT INTO ' . $xoopsDB->prefix( $this->mydirname . '_access' ) . " SET ip='$ip4sql',request_uri='$uri4sql',malicious_actions='$mal4sql',expire=UNIX_TIMESTAMP()+600";

		// count check
		$result = $xoopsDB->query( 'SELECT COUNT(*) FROM ' . $xoopsDB->prefix( $this->mydirname . '_access' ) . " WHERE ip='$ip4sql' AND malicious_actions like 'BRUTE FORCE:%'" );
		list( $bf_count ) = $xoopsDB->fetchRow( $result );
		if ( $bf_count > $this->_conf['bf_count'] ) {
			$this->register_bad_ips( time() + $this->_conf['banip_time0'] );
			$this->last_error_type = 'BruteForce';
			$this->message         .= "Trying to login as '" . addslashes( $victim_uname ) . "' found.\n";
			$this->output_log( 'BRUTE FORCE', 0, true, 1 );
			$ret = $this->call_filter( 'bruteforce_overrun' );
			if ( false == $ret ) {
				exit;
			}
		}
		// delayed insert
		$xoopsDB->queryF( $sql4insertlog );
	}

	public function _spam_check_point_recursive( $val ) {
		if ( is_array( $val ) ) {
			foreach ( $val as $subval ) {
				$this->_spam_check_point_recursive( $subval );
			}
		} else {
			// http_host
			$path_array = parse_url( XOOPS_URL );
			$http_host  = empty( $path_array['host'] ) ? 'www.xoops.org' : $path_array['host'];

			// count URI up
			$count = - 1;
			foreach ( preg_split( '#https?\:\/\/#i', $val ) as $fragment ) {
				if ( 0 !== strncmp( $fragment, $http_host, strlen( $http_host ) ) ) {
					++ $count;
				}
			}
			if ( $count > 0 ) {
				$this->_spamcount_uri += $count;
			}

			// count BBCode likd [url=www....] up (without [url=https://...])
			$this->_spamcount_uri += count( preg_split( '/\[url=(?!http|\\"http|\\\'http|' . $http_host . ')/i', $val ) ) - 1;
		}
	}

	public function spam_check( $points4deny, $uid ) {
		$this->_spamcount_uri = 0;
		$this->_spam_check_point_recursive( $_POST );

		if ( $this->_spamcount_uri >= $points4deny ) {
			$this->message .= @$_SERVER['REQUEST_URI'] . " SPAM POINT: $this->_spamcount_uri\n";
			$this->output_log( 'URI SPAM', $uid, false, 128 );
			$ret = $this->call_filter( 'spamcheck_overrun' );
			if ( false == $ret ) {
				exit;
			}
		}
	}

	public function check_manipulation() {
		if ( $_SERVER['SCRIPT_FILENAME'] == XOOPS_ROOT_PATH . '/index.php' ) {
			$root_stat    = stat( XOOPS_ROOT_PATH );
			$index_stat   = stat( XOOPS_ROOT_PATH . '/index.php' );
			$finger_print = $root_stat['mtime'] . ':' . $index_stat['mtime'] . ':' . $index_stat['ino'];
			if ( empty( $this->_conf['manip_value'] ) ) {
				$this->updateConfIntoDb( 'manip_value', $finger_print );
			} elseif ( $finger_print != $this->_conf['manip_value'] ) {
				// Notify if finger_print is ident from old one
				$ret = $this->call_filter( 'postcommon_manipu' );
				if ( false == $ret ) {
					die( 'Protector detects site manipulation.' );
				}
				$this->updateConfIntoDb( 'manip_value', $finger_print );
			}
		}
	}

	public function disable_features() {
		global $HTTP_POST_VARS, $HTTP_GET_VARS, $HTTP_COOKIE_VARS;

		// disable "Notice: Undefined index: ..."
		$error_reporting_level = error_reporting( 0 );

		// bit 1 : disable XMLRPC , criteria bug

		if ( $this->_conf['disable_features'] & 1 ) {

			// zx 2005/1/5 disable xmlrpc.php in root
			if (/* ! stristr( $_SERVER['SCRIPT_NAME'] , 'modules' ) && */ 'xmlrpc.php' == substr( @$_SERVER['SCRIPT_NAME'], - 10 ) ) {
				$this->output_log( 'xmlrpc', 0, true, 1 );
				exit;
			}

			// security bug of class/criteria.php 2005/6/27
			if ( '0' === $_POST['uname'] || '0' === $_COOKIE['autologin_pass'] ) {
				$this->output_log( 'CRITERIA' );
				exit;
			}
		}

		// bit 11 : XSS+CSRFs in XOOPS < 2.0.10

		if ( $this->_conf['disable_features'] & 1024 ) {

			// root controllers
			if ( ! stristr( @$_SERVER['SCRIPT_NAME'], 'modules' ) ) {
				// zx 2004/12/13 misc.php debug (file check)
				if ( 'misc.php' == substr( @$_SERVER['SCRIPT_NAME'], - 8 ) && ( 'debug' == $_GET['type'] || 'debug' == $_POST['type'] ) && ! preg_match( '/^dummy_[0-9]+\.html$/', $_GET['file'] ) ) {
					$this->output_log( 'misc debug' );
					exit;
				}

				// zx 2004/12/13 misc.php smilies
				if ( 'misc.php' == substr( @$_SERVER['SCRIPT_NAME'], - 8 ) && ( 'smilies' == $_GET['type'] || 'smilies' == $_POST['type'] ) && ! preg_match( '/^[0-9a-z_]*$/i', $_GET['target'] ) ) {
					$this->output_log( 'misc smilies' );
					exit;
				}

				// zx 2005/1/5 edituser.php avatarchoose
				if ( 'edituser.php' == substr( @$_SERVER['SCRIPT_NAME'], - 12 ) && 'avatarchoose' == $_POST['op'] && strstr( $_POST['user_avatar'], '..' ) ) {
					$this->output_log( 'edituser avatarchoose' );
					exit;
				}
			}

			// zx 2005/1/4 findusers
			if ( 'modules/system/admin.php' == substr( @$_SERVER['SCRIPT_NAME'], - 24 ) && ( 'findusers' == $_GET['fct'] || 'findusers' == $_POST['fct'] ) ) {
				foreach ( $_POST as $key => $val ) {
					if ( strstr( $key, "'" ) || strstr( $val, "'" ) ) {
						$this->output_log( 'findusers' );
						exit;
					}
				}
			}

			// preview CSRF zx 2004/12/14
			// news submit.php
			if ( 'modules/news/submit.php' == substr( @$_SERVER['SCRIPT_NAME'], - 23 ) && isset( $_POST['preview'] ) && 0 !== strpos( @$_SERVER['HTTP_REFERER'], XOOPS_URL . '/modules/news/submit.php' ) ) {
				$HTTP_POST_VARS['nohtml'] = $_POST['nohtml'] = 1;
			}
			// news admin/index.php
			if ( 'modules/news/admin/index.php' == substr( @$_SERVER['SCRIPT_NAME'], - 28 ) && ( 'preview' == $_POST['op'] || 'preview' == $_GET['op'] ) && 0 !== strpos( @$_SERVER['HTTP_REFERER'], XOOPS_URL . '/modules/news/admin/index.php' ) ) {
				$HTTP_POST_VARS['nohtml'] = $_POST['nohtml'] = 1;
			}
			// comment comment_post.php
			if ( isset( $_POST['com_dopreview'] ) && ! strstr( substr( @$_SERVER['HTTP_REFERER'], - 16 ), 'comment_post.php' ) ) {
				$HTTP_POST_VARS['dohtml'] = $_POST['dohtml'] = 0;
			}
			// disable preview of system's blocksadmin
			if ( 'modules/system/admin.php' == substr( @$_SERVER['SCRIPT_NAME'], - 24 ) && ( 'blocksadmin' == $_GET['fct'] || 'blocksadmin' == $_POST['fct'] ) && isset( $_POST['previewblock'] ) /* && strpos( $_SERVER['HTTP_REFERER'] , XOOPS_URL.'/modules/system/admin.php' ) !== 0 */ ) {
				die( "Danger! don't use this preview. Use 'altsys module' instead.(by Protector)" );
			}
			// tpl preview
			if ( 'modules/system/admin.php' == substr( @$_SERVER['SCRIPT_NAME'], - 24 ) && ( 'tplsets' == $_GET['fct'] || 'tplsets' == $_POST['fct'] ) ) {
				if ( 'previewpopup' == $_POST['op'] || 'previewpopup' == $_GET['op'] || isset( $_POST['previewtpl'] ) ) {
					die( "Danger! don't use this preview.(by Protector)" );
				}
			}
		}

		// restore reporting level
		error_reporting( $error_reporting_level );
	}

	public function call_filter( $type, $dying_message = '' ) {
		require_once __DIR__ . '/ProtectorFilter.php';
		$filter_handler = &ProtectorFilterHandler::getInstance();
		$ret            = $filter_handler->execute( $type );
		if ( false == $ret && $dying_message ) {
			die( $dying_message );
		}

		return $ret;
	}

	protected function get_remote_ip( $ipv6prefix = 0, $ipv4 = true ) {
		$ip = @$_SERVER['REMOTE_ADDR'];
		if ( false === strpos( $ip, ':' ) ) {
			return $ipv4 ? $ip : '';
		}
		$ip     = strtolower( $ip );
		$fulls  = [];
		$fileds = explode( ':', $ip );
		if ( false !== strpos( $ip, '::' ) ) {
			$inscnt = 9 - count( $fileds );
			foreach ( $fileds as $i => $filed ) {
				if ( '' === $filed ) {
					if ( 0 === $i ) {
						$fulls[] = '0000';
					} else {
						$fulls = array_merge( $fulls, array_pad( [], $inscnt, '0000' ) );
					}
				} else {
					$fulls[] = str_pad( $filed, 4, '0', STR_PAD_LEFT );
				}
			}
		} else {
			foreach ( $fileds as $filed ) {
				$fulls[] = str_pad( $filed, 4, '0', STR_PAD_LEFT );
			}
		}
		$full = implode( '', $fulls );
		if ( $ipv6prefix && $ipv6prefix < 128 ) {
			$full = substr( $full, 0, $ipv6prefix / 4 );
		}
		$fulls  = str_split( $full, 4 );
		$fullip = implode( ':', $fulls );

		return $fullip;
	}
}
