<?php
/**
 * By default joomla display 10 pages in pagination. This file allows
 * us to customize the number of displayed pages.
 * 
 * Simply add this file to $template/html/pagination.php and
 * change $displayedPages variable.
 */
defined('_JEXEC') or die('Restricted access');


/**
 * Override joomla default pagination list render method
 * @param  array	$list	Pagination raw data
 * @return string			HTML string
 */
function pagination_list_render($list) {
	$displayedPages = 6;
	// Reduce number of displayed pages to 6 instead of 10
	$list['pages'] = _reduce_displayed_pages($list['pages'], $displayedPages);
	return _list_render($list);
}
/**
 * Reduce number of displayed pages in pagination
 * @param  array	$pages			Pagination pages raw data
 * @param  integer	$displayedPages	Number of displayed pages
 * @return string					HTML string
 */
function _reduce_displayed_pages($pages, $displayedPages) {
	$currentPageIndex = _get_current_page_index($pages);
	$midPoint = ceil($displayedPages / 2);
	if ($currentPageIndex >= $displayedPages) {
		$pages = array_slice($pages, -$displayedPages);
		return $pages;
	} 
	
	$startIndex = max($currentPageIndex - $midPoint, 0); 	
	$pages = array_slice($pages, $startIndex, $displayedPages);
	
	return $pages;
}
/**
 * Get current page index
 * @param  array	$pages	Pagination pages raw data
 * @return integer			Current page index
 */
function _get_current_page_index($pages) {
	$counter = 0;
	foreach ($pages as $page) {
		if (!$page['active']) return $counter;
		$counter++;
	}
}
/**
 * Function copied from joomla html pagination to render pagination data into html string
 * @param  array	$list	Pagination raw data
 * @return string			HTML string
 */
function _list_render($list) {
	// Reverse output rendering for right-to-left display.
	$html = '<ul>';
	$html .= '<li class="pagination-start">' . $list['start']['data'] . '</li>';
	$html .= '<li class="pagination-prev">' . $list['previous']['data'] . '</li>';
	foreach ($list['pages'] as $page)
	{
		$html .= '<li>' . $page['data'] . '</li>';
	}
	$html .= '<li class="pagination-next">' . $list['next']['data'] . '</li>';
	$html .= '<li class="pagination-end">' . $list['end']['data'] . '</li>';
	$html .= '</ul>';
	return $html;
}
