<?php
/**
 * @version     1.0.0
 * @package     com_dolo
 * @copyright   
 * @license     
 * @author       <> - 
 */

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.controllerform');

/**
 * Campaignstatus controller class.
 */
class DoloControllerCampaignstatus extends JControllerForm
{

    function __construct() {
        $this->view_list = 'campaignstatuss';
        parent::__construct();
    }

}