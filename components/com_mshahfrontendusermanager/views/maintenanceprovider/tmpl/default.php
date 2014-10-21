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
 
JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidation');
JHtml::_('behavior.tooltip');

 require_once("./configuration.php");
$jconfig = new JConfig();
$db_error = "I am sorry! There is an error in db connection.";
$db_config = mysql_connect( $jconfig->host, $jconfig->user, $jconfig->password ) or die( $db_error );
mysql_select_db( $jconfig->db, $db_config ) or die( $db_error );


        $document = JFactory::getDocument();
        $document->addScript(JURI::root().'./media/com_mshahfrontendusermanager/js/user.js');

        $db=JFactory::getDBO();
        $user = JFactory::getUser();
        $isAdmin = $user->get('isRoot');

                

        $groups = JUserHelper::getUserGroups($user->get('id'));

             $model = $this->getModel('maintenanceprovider');
             $groupsLabels = $model->getGroupName($groups);
             if(isset($groupsLabels))
             {
                foreach ($groupsLabels as $groupLabel) {
                    $groupNames = $groupLabel;
                }   
             }

if($isAdmin || isset($_POST['uid']) || isset($groupNames)=='ums' ){

         if(isset($_POST['uid']))
         {
            $model = $this->getModel('maintenanceprovider');
            $uid = $_REQUEST['uid'];
            $message = 'Update User Info';
            $button = 'Update';

            $res1 = $model->getUserInfo($uid=$uid);
            foreach ($res1 as $value) {
                $name = $value->name;
                $username = $value->username;
                $password = $value->password;
                $email  = $value->email;
                $block  = $value->block;
                $checkboxResult= $value->ucheckbox;
                $title = $value->title;
            }     
        } else {
            $message='Add User';
            $uid=null;
            $name = null;
            $username=null;
            $password=null;
            $email=null;
            $block=null;
            $groupid=null;
            $checkboxResult=null;
            $button = 'Save';
         }
 

    ?>

    <form class="form-validate pure-form pure-form-aligned" action="<?php echo JRoute::_('index.php'); ?>" method="post" id="maintenanceprovider" name="maintenanceprovider" OnSubmit="return fncSubmit();">
    <td class='cls2'><?php echo $this->form->getInput('id',null,$uid) ?></td></tr>
    <td class='cls2'><?php echo $this->form->getInput('password1',null,$password) ?></td></tr>

    <table id='tablecss'>
        <h1><?php echo $message; ?></h1>
   

    <tr>
        <td class='cls1'><?php echo $this->form->getLabel('name'); ?></td>
        <td class='cls2'><?php echo $this->form->getInput('name',null,$name) ?></td></tr>

        <tr>
        <td class='cls1'><?php echo $this->form->getLabel('username'); ?></td>
        <td class='cls2'><?php echo $this->form->getInput('username',null,$username); ?></td></tr>


        <tr>
        <td class='cls1'><?php echo $this->form->getLabel('password'); ?></td>
        <td class='cls2'><input type='password' name='password' id='password' value="<?php echo $password; ?>" required=true style="width:300px;" /></td></tr>

        <tr>
        <td class='cls1'><?php echo $this->form->getLabel('confirmpassword'); ?></td>
        <td class='cls2'><input type='password' name='ConPassword' id='ConPassword' value="<?php echo $password; ?>" required=true style="width:300px;" /></td></tr>
       

       <tr>
        <?php
        
         if ($isAdmin || isset($groupNames)=='ums') {
         ?><tr> <td class='cls1'>select group</td><td>
  
        <?php

             if($isAdmin) {
            $result=mysql_query("SELECT id,title from ".$jconfig->dbprefix."usergroups");
            }
            else{
                $result=mysql_query("SELECT id,title from ".$jconfig->dbprefix."usergroups WHERE id IN(3,4)" );
            }
            $checkbox[] = array();
            while($row = mysql_fetch_array($result)) {

            $checked = isset($_REQUEST['checkbox']) ? " checked" : "";
            $my_array = explode(',',$checkboxResult);
            $ID = $row['id'];
            ?>
             
            <input name="checkbox[]" type='checkbox' value="<?php echo $row['id'] ?>" <?php if(in_array($ID, $my_array)) echo( 'checked = "checked"'); ?> /> 
            <?php
            echo $row['title'];
            echo "<br />";
            }
        ?>
</td></tr>
        <?php
         
        } else {
            ?>
           <td class='cls1'><?php echo $this->form->getLabel('group'); ?></td>
                   <td class='cls2'><?php echo $this->form->getInput('group',null,$title,'readonly'); ?></td>

           <?php
        } 

        ?>

       </tr>
        <tr>
        <td class='cls1'><?php echo $this->form->getLabel('email'); ?></td>
        <td class='cls2'><?php echo $this->form->getInput('email',null,$email); ?></td></tr>

        <tr>
        <?php
       if ($isAdmin || isset($groupNames)=='ums') {
        ?>
        <td class='cls1'><?php echo $this->form->getLabel('block'); ?></td>
        <td class='radioCls'><?php echo $this->form->getInput('block',null,$block); ?></td></tr>
        <?php
           } 
        ?>
        
       <tr>
        <td><input type="hidden" name="option" value="com_mshahfrontendusermanager" />
        <input type="hidden" name="task" value="maintenanceprovider.submit" />
        </td></tr>

        <tr>
        <td>

             <a class="btn btn-cancel" href="<?php echo JRoute::_('index.php?option=com_mshahfrontendusermanager&amp;view=reports&amp;task=providers'); ?>" title="<?php echo JText::_('JCANCEL'); ?>"><?php echo JText::_('JCANCEL'); ?></a>
             <button type="submit" class="validate btn btn-primary" id='login_submit'><?php echo JText::_($button); ?></button>
                            <?php echo JHtml::_('form.token'); ?></td>
        <td>
            
      
        </td>
        </tr>
    </table>
    </form>

    <?php
    }
?>
   
    <div class="clr"></div>


