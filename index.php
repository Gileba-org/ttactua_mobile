<?php
	defined( '_JEXEC' ) or die( 'Restricted access' );
	
	$app    = 	JFactory::getApplication();
	$params	= 	$app->getTemplate(true)->params;
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" 
   xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" >
   <head>
		<jdoc:include type="head" />
		<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/system/css/system.css" type="text/css" />
		<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/system/css/general.css" type="text/css" />
		<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/template.css" type="text/css" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php
		if ($this->params->get('doubleClickActivate')) {
?>
<!-- START Google DoubleClick Code -->
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
<?php
				echo $this->params->get('doubleClick');
?>
			    	googletag.pubads().enableSingleRequest();
			    	googletag.enableServices();
				});
			</script>		
<!-- END Google DoubleClick Code -->
<?php
		}
?>
	</head>
	<body>
		<div id="wrapper">
			<div class="row">
				<div class="col-12 col-m-12"><jdoc:include type="modules" name="title" /></div>
			</div>
			<div class="row">
				<div class="col-12 col-m-12"><jdoc:include type="modules" name="top" /></div>
			</div>
			<div class="row">
				<div class="col-12 col-m-12"><jdoc:include type="modules" name="banners" /></div>
			</div>
			<div class="row">
				<div class="col-12 col-m-12"><jdoc:include type="modules" name="header" /></div>
			</div>
			<div class="row">
				<div class="col-3 col-m-4"><jdoc:include type="modules" name="left" /></div>
				<div class="col-6 col-m-8"><jdoc:include type="component" /></div>
				<div class="col-3 col-m-0"><jdoc:include type="modules" name="right" /></div>
			</div>			 
			<div class="row">
				<div class="col-12 col-m-12"><jdoc:include type="modules" name="footer" /></div>
			</div>
		</div>
	</body>
</html>