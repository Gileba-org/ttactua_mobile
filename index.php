<?php
	defined( '_JEXEC' ) or die( 'Restricted access' );
	
	$app      = JFactory::getApplication();
	$doc      = JFactory::getDocument();
	$params	  = $app->getTemplate(true)->params;
	
	JHtml::_('jquery.framework');
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" 
   xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" >
   <head>
		<jdoc:include type="head" />
		<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/system/css/system.css" type="text/css" />
		<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/system/css/general.css" type="text/css" />
		<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/template.css" type="text/css" />
<?php	if ($this->params->get('fontsCss') != "") {?>
		<link type="text/css" rel="stylesheet" href="//fast.fonts.net/cssapi/<?php echo $this->params->get('fontsCss'); ?>"/>
<?php	}?>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php	$doc->addScript('templates/' . $this->template . '/js/jquery.sidr.js'); ?>
<!-- START Google DoubleClick Code -->
<?php	if ($this->params->get('doubleClickActivate')) {	?>
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
		<div id="sidr">
			<div class="col-12" id="mobile-menu"><jdoc:include type="modules" name="mobile-menu" /></div>
		</div>
		<div id="mobile-header" class="col-p-only">
			<div class="col-p-2">
				<p><a id="simple-menu" href="#sidr"><span class="hamburger"></span></p>
			</div>
			<div class="col-p-10"><jdoc:include type="modules" name="mobile-header" /></div>
		</div>
		<div id="wrapper">
			<div class="row" id="title">
				<div class="col-12 col-s-12 col-m-12"><jdoc:include type="modules" name="title" /></div>
			</div>
			<div class="row" id="top">
				<div class="col-12 col-s-12 col-m-12"><jdoc:include type="modules" name="top" /></div>
			</div>
			<div class="row" id="banners">
				<div class="col-12 col-s-12 col-m-12"><jdoc:include type="modules" name="banners" /></div>
			</div>
			<div class="row" id="header">
				<div class="col-12 col-s-12 col-m-12"><jdoc:include type="modules" name="header" /></div>
			</div>
			<div class="row" id="main">
				<div class="col-3 col-s-4 col-m-4 col-p-0" id="left"><jdoc:include type="modules" name="left" /></div>
				<div class="col-6 col-s-8 col-m-8" id="component"><jdoc:include type="component" /></div>
				<div class="col-3 col-s-0 col-m-0 col-p-0" id="right"><jdoc:include type="modules" name="right" /></div>
			</div>			 
			<div class="row" id="footer">
				<div class="col-12 col-s-12 col-m-12"><jdoc:include type="modules" name="footer" /></div>
			</div>
		</div>
    <!-- Your code -->
    <script>

    jQuery(document).ready(function () {
		jQuery('#simple-menu').sidr({
      	});
    });
    </script>

	</body>
</html>