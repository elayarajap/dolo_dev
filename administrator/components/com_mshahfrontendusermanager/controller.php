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
        JToolBarHelper::Title('Mshah Frontend User Manager','mshahums');
		 parent::display();
	}
}
