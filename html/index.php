<?php
/**
 *
 * @package Legacy
 * @version $Id: index.php,v 1.3 2008/09/25 15:10:27 kilica Exp $
 * @copyright (c) 2005-2022 The XOOPSCube Project
 * @license https://github.com/xoopscube/xcl/blob/master/GPL_V2.txt
 *
 */
require_once './mainfile.php';
require_once './header.php';

$xoopsOption['show_cblock'] = 1;
XCube_DelegateUtils::call('Legacypage.Top.Access');

require_once './footer.php';
