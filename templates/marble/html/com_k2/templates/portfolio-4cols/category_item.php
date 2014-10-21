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

// Define default image size (do not change)
K2HelperUtilities::setDefaultImage($this->item, 'itemlist', $this->params);
$filter = getItemTagsFilter($this->item);

?>
<div class="project-post <?php echo $filter;?>">
	<div class="project-gal">
		<img alt="<?php echo $this->item->title;?>" src="<?php echo getK2ItemImage($this->item->id, 'L') ;?>">
		<div class="hover-box">
			<a class="zoom" href="<?php echo getK2ItemImage($this->item->id, 'L') ;?>"><i class="fa fa-search-plus"></i></a>
			<a class="link" href="<?php echo getK2ItemLink($this->item->id, $this->item->alias, $this->item->catid, $this->item->categoryalias);?>"><i class="fa fa-link"></i></a>
		</div>
	</div>
	<div class="project-content">
		<h2><?php echo $this->item->title;?></h2>
		<?php echo $this->item->introtext;?>
	</div>
</div>