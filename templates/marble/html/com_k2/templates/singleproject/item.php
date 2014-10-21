<?php
// no direct access
defined('_JEXEC') or die;
$document = JFactory::getDocument();
$document->addStyleSheet(JURi::root().'templates/identity/stylesheets/idangerous.swiper.css');
$document->addStyleSheet(JURi::root().'templates/identity/stylesheets/idangerous.swiper.scrollbar.css');
$css = '.swiper-container {
      text-align: center;
    }
    .swiper-slide gallery-slide gallery-slide0 {
      padding: 0px;
      background: #fff;
    }
    .swiper-slide gallery-slide gallery-slide0 > img{
    display: inline-block;
    float: left;
    }
    .red-slide {
      background: #ca4040;
    }
    .blue-slide {
      background: #4390ee;
    }
    .orange-slide {
      background: #ff8604;
    }
    .green-slide {
      background: #49a430;
    }
    .pink-slide {
      background: #973e76;
    }
    .swiper-scrollbar {
      width: 100%;
      height: 10px;
      position: absolute;
      left: 0;
      bottom: 5px;
      z-index: 1;
    }
    .swiper-scrollbar-drag{
}';
$document->addStyleDeclaration($css);
$aboutproject = '';
$whatwedid = '';
$moreinfo = '';
?>


<!-- page-section : starts -->
<section id="gallery" class="gallery gallery-bg">
	

	<!-- inner-section : starts -->
	<section id="gallery-wrap" class="inner-section">

		<!-- container : starts -->
		<section class="container">
			<div class="row">
				<article class="col-md-4 text-left">
					<div class="welcome pad-common  border-top-main">
						<h1 class="main-heading"><?php echo $this->item->title;?></h1>
						<span class="liner-medium"></span>
					</div>
				</article>
				<?php if(!empty($this->item->introtext)) {
					echo $this->item->introtext;
					} ?>
			</div>


				
			<div class="row">
				<article class="col-md-12 text-left">
					
<div class="swiper-container">
	<div class="swiper-scrollbar"></div>
		<div class="swiper-wrapper">

		      <!--Slide container : starts-->
		      <!-- you must specify the 'data-gallery-item-count' as total number of carousel images-->
		<?php
                $st_item = ShinethemePlugin::getK2Items($this->item->id);
                $st_extra = json_decode($st_item->extra_fields);
                
                $item_count = count($st_extra) - 3;

               if($item_count > 0) : 
               //if(count($st_extra)) :
               //$item_count = $c
               ?>
 				<div class="swiper-slide gallery-wrap" data-gallery-item-count="<?php echo $item_count;?>"> 
		<?php
                foreach ($st_extra as $key => $extraField) :
                //if($key < 3) :
                    if($key == '0'){
                        $aboutproject = trim($extraField->value);
                    }elseif($key == '1'){
                        $whatwedid = trim($extraField->value);
                    }elseif($key == '2'){
                        $moreinfo = trim($extraField->value);
                    }else {
                //else :
		?>
		     
		      	<div class="swiper-slide gallery-slide" style="background-image: url(<?php echo JURI::base(true).$extraField->value;?>);"> 
			       <a data-gall="inner-gallery" href="<?php echo JURI::base(true).$extraField->value;?>" class="image-lightbox-link">
		          		<img src="<?php echo JURI::base(true);?>/images/zoom.png" class="valign " title="<?php echo preg_replace("/\.[\w]{2,4}$/", "", basename(JURI::base(true).$extraField->value));?>" alt="<?php echo preg_replace("/\.[\w]{2,4}$/", "", basename(JURI::base(true).$extraField->value));?>">
		          	       </a>
			</div>
		      	<?php } endforeach;
		      	//if($item_count) : ?>
		      </div>
		  <?php  endif; //endif;?>

		       <!--Slide container : ends-->
      
      		</div>
 </div>
					
				</article>


			<div class="row">
            <?php if(!empty($aboutproject)) : ?>
				<article class="col-md-4 text-left">
					<div class="about-content-main pad-common grey-bg">
						<h2 class="inner-heading dark-text"><?php echo JText::_('TPL_IDENTITY_ABOUT_PROJECT_TEXT');?></h2>
						<span class="liner-small"></span>
						<p class="add-top-half"><?php echo $aboutproject;?></p>
					</div>
				</article>
            <?php endif ;?>
            <?php if(!empty($whatwedid)) : ?>
				<article class="col-md-4 text-left">
					<div class="about-content-main pad-common dark-bg">
						<h2 class="inner-heading white-text"><?php echo JText::_('TPL_IDENTITY_WHAT_WE_DID_TEXT');?></h2>
						<span class="liner-small"></span>
						<p class="add-top-half"><?php echo $whatwedid ;?></p>
					</div>

				</article>
            <?php endif ;?>
            <?php if(!empty($moreinfo)) : ?>
				<article class="col-md-4 text-left">
					<div class="about-content-main pad-common grey-bg">
						<h2 class="inner-heading dark-text"><?php echo JText::_('TPL_IDENTITY_MORE_INFO_TEXT');?></h2>
						<span class="liner-small"></span>
						<p class="add-top-half"><?php echo $moreinfo ;?></p>
					</div>
				</article>
            <?php endif ;?>
			</div>
            

			</div>

		</section>
		<!-- container : ends -->

        	</section>
	<!-- inner-section : ends -->
</section>
<!-- page-section : ends -->