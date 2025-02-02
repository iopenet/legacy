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

require_once XOOPS_ROOT_PATH . '/core/XCube_ActionForm.class.php';
require_once XOOPS_MODULE_PATH . '/legacy/class/Legacy_Validator.class.php';

class Xupdate_Admin_ThemeFinderInstallForm extends XCube_ActionForm {
	/**
	 * getTokenName
	 *
	 * @param void
	 *
	 * @return  string
	 **/
	public function getTokenName() {
		return 'module.xupdate.Admin_ThemeFinderInstallForm.TOKEN';
	}

	/***
	 * For displaying the confirm-page, don't show CSRF error.
	 * Always return null.
	 */
	public function getTokenErrorMessage() {
		return null;
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
		$this->mFormProperties['addon_url'] = new XCube_StringProperty( 'addon_url' );

		$this->mFormProperties['target_key']  = new XCube_IntProperty( 'target_key' );
		$this->mFormProperties['target_type'] = new XCube_StringProperty( 'target_type' );

		//
		// Set field properties
		//
		/*
				$this->mFieldProperties['addon_url'] = new XCube_FieldProperty($this);
				$this->mFieldProperties['addon_url']->setDependsByArray(array('required'));
				$this->mFieldProperties['addon_url']->addMessage('required', _MD_XUPDATE_ERROR_REQUIRED, 'addon_url');
		*/
		$this->mFieldProperties['target_key'] = new XCube_FieldProperty( $this );
		$this->mFieldProperties['target_key']->setDependsByArray( [ 'required' ] );
		$this->mFieldProperties['target_key']->addMessage( 'required', _MD_XUPDATE_ERROR_REQUIRED, 'target_key' );

		$this->mFieldProperties['target_type'] = new XCube_FieldProperty( $this );
		$this->mFieldProperties['target_type']->setDependsByArray( [ 'required' ] );
		$this->mFieldProperties['target_type']->addMessage( 'required', _MD_XUPDATE_ERROR_REQUIRED, 'target_type' );
	}

	/**
	 * load
	 *
	 * @param XoopsSimpleObject  &$obj
	 *
	 * @return  void
	 **/
	public function load( /*** XoopsSimpleObject ***/ &$obj ) {
	}

	/**
	 * update
	 *
	 * @param XoopsSimpleObject  &$obj
	 *
	 * @return  void
	 **/
	public function update( /*** XoopsSimpleObject ***/ &$obj ) {
	}
}//END CLASS
;
