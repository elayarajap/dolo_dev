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
 * MshahfrontendusermanagerModelReports Model
 */
class MshahfrontendusermanagerModelReports extends JModelForm
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
                $form = $this->loadForm('com_mshahfrontendusermanager.reports', 'reports', array('control' => 'jform', 'load_data' => true));
                if (empty($form)) {
                        return false;
                }
                return $form;
 
        }

  // Custom code for get users for company admin
   public function getUsers(){

        $db=JFactory::getDBO();
        $user = JFactory::getUser();
        $userId = $user->id;
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

        $current_user = $user->id;
        $account_info = "SELECT account_id FROM ".$db->quoteName('#__dolo_account_user_mapping')." WHERE user_id='".$current_user."'";
        $db->setQuery($account_info);
        $account_result = $db->loadRow();
         

        if ($isAdmin) {
           $query="SELECT a.*,CASE a.block WHEN 0 THEN 'Active' ELSE 'Inactive' END as status,group_concat(b.group_id) as ucheckbox,group_concat(c.title) as title,c.id as groupid from `#__users` a left join `#__user_usergroup_map` b on a.id=b.user_id left join `#__usergroups` c on b.group_id=c.id group by a.id ORDER BY a.id ASC";
            $db->setQuery($query);
            $rows=$db->loadObjectList();
            return $rows;
        }elseif ($groupNames=='ums') {
           $query="SELECT a.*,CASE a.block WHEN 0 THEN 'Active' ELSE 'Inactive' END as status,group_concat(b.group_id) as ucheckbox,group_concat(c.title) as title,c.id as groupid from `#__users` a left join `#__user_usergroup_map` b on a.id=b.user_id left join `#__usergroups` c on b.group_id=c.id WHERE a.id IN (SELECT user_id FROM `#__dolo_account_user_mapping` WHERE account_id=$account_result[0]) group by a.id ORDER BY a.id ASC";
            $db->setQuery($query);
            $rows=$db->loadObjectList();
            return $rows;
        }else {
            $query="SELECT a.*,CASE a.block WHEN 0 THEN 'Active' ELSE 'Inactive' END as status,group_concat(b.group_id) as ucheckbox,group_concat(c.title) as title,c.id as groupid FROM `#__users` a,`#__user_usergroup_map` b,`#__usergroups` c where a.id=$userId and a.id=b.user_id and  b.group_id=c.id ORDER BY a.id ASC";

            $db->setQuery($query);
            $rows=$db->loadObjectList();
            return $rows;
        }
   }

        public function getActiveusers(){
        $db1=JFactory::getDBO();

        $query1="SELECT a.name,a.username,a.email,CASE a.block WHEN 0 THEN 'Active' ELSE 'Inactive' END as status,a.lastvisitDate,group_concat(b.group_id) as ucheckbox,group_concat(c.title) as title,c.id as groupid from `#__users` a left join `#__user_usergroup_map` b on a.id=b.user_id left join `#__usergroups` c on b.group_id=c.id where a.block=0 group by a.id ORDER BY a.id ASC";
            $db1->setQuery($query1);
            $rows1=$db1->loadObjectList();
            return $rows1;
        }

       public function getInactiveusers(){
         $db1=JFactory::getDBO();
         $query1="SELECT a.name,a.username,a.email,CASE a.block WHEN 0 THEN 'Active' ELSE 'Inactive' END as status,a.lastvisitDate,group_concat(b.group_id) as ucheckbox,group_concat(c.title) as title,c.id as groupid from `#__users` a left join `#__user_usergroup_map` b on a.id=b.user_id left join `#__usergroups` c on b.group_id=c.id where a.block=1 group by a.id ORDER BY a.id ASC";
            $db1->setQuery($query1);
            $rows1=$db1->loadObjectList();
            return $rows1;
          }
            public function getMultipleUsers($value){
            $db=JFactory::getDBO();
            $query1=" SELECT COUNT( username ) as total FROM `#__users` WHERE username='$value' ";
            $db->setQuery($query1);
            $rows1=$db->loadObjectList();
            return $rows1;
        }

        public function getGroupID($value){
            $db=JFactory::getDBO();
            $query1="SELECT id FROM `#__usergroups` WHERE title='$value' ";
            $db->setQuery($query1);
            $rows1=$db->loadObjectList();
            return $rows1;
        }

        public function insertUsers($name,$username,$email,$password) {
            $db=JFactory::getDBO();
            $crton =date("Y-m-d H:i:s");
            $query = $db->getQuery(true);
            $columns = array('name', 'username','email', 'password','registerDate');
            $values = array( $db->quote($name), $db->Quote($username),$db->quote($email),$db->Quote(md5($password)),$db->Quote($crton));
            $query
                ->insert($db->quoteName('#__users'))
                ->columns($db->quoteName($columns))
                ->values(implode(',', $values));
            $db->setQuery($query);
            if (!$db->query()) {
            JError::raiseError(500, $db->getErrorMsg());
                return false;
            }

            return true;
        }

        public function getUserID($name,$username){
            $db=JFactory::getDBO();
            $query1="SELECT max(id) as id FROM `#__users` WHERE name='".$name."' AND username='".$username."' ";
            $db->setQuery($query1);
            $rows1=$db->loadObjectList();
            return $rows1;
        }

        public function insertUserGroup($userID,$id) {
            $db=JFactory::getDBO();

            $query = $db->getQuery(true);
            $columns = array('user_id', 'group_id');
            $values = array( $db->quote($userID), $db->Quote($id));
            $query
                ->insert($db->quoteName('#__user_usergroup_map'))
                ->columns($db->quoteName($columns))
                ->values(implode(',', $values));
            $db->setQuery($query);
            if (!$db->query()) {
            JError::raiseError(500, $db->getErrorMsg());
                return false;
            }
            return true;
        }
        public function blockUser($uid) {
            $db =  JFactory::getDBO(); 
            $a=1;  
           $update_query = "UPDATE `#__users` SET block = $a where id = $uid ";
             $db->setQuery( $update_query );
             $db->query(); 
             return true;
        }

        public function unblockUser($uid) {
             $db =  JFactory::getDBO();
             $b=0;
           $update_query = "UPDATE `#__users` SET block = $b where id = $uid ";
             $db->setQuery( $update_query );
             $db->query();
              return true;
        }

        public function deleteUser($uid) {
         $db =  JFactory::getDBO();   
          $delete_query = "DELETE FROM `#__users` WHERE id = $uid ";
             $db->setQuery( $delete_query );
             $db->query();

    $delete_query1 = "DELETE FROM `#__user_usergroup_map` WHERE user_id = $uid ";
             $db->setQuery( $delete_query1 );
             $db->query();
              return true;

        }
         public function getGroupName($groupId){
            $db = JFactory::getDbo();
            $query = $db->getQuery(true);
            $query->select('title')->from('#__usergroups')->where('id IN (' . implode(',', $groupId) . ') AND title="ums" ');
            $db->setQuery($query);
            $groupsLabels = $db->loadColumn();
            return $groupsLabels;
        }
 
}