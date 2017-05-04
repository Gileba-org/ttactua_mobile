<?php
/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_BASE') or die;

$list = $displayData['list'];
?>
<ul>
	<li class="pagination-start"><span class="icon-first"><?php echo $list['start']['data']; ?></span></li>
	<li class="pagination-prev"><span class="icon-previous"><?php echo $list['previous']['data']; ?></span></li>
	<?php foreach ($list['pages'] as $page) : ?>
		<?php echo '<li>' . $page['data'] . '</li>'; ?>
	<?php endforeach; ?>
	<li class="pagination-next"><span class="icon-next"><?php echo $list['next']['data']; ?></span></li>
	<li class="pagination-end"><span class="icon-last"><?php echo $list['end']['data']; ?></span></li>
</ul>
