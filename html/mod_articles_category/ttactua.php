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
		<div class="mySlide">
			<?php if ($params->get('link_titles') == 1) : ?>
				<h2><a class="mod-articles-category-title <?php echo $item->active; ?>" href="<?php echo $item->link; ?>">
					<?php echo $item->title; ?></a></h2>
					<?php echo JLayoutHelper::render('joomla.content.full_image', $item) ?>
				</a>
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
	var myIndex = 0;
	carousel();

function carousel() {
    var i;
    var x = document.getElementsByClassName("mySlide");
    for (i = 0; i < x.length; i++) {
       x[i].style.display = "none";  
    }
    myIndex++;
    if (myIndex > x.length) {myIndex = 1}    
    x[myIndex-1].style.display = "block";  
    setTimeout(carousel, 4000); // Change image every 2 seconds
}
</script>