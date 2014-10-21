<?php
/**
 * @version		2.6.x
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.net
 * @copyright	Copyright (c) 2006 - 2014 JoomlaWorks Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die;
?>

	<?php if(count($items)): ?>
  <ul class="popular-list">
    <?php foreach ($items as $key=>$item):	?>
    <li>
    <?php if($params->get('itemImage')) : ?>
		<img src="<?php echo $item->image; ?>" width="60" height="60" alt="<?php echo K2HelperUtilities::cleanHtml($item->title); ?>"/>
    <?php endif;?>
<?php if($params->get('itemTitle') || $params->get('itemDateCreated')): ?>
    <div class="side-content">

		<h2><a href="<?php echo $item->link; ?>"><?php echo $item->title; ?></a></h2>
		<p><?php echo JHTML::_('date', $item->created, JText::_('F, d Y')); ?></p>
	</div>
<?php endif;?>
    </li>
    <?php endforeach; ?>
  </ul>
  <?php endif;?>