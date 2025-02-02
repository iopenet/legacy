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

// Xupdate_ftp excutr function
// if(!class_exists('ZipArchive') ){
// 	$mod_zip=false;
// 	if (!extension_loaded('zip')) {
// 		if (function_exists('dl')){
// 			$prefix = (PHP_SHLIB_SUFFIX == 'dll') ? 'php_' : '';
// 			if(@dl($prefix . 'zip.' . PHP_SHLIB_SUFFIX)){
// 				$mod_zip=true;
// 			}
// 		}
// 	}
// 	if(!class_exists('ZipArchive') ){
// 		require_once XUPDATE_TRUST_PATH .'/include/FtpCommonFileArchive.class.php';
// 	}else{
// 		require_once XUPDATE_TRUST_PATH .'/include/FtpCommonZipArchive.class.php';
// 	}
// }else{
// 	require_once XUPDATE_TRUST_PATH .'/include/FtpCommonZipArchive.class.php';
// }
require_once XUPDATE_TRUST_PATH . '/include/FtpCommonFileArchive.class.php';

class Xupdate_FtpThemeFinderInstall extends Xupdate_FtpCommonZipArchive {

	/*parent public
	public $mRoot ;
	public $mModule ;
	public $mAsset ;

	public $Xupdate  ;	// Xupdate instance
	public $Ftp  ;	// FTP instance
	public $Func ;	// Functions instance
	public $mod_config ;
	public $content ;
	public $downloadDirPath;
	public $exploredDirPath;
	public $downloadUrlFormat;

	public $target_key;
	public $target_type;
*/

	public function __construct() {
		parent::__construct();
	}

	/**
	 * execute
	 *
	 * @return    bool
	 **/
	public function execute() {
		$result = true;
		if ( true === $this->Xupdate->params['is_writable']['result'] ) {
			if ( ! $exploredDirPath = $this->checkExploredDirPath( $this->target_key ) ) {
				$this->_set_error_log( _MI_XUPDATE_ERR_MAKE_EXPLOREDDIR . ': ' . $this->target_key );

				return false;
			}
			if ( ! $this->is_xupdate_excutable() ) {
				$this->content .= '<div class="error">' . _MI_XUPDATE_ANOTHER_PROCESS_RUNNING . '</div>';

				return false;
			}

			$downloadUrl         = $this->Func->_getDownloadUrl( $this->target_key, $this->downloadUrlFormat );
			$this->download_file = $this->target_key . ( preg_match( '/\btar\b/i', $downloadUrl ) ? '.tar.gz' : '.zip' );

			$this->content .= _MI_XUPDATE_PROG_FILE_GETTING . '<br>';
			if ( $this->Func->_downloadFile( $this->target_key, $downloadUrl, $this->download_file, $this->downloadedFilePath ) ) {
				$downloadDirPath       = realpath( $this->Xupdate->params['temp_path'] );
				$this->exploredDirPath = $exploredDirPath;
				if ( true == $this->_unzipFile() ) {
					// ToDo port , timeout
					if ( $this->Ftp->isConnected() || true == $this->Ftp->app_login() ) {
						if ( ! $this->uploadFiles() ) {
							$this->_set_error_log( 'Ftp uploadFiles false' );
							$result = false;
						}
					} else {
						$this->_set_error_log( 'Ftp->app_login false' );
						$result = false;
					}
				} else {
					$this->_set_error_log( 'unzipFile false ' );
					$result = false;
				}
			} else {
				$this->_set_error_log( 'downloadFile false' );
				$result = false;
			}

			$this->content .= _MI_XUPDATE_PROG_CLEANING_UP . '<br>';
			$this->_cleanup( $exploredDirPath );

			if ( $this->Ftp->isConnected() ) {
				$this->Ftp->app_logout();
			}
			//
			//$downloadPath= $this->_getDownloadFilePath() ;
//TODO unlink ok?
			//@unlink( $downloadPath );
			@unlink( $this->downloadedFilePath );

			$this->content .= _MI_XUPDATE_PROG_COMPLETED . '<br><br>';

			@ unlink( _MD_XUPDATE_SYS_LOCK_FILE );
		} else {
			$result = false;
		}

		if ( $result ) {
			$this->nextlink = $this->_get_nextlink();
		} else {
			$this->content .= _ERRORS;
		}

		return $result;
	}

	/**
	 * _getDownloadUrl
	 *
	 * @return    strig
	 **/
	public function _getDownloadUrl() {
		// TODO ファイルNotFound対策
		$url = sprintf( $this->downloadUrlFormat, $this->target_key );

		return $url;
	}

	/**
	 * uploadFiles
	 *
	 * @return    bool
	 **/
	private function uploadFiles() {
		//$this->Ftp->connect();

		$this->Ftp->appendMes( 'start uploading..<br>' );
		$this->content .= _MI_XUPDATE_PROG_UPLOADING . '<br>';

		if ( 'Theme' !== $this->target_type ) {
			return false;
		}

		// copy to themes
		$uploadPath = XOOPS_ROOT_PATH . '/themes/';
		$unzipPath  = $this->exploredDirPath . '/';
		$result     = $this->Ftp->uploadNakami( $unzipPath, $uploadPath );
		if ( ! $this->_check_file_upload_result( $result, 'themes' ) ) {
			return false;
		}

		$this->Ftp->appendMes( 'end uploaded success<br>' );

		return true;
	}

	/**
	 * _get_nextlink
	 *
	 * @return    strig
	 **/
	private function _get_nextlink() {
		$ret = '<a href="' . XOOPS_MODULE_URL . '/legacy/admin/index.php?action=ThemeList">' . _MI_XUPDATE_ADMENU_THEME . _MI_XUPDATE_MANAGE . '</a>';

		return $ret;
	}
} // end class
;
