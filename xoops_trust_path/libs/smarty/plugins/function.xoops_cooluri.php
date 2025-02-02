<?php
/**
 *
 * @package Legacy
 * @version $Id
 * @copyright (c) 2005-2022 The XOOPS Cube Project
 * @license https://github.com/xoopscube/xcl/blob/master/GPL_V2.txt
 *
 */

/*
 * Smarty plugin
 * -------------------------------------------------------------
 * Type:	 function
 * Name:	 xoops_cooluri
 * Version:  1.0
 * Date:	 May 1, 2010
 * Author:	 kilica
 * Purpose:  create uri
 * Input:	 string		dirname	*required
 *			 string		dataname
 *			 int		data_id
 *			 string		action
 *			 string		query
 *
 * Examples: {xoops_cooluri dirname=lenews dataname=story data_id=6 action=edit query='cat_id=3&mode=admin'}
 * -------------------------------------------------------------
 */

function smarty_function_xoops_cooluri($params, &$smarty)
{
    if (! $params['dirname']) {
        return;
    }
    $dirname = $params['dirname'];
    $dataname = isset($params['dataname']) ? $params['dataname'] : null;
    $dataId = isset($params['data_id']) ? $params['data_id'] : 0;
    $action = isset($params['action']) ? $params['action'] : null;
    $query = isset($params['query']) ? $params['query'] : null;

    echo htmlspecialchars(Legacy_Utils::renderUri($dirname, $dataname, $dataId, $action, $query), ENT_QUOTES);
}
