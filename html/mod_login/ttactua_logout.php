<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_login
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;

// HTMLHelper::_('behavior.keepalive');
?>
<form action="<?php echo Route::_('index.php', true, $params->get('usesecure', 0)); ?>" method="post" id="login-form" class="form-vertical">
	<div class="logout-button">
		<input type="submit" name="Submit" class="btn" value="<?php echo Text::_('JLOGOUT'); ?>" />
		<input type="hidden" name="option" value="com_users" />
		<input type="hidden" name="task" value="user.logout" />
		<input type="hidden" name="return" value="<?php echo $return; ?>" />
		<?php echo HTMLHelper::_('form.token'); ?>
	</div>
</form>
