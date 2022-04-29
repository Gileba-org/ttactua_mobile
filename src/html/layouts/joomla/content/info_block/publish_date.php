<?php
/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$app      = JFactory::getApplication();
$params	  = $app->getTemplate(true)->params;

?>
			<dd class="published">
				<span class="icon-calendar fa fa-calendar-alt" aria-hidden="true"></span>
				<time datetime="<?php echo JHtml::_('date', $displayData['item']->publish_up, 'c'); ?>" itemprop="datePublished">
					<?php if ($params->get('specificDateFormat') != "") {
						echo JText::sprintf(JHtml::_('date', $displayData['item']->publish_up, JText::_($params->get('specificDateFormat'))));
					} else {
						echo JText::sprintf(JHtml::_('date', $displayData['item']->publish_up, JText::_('DATE_FORMAT_LC3')));
					}	?>
				</time>
			</dd>
