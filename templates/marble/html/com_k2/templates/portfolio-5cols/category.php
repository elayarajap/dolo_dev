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

	function getK2ItemImage($id,$size='XS'){
		return JURI::root(true).'/media/k2/items/cache/'.md5("Image".$id).'_'.$size.'.jpg';
	}


	function getK2ItemLink($id,$alias,$catid,$categoryalias){
		require_once (JPATH_SITE.'/components/com_k2/helpers/route.php');
		return urldecode(JRoute::_(K2HelperRoute::getItemRoute($id.':'.urlencode($alias), $catid.':'.urlencode($categoryalias))));
	}

	$catid = $this->category->id;

	$tagsFilter = getTagsFilter($catid);
    //echo'<pre>';var_dump($this->category);die;
?>
<?php if((isset($this->leading) || isset($this->primary) || isset($this->secondary) || isset($this->links)) && (count($this->leading) || count($this->primary) || count($this->secondary) || count($this->links))): ?>
<!-- portfolio-section 
	================================================== -->
<div class="section-content portfolio-section">
<?php if(!empty($this->category->description)) : ?>
	<div class="title-section white">
		<div class="container">
			<?php echo $this->category->description;?>
		</div>
	</div>
<?php endif;?>
	<div class="portfolio-box">
		<ul class="filter">
			<li><a href="#" class="active" data-filter="*"><?php echo JText::_('TPL_MARBLE_FILTER_ALL_TEXT');?></a></li>
			<?php if(isset($tagsFilter) && count($tagsFilter)): foreach($tagsFilter as $tag): ?>
				<li><a href="#" data-filter=".<?php echo strtolower(str_replace(" ","-",$tag)); ?>"><?php echo $tag; ?></a></li>
			<?php endforeach; endif; ?>
		</ul>
		<div class="masonry five-col">

		<?php if(isset($this->leading) && count($this->leading)): ?>
		<!-- Leading items -->
			<?php foreach($this->leading as $item): ?>

				<?php
					// Load category_item.php by default
					$this->item=$item;
					echo $this->loadTemplate('item');
				?>
			<?php endforeach; ?>
		<?php endif; ?>

		<?php if(isset($this->primary) && count($this->primary)): ?>
		<!-- Primary items -->
			<?php foreach($this->primary as $item): ?>

				<?php
					// Load category_item.php by default
					$this->item=$item;
					echo $this->loadTemplate('item');
				?>
			<?php endforeach; ?>
		<?php endif; ?>

		<?php if(isset($this->secondary) && count($this->secondary)): ?>
		<!-- Secondary items -->
			<?php foreach($this->secondary as $item): ?>
			
			
				<?php
					// Load category_item.php by default
					$this->item=$item;
					echo $this->loadTemplate('item');
				?>

			<?php endforeach; ?>
		<?php endif; ?> 
		</div>
	</div>
	<!-- Pagination -->
	<?php if($this->pagination->getPagesLinks()): ?>
	<div class="k2Pagination">
		<?php if($this->params->get('catPagination')) echo $this->pagination->getPagesLinks(); ?>
	</div>
	<?php endif; ?>
</div>

<?php endif; ?>
