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

$extraFields = json_decode($this->item->extra_fields);
$postType = $extraFields[0]->value;
$postLink = $extraFields[1]->value;
$filter = getItemTagsFilter($this->item);
?>
<div class="blog-post <?php echo $filter;?>">
	<div class="post-date">
		<?php $created_string = explode(" ", JHTML::_('date', $this->item->created , JText::_('DATE_FORMAT_LC3'))); ?><p><span><?php echo $created_string[0];?></span><?php echo $created_string[1];?></p>
	</div>
	<?php if(!empty($postType)) : ?>
	<div class="post-gal">
		<?php if($postType == '1') : ?>
			<img alt="<?php echo $this->item->title;?>" src="<?php echo JURI::root(true).'/'.$postLink;?>">
			<div class="hover-box">
				<a class="link" href="<?php echo $this->item->link; ?>"><i class="fa fa-link"></i></a>
			</div>
		<?php elseif($postType == '2') : ?>
			<div class="flexslider">
				<ul class="slides">
				<?php
			    	foreach ($extraFields as $key => $field) :
			    	if($key > 1) :
		        ?>
					<li>
						<img alt="Image <?php echo ($key+1);?>" src="<?php echo JURI::root(true).'/'.$field->value;?>" />
					</li>
				<?php endif; endforeach; ?>
				</ul>
			</div>
		<?php elseif($postType == '3') : 

		$id = array();
		// get youtube video id from link
		preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $postLink, $id);
        //support embed link pasted at link
        if(empty($id) || !is_array($id)){
            preg_match('/embed[\/]([^\\?\\&]+)[\\?]/', $postLink, $id);
        }



        	if(!empty($id[1])) :
		?>
			<!-- youtube -->
			<iframe class="videoembed" src="http://www.youtube.com/embed/<?php echo $id[1];?>?" frameborder="0" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen="" data-devanime="fadeIn" data-devanime-delay="0.6s"></iframe>
			<!-- End youtube -->
			<?php endif;?>
		<?php elseif($postType == '4') :

		$id = array();
		// get vimeo video id from link
		preg_match('/http:\/\/vimeo.com\/(\d+)$/', $postLink, $id);

			if(!empty($id[1])) :

		?>
			<!-- Vimeo -->
			<iframe class="videoembed" src="http://player.vimeo.com/video/<?php echo $id[1];?>?title=0&amp;byline=0&amp;portrait=0" frameborder="0" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen=""></iframe>
			<!-- End Vimeo -->
			<?php endif;?>
		
		<?php elseif($postType == '5') : 
			$url = str_replace(":", "%3A", $postLink);
		?>
			<iframe class="videoembed" src="https://w.soundcloud.com/player/?url=<?php echo $url;?>&amp;auto_play=false&amp;hide_related=false&amp;visual=true" frameborder="0" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen="" data-devanime="fadeIn" data-devanime-delay="0.6s"></iframe>
		<?php endif;?>
	</div>	
	<?php endif;?>						
	<div class="post-content">
		<div class="content-data">
			<?php if($this->item->params->get('catItemTitle')): ?>
			  <!-- Item title -->
			  <h2>
					<?php if(isset($this->item->editLink)): ?>
					<!-- Item edit link -->
					<span class="catItemEditLink">
						<a class="modal" rel="{handler:'iframe',size:{x:990,y:550}}" href="<?php echo $this->item->editLink; ?>">
							<?php echo JText::_('K2_EDIT_ITEM'); ?>
						</a>
					</span>
					<?php endif; ?>

			  	<?php if ($this->item->params->get('catItemTitleLinked')): ?>
					<a href="<?php echo $this->item->link; ?>">
			  		<?php echo $this->item->title; ?>
			  		</a>
			  	<?php else: ?>
			  	<?php echo $this->item->title; ?>
			  	<?php endif; ?>
				
			  </h2>
			  <?php endif; ?>
			<p>
			<?php if($this->item->params->get('catItemAuthor')): ?>
			<!-- Item Author -->

				<?php echo JText::_('TPL_MARBLE_CREATED_BY_TEXT'); ?>&nbsp; 
				<?php if(isset($this->item->author->link) && $this->item->author->link): ?>
				<a rel="author" href="<?php echo $this->item->author->link; ?>"><?php echo $this->item->author->name; ?></a>
				<?php else: ?>
				<?php echo $this->item->author->name; ?>
				<?php endif; ?>
			<?php endif; ?> | 
				<?php if($this->item->params->get('catItemCommentsAnchor') && ( ($this->item->params->get('comments') == '2' && !$this->user->guest) || ($this->item->params->get('comments') == '1')) ): ?>
		<!-- Anchor link to comments below -->
		
			<?php if(!empty($this->item->event->K2CommentsCounter)): ?>
				<!-- K2 Plugins: K2CommentsCounter -->
				<?php echo $this->item->event->K2CommentsCounter; ?>
			<?php else: ?>
				<?php if($this->item->numOfComments > 0): ?>
				<a href="<?php echo $this->item->link; ?>#itemCommentsAnchor">
					<?php echo $this->item->numOfComments; ?> <?php echo ($this->item->numOfComments>1) ? JText::_('K2_COMMENTS') : JText::_('K2_COMMENT'); ?>
				</a>
				<?php else: ?>
				<a href="<?php echo $this->item->link; ?>#itemCommentsAnchor">
					<?php echo JText::_('K2_BE_THE_FIRST_TO_COMMENT'); ?>
				</a>
				<?php endif; ?>
			<?php endif; ?>
		
		<?php endif; ?>
			</p>
		</div>
		<?php if($this->item->params->get('catItemIntroText')): ?>
		  <!-- Item introtext -->
		  	<?php echo $this->item->introtext; ?>
		  <?php endif; ?>

		  <?php if ($this->item->params->get('catItemReadMore')): ?>
		<!-- Item "read more..." link -->

			<a class="button-third" href="<?php echo $this->item->link; ?>">
				<?php echo JText::_('K2_READ_MORE'); ?>
			</a>

		<?php endif; ?>
	</div>
</div>