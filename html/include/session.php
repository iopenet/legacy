<?php
/**
 * Session
 * @package    XCL
 * @subpackage core
 * @version    XCL 2.3.1
 * @author     Other authors gigamaster, 2020 XCL/PHP7
 * @author     kilica, 2008/09/25
 * @copyright  (c) 2005-2022 The XOOPSCube Project
 * @license    https://github.com/xoopscube/xcl/blob/master/GPL_V2.txt
 */

if (!defined('XOOPS_ROOT_PATH')) {
    exit();
}

/**
  * Regenerate New Session ID & Delete OLD Session
  * @deprecated
  */

function xoops_session_regenerate()
{
    $root =& XCube_Root::getSingleton();
    if (!isset($_SESSION)) {
      $root->mSession->regenerate();
    }
}
