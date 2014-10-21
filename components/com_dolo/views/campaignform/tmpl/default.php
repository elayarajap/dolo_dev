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
$isAdmin = $user_for_campaign->get('isRoot');
foreach ($user_for_campaign->groups as $groupId => $value){
$db = JFactory::getDbo();
$db->setQuery(
'SELECT `title`' .
' FROM `#__usergroups`' .
' WHERE `id` = '. (int) $groupId
);
}
$groupNames = $db->loadResult();

$userinfo_acc = JFactory::getUser();
$current_user_acc = $userinfo_acc->id;

if($groupNames=='ums') {

$account_info = mysql_query("SELECT account_id FROM ".$jconfig->dbprefix."dolo_account_user_mapping WHERE user_id=$current_user_acc");
$row = mysql_fetch_array($account_info);
$accid = $row[0];

$result=mysql_query("SELECT id, name from ".$jconfig->dbprefix."users WHERE id IN (SELECT user_id FROM ".$jconfig->dbprefix."dolo_account_user_mapping WHERE account_id=$accid)");

$result_brand=mysql_query("SELECT id, name from ".$jconfig->dbprefix."dolo_brand WHERE id IN (SELECT brand_id FROM ".$jconfig->dbprefix."dolo_account_brand_mapping WHERE account_id=$accid) AND state = 1");
//Campaigns collaborators starts here
$result_collaborator_edit=mysql_query("SELECT collaborators from ".$jconfig->dbprefix."dolo_campaign WHERE id=".$this->item->id."");
$collaboratorsList = mysql_fetch_array($result_collaborator_edit); 
$collaborators = array();
$collaborators = explode(",", $collaboratorsList[0]);
//Campaigns collaborators ends here

//Campaigns brands starts here
$result_brand_edit=mysql_query("SELECT brandid from ".$jconfig->dbprefix."dolo_campaign WHERE id=".$this->item->id."");
$brandList = mysql_fetch_array($result_brand_edit); 
$brand_selected = $brandList[0];
//Campaigns brands ends here
}

else if(!$isAdmin) {

$result_brand=mysql_query("SELECT id, name from ".$jconfig->dbprefix."dolo_brand WHERE id IN (SELECT brand_id FROM ".$jconfig->dbprefix."dolo_user_brand_mapping WHERE user_id=$current_user_acc) AND state = 1");

//Campaigns brands starts here
$result_brand_edit=mysql_query("SELECT brandid from ".$jconfig->dbprefix."dolo_campaign WHERE id=".$this->item->id."");
$brandList = mysql_fetch_array($result_brand_edit); 
$brand_selected = $brandList[0];
//Campaigns brands ends here
}
// Joomla custom scripting ends here


?>
</style>
<script type="text/javascript">
    getScript('//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js', function() {
        jQuery(document).ready(function() {
            jQuery('#form-campaign').submit(function(event) {
                
            });

            
			jQuery('input:hidden.brandid').each(function(){
				var name = jQuery(this).attr('name');
				if(name.indexOf('brandidhidden')){
					jQuery('#jform_brandid option[value="' + jQuery(this).val() + '"]').attr('selected',true);
				}
			});
					jQuery("#jform_brandid").trigger("liszt:updated");
			jQuery('input:hidden.campaigntype_id').each(function(){
				var name = jQuery(this).attr('name');
				if(name.indexOf('campaigntype_idhidden')){
					jQuery('#jform_campaigntype_id option[value="' + jQuery(this).val() + '"]').attr('selected',true);
				}
			});
					jQuery("#jform_campaigntype_id").trigger("liszt:updated");
			jQuery('input:hidden.campaignstatus_id').each(function(){
				var name = jQuery(this).attr('name');
				if(name.indexOf('campaignstatus_idhidden')){
					jQuery('#jform_campaignstatus_id option[value="' + jQuery(this).val() + '"]').attr('selected',true);
				}
			});
					jQuery("#jform_campaignstatus_id").trigger("liszt:updated");
			jQuery('input:hidden.collaborators').each(function(){
				var name = jQuery(this).attr('name');
				if(name.indexOf('collaboratorshidden')){
					jQuery('#jform_collaborators option[value="' + jQuery(this).val() + '"]').attr('selected',true);
				}
			});
	jQuery('#jform_collaborators').change(function(){
		if(jQuery('#jform_collaborators option:selected').length == 0){
		jQuery("#jform_collaborators option[value=0]").attr('selected', 'selected');
		}
	});
					jQuery("#jform_collaborators").trigger("liszt:updated");
        });
    });

</script>

<div class="campaign-edit front-end-edit">
    <?php if (!empty($this->item->id)): ?>
        <h1>Edit Campaign</h1>
    <?php else: ?>
        <h1>Add Campaign</h1>
    <?php endif; ?>

    <form id="form-campaign" action="<?php echo JRoute::_('index.php?option=com_dolo&task=campaign.save'); ?>" method="post" class="form-validate pure-form pure-form-aligned" enctype="multipart/form-data">
        
	<input type="hidden" name="jform[id]" value="<?php echo $this->item->id; ?>" />

	<?php if(empty($this->item->created_by)): ?>
		<input type="hidden" name="jform[created_by]" value="<?php echo JFactory::getUser()->id; ?>" />
	<?php else: ?>
		<input type="hidden" name="jform[created_by]" value="<?php echo $this->item->created_by; ?>" />
	<?php endif; ?>
	<div class="control-group">
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
		<div class="controls">
			<?php if($isAdmin) { ?>	
				<?php echo $this->form->getInput('brandid'); ?>
			<?php } else { ?>
				<select id="jform_brandid" name="jform[brandid]" class="inputbox">
					<?php
					while($row = mysql_fetch_array($result_brand)) {
						$uid = $row['id'];
						$uname = $row['name'];
					?> 
				<option value="<?php echo $uid; ?>" <?php if($brand_selected == (int)$uid) { ?> selected="selected" <?php } ?> ><?php echo $uname; ?></option>
				<?php }	?>	
				</select>
			<?php } ?>
		</div>
	</div>
	<?php foreach((array)$this->item->brandid as $value): ?>
		<?php if(!is_array($value)): ?>
			<input type="hidden" class="brandid" name="jform[brandidhidden][<?php echo $value; ?>]" value="<?php echo $value; ?>" />
		<?php endif; ?>
	<?php endforeach; ?>
	<div class="control-group">
		<div class="control-label"><?php echo $this->form->getLabel('campaigntype_id'); ?></div>
		<div class="controls"><?php echo $this->form->getInput('campaigntype_id'); ?></div>
	</div>
	<?php foreach((array)$this->item->campaigntype_id as $value): ?>
		<?php if(!is_array($value)): ?>
			<input type="hidden" class="campaigntype_id" name="jform[campaigntype_idhidden][<?php echo $value; ?>]" value="<?php echo $value; ?>" />
		<?php endif; ?>
	<?php endforeach; ?>
	<div class="control-group">
		<div class="control-label"><?php echo $this->form->getLabel('campaignstatus_id'); ?></div>
		<div class="controls"><?php echo $this->form->getInput('campaignstatus_id'); ?></div>
	</div>
	<?php foreach((array)$this->item->campaignstatus_id as $value): ?>
		<?php if(!is_array($value)): ?>
			<input type="hidden" class="campaignstatus_id" name="jform[campaignstatus_idhidden][<?php echo $value; ?>]" value="<?php echo $value; ?>" />
		<?php endif; ?>
	<?php endforeach; ?>
	<div class="control-group">
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
			<!--Campaigns collaborators -->
		<?php if($isAdmin) { ?>	
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('collaborators'); ?></div>
				<div class="controls">

				<?php echo $this->form->getInput('collaborators'); ?>
				</div>
			</div>

		<?php } elseif($groupNames=='ums') { ?>

			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('collaborators'); ?></div>
				<div class="controls">
				<?php if (!empty($this->item->id)): ?>
			        <select id="jform_collaborators" name="jform[collaborators][]" class="chzn-done" multiple="true" >
					<?php
						while($row = mysql_fetch_array($result)) {
						$uid = $row['id'];
						$uname = $row['name'];			
					?> 
					<option value="<?php echo $uid; ?>" <?php if (in_array($uid, $collaborators)) { ?> selected="selected" <?php } ?>> <?php echo $uname; ?></option>
					<?php }	?>
				</select>
			    <?php else: ?>
			        <select id="jform_collaborators" name="jform[collaborators][]" class="chzn-done" multiple="true" >
					<?php
						while($row = mysql_fetch_array($result)) {
						$uid = $row['id'];
						$uname = $row['name'];			
					?> 
					<option value="<?php echo $uid; ?>"> <?php echo $uname; ?></option>
					<?php }	?>
				</select>
			    <?php endif; ?>

			    </div>
			  	</div>				
		<?php } ?>
		<input type="hidden" name="jform[state]" value="<?php echo $this->item->state; ?>" />

<br/>
	<?php foreach((array)$this->item->collaborators as $value): ?>
		<?php if(!is_array($value)): ?>
			<input type="hidden" class="collaborators" name="jform[collaboratorshidden][<?php echo $value; ?>]" value="<?php echo $value; ?>" />
		<?php endif; ?>
	<?php endforeach; ?>
	<input type="hidden" name="jform[state]" value="<?php echo $this->item->state; ?>" />
        <div class="control-group">
            <div class="controls">
                <button type="submit" class="validate btn btn-primary"><?php echo JText::_('JSUBMIT'); ?></button>
                <a class="btn" href="<?php echo JRoute::_('index.php?option=com_dolo&task=campaignform.cancel'); ?>" title="<?php echo JText::_('JCANCEL'); ?>"><?php echo JText::_('JCANCEL'); ?></a>
            </div>
        </div>
        
        <input type="hidden" name="option" value="com_dolo" />
        <input type="hidden" name="task" value="campaignform.save" />
        <?php echo JHtml::_('form.token'); ?>
    </form>
</div>
