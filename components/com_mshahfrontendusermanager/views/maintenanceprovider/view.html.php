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
 * HTML MshahfrontendusermanagerView class for the Mshahfrontendusermanager Component
 */
class MshahfrontendusermanagerViewMaintenanceProvider extends JViewLegacy
{
        // Overwriting JView display method
        function display($tpl = null) 
        {
                $app = JFactory::getApplication();
             
                // Get some data from the models
    
                $this->form = $this->get('Form');
 
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