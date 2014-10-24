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
        
	js('input:hidden.user_id').each(function(){
		var name = js(this).attr('name');
		if(name.indexOf('user_idhidden')){
			js('#jform_user_id option[value="'+js(this).val()+'"]').attr('selected',true);
		}
	});
	js("#jform_user_id").trigger("liszt:updated");
	js('input:hidden.brand_id').each(function(){
		var name = js(this).attr('name');
		if(name.indexOf('brand_idhidden')){
			js('#jform_brand_id option[value="'+js(this).val()+'"]').attr('selected',true);
		}
	});
	js("#jform_brand_id").trigger("liszt:updated");
    });

    Joomla.submitbutton = function(task)
    {
        if (task == 'userbrandmapping.cancel') {
            Joomla.submitform(task, document.getElementById('userbrandmapping-form'));
        }
        else {
            
            if (task != 'userbrandmapping.cancel' && document.formvalidator.isValid(document.id('userbrandmapping-form'))) {
                
                Joomla.submitform(task, document.getElementById('userbrandmapping-form'));
            }
            else {
                alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED')); ?>');
            }
        }
    }
</script>

<form action="<?php echo JRoute::_('index.php?option=com_dolo&layout=edit&id=' . (int) $this->item->id); ?>" method="post" enctype="multipart/form-data" name="adminForm" id="userbrandmapping-form" class="form-validate">

    <div class="form-horizontal">
        <?php echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'general')); ?>

        <?php echo JHtml::_('bootstrap.addTab', 'myTab', 'general', JText::_('COM_DOLO_TITLE_USERBRANDMAPPING', true)); ?>
        <div class="row-fluid">
            <div class="span10 form-horizontal">
                <fieldset class="adminform">

                    				<input type="hidden" name="jform[id]" value="<?php echo $this->item->id; ?>" />
				<input type="hidden" name="jform[state]" value="<?php echo $this->item->state; ?>" />

				<?php if(empty($this->item->created_by)){ ?>
					<input type="hidden" name="jform[created_by]" value="<?php echo JFactory::getUser()->id; ?>" />

				<?php } 
				else{ ?>
					<input type="hidden" name="jform[created_by]" value="<?php echo $this->item->created_by; ?>" />

				<?php } ?>			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('user_id'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('user_id'); ?></div>
			</div>

			<?php
				foreach((array)$this->item->user_id as $value): 
					if(!is_array($value)):
						echo '<input type="hidden" class="user_id" name="jform[user_idhidden]['.$value.']" value="'.$value.'" />';
					endif;
				endforeach;
			?>			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('brand_id'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('brand_id'); ?></div>
			</div>

			<?php
				foreach((array)$this->item->brand_id as $value): 
					if(!is_array($value)):
						echo '<input type="hidden" class="brand_id" name="jform[brand_idhidden]['.$value.']" value="'.$value.'" />';
					endif;
				endforeach;
			?>

                </fieldset>
            </div>
        </div>
        <?php echo JHtml::_('bootstrap.endTab'); ?>
        
        

        <?php echo JHtml::_('bootstrap.endTabSet'); ?>

        <input type="hidden" name="task" value="" />
        <?php echo JHtml::_('form.token'); ?>

    </div>
</form>