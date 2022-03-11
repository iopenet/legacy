<?php
/**
 * checklogin
 * @package    XCL
 * @version    XCL 2.3.1
 * @author     Kilica, 2008/09/25
 * @copyright  (c) 2005-2022 The XOOPSCube Project
 * @license    https://github.com/xoopscube/xcl/blob/master/GPL_V2.txt
 * @brief      This file was entirely rewritten by the XOOPSCube Legacy project
 *             for compatibility with XOOPS2
 */

if (!defined('XOOPS_ROOT_PATH')) {
    exit();
}

$root =& XCube_Root::getSingleton();
$root->mController->checkLogin();

// ! Add after core!
