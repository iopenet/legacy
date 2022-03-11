<?php
/**
 * @package    XCL
 * @subpackage Installation Wizard
 * @version    XCL 2.3.1
 * @author     kilica, 2008/09/25
 * @copyright  (c) 2005-2022 The XOOPSCube Project
 * @license    https://github.com/xoopscube/xcl/blob/master/GPL_V2.txt
 */

include_once '../mainfile.php';
include_once './class/settingmanager.php';

$sm = new setting_manager();

$sm->readConstant();
$wizard->setContent( $sm->editform() );
$wizard->render();
