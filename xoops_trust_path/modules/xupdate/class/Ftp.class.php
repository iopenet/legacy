<?php
/**
 * X-Update package management for XCL
 *
 * @package XCL
 * @subpackage Xupdate
 * @version 2.3
 * @author Naoki Sawada, Naoki Okino, Gigamaster (XCL 2.3)
 * @copyright Copyright 2005-2022 XOOPS Cube Project
 * @license https://github.com/xoopscube/xcl/blob/master/GPL_V2.txt
 */

/* class Xupdate_Ftp  ## Base Class ##
*/
if ( ! defined( 'XOOPS_ROOT_PATH' ) ) {
	exit;
}

if ( ! defined( '_XUPDATE_FTP_CUSTOM' ) ) {
	define( '_XUPDATE_FTP_CUSTOM', '0' );
	define( '_XUPDATE_FTP_PHP_MODULE', '1' );
	define( '_XUPDATE_FTP_CUSTOM_SFTP', '2' );
	define( '_XUPDATE_FTP_CUSTOM_SSH2', '3' );
	define( '_XUPDATE_FTP_DIRECT', '4' );
}

// module config
$mod_config = XCube_Root::getSingleton()->mContext->mModuleConfig;
//	adump($this->mod_config);

// FTP class
switch ( $mod_config['ftp_method'] ) {
	case _XUPDATE_FTP_CUSTOM :
		require_once __DIR__ . '/ftp/Custom.class.php';
		break;
	case _XUPDATE_FTP_PHP_MODULE :
		require_once __DIR__ . '/ftp/Phpfunc.class.php';
		break;
	case _XUPDATE_FTP_CUSTOM_SFTP :
		// To Do
		if ( ! defined( 'PATH_SEPARATOR' ) ) {
			if ( 'WIN' !== strtoupper( substr( PHP_OS, 0, 3 ) ) ) {
				define( 'PATH_SEPARATOR', ':' );
			} else {
				define( 'PATH_SEPARATOR', ';' );
			}
		}
		set_include_path( get_include_path() . PATH_SEPARATOR . __DIR__ . '/ftp/phpseclib' );
		require_once __DIR__ . '/ftp/Sftp.class.php';
		break;
	case _XUPDATE_FTP_CUSTOM_SSH2 :
		// To Do
		if ( ! defined( 'PATH_SEPARATOR' ) ) {
			if ( 'WIN' !== strtoupper( substr( PHP_OS, 0, 3 ) ) ) {
				define( 'PATH_SEPARATOR', ':' );
			} else {
				define( 'PATH_SEPARATOR', ';' );
			}
		}
		set_include_path( get_include_path() . PATH_SEPARATOR . __DIR__ . '/ftp/phpseclib' );
		require_once __DIR__ . '/ftp/Ssh2.class.php';
		break;
	case _XUPDATE_FTP_DIRECT :
		require_once __DIR__ . '/ftp/Direct.class.php';
		define( '_XUPDATE_FTP_ROOT', '' );
		break;
	default:
} // end switch


/* FTP class
*/

class Xupdate_Ftp extends Xupdate_Ftp_ {

	private $loginCheckFile;
	private $phpPerm;
	private $uploaded_files = [];
	private $rootChangeFlg = false;
	public $isSafeMode;

	/* Constructor */
	public function __construct( $XupdateObj, $port_mode = false, $verb = false, $le = false ) {
		parent::__construct( $XupdateObj );

		$tempDir = XOOPS_TRUST_PATH . '/' . trim( $this->mod_config['temp_path'], '/' );

		$this->isSafeMode = ( '1' == ini_get( 'safe_mode' ) || ! Xupdate_Utils::checkMakeDirectory( $tempDir ) );

		$this->loginCheckFile = $tempDir . '/' . rawurlencode( substr( XOOPS_URL, 7 ) ) . '_logincheck.ini.php';
		if ( ! empty( $this->mod_config['php_perm'] ) ) {
			$this->phpPerm = intval( $this->mod_config['php_perm'], 8 );
		}

		// for upload retry mode
		if ( isset( $_POST['upload_retry'] ) && is_file( _MD_XUPDATE_SYS_RETRYSER_FILE ) ) {
			if ( $retry_cache = @unserialize( file_get_contents( _MD_XUPDATE_SYS_RETRYSER_FILE ) ) ) {
				$this->uploaded_files           = $retry_cache['uploaded_files'];
				$GLOBALS['xupdate_retry_cache'] = $retry_cache;
			}
		}
		if ( ! isset( $GLOBALS['xupdate_retry_cache'] ) ) {
			$GLOBALS['xupdate_retry_cache'] = [];
		}
		$GLOBALS['xupdate_retry_cache']['uploaded_files'] = [];
	}

// <!-- --------------------------------------------------------------------------------------- -->
// <!--	   public functions																  -->
// <!-- --------------------------------------------------------------------------------------- -->

	public function getMes() {
		if ( $this->mod_config['Show_debug'] ) {
			return $this->mes;
		}
	}

	public function appendMes( $message ) {
		$this->mes .= $message;
	}


	public function app_login( $server = null ) {
		if ( null === $server ) {
			$server = ( empty( $this->mod_config['FTP_server'] ) ) ? '127.0.0.1' : $this->mod_config['FTP_server'];
		}
		if ( ! $ret = parent::app_login( $server ) ) {
			@ unlink( $this->loginCheckFile );
		}

		return $ret;
	}

    /**
     * FTP content
     * @param $sourcePath
     * @param $targetPath
     * @return array|bool
     */
    public function uploadNakami($sourcePath, $targetPath ) {
		$this->mes .= ' start FTP put (normal mode) form `' . htmlspecialchars( substr( $sourcePath, strlen( $this->exploredDirPath ) + 1 ), ENT_QUOTES, _CHARSET ) . '` to `' . htmlspecialchars( $targetPath, ENT_QUOTES, _CHARSET ) . "` ..<br>\n";
		$result    = $this->_ftpPutNakami( $sourcePath, $targetPath );

		return $result;
	}

	//for module rename uploading
	public function uploadNakami_To_module( $sourcePath, $targetPath, $trust_dirname, $dirname ) {
		$this->mes .= ' start FTP put (replicate module mode) ' . htmlspecialchars( $targetPath . '->' . $dirname, ENT_QUOTES, _CHARSET ) . " ..<br>\n";
		$result    = $this->_ftpPutNakami( $sourcePath, $targetPath, $trust_dirname, $dirname );

		return $result;
	}

	//for other than module uploading
	public function uploadNakami_OtherThan_module( $sourcePath, $targetPath, $trust_dirname ) {
		$this->mes .= ' start FTP put (replicate misc mode) ' . htmlspecialchars( $targetPath, ENT_QUOTES, _CHARSET ) . " ..<br>\n";
		$result    = $this->_ftpPutNakami( $sourcePath, $targetPath, $trust_dirname );

		return $result;
	}

	public function app_logout() {
		$this->quit();

		return true;
	}

	public function chmod( $pathname, $mode ) {
		return parent::chmod( $pathname, $mode );
	}

	/**
	 * Set item_options
	 *
	 * @param array $options
	 *
	 * @return void
	 */
	public function set_item_options( $options ) {
		$this->item_options = $options;
		$this->set_no_overwrite( [ $options['no_overwrite'], $options['no_update'] ] );
	}

	/**
	 *  set_no_overwrite
	 *
	 * @param array $no_overwrite
	 *
	 * @return void
	 */
	private function set_no_overwrite( $no_overwrite ) {
		$this->no_overwrite = $no_overwrite;
	}

	/**
	 * Make dirctory by server path
	 *
	 * @param string $dir server path
	 *
	 * @return void <void, boolean>
	 */
	public function localMkdir( $dir ) {
		return $this->ftp_mkdir( $dir );
	}

	/**
	 * Remove directory by server path
	 *
	 * @param string $dir server path
	 *
	 * @return bool
	 */
	public function localRmdir( $dir ) {
		return parent::rmdir( $this->getLocalPath( $dir ) );
	}

	/**
	 * put by server path
	 *
	 * @param string $src
	 * @param string $file server path
	 *
	 * @return bool
	 */
	public function localPut( $src, $file ) {
		return $this->put( $src, $this->getLocalPath( $file ) );
	}

	/**
	 * Rename by server path
	 *
	 * @param string $from server path
	 * @param string $to server path
	 *
	 * @return bool
	 */
	public function localRename( $from, $to ) {
		return $this->rename( $this->getLocalPath( $from ), $this->getLocalPath( $to ) );
	}

	/**
	 * chmod by server path
	 *
	 * @param string $item server path
	 * @param int $mode
	 *
	 * @return Ambigous <boolean, number, Mixed, unknown, string>
	 */
	public function localChmod( $item, $mode ) {
		return $this->chmod( $this->getLocalPath( $item ), $mode );
	}

	/**
	 * delete file by server path
	 *
	 * @param string $file server path
	 *
	 * @return bool
	 */
	public function localDelete( $file ) {
		return parent::delete( $this->getLocalPath( $file ) );
	}

	/**
	 * remove directory recursive by server path
	 *
	 * @param string $dir server path
	 *
	 * @return bool
	 */
	public function localRmdirRecursive( $dir ) {
		$localDir = $this->getLocalPath( $dir );
		if ( $list = parent::nlist( $localDir ) ) {
			$ftproot = $this->seekFTPRoot();
			foreach ( $list as $path ) {
				$name = basename( $path );
				if ( '.' !== $name && '..' !== $name ) {
					$serverPath = $ftproot . $path;
					if ( is_dir( $serverPath ) ) {
						$this->localRmdirRecursive( $serverPath );
					} else {
						$this->localDelete( $serverPath );
					}
				}
			}
		}

		return parent::rmdir( $localDir );
	}

	/**
	 * @return bool
	 */
	public function checkLogin() {
		$checkKey = md5( serialize( $this->mod_config ) );
		if ( ! ( $ret = @ unserialize( @ file_get_contents( $this->loginCheckFile ) ) ) || ! is_array( $ret ) || ! isset( $ret[ $checkKey ] ) ) {
			$ret = [];
			if ( $this->app_login() ) {
				$this->app_logout();
				$ret[ $checkKey ] = true;
			} else {
				$ret[ $checkKey ] = false;
			}
			file_put_contents( $this->loginCheckFile, serialize( $ret ) );
		}

		return $ret[ $checkKey ];
	}

	/**
	 * @return bool
	 */
	public function isConnected() {
		return $this->_connected;
	}

	/**
	 * isRootDirChange
	 *
	 * @return bool
	 */
	public function isRootDirChange() {
		return $this->rootChangeFlg;
	}

// <!-- --------------------------------------------------------------------------------------- -->
// <!--	   protected functions																  -->
// <!-- --------------------------------------------------------------------------------------- -->

	/**
	 * ftp rootの絶対パスを返す ex /home/ryuji/public_htmlにxoopsがあり、ftp rootが /home/ryuji/ だったら 戻り値は /home/ryuji
	 *　さらに $xoops_root_pathで指定されたディレクトリへ移動する
	 *  //
	 * @return void @author ryuji
	 * DIRECTORY_SEPARETERを使わないで'/'にしている。WinFileZillaでセパレータに\を使うとftp_chdirできないため
	 */
	protected function seekFTPRoot() {
		if ( defined( '_XUPDATE_FTP_ROOT' ) ) {
			return _XUPDATE_FTP_ROOT;
		}

		$xoops_root_path = $this->XupdateObj->xoops_root_path;
		static $ftp_root = null;

		if ( null !== $ftp_root ) {
			return $ftp_root;
		}

		$xoops_root_path = str_replace( "\\", '/', $xoops_root_path );
		$path            = explode( '/', $xoops_root_path );

		$current_path = '';
		for ( $i = count( $path ) - 1; $i >= 0; $i -- ) {
			$current_path = '/' . $path[ $i ] . $current_path;
			if ( $this->chdir( $current_path ) ) {
				$_ftp_root = substr( $xoops_root_path, 0, strrpos( $xoops_root_path, $current_path ) );
				$_start    = strlen( $_ftp_root );
				if ( $this->chdir( substr( XOOPS_TRUST_PATH, $_start ) )/* check trust path */ ) {
					$this->chdir( $current_path );
					$ftp_root = $_ftp_root;

					return $ftp_root;
				}
			}
		}
		if ( $this->chdir( '/' ) && 0 === strpos( XOOPS_TRUST_PATH, XOOPS_ROOT_PATH ) ) {
			// May be XOOPS_ROOT_PATH is FTP root
			$ftp_root = $xoops_root_path;

			return $ftp_root;
		}

		//throw new Exception(t("seekFTP fail"), 1);
		$this->mes .= " seekFTPRoot fail. Can not access to XOOPS_ROOT_PATH or XOOPS_TRUST_PATH. Do checking your FTP setting.<br>\n";//TODO WHY fail?

		return false;
	}

	// remove directories recursively
	protected function removeDirectory( $dir ) {
		if ( $handle = opendir( (string) $dir ) ) {
			while ( false !== ( $item = readdir( $handle ) ) ) {
				if ( '.' !== $item && '..' !== $item ) {
					if ( is_dir( "$dir/$item" ) ) {
						$this->removeDirectory( "$dir/$item" );
					} else {
						unlink( "$dir/$item" );
						//$this->mes .= " removing $dir/$item<br>\n";
					}
				}
			}
			closedir( $handle );
			rmdir( $dir );
		}
	}

	private function _ftpPutNakami( $local_path, $remote_path, $trust_dirname = null, $dirname = null ) {
		$remote_pos = strlen( $local_path ) + 1;
		//$this->mes .= $remote_pos. "<br>\n";
		$result = $this->_ftpPutSub( $local_path, $remote_path, $remote_pos, $trust_dirname, $dirname );

		return $result;
	}

	private function _ftpPutSub( $local_path, $remote_path, $remote_pos, $trust_dirname = null, $dirname = null ) {
		$ftp_root = $this->seekFTPRoot();
		if ( false === $ftp_root ) {
			return false;
		}
		$mode = ( $trust_dirname && $dirname ) ? 'repModule' : ( $trust_dirname ? 'repMisc' : 'normal' );
		if ( ! isset( $GLOBALS['xupdate_retry_cache']['file_list'] ) ) {
			$GLOBALS['xupdate_retry_cache']['file_list'] = [];
			$GLOBALS['xupdate_retry_cache']['dir_cnt']   = [];
		}
		if ( ! isset( $GLOBALS['xupdate_retry_cache']['file_list'][ $local_path ] ) ) {
			$file_list                                                  = $this->_getFileList( $local_path );
			$GLOBALS['xupdate_retry_cache']['file_list'][ $local_path ] = $file_list;
			$GLOBALS['xupdate_retry_cache']['dir_cnt'][ $local_path ]   = [];
		} else {
			$file_list = $GLOBALS['xupdate_retry_cache']['file_list'][ $local_path ];
		}
		if ( ! isset( $GLOBALS['xupdate_retry_cache']['dir_cnt'][ $local_path ][ $mode ] ) ) {
			$dir_cnt = 0;
			if ( isset( $file_list['dir'] ) && is_array( $file_list['dir'] ) ) {
				$dir = $file_list['dir'];
				krsort( $dir );
				$rootReg = '#^' . preg_quote( XOOPS_ROOT_PATH, '#' ) . '/[^/]+$#';
				foreach ( $dir as $directory ) {
					if ( 'repMisc' === $mode ) {
						if ( strstr( $directory, '/modules/' . $trust_dirname ) ) {
							continue;
						}
					} elseif ( 'repModule' === $mode ) {
						$directory = str_replace( '/modules/' . $trust_dirname, '/modules/' . $dirname, $directory );
					}
					$remote_directory = $remote_path . substr( $directory, $remote_pos );
					if ( ! is_dir( $remote_directory ) && ! $this->_dont_overwrite( $remote_directory, true ) ) {
						if ( $this->ftp_mkdir( $remote_directory ) ) {
							//checking XOOPS_ROOT_PATH root dir
							if ( ! $this->rootChangeFlg && preg_match( $rootReg, $remote_directory ) ) {
								$this->rootChangeFlg = true;
								$this->appendMes( 'mkdir into XOOPS_ROOT_PATH (' . $remote_directory . ')<br>' );
							}
						}
					}
					$dir_cnt ++;
				}
			}
			$GLOBALS['xupdate_retry_cache']['dir_cnt'][ $local_path ][ $mode ] = $dir_cnt;
		} else {
			$dir_cnt = $GLOBALS['xupdate_retry_cache']['dir_cnt'][ $local_path ][ $mode ];
		}

		// file nothing
		if ( empty( $file_list['file'] ) ) {
			return true;
		}

		/// put files
		$res            = [ 'ok' => 0, 'ng' => [], 'un_overwrite' => 0, 'same_file' => 0 ];
		$uploaded_files =& $GLOBALS['xupdate_retry_cache']['uploaded_files'];
		$_cnt           = 0;
		foreach ( $file_list['file'] as $l_file ) {
			Xupdate_Utils::check_http_timeout();
			// check done file on upload retry mode
			if ( isset( $this->uploaded_files[ $l_file ] ) ) {
				$uploaded_files[ $l_file ] = $this->uploaded_files[ $l_file ];
				if ( true === $this->uploaded_files[ $l_file ] ) {
					$res['ok'] ++;
				} elseif ( $this->uploaded_files[ $l_file ] ) {
					$res['ng'][] = $this->uploaded_files[ $l_file ];
				}
				continue;
			}

			if ( 'repMisc' === $mode ) {
				if ( strstr( $l_file, '/modules/' . $trust_dirname . '/' ) ) {
					$uploaded_files[ $l_file ] = false; // for update retry mode
					continue;
				}
				$r_file = $remote_path . substr( $l_file, $remote_pos ); // +1 is remove first flash
			} elseif ( 'repModule' === $mode ) {
				//rename dirname
				$r_file = $remote_path . substr( str_replace( '/modules/' . $trust_dirname . '/', '/modules/' . $dirname . '/', $l_file ), $remote_pos ); // +1 is remove first flash
			} else {
				$r_file = $remote_path . substr( $l_file, $remote_pos ); // +1 is remove first flash
			}
			$ftp_remote_file = substr( $r_file, strlen( $ftp_root ) );
			$dont_overwrite  = $this->_dont_overwrite( $r_file );
			$same            = false;
			if ( false === $dont_overwrite && ! $same = $this->_same_file( $l_file, $r_file ) and ! $this->put( $l_file, $ftp_remote_file ) ) {
				$res['ng'][]               = $ftp_remote_file;
				$uploaded_files[ $l_file ] = $ftp_remote_file;
			} else {
				$res['ok'] ++;
				if ( $dont_overwrite ) {
					$res['un_overwrite'] ++;
				}
				if ( $same ) {
					$res['same_file'] ++;
				}
				$this->setPhpPerm( $ftp_remote_file );
				$uploaded_files[ $l_file ] = true; // for update retry mode
			}
			if ( 0 === ++ $_cnt % 100 ) {
				file_put_contents( _MD_XUPDATE_SYS_RETRYSER_FILE, serialize( $GLOBALS['xupdate_retry_cache'] ) );
			}
		}

		return $res;
	}

	private function _getFileList( $dir, $list = [ 'dir' => [], 'file' => [] ] ) {
		if ( false == is_dir( $dir ) ) {
			return [];
		}

		$dh = opendir( $dir );
		if ( $dh ) {
			while ( false !== ( $file = readdir( $dh ) ) ) {
				if ( '.' === $file || '..' === $file ) {
					continue;
				} elseif ( is_dir( "$dir/$file" ) ) {
					$list          = $this->_getFileList( "$dir/$file", $list );
					$list['dir'][] = "$dir/$file";
				} else {
					$list['file'][] = "$dir/$file";
				}
			}
		}
		closedir( $dh );

		return $list;
	}

	private function _dont_overwrite( $file, $dir_chk = false ) {
		static $only_conf_lang = null;
		static $reg_lang = null;
		static $lang = null;
		static $no_overwrite = null;
		static $no_update = null;

		if ( null === $only_conf_lang ) {
			$only_conf_lang = $this->mod_config['only_conf_lang'];
			list( $no_overwrite, $no_update ) = $this->no_overwrite;
		}

		// language check
		if ( $only_conf_lang ) {
			if ( null === $reg_lang ) {
				$html     = preg_quote( XOOPS_ROOT_PATH, '#' );
				$trust    = preg_quote( XOOPS_TRUST_PATH, '#' );
				$reg_lang = '#^(?:' . $html . '|' . $trust . ')/(?:modules/[^/]+/)?language/([^/]+)(?:/|$)#';
				$root     = XCube_Root::getSingleton();
				$lang     = $root->mContext->getXoopsConfig( 'language' );
				$lang     = ( 'english' === $lang ) ? [ $lang ] : [ $lang, 'english' ];
				if ( isset( $this->item_options['force_languages'] ) && is_array( $this->item_options['force_languages'] ) ) {
					$lang = array_merge( $lang, $this->item_options['force_languages'] );
				}
			}
			if ( preg_match( $reg_lang, $file, $match ) ) {
				if ( ! in_array( $match[1], $lang ) ) {
					return true;
				}
			}
		}

		if ( null === $no_overwrite ) {
			list( $no_overwrite, $no_update ) = $this->no_overwrite;
		}
		if ( $no_update ) {
			foreach ( $no_update as $item ) {
				if ( 0 === strpos( $file, $item ) ) {
					return true;
				}
			}
		}
		if ( ! $dir_chk && $no_overwrite ) {
			foreach ( $no_overwrite as $item ) {
				if ( 0 === strpos( $file, $item ) && file_exists( $file ) ) {
					return true;
				}
			}
		}

		return false;
	}

	/**
	 * compare file by md5 hash
	 *
	 * @param string $source
	 * @param string $target
	 *
	 * @return bool
	 */
	private function _same_file( $source, $target ) {
		return ( is_readable( $target ) && md5_file( $source ) === md5_file( $target ) );
	}

	/**
	 * undocumented function
	 *
	 * @param string $dir ローカルの絶対パス
	 *
	 * @return void
	 * @author ryuji
	 */
	protected function ftp_mkdir( $dir ) {
		return $this->ftpMkdirByFtpPath( $this->getLocalPath( $dir ) );
	}

	/**
	 * ftp root からのパスで$dirは指定する
	 *
	 * @param string $dir
	 *
	 * @return void
	 * @author ryuji
	 */
	protected function ftpMkdirByFtpPath( $dir ) {
		$parent = dirname( $dir );
		if ( $dir === $parent ) {
			return true;
		}

		$ftpRoot = $this->seekFTPRoot();
		if ( false === is_dir( $ftpRoot . $parent ) ) {
			if ( false === $this->ftpMkdirByFtpPath( $parent ) ) {
				return false;
			}
		}

		return $this->mkdir( $dir );
	}

	/**
	 * Set permission of .php
	 *
	 * @param string $file
	 */
	private function setPhpPerm( $file ) {
		if ( $this->phpPerm && '.php' === strtolower( substr( $file, - 4 ) ) && is_file( $file ) ) {
			$this->chmod( $file, $this->phpPerm );
		}
	}

	/**
	 * Get local(on FTP) path
	 *
	 * @param string $path
	 *
	 * @return string
	 */
	private function getLocalPath( $path ) {
		static $FTP_root_len = null;
		if ( null === $FTP_root_len ) {
			$FTP_root_len = strlen( $this->seekFTPRoot() );
		}
		$localPath = substr( $path, $FTP_root_len );

		return $localPath;
	}
}// end class
;
