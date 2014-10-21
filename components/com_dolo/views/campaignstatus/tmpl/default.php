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

//Load admin language file
$lang = JFactory::getLanguage();
$lang->load('com_dolo', JPATH_ADMINISTRATOR);
$canEdit = JFactory::getUser()->authorise('core.edit', 'com_dolo');
if (!$canEdit && JFactory::getUser()->authorise('core.edit.own', 'com_dolo')) {
	$canEdit = JFactory::getUser()->id == $this->item->created_by;
}
?>
<?php if ($this->item && $this->item->state == 1) : ?>

    <div class="item_fields">
        <table class="table">
            <tr>
			<th><?php echo JText::_('COM_DOLO_FORM_LBL_CAMPAIGNSTATUS_ID'); ?></th>
			<td><?php echo $this->item->id; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_DOLO_FORM_LBL_CAMPAIGNSTATUS_CREATED_BY'); ?></th>
			<td><?php echo $this->item->created_by_name; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_DOLO_FORM_LBL_CAMPAIGNSTATUS_STATUS'); ?></th>
			<td><?php echo $this->item->status; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_DOLO_FORM_LBL_CAMPAIGNSTATUS_STATE'); ?></th>
			<td>
			<i class="icon-<?php echo ($this->item->state == 1) ? 'publish' : 'unpublish'; ?>"></i></td>
</tr>

        </table>
    </div>
    <?php if($canEdit): ?>
		<a class="btn" href="<?php echo JRoute::_('index.php?option=com_dolo&task=campaignstatus.edit&id='.$this->item->id); ?>"><?php echo JText::_("COM_DOLO_EDIT_ITEM"); ?></a>
	<?php endif; ?>
								<?php if(JFactory::getUser()->authorise('core.delete','com_dolo')):?>
									<a class="btn" href="<?php echo JRoute::_('index.php?option=com_dolo&task=campaignstatus.remove&id=' . $this->item->id, false, 2); ?>"><?php echo JText::_("COM_DOLO_DELETE_ITEM"); ?></a>
								<?php endif; ?>
    <?php
else:
    echo JText::_('COM_DOLO_ITEM_NOT_LOADED');
endif;
?>
