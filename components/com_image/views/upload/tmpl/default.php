<?php
/**
 * @version     1.0.0
 * @package     com_image
 * @copyright   
 * @license     
 * @author       <> - 
 */
// no direct access
defined('_JEXEC') or die;

//Load admin language file
$lang = JFactory::getLanguage();
$lang->load('com_image', JPATH_ADMINISTRATOR);
$canEdit = JFactory::getUser()->authorise('core.edit', 'com_image');
if (!$canEdit && JFactory::getUser()->authorise('core.edit.own', 'com_image')) {
	$canEdit = JFactory::getUser()->id == $this->item->created_by;
}
?>
<?php if ($this->item && $this->item->state == 1) : ?>

    <div class="item_fields">
        <table class="table">
            <tr>
			<th><?php echo JText::_('COM_IMAGE_FORM_LBL_UPLOAD_ID'); ?></th>
			<td><?php echo $this->item->id; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_IMAGE_FORM_LBL_UPLOAD_STATE'); ?></th>
			<td>
			<i class="icon-<?php echo ($this->item->state == 1) ? 'publish' : 'unpublish'; ?>"></i></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_IMAGE_FORM_LBL_UPLOAD_CREATED_BY'); ?></th>
			<td><?php echo $this->item->created_by_name; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_IMAGE_FORM_LBL_UPLOAD_IMAGE'); ?></th>
			<td><?php echo $this->item->image; ?></td>
</tr>

        </table>
    </div>
    <?php if($canEdit): ?>
		<a class="btn" href="<?php echo JRoute::_('index.php?option=com_image&task=upload.edit&id='.$this->item->id); ?>"><?php echo JText::_("COM_IMAGE_EDIT_ITEM"); ?></a>
	<?php endif; ?>
								<?php if(JFactory::getUser()->authorise('core.delete','com_image')):?>
									<a class="btn" href="<?php echo JRoute::_('index.php?option=com_image&task=upload.remove&id=' . $this->item->id, false, 2); ?>"><?php echo JText::_("COM_IMAGE_DELETE_ITEM"); ?></a>
								<?php endif; ?>
    <?php
else:
    echo JText::_('COM_IMAGE_ITEM_NOT_LOADED');
endif;
?>
