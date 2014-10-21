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


// Joomla custom scripting
require_once("./configuration.php");
$jconfig = new JConfig();
$db_error = "I am sorry! There is an error in db connection.";
$db_config = mysql_connect( $jconfig->host, $jconfig->user, $jconfig->password ) or die( $db_error );
mysql_select_db( $jconfig->db, $db_config ) or die( $db_error );

$db=JFactory::getDBO();
$user_for_campaign = JFactory::getUser();
 foreach ($user_for_campaign->groups as $groupId => $value){
$db = JFactory::getDbo();
$db->setQuery(
'SELECT `title`' .
' FROM `#__usergroups`' .
' WHERE `id` = '. (int) $groupId
);
}
$groupNames = $db->loadResult();

$userinfo_brand = JFactory::getUser();
$isAdmin = $userinfo_brand->get('isRoot');

if($isAdmin) {
$result=mysql_query("SELECT id, name from ".$jconfig->dbprefix."users a");
$result1=mysql_query("SELECT id, name from ".$jconfig->dbprefix."dolo_brand");
}
elseif($groupNames=='ums') {

$userinfo_acc = JFactory::getUser();
$current_user_acc = $userinfo_acc->id;

$account_info = mysql_query("SELECT account_id FROM ".$jconfig->dbprefix."dolo_account_user_mapping WHERE user_id=$current_user_acc");
$row = mysql_fetch_array($account_info);
// $db->setQuery($account_info);
// $account_result = $db->loadRow();
$accid = $row[0];

$result=mysql_query("SELECT id, name from ".$jconfig->dbprefix."users WHERE id IN (SELECT user_id FROM ".$jconfig->dbprefix."dolo_account_user_mapping WHERE account_id=$accid)");
$result1=mysql_query("SELECT id, name from ".$jconfig->dbprefix."dolo_brand WHERE id IN (SELECT brand_id FROM ".$jconfig->dbprefix."dolo_account_brand_mapping WHERE account_id=$accid)");

//Campaigns brands starts here
$result_user_brand_edit=mysql_query("SELECT user_id, brand_id from ".$jconfig->dbprefix."dolo_user_brand_mapping WHERE id=".$this->item->id."");
$userBrandList = mysql_fetch_array($result_user_brand_edit); 
$user_selected = $userBrandList[0];
$brand_selected = $userBrandList[1];
//Campaigns brands ends here
}
// Joomla custom scripting ends here


?>
</style>
<script type="text/javascript">
    getScript('//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js', function() {
        jQuery(document).ready(function() {
            jQuery('#form-userbrandmapping').submit(function(event) {
                
            });

            
			jQuery('input:hidden.user_id').each(function(){
				var name = jQuery(this).attr('name');
				if(name.indexOf('user_idhidden')){
					jQuery('#jform_user_id option[value="' + jQuery(this).val() + '"]').attr('selected',true);
				}
			});
					jQuery("#jform_user_id").trigger("liszt:updated");
			jQuery('input:hidden.brand_id').each(function(){
				var name = jQuery(this).attr('name');
				if(name.indexOf('brand_idhidden')){
					jQuery('#jform_brand_id option[value="' + jQuery(this).val() + '"]').attr('selected',true);
				}
			});
					jQuery("#jform_brand_id").trigger("liszt:updated");
        });
    });

</script>

<div class="userbrandmapping-edit front-end-edit">
    <?php if (!empty($this->item->id)): ?>
        <h1>Edit</h1>
    <?php else: ?>
        <h1>Add</h1>
    <?php endif; ?>

    <form id="form-userbrandmapping" action="<?php echo JRoute::_('index.php?option=com_dolo&task=userbrandmapping.save'); ?>" method="post" class="form-validate pure-form pure-form-aligned" enctype="multipart/form-data">
        
	<input type="hidden" name="jform[id]" value="<?php echo $this->item->id; ?>" />

	<input type="hidden" name="jform[state]" value="<?php echo $this->item->state; ?>" />

	<?php if(empty($this->item->created_by)): ?>
		<input type="hidden" name="jform[created_by]" value="<?php echo JFactory::getUser()->id; ?>" />
	<?php else: ?>
		<input type="hidden" name="jform[created_by]" value="<?php echo $this->item->created_by; ?>" />
	<?php endif; ?>
	<div class="control-group">
		<div class="control-label"><?php echo $this->form->getLabel('user_id'); ?></div>
		<div class="controls">

			<?php if($isAdmin) { ?>
				<?php echo $this->form->getInput('user_id'); ?>
			<?php } elseif($groupNames=='ums') { ?>
				<select id="jform_user_id" name="jform[user_id]" class="inputbox" aria-invalid="false">
					<?php
					while($row = mysql_fetch_array($result)) {
						$uid = $row['id'];
						$uname = $row['name'];
					?> 
					<option value="<?php echo $uid; ?>" <?php if($user_selected == (int)$uid) { ?> selected="selected" <?php } ?>><?php echo $uname; ?></option>
					<?php }	?>
				</select>
			<?php } ?>


		</div>
	</div>
	<?php foreach((array)$this->item->user_id as $value): ?>
		<?php if(!is_array($value)): ?>
			<input type="hidden" class="user_id" name="jform[user_idhidden][<?php echo $value; ?>]" value="<?php echo $value; ?>" />
		<?php endif; ?>
	<?php endforeach; ?>
	<div class="control-group">
		<div class="control-label"><?php echo $this->form->getLabel('brand_id'); ?></div>
		<div class="controls">


			<?php if($isAdmin) { ?>
				<?php echo $this->form->getInput('brand_id'); ?>
			<?php } elseif($groupNames=='ums') { ?>
				<select id="jform_brand_id" name="jform[brand_id]" class="inputbox" aria-invalid="false">
					<?php
					while($row = mysql_fetch_array($result1)) {
						$uid = $row['id'];
						$uname = $row['name'];
					?> 
					<option value="<?php echo $uid; ?>" <?php if($brand_selected == (int)$uid) { ?> selected="selected" <?php } ?>><?php echo $uname; ?></option>
					<?php }	?>	
				</select>
			<?php } ?>


		</div>
	</div></br>
	<?php foreach((array)$this->item->brand_id as $value): ?>
		<?php if(!is_array($value)): ?>
			<input type="hidden" class="brand_id" name="jform[brand_idhidden][<?php echo $value; ?>]" value="<?php echo $value; ?>" />
		<?php endif; ?>
	<?php endforeach; ?>
        <div class="control-group">
            <div class="controls">
                <button type="submit" class="validate btn btn-primary"><?php echo JText::_('JSUBMIT'); ?></button>
                <a class="btn" href="<?php echo JRoute::_('index.php?option=com_dolo&task=userbrandmappingform.cancel'); ?>" title="<?php echo JText::_('JCANCEL'); ?>"><?php echo JText::_('JCANCEL'); ?></a>
            </div>
        </div>
        
        <input type="hidden" name="option" value="com_dolo" />
        <input type="hidden" name="task" value="userbrandmappingform.save" />
        <?php echo JHtml::_('form.token'); ?>
    </form>
</div>
