<?php
/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_BASE') or die;

?>
			<span class="category-name">
				<?php if ($displayData['params']->get('show_publish_date') || $displayData['params']->get('show_create_date') || $displayData['params']->get('show_modify_date')) : ?>
					&bullet;
				<?php endif; ?>
					
					<?php $title = $this->escape($displayData['item']->category_title); ?>
				<?php if ($displayData['params']->get('link_category') && $displayData['item']->catslug) : ?>
					<?php $url = '<a href="' . JRoute::_(ContentHelperRoute::getCategoryRoute($displayData['item']->catslug)) . '" itemprop="genre">' . $title . '</a>'; ?>
					<?php echo JText::sprintf($url); ?>
				<?php else : ?>
					<?php echo JText::sprintf('COM_CONTENT_CATEGORY', '<span itemprop="genre">' . $title . '</span>'); ?>
				<?php endif; ?>
			</span>