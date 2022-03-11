<?php
/**
 * This Interface is generated by Cube tool.
 * @package    Legacy
 * @version    XCL 2.3.1
 * @author     Other authors gigamaster, 2020 XCL/PHP7
 * @author     code generator
 * @copyright  (c) 2005-2022 The XOOPSCube Project
 * @license    https://github.com/xoopscube/xcl/blob/master/GPL_V2.txt
 */

if (!defined('XOOPS_ROOT_PATH')) {
    exit();
}

/**
 * Interface of tag delegate
**/
interface Legacy_iTagDelegate
{
    /**
     * setTags	Legacy_Tag.{dirname}.SetTags
     *
     * @param bool		$result
     * @param string	$tDirname	Legacy_Tag module's dirname
     * @param string	$dirname	client module dirname
     * @param string	$dataname	client module dataname(tablename)
     * @param int		$dataId		client module primary key
     * @param int		$posttime
     * @param string[]	$tagArr		tags for this data
     */
    public static function setTags(&$result, $tDirname, $dirname, $dataname, $dataId, $posttime, $tagArr);

    /**
     * getTags	Legacy_Tag.{dirname}.GetTags
     * get tags from dirname/dataname/data_id
     *
     * @param string[] $tagArr
     * @param string	$tDirname	Legacy_Tag module's dirname
     * @param string	$dirname	client module dirname
     * @param string	$dataname	client module dataname(tablename)
     * @param int		$dataId		client module primary key
     */
    public static function getTags(&$tagArr, $tDirname, $dirname, $dataname, $dataId);

    /**
     * getTagCloudSrc	Legacy_Tag.{dirname}.GetTagCloudSrc
     *
     * @param mixed		$cloud
     *	 $cloud[$tag] = $count
     * @param string	$tDirname	Legacy_Tag module's dirname
     * @param string	$dirname	client module dirname
     * @param string	$dataname	client module dataname
     * @param int[]		$uidList	whose tags you want
     */
    public static function getTagCloudSrc(&$cloud, $tDirname, $dirname=null, $dataname=null, $uidList= []);

    /**
     * getDataIdListByTags	Legacy_Tag.{dirname}.GetDataIdListByTags
     *
     * @param int[]		$list
     * @param string	$tDirname	Legacy_Tag module's dirname
     * @param string[]	$tagArr		tag list
     * @param string	$dirname	client module dirname
     * @param string	$dataname	client module dataname
     */
    public static function getDataIdListByTags(&$list, $tDirname, $tagArr, $dirname, $dataname);
}
