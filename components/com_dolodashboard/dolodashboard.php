<?php
/***
**/

defined( '_JEXEC' ) or die( 'Restricted access' );

$app = JFactory::getApplication();


include_once JPATH_SITE.'/test.php';


$admin = $app->isAdmin();

if($admin==1)
	{
?>
<div>
  This is the main dashboard controller site.
</div>
<?php
	}
else
	{
  
	jimport('joomla.application.component.controller');

	// Create the controller
	$controller = JControllerLegacy::getInstance('DoloDashboard');

	// Perform the Request task
	$controller->execute(JRequest::getCmd('task'));

	// Redirect if set by the controller
	$controller->redirect();
	}

 ?>
