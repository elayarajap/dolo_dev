<?php
/**
 * @version		2.6.x
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.net
 * @copyright	Copyright (c) 2006 - 2014 JoomlaWorks Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die;

?>

<form class="comment-form form-validate" action="<?php echo JURI::root(true); ?>/index.php" method="post" id="comment-form">
	<h3><?php echo JText::_('K2_LEAVE_A_COMMENT') ?></h3>
	<div class="row">
		<div class="col-md-4">
			<input name="userName" id="userName" type="text" placeholder="<?php echo JText::_('TPL_MARBLE_NAME_REQUIRED_TEXT');?>">
		</div>
		<div class="col-md-4">
			<input name="commentEmail" id="commentEmail" type="text" placeholder="<?php echo JText::_('TPL_MARBLE_EMAIL_REQUIRED_TEXT');?>">
		</div>
		<div class="col-md-4">
			<input name="commentURL" id="commentURL" type="text" placeholder="<?php echo JText::_('TPL_MARBLE_WEBSITE_TEXT');?>">
		</div>
	</div>
	<textarea name="commentText" id="commentText" placeholder="<?php echo JText::_('TPL_MARBLE_YOUR_MESSAGE_REQUIRED_TEXT');?>"></textarea>
	<?php if($this->params->get('recaptcha') && ($this->user->guest || $this->params->get('recaptchaForRegistered', 1))): ?>
	<label class="formRecaptcha"><?php echo JText::_('K2_ENTER_THE_TWO_WORDS_YOU_SEE_BELOW'); ?></label>
	<div id="recaptcha"></div>
	<?php endif; ?>
	<input type="submit" id="submitCommentButton" value="<?php echo JText::_('TPL_MARBLE_SUBMIT_BUTTON_TEXT');?>">
	<br/><br/><span id="formLog"></span>

	<input type="hidden" name="option" value="com_k2" />
	<input type="hidden" name="view" value="item" />
	<input type="hidden" name="task" value="comment" />
	<input type="hidden" name="itemID" value="<?php echo JRequest::getInt('id'); ?>" />
	<?php echo JHTML::_('form.token'); ?>
</form>