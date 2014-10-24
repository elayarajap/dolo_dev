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
 * Account controller class.
 */
class DoloControllerAccount extends JControllerForm
{

    function __construct() {
        $this->view_list = 'accounts';
        parent::__construct();
    }

}