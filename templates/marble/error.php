<?php
/**
 * @package     CTHthemes.com
 * @subpackage  Templates.Marble
 *
 * @copyright   Copyright (C) 2014 CTHthemes.com All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Getting params from template
$params = JFactory::getApplication()->getTemplate(true)->params;
$app = JFactory::getApplication();
if ($this->error->getCode() == '404' || $this->error->getCode()=='500') {
	$app->redirect(JRoute::_('index.php?Itemid='. (int)$params->get('error',131)));
	exit;
}
