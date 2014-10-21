<?php 
defined('_JEXEC') or die;

$extraFields = null;
$tagsText = array(); 
foreach ($this->item->tags as $tag){
  $tagsText[] = '<span>'.$tag->name.'</span>'; 
}

if(!empty($this->item->extra_fields)) {
  $extraFields = $this->item->extra_fields;
}

?>
<!-- single project -section 
  ================================================== -->
<div class="single-project">
  <div class="title-section white">
    <div class="container triggerAnimation animated" data-animate="bounceIn">
      <h1><?php echo $this->item->title;?></h1>
      <?php if(!empty($this->item->introtext)) : ?>
       <?php echo $this->item->introtext;?>
      <?php endif;?>
    </div>
  </div>
  <div class="container">
    <div class="row">
    <?php if(!empty($this->item->fulltext)) : ?>
      <div class="col-md-8">
        <div class="project-block triggerAnimation animated" data-animate="slideInLeft">
          <?php echo $this->item->fulltext;?>
        </div>
      </div>
    <?php endif;?>
      <div class="col-md-4">
        <div class="project-sidebar triggerAnimation animated" data-animate="slideInRight">
        <?php if(!empty($extraFields) && count($extraFields) > 4) :?>
          <ul class="project-photos">
          <?php foreach($extraFields as $key=>$field) :
            if($key > 3) :
            $attribs  = empty($field->value) ? array() : JUtility::parseAttributes($field->value);
            if(!empty($attribs['src'])) :
          ?>
            <li>
              <img alt="<?php echo $attribs['alt'];?>" src="<?php echo $attribs['src'];?>">
              <a class="hover" href="<?php echo $attribs['src'];?>"></a>
            </li>
            
          <?php endif; endif; endforeach;?>
          </ul>
        <?php endif;?>
          <h1><?php echo JText::_('TPL_MARBLE_PROJECT_DETAILS_TEXT');?></h1>
          <?php if(!empty($extraFields[0]->value)) : ?>
          <h3><?php echo $extraFields[0]->value;?></h3>
          <?php endif;?>
          <?php if(!empty($tagsText)) : ?>
          <p><?php echo JText::_('TPL_MARBLE_PROJECT_TAGS_TEXT');?> <?php echo implode(", ", $tagsText) ;?></p>
          <?php endif;?>
          <?php if(!empty($extraFields[1]->value)) : ?>
          <p><?php echo JText::_('TPL_MARBLE_PROJECT_CLIENT_TEXT');?>  <span><?php echo $extraFields[1]->value;?></span></p>
          <?php endif;?>
          <?php if(!empty($extraFields[2]->value)) : ?>
          <p><?php echo JText::_('TPL_MARBLE_PROJECT_LINK_TEXT');?> <a href="<?php echo $extraFields[2]->value;?>"><?php echo $extraFields[2]->value;?></a></p>
          <?php endif;?>
          
          <?php if(!empty($extraFields[3]->value)) : ?>
          <a href="<?php echo $extraFields[3]->value;?>" class="button-third"><?php echo JText::_('TPL_MARBLE_PROJECT_VIEW_PROJECT_TEXT');?></a>
          <?php endif;?>
          
        </div>
      </div>
    </div>          
  </div>
</div>
<?php if($this->item->params->get('itemRelated') && isset($this->relatedItems)): ?>
<!-- portfolio-section 
  ================================================== -->
<div class="section-content portfolio-section">
  <div class="title-section">
    <div class="container triggerAnimation animated" data-animate="bounceIn">
      <h1><?php echo JText::_('TPL_MARBLE_RELATED_PROJECTS_TEXT');?></h1>
      <p><?php echo JText::_('TPL_MARBLE_RELATED_PROJECTS_INTRO_TEXT');?></p>
    </div>
  </div>

  <div class="portfolio-box triggerAnimation animated" data-animate="bounceIn">
    <div id="owl-demo" class="owl-carousel owl-theme">

      <?php foreach($this->relatedItems as $item): ?>

        <?php if($this->item->params->get('itemRelatedTitle', 1)): ?>
          <!-- Related title -->
          <div class="item project-post">
            <div class="project-gal">
              <img alt="<?php echo $item->title; ?>" src="<?php echo $item->imageLarge;?>">
              <div class="hover-box">
                <a class="zoom" href="<?php echo $item->imageLarge;?>"><i class="fa fa-search-plus"></i></a>
                <a class="link" href="<?php echo $item->link;?>"><i class="fa fa-link"></i></a>
              </div>
            </div>
            <div class="project-content">
              <h2><?php echo $item->title; ?></h2>
              <?php if(!empty($item->introtext)) {
                echo $item->introtext;
                }?>

            </div>
          </div>
        <?php endif; ?>

        <?php if($this->item->params->get('itemRelatedCategory')): ?>
          <!-- Related category -->
          <div class="item project-post">
            <div class="project-gal">
              <img alt="<?php echo $item->title; ?>" src="<?php echo $item->imageLarge;?>">
              <div class="hover-box">
                <a class="zoom" href="<?php echo $item->imageLarge;?>"><i class="fa fa-search-plus"></i></a>
                <a class="link" href="<?php echo $item->link;?>"><i class="fa fa-link"></i></a>
              </div>
            </div>
            <div class="project-content">
              <h2><?php echo $item->title; ?></h2>
              <?php if(!empty($item->introtext)) {
                echo $item->introtext;
                }?>

            </div>
          </div>
        <?php endif; ?>

        <?php if($this->item->params->get('itemRelatedAuthor')): ?>
          <!-- Related author -->
          <div class="item project-post">
            <div class="project-gal">
              <img alt="<?php echo $item->title; ?>" src="<?php echo $item->imageLarge;?>">
              <div class="hover-box">
                <a class="zoom" href="<?php echo $item->imageLarge;?>"><i class="fa fa-search-plus"></i></a>
                <a class="link" href="<?php echo $item->link;?>"><i class="fa fa-link"></i></a>
              </div>
            </div>
            <div class="project-content">
              <h2><?php echo $item->title; ?></h2>
              <?php if(!empty($item->introtext)) {
                echo $item->introtext;
                }?>

            </div>
          </div>
        <?php endif; ?>
      <?php endforeach; ?>

    </div>
    <div class="buttons">
      <a class="owl-prev button-third" href="#"><i class="fa fa-angle-left"></i></a>
      <a class="button-third" href="<?php echo $this->item->category->link;?>"><?php echo JText::_('TPL_MARBLE_SEE_ALL_WORK_TEXT');?></a>
      <a class="owl-next button-third" href="#"><i class="fa fa-angle-right"></i></a>
    </div>
  </div>
</div>
  <?php endif; ?>

<script>
  jQuery(document).ready(function($) {
    /*-------------------------------------------------*/
    /* =  fullwidth carousell
    /*-------------------------------------------------*/
    try {
      var fullCarousell = $("#owl-demo");
      fullCarousell.owlCarousel({
        navigation : true,
        afterInit : function(elem){
          var that = this;
          that.owlControls.appendTo(elem);
        },
        items: 4,
        itemsDesktop: [1199, 3],
        itemsDesktopSmall: [979, 2],
        itemsTablet: [768, 1],
        itemsTabletSmall: false,
        itemsMobile: [479, 1]
      });
    } catch(err) {

    }
    var prevButton = $('.buttons a.owl-prev'),
    nextButton = $('.buttons a.owl-next');

    prevButton.live('click', function(e) {
      e.preventDefault();
      fullCarousell.trigger('owl.prev');
    });

    nextButton.on('click', function(e) {
      e.preventDefault();
      fullCarousell.trigger('owl.next');
    });
  });
</script>