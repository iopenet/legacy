<?php
/**
 *
 * @package Legacy
 * @version $Id: edituser.php,v 1.3 2008/09/25 15:10:27 kilica Exp $
 * @copyright (c) 2005-2022 The XOOPSCube Project
 * @license https://github.com/xoopscube/xcl/blob/master/GPL_V2.txt
 *
 */
/*------------------------------------------------------------------------*
 |  This file was entirely rewritten by the XOOPS Cube Legacy project for |
 |   keeping compatibility with XOOPS 2.0.x <https://www.xoops.org>        |
 *------------------------------------------------------------------------*/

require_once 'mainfile.php';

XCube_DelegateUtils::call('Legacypage.Edituser.Access');
