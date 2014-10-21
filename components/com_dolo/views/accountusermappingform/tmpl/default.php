<?php
/**
 * @version     1.0.0
 * @package     com_dolo
 * @copyright   
 * @license     
 * @author       <> - 
 */
// no direct access
defined('_JEXEC') or die;

JHtml::_('behavior.keepalive');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');

//Load admin language file
$lang = JFactory::getLanguage();
$lang->load('com_dolo', JPATH_ADMINISTRATOR);
$doc = JFactory::getDocument();
$doc->addScript(JUri::base() . '/components/com_dolo/assets/js/form.js');


?>
</style>
<script type="text/javascript">
    getScript('//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js', function() {
        jQuery(document).ready(function() {
            jQuery('#form-accountusermapping').submit(function(event) {
                
            });

            
			jQuery('input:hidden.user_id').each(function(){
				var name = jQuery(this).attr('name');
				if(name.indexOf('user_idhidden')){
					jQuery('#jform_user_id option[value="' + jQuery(this).val() + '"]').attr('selected',true);
				}
			});
					jQuery("#jform_user_id").trigger("liszt:updated");
			jQuery('input:hidden.account_id').each(function(){
				var name = jQuery(this).attr('name');
				if(name.indexOf('account_idhidden')){
					jQuery('#jform_account_id option[value="' + jQuery(this).val() + '"]').attr('selected',true);
				}
			});
					jQuery("#jform_account_id").trigger("liszt:updated");
        });
    });

</script>

<div class="accountusermapping-edit front-end-edit">
    <?php if (!empty($this->item->id)): ?>
        <h1>Edit <?php echo $this->item->id; ?></h1>
    <?php else: ?>
        <h1>Add</h1>
    <?php endif; ?>

    <form id="form-accountusermapping" action="<?php echo JRoute::_('index.php?option=com_dolo&task=accountusermapping.save'); ?>" method="post" class="form-validate form-horizontal" enctype="multipart/form-data">
        
	<input type="hidden" name="jform[id]" value="<?php echo $this->item->id; ?>" />

	<input type="hidden" name="jform[state]" value="<?php echo $this->item->state; ?>" />

	<?php if(empty($this->item->created_by)): ?>
		<input type="hidden" name="jform[created_by]" value="<?php echo JFactory::getUser()->id; ?>" />
	<?php else: ?>
		<input type="hidden" name="jform[created_by]" value="<?php echo $this->item->created_by; ?>" />
	<?php endif; ?>
	<div class="control-group">
		<div class="control-label"><?php echo $this->form->getLabel('user_id'); ?></div>
		<div class="controls"><?php echo $this->form->getInput('user_id'); ?></div>
	</div>
	<?php foreach((array)$this->item->user_id as $value): ?>
		<?php if(!is_array($value)): ?>
			<input type="hidden" class="user_id" name="jform[user_idhidden][<?php echo $value; ?>]" value="<?php echo $value; ?>" />';
		<?php endif; ?>
	<?php endforeach; ?>
	<div class="control-group">
		<div class="control-label"><?php echo $this->form->getLabel('account_id'); ?></div>
		<div class="controls"><?php echo $this->form->getInput('account_id'); ?></div>
	</div>
	<?php foreach((array)$this->item->account_id as $value): ?>
		<?php if(!is_array($value)): ?>
			<input type="hidden" class="account_id" name="jform[account_idhidden][<?php echo $value; ?>]" value="<?php echo $value; ?>" />';
		<?php endif; ?>
	<?php endforeach; ?>
        <div class="control-group">
            <div class="controls">
                <button type="submit" class="validate btn btn-primary"><?php echo JText::_('JSUBMIT'); ?></button>
                <a class="btn" href="<?php echo JRoute::_('index.php?option=com_dolo&task=accountusermappingform.cancel'); ?>" title="<?php echo JText::_('JCANCEL'); ?>"><?php echo JText::_('JCANCEL'); ?></a>
            </div>
        </div>
        
        <input type="hidden" name="option" value="com_dolo" />
        <input type="hidden" name="task" value="accountusermappingform.save" />
        <?php echo JHtml::_('form.token'); ?>
    </form>
</div>
