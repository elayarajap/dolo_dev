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
 
// Include dependancy of the main model form
jimport('joomla.application.component.modelform');
// import Joomla modelitem library
jimport('joomla.application.component.modelitem');
// Include dependancy of the dispatcher
jimport('joomla.event.dispatcher');
 
/**
 * mshahfrontendusermanagerModelMaintenanceProvider Model
 */
class mshahfrontendusermanagerModelMaintenanceProvider extends JModelForm
{
        /**
         * @var object item
         */
        protected $item;
 
        /**
         * Get the data for a new qualification
         */
        public function getForm($data = array(), $loadData = true)
        {
 
        $app = JFactory::getApplication();
 
        // Get the form.
                $form = $this->loadForm('com_mshahfrontendusermanager.maintenanceprovider', 'maintenanceprovider', array('control' => 'jform', 'load_data' => true));
                if (empty($form)) {
                        return false;
                }
                return $form;
 
        }

        public function getUserInfo($uid){
            $db=JFactory::getDBO();
            $query="SELECT a.name,a.username,a.email,a.password,a.block,group_concat(b.group_id) as ucheckbox,group_concat(c.title) as title FROM `#__users` a,`#__user_usergroup_map` b,`#__usergroups` c where a.id=".$uid." and a.id=b.user_id and  b.group_id=c.id ORDER BY a.username ASC ";
            $db->setQuery($query);
            $rows=$db->loadObjectList();
            return $rows;
        }
 
        public function insertData($data)
        {
            $createdon=date('Y-m-d H:i:s');
             $db = JFactory::getDbo();
             $user = JFactory::getUser();
             $isAdmin = $user->get('isRoot');
              foreach ($user->groups as $groupId => $value){
    $db = JFactory::getDbo();
    $db->setQuery(
        'SELECT `title`' .
        ' FROM `#__usergroups`' .
        ' WHERE `id` = '. (int) $groupId
    );
 }
 $groupNames = $db->loadResult();
         // set the variables from the passed data
       $uid=$data['id'];
        $name = $data['name'];
      $username = $data['username'];
        $password = $_REQUEST['password'];
        $ConPassword=$data['password1'];
        $email = $data['email'];
        if(isset($data['block'])){
        $block = $data['block']; }
        else
        {
         $block=0;
        }
        if(isset($data['groupid']))
        $groupid=$data['groupid'];
        if(isset($_POST['checkbox'])){
        $checkbox = $_POST['checkbox']; }
        if(strcmp ( $password, $ConPassword) == 0  )
        {
        $epassword=$ConPassword;
        }
        else
        {
            $epassword=md5($password);
        }
      
        $query="SELECT id,username FROM `#__users` a where a.username = '$username'  ";
        $db->setQuery($query);
        $rows=$db->loadObject();
        $uid1=$rows->id;
        $uname=$rows->username;
        if ( strcasecmp ( $username, $uname) == 0  )
          {
             if($uid==$uid1)
             {
     
if ($isAdmin || $groupNames=='ums')
{


$db = JFactory::getDbo();
 $delete_query = "DELETE FROM `#__user_usergroup_map` WHERE user_id = $uid ";
             $db->setQuery( $delete_query );
             $db->query();
 }
     
             if(!empty($_POST['checkbox'])) {

foreach($_POST['checkbox'] as $cb) {    

         $db1 = JFactory::getDBO();
            $query1 = "INSERT INTO `#__user_usergroup_map` (`user_id`, `group_id`)
             VALUES ($uid, $cb);";
            $db1->setQuery( $query1 );
            $db->query(); 
        }} 
            // return true;

  $update_query = "UPDATE `#__users` SET name ='$name',username='$username',password='$epassword',email='$email',block=$block where id=$uid ";
             $db->setQuery( $update_query );
             $db->query(); 
             return true;

             }
             else {
               echo "<script>alert('User name already exist')</script>";
             echo "<meta http-equiv=refresh content=\"0;URL=../../mshahfrontendusermanager\">";


             }
          }

        else
        {
      
        $query="SELECT a.username FROM `#__users` a where a.id = '$uid' ";
        $db->setQuery($query);
        $rows=$db->loadObject();
        $id=$rows->username;


        if(isset($id))
        {
             
            if ($isAdmin || $groupNames=='ums') {
                $delete_query = "DELETE FROM `#__user_usergroup_map` WHERE user_id = $uid ";
             $db->setQuery( $delete_query );
             $db->query(); }
     
             if(!empty($_POST['checkbox'])) {

foreach($_POST['checkbox'] as $cb) {    

         $db1 =& JFactory::getDBO();
            $query1 = "INSERT INTO `#__user_usergroup_map` (`user_id`, `group_id`)
             VALUES ($uid, $cb);";
            $db1->setQuery( $query1 );
            $db->query(); 
        }} 

    $update_query = "UPDATE `#__users` SET name ='$name',username='$username',password='$epassword',email='$email',block= $block where id=$uid ";
             $db->setQuery( $update_query );
             $db->query(); 
             return true;
                
        }


        else{

           
        // Create a new query object.
        $query = $db->getQuery(true);
        $columns = array('name', 'username','password', 'email','block','registerDate');
        $values = array( $db->quote($name), $db->Quote($username),$db->quote($epassword), $db->Quote($email),$db->quote($block),$db->quote($createdon));
        
        $mainframe = JFactory::getApplication();
        $from_mail= $mainframe->getCfg('mailfrom');
        
        $subject  = 'User Information'; 
        $subject1  = 'New registration info'; 

         // PREPARE THE BODY OF THE MESSAGE

            $message = '<html><body>';
           
            $message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
            $message .= "<tr style='background: #eee;'><td><strong>Username:</strong> </td><td>" . strip_tags($username) . "</td></tr>";
            $message .= "<tr><td><strong>Password:</strong> </td><td>" . strip_tags($password) . "</td></tr>";
            $message .= "</table>";
            $message .= "</body></html>";  
    //   CHANGE THE BELOW VARIABLES TO YOUR NEEDS
           
            $headers = "From: " . $from_mail . "\r\n";
            $headers .= "Content-Type: text/html; charset=utf-8\r\n";
             
     // Sending Mail to User
   
            mail( $email, $subject, $message, $headers);    
            
            $message1 = '<html><body>';
            $message1 .= "Hi Admin this is the notification of new user registration:The user information as follows<br>";
            $message1 .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
            $message1 .= "<tr style='background: #eee;'><td><strong>Name:</strong> </td><td>" . strip_tags($name) . "</td></tr>";
            $message1 .= "<tr style='background: #eee;'><td><strong>Username:</strong> </td><td>" . strip_tags($username) . "</td></tr>";
            $message1 .= "<tr style='background: #eee;'><td><strong>Email:</strong> </td><td>" . strip_tags($email) . "</td></tr>";
            $message1 .= "</table>";
            $message1 .= "</body></html>"; 
            $headers1 = "From: " . $from_mail . "\r\n";
            $headers1 .= "Content-Type: text/html; charset=utf-8\r\n";  

    // Sending Mail to Admin
        
        mail( $from_mail, $subject1, $message1, $headers1); 

               

          $query
            ->insert($db->quoteName('#__users'))
            ->columns($db->quoteName($columns))
            ->values(implode(',', $values));
            $db->setQuery($query);
            if (!$db->query()) {
            JError::raiseError(500, $db->getErrorMsg());
                return false;
        } else {

            //Custom code to get user
            $userinfo_acc = JFactory::getUser();
            //Group checking for UMS for company administrator
            $userId = $userinfo_acc->id;
            $isAdmin = $userinfo_acc->get('isRoot');
            foreach ($userinfo_acc->groups as $groupId => $value){
            $db = JFactory::getDbo();
            $db->setQuery(
            'SELECT `title`' .
            ' FROM `#__usergroups`' .
            ' WHERE `id` = '. (int) $groupId
            );
            }
            $groupNames = $db->loadResult();
            //Group checking for UMS for company administrator ends here  

            if ($groupNames=='ums') {  
                // User Account Mapping custom code
            $acc_user_id = $db->insertid();
            $current_user_acc = $userinfo_acc->id;
            $account_info = "SELECT account_id FROM ".$db->quoteName('#__dolo_account_user_mapping')." WHERE user_id='".$current_user_acc."'";
            $db->setQuery($account_info);
            $account_result = $db->loadRow();
            $accid = $account_result[0];
            $state_upt = 1;
            $sql_account = "INSERT INTO ".$db->quoteName('#__dolo_account_user_mapping')." SET
            ".$db->quoteName('account_id')."        = ".$db->quote($accid).",
            ".$db->quoteName('user_id')."         = ".$db->quote($acc_user_id).",
            ".$db->quoteName('state')."         = ".$db->quote($state_upt)."
            ";
            $db->setQuery($sql_account);
            $db->query();
            // User Account Mapping custom code
            }

        $query1="SELECT max(id) as userid FROM `#__users`";
        $db->setQuery($query1);
        $rows1=$db->loadObject();
        $userid=$rows1->userid;

        if(!empty($_POST['checkbox'])) {

foreach($_POST['checkbox'] as $cb) {    

         $db1 =& JFactory::getDBO();
            $query1 = "INSERT INTO `#__user_usergroup_map` (`user_id`, `group_id`)
             VALUES ($userid, $cb);";
            $db1->setQuery( $query1 );
            $db->query(); }} 
             return true;
                }   
}
}}
        public function getGroupName($groupId){
            $db = JFactory::getDbo();
            $query = $db->getQuery(true);
            $query->select('title')->from('#__usergroups')->where('id IN (' . implode(',', $groupId) . ') AND title="ums" ');
            $db->setQuery($query);
            $groupsLabels = $db->loadColumn();
            return $groupsLabels;
        }
}