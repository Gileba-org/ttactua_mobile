<?php
/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;

$app      = Factory::getApplication();
$params	  = $app->getTemplate(true)->params;

?>
			<dd class="published">
				<span class="icon-calendar" aria-hidden="true"></span>
				<time datetime="<?php echo HTMLHelper::_('date', $displayData['item']->publish_up, 'c'); ?>" itemprop="datePublished">
					<?php if ($params->get('specificDateFormat') != "") {
						echo Text::sprintf(HTMLHelper::_('date', $displayData['item']->publish_up, Text::_($params->get('specificDateFormat'))));
					} else {
						echo Text::sprintf(HTMLHelper::_('date', $displayData['item']->publish_up, Text::_('DATE_FORMAT_LC3')));
					}	?>
				</time>
			</dd>
