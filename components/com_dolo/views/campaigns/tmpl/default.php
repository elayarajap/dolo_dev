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
JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('formbehavior.chosen', 'select');

$user = JFactory::getUser();
$userId = $user->get('id');
$listOrder = $this->state->get('list.ordering');
$listDirn = $this->state->get('list.direction');
$canCreate = $user->authorise('core.create', 'com_dolo');
$canEdit = $user->authorise('core.edit', 'com_dolo');
$canCheckin = $user->authorise('core.manage', 'com_dolo');
$canChange = $user->authorise('core.edit.state', 'com_dolo');
$canDelete = $user->authorise('core.delete', 'com_dolo');
?>

<form action="<?php echo JRoute::_('index.php?option=com_dolo&view=campaigns'); ?>" method="post" name="adminForm" id="adminForm">

    <table class="table table-striped" id = "campaignList" >
        <thead >
            <tr >
                <?php if (isset($this->items[0]->state)): ?>
        <th width="1%" class="nowrap center">
            <?php echo JText::_('JSTATUS'); ?>
        </th>
    <?php endif; ?>

    			<th class='left'>
                <?php echo JText::_('COM_DOLO_CAMPAIGNS_NAME'); ?>
                </th>
                <th class='left'>
                <?php echo JText::_('COM_DOLO_CAMPAIGNS_START_DATE'); ?>
                </th>
                <th class='left'>
                <?php echo JText::_('COM_DOLO_CAMPAIGNS_END_DATE'); ?>
                </th>
                <th class='left'>
                <?php echo JText::_('COM_DOLO_CAMPAIGNS_BRANDID'); ?>
                </th>
                <th class='left'>
                <?php echo JText::_('COM_DOLO_CAMPAIGNS_CAMPAIGNSTATUS_ID'); ?>
                </th>


    <?php if (isset($this->items[0]->id)): ?>
        <th width="1%" class="nowrap center hidden-phone">
            <?php echo JText::_('JGRID_HEADING_ID'); ?>
        </th>
    <?php endif; ?>

    				<?php if ($canEdit || $canDelete): ?>
					<th class="center">
				<?php echo JText::_('COM_DOLO_CAMPAIGNS_ACTIONS'); ?>
				</th>
				<?php endif; ?>

    </tr>
    </thead>
    <tfoot>
    <tr>
        <td colspan="<?php echo isset($this->items[0]) ? count(get_object_vars($this->items[0])) : 10; ?>">
            <?php echo $this->pagination->getListFooter(); ?>
        </td>
    </tr>
    </tfoot>
    <tbody>
    <?php foreach ($this->items as $i => $item) : ?>
        <?php $canEdit = $user->authorise('core.edit', 'com_dolo'); ?>

        				<?php if (!$canEdit && $user->authorise('core.edit.own', 'com_dolo')): ?>
					<?php $canEdit = JFactory::getUser()->id == $item->created_by; ?>
				<?php endif; ?>

        <tr class="row<?php echo $i % 2; ?>">

            <?php if (isset($this->items[0]->state)): ?>
                <?php $class = ($canEdit || $canChange) ? 'active' : 'disabled'; ?>
                <td class="center">
                    <a class="btn btn-micro <?php echo $class; ?>" onClick="changeCampaignStatus(this.form, '<?php echo JURI::root();?>','<?php echo (int)$item->id; ?>','<?php echo $item->state; ?>');"
                       href="javascript:void(0);">
                        <?php if ($item->state == 1): ?>
                            <i class="icon-publish"></i>
                        <?php else: ?>
                            <i class="icon-unpublish"></i>
                        <?php endif; ?>
                    </a>
                </td>
            <?php endif; ?>

            				<td>
				<?php if (isset($item->checked_out) && $item->checked_out) : ?>
					<?php echo JHtml::_('jgrid.checkedout', $i, $item->editor, $item->checked_out_time, 'campaigns.', $canCheckin); ?>
				<?php endif; ?>			
				<?php echo $this->escape($item->name); ?>
				</td>
				<td>

					<?php echo $item->start_date; ?>
				</td>
				<td>

					<?php echo $item->end_date; ?>
				</td>
				<td>

					<?php echo $item->brandid; ?>
				</td>
				<td>

					<?php echo $item->campaignstatus_id; ?>
				</td>


            <?php if (isset($this->items[0]->id)): ?>
                <td class="center hidden-phone">
                    <?php echo (int)$item->id; ?>
                </td>
            <?php endif; ?>

            				<?php if ($canEdit || $canDelete): ?>
					<td class="center">
						<?php if ($canEdit): ?>
							<a href="<?php echo JRoute::_('index.php?option=com_dolo&task=campaignform.edit&id=' . $item->id, false, 2); ?>" class="btn btn-mini" type="button"><i class="icon-edit" ></i></a>
						<?php endif; ?>
						<?php if ($canDelete): ?>
							<button data-item-id="<?php echo $item->id; ?>" class="btn btn-mini delete-button" type="button"><i class="icon-trash" ></i></button>
						<?php endif; ?>
					</td>
				<?php endif; ?>

        </tr>
    <?php endforeach; ?>
    </tbody>
    </table>

    <?php if ($canCreate): ?>
        <a href="<?php echo JRoute::_('index.php?option=com_dolo&task=campaignform.edit&id=0', false, 2); ?>"
           class="btn btn-success btn-small"><i
                class="icon-plus"></i> <?php echo JText::_('COM_DOLO_ADD_ITEM'); ?></a>
    <?php endif; ?>

    <input type="hidden" name="task" value=""/>
    <input type="hidden" name="boxchecked" value="0"/>
    <input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>"/>
    <input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>"/>
    <?php echo JHtml::_('form.token'); ?>
</form>

<script type="text/javascript">

    jQuery(document).ready(function () {
        jQuery('.delete-button').click(deleteItem);
    });

    function deleteItem() {
        var item_id = jQuery(this).attr('data-item-id');
        if (confirm("<?php echo JText::_('COM_DOLO_DELETE_MESSAGE'); ?>")) {
            window.location.href = '<?php echo JRoute::_('index.php?option=com_dolo&task=campaignform.remove&id=', false, 2) ?>' + item_id;
        }
    }

    function changeCampaignStatus(frm,root_url,id,status) {    
        var strURL=root_url+"components/com_dolo/controllers/block_unblock.php?run=blockCampaign&id="+id+"&status="+status;
        $.ajax({
           url: strURL,
           type: 'put',
           success: function(response) {
            window.location.reload();
           }
        });
    }


</script>


