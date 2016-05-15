<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_category
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>
<div id="slideContainer">
	<?php foreach ($list as $item) : ?>
		<div class="mySlide<?php echo substr($moduleclass_sfx,0,1); ?>">
			<?php if ($params->get('link_titles') == 1) : ?>
				<?php echo JLayoutHelper::render('joomla.content.full_image', $item) ?>
				<h4><a href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($item->slug, $item->catid, $item->language)); ?>"><?php echo $item->title; ?></a></h4>
			<?php else : ?>
				<?php echo $item->title; ?>
			<?php endif; ?>
					<?php if ($item->displayHits) : ?>
				<span class="mod-articles-category-hits">
					(<?php echo $item->displayHits; ?>)
				</span>
			<?php endif; ?>
					<?php if ($params->get('show_author')) : ?>
				<span class="mod-articles-category-writtenby">
					<?php echo $item->displayAuthorName; ?>
				</span>
			<?php endif;?>
					<?php if ($item->displayCategoryTitle) : ?>
				<span class="mod-articles-category-category">
					(<?php echo $item->displayCategoryTitle; ?>)
				</span>
			<?php endif; ?>
					<?php if ($item->displayDate) : ?>
				<span class="mod-articles-category-date">
					<?php echo $item->displayDate; ?>
				</span>
			<?php endif; ?>
					<?php if ($params->get('show_introtext')) : ?>
				<p class="mod-articles-category-introtext">
					<?php echo $item->displayIntrotext; ?>
				</p>
			<?php endif; ?>
					<?php if ($params->get('show_readmore')) : ?>
				<p class="mod-articles-category-readmore">
					<a class="mod-articles-category-title <?php echo $item->active; ?>" href="<?php echo $item->link; ?>">
						<?php if ($item->params->get('access-view') == false) : ?>
							<?php echo JText::_('MOD_ARTICLES_CATEGORY_REGISTER_TO_READ_MORE'); ?>
						<?php elseif ($readmore = $item->alternative_readmore) : ?>
							<?php echo $readmore; ?>
							<?php echo JHtml::_('string.truncate', $item->title, $params->get('readmore_limit')); ?>
						<?php elseif ($params->get('show_readmore_title', 0) == 0) : ?>
							<?php echo JText::sprintf('MOD_ARTICLES_CATEGORY_READ_MORE_TITLE'); ?>
						<?php else : ?>
							<?php echo JText::_('MOD_ARTICLES_CATEGORY_READ_MORE'); ?>
							<?php echo JHtml::_('string.truncate', $item->title, $params->get('readmore_limit')); ?>
						<?php endif; ?>
					</a>
				</p>
			<?php endif; ?>
		</div>
	<?php endforeach; ?>
</div>

<script>
	var myIndex<?php echo substr($moduleclass_sfx,0,1);?> = 0;
	carousel<?php echo substr($moduleclass_sfx,0,1);?>();

function carousel<?php echo substr($moduleclass_sfx,0,1);?>() {
	var i;
	var x = document.getElementsByClassName("mySlide<?php echo substr($moduleclass_sfx,0,1);?>");
	for (i = 0; i < x.length; i++) {
		x[i].style.display = "none";  
	}
	myIndex<?php echo substr($moduleclass_sfx,0,1);?>++;
	if (myIndex<?php echo substr($moduleclass_sfx,0,1);?> > x.length) {myIndex<?php echo substr($moduleclass_sfx,0,1);?> = 1}    
	x[myIndex<?php echo substr($moduleclass_sfx,0,1);?>-1].style.display = "inline-block";  
	setTimeout(carousel<?php echo substr($moduleclass_sfx,0,1);?>, 4000); // Change image every 4 seconds
}

</script>