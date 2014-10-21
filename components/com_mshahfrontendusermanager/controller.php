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

// import joomla controller
jimport('joomla.application.component.controller');

/**
*  Mshahfrontendusermanager frontend class
*/
class MshahfrontendusermanagerController extends JControllerLegacy {

public function display($chaseble=false,$urlparams = false)
	{
		$doc=Jfactory::getDocument();
        $doc->addStyleSheet(JURI ::root().'media/com_mshahfrontendusermanager/css/mshahfrontendusermanager.css');        
        parent::display();
	}
	
	public function blockUser() {

    $res = JRequest::getVar('checkbox', '', 'get', 'cmd');
    if(isset($res))
    {
    $model = $this->getModel('Reports');   
    $model->blockUser($uid=$res);
   }
}
    public function unblockUser() {

    $res = JRequest::getVar('checkbox', '', 'get', 'cmd');
        if(isset($res))
        {
        $model = $this->getModel('Reports');   
        $model->unblockUser($uid=$res);
        }
    }

     public function deleteUser() {

    $res = JRequest::getVar('checkbox', '', 'get', 'cmd');
        if(isset($res))
        {
        $model = $this->getModel('Reports');   
        $model->deleteUser($uid=$res);
        }
    }
}
