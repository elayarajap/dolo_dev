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
 * Campaigntype controller class.
 */
class DoloControllerCampaigntype extends JControllerForm
{

    function __construct() {
        $this->view_list = 'campaigntypes';
        parent::__construct();
    }

}