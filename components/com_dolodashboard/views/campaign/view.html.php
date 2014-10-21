<?php
/**
**/
// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.view');

class DoloDashboardViewDCampaign extends JViewLegacy
{

	protected $params;

	public function display($tpl = null)
	{
		$app	= JFactory::getApplication();
		$params = $app->getParams();
		$menus	= $app->getMenu();
		$menu	= $menus->getActive();
    
    $document = JFactory::getDocument();
  
    //add the chart scripts
    $document->addScript('/includes/charts/js/jchartfx.system.js');
    $document->addScript('/includes/charts/js/jchartfx.coreVector.js');
    $document->addScript('/includes/charts/js/jchartfx.coreVector3D.js');
    $document->addScript('/includes/charts/js/jchartfx.advanced.js');
    $document->addScript('/includes/charts/js/jchartfx.gauge.js');
    $document->addScript('/includes/charts/js/jchartfx.motif.aurora.js');
    
		if ($menu)
		{
			$params->set('page_heading', $params->get('page_title', $menu->title));
		}
		else
		{
			$params->set('page_title',	JText::_('Dolo Dashboard'));
		}

		$title = $params->get('page_title');
		if ($app->getCfg('sitename_pagetitles', 0)) {
			$title = JText::sprintf('JPAGETITLE', $app->getCfg('sitename'), $title);
		}
		$this->document->setTitle($title);

		if ($params->get('menu-meta_description'))
		{
			$this->document->setDescription($params->get('menu-meta_description'));
		}

		if ($params->get('menu-meta_keywords')) 
		{
			$this->document->setMetadata('keywords', $params->get('menu-meta_keywords'));
		}

		if ($params->get('robots')) 
		{
			$this->document->setMetadata('robots', $params->get('robots'));
		}

		$this->assignRef('params',		$params);

		parent::display($tpl);
	}
}
