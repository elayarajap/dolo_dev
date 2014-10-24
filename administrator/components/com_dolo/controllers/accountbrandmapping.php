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
 * Accountbrandmapping controller class.
 */
class DoloControllerAccountbrandmapping extends JControllerForm
{

    function __construct() {
        $this->view_list = 'accountbrandmappings';
        parent::__construct();
    }

}