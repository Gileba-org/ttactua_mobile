<?php
	defined( '_JEXEC' ) or die( 'Restricted access' );
	
	$app      	= JFactory::getApplication();
	$doc      	= JFactory::getDocument();
	$params	  	= $app->getTemplate(true)->params;
	$menu 		= $app->getMenu();
	
	JHtml::_('jquery.framework');
	JHtml::_('bootstrap.framework');
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" 
   xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" >
   <head>
		<jdoc:include type="head" />
		<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/system/css/system.css" type="text/css" />
		<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/system/css/general.css" type="text/css" />
		<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/template.css" type="text/css" />
		<link rel="stylesheet" href="<?php echo $this->baseurl ?>/media/jui/css/icomoon.css" type="text/css" />
<?php	$doc->addStyleSheet($this->baseurl.'/media/jui/css/icomoon.css'); ?>
<?php	$doc->addScript('templates/' . $this->template . '/js/sticky.js'); ?>
<?php	$doc->addScript('templates/' . $this->template . '/js/elementQuery.js'); ?>
<?php	if ($this->params->get('fontsCss') != "") {?>
		<link type="text/css" rel="stylesheet" href="//fast.fonts.net/cssapi/<?php echo $this->params->get('fontsCss'); ?>"/>
<?php	}?>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php	$doc->addScript('templates/' . $this->template . '/js/jquery.sidr.js'); ?>
<!-- START Google DoubleClick Code -->
<?php	if ($this->params->get('doubleClick')) {	?>
			<script type='text/javascript'>
				(function() {
					var useSSL = 'https:' == document.location.protocol;
					var src = (useSSL ? 'https:' : 'http:') +
						'//www.googletagservices.com/tag/js/gpt.js';
				    document.write('<scr' + 'ipt src="' + src + '"></scr' + 'ipt>');
				})();
			</script>
			<script type='text/javascript'>
				googletag.cmd.push(function() {
<?php				echo $this->params->get('doubleClick');	?>
			    	googletag.pubads().enableSingleRequest();
			    	googletag.enableServices();
				});
			</script>		
<?php	}	?>
<!-- END Google DoubleClick Code -->
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
			<div class="col-p-10"><jdoc:include type="modules" name="mobile-header" /></div>
		</div>
		<div id="container">
			<div id="wrapper">
				<div class="row" id="title">
					<div class="col-12 col-s-12 col-m-12"><jdoc:include type="modules" name="title" /></div>
				</div>
				<div class="row" id="top">
					<div class="col-12 col-s-12 col-m-12"><jdoc:include type="modules" name="top" /></div>
				</div>
				<div id="sticky-anchor"></div>
				<div id="sticky">
					<div class="row" id="banners">
						<div class="col-12 col-s-12 col-m-12 col-p-0"><jdoc:include type="modules" name="banners" /></div>
					</div>
				</div>
				<div class="row" id="header">
					<div class="col-12 col-s-12 col-m-12 col-p-0"><jdoc:include type="modules" name="header" /></div>
				</div>
				<div class="row" id="main">
<?php if ($this->params->get('hideleft')) : ?>
					<div class="col-3 col-s-0 col-m-0 col-p-0" id="left"><jdoc:include type="modules" name="left" /></div>
<?php else : ?>
					<div class="col-3 col-s-4 col-m-5 col-p-0" id="left"><jdoc:include type="modules" name="left" /></div>
<?php endif ?>
<?php if($this->countModules('right') && $this->countModules('left')) : ?>
					<div class="col-6 col-s-8 col-m-7" id="component_wrapper">
<?php elseif ($this->countModules('right') || $this->countModules('left')): ?>
					<div class="col-9 col-s-8 col-m-7" id="component_wrapper">
<?php else : ?>
					<div class="col-12 col-s-12 col-m-12" id="component_wrapper">
<?php endif ?>
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
				<div class="row" id="footer">
					<div class="col-12 col-s-12 col-m-12"><jdoc:include type="modules" name="footer" /></div>
				</div>
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
				if ($win.width() < 720) {
					jQuery("#mainmenu").appendTo("#mobile-menu");
				}
			});
			$win.on("resize", function(e) {
				if ($win.width() < 720) {
					jQuery("#mainmenu").appendTo("#mobile-menu");
				}
				if ($win.width() >= 720) {
					jQuery("#mainmenu").prependTo("#left");
				}
			});
		</script>
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
	</body>
</html>