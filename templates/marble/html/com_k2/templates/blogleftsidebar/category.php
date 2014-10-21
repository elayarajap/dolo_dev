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


	<?php if((isset($this->leading) || isset($this->primary) || isset($this->secondary) || isset($this->links)) && (count($this->leading) || count($this->primary) || count($this->secondary) || count($this->links))): ?>
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
