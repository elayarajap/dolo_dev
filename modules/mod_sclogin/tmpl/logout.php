<?php
/**
 * @package         SCLogin
 * @copyright (c)   2009-2014 by SourceCoast - All Rights Reserved
 * @license         http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @version         Release v4.1.1
 * @build-date      2014/07/14
 */

defined('_JEXEC') or die('Restricted access');

?>
<div class="sclogin sourcecoast">

<?php
if ($params->get('enableProfilePic'))
    echo $helper->getSocialAvatar($registerType, $helper->profileLink);

if ($params->get('greetingName') != 2)
{
    $user = JFactory::getUser();
    if ($params->get('greetingName') == 0)
        $name = $user->get('username');
    else
        $name = $user->get('name');
    echo '<div class="sclogin-greeting">' . JText::sprintf('MOD_SCLOGIN_WELCOME', $name) . '</div>';
}

if ($params->get('showLogoutButton'))
{ ?>
    <div class="sclogout-button">
        <div class="sclogin-joomla-login">
            <form action="<?php echo JRoute::_('index.php', true, $params->get('usesecure'));?>" method="post" id="sclogin-form">
                <div class="logout-button" id="scLogoutButton">
                    <input type="submit" name="Submit" class="button btn btn-primary" value="<?php echo JText::_('JLOGOUT');?>" />
                    <input type="hidden" name="option" value="com_users" />
                    <input type="hidden" name="task" value="user.logout" />
                    <input type="hidden" name="return" value="<?php echo $jLogoutUrl;?>" />
                    <?php echo JHtml::_('form.token')?>
                </div>
            </form>
        </div>
    </div>
<?php
}

if ($params->get('showUserMenu'))
{
    echo $helper->getUserMenu($params->get('showUserMenu'), $params->get('userMenuStyle'));
}

if ($params->get('showConnectButton'))
{ ?>
    <div class="sclogin-social-connect">
        <?php echo $helper->getReconnectButtons($params->get('socialButtonsOrientation'), $params->get('socialButtonsAlignment'));?>
    </div>
<?php
}

echo $helper->getPoweredByLink();
?>
    <div class="clearfix"></div>
</div>
