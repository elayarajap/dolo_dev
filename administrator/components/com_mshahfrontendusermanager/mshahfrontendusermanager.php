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


$controller = JControllerLegacy::getInstance('Mshahfrontendusermanager');

$controller->execute(JRequest::getCmd('task'));

$controller->redirect();