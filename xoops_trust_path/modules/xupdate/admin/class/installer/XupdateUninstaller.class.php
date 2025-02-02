<?php
/**
 * X-Update package management for XCL
 *
 * @package XCL
 * @subpackage Xupdate
 * @version 2.3
 * @author Naoki Sawada, Naoki Okino, Gigamaster (XCL 2.3)
 * @copyright (c) 2005-2022 The XOOPSCube Project
 * @license https://github.com/xoopscube/xcl/blob/master/GPL_V2.txt
 */

if ( ! defined( 'XOOPS_ROOT_PATH' ) ) {
	exit;
}

require_once XUPDATE_TRUST_PATH . '/admin/class/installer/XupdateInstallUtils.class.php';

/**
 * Xupdate_Uninstaller
 **/
class Xupdate_Uninstaller {
	/*** Legacy_ModuleInstallLog ***/
	public $mLog = null;

	/*** bool ***/
	private $_mForceMode = false;

	/*** XoopsModule ***/
	private $_mXoopsModule = null;

	/**
	 * __construct
	 *
	 * @param void
	 *
	 * @return  void
	 **/
	public function __construct() {
		$this->mLog = new Legacy_ModuleInstallLog();
	}

	/**
	 * setCurrentXoopsModule
	 *
	 * @param XoopsModule  &$xoopsModule
	 *
	 * @return  void
	 **/
	public function setCurrentXoopsModule( /*** XoopsModule ***/ &$xoopsModule ) {
		$this->_mXoopsModule =& $xoopsModule;
	}

	/**
	 * setForceMode
	 *
	 * @param bool $isForceMode
	 *
	 * @return  void
	 **/
	public function setForceMode( /*** bool ***/ $isForceMode ) {
		$this->_mForceMode = $isForceMode;
	}

	/**
	 * _uninstallModule
	 *
	 * @param void
	 *
	 * @return  void
	 **/
	private function _uninstallModule() {
		$moduleHandler =& Xupdate_Utils::getXoopsHandler( 'module' );

		if ( $moduleHandler->delete( $this->_mXoopsModule ) ) {
			$this->mLog->addReport( _MI_XUPDATE_INSTALL_MSG_MODULE_INFORMATION_DELETED );
		} else {
			$this->mLog->addError( _MI_XUPDATE_INSTALL_ERROR_MODULE_INFORMATION_DELETED );
		}
	}

	/**
	 * _uninstallTables
	 *
	 * @param void
	 *
	 * @return  void
	 **/
	private function _uninstallTables() {
		$root    =& XCube_Root::getSingleton();
		$db      =& $root->mController->getDB();
		$dirname = $this->_mXoopsModule->get( 'dirname' );

		$tables =& $this->_mXoopsModule->getInfo( 'tables' );
		if ( is_array( $tables ) ) {
			foreach ( $tables as $table ) {
				$tableName = str_replace(
					[ '{prefix}', '{dirname}' ],
					[ XOOPS_DB_PREFIX, $dirname ],
					$table
				);
				if ( XOOPS_DB_TYPE === 'pdo_pgsql' ) {
					$sql = sprintf( 'drop table "%s";', $tableName );
				} else {
					$sql = sprintf( 'drop table `%s`;', $tableName );
				}

				if ( $db->query( $sql ) ) {
					$this->mLog->addReport(
						XCube_Utils::formatString(
							_MI_XUPDATE_INSTALL_MSG_TABLE_DOROPPED,
							$tableName
						)
					);
				} else {
					$this->mLog->addError(
						XCube_Utils::formatString(
							_MI_XUPDATE_INSTALL_ERROR_TABLE_DOROPPED,
							$tableName
						)
					);
				}
			}
		}
	}

	/**
	 * _uninstallTemplates
	 *
	 * @param void
	 *
	 * @return  void
	 **/
	private function _uninstallTemplates() {
		Xupdate_InstallUtils::uninstallAllOfModuleTemplates( $this->_mXoopsModule, $this->mLog, false );
	}

	/**
	 * _uninstallBlocks
	 *
	 * @param void
	 *
	 * @return  void
	 **/
	private function _uninstallBlocks() {
		Xupdate_InstallUtils::uninstallAllOfBlocks( $this->_mXoopsModule, $this->mLog );

		$tplHandler =& Xupdate_Utils::getXoopsHandler( 'tplfile' );
		$cri        = new Criteria( 'tpl_module', $this->_mXoopsModule->get( 'dirname' ) );
		if ( ! $tplHandler->deleteAll( $cri ) ) {
			$this->mLog->addError(
				XCube_Utils::formatString(
					_MI_XUPDATE_INSTALL_ERROR_BLOCK_TPL_DELETED,
					$tplHandler->db->error()
				)
			);
		}
	}

	/**
	 * _uninstallPreferences
	 *
	 * @param void
	 *
	 * @return  void
	 **/
	private function _uninstallPreferences() {
		Xupdate_InstallUtils::uninstallAllOfConfigs( $this->_mXoopsModule, $this->mLog );
	}

	/**
	 * _processReport
	 *
	 * @param void
	 *
	 * @return  void
	 **/
	private function _processReport() {
		if ( ! $this->mLog->hasError() ) {
			$this->mLog->add(
				XCube_Utils::formatString(
					_MI_XUPDATE_INSTALL_MSG_MODULE_UNINSTALLED,
					$this->_mXoopsModule->get( 'name' )
				)
			);
		} elseif ( is_object( $this->_mXoopsModule ) ) {
			$this->mLog->addError(
				XCube_Utils::formatString(
					_MI_XUPDATE_INSTALL_ERROR_MODULE_UNINSTALLED,
					$this->_mXoopsModule->get( 'name' )
				)
			);
		} else {
			$this->mLog->addError(
				XCube_Utils::formatString(
					_MI_XUPDATE_INSTALL_ERROR_MODULE_UNINSTALLED,
					'something'
				)
			);
		}
	}

	/**
	 * executeUninstall
	 *
	 * @param void
	 *
	 * @return  bool
	 **/
	public function executeUninstall() {
		$this->_uninstallTables();
		if ( ! $this->_mForceMode && $this->mLog->hasError() ) {
			$this->_processReport();

			return false;
		}

		if ( null != $this->_mXoopsModule->get( 'mid' ) ) {
			$this->_uninstallModule();
			if ( ! $this->_mForceMode && $this->mLog->hasError() ) {
				$this->_processReport();

				return false;
			}

			$this->_uninstallTemplates();
			if ( ! $this->_mForceMode && $this->mLog->hasError() ) {
				$this->_processReport();

				return false;
			}

			$this->_uninstallBlocks();
			if ( ! $this->_mForceMode && $this->mLog->hasError() ) {
				$this->_processReport();

				return false;
			}

			$this->_uninstallPreferences();
			if ( ! $this->_mForceMode && $this->mLog->hasError() ) {
				$this->_processReport();

				return false;
			}
		}

		$this->_processReport();

		return true;
	}
}
