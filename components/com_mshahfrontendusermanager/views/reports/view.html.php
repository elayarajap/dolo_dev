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
 
// import Joomla view library
jimport('joomla.application.component.view');
 
/**
 * HTML User Reports class for the Mshahfrontendusermanager Component
 */
class MshahfrontendusermanagerViewReports extends JViewLegacy
{
       
        protected $userlist;
        protected $val;
        
        // Overwriting JView display method
        function display($tpl = null) 
        {
                $app  = JFactory::getApplication();
                
                $tpl = JRequest::getCmd('task',null);
                $model = $this->getModel();
                if(isset($_REQUEST['active']))
                {
                $this->val = 0;
                $this->userlist =$model->getActiveusers(); 
                                } 
                elseif(isset($_REQUEST['inactive']))
                {
                $this->val = 1;    
                $this->userlist =$model->getInactiveusers(); 
               
                }    
                else
                {
                 $this->userlist =$model->getUsers(); 
                 $this->val = 2;
                }
                // Get some data from the models
    
 
                // Check for errors.
                if (count($errors = $this->get('Errors'))) 
                {
                        JError::raiseError(500, implode('<br />', $errors));
                        return false;
                }
                // Display the view
                parent::display($tpl);
        }
}