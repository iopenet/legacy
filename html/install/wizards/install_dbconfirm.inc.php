<?php
/**
 * @package    XCL
 * @subpackage Installation Wizard
 * @version    XCL 2.3.1
 * @author     kilica, 2008/09/25
 * @copyright  (c) 2005-2022 The XOOPSCube Project
 * @license    https://github.com/xoopscube/xcl/blob/master/GPL_V2.txt
 */

include_once './class/settingmanager.php';

$sm = new setting_manager( true );

$content = $sm->checkData();
if ( ! empty( $content ) ) {
	$wizard->setTitle( _INSTALL_L93 );
	$wizard->setContent( $content . $sm->editform() );
	$wizard->setNext( [ 'dbconfirm', _INSTALL_L91 ] );
} else {
	$wizard->setContent( $sm->confirmForm() );
}
$wizard->render();
