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

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');
JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('formbehavior.chosen', 'select');

$user = JFactory::getUser();
$userId = $user->get('id');
$listOrder = $this->state->get('list.ordering');
$listDirn = $this->state->get('list.direction');
$canCreate = $user->authorise('core.create', 'com_image');
$canEdit = $user->authorise('core.edit', 'com_image');
$canCheckin = $user->authorise('core.manage', 'com_image');
$canChange = $user->authorise('core.edit.state', 'com_image');
$canDelete = $user->authorise('core.delete', 'com_image');
?>

<form action="<?php echo JRoute::_('index.php?option=com_image&view=uploads'); ?>" method="post" name="adminForm" id="adminForm">

    
    <table class="table table-striped" id = "uploadList" >
        <thead >
            <tr >
                
                    <th class='left'>
                <?php echo JHtml::_('grid.sort',  'COM_IMAGE_UPLOADS_IMAGE', 'a.image', $listDirn, $listOrder); ?>
                </th>


                    <?php if ($canEdit || $canDelete): ?>
                    <th class="center">
                <?php echo JText::_('COM_IMAGE_UPLOADS_ACTIONS'); ?>
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
        <?php $canEdit = $user->authorise('core.edit', 'com_image'); ?>

                        <?php if (!$canEdit && $user->authorise('core.edit.own', 'com_image')): ?>
                    <?php $canEdit = JFactory::getUser()->id == $item->created_by; ?>
                <?php endif; ?>

        <tr class="row<?php echo $i % 2; ?>">

            

                            <td>

                    <?php echo $item->image; ?>
                </td>


                            <?php if ($canEdit || $canDelete): ?>
                    <td class="center">
                        <?php if ($canEdit): ?>
                            <a href="<?php echo JRoute::_('index.php?option=com_image&task=uploadform.edit&id=' . $item->id, false, 2); ?>" class="btn btn-mini" type="button"><i class="icon-edit" ></i></a>
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
        <a href="<?php echo JRoute::_('index.php?option=com_image&task=uploadform.edit&id=0', false, 2); ?>"
           class="btn btn-success btn-small"><i
                class="icon-plus"></i> <?php echo JText::_('COM_IMAGE_ADD_ITEM'); ?></a>
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
        if (confirm("<?php echo JText::_('COM_IMAGE_DELETE_MESSAGE'); ?>")) {
            window.location.href = '<?php echo JRoute::_('index.php?option=com_image&task=uploadform.remove&id=', false, 2) ?>' + item_id;
        }
    }
</script>


