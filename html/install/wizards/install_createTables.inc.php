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
include_once './class/dbmanager.php';

$dbm = new db_manager();

$tables = [];

$result = $dbm->queryFromFile( './sql/' . ( ( XOOPS_DB_TYPE === 'mysqli' ) ? 'mysql' : XOOPS_DB_TYPE ) . '.structure.sql' );

$wizard->assign( 'reports', $dbm->report() );
if ( ! $result ) {
	$wizard->assign( 'message', _INSTALL_L114 );
	$wizard->setBack( [ 'start', _INSTALL_L103 ] );
} else {
	$wizard->assign( 'message', _INSTALL_L115 );
}
$wizard->render( 'install_createTables.tpl.php' );
