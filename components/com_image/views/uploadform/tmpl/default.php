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

JHtml::_('behavior.keepalive');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');

//Load admin language file
$lang = JFactory::getLanguage();
$lang->load('com_image', JPATH_ADMINISTRATOR);
$doc = JFactory::getDocument();
$doc->addScript(JUri::base() . '/components/com_image/assets/js/form.js');



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

if(isset($_POST['imageformsub']))
{

$jRootPath = JPath::clean(JPATH_ROOT);

$upload_path = $jRootPath . '/images/';

$upload_path = $upload_path . basename( $_FILES["uploadFile"]["name"]);

if (move_uploaded_file($_FILES["uploadFile"]["tmp_name"], $upload_path)) {
    $target_dir = JUri::root() . 'images/' . basename( $_FILES["uploadFile"]["name"]);
    $insert_operation = mysql_query("INSERT INTO ".$jconfig->dbprefix."image_upload VALUES ('','1','".$user_for_campaign->id."','".$target_dir."')");
    echo "Successfully uploaded!";
} else {
    echo "Sorry, there was an error uploading your file.";
}

}


?>
<script type="text/javascript">
    getScript('//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js', function() {
        jQuery(document).ready(function() {
            jQuery('#form-upload').submit(function(event) {
                
            });

            
        });
    });

</script>

<div class="upload-edit front-end-edit">
    <?php if (!empty($this->item->id)): ?>
        <h1>Edit <?php echo $this->item->id; ?></h1>
    <?php else: ?>
        <h1>Add</h1>
    <?php endif; ?>

    <form method="post" class="form-validate form-horizontal" enctype="multipart/form-data">

    
    Please choose a file: <input type="file" name="uploadFile"><br>
    <input type="submit" name="imageformsub" value="Upload File">

    </form>


</div>
