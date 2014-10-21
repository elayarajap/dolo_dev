<?php
/**
 * @version     1.0.0
 * @package     com_dolo
 * @copyright   
 * @license     
 * @author       <> - 
 */

defined('_JEXEC') or die;

// Include dependancies
jimport('joomla.application.component.controller');

// Execute the task.
$controller	= JControllerLegacy::getInstance('Dolo');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();
