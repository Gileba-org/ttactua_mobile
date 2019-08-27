<?php
	defined('_JEXEC') or die('Restricted access');

	/** @var JDocumentHtml $this */
	$app      	= JFactory::getApplication();
	$user 		= JFactory::getUser();

	$params	  	= $app->getTemplate(true)->params;
	$menu 		= $app->getMenu();
	$config 	= JFactory::getConfig();

	// Detecting Active Variables
	$option   = $app->input->getCmd('option', '');
	$view     = $app->input->getCmd('view', '');
	$layout   = $app->input->getCmd('layout', '');
	$task     = $app->input->getCmd('task', '');
	$itemid   = $app->input->getCmd('Itemid', '');
	$format   = $app->input->getCmd('format', 'html');
	$sitename = htmlspecialchars($app->get('sitename'), ENT_QUOTES, 'UTF-8');

	// Add JavaScript Frameworks
	JHtml::_('jquery.framework');
	JHtml::_('bootstrap.framework');

	/** Count Modules Performance */
	$countRightModules	= count(JModuleHelper::getModules( 'right' ));
	$countLeftModules	= count(JModuleHelper::getModules( 'left' ));
	$countHeaderModules	= count(JModuleHelper::getModules( 'header' ));
	$countFooterModules	= count(JModuleHelper::getModules( 'footer' ));
	$countTitleModules	= count(JModuleHelper::getModules( 'title' ));
	$countTopModules	= count(JModuleHelper::getModules( 'top' ));
	$countBannerModules	= count(JModuleHelper::getModules( 'banners' ));
?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" >
	<head>
		<meta charset="utf-8" />
		<title><?php echo $this->title; ?> <?php echo htmlspecialchars($this->error->getMessage(), ENT_QUOTES, 'UTF-8'); ?></title>
		<link href="<?php echo JUri::root(true); ?>/templates/system/css/system.css" rel="stylesheet" />
		<link href="<?php echo JUri::root(true); ?>/templates/system/css/general.css" rel="stylesheet" />
		<link href="<?php echo JUri::root(true); ?>/media/jui/css/icomoon.css" rel="stylesheet" />
		<link href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/template.css" rel="stylesheet" />
		<link href="<?php echo Juri::root(true); ?>/modules/mod_cookiesaccept/screen.css" rel="stylesheet" />
		<script src="/media/jui/js/jquery.min.js"></script>
		<script src="/media/jui/js/jquery-noconflict.js"></script>
		<script src="/media/jui/js/jquery-migrate.min.js"></script>
<?php if ($app->get('debug_lang', '0') == '1' || $app->get('debug', '0') == '1') : ?>
		<link href="<?php echo JUri::root(true); ?>/media/cms/css/debug.css" rel="stylesheet" />
<?php endif; ?>
<?php
if($countBannerModules) {
	?>
		<script src="<?php echo JUri::root(true); ?>/templates/<?php echo $this->template; ?>/js/sticky.js"></script>
<?php } ?>

		<script src="<?php echo JUri::root(true); ?>/templates/<?php echo $this->template; ?>/js/elementQuery.js"></script>
		<script src="<?php echo JUri::root(true); ?>/templates/<?php echo $this->template; ?>/js/jquery.sidr.js"></script>
<?php
if ($params->get('fontsCss') != "") {
	?>
		<link href="https://fast.fonts.net/cssapi/<?php echo $params->get('fontsCss'); ?>" rel="stylesheet" />
	<?php
}
?>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php	if ($params->get('doubleClick')) {	?>
<!-- START Google DoubleClick Code -->
			<script>
				(function() {
					var useSSL = 'https:' == document.location.protocol;
					var src = (useSSL ? 'https:' : 'http:') +
						'//www.googletagservices.com/tag/js/gpt.js';
					document.write('<scr' + 'ipt src="' + src + '"></scr' + 'ipt>');
				})();
			</script>
			<script>
				googletag.cmd.push(function() {
	<?php				echo $params->get('doubleClick');	?>
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
				<button class="hamburger hamburger--<?php echo $params->get('hamburgerstyle'); ?>" type="button">
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
						<?php
						$modules = JModuleHelper::getModules('mobile_header');
						$attribs['style'] = 'xhtml';
						foreach ($modules AS $module) {
							echo JModuleHelper::renderModule($module, $attribs);
						}						?>
					   </div>
				</div>
			</div>
		</div>
		<div id="container">
			<div id="wrapper">
<?php if($countTitleModules) : ?>
				<div class="row" id="title">
					<div class="col-12 col-s-12 col-m-12 col-p-0">
												<?php
												$modules = JModuleHelper::getModules('title');
												$attribs['style'] = 'xhtml';
												foreach ($modules AS $module) {
													echo JModuleHelper::renderModule($module, $attribs);
												}						?>

					</div>
				</div>
<?php endif ?>
<?php if($countTopModules) : ?>
				<div class="row" id="top">
					<div class="col-12 col-s-12 col-m-12 col-p-0">
												<?php
												$modules = JModuleHelper::getModules('top');
												$attribs['style'] = 'xhtml';
												foreach ($modules AS $module) {
													echo JModuleHelper::renderModule($module, $attribs);
												}						?>
</div>
				</div>
<?php endif ?>
<?php if($countBannerModules) : ?>
				<div id="sticky-anchor"></div>
				<div id="sticky">
					<div class="row" id="banners">
						<div class="col-12 col-s-12 col-m-12">
													<?php
													$modules = JModuleHelper::getModules('banners');
													$attribs['style'] = 'inherit';
													foreach ($modules AS $module) {
														echo JModuleHelper::renderModule($module, $attribs);
													}						?>

						</div>
					</div>
				</div>
<?php endif ?>
<?php if($countHeaderModules) : ?>
				<div class="row" id="header">
					<div class="col-12 col-s-12 col-m-12 col-p-0">
												<?php
												$modules = JModuleHelper::getModules('header');
												$attribs['style'] = 'inherit';
												foreach ($modules AS $module) {
													echo JModuleHelper::renderModule($module, $attribs);
												}						?>

					</div>
				</div>
<?php endif ?>
				<div class="row" id="main">
<?php if (!$params->get('hideleft')) : ?>
					<div class="col-3 col-s-4 col-m-5 col-p-0" id="left">
												<?php
												$modules = JModuleHelper::getModules('left');
												$attribs['style'] = 'xhtml';
												foreach ($modules AS $module) {
													echo JModuleHelper::renderModule($module, $attribs);
												}						?>

					</div>
<?php endif ?>
					<div class="col-9 col-s-8 col-m-7" id="component_wrapper">
						<div id="messages"></div>
						<div id="component">
												<!-- Begin Content -->
					<h1 class="page-header"><?php echo JText::_('JERROR_LAYOUT_PAGE_NOT_FOUND'); ?></h1>
					<div style="padding-left: 20px;">
						<div>
							<div class="col-6" style="padding-right:10px;">
								<p><strong><?php echo JText::_('JERROR_LAYOUT_ERROR_HAS_OCCURRED_WHILE_PROCESSING_YOUR_REQUEST'); ?></strong></p>
								<p><?php echo JText::_('JERROR_LAYOUT_NOT_ABLE_TO_VISIT'); ?></p>
								<ul>
									<li><?php echo JText::_('JERROR_LAYOUT_AN_OUT_OF_DATE_BOOKMARK_FAVOURITE'); ?></li>
									<li><?php echo JText::_('JERROR_LAYOUT_MIS_TYPED_ADDRESS'); ?></li>
									<li><?php echo JText::_('JERROR_LAYOUT_SEARCH_ENGINE_OUT_OF_DATE_LISTING'); ?></li>
									<li><?php echo JText::_('JERROR_LAYOUT_YOU_HAVE_NO_ACCESS_TO_THIS_PAGE'); ?></li>
								</ul>
							</div>
							<div class="col-6" style="padding-left:10px;">
								<?php if ($format === 'html' && JModuleHelper::getModule('mod_search')) : ?>
									<p><strong><?php echo JText::_('JERROR_LAYOUT_SEARCH'); ?></strong></p>
									<p><?php echo JText::_('JERROR_LAYOUT_SEARCH_PAGE'); ?></p>
									<?php $module = JModuleHelper::getModule('mod_search'); ?>
									<?php echo JModuleHelper::renderModule($module); ?>
								<?php endif; ?>
								<p style='display: block; content: ""; clear: both; padding-top: 20px;'><?php echo JText::_('JERROR_LAYOUT_GO_TO_THE_HOME_PAGE'); ?></p>
								<p><a href="<?php echo $this->baseurl; ?>/index.php" class="btn"><span class="icon-home" aria-hidden="true"></span> <?php echo JText::_('JERROR_LAYOUT_HOME_PAGE'); ?></a></p>
							</div>
						</div>
						<hr class="col-12" />
						<p class="col-12"> <?php echo JText::_('JERROR_LAYOUT_PLEASE_CONTACT_THE_SYSTEM_ADMINISTRATOR'); ?></p>
						<blockquote class="col-12" >
							<span class="label label-inverse"><?php echo $this->error->getCode(); ?></span> <?php echo htmlspecialchars($this->error->getMessage(), ENT_QUOTES, 'UTF-8');?>
							<?php if ($this->debug) : ?>
								<br/><?php echo htmlspecialchars($this->error->getFile(), ENT_QUOTES, 'UTF-8');?>:<?php echo $this->error->getLine(); ?>
							<?php endif; ?>
						</blockquote>
						<?php if ($this->debug) : ?>
							<div>
								<?php echo $this->renderBacktrace(); ?>
								<?php // Check if there are more Exceptions and render their data as well ?>
								<?php if ($this->error->getPrevious()) : ?>
									<?php $loop = true; ?>
									<?php // Reference $this->_error here and in the loop as setError() assigns errors to this property and we need this for the backtrace to work correctly ?>
									<?php // Make the first assignment to setError() outside the loop so the loop does not skip Exceptions ?>
									<?php $this->setError($this->_error->getPrevious()); ?>
									<?php while ($loop === true) : ?>
										<p><strong><?php echo JText::_('JERROR_LAYOUT_PREVIOUS_ERROR'); ?></strong></p>
										<p>
											<?php echo htmlspecialchars($this->_error->getMessage(), ENT_QUOTES, 'UTF-8'); ?>
											<br/><?php echo htmlspecialchars($this->_error->getFile(), ENT_QUOTES, 'UTF-8');?>:<?php echo $this->_error->getLine(); ?>
										</p>
										<?php echo $this->renderBacktrace(); ?>
										<?php $loop = $this->setError($this->_error->getPrevious()); ?>
									<?php endwhile; ?>
									<?php // Reset the main error object to the base error ?>
									<?php $this->setError($this->error); ?>
								<?php endif; ?>
							</div>
						<?php endif; ?>
					</div>
					<!-- End Content -->

						</div>
					</div>
<?php if ($params->get('hideleft')) : ?>
					<div class="col-3 col-s-4 col-m-5 col-p-0" id="right">
												<?php
												$modules = JModuleHelper::getModules('right');
												$attribs['style'] = 'ttactua';
												foreach ($modules AS $module) {
													echo JModuleHelper::renderModule( $module, $attribs );
												}						?>

					</div>
<?php endif ?>
				</div>			 
<?php if($countFooterModules) : ?>
				<div class="row" id="footer">
					<div class="col-12 col-s-12 col-m-12">
												<?php
												$modules = JModuleHelper::getModules('footer');
												$attribs['style'] = 'inherit';
												foreach ($modules AS $module) {
													echo JModuleHelper::renderModule($module, $attribs);
												}						?>

					</div>
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
<?php if($countBannerModules) : ?>
		<!-- Sticky and turning banners -->
		<script>
			moveScroller();
		</script>
<?php endif ?>
<?php	if ($params->get('analytics')) {	?>
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
