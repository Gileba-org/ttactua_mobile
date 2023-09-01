<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_contact
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined("_JEXEC") or die();

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\FileLayout;
use Joomla\CMS\Plugin\PluginHelper;
use Joomla\CMS\Router\Route;

$params = $this->item->params;
?>

<div class="contact<?php echo $this->pageclass_sfx; ?>" itemscope itemtype="https://schema.org/Person">
	<?php if ($params->get("show_page_heading")): ?>
		<h1>
			<?php echo $this->escape($params->get("page_heading")); ?>
		</h1>
	<?php endif; ?>

	<?php if ($this->item->name && $params->get("show_name")): ?>
		<div class="page-header">
			<h2>
				<?php if ($this->item->published == 0): ?>
					<span class="label label-warning"><?php echo Text::_("JUNPUBLISHED"); ?></span>
				<?php endif; ?>
				<span class="contact-name" itemprop="name"><?php echo $this->item->name; ?></span>
			</h2>
		</div>
	<?php endif; ?>

	<?php $show_contact_category = $params->get("show_contact_category"); ?>

	<?php if ($show_contact_category === "show_no_link"): ?>
		<h3>
			<span class="contact-category"><?php echo $this->item->category_title; ?></span>
		</h3>
	<?php elseif ($show_contact_category === "show_with_link"): ?>
		<?php $contactLink = ContactHelperRoute::getCategoryRoute($this->item->catid); ?>
		<h3>
			<span class="contact-category"><a href="<?php echo $contactLink; ?>">
				<?php echo $this->escape($this->item->category_title); ?></a>
			</span>
		</h3>
	<?php endif; ?>

	<?php echo $this->item->event->afterDisplayTitle; ?>

	<?php if ($params->get("show_contact_list") && count($this->items) > 1): ?>
		<form action="#" method="get" name="selectForm" id="selectForm">
			<label for="select_contact"><?php echo Text::_("COM_CONTACT_SELECT_CONTACT"); ?></label>
			<?php echo HTMLHelper::_(
   	"select.genericlist",
   	$this->items,
   	"select_contact",
   	'class="inputbox" onchange="document.location.href = this.value"',
   	"link",
   	"name",
   	$this->item->link
   ); ?>
		</form>
	<?php endif; ?>

	<?php if ($params->get("show_tags", 1) && !empty($this->item->tags->itemTags)): ?>
		<?php $this->item->tagLayout = new FileLayout("joomla.content.tags"); ?>
		<?php echo $this->item->tagLayout->render($this->item->tags->itemTags); ?>
	<?php endif; ?>

	<?php $presentation_style = $params->get("presentation_style"); ?>
	<?php $accordionStarted = false; ?>
	<?php $tabSetStarted = false; ?>

	<?php if ($this->params->get("show_info", 1)): ?>
		<?php if ($presentation_style === "sliders"): ?>
			<?php echo HTMLHelper::_("bootstrap.startAccordion", "slide-contact", ["active" => "basic-details"]); ?>
			<?php $accordionStarted = true; ?>
			<?php echo HTMLHelper::_("bootstrap.addSlide", "slide-contact", Text::_("COM_CONTACT_DETAILS"), "basic-details"); ?>
		<?php elseif ($presentation_style === "tabs"): ?>
			<?php echo HTMLHelper::_("bootstrap.startTabSet", "myTab", ["active" => "basic-details"]); ?>
			<?php $tabSetStarted = true; ?>
			<?php echo HTMLHelper::_("bootstrap.addTab", "myTab", "basic-details", Text::_("COM_CONTACT_DETAILS")); ?>
		<?php elseif ($presentation_style === "plain"): ?>
			<?php echo "<h3>" . Text::_("COM_CONTACT_DETAILS") . "</h3>"; ?>
		<?php endif; ?>

		<?php if ($this->item->image && $params->get("show_image")): ?>
			<div class="thumbnail pull-right">
				<?php echo HTMLHelper::_("image", $this->item->image, htmlspecialchars($this->item->name, ENT_QUOTES, "UTF_8"), [
    	"itemprop" => "image",
    ]); ?>
			</div>
		<?php endif; ?>

		<?php if ($this->item->con_position && $params->get("show_position")): ?>
			<dl class="contact-position dl-horizontal">
				<dt><?php echo Text::_("COM_CONTACT_POSITION"); ?>:</dt>
				<dd itemprop="jobTitle">
					<?php echo $this->item->con_position; ?>
				</dd>
			</dl>
		<?php endif; ?>

		<?php echo $this->loadTemplate("address"); ?>

		<?php echo $this->item->event->beforeDisplayContent; ?>

		<?php if ($params->get("allow_vcard")): ?>
			<?php echo Text::_("COM_CONTACT_DOWNLOAD_INFORMATION_AS"); ?>
			<a href="<?php echo Route::_(
   	"index.php?option=com_contact&view=contact&catid=" .
   		$this->item->catslug .
   		"&id=" .
   		$this->item->slug .
   		"&format=vcf"
   ); ?>">
			<?php echo Text::_("COM_CONTACT_VCARD"); ?></a>
		<?php endif; ?>

		<?php if ($presentation_style === "sliders"): ?>
			<?php echo HTMLHelper::_("bootstrap.endSlide"); ?>
		<?php elseif ($presentation_style === "tabs"): ?>
			<?php echo HTMLHelper::_("bootstrap.endTab"); ?>
		<?php endif; ?>
	<?php endif; ?>

	<?php if ($params->get("show_email_form") && ($this->item->email_to || $this->item->user_id)): ?>
		<?php if ($presentation_style === "sliders"): ?>
			<?php if (!$accordionStarted) {
   	echo HTMLHelper::_("bootstrap.startAccordion", "slide-contact", ["active" => "display-form"]);
   	$accordionStarted = true;
   } ?>
			<?php echo HTMLHelper::_("bootstrap.addSlide", "slide-contact", Text::_("COM_CONTACT_EMAIL_FORM"), "display-form"); ?>
		<?php elseif ($presentation_style === "tabs"): ?>
			<?php if (!$tabSetStarted) {
   	echo HTMLHelper::_("bootstrap.startTabSet", "myTab", ["active" => "display-form"]);
   	$tabSetStarted = true;
   } ?>
			<?php echo HTMLHelper::_("bootstrap.addTab", "myTab", "display-form", Text::_("COM_CONTACT_EMAIL_FORM")); ?>
		<?php elseif ($presentation_style === "plain"): ?>
			<?php echo "<h3>" . Text::_("COM_CONTACT_EMAIL_FORM") . "</h3>"; ?>
		<?php endif; ?>

		<?php echo $this->loadTemplate("form"); ?>

		<?php if ($presentation_style === "sliders"): ?>
			<?php echo HTMLHelper::_("bootstrap.endSlide"); ?>
		<?php elseif ($presentation_style === "tabs"): ?>
			<?php echo HTMLHelper::_("bootstrap.endTab"); ?>
		<?php endif; ?>
	<?php endif; ?>

	<?php if ($params->get("show_links")): ?>
		<?php if ($presentation_style === "sliders"): ?>
			<?php if (!$accordionStarted): ?>
				<?php echo HTMLHelper::_("bootstrap.startAccordion", "slide-contact", ["active" => "display-links"]); ?>
				<?php $accordionStarted = true; ?>
			<?php endif; ?>
		<?php elseif ($presentation_style === "tabs"): ?>
			<?php if (!$tabSetStarted): ?>
				<?php echo HTMLHelper::_("bootstrap.startTabSet", "myTab", ["active" => "display-links"]); ?>
				<?php $tabSetStarted = true; ?>
			<?php endif; ?>
		<?php endif; ?>
		<?php echo $this->loadTemplate("links"); ?>
	<?php endif; ?>

	<?php if ($params->get("show_articles") && $this->item->user_id && $this->item->articles): ?>
		<?php if ($presentation_style === "sliders"): ?>
			<?php if (!$accordionStarted) {
   	echo HTMLHelper::_("bootstrap.startAccordion", "slide-contact", ["active" => "display-articles"]);
   	$accordionStarted = true;
   } ?>
			<?php echo HTMLHelper::_("bootstrap.addSlide", "slide-contact", Text::_("JGLOBAL_ARTICLES"), "display-articles"); ?>
		<?php elseif ($presentation_style === "tabs"): ?>
			<?php if (!$tabSetStarted) {
   	echo HTMLHelper::_("bootstrap.startTabSet", "myTab", ["active" => "display-articles"]);
   	$tabSetStarted = true;
   } ?>
			<?php echo HTMLHelper::_("bootstrap.addTab", "myTab", "display-articles", Text::_("JGLOBAL_ARTICLES")); ?>
		<?php elseif ($presentation_style === "plain"): ?>
			<?php echo "<h3>" . Text::_("JGLOBAL_ARTICLES") . "</h3>"; ?>
		<?php endif; ?>

		<?php echo $this->loadTemplate("articles"); ?>

		<?php if ($presentation_style === "sliders"): ?>
			<?php echo HTMLHelper::_("bootstrap.endSlide"); ?>
		<?php elseif ($presentation_style === "tabs"): ?>
			<?php echo HTMLHelper::_("bootstrap.endTab"); ?>
		<?php endif; ?>
	<?php endif; ?>

	<?php if ($params->get("show_profile") && $this->item->user_id && PluginHelper::isEnabled("user", "profile")): ?>
		<?php if ($presentation_style === "sliders"): ?>
			<?php if (!$accordionStarted) {
   	echo HTMLHelper::_("bootstrap.startAccordion", "slide-contact", ["active" => "display-profile"]);
   	$accordionStarted = true;
   } ?>
			<?php echo HTMLHelper::_("bootstrap.addSlide", "slide-contact", Text::_("COM_CONTACT_PROFILE"), "display-profile"); ?>
		<?php elseif ($presentation_style === "tabs"): ?>
			<?php if (!$tabSetStarted) {
   	echo HTMLHelper::_("bootstrap.startTabSet", "myTab", ["active" => "display-profile"]);
   	$tabSetStarted = true;
   } ?>
			<?php echo HTMLHelper::_("bootstrap.addTab", "myTab", "display-profile", Text::_("COM_CONTACT_PROFILE")); ?>
		<?php elseif ($presentation_style === "plain"): ?>
			<?php echo "<h3>" . Text::_("COM_CONTACT_PROFILE") . "</h3>"; ?>
		<?php endif; ?>

		<?php echo $this->loadTemplate("profile"); ?>

		<?php if ($presentation_style === "sliders"): ?>
			<?php echo HTMLHelper::_("bootstrap.endSlide"); ?>
		<?php elseif ($presentation_style === "tabs"): ?>
			<?php echo HTMLHelper::_("bootstrap.endTab"); ?>
		<?php endif; ?>
	<?php endif; ?>

	<?php if ($params->get("show_user_custom_fields") && $this->itemUser): ?>
		<?php echo $this->loadTemplate("user_custom_fields"); ?>
	<?php endif; ?>

	<?php if ($this->item->misc && $params->get("show_misc")): ?>
		<?php if ($presentation_style === "sliders"): ?>
			<?php if (!$accordionStarted) {
   	echo HTMLHelper::_("bootstrap.startAccordion", "slide-contact", ["active" => "display-misc"]);
   	$accordionStarted = true;
   } ?>
			<?php echo HTMLHelper::_(
   	"bootstrap.addSlide",
   	"slide-contact",
   	Text::_("COM_CONTACT_OTHER_INFORMATION"),
   	"display-misc"
   ); ?>
		<?php elseif ($presentation_style === "tabs"): ?>
			<?php if (!$tabSetStarted) {
   	echo HTMLHelper::_("bootstrap.startTabSet", "myTab", ["active" => "display-misc"]);
   	$tabSetStarted = true;
   } ?>
			<?php echo HTMLHelper::_("bootstrap.addTab", "myTab", "display-misc", Text::_("COM_CONTACT_OTHER_INFORMATION")); ?>
		<?php elseif ($presentation_style === "plain"): ?>
			<?php echo "<h3>" . Text::_("COM_CONTACT_OTHER_INFORMATION") . "</h3>"; ?>
		<?php endif; ?>

		<div class="contact-miscinfo">
			<dl class="dl-horizontal">
				<dt>
					<span class="<?php echo $params->get("marker_class"); ?>">
					<?php echo $params->get("marker_misc"); ?>
					</span>
				</dt>
				<dd>
					<span class="contact-misc">
						<?php echo $this->item->misc; ?>
					</span>
				</dd>
			</dl>
		</div>

		<?php if ($presentation_style === "sliders"): ?>
			<?php echo HTMLHelper::_("bootstrap.endSlide"); ?>
		<?php elseif ($presentation_style === "tabs"): ?>
			<?php echo HTMLHelper::_("bootstrap.endTab"); ?>
		<?php endif; ?>
	<?php endif; ?>

	<?php if ($accordionStarted): ?>
		<?php echo HTMLHelper::_("bootstrap.endAccordion"); ?>
	<?php elseif ($tabSetStarted): ?>
		<?php echo HTMLHelper::_("bootstrap.endTabSet"); ?>
	<?php endif; ?>

	<?php echo $this->item->event->afterDisplayContent; ?>
</div>
