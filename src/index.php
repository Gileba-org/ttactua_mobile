<?php
	defined('_JEXEC') or die('Restricted access');

	/** @var JDocumentHtml $this */
	$app      	= JFactory::getApplication();

	/** Output as HTML5 */
	$this->setHtml5(true);

	$params	  	= $app->getTemplate(true)->params;
	$menu 		= $app->getMenu();
	$config 	= JFactory::getConfig();
	$version 	= new JVersion();

if ($version->isCompatible("4.0.0")) {
	$wa  		= $this->getWebAssetManager();
}

	JHtml::_('jquery.framework');
	JHtml::_('bootstrap.framework');

	/** Count Modules Performance */
	$countRightModules	= $this->countModules('right');
	$countLeftModules	= $this->countModules('left');
	$countHeaderModules	= $this->countModules('header');
	$countFooterModules	= $this->countModules('footer');
	$countTitleModules	= $this->countModules('title');
	$countTopModules	= $this->countModules('top');
	$countBannerModules	= $this->countModules('banners');
?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" >
   <head>
		<jdoc:include type="head" />
<?php
		JHtml::_('stylesheet', 'template.css', array('version' => 'auto', 'relative' => true));
		JHtml::_('stylesheet', 'templates/system/css/system.css', array('version' => 'auto'));
		JHtml::_('stylesheet', 'templates/system/css/general.css', array('version' => 'auto'));
		JHtml::_('stylesheet', 'media/jui/css/icomoon.css', array('version' => 'auto'));
if ($this->params->get('fontsCss') != "") {
	JHtml::_('stylesheet', 'https://fast.fonts.net/cssapi/' . $this->params->get('fontsCss'));
}

if ($version->isCompatible("4.0.0")) {
	$wa->getAsset('style', 'fontawesome')->setAttribute('rel', 'lazy-stylesheet');
}

if($countBannerModules) {
	JHTML::_('script', 'sticky.js', array('version' => 'auto', 'relative' => true));
}

		JHTML::_('script', 'elementQuery.js', array('version' => 'auto', 'relative' => true));
		JHTML::_('script', 'jquery.sidr.js', array('version' => 'auto', 'relative' => true));
?>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php	if ($this->params->get('doubleClick')) {	?>
<!-- START Google DoubleClick Code -->
			<script src="https://www.googletagservices.com/tag/js/gpt.js"></script>
			<script>
				googletag.cmd.push(function() {
	<?php				echo $this->params->get('doubleClick');	?>
					googletag.pubads().enableSingleRequest();
					googletag.enableServices();
				});
			</script>
<!-- END Google DoubleClick Code -->
<?php	}	?>
	</head>
	<body>
		<div id="sidemenu" class="col-p-only left">
			<div class="col-12" id="mobile-menu"></div>
		</div>
		<div id="mobile-header" class="col-p-only">
			<div class="col-p-2" id="simple-menu">
				<button class="hamburger hamburger--<?php echo $this->params->get('hamburgerstyle'); ?>" type="button">
					<span class="hamburger-box">
						<span class="hamburger-inner"></span>
					</span>
				</button>
			</div>
			<div class="col-p-10 flip-container vertical">
				<div class="flipper">
					<div class="mobile-front" id="site">
						<span id="sitename"><?php echo $config->get('sitename');?></span>
					</div>
					<div class="mobile-back">
						<jdoc:include type="modules" name="mobile-header" />
					   </div>
				</div>
			</div>
		</div>
		<div id="container">
			<div id="wrapper">
<?php if($countTitleModules) : ?>
				<div class="row" id="title">
					<div class="col-12 col-s-12 col-m-12 col-p-0"><jdoc:include type="modules" name="title" /></div>
				</div>
<?php endif ?>
<?php if($countTopModules) : ?>
				<div class="row" id="top">
					<div class="col-12 col-s-12 col-m-12 col-p-0"><jdoc:include type="modules" name="top" /></div>
				</div>
<?php endif ?>
<?php if($countBannerModules) : ?>
				<div id="sticky-anchor"></div>
				<div id="sticky">
					<div class="row" id="banners">
						<div class="col-12 col-s-12 col-m-12"><jdoc:include type="modules" name="banners" /></div>
					</div>
				</div>
<?php endif ?>
<?php if($countHeaderModules) : ?>
				<div class="row" id="header">
					<div class="col-12 col-s-12 col-m-12 col-p-0"><jdoc:include type="modules" name="header" /></div>
				</div>
<?php endif ?>
				<div class="row" id="main">
<?php if ($this->params->get('hideleft')) : ?>
					<div class="col-3 col-s-0 col-m-0 col-p-0" id="left"><jdoc:include type="modules" name="left" /></div>
<?php else : ?>
					<div class="col-3 col-s-4 col-m-5 col-p-0" id="left"><jdoc:include type="modules" name="left" /></div>
<?php endif ?>
<?php if($countRightModules && $countLeftModules) : ?>
					<div class="col-6 col-s-8 col-m-7" id="component_wrapper">
<?php elseif ($countRightModules || $countLeftModules): ?>
					<div class="col-9 col-s-8 col-m-7" id="component_wrapper">
<?php else : ?>
					<div class="col-12 col-s-12 col-m-12" id="component_wrapper">
<?php endif ?>
						<div id="messages"><jdoc:include type="message" /></div>
						<div id="cheader"><jdoc:include type="modules" name="content-header" /></div>
<?php if (!($this->params->get('componentFreeHome')) || ($menu->getActive() != $menu->getDefault())) : ?>
						<div id="component"><jdoc:include type="component" /></div>
<?php endif ?>
						<div id="cfooter"><jdoc:include type="modules" name="content-footer" /></div>
					</div>
<?php if ($this->params->get('hideleft')) : ?>
					<div class="col-3 col-s-4 col-m-5 col-p-0" id="right"><jdoc:include type="modules" name="right" style="ttactua" /></div>
<?php else : ?>
					<div class="col-3 col-s-0 col-m-0 col-p-0" id="right"><jdoc:include type="modules" name="right" style="ttactua" /></div>
<?php endif ?>
				</div>
<?php if($countFooterModules) : ?>
				<div class="row" id="footer">
					<div class="col-12 col-s-12 col-m-12"><jdoc:include type="modules" name="footer" /></div>
				</div>
<?php endif ?>
			</div>
		</div>
		<!-- Hamburgers en Sidr -->
		<script>
			var $hamburger = jQuery(".hamburger");
			var $mobilemenu = jQuery("#sidemenu");
			$hamburger.on("click", function(e) {
				$hamburger.toggleClass("is-active");
				$mobilemenu.toggleClass("left open");
			});
		</script>
		<!-- Move left menu to mobile space and back -->
		<script>
			var $win = jQuery(window);
			jQuery(document).ready(function(f) {
				if ($win.width() < 600) {
					jQuery("#mainmenu").appendTo("#mobile-menu");
				}
			});
			$win.on("resize", function(e) {
				if ($win.width() < 600) {
					jQuery("#mainmenu").appendTo("#mobile-menu");
				}
				if ($win.width() >= 600) {
					jQuery("#mainmenu").prependTo("#left");
				}
			});
		</script>
<?php if($countBannerModules) : ?>
		<!-- Sticky and turning banners -->
		<script>
			moveScroller();
		</script>
<?php endif ?>
<?php	if ($this->params->get('analytics')) {	?>
		<!-- Google Analytics -->
		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
				(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
				m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			  })
			  (window,document,'script','https://www.google-analytics.com/analytics.js','ga');
			  ga('create', '<?php	echo $this->params->get('analytics'); ?>', 'auto');
			  ga('send', 'pageview');
		  </script>
<?php	}	?>
	</body>
</html>
