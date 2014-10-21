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

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');
JHtml::_('behavior.keepalive');

// Import CSS
$document = JFactory::getDocument();
$document->addStyleSheet('components/com_dolo/assets/css/dolo.css');
?>
<script type="text/javascript">
    js = jQuery.noConflict();
    js(document).ready(function() {
        
	js('input:hidden.brandid').each(function(){
		var name = js(this).attr('name');
		if(name.indexOf('brandidhidden')){
			js('#jform_brandid option[value="'+js(this).val()+'"]').attr('selected',true);
		}
	});
	js("#jform_brandid").trigger("liszt:updated");
	js('input:hidden.campaigntype_id').each(function(){
		var name = js(this).attr('name');
		if(name.indexOf('campaigntype_idhidden')){
			js('#jform_campaigntype_id option[value="'+js(this).val()+'"]').attr('selected',true);
		}
	});
	js("#jform_campaigntype_id").trigger("liszt:updated");
	js('input:hidden.campaignstatus_id').each(function(){
		var name = js(this).attr('name');
		if(name.indexOf('campaignstatus_idhidden')){
			js('#jform_campaignstatus_id option[value="'+js(this).val()+'"]').attr('selected',true);
		}
	});
	js("#jform_campaignstatus_id").trigger("liszt:updated");
	js('input:hidden.collaborators').each(function(){
		var name = js(this).attr('name');
		if(name.indexOf('collaboratorshidden')){
			js('#jform_collaborators option[value="'+js(this).val()+'"]').attr('selected',true);
		}
	});
	js("#jform_collaborators").trigger("liszt:updated");
    });

    Joomla.submitbutton = function(task)
    {
        if (task == 'campaign.cancel') {
            Joomla.submitform(task, document.getElementById('campaign-form'));
        }
        else {
            
            if (task != 'campaign.cancel' && document.formvalidator.isValid(document.id('campaign-form'))) {
                
	if(js('#jform_collaborators option:selected').length == 0){
		js("#jform_collaborators option[value=0]").attr('selected','selected');
	}
                Joomla.submitform(task, document.getElementById('campaign-form'));
            }
            else {
                alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED')); ?>');
            }
        }
    }
</script>

<form action="<?php echo JRoute::_('index.php?option=com_dolo&layout=edit&id=' . (int) $this->item->id); ?>" method="post" enctype="multipart/form-data" name="adminForm" id="campaign-form" class="form-validate">

    <div class="form-horizontal">
        <?php echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'general')); ?>

        <?php echo JHtml::_('bootstrap.addTab', 'myTab', 'general', JText::_('COM_DOLO_TITLE_CAMPAIGN', true)); ?>
        <div class="row-fluid">
            <div class="span10 form-horizontal">
                <fieldset class="adminform">

                    				<input type="hidden" name="jform[id]" value="<?php echo $this->item->id; ?>" />

				<?php if(empty($this->item->created_by)){ ?>
					<input type="hidden" name="jform[created_by]" value="<?php echo JFactory::getUser()->id; ?>" />

				<?php } 
				else{ ?>
					<input type="hidden" name="jform[created_by]" value="<?php echo $this->item->created_by; ?>" />

				<?php } ?>			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('name'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('name'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('start_date'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('start_date'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('end_date'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('end_date'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('brandid'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('brandid'); ?></div>
			</div>

			<?php
				foreach((array)$this->item->brandid as $value): 
					if(!is_array($value)):
						echo '<input type="hidden" class="brandid" name="jform[brandidhidden]['.$value.']" value="'.$value.'" />';
					endif;
				endforeach;
			?>			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('campaigntype_id'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('campaigntype_id'); ?></div>
			</div>

			<?php
				foreach((array)$this->item->campaigntype_id as $value): 
					if(!is_array($value)):
						echo '<input type="hidden" class="campaigntype_id" name="jform[campaigntype_idhidden]['.$value.']" value="'.$value.'" />';
					endif;
				endforeach;
			?>			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('campaignstatus_id'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('campaignstatus_id'); ?></div>
			</div>

			<?php
				foreach((array)$this->item->campaignstatus_id as $value): 
					if(!is_array($value)):
						echo '<input type="hidden" class="campaignstatus_id" name="jform[campaignstatus_idhidden]['.$value.']" value="'.$value.'" />';
					endif;
				endforeach;
			?>			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('impressions'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('impressions'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('hero_images'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('hero_images'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('keywords'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('keywords'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('collaborators'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('collaborators'); ?></div>
			</div>

			<?php
				foreach((array)$this->item->collaborators as $value): 
					if(!is_array($value)):
						echo '<input type="hidden" class="collaborators" name="jform[collaboratorshidden]['.$value.']" value="'.$value.'" />';
					endif;
				endforeach;
			?>				<input type="hidden" name="jform[state]" value="<?php echo $this->item->state; ?>" />


                </fieldset>
            </div>
        </div>
        <?php echo JHtml::_('bootstrap.endTab'); ?>
        
        

        <?php echo JHtml::_('bootstrap.endTabSet'); ?>

        <input type="hidden" name="task" value="" />
        <?php echo JHtml::_('form.token'); ?>

    </div>
</form>