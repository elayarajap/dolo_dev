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

if($groupNames=='ums') {

$userinfo_acc = JFactory::getUser();
$current_user_acc = $userinfo_acc->id;

$account_info = mysql_query("SELECT account_id FROM ".$jconfig->dbprefix."dolo_account_user_mapping WHERE user_id=$current_user_acc");
$row = mysql_fetch_array($account_info);
// $db->setQuery($account_info);
// $account_result = $db->loadRow();
$accid = $row[0];

$result=mysql_query("SELECT id, name from ".$jconfig->dbprefix."users WHERE id IN (SELECT user_id FROM ".$jconfig->dbprefix."dolo_account_user_mapping WHERE account_id=$accid)");


$result_selected=mysql_query("SELECT id from ".$jconfig->dbprefix."users WHERE id IN (SELECT user_id FROM ".$jconfig->dbprefix."dolo_user_brand_mapping WHERE brand_id=".$this->item->id.")");
$usersarr = array();
while($usersList = mysql_fetch_array($result_selected))
{
$usersarr[] = $usersList["id"];
} 

}
// Joomla custom scripting ends here


?>
</style>
<script type="text/javascript">
    getScript('//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js', function() {
        jQuery(document).ready(function() {
            jQuery('#form-brand').submit(function(event) {
                
            });

            
        });
    });

</script>

<div class="brand-edit front-end-edit">
    <?php if (!empty($this->item->id)): ?>
        <h1>Edit <?php echo $this->item->id; ?></h1>
    <?php else: ?>
        <h1>Add</h1>
    <?php endif; ?>

    <form id="form-brand" action="<?php echo JRoute::_('index.php?option=com_dolo&task=brand.save'); ?>" method="post" class="form-validate pure-form pure-form-aligned" enctype="multipart/form-data">
        
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
        <div class="control-label"><?php echo $this->form->getLabel('user_id'); ?></div>
        <div class="controls">

            <?php if($groupNames=='ums') { ?>
            <select id="jform_user_id" name="jform[user_id][]" class="inputbox" multiple="multiple">
            <?php
            while($row = mysql_fetch_array($result)) {
            $uid = $row['id'];
            $uname = $row['name'];
            ?> 
            <option value="<?php echo $uid; ?>" <?php if (in_array($uid, $usersarr)) { ?> selected="selected" <?php } ?> ><?php echo $uname; ?></option>
            <?php
            }
            ?>
            </select>
            <?php } ?>


        </div>
    </div><br/>


	<input type="hidden" name="jform[state]" value="<?php echo $this->item->state; ?>" />

        <div class="control-group">
            <div class="controls">
                <button type="submit" class="validate btn btn-primary"><?php echo JText::_('JSUBMIT'); ?></button>
                <a class="btn" href="<?php echo JRoute::_('index.php?option=com_dolo&task=brandform.cancel'); ?>" title="<?php echo JText::_('JCANCEL'); ?>"><?php echo JText::_('JCANCEL'); ?></a>
            </div>
        </div>
        
        <input type="hidden" name="option" value="com_dolo" />
        <input type="hidden" name="task" value="brandform.save" />
        <?php echo JHtml::_('form.token'); ?>
    </form>
</div>
