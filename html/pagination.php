<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.protostar
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;

/**
 * Renders an active item in the pagination block
 *
 * @param   PaginationObject  $item  The current pagination object
 *
 * @return  string                    HTML markup for active item
 *
 * @since   3.0
 */
function pagination_item_active(&$item)
{
	$class = '';

	// Check for "Start" item
	if ($item->text == Text::_('JLIB_HTML_START'))
	{
		$display = '<span class="icon-first"></span>';
	}

	// Check for "Prev" item
	if ($item->text == Text::_('JPREV'))
	{
		$display = '<span class="icon-previous"></span>';
	}

	// Check for "Next" item
	if ($item->text == Text::_('JNEXT'))
	{
		$display = '<span class="icon-next"></span>';
	}

	// Check for "End" item
	if ($item->text == Text::_('JLIB_HTML_END'))
	{
		$display = '<span class="icon-last"></span>';
	}

	// If the display object isn't set already, just render the item with its text
	if (!isset($display))
	{
		$display = $item->text;
		$class   = ' class="hidden-phone"';
	}

	return '<span' . $class . '><a title="' . $item->text . '" href="' . $item->link . '" class="pagenav">' . $display . '</a></span>';
}

/**
 * Renders an inactive item in the pagination block
 *
 * @param   PaginationObject  $item  The current pagination object
 *
 * @return  string  HTML markup for inactive item
 *
 * @since   3.0
 */
function pagination_item_inactive(&$item)
{
	// Check for "Start" item
	if ($item->text == Text::_('JLIB_HTML_START'))
	{
		return '<span class="disabled"><a><span class="icon-first"></span></a></span>';
	}

	// Check for "Prev" item
	if ($item->text == Text::_('JPREV'))
	{
		return '<span class="disabled"><a><span class="icon-previous"></span></a></span>';
	}

	// Check for "Next" item
	if ($item->text == Text::_('JNEXT'))
	{
		return '<span class="disabled"><a><span class="icon-next"></span></a></span>';
	}

	// Check for "End" item
	if ($item->text == Text::_('JLIB_HTML_END'))
	{
		return '<span class="disabled"><a><span class="icon-last"></span></a></span>';
	}

	// Check if the item is the active page
	if (isset($item->active) && $item->active)
	{
		return '<span class="active hidden-phone"><span class="pagenav">' . $item->text . '</span></span>';
	}

	// Doesn't match any other condition, render a normal item
	return '<span class="disabled hidden-phone"><a>' . $item->text . '</a></span>';
}

/**
 * By default joomla display 10 pages in pagination. This file allows
 * us to customize the number of displayed pages.
 *
 * Simply add this file to $template/html/pagination.php and
 * change $displayedPages variable.
 */

/**
 * Override joomla default pagination list render method
 * @param  array	$list	Pagination raw data
 * @return string			HTML string
 */
function pagination_list_render($list)
{
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
function _reduce_displayed_pages($pages, $displayedPages)
{
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
function _get_current_page_index($pages)
{
	$counter = 0;
	foreach ($pages as $page) {
		if (!$page['active']) { return $counter;
		}

		$counter++;
	}
}

/**
 * Function copied from joomla html pagination to render pagination data into html string
 * @param  array	$list	Pagination raw data
 * @return string			HTML string
 */
function _list_render($list)
{
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
