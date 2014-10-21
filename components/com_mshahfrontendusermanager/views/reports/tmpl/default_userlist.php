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
            $doc->addScript(JURI::root().'./media/com_mshahfrontendusermanager/js/user.js');
            $user = JFactory::getUser();
            $isAdmin = $user->get('isRoot');
            $groups = JUserHelper::getUserGroups($user->get('id'));

             $model = $this->getModel('Reports');
             $groupsLabels = $model->getGroupName($groups);
             foreach ($groupsLabels as $groupLabel) {
               $groupNames = $groupLabel;
              }
 
            if ($isAdmin || isset($groupNames)=='ums')
            { 
            echo '    <form name="form1" method="post" action="">';
            echo '<div class="tpheader">';
              ?>           
              &nbsp;&nbsp; <input type="submit" alt="active" value=" " name="active" id="getUserActiveImage" /></input>
            &nbsp;&nbsp; <input type="submit" alt="inactive" value=" " name="inactive" id="getUserInactiveImage" /></input>

    &nbsp;&nbsp;<input name="userPdf" type="button" id="getPdfImage" onClick="getPdfUrl('<?php echo $this->val ?>')" />

   &nbsp;&nbsp;<input name="userCsv" type="button" id="getCsvImage" onClick="getCsvUrl('<?php echo $this->val ?>')" /> 

             &nbsp;&nbsp;<input type="text" id="searchTerm" class="searchTerm1" placeholder=" search here.." onkeyup="doSearch()" />
</div>
   
    
<?php
        }

?>

<table cellpadding="0" cellspacing="0" border="0" id="table" class="sortable">
        <thead>
            <tr>
                <th><h3><font color="#fff">Sno</h3></font></th>
                <th><h3><font color="#fff">Name</h3></font></th>
                <th><h3><font color="#fff">User Name</h3></font></th>
                <th><h3><font color="#fff">Email-ID</h3></font></th>           
                <th><h3><font color="#fff">Status</h3></font></th>
                <th><h3><font color="#fff">User Group</h3></font></th>
                <th><h3><font color="#fff">LastVisit Date</h3></font></th>

            </tr>
        </thead>
        <tbody>
<?php

$sno=1;
if(isset($this->userlist))
{

foreach ($this->userlist as $value ) {
$name = $value->name;
$username = $value->username;
$email = $value->email;
$status = $value->status;
$title=$value->title;
$groupid=$value->groupid;


   echo "<tr><td>";
   echo $sno++;
   echo "</td><td>";
   echo $name;
   echo "</td><td>";
   echo $username;
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
  
echo "</tbody></table>";

?></form>

 <div id="controls">
        <div id="perpage">
            <select id="select1" onchange="sorter.size(this.value)">
            <option value="5">5</option>
                <option value="10" selected="selected">10</option>
                <option value="20">20</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
            <span>Entries Per Page</span>
        </div>
        <div id="navigation">
            <img src="./media/com_mshahfrontendusermanager/images/first.gif" width="16" height="16" alt="First Page" onclick="sorter.move(-1,true)" />
            <img src="./media/com_mshahfrontendusermanager/images/previous.gif" width="16" height="16" alt="First Page" onclick="sorter.move(-1)" />
            <img src="./media/com_mshahfrontendusermanager/images/next.gif" width="16" height="16" alt="First Page" onclick="sorter.move(1)" />
            <img src="./media/com_mshahfrontendusermanager/images/last.gif" width="16" height="16" alt="Last Page" onclick="sorter.move(1,true)" />
        </div>
        
    </div>
   <div id="text">Displaying Page <span id="currentpage"></span> of <span id="pagelimit"></span></div>
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
<div style="float: right; margin-right: 20px;">  
  <p>Powered by  <a href="http://www.mshahtech.com" target="_blank">Mshah Info Technologies</a></p>  
</div>
</body>
<?php
}
?>