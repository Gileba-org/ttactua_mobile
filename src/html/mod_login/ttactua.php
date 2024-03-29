<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_login
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Uri\Uri;

JLoader::register('UsersHelperRoute', JPATH_SITE . '/components/com_users/helpers/route.php');

// HTMLHelper::_('behavior.keepalive');
HTMLHelper::_('bootstrap.tooltip');
$path   = Uri::base(true) . '/templates/' . $app->getTemplate() . '/';

?>
<div id="ttactua-login">
<form action="<?php echo Route::_('index.php', true, $params->get('usesecure', 0)); ?>" method="post" id="login-form" class="form-inline">
	<?php if ($params->get('pretext')) : ?>
		<div class="pretext">
			<p><?php echo $params->get('pretext'); ?></p>
		</div>
	<?php endif; ?>
	<div class="userdata">
		<div id="form-login-username" class="control-group">
			<div class="controls">
				<div class="input-prepend">
					<input id="modlgn-username" type="text" name="username" class="input-medium ttactua" tabindex="0" size="18"
						placeholder="<?php echo Text::_('MOD_LOGIN_VALUE_USERNAME'); ?>" />
				</div>
			</div>
		</div>
		<div id="form-login-password" class="control-group">
			<div class="controls">
				<div class="input-prepend">
					<input id="modlgn-passwd" type="password" name="password" class="input-medium" tabindex="0" size="18"
						placeholder="<?php echo Text::_('JGLOBAL_PASSWORD'); ?>" />
				</div>
			</div>
		</div>
		<div id="form-login-submit" class="control-group">
			<div class="controls">
				<button type="submit" tabindex="0" name="Submit" class="btn login-button"><?php echo Text::_('JLOGIN'); ?></button>
			</div>
		</div>
		<?php
			$usersConfig = ComponentHelper::getParams('com_users'); ?>
			<?php if ($usersConfig->get('allowUserRegistration')) : ?>
				<div>
					<a href="
						<?php echo Route::_('index.php?option=com_users&view=registration&Itemid=' . UsersHelperRoute::getRegistrationRoute()); ?>
						">
						<img src="<?php echo $path; ?>images/registration.png" alt="<?php echo Text::_('MOD_LOGIN_REGISTER'); ?>" />
					</a>
				</div>
			<?php endif; ?>
				<div>
					<a href="<?php echo Route::_('index.php?option=com_users&view=remind&Itemid=' . UsersHelperRoute::getRemindRoute()); ?>">
						<img src="<?php echo $path; ?>images/lost_username.png" alt="<?php echo Text::_('MOD_LOGIN_FORGOT_YOUR_USERNAME'); ?>" />
					</a>
				</div>
				<div>
					<a href="<?php echo Route::_('index.php?option=com_users&view=reset&Itemid=' . UsersHelperRoute::getResetRoute()); ?>">
						<img src="<?php echo $path; ?>images/lost_password.png" alt="<?php echo Text::_('MOD_LOGIN_FORGOT_YOUR_PASSWORD'); ?>" />
					</a>
				</div>
		<input type="hidden" name="option" value="com_users" />
		 <input type="hidden" name="task" value="user.login" />
		<input type="hidden" name="return" value="<?php echo $return; ?>" />
		<?php echo HTMLHelper::_('form.token'); ?>
	</div>
	<?php if ($params->get('posttext')) : ?>
		<div class="posttext">
			<p><?php echo $params->get('posttext'); ?></p>
		</div>
	<?php endif; ?>
</form>
</div>
