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

if ( ! defined( 'XOOPS_ROOT_PATH' ) ) {
	exit;
}

require_once XOOPS_ROOT_PATH . '/core/XCube_ActionForm.class.php';
require_once XOOPS_MODULE_PATH . '/legacy/class/Legacy_Validator.class.php';

/**
 * Xupdate_StoreDeleteForm
 **/
class Xupdate_StoreDeleteForm extends XCube_ActionForm {
	/**
	 * getTokenName
	 *
	 * @param void
	 *
	 * @return  string
	 **/
	public function getTokenName() {
		return 'module.xupdate.StoreDeleteForm.TOKEN';
	}

	/**
	 * prepare
	 *
	 * @param void
	 *
	 * @return  void
	 **/
	public function prepare() {
		//
		// Set form properties
		//
		$this->mFormProperties['sid'] = new XCube_IntProperty( 'sid' );

		//
		// Set field properties
		//
		$this->mFieldProperties['sid'] = new XCube_FieldProperty( $this );
		$this->mFieldProperties['sid']->setDependsByArray( [ 'required' ] );
		$this->mFieldProperties['sid']->addMessage( 'required', _MD_XUPDATE_ERROR_REQUIRED, _MD_XUPDATE_LANG_SID );
	}

	/**
	 * load
	 *
	 * @param XoopsSimpleObject  &$obj
	 *
	 * @return  void
	 **/
	public function load( /*** XoopsSimpleObject ***/ &$obj ) {
		$this->set( 'sid', $obj->get( 'sid' ) );
	}

	/**
	 * update
	 *
	 * @param XoopsSimpleObject  &$obj
	 *
	 * @return  void
	 **/
	public function update( /*** XoopsSimpleObject ***/ &$obj ) {
		$obj->set( 'sid', $this->get( 'sid' ) );
	}
}
