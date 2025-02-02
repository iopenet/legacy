<?php
/**
 * X-Update package management for XCL
 *
 * @package XCL
 * @subpackage Xupdate
 * @version 2.3
 * @author Naoki Sawada, Naoki Okino, Gigamaster (XCL 2.3)
 * @copyright (c) 2005-2022 The XOOPS Cube Project
 * @license https://github.com/xoopscube/xcl/blob/master/GPL_V2.txt
 */

if ( ! defined( 'XOOPS_ROOT_PATH' ) ) {
	exit();
}

require_once XUPDATE_TRUST_PATH . '/class/AbstractFilterForm.class.php';

define( 'MODULE_SORT_KEY_ID', 1 );
define( 'MODULE_SORT_KEY_SID', 2 );
define( 'MODULE_SORT_KEY_DIRNAME', 3 );
define( 'MODULE_SORT_KEY_VERSION', 4 );
define( 'MODULE_SORT_KEY_LICENSE', 5 );
define( 'MODULE_SORT_KEY_REQUIRED', 6 );
define( 'MODULE_SORT_KEY_LASTUPDATE', 7 );
define( 'MODULE_SORT_KEY_TARGET_KEY', 8 );
define( 'MODULE_SORT_KEY_TARGET_TYPE', 9 );
define( 'MODULE_SORT_KEY_CATEGORY_ID', 10 );

define( 'MODULE_SORT_KEY_DEFAULT', MODULE_SORT_KEY_DIRNAME );
define( 'MODULE_SORT_KEY_MAXVALUE', 10 );

/***
 * @internal
 * This is the special filter for the list of installed modules without the
 * pager.
 */
class Xupdate_Admin_ModuleStoreFilterForm extends Xupdate_AbstractFilterForm {
	public $mSpecial = null;

	public $mSortKeys = [
		MODULE_SORT_KEY_ID          => 'id',
		MODULE_SORT_KEY_SID         => 'sid',
		MODULE_SORT_KEY_DIRNAME     => 'dirname',
		MODULE_SORT_KEY_VERSION     => 'version',
		MODULE_SORT_KEY_LICENSE     => 'license',
		MODULE_SORT_KEY_REQUIRED    => 'required',
		MODULE_SORT_KEY_LASTUPDATE  => 'last_update',
		MODULE_SORT_KEY_TARGET_KEY  => 'target_key',
		MODULE_SORT_KEY_TARGET_TYPE => 'target_type',
		MODULE_SORT_KEY_CATEGORY_ID => 'category_id'
	];

	public function __construct() {
		$this->_mCriteria = new CriteriaCompo();
	}

	public function Xupdate_Admin_ModuleStoreFilterForm() {
		self::__construct();
	}

	public function prepare( /*** XCube_PageNavigator ***/ &$navi, /*** XoopsObjectGenericHandler ***/ &$handler ) {
		parent::prepare( $navi, $handler );
	}

	public function getDefaultSortKey() {
		return MODULE_SORT_KEY_DEFAULT;
	}

	public function fetch() {
		$this->fetchSort();

		$req = XCube_Root::getSingleton()->mContext->mRequest;
		if ( null !== ( $value = $req->getRequest( 'category_id' ) ) ) {
			$this->mNavi->addExtra( 'category_id', $value );
			$this->_mCriteria->add( new Criteria( 'category_id', $value ) );
		}
		$this->_mCriteria->addSort( $this->getSort(), $this->getOrder() );
	}
}
