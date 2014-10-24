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

/**
 * Dolo helper.
 */
class DoloHelper {

    /**
     * Configure the Linkbar.
     */
    public static function addSubmenu($vName = '') {
        		JHtmlSidebar::addEntry(
			JText::_('COM_DOLO_TITLE_CAMPAIGNS'),
			'index.php?option=com_dolo&view=campaigns',
			$vName == 'campaigns'
		);
		JHtmlSidebar::addEntry(
			JText::_('COM_DOLO_TITLE_BRANDS'),
			'index.php?option=com_dolo&view=brands',
			$vName == 'brands'
		);
		JHtmlSidebar::addEntry(
			JText::_('COM_DOLO_TITLE_CAMPAIGNTYPES'),
			'index.php?option=com_dolo&view=campaigntypes',
			$vName == 'campaigntypes'
		);
		JHtmlSidebar::addEntry(
			JText::_('COM_DOLO_TITLE_CAMPAIGNSTATUSS'),
			'index.php?option=com_dolo&view=campaignstatuss',
			$vName == 'campaignstatuss'
		);
		JHtmlSidebar::addEntry(
			JText::_('COM_DOLO_TITLE_ACCOUNTS'),
			'index.php?option=com_dolo&view=accounts',
			$vName == 'accounts'
		);
		JHtmlSidebar::addEntry(
			JText::_('COM_DOLO_TITLE_ACCOUNTBRANDMAPPINGS'),
			'index.php?option=com_dolo&view=accountbrandmappings',
			$vName == 'accountbrandmappings'
		);
		JHtmlSidebar::addEntry(
			JText::_('COM_DOLO_TITLE_ACCOUNTUSERMAPPINGS'),
			'index.php?option=com_dolo&view=accountusermappings',
			$vName == 'accountusermappings'
		);
		JHtmlSidebar::addEntry(
			JText::_('COM_DOLO_TITLE_USERBRANDMAPPINGS'),
			'index.php?option=com_dolo&view=userbrandmappings',
			$vName == 'userbrandmappings'
		);

    }

    /**
     * Gets a list of the actions that can be performed.
     *
     * @return	JObject
     * @since	1.6
     */
    public static function getActions() {
        $user = JFactory::getUser();
        $result = new JObject;

        $assetName = 'com_dolo';

        $actions = array(
            'core.admin', 'core.manage', 'core.create', 'core.edit', 'core.edit.own', 'core.edit.state', 'core.delete'
        );

        foreach ($actions as $action) {
            $result->set($action, $user->authorise($action, $assetName));
        }

        return $result;
    }


}
