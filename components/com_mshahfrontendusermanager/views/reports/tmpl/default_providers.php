<?php
/**
 * 
 * @author Mshah Info Technologies
 *
 * @copyright  Copyright (C) 2014 mshahtech.com . All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
 if(JFactory::getUser()->id){
?>
    <h2>User List</h2>

<?php
            $doc = JFactory::getDocument();
            $doc->addStyleSheet(JURI::root().'./media/com_mshahfrontendusermanager/css/style.css');
            $doc->addScript(JURI::root().'./media/com_mshahfrontendusermanager/js/jquery.min.js');
            $doc->addScript(JURI::root().'./media/com_mshahfrontendusermanager/js/user.js');
            $user = JFactory::getUser();
            $isAdmin = $user->get('isRoot');
            $groups = JUserHelper::getUserGroups($user->get('id'));

             $model = $this->getModel('Reports');
             $groupsLabels = $model->getGroupName($groups);
             foreach ($groupsLabels as $groupLabel) {
               $groupNames = $groupLabel;
              }
 

            $userId = $user->get('id'); 
           
            echo '<form name="myform" id="myform" method="POST" action="./?option=com_mshahfrontendusermanager&view=maintenanceprovider">';
            echo "<input type='hidden' id='uid' name='uid' value=''>";

            if ($isAdmin || isset($groupNames)=='ums')
            { 

             echo '<div class="tpheader">';
              ?>

               
            <div class="btn-toolbar" id="toolbar">
              <div class="btn-wrapper" id="toolbar-new">
                <a href="<?php echo JRoute::_('index.php?option=com_mshahfrontendusermanager&view=maintenanceprovider', false, 2); ?>" class="btn btn-success btn-small"><i class="icon-plus"></i> Add</a>
              </div>
               <div class="btn-wrapper" id="toolbar-delete">                
                <input name="delete" type="button" onClick="deleteUser(this.form, '<?php echo JURI::root();?>');" class="btn btn-small"  id="delete" value="Delete">              
              </input>
                
              </div>              
              <div class="btn-wrapper" id="toolbar-publish">
                <input name="block"  type="button" onClick="unblockUser(this.form, '<?php echo JURI::root();?>');"  class="btn btn-small" id="unblock" value="Activate" >
              </div>
              <div class="imagesInline" id="blockUserDiv"></div>
              <div class="btn-wrapper" id="toolbar-unpublish">
                <input name="block"  type="button" onClick="blockUser(this.form, '<?php echo JURI::root();?>');"  class="btn btn-small" id="block" value="Block" >
              </div>
            </div>
           

</div>  

<?php
        }

?>
<div id="horizontalscrollbar">
<table cellpadding="0" cellspacing="0" border="0" id="table" class="sortable">
        <thead>
            <tr>
                <th><!--h3> <input type="checkbox" onClick="checkedall(this)" /></h3--></th>
                <th><h3>Sno</h3></th>
                <th><h3>Name</h3>
                <th><h3>User Name</h3></th>
                <th><h3>Email-ID</h3></th>           
                <th><h3>Status</h3></th>
                <th><h3>User Group</h3></th>
                <th><h3>LastVisit Date</h3></th>

            </tr>
        </thead>
      <tbody>
<?php

$sno=1;
if(isset($this->userlist))
{

foreach ($this->userlist as $value ) {
$status=$value->status;

$uid=$value->id;
$name = $value->name;
$username = $value->username;
$password= $value->password;
$email = $value->email;
$block = $value->block;
$title=$value->title;
$groupid=$value->groupid;
$ucheckbox=$value->ucheckbox;

   if($groupid!=8 || $isAdmin) {

   
   echo "<tr><td>";
   if($uid==$userId)
         echo "<input name='checkbox'  disabled='disabled'  type='checkbox' id='checkbox' value=$uid>";

   if($uid!=$userId) {
   echo "<input name='checkbox' type='checkbox' id='checkbox' value=$uid>";
   }
   echo "</td><td>"; 
    echo $sno++;
   echo "</td><td>";
   echo $name;
   echo "</td><td>";
   echo "<a href='javascript: modifyUser(".$uid.")'>$username</a>";
   echo "</td><td>";               
   echo $value->email;
   echo "</td><td>";
   echo $status;
   echo "</td><td>";
   echo $title;
   echo "</td><td>";
   echo $value->lastvisitDate;
   echo "</td></tr>"; 
 }
}
 }
  
echo "</tbody>";

?>
</table>
</div>
</form>


 <div id="controls">
        <div id="perpage">
            <select id="select1" onchange="sorter.size(this.value)">
            <option value="5">5</option>
                <option value="10" selected="selected">10</option>
                <option value="20">20</option>
                <option value="50">50</option>
                <option value="100">100</option>
                <option value="500">500</option>
            </select>
            <span>Entries Per Page</span>
        </div>
        
    </div>
   
    <?php
     $doc->addScript(JURI::root().'./media/com_mshahfrontendusermanager/js/script.js');
    ?>
    <script type="text/javascript">
    
  var sorter = new TINY.table.sorter("sorter");
    sorter.head = "head";
    sorter.asc = "asc";
    sorter.desc = "desc";
    sorter.even = "evenrow";
    sorter.odd = "oddrow";
    sorter.evensel = "evenselected";
    sorter.oddsel = "oddselected";
    sorter.paginate = true;
    sorter.currentid = "currentpage";
    sorter.limitid = "pagelimit";
    sorter.init("table",1);
  </script>

</body>
<?php
}
?>
<div id="fields-container">
</div>