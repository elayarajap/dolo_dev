<?php
/**
 * @version     1.0.0
 * @package     com_image
 * @copyright   
 * @license     
 * @author       <> - 
 */

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.controllerform');

/**
 * Upload controller class.
 */
class ImageControllerUpload extends JControllerForm
{

    function __construct() {
        $this->view_list = 'uploads';
        parent::__construct();
    }

}