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

    function getItemTagsFilter($item){
    	require_once JPATH_BASE.'/components/com_k2/models/item.php';

    	$K2ModelItem = new K2ModelItem;

        $tags = array();
    	$itemTags = $K2ModelItem->getItemTags($item->id);
    	if(count($itemTags)) {
    		foreach ($itemTags as $tag) {
                $tagName = str_replace(" ", "-", $tag->name);
                $tags[] = strtolower($tagName);
            }
    	}
        $filter = implode(" ", $tags);

        return $filter;
    }
    function getCats($catid=0){
        $db =  JFactory::getDbo();
        $query=$db->getQuery(true);
        array('a.published=1','a.trash=0');
        if((int)$catid!=0){
            $where ='a.catid='.(int)$catid;
        }
        $query 		->select('a.id')
            ->from('#__k2_items AS a')
            ->where($where)
            ->order('created ASC');
        $db->setQuery($query,0,'All');

        return $db->loadObjectList();
    }

    function getTagsFilter($catid){

		$items = getCats($catid);

		$catTags = array();

		$allTags = array();

		$tags = array();

		if(count($items)){


			require_once JPATH_BASE.'/components/com_k2/models/item.php';

			$K2ModelItem = new K2ModelItem;

			foreach ($items as $item) {
				$catTags[] = $K2ModelItem->getItemTags($item->id);
			}
			
			if(!empty($catTags)){
				foreach ($catTags as $catTag) {
					if (!empty($catTag)) {
						foreach ($catTag as $tag) {
							$allTags[] = $tag->name;
						}
					}
				}
			}

			$tags = array_unique($allTags);
		}
		return $tags;
	}
	$catid = $this->category->id;

	$tagsFilter = getTagsFilter($catid);
?>


	<?php if((isset($this->leading) || isset($this->primary) || isset($this->secondary) || isset($this->links)) && (count($this->leading) || count($this->primary) || count($this->secondary) || count($this->links))): ?>

	<div class="categorize-blog">
		<div class="title-section">
			<div class="container triggerAnimation animated" data-animate="bounceIn">
				<h1><?php echo $this->category->name;?></h1>
				<ul class="filter">
					<li><a href="#" class="active" data-filter="*"><?php echo JText::_('TPL_MARBLE_FILTER_ALL_TEXT');?></a></li>
					<?php if(isset($tagsFilter) && count($tagsFilter)): foreach($tagsFilter as $tag): ?>
						<li><a href="#" data-filter=".<?php echo strtolower(str_replace(" ","-",$tag)); ?>"><?php echo $tag; ?></a></li>
					<?php endforeach; endif; ?>
				</ul>
			</div>
		</div>				
	</div>

	<!-- blog-section 
		================================================== -->
	<div class="section-content blog-section second-style">
		<div class="container">
  			<div class="blog-box masonry one-col triggerAnimation animated" data-animate="slideInUp">

		<?php if(isset($this->leading) && count($this->leading)): ?>
		<!-- Leading items -->
			<?php foreach($this->leading as $key=>$item): ?>

				<?php
					// Load category_item.php by default
					$this->item=$item;
					echo $this->loadTemplate('item');
				?>
			<?php endforeach; ?>
		<?php endif; ?>

		<?php if(isset($this->primary) && count($this->primary)): ?>
		<!-- Primary items -->
			<?php foreach($this->primary as $key=>$item): ?>

				<?php
					// Load category_item.php by default
					$this->item=$item;
					echo $this->loadTemplate('item');
				?>
			<?php endforeach; ?>
		<?php endif; ?>

		<?php if(isset($this->secondary) && count($this->secondary)): ?>
		<!-- Secondary items -->
			<?php foreach($this->secondary as $key=>$item): ?>
			
			
				<?php
					// Load category_item.php by default
					$this->item=$item;
					echo $this->loadTemplate('item');
				?>

			<?php endforeach; ?>
		<?php endif; ?>

		<?php if(isset($this->links) && count($this->links)): ?>
		<!-- Link items -->
		<div id="itemListLinks">
			<h4><?php echo JText::_('K2_MORE'); ?></h4>
			<?php foreach($this->links as $key=>$item): ?>
				<?php
					// Load category_item_links.php by default
					$this->item=$item;
					echo $this->loadTemplate('item_links');
				?>
			<?php endforeach; ?>
			
		</div>
		<?php endif; ?>
	</div>
	
	<!-- Pagination -->
	<?php if($this->pagination->getPagesLinks()): ?>
	<div class="k2Pagination">
		<?php if($this->params->get('catPagination')) echo $this->pagination->getPagesLinks(); ?>
	</div>
	<?php endif; ?>
	</div>
          		<a class="go-top" href="#"><i class="fa fa-arrow-circle-o-up"></i></a>
			</div>

	<?php endif; ?>
