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

function treerecurse(&$params, $id = 0, $level = 0, $begin = false)
	{

		static $output;
		if ($begin)
		{
			$output = '';
		}
		$mainframe = JFactory::getApplication();
		$root_id = (int)$params->get('root_id');
		$end_level = $params->get('end_level', NULL);
		$id = (int)$id;
		$catid = JRequest::getInt('id');
		$option = JRequest::getCmd('option');
		$view = JRequest::getCmd('view');

		$user = JFactory::getUser();
		$aid = (int)$user->get('aid');
		$db = JFactory::getDBO();

		switch ($params->get('categoriesListOrdering'))
		{

			case 'alpha' :
				$orderby = 'name';
				break;

			case 'ralpha' :
				$orderby = 'name DESC';
				break;

			case 'order' :
				$orderby = 'ordering';
				break;

			case 'reversedefault' :
				$orderby = 'id DESC';
				break;

			default :
				$orderby = 'id ASC';
				break;
		}

		if (($root_id != 0) && ($level == 0))
		{
			$query = "SELECT * FROM #__k2_categories WHERE parent={$root_id} AND published=1 AND trash=0 ";

		}
		else
		{
			$query = "SELECT * FROM #__k2_categories WHERE parent={$id} AND published=1 AND trash=0 ";
		}

		if (K2_JVERSION != '15')
		{
			$query .= " AND access IN(".implode(',', $user->getAuthorisedViewLevels()).") ";
			if ($mainframe->getLanguageFilter())
			{
				$languageTag = JFactory::getLanguage()->getTag();
				$query .= " AND language IN (".$db->Quote($languageTag).", ".$db->Quote('*').") ";
			}

		}
		else
		{
			$query .= " AND access <= {$aid}";
		}

		$query .= " ORDER BY {$orderby}";

		$db->setQuery($query);
		$rows = $db->loadObjectList();
		if ($db->getErrorNum())
		{
			echo $db->stderr();
			return false;
		}

		if ($level < intval($end_level) || is_null($end_level))
		{
			$output .= '<ul class="category-list">';
			foreach ($rows as $row)
			{

				if (modK2ToolsHelper::hasChildren($row->id))
				{
					$output .= '<li><a href="'.urldecode(JRoute::_(K2HelperRoute::getCategoryRoute($row->id.':'.urlencode($row->alias)))).'">'.$row->name.'</a>';
					treerecurse($params, $row->id, $level + 1);
					$output .= '</li>';
				}
				else
				{
					$output .= '<li><a href="'.urldecode(JRoute::_(K2HelperRoute::getCategoryRoute($row->id.':'.urlencode($row->alias)))).'">'.$row->name.'</a></li>';
				}
			}
			$output .= '</ul>';
		}

		return $output;
	}

	$output = treerecurse($params);

?>
	<?php echo $output; ?>

