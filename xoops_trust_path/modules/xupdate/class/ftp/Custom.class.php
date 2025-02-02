<?php
/**
 * X-Update package management for XCL
 *
 * @package XCL
 * @subpackage Xupdate
 * @version 2.3
 * @author Naoki Sawada, Naoki Okino, Gigamaster (XCL 2.3)
 * @copyright Copyright 2005-2022 XOOPSCube Project
 * @license https://github.com/xoopscube/xcl/blob/master/GPL_V2.txt
 */

include_once __DIR__ . '/Abstract.class.php';

class Xupdate_Ftp_CustomBase extends Xupdate_Ftp_Abstract {

	/* Constructor */
	public function __construct( $XupdateObj, $port_mode = false, $verb = false, $le = false ) {
		parent::__construct( $XupdateObj );
	}

// <!-- --------------------------------------------------------------------------------------- -->
// <!--       Public functions                                                                  -->
// <!-- --------------------------------------------------------------------------------------- -->
	/**
	 * app_login
	 *
	 * @param string $server
	 *
	 * @return    bool
	 **/
	public function app_login( $server ) {
		$ftp_use_ssl = $this->mod_config['FTP_SSL'];
		$ftp_id      = $this->mod_config['FTP_UserName'];
		$ftp_pass    = $this->mod_config['FTP_password'];

		// LOGIN

		$this->Verbose   = true;
		$this->LocalEcho = false;
		//$this->Passive(TRUE);

		if ( ! $this->SetServer( $server, 21, true ) ) {
			$this->quit();
			$this->mes .= "Setiing server failed<br>\n";

			return false;
		}

		if ( $ftp_use_ssl ) {
			$ftp_connected = $this->ssl_connect();
		} else {
			$ftp_connected = $this->connect();
		}
		if ( true !== $ftp_connected ) {
			$this->mes .= "Cannot connect<br>\n";

			return false;
		} else {
			if ( true !== $this->login( $ftp_id, $ftp_pass ) ) {
				$this->mes .= "login failed<br>\n";

				return false;
			} else {
				$this->mes .= "login succeeded<br>\n";
			}
		}
		if ( ! $this->Passive( true ) ) {
			$this->mes .= "Passive FAILS!<br>\n";
		}

		// SET BINARY MODE
		if ( ! $this->SetType( FTP_BINARY ) ) {
			$this->mes .= "Binary mode FAILS!<br>\n";
		}//bugfix 'FTP_BINARY'->FTP_BINARY

		$this->mes .= 'PWD:';
		$this->pwd();

		return true;
	}

	protected function parselisting( $list ) {
		//	Parses 1 line like:		"drwxrwx---  2 owner group 4096 Apr 23 14:57 text"
		if ( preg_match( "/^([-ld])([rwxst-]+)\s+(\d+)\s+([^\s]+)\s+([^\s]+)\s+(\d+)\s+(\w{3})\s+(\d+)\s+([\:\d]+)\s+(.+)$/i", $list, $ret ) ) {
			$v   = [
				'type'  => ( '-' == $ret[1] ? 'f' : $ret[1] ),
				'perms' => 0,
				'inode' => $ret[3],
				'owner' => $ret[4],
				'group' => $ret[5],
				'size'  => $ret[6],
				'date'  => $ret[7] . ' ' . $ret[8] . ' ' . $ret[9],
				'name'  => $ret[10]
			];
			$bad = [ '(?)' ];
			if ( in_array( $v['owner'], $bad ) ) {
				$v['owner'] = null;
			}
			if ( in_array( $v['group'], $bad ) ) {
				$v['group'] = null;
			}
			$v['perms'] += 00400 * (int) ( 'r' === $ret[2]{0} );
			$v['perms'] += 00200 * (int) ( 'w' === $ret[2]{1} );
			$v['perms'] += 00100 * (int) in_array( $ret[2]{2}, [ 'x', 's' ] );
			$v['perms'] += 00040 * (int) ( 'r' === $ret[2]{3} );
			$v['perms'] += 00020 * (int) ( 'w' === $ret[2]{4} );
			$v['perms'] += 00010 * (int) in_array( $ret[2]{5}, [ 'x', 's' ] );
			$v['perms'] += 00004 * (int) ( 'r' === $ret[2]{6} );
			$v['perms'] += 00002 * (int) ( 'w' === $ret[2]{7} );
			$v['perms'] += 00001 * (int) in_array( $ret[2]{8}, [ 'x', 't' ] );
			$v['perms'] += 04000 * (int) in_array( $ret[2]{2}, [ 'S', 's' ] );
			$v['perms'] += 02000 * (int) in_array( $ret[2]{5}, [ 'S', 's' ] );
			$v['perms'] += 01000 * (int) in_array( $ret[2]{8}, [ 'T', 't' ] );
		}

		return $v;
	}

	/* moved into Abstract
		function SendMSG($message = "", $crlf=true) {
			if ($this->Verbose) {
				echo $message.($crlf?CRLF:"");
				flush();
			}
			return TRUE;
		}
	*/
	protected function SetType( $mode = FTP_AUTOASCII ) {
		if ( ! in_array( $mode, $this->AuthorizedTransferMode ) ) {
			$this->SendMSG( 'Wrong type' );

			return false;
		}
		$this->_type = $mode;
		$this->SendMSG( 'Transfer type: ' . ( FTP_BINARY == $this->_type ? 'binary' : ( FTP_ASCII == $this->_type ? 'ASCII' : 'auto ASCII' ) ) );

		return true;
	}

	protected function _settype( $mode = FTP_ASCII ) {
		if ( $this->_ready ) {
			if ( FTP_BINARY == $mode ) {
				if ( FTP_BINARY != $this->_curtype ) {
					if ( ! $this->_exec( 'TYPE I', 'SetType' ) ) {
						return false;
					}
					$this->_curtype = FTP_BINARY;
				}
			} elseif ( FTP_ASCII != $this->_curtype ) {
				if ( ! $this->_exec( 'TYPE A', 'SetType' ) ) {
					return false;
				}
				$this->_curtype = FTP_ASCII;
			}
		} else {
			return false;
		}

		return true;
	}

	protected function Passive( $pasv = null ) {
		if ( null === $pasv ) {
			$this->_passive = ! $this->_passive;
		} else {
			$this->_passive = $pasv;
		}
		if ( ! $this->_port_available and ! $this->_passive ) {
			$this->SendMSG( 'Only passive connections available!' );
			$this->_passive = true;

			return false;
		}
		$this->SendMSG( 'Passive mode ' . ( $this->_passive ? 'on' : 'off' ) );

		return true;
	}

	/* moved into Abstract
		function SetServer($host, $port=21, $reconnect=true) {
			if(!is_long($port)) {
				$this->verbose=true;
				$this->SendMSG("Incorrect port syntax");
				return FALSE;
			} else {
				$ip=@gethostbyname($host);
				$dns=@gethostbyaddr($host);
				if(!$ip) $ip=$host;
				if(!$dns) $dns=$host;
				if(ip2long($ip) === -1) {
					$this->SendMSG("Wrong host name/address \"".$host."\"");
					return FALSE;
				}
				$this->_host=$ip;
				$this->_fullhost=$dns;
				$this->_port=$port;
				$this->_dataport=$port-1;
			}
			$this->SendMSG("Host \"".$this->_fullhost."(".$this->_host."):".$this->_port."\"");
			if($reconnect){
				if($this->_connected) {
					$this->SendMSG("Reconnecting");
					if(!$this->quit(FTP_FORCE)) return FALSE;
					if(!$this->connect()) return FALSE;
				}
			}
			return TRUE;
		}
	*/
	protected function SetUmask( $umask = 0022 ) {
		$this->_umask = $umask;
		umask( $this->_umask );
		$this->SendMSG( 'UMASK 0' . decoct( $this->_umask ) );

		return true;
	}

	protected function SetTimeout( $timeout = 30 ) {
		$this->_timeout = $timeout;
		$this->SendMSG( 'Timeout ' . $this->_timeout );
		if ( $this->_connected ) {
			if ( ! $this->_settimeout( $this->_ftp_control_sock ) ) {
				return false;
			}
		}

		return true;
	}

	protected function connect( $server = null ) {
		if ( ! empty( $server ) ) {
			if ( ! $this->SetServer( $server ) ) {
				return false;
			}
		}
		if ( $this->_ready ) {
			return true;
		}
		$this->SendMsg( 'Local OS : ' . $this->OS_FullName[ $this->OS_local ] );
		if ( ! ( $this->_ftp_control_sock = $this->_connect( $this->_host, $this->_port ) ) ) {
			$this->SendMSG( 'Error : Cannot connect to remote host "' . $this->_fullhost . ' :' . $this->_port . '"' );

			return false;
		}
		$this->SendMSG( 'Connected to remote host "' . $this->_fullhost . ':' . $this->_port . '". Waiting for greeting.' );
		do {
			if ( ! $this->_readmsg() ) {
				return false;
			}
			if ( ! $this->_checkCode() ) {
				return false;
			}
			$this->_lastaction = time();
		} while ( $this->_code < 200 );
		$this->_ready = true;
		$syst         = $this->systype();
		if ( ! $syst ) {
			$this->SendMSG( "Can't detect remote OS" );
		} else {
			if ( preg_match( '/win|dos|novell/i', $syst[0] ) ) {
				$this->OS_remote = FTP_OS_Windows;
			} elseif ( preg_match( '/os/i', $syst[0] ) ) {
				$this->OS_remote = FTP_OS_Mac;
			} elseif ( preg_match( '/(li|u)nix/i', $syst[0] ) ) {
				$this->OS_remote = FTP_OS_Unix;
			} else {
				$this->OS_remote = FTP_OS_Mac;
			}
			$this->SendMSG( 'Remote OS: ' . $this->OS_FullName[ $this->OS_remote ] );
		}
		if ( ! $this->features() ) {
			$this->SendMSG( "Can't get features list. All supported - disabled" );
		} else {
			$this->SendMSG( 'Supported features: ' . implode( ', ', array_keys( $this->_features ) ) );
		}

		return true;
	}

	protected function quit( $force = false ) {
		if ( $this->_ready ) {
			if ( ! $this->_exec( 'QUIT' ) and ! $force ) {
				return false;
			}
			if ( ! $this->_checkCode() and ! $force ) {
				return false;
			}
			$this->_ready = false;
			$this->SendMSG( 'Session finished' );
		}
		$this->_quit();

		return true;
	}

	protected function login( $user = null, $pass = null ) {
		if ( null !== $user ) {
			$this->_login = $user;
		} else {
			$this->_login = 'anonymous';
		}
		if ( null !== $pass ) {
			$this->_password = $pass;
		} else {
			$this->_password = 'anon@anon.com';
		}
		if ( ! $this->_exec( 'USER ' . $this->_login, 'login' ) ) {
			return false;
		}
		if ( ! $this->_checkCode() ) {
			return false;
		}
		if ( 230 != $this->_code ) {
			if ( ! $this->_exec( ( ( 331 == $this->_code ) ? 'PASS ' : 'ACCT ' ) . $this->_password, 'login' ) ) {
				return false;
			}
			if ( ! $this->_checkCode() ) {
				return false;
			}
		}
		$this->SendMSG( 'Authentication succeeded' );
		if ( empty( $this->_features ) ) {
			if ( ! $this->features() ) {
				$this->SendMSG( "Can't get features list. All supported - disabled" );
			} else {
				$this->SendMSG( 'Supported features: ' . implode( ', ', array_keys( $this->_features ) ) );
			}
		}

		return true;
	}

	protected function pwd() {
		if ( ! $this->_exec( 'PWD', 'pwd' ) ) {
			return false;
		}
		if ( ! $this->_checkCode() ) {
			return false;
		}

//fix ereg_replace -> preg_replace for php5.3+
		return preg_replace( '/^[0-9]{3} "(.+)" .+' . CRLF . '/', "\\1", $this->_message );
	}

	protected function cdup() {
		if ( ! $this->_exec( 'CDUP', 'cdup' ) ) {
			return false;
		}
		if ( ! $this->_checkCode() ) {
			return false;
		}

		return true;
	}

	protected function chdir( $pathname ) {
		if ( ! $this->_exec( 'CWD ' . $pathname, 'chdir' ) ) {
			return false;
		}
		if ( ! $this->_checkCode() ) {
			return false;
		}

		return true;
	}

	protected function rmdir( $pathname ) {
		if ( ! $this->_exec( 'RMD ' . $pathname, 'rmdir' ) ) {
			return false;
		}
		if ( ! $this->_checkCode() ) {
			return false;
		}

		return true;
	}

	protected function mkdir( $pathname ) {
		if ( ! $this->_exec( 'MKD ' . $pathname, 'mkdir' ) ) {
			return false;
		}
		if ( ! $this->_checkCode() ) {
			return false;
		}

		return true;
	}

	protected function rename( $from, $to ) {
		if ( ! $this->_exec( 'RNFR ' . $from, 'rename' ) ) {
			return false;
		}
		if ( ! $this->_checkCode() ) {
			return false;
		}
		if ( 350 == $this->_code ) {
			if ( ! $this->_exec( 'RNTO ' . $to, 'rename' ) ) {
				return false;
			}
			if ( ! $this->_checkCode() ) {
				return false;
			}
		} else {
			return false;
		}

		return true;
	}

	protected function filesize( $pathname ) {
		if ( ! isset( $this->_features['SIZE'] ) ) {
			$this->PushError( 'filesize', 'not supported by server' );

			return false;
		}
		if ( ! $this->_exec( 'SIZE ' . $pathname, 'filesize' ) ) {
			return false;
		}
		if ( ! $this->_checkCode() ) {
			return false;
		}

//fix ereg_replace -> preg_replace for php5.3+
		return preg_replace( '/^[0-9]{3} ([0-9]+)' . CRLF . '/', "\\1", $this->_message );
	}

	protected function abort() {
		if ( ! $this->_exec( 'ABOR', 'abort' ) ) {
			return false;
		}
		if ( ! $this->_checkCode() ) {
			if ( 426 != $this->_code ) {
				return false;
			}
			if ( ! $this->_readmsg( 'abort' ) ) {
				return false;
			}
			if ( ! $this->_checkCode() ) {
				return false;
			}
		}

		return true;
	}

	protected function mdtm( $pathname ) {
		if ( ! isset( $this->_features['MDTM'] ) ) {
			$this->PushError( 'mdtm', 'not supported by server' );

			return false;
		}
		if ( ! $this->_exec( 'MDTM ' . $pathname, 'mdtm' ) ) {
			return false;
		}
		if ( ! $this->_checkCode() ) {
			return false;
		}
//fix ereg_replace -> preg_replace for php5.3+
		$mdtm      = preg_replace( '/^[0-9]{3} ([0-9]+)' . CRLF . '/', "\\1", $this->_message );
		$date      = sscanf( $mdtm, '%4d%2d%2d%2d%2d%2d' );
		$timestamp = mktime( $date[3], $date[4], $date[5], $date[1], $date[2], $date[0] );

		return $timestamp;
	}

	protected function systype() {
		if ( ! $this->_exec( 'SYST', 'systype' ) ) {
			return false;
		}
		if ( ! $this->_checkCode() ) {
			return false;
		}
		$DATA = explode( ' ', $this->_message );

		return [ $DATA[1], $DATA[3] ];
	}

	protected function delete( $pathname ) {
		if ( ! $this->_exec( 'DELE ' . $pathname, 'delete' ) ) {
			return false;
		}
		if ( ! $this->_checkCode() ) {
			return false;
		}

		return true;
	}

	protected function site( $command, $fnction = 'site' ) {
		if ( ! $this->_exec( 'SITE ' . $command, $fnction ) ) {
			return false;
		}
		if ( ! $this->_checkCode() ) {
			return false;
		}

		return true;
	}

	protected function chmod( $pathname, $mode ) {
		if ( ! $this->site( 'CHMOD ' . decoct( $mode ) . ' ' . $pathname, 'chmod' ) ) {
			return false;
		}

		return true;
	}

	protected function restore( $from ) {
		if ( ! isset( $this->_features['REST'] ) ) {
			$this->PushError( 'restore', 'not supported by server' );

			return false;
		}
		if ( FTP_BINARY != $this->_curtype ) {
			$this->PushError( 'restore', "can't restore in ASCII mode" );

			return false;
		}
		if ( ! $this->_exec( 'REST ' . $from, 'resore' ) ) {
			return false;
		}
		if ( ! $this->_checkCode() ) {
			return false;
		}

		return true;
	}

	protected function features() {
		if ( ! $this->_exec( 'FEAT', 'features' ) ) {
			return false;
		}
		if ( ! $this->_checkCode() ) {
			return false;
		}
		$f = array_slice( preg_split( '/[' . CRLF . ']+/', $this->_message, - 1, PREG_SPLIT_NO_EMPTY ), 1, - 1 );
		array_walk( $f, create_function( '&$a', '$a=preg_replace("/[0-9]{3}[\s-]+/", "", trim($a));' ) );
		$this->_features = [];
		foreach ( $f as $k => $v ) {
			$v                                    = explode( ' ', trim( $v ) );
			$this->_features[ array_shift( $v ) ] = $v;
		}

		return true;
	}

	protected function rawlist( $pathname = '', $arg = '' ) {
		return $this->_list( ( $arg ? ' ' . $arg : '' ) . ( $pathname ? ' ' . $pathname : '' ), 'LIST', 'rawlist' );
	}

	protected function nlist( $pathname = '', $arg = '' ) {
		return $this->_list( ( $arg ? ' ' . $arg : '' ) . ( $pathname ? ' ' . $pathname : '' ), 'NLST', 'nlist' );
	}

	protected function is_exists( $pathname ) {
		return $this->file_exists( $pathname );
	}

	protected function file_exists( $pathname ) {
		$exists = true;
		if ( ! $this->_exec( 'RNFR ' . $pathname, 'rename' ) ) {
			$exists = false;
		} else {
			if ( ! $this->_checkCode() ) {
				$exists = false;
			}
			$this->abort();
		}
		if ( $exists ) {
			$this->SendMSG( 'Remote file ' . $pathname . ' exists' );
		} else {
			$this->SendMSG( 'Remote file ' . $pathname . ' does not exist' );
		}

		return $exists;
	}

	protected function get( $remotefile, $localfile = null, $rest = 0 ) {
		if ( null === $localfile ) {
			$localfile = $remotefile;
		}
		if ( @file_exists( $localfile ) ) {
			$this->SendMSG( 'Warning : local file will be overwritten' );
		}
		$fp = @fopen( $localfile, 'w' );
		if ( ! $fp ) {
			$this->PushError( 'get', "can't open local file", 'Cannot create "' . $localfile . '"' );

			return false;
		}
		if ( $this->_can_restore and 0 != $rest ) {
			fseek( $fp, $rest );
		}
		$pi = pathinfo( $remotefile );
//fix set '' to ["extension"] , when $pi["extension"] is nothing in pathinfo
		$pi['extension'] = ! isset( $pi['extension'] ) ? '' : $pi['extension'];
		if ( FTP_ASCII == $this->_type or ( FTP_AUTOASCII == $this->_type and in_array( strtoupper( $pi['extension'] ), $this->AutoAsciiExt ) ) ) {
			$mode = FTP_ASCII;
		} else {
			$mode = FTP_BINARY;
		}
		if ( ! $this->_data_prepare( $mode ) ) {
			fclose( $fp );

			return false;
		}
		if ( $this->_can_restore and 0 != $rest ) {
			$this->restore( $rest );
		}
		if ( ! $this->_exec( 'RETR ' . $remotefile, 'get' ) ) {
			$this->_data_close();
			fclose( $fp );

			return false;
		}
		if ( ! $this->_checkCode() ) {
			$this->_data_close();
			fclose( $fp );

			return false;
		}
		$out = $this->_data_read( $mode, $fp );
		fclose( $fp );
		$this->_data_close();
		if ( ! $this->_readmsg() ) {
			return false;
		}
		if ( ! $this->_checkCode() ) {
			return false;
		}

		return $out;
	}

	protected function put( $localfile, $remotefile = null, $rest = 0 ) {
		if ( null === $remotefile ) {
			$remotefile = $localfile;
		}
		if ( ! @file_exists( $localfile ) ) {
			$this->PushError( 'put', "can't open local file", 'No such file or directory "' . $localfile . '"' );

			return false;
		}
		$fp = @fopen( $localfile, 'r' );
		if ( ! $fp ) {
			$this->PushError( 'put', "can't open local file", 'Cannot read file "' . $localfile . '"' );

			return false;
		}
		if ( $this->_can_restore and 0 != $rest ) {
			fseek( $fp, $rest );
		}
		$pi = pathinfo( $localfile );
//fix set '' to ["extension"] , when $pi["extension"] is nothing in pathinfo
		$pi['extension'] = ! isset( $pi['extension'] ) ? '' : $pi['extension'];
		if ( FTP_ASCII == $this->_type or ( FTP_AUTOASCII == $this->_type and in_array( strtoupper( $pi['extension'] ), $this->AutoAsciiExt ) ) ) {
			$mode = FTP_ASCII;
		} else {
			$mode = FTP_BINARY;
		}
		if ( ! $this->_data_prepare( $mode ) ) {
			fclose( $fp );

			return false;
		}
		if ( $this->_can_restore and 0 != $rest ) {
			$this->restore( $rest );
		}
		if ( ! $this->_exec( 'STOR ' . $remotefile, 'put' ) ) {
			$this->_data_close();
			fclose( $fp );

			return false;
		}
		if ( ! $this->_checkCode() ) {
			$this->_data_close();
			fclose( $fp );

			return false;
		}
		$ret = $this->_data_write( $mode, $fp );
		fclose( $fp );
		$this->_data_close();
		if ( ! $this->_readmsg() ) {
			return false;
		}
		if ( ! $this->_checkCode() ) {
			return false;
		}

		return $ret;
	}

	protected function mput( $local = '.', $remote = null, $continious = false ) {
		$local = realpath( $local );
		if ( ! @file_exists( $local ) ) {
			$this->PushError( 'mput', "can't open local folder", 'Cannot stat folder "' . $local . '"' );

			return false;
		}
		if ( ! is_dir( $local ) ) {
			return $this->put( $local, $remote );
		}
		if ( empty( $remote ) ) {
			$remote = '.';
		} elseif ( ! $this->file_exists( $remote ) and ! $this->mkdir( $remote ) ) {
			return false;
		}
		if ( $handle = opendir( $local ) ) {
			$list = [];
			while ( false !== ( $file = readdir( $handle ) ) ) {
				if ( '.' !== $file && '..' !== $file ) {
					$list[] = $file;
				}
			}
			closedir( $handle );
		} else {
			$this->PushError( 'mput', "can't open local folder", 'Cannot read folder "' . $local . '"' );

			return false;
		}
		if ( empty( $list ) ) {
			return true;
		}
		$ret = true;
		foreach ( $list as $el ) {
			if ( is_dir( $local . '/' . $el ) ) {
				$t = $this->mput( $local . '/' . $el, $remote . '/' . $el );
			} else {
				$t = $this->put( $local . '/' . $el, $remote . '/' . $el );
			}
			if ( ! $t ) {
				$ret = false;
				if ( ! $continious ) {
					break;
				}
			}
		}

		return $ret;
	}

	protected function mget( $remote, $local = '.', $continious = false ) {
		$list = $this->rawlist( $remote, '-lA' );
		if ( false === $list ) {
			$this->PushError( 'mget', "can't read remote folder list", "Can't read remote folder \"" . $remote . '" contents' );

			return false;
		}
		if ( empty( $list ) ) {
			return true;
		}
		if ( ! @file_exists( $local ) ) {
			if ( ! @mkdir( $local ) ) {
				$this->PushError( 'mget', "can't create local folder", 'Cannot create folder "' . $local . '"' );

				return false;
			}
		}
		foreach ( $list as $k => $v ) {
			$list[ $k ] = $this->parselisting( $v );
			if ( '.' === $list[ $k ]['name'] or '..' === $list[ $k ]['name'] ) {
				unset( $list[ $k ] );
			}
		}
		$ret = true;
		foreach ( $list as $el ) {
			if ( 'd' === $el['type'] ) {
				if ( ! $this->mget( $remote . '/' . $el['name'], $local . '/' . $el['name'], $continious ) ) {
					$this->PushError( 'mget', "can't copy folder", "Can't copy remote folder \"" . $remote . '/' . $el['name'] . '" to local "' . $local . '/' . $el['name'] . '"' );
					$ret = false;
					if ( ! $continious ) {
						break;
					}
				}
			} else {
				if ( ! $this->get( $remote . '/' . $el['name'], $local . '/' . $el['name'] ) ) {
					$this->PushError( 'mget', "can't copy file", "Can't copy remote file \"" . $remote . '/' . $el['name'] . '" to local "' . $local . '/' . $el['name'] . '"' );
					$ret = false;
					if ( ! $continious ) {
						break;
					}
				}
			}
			@chmod( $local . '/' . $el['name'], $el['perms'] );
			$t = strtotime( $el['date'] );
			if ( - 1 !== $t and false !== $t ) {
				@touch( $local . '/' . $el['name'], $t );
			}
		}

		return $ret;
	}

	protected function mdel( $remote, $continious = false ) {
		$list = $this->rawlist( $remote, '-la' );
		if ( false === $list ) {
			$this->PushError( 'mdel', "can't read remote folder list", "Can't read remote folder \"" . $remote . '" contents' );

			return false;
		}

		foreach ( $list as $k => $v ) {
			$list[ $k ] = $this->parselisting( $v );
			if ( '.' === $list[ $k ]['name'] or '..' === $list[ $k ]['name'] ) {
				unset( $list[ $k ] );
			}
		}
		$ret = true;

		foreach ( $list as $el ) {
			if ( 'd' === $el['type'] ) {
				if ( ! $this->mdel( $remote . '/' . $el['name'], $continious ) ) {
					$ret = false;
					if ( ! $continious ) {
						break;
					}
				}
			} else {
				if ( ! $this->delete( $remote . '/' . $el['name'] ) ) {
					$this->PushError( 'mdel', "can't delete file", "Can't delete remote file \"" . $remote . '/' . $el['name'] . '"' );
					$ret = false;
					if ( ! $continious ) {
						break;
					}
				}
			}
		}

		if ( ! $this->rmdir( $remote ) ) {
			$this->PushError( 'mdel', "can't delete folder", "Can't delete remote folder \"" . $remote . '/' . $el['name'] . '"' );
			$ret = false;
		}

		return $ret;
	}

	protected function mmkdir( $dir, $mode = 0777 ) {
		if ( empty( $dir ) ) {
			return false;
		}
		if ( $this->is_exists( $dir ) or '/' === $dir ) {
			return true;
		}
		if ( ! $this->mmkdir( dirname( $dir ), $mode ) ) {
			return false;
		}
		$r = $this->mkdir( $dir, $mode );
		$this->chmod( $dir, $mode );

		return $r;
	}

	protected function glob( $pattern, $handle = null ) {
		$path = $output = null;
		if ( PHP_OS === 'WIN32' ) {
			$slash = '\\';
		} else {
			$slash = '/';
		}
		$lastpos = strrpos( $pattern, $slash );
		if ( ! ( false === $lastpos ) ) {
			$path    = substr( $pattern, 0, - $lastpos - 1 );
			$pattern = substr( $pattern, $lastpos );
		} else {
			$path = getcwd();
		}
		if ( is_array( $handle ) and ! empty( $handle ) ) {
			while ( $dir = each( $handle ) ) {
				if ( $this->glob_pattern_match( $pattern, $dir ) ) {
					$output[] = $dir;
				}
			}
		} else {
			$handle = @opendir( $path );
			if ( false === $handle ) {
				return false;
			}
			while ( $dir = readdir( $handle ) ) {
				if ( $this->glob_pattern_match( $pattern, $dir ) ) {
					$output[] = $dir;
				}
			}
			closedir( $handle );
		}
		if ( is_array( $output ) ) {
			return $output;
		}

		return false;
	}

	protected function glob_pattern_match( $pattern, $string ) {
		$out    = null;
		$chunks = explode( ';', $pattern );
		foreach ( $chunks as $pattern ) {
			$escape = [ '$', '^', '.', '{', '}', '(', ')', '[', ']', '|' ];
			while ( false !== strpos( $pattern, '**' ) ) {
				$pattern = str_replace( '**', '*', $pattern );
			}
			foreach ( $escape as $probe ) {
				$pattern = str_replace( $probe, "\\$probe", $pattern );
			}
			$pattern = str_replace( '?*', '*',
				str_replace( '*?', '*',
					str_replace( '*',
						'.*',
						str_replace( '?', '.{1,1}', $pattern ) ) ) );
			$out[]   = $pattern;
		}
		if ( 1 == count( $out ) ) {
			return ( $this->glob_regexp( "^$out[0]$", $string ) );
		} else {
			foreach ( $out as $tester ) {
				if ( $this->my_regexp( "^$tester$", $string ) ) {
					return true;
				}
			}
		}

		return false;
	}

	protected function glob_regexp( $pattern, $probe ) {
		$sensitive = ( PHP_OS !== 'WIN32' );

//fix ereg,eregi -> preg_match for php5.3+
		return ( $sensitive ?
			preg_match( '/' . $pattern . '/', $probe ) :
			preg_match( '/' . $pattern . '/i', $probe )
		);
	}
// <!-- --------------------------------------------------------------------------------------- -->
// <!--       Private functions                                                                 -->
// <!-- --------------------------------------------------------------------------------------- -->
	protected function _checkCode() {
		return ( $this->_code < 400 and $this->_code > 0 );
	}

	protected function _list( $arg = '', $cmd = 'LIST', $fnction = '_list' ) {
		if ( ! $this->_data_prepare() ) {
			return false;
		}
		if ( ! $this->_exec( $cmd . $arg, $fnction ) ) {
			$this->_data_close();

			return false;
		}
		if ( ! $this->_checkCode() ) {
			$this->_data_close();

			return false;
		}
		$out = '';
		if ( $this->_code < 200 ) {
			$out = $this->_data_read();
			$this->_data_close();
			if ( ! $this->_readmsg() ) {
				return false;
			}
			if ( ! $this->_checkCode() ) {
				return false;
			}
			if ( false === $out ) {
				return false;
			}
			$out = preg_split( '/[' . CRLF . ']+/', $out, - 1, PREG_SPLIT_NO_EMPTY );
//			$this->SendMSG(implode($this->_eol_code[$this->OS_local], $out));
		}

		return $out;
	}

// <!-- --------------------------------------------------------------------------------------- -->
// <!-- Partie : gestion des erreurs                                                            -->
// <!-- --------------------------------------------------------------------------------------- -->
// G�n�re une erreur pour traitement externe � la classe
	protected function PushError( $fctname, $msg, $desc = false ) {
		$error            = [];
		$error['time']    = time();
		$error['fctname'] = $fctname;
		$error['msg']     = $msg;
		$error['desc']    = $desc;
		if ( $desc ) {
			$tmp = ' (' . $desc . ')';
		} else {
			$tmp = '';
		}
		$this->SendMSG( $fctname . ': ' . $msg . $tmp );

		return ( array_push( $this->_error_array, $error ) );
	}

// R�cup�re une erreur externe
	protected function PopError() {
		if ( count( $this->_error_array ) ) {
			return ( array_pop( $this->_error_array ) );
		} else {
			return ( false );
		}
	}
}

$mod_sockets = false;
if ( ! extension_loaded( 'sockets' ) ) {
	if ( function_exists( 'dl' ) ) {
		$prefix = ( PHP_SHLIB_SUFFIX === 'dll' ) ? 'php_' : '';
		if ( @dl( $prefix . 'sockets.' . PHP_SHLIB_SUFFIX ) ) {
			$mod_sockets = true;
		}
	}
}
require_once 'Custom_' . ( $mod_sockets ? 'sockets' : 'pure' ) . '.class.php';
