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

if ( ! defined( 'XOOPS_ROOT_PATH' ) ) {
	exit();
}

//require_once XUPDATE_TRUST_PATH .'/class/Root.class.php';

/**
 * XoopsSimpleObject
 */
class Xupdate_ModuleStore extends Legacy_AbstractObject {

	const PRIMARY = 'id';
	const DATANAME = 'modulestore';

	public $mModule;
	public $modinfo = [];
	public $detailed_version = '';
	public $options = [];

	public function __construct() {
		if ( XOOPS_DB_TYPE === 'pdo_pgsql' ) {
			$this->initVar( 'id', XOBJ_DTYPE_INT, "nextval('" . XOOPS_DB_PREFIX . '_' . $this->mDirname . "_modulestore_id_seq')", false );//Primary key
		} else {
			$this->initVar( 'id', XOBJ_DTYPE_INT, '0', false );//Primary key
		}
		$this->initVar( 'sid', XOBJ_DTYPE_INT, '0', false );//store join

		$this->initVar( 'dirname', XOBJ_DTYPE_STRING, '', false );
		$this->initVar( 'trust_dirname', XOBJ_DTYPE_STRING, '', false );
		$this->initVar( 'version', XOBJ_DTYPE_INT, 100, false );
		$this->initVar( 'license', XOBJ_DTYPE_STRING, '', false );
		$this->initVar( 'required', XOBJ_DTYPE_STRING, '', false );
		$this->initVar( 'last_update', XOBJ_DTYPE_INT, null, false );
		$this->initVar( 'target_key', XOBJ_DTYPE_STRING, '', false );
		$this->initVar( 'target_type', XOBJ_DTYPE_STRING, '', false );

		$this->initVar( 'replicatable', XOBJ_DTYPE_INT, '0', false );
		$this->initVar( 'description', XOBJ_DTYPE_STRING, '', false );
		$this->initVar( 'unzipdirlevel', XOBJ_DTYPE_INT, '0', false );
		$this->initVar( 'addon_url', XOBJ_DTYPE_STRING, '', false, 191 );
		$this->initVar( 'detail_url', XOBJ_DTYPE_STRING, '', false, 191 );
		$this->initVar( 'options', XOBJ_DTYPE_TEXT, '', false );

		// ver >= 0.06
		$this->initVar( 'isactive', XOBJ_DTYPE_INT, '-1', false );
		$this->initVar( 'hasupdate', XOBJ_DTYPE_INT, '0', false );

		// ver >= 0.11
		$this->initVar( 'contents', XOBJ_DTYPE_STRING, '', false, 191 );

		// ver >= 0.60
		$this->initVar( 'category_id', XOBJ_DTYPE_INT, '0', false );
		parent::__construct();
	}

	public function assignVars( $item ) {
		$tag = isset( $item['tag'] ) ? $item['tag'] : '';
		unset( $item['tag'] );
		$res            = parent::assignVars( $item );
		$this->mDirname = 'xupdate';
		if ( 'package' !== $item['contents'] ) {
			$this->mTag = explode( ' ', $tag );
		} else {
			$this->mTag = [];
		}

		return $res;
	}

	public function get( $key ) {
		if ( 'posttime' === $key ) {
			return time();
		}

		return parent::get( $key );
	}

	/**
	 * @return string
	 */
	public function getRenderedVersion() {
		return ( $this->getVar( 'version' ) > 0 ) ? sprintf( '%01.2f', $this->getVar( 'version' ) / 100 ) : '';
	}

	/**
	 * @
	 * @param bool $readini
	 */
	public function setmModule( $readini = true ) {
		$hModule  = Xupdate_Utils::getXoopsHandler( 'module' );
		$dirname  = $this->get( 'dirname' );
		$contents = $this->get( 'contents' );
		if ( 'module' === $contents || 'package' === $contents ) {
			$this->mModule =& $hModule->getByDirname( $dirname );
			$_isModule     = true;
		} else {
			$this->mModule = null;
			$_isModule     = false;
		}
		if ( is_object( $this->mModule ) ) {
			$this->setVar( 'last_update', $this->mModule->getVar( 'last_update' ) );
			$this->modinfo            =& $this->mModule->getInfo();
			$this->modinfo['version'] = sprintf( '%01.2f', $this->mModule->getVar( 'version' ) / 100 );
			$trust_dirname            = $this->mModule->getVar( 'trust_dirname' );

			$this->options = $this->unserialize_options( $readini );

			// set detaild_version by constat (ex. '_MI_LEGACY_DETAILED_VERSION'
			if ( ! isset( $this->modinfo['detailed_version'] ) ) {
				if ( defined( '_MI_' . strtoupper( $dirname ) . '_DETAILED_VERSION' ) ) {
					$this->modinfo['detailed_version'] = constant( '_MI_' . strtoupper( $dirname ) . '_DETAILED_VERSION' );
				} elseif ( $trust_dirname && defined( '_MI_' . strtoupper( $trust_dirname ) . '_DETAILED_VERSION' ) ) {
					$this->modinfo['detailed_version'] = constant( '_MI_' . strtoupper( $trust_dirname ) . '_DETAILED_VERSION' );
				} elseif ( $this->options['detailed_version'] ) {
					$this->modinfo['detailed_version'] = '';
				}
			}

			if ( $readini ) {
				if ( $this->mModule->getVar( 'isactive' ) ) {
					if ( ( $this->getVar( 'version' ) && $this->mModule->getVar( 'version' ) < $this->getVar( 'version' ) )
					     ||
					     ( isset( $this->modinfo['detailed_version'] ) && $this->_check_hasupdate( $this->modinfo['detailed_version'], $this->options['detailed_version'] ) ) ) {
						$this->setVar( 'hasupdate', 1 );
					} else {
						$this->setVar( 'hasupdate', 0 );
					}
					$this->setVar( 'isactive', 1 );
				} else {
					$this->setVar( 'hasupdate', 0 );
					$this->setVar( 'isactive', 0 );
				}
			}

			if ( ! isset( $this->modinfo['trust_dirname'] ) ) {
				$this->modinfo['trust_dirname'] = '';
			}
			if ( empty( $trust_dirname ) && 'TrustModule' === $this->getVar( 'target_type' ) ) {
				if ( $this->modinfo['trust_dirname'] ) {
					$trust_dirname = $this->modinfo['trust_dirname'];
				} else {
					//for d3modules
					if ( file_exists( XOOPS_MODULE_PATH . '/' . $this->getVar( 'dirname' ) . '/mytrustdirname.php' ) ) {
						$mytrustdirname = '';
						include XOOPS_MODULE_PATH . '/' . $this->getVar( 'dirname' ) . '/mytrustdirname.php';
						$trust_dirname                  = $mytrustdirname;
						$this->modinfo['trust_dirname'] = $mytrustdirname;
					}
				}
				if ( $trust_dirname ) {
					// update XCL core module info
					$this->mModule->setVar( 'trust_dirname', $trust_dirname );
					$hModule->insert( $this->mModule );
				}
			} else {
				if ( $trust_dirname && 'TrustModule' !== $this->getVar( 'target_type' ) ) {
					// 以前の X-update では。TrustMode ではないモジュールなのに
					// なぜか mytrustdirname.php が存在するモジュールに対し、
					// 誤って XCL Core の modules テーブルの trust_name を登録してしまっていたので、その対応。
					$this->modinfo['trust_dirname'] = $trust_dirname = '';
					$this->mModule->setVar( 'trust_dirname', $trust_dirname );
					$hModule->insert( $this->mModule );
				}
				if ( $trust_dirname && ! $this->modinfo['trust_dirname'] ) {
					$this->modinfo['trust_dirname'] = $trust_dirname;
				}
			}
		} else {
			$this->mModule = new XoopsModule();//空のobject
			$this->mModule->cleanVars();

			$this->options = $this->unserialize_options( $readini );
			if ( isset( $this->options['modinfo'] ) ) {
				$this->modinfo = $this->options['modinfo'];
				if ( ! isset( $this->modinfo['version'] ) ) {
					$this->modinfo['version'] = 0;
				}
				if ( ! isset( $this->modinfo['detailed_version'] ) ) {
					$this->modinfo['detailed_version'] = '';
				}
				if ( ! isset( $this->modinfo['lastupdate'] ) ) {
					$this->modinfo['lastupdate'] = 0;
				}
				$this->mModule->setVar( 'version', $this->modinfo['version'] * 100 );
			} else {
				$this->mModule->setVar( 'version', $this->getVar( 'version' ) );
				$this->modinfo = [
					'version'          => $this->mModule->getRenderedVersion(),
					'detailed_version' => $this->options['detailed_version'],
					'lastupdate'       => 0
				];
			}
			if ( $readini ) {
				$this->setVar( 'isactive', - 1 );
				if ( ! $_isModule ) {
					// for Theme
					if ( 'theme' === $this->getVar( 'contents' ) ) {
						$t_dir = XOOPS_ROOT_PATH . '/themes/' . $this->getVar( 'dirname' );
						if ( is_dir( $t_dir ) ) {
							$this->setVar( 'isactive', 1 );
							$lastupdate = filemtime( $t_dir );
							$this->setVar( 'last_update', $lastupdate );
							$m_file = $t_dir . '/' . 'manifesto.ini.php';
							if ( is_file( $m_file ) ) {
								if ( $manifesto = @ parse_ini_file( $m_file ) ) {
									if ( ! empty( $manifesto['Version'] ) ) {
										$mVersion = $manifesto['Version'] * 100;
										if ( ! $this->getVar( 'version' ) ) {
											$this->setVar( 'version', $mVersion );
										}
										$this->mModule->setVar( 'version', $mVersion );
										$this->modinfo = [
											'version'          => $this->mModule->getRenderedVersion(),
											'detailed_version' => $this->options['detailed_version'],
											'lastupdate'       => $lastupdate
										];
									}
								}
							} else {
								if ( $lastupdate > $this->modinfo['lastupdate'] ) {
									$this->mModule->setVar( 'version', $this->getVar( 'version' ) );
									$this->modinfo = [
										'version'          => $this->mModule->getRenderedVersion(),
										'detailed_version' => $this->options['detailed_version'],
										'lastupdate'       => $lastupdate
									];
								}
							}
						}
					}
					// for Preload
					if ( 'preload' === $this->getVar( 'contents' ) ) {
						$t_file = XOOPS_ROOT_PATH . '/preload/' . $this->getVar( 'target_key' ) . '.class.php';
						if ( is_file( $t_file ) ) {
							$lastupdate = filemtime( $t_file );
							$this->setVar( 'isactive', 1 );
							$this->setVar( 'last_update', $lastupdate );
							if ( $lastupdate > $this->modinfo['lastupdate'] ) {
								$this->mModule->setVar( 'version', $this->getVar( 'version' ) );
								$this->modinfo = [
									'version'          => $this->mModule->getRenderedVersion(),
									'detailed_version' => $this->options['detailed_version'],
									'lastupdate'       => $lastupdate
								];
							}
						}
					}
					if ( $this->getVar( 'isactive' ) == 1) {
						$this->options['modinfo'] = $this->modinfo;
					} else {
						unset( $this->options['modinfo'] );
					}
					$this->setVar( 'options', serialize( $this->options ) );
					if ( ( $this->getVar( 'version' ) && $this->mModule->getVar( 'version' ) < $this->getVar( 'version' ) )
					     ||
					     ( isset( $this->modinfo['detailed_version'] ) && $this->_check_hasupdate( $this->modinfo['detailed_version'], $this->options['detailed_version'] ) ) ) {
						$this->setVar( 'hasupdate', 1 );
					} else {
						$this->setVar( 'hasupdate', 0 );
					}
				}
			}
		}
	}

	/**
	 * @return bool
	 */
	public function isDirnameError() {
		if ( 'TrustModule' === $this->getVar( 'target_type' ) ) {
			if ( is_object( $this->mModule ) ) {
				if ( $this->mModule->getVar( 'mid' ) ) {
					if ( $this->getVar( 'trust_dirname' ) == $this->mModule->getVar( 'trust_dirname' ) ) {
						return false;//upadte
					}
					if ( ! isset( $this->modinfo['trust_dirname'] ) ) {
						return true;
					}
					if ( empty( $this->modinfo['trust_dirname'] ) ) {
						return true;
					}
					if ( $this->modinfo['trust_dirname'] != $this->getVar( 'trust_dirname' ) ) {
						return true;
					}
				}
			}
		} else {
			if ( is_object( $this->mModule ) ) {
				if ( $this->mModule->getVar( 'mid' ) ) {
					if ( isset( $this->modinfo['trust_dirname'] ) && ! empty( $this->modinfo['trust_dirname'] ) ) {
						return true;
					}
				}
			}
		}

		return false;
	}

	/**
	 * @return bool
	 */
	public function hasNeedUpdate() {
		if ( empty( $this->modinfo ) ) {
			return false;
		} else {
			return ( $this->getVar( 'version' ) != Legacy_Utils::convertVersionFromModinfoToInt( $this->modinfo['version'] ) );
		}
	}

	/**
	 * Check need update of detailed_version
	 * @return bool
	 */
	public function hasNeedUpdateDetail() {
		if ( empty( $this->modinfo ) ) {
			return false;
		} else {
			return ( isset( $this->modinfo['detailed_version'] ) && isset( $this->options['detailed_version'] ) && $this->modinfo['detailed_version'] != $this->options['detailed_version'] );
		}
	}

	public function get_StoreUrl() {
		//TODO for test dirname ?
		$root       =& XCube_Root::getSingleton();
		$modDirname = $root->mContext->mModule->mAssetManager->mDirname;
		$ret        = XOOPS_MODULE_URL . '/' . $modDirname . '/admin/index.php?action=ModuleInstall'
		              . '&id=' . $this->getVar( 'id' ) . '&dirname=' . $this->getVar( 'dirname' );

		return $ret;
	}

	public function get_InstallUrl() {
		$ret = XOOPS_MODULE_URL . '/legacy/admin/index.php?action=ModuleInstall&dirname='
		       . $this->getVar( 'dirname' );

		return $ret;
	}

	public function get_UpdateUrl() {
		$ret = XOOPS_MODULE_URL . '/legacy/admin/index.php?action=ModuleUpdate&dirname='
		       . $this->getVar( 'dirname' );

		return $ret;
	}

	/**
	 * get_DetailUrl
	 *
	 * @param string $downloadUrlFormat
	 * @param string $target_key
	 *
	 * @return    string
	 **/
	public function get_DetailUrl( $target_key, $downloadUrlFormat ) {
		// TODO ファイルNotFound対策
		$url = sprintf( $downloadUrlFormat, $target_key );

		return $url;
	}

	/**
	 * Get this item's store name
	 *
	 * @return string Tthis item's store name
	 */
	public function get_StoreName() {
		return $this->_getStoreNameBySid( $this->get( 'sid' ) );
	}

	/**
	 * [modules.ini] Options unserializer
	 *
	 * @param bool $readini
	 *
	 * @return array
	 */
	public function unserialize_options( $readini = false ) {
		$dirname = $this->getVar( 'dirname' );

		//unserialize xin option fileld and replace dirname
		$options = [];
		if ( $option = $this->get( 'options' ) ) {
			if ( ! $options = @unserialize( $this->get( 'options' ) ) ) {
				$options = [];
			}
		}
		if ( isset( $options['writable_dir'] ) ) {
			if ( ! $readini ) {
				array_walk( $options['writable_dir'], [ $this, '_printf' ], [
					$dirname,
					XOOPS_ROOT_PATH,
					XOOPS_TRUST_PATH
				] );
			}
		} else {
			$options['writable_dir'] = [];
		}
		if ( isset( $options['writable_file'] ) ) {
			if ( ! $readini ) {
				array_walk( $options['writable_file'], [ $this, '_printf' ], [
					$dirname,
					XOOPS_ROOT_PATH,
					XOOPS_TRUST_PATH
				] );
			}
		} else {
			$options['writable_file'] = [];
		}
		if ( isset( $options['no_overwrite'] ) ) {
			if ( ! $readini ) {
				array_walk( $options['no_overwrite'], [ $this, '_printf' ], [
					$dirname,
					XOOPS_ROOT_PATH,
					XOOPS_TRUST_PATH
				] );
			}
		} else {
			$options['no_overwrite'] = [];
		}
		if ( isset( $options['no_update'] ) ) {
			if ( ! $readini ) {
				array_walk( $options['no_update'], [ $this, '_printf' ], [
					$dirname,
					XOOPS_ROOT_PATH,
					XOOPS_TRUST_PATH
				] );
			}
		} else {
			$options['no_update'] = [];
		}
		if ( isset( $options['rename_item'] ) ) {
			if ( ! $readini ) {
				array_walk( $options['rename_item'], [ $this, '_printf' ], [
					$dirname,
					XOOPS_ROOT_PATH,
					XOOPS_TRUST_PATH
				] );
			}
		} else {
			$options['rename_item'] = [];
		}
		if ( isset( $options['delete_dir'] ) ) {
			if ( ! $readini ) {
				array_walk( $options['delete_dir'], [ $this, '_printf' ], [
					$dirname,
					XOOPS_ROOT_PATH,
					XOOPS_TRUST_PATH
				] );
			}
		} else {
			$options['delete_dir'] = [];
		}
		if ( isset( $options['delete_file'] ) ) {
			if ( ! $readini ) {
				array_walk( $options['delete_file'], [ $this, '_printf' ], [
					$dirname,
					XOOPS_ROOT_PATH,
					XOOPS_TRUST_PATH
				] );
			}
		} else {
			$options['delete_file'] = [];
		}
		if ( ! isset( $options['detailed_version'] ) ) {
			$options['detailed_version'] = '';
		} else {
			$options['detailed_version'] = Xupdate_Utils::toShow( $options['detailed_version'] );
		}
		if ( ! isset( $options['screen_shot'] ) ) {
			$options['screen_shot'] = '';
		} else {
			$options['screen_shot'] = Xupdate_Utils::toShow( $options['screen_shot'] );
		}
		if ( ! isset( $options['force_languages'] ) ) {
			$options['force_languages'] = [];
		}

		return $options;
	}

	/**
	 *
	 * @param $format
	 * @param $key
	 * @param $args
	 */
	private function _printf( &$format, $key, $args ) {
		$format = sprintf( $format, $args[0], $args[1], $args[2] );
	}

	/**
	 * Get Store name by sid
	 *
	 * @param intger $sid
	 *
	 * @return string Store name
	 */
	private function _getStoreNameBySid( $sid ) {
		static $names = [];
		static $sHandler = null;
		if ( null === $sHandler ) {
			$sHandler = Legacy_Utils::getModuleHandler( 'Store', 'xupdate' );
		}
		if ( ! isset( $names[ $sid ] ) ) {
			$obj           = $sHandler->get( $sid );
			$names[ $sid ] = $obj->get( 'name' );
		}

		return $names[ $sid ];
	}

	/**
	 * Check hasupdate (compare $version1[local], $version2[fetched])
	 *
	 * @param $version1
	 * @param $version2
	 *
	 * @return bool
	 */
	private function _check_hasupdate( $version1, $version2 ) {
		if ( preg_match( '/\d+/', $version1 ) && preg_match( '/\d+/', $version2 ) ) {
			return version_compare( $version1, $version2, '<' );
		} else {
			return ( $version1 != $version2 );
		}
	}
} // end class

/**
 * XoopsObjectGenericHandler extends
 */
class Xupdate_ModuleStoreHandler extends Legacy_AbstractClientObjectHandler {
	public $mTable = '{dirname}_modulestore';

	public $mPrimary = 'id';
	//XoopsSimpleObject
	public $mClass = 'Xupdate_ModuleStore';

	public $mDirname;


	public function __construct( /*** XoopsDatabase ***/ &$db, /*** string ***/ $dirname ) {
		$this->mTable   = strtr( $this->mTable, [ '{dirname}' => $dirname ] );
		$this->mDirname = $dirname;
		parent::__construct( $db );
	}

	public function &getObjects( $criteria = null, $limit = null, $start = null, $id_as_key = false ) {
		$ret = [];

		$mObjects =& parent::getObjects( $criteria, $limit, $start, $id_as_key );
		//return $mObjects;

		foreach ( $mObjects as $key => $mobj ) {
			$mobj->setmModule( false );//判定用のインストール済みのモジュール情報の保持を追加
			$mobj->mDirname = $this->mDirname;
			if ( $id_as_key ) {
				$id         = $mobj->getVar( 'id' );
				$ret[ $id ] = $mobj;// do not add &
			} else {
				$ret[] = $mobj;// do not add &
			}
		}

		return $ret;
	}

	/**
	 * Get count has update items
	 *
	 * @param string $contents
	 *
	 * @return number
	 */
	public function getCountHasUpdate( $contents = 'module' ) {
		$criteria = new CriteriaCompo();
		$criteria->add( new Criteria( 'contents', $contents ) );
		$criteria->add( new Criteria( 'isactive', 1 ) );
		$criteria->add( new Criteria( 'hasupdate', 1 ) );
		$criteria->setGroupby( 'dirname' );
		$mObjects = parent::getObjects( $criteria );

		return count( $mObjects );
	}

	/**
	 * Get Notify HTML (Pull down bar)
	 * Add as JavaScript into headerScript
	 *
	 * @return void
	 */
	public function getNotifyHTML() {
		$result        = '';
		$module_count  = $this->getCountHasUpdate( 'module' );
		$theme_count   = $this->getCountHasUpdate( 'theme' );
		$preload_count = $this->getCountHasUpdate( 'preload' );
		if ( $module_count || $theme_count || $preload_count ) {
			$root =& XCube_Root::getSingleton();
			$root->mLanguageManager->loadBlockMessageCatalog( 'xupdate' );
			$module      = ( $module_count ) ? '<a href="' . XOOPS_MODULE_URL . '/' . $this->mDirname . '/admin/index.php?action=ModuleStore&amp;filter=updated&amp;sort=-6">' . sprintf( _MB_XUPDATE_HAVE_UPDATEMODULE, $module_count ) . '</a>' : '';
			$theme       = ( $theme_count ) ? '<a href="' . XOOPS_MODULE_URL . '/' . $this->mDirname . '/admin/index.php?action=ThemeStore&amp;filter=updated">' . sprintf( _MB_XUPDATE_HAVE_UPDATETHEME, $theme_count ) . '</a>' : '';
			$preload     = ( $preload_count ) ? '<a href="' . XOOPS_MODULE_URL . '/' . $this->mDirname . '/admin/index.php?action=PreloadStore&amp;filter=updated">' . sprintf( _MB_XUPDATE_HAVE_UPDATEPRELOAD, $preload_count ) . '</a>' : '';
			$msg         = sprintf( _MB_XUPDATE_HAVE_UPDATE, $module . $theme . $preload );
			$type        = ( ! empty( $_COOKIE['xupdate_ondemand'] ) ) ? 'ondemand' : 'sticky';
			$arg         = parse_url( XOOPS_URL );
			$cookie_path = ( isset( $arg['path'] ) ) ? $arg['path'] . '/' : '/';
			$notifyJS    = <<<EOD
$('.notification.{$type}').notify({ type: '{$type}' });
$('.close').click(function(){
	$.cookie('xupdate_ondemand', '1', { path: '{$cookie_path}' });
});
$('.ondemand-button').click(function(){
	$.removeCookie('xupdate_ondemand', { path: '{$cookie_path}' });
});
EOD;
			$ondemandBtn = '';
			if ( 'ondemand' === $type ) {
				$notifyJS    .= "\n" . '$(\'.ondemand-button\').show();';
				$ondemandBtn = '<div class="hide ondemand-button">
				<a href="javascript:"><img src="' . XOOPS_URL . '/common/js/notify/images/icon-arrowdown.png" /></a>
				</div>';
			}

			$result = '<div class="notification ' . $type . ' hide">
			<a class="close" href="javascript:"><img src="' . XOOPS_URL . '/common/js/notify/images/icon-close.png" /></a>
			<div>' . $msg . '</div>
			</div>' . $ondemandBtn;
			$result = str_replace( "'", '&#039;', $result );
			$result = str_replace( [ "\r", "\n", "\t" ], '', $result );

			$headerScript = $root->mContext->getAttribute( 'headerScript' );
			$headerScript->addStylesheet( '/common/js/notify/style/default.css' );
			$headerScript->addStylesheet( '/modules/' . $this->mDirname . '/admin/templates/stylesheets/module.css' );
			$headerScript->addLibrary( '/common/js/notify/notification.js' );
			$headerScript->addLibrary( '/common/js/jquery.cookie.js' );
			$headerScript->addScript( "\njQuery('$result').appendTo('body');\n" . $notifyJS );
		}
	}

	protected function _isActivityClient( /*** mixed[] ***/ $conf ) {
		return false;
	}
} // end class
;
