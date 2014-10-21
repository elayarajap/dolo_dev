<?php
/**
 * 
 * @author Mshah Info Technologies
 *
 * @copyright  Copyright (C) 2014 mshahtech.com . All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */
 
// no direct access
 
defined( '_JEXEC' ) or die( 'Restricted access' );
 
jimport( 'joomla.application.component.view');
 
/**
 *
 *  MshahfrontendusermanagerViewmshahfrontendusermanager
 */
 
class MshahfrontendusermanagerViewMshahfrontendusermanager extends JViewLegacy
{	
	 function display($tpl = null)
    {
         $msg = "Documentation for Mshah Frontend User Manager @Mshah info Technologies";
        $this->assignRef( 'msg', $msg );
        parent::display($tpl);

          echo ' <img style="float:right;" src=".././media/com_mshahfrontendusermanager/images/userlist.jpg">';
       echo "<p><b> 
This component makes it possible to do CURD(Create,Update,Read,Delete) operations from the frontend. The administrator can only add the user and he can also assign the particular group(like:Author,Manager,Editor,Public etc.,) to the user.<br><br>
  
  The administrator can assign a particular user to manage this component by assigning the ums category.This component is very simple to install and manage and there is no need to install any third part integration to use this component.<br><br>

  This component has an advantage to add a single user and you can also add mutiple users by uploading the csv file.You can also assign the category(like registered,publisher,author etc) at the time of user creation.We are providing a special 'UMS' category
  to manage this component.If the administrator assign this ums category to the user, then that user can manage the users.<br><br>

  This component will provide the ability to manage these users by sending emails at the time of user creation.You can also save the user either in pdf format or csv format.We are also integrated one report(active/inactive userlist).<br><br>

  For any queries you can also mail to info@mshahtech.com
 </p>";
    }

}