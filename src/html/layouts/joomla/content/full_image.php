<?php
/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined("_JEXEC") or die();
$params = $displayData->params;
?>
<?php $images = json_decode($displayData->images); ?>
<?php if (!empty($images->image_intro)): ?>
	<?php $imgfloat = empty($images->float_fulltext) ? $params->get("float_fulltext") : $images->float_fulltext; ?>
	<div class="pull-<?php echo htmlspecialchars($imgfloat); ?> item-image full"> <img
		<?php if (isset($images->image_intro_caption) && $images->image_intro_caption):
  	echo 'class="caption" title="' . htmlspecialchars($images->image_intro_caption) . '"';
  endif; ?>
	src="<?php echo htmlspecialchars($images->image_intro); ?>" alt="<?php echo htmlspecialchars(
	$images->image_intro_alt
); ?>"
	itemprop="image"/> </div>
<?php endif;
