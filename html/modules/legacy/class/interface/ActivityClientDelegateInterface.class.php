<?php
/**
 * This Interface is generated by Cube tool.
 * @package    Legacy
 * @version    XCL 2.3.1
 * @author     Other authors  gigamaster, 2020 XCL/PHP7
 * @author     code generator
 * @copyright  (c) 2005-2022 The XOOPSCube Project
 * @license    GPL 2.0
 */

if (!defined('XOOPS_ROOT_PATH')) {
    exit();
}

/**
 * Interface of group client delegate
 * Modules which uses Legacy_Activity must implement this interface.
 * Legacy_Activity module must be unique.
 * You can get its dirname by constant LEGACY_ACTIVITY_DIRNAME
**/
interface Legacy_iActivityClientDelegate
{
    /**
     * getClientList	Legacy_ActivityClient.GetClientList
     *
     * @param mixed[]	&$list
     *  @list[]['dirname']	client module's dirname
     *  @list[]['dataname']	client module's dataname(tablename)
     *  @list[]['access_controller']	access controller's module dirname
     *
     * @return	void
     */
    public static function getClientList(/*** mixed[] ***/ &$list);

    /**
     * getClientData	Legacy_ActivityClient.{dirname}.GetClientData
     *
     * @param mixed		&$list
     *  string	$list['dirname']	client module's dirname
     *  string	$list['dataname']	client module's dataname(tablename)
     *  int		$list['data_id']	client module's primary key
     *  mixed	$list['data']
     *  string  $list['title']		client module's title
     *  string	$list['template_name']
     * @param string	$dirname
     * @param string	$dataname
     * @param int		$dataId
     *
     * @return	void
     */
    public static function getClientData(/*** mixed ***/ &$list, /*** string ***/ $dirname, /*** string ***/ $dataname, /*** int ***/ $dataId);

    /**
     * getClientFeed	Legacy_ActivityClient.{dirname}.GetClientFeed
     *
     * @param mixed		&$list
     *  string[]	$list['title']	entry's title
     *  string[]	$list['link']	link to entry
     *  string[]	$list['id']		entry's id(=permalink to entry)
     *  int[]		$list['updated']	unixtime
     *  int[]		$list['published']	unixtime
     *  string[]	$list['author']
     *  string[]	$list['content']
     * @param string	$dirname	client module's dirname
     * @param string	$dataname	client module's dataname(tablename)
     * @param int		$dataId		client module's primary key
     *
     * @return	void
     */
    public static function getClientFeed(/*** mixed ***/ &$list, /*** string ***/ $dirname, /*** string ***/ $dataname, /*** int ***/ $dataId);
}
