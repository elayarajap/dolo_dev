<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_menu
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Note. It is important to remove spaces between elements.
$class = $item->anchor_css ? 'class="' . $item->anchor_css . '" ' : '';
$title = $item->anchor_title ? 'title="' . $item->anchor_title . '" ' : '';

if ($item->menu_image)
	{
		$item->params->get('menu_text', 1) ?
		$linktype = '<img src="' . $item->menu_image . '" alt="' . $item->title . '" /><span class="image-title">' . $item->title . '</span> ' :
		$linktype = '<img src="' . $item->menu_image . '" alt="' . $item->title . '" />';
}
else
{
	$linktype = $item->title;
}

$flink = $item->flink;
$flink = JFilterOutput::ampReplace(htmlspecialchars($flink));

//require_once JPATH_ROOT.'/components/com_k2/helpers/route.php';

//$searchAction = JRoute::_(K2HelperRoute::getSearchRoute());

switch ($item->browserNav) :
	default:
	case 0:
	if(in_array('open-search', $anchor_css_array)): ?>
	<a <?php echo $class; ?> href="<?php echo $flink; ?>" <?php echo $title; ?>><i class="fa fa-search"></i></a>
	<form class="form-search"  action="index.php" method="post" >
		<input type="search" name="searchword" placeholder="Search:"/>
		<button type="submit">
			<i class="fa fa-search"></i>
		</button>
		<input type="hidden" name="task" value="search" />
		<input type="hidden" name="option" value="com_search" />
		<!-- 		
		<input type="hidden" name="option" value="com_k2" />
		<input type="hidden" name="view" value="itemlist" />
		<input type="hidden" name="task" value="search" /> -->
	</form>
	<?php else: ?>
	<a <?php echo $class; ?> href="<?php echo $flink; ?>" <?php echo $title; ?>><?php echo $linktype; ?></a>
	<?php endif;
		break;
	case 1:
		// _blank
?><a <?php echo $class; ?> href="<?php echo $flink; ?>" target="_blank" <?php echo $title; ?>><?php echo $linktype; ?></a><?php
		break;
	case 2:
		// window.open
		$options = 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,'.$params->get('window_open');
			?><a <?php echo $class; ?>href="<?php echo $flink; ?>" onclick="window.open(this.href,'targetWindow','<?php echo $options;?>');return false;" <?php echo $title; ?>><?php echo $linktype; ?></a><?php
		break;
endswitch;
