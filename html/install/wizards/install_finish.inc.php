<?php
/**
 * @package    XCL
 * @subpackage Installation Wizard
 * @version    XCL 2.3.1
 * @author     kilica, 2008/09/25
 * @copyright  (c) 2005-2022 The XOOPSCube Project
 * @license    https://github.com/xoopscube/xcl/blob/master/GPL_V2.txt
 */

include './language/' . $language . '/finish.php'; //This will set message to $content;

$wizard->assign( 'finish', $content );
$wizard->render( 'install_finish.tpl.php' );
