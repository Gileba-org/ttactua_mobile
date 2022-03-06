<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_category
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined("_JEXEC") or die();

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Router\Route;
use Joomla\Component\Content\Site\Helper\RouteHelper;
?>
<?php if (!empty($list)) : ?>
<div class="slideContainer">
	<?php foreach ($list as $item): ?>
		<div class="mySlide_<?php echo $module->id; ?>" style="max-width: 100%;" itemscope>
			<?php if ($params->get("link_titles") == 1): ?>
				<?php echo LayoutHelper::render("joomla.content.full_image", $item); ?>
				<a href="<?php echo Route::_(ContentHelperRoute::getArticleRoute($item->slug, $item->catid, $item->language)); ?>">
					<h4><?php echo $item->title; ?></h4>
				</a>
			<?php else: ?>
				<?php echo LayoutHelper::render("joomla.content.full_image", $item); ?>
				<h4><?php echo $item->title; ?></h4>
			<?php endif; ?>
					<?php if ($item->displayHits): ?>
				<span class="mod-articles-category-hits">
					(<?php echo $item->displayHits; ?>)
				</span>
					<?php endif; ?>
					<?php if ($params->get("show_author")): ?>
				<span class="mod-articles-category-writtenby">
						<?php echo $item->displayAuthorName; ?>
				</span>
					<?php endif; ?>
					<?php if ($item->displayCategoryTitle): ?>
				<span class="mod-articles-category-category">
					(<?php echo $item->displayCategoryTitle; ?>)
				</span>
					<?php endif; ?>
					<?php if ($item->displayDate): ?>
				<span class="mod-articles-category-date">
						<?php echo $item->displayDate; ?>
				</span>
					<?php endif; ?>
					<?php if ($params->get("show_introtext")): ?>
				<p class="mod-articles-category-introtext">
						<?php echo $item->displayIntrotext; ?>
				</p>
					<?php endif; ?>
					<?php if ($params->get("show_readmore")): ?>
				<p class="mod-articles-category-readmore">
					<a class="mod-articles-category-title <?php echo $item->active; ?>" href="<?php echo $item->link; ?>">
						<?php if ($item->params->get("access-view") == false): ?>
							<?php echo Text::_("MOD_ARTICLES_CATEGORY_REGISTER_TO_READ_MORE"); ?>
						<?php elseif ($readmore = $item->alternative_readmore): ?>
							<?php echo $readmore; ?>
							<?php echo HTMLHelper::_("string.truncate", $item->title, $params->get("readmore_limit")); ?>
						<?php elseif ($params->get("show_readmore_title", 0) == 0): ?>
							<?php echo Text::sprintf("MOD_ARTICLES_CATEGORY_READ_MORE_TITLE"); ?>
						<?php else: ?>
							<?php echo Text::_("MOD_ARTICLES_CATEGORY_READ_MORE"); ?>
							<?php echo HTMLHelper::_("string.truncate", $item->title, $params->get("readmore_limit")); ?>
						<?php endif; ?>
					</a>
				</p>
					<?php endif; ?>
		</div>
	<?php endforeach; ?>
</div>

<script>
	var myIndex_<?php echo $module->id; ?> = 0;
	carousel_<?php echo $module->id; ?>();

function carousel_<?php echo $module->id; ?>() {
	var i;
	var x = document.getElementsByClassName("mySlide_<?php echo $module->id; ?>");
	for (i = 0; i < x.length; i++) {
		x[i].style.display = "none";
	}
	myIndex_<?php echo $module->id; ?>++;
	if (myIndex_<?php echo $module->id; ?> > x.length) {myIndex_<?php echo $module->id; ?> = 1}
	x[myIndex_<?php echo $module->id; ?>-1].style.display = "inline-block";
	setTimeout(carousel_<?php echo $module->id; ?>, 4000); // Change image every 4 seconds
}

</script>
<?php endif;
