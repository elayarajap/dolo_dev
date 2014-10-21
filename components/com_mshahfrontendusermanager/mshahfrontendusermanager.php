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


$controller = JControllerLegacy::getInstance('Mshahfrontendusermanager');
//$controller->execute(JRequest::getCmd('task'));
$controller->execute(JFactory::getApplication()->input->get('task'));


$controller->redirect();