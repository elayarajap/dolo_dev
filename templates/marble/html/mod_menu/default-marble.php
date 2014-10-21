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
?>
<?php // The menu class is deprecated. Use nav instead. ?>
<ul class="<?php echo $class_sfx;?>"<?php
	$tag = '';

	if ($params->get('tag_id') != null)
	{
		$tag = $params->get('tag_id') . '';
		echo ' id="' . $tag . '"';
	}
?>>
<?php
foreach ($list as $i => &$item)
{
	//echo '<pre>';var_dump($item);die;
	$class = 'item-' . $item->id;

	// if ($item->id == $active_id)
	// {
	// 	$class .= ' current';
	// }

	// if (in_array($item->id, $path) || $item->id == $active_id)
	// {
	// 	$class .= ' active';
	// }
	// elseif ($item->type == 'alias')
	// {
	// 	$aliasToId = $item->params->get('aliasoptions');

	// 	if (count($path) > 0 && $aliasToId == $path[count($path) - 1])
	// 	{
	// 		$class .= ' active';
	// 	}
	// 	elseif (in_array($aliasToId, $path))
	// 	{
	// 		$class .= ' alias-parent-active';
	// 	}
	// }

	if ($item->type == 'separator')
	{
		$class .= ' divider';
	}

	if ($item->deeper)
	{
		$class .= ' deeper';
	}

	if ($item->parent)
	{
		$class .= ' parent';
	}
	
	$anchor_css_array = explode(" ", trim($item->anchor_css));

	if(in_array('drop', $anchor_css_array)){
		$class .= ' drop';
	}
	
	if (!empty($class))
	{
		$class = ' class="' . trim($class) . '"';
	}

	echo '<li' . $class . '>';

	// Render the menu item.
	switch ($item->type) :
		case 'separator':
		case 'url':
		case 'component':
		case 'heading':
			require JModuleHelper::getLayoutPath('mod_menu', 'default-marble_' . $item->type);
			break;

		default:
			require JModuleHelper::getLayoutPath('mod_menu', 'default-marble_url');
			break;
	endswitch;

	// The next item is deeper.
	if ($item->deeper)
	{
		echo '<ul class="drop-down'.(($item->level == '2')? ' level3' : '' ).'">';
	}
	elseif ($item->shallower)
	{
		// The next item is shallower.
		echo '</li>';
		echo str_repeat('</ul></li>', $item->level_diff);
	}
	else
	{
		// The next item is on the same level.
		echo '</li>';
	}
}
?></ul>
