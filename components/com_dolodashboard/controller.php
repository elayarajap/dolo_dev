<?php
/**
**/
// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.controller');


class DoloDashboardController extends JControllerLegacy
{

	public function display($cachable = false, $urlparams = false)
	{
    $vName = $this->input->getCmd('view', 'default');
    $this->input->set('view', $vName);

		return parent::display($cachable, $urlparams);
	}

}
