<?php
/**
 * Pico content management D3 module for XCL
 *
 * @package    Pico
 * @version    XCL 2.3.1
 * @author     Other authors Gigamaster, 2020 XCL PHP7
 * @author     Gijoe (Peak)
 * @copyright  (c) 2005-2022 Author
 * @license    https://github.com/xoopscube/xcl/blob/master/GPL_V2.txt
 */

require_once __DIR__ . '/PicoControllerAbstract.class.php';
require_once __DIR__ . '/PicoModelTag.class.php';
require_once __DIR__ . '/PicoModelCategory.class.php';
require_once __DIR__ . '/PicoModelContent.class.php';

class PicoControllerQueryContents extends PicoControllerAbstract {

	//var $mydirname = '' ;
	//var $mytrustdirname = '' ;
	//var $assign = array() ;
	//var $mod_config = array() ;
	//var $uid = 0 ;
	//var $currentCategoryObj = null ;
	//var $permissions = array() ;
	//var $is_need_header_footer = true ;
	//var $template_name = '' ;
	//var $html_header = '' ;
	//var $contentObjs = array() ;

	public function execute( $request ) {
		parent::execute( $request );

		$whr     = '1';
		$queries = [];

		// query type "tag"
		if ( ! empty( $request['tag'] ) ) {
			$queries[] = [ 'type' => 'tag', 'value' => $request['tag'] ];
			// get content_ids
			$tag_handler    = new PicoTagHandler( $this->mydirname );
			$content_ids_sc = $tag_handler->getContentIdsCS( $request['tag'] );
			if ( $content_ids_sc ) {
				$whr .= ' AND (`content_id` IN (' . $content_ids_sc . '))';
			} else {
				$whr .= ' AND 0';
			}
		}

		// content handler
		$content_handler = new PicoContentHandler( $this->mydirname );

		// contents (order by modified_time DESC)
		$this->assign['contents'] = [];
		$contents4assign          = $content_handler->getContents4assign( $whr );
		foreach ( $contents4assign as $content4assign ) {
			$this->assign['contents'][] = $content4assign;
		}

		// render $queries
		$query4assign          = $this->renderQueries( $queries );
		$this->assign['query'] = $query4assign;

		// breadcrumbs
		$breadcrumbsObj = AltsysBreadcrumbs::getInstance();
		$breadcrumbsObj->appendPath( '', $query4assign['title'] );
		$this->assign['xoops_breadcrumbs'] = $breadcrumbsObj->getXoopsbreadcrumbs();
		$this->assign['xoops_pagetitle']   = $query4assign['title'];

		// views ('list')
		$this->template_name         = $this->mydirname . '_main_query_contents.html';
		$this->is_need_header_footer = true;
	}

	public function renderQueries( $queries ): array {
		$title = '';
		$desc  = '';

		foreach ( $queries as $query ) {
			$value4assign = htmlspecialchars( $query['value'], ENT_QUOTES );
			switch ( $query['type'] ) {
				case 'tag':
					$title .= sprintf( _MD_PICO_FMT_QUERYTAGTITLE, $value4assign );
					$desc  .= sprintf( _MD_PICO_FMT_QUERYTAGDESC, $value4assign );
					break;
			}
		}

		return [ 'title' => $title, 'desc' => $desc ];
	}
}
