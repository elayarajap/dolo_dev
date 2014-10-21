<?php
/**
 * 
 * @author Mshah Info Technologies
 *
 * @copyright  Copyright (C) 2014 mshahtech.com . All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

// No direct access to this file
defined('_JEXEC') or die('Access Deny');


// Include dependancy of the main controllerform class
jimport('joomla.application.component.controllerform');
 
 /**
 *  MshahfrontendusermanagerControllerMaintenanceProvider class
 */
 class MshahfrontendusermanagerControllerMaintenanceProvider extends JControllerForm
 {
 	
 	  public function getModel($name = '', $prefix = '', $config = array('ignore_request' => true))
        {
                return parent::getModel($name, $prefix, array('ignore_request' => false));
        }

        public function submit()
        {
                // Check for request forgeries.
                JRequest::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
 
                // Initialise variables.
                $app    = JFactory::getApplication();
                $model  = $this->getModel('maintenanceprovider');
 
                // Get the data from the form POST
                $data = JRequest::getVar('jform', array(), 'post', 'array');
 
		        // Now update the loaded data to the database via a function in the model
		        $insertData  = $model->insertData($data);
		 
		        // check if ok and display appropriate message.  This can also have a redirect if desired.
		        if ($insertData) {
		                  $msg = JText::_( 'Data Successfully Saved');
		               //$return = JURI::base().'index.php/mshahfrontendusermanager';
		                  //$this->setRedirect($return);
		                  $this->setRedirect(JRoute::_('index.php?option=com_mshahfrontendusermanager&view=reports&task=providers', false));
		              // $link = JRoute::_('&view=reports&task=providers', false);
		               
		          } else {
		              echo "<h2>Failed to be save</h2>";
		          }
		 
		                return true;
		        }        

}
