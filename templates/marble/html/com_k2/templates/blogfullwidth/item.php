<?php
/**
 * @version     2.6.x
 * @package     K2
 * @author      JoomlaWorks http://www.joomlaworks.net
 * @copyright   Copyright (c) 2006 - 2014 JoomlaWorks Ltd. All rights reserved.
 * @license     GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die;
//echo'<pre>';var_dump($this->item);die;
$extraFields = null;
if(!empty($this->item->extra_fields)){
  $extraFields = json_decode($this->item->extra_fields);
}

$postType = $extraFields[0]->value;
$postLink = $extraFields[1]->value;

?>
<div class="section-content blog-section full-width">
  <div class="container">
    <div class="blog-box">
      <div class="row">
        <?php if(JRequest::getInt('print')==1): ?>
        <!-- Print button at the top of the print page only -->
        <a class="itemPrintThisPage" rel="nofollow" href="#" onclick="window.print();return false;">
            <span><?php echo JText::_('K2_PRINT_THIS_PAGE'); ?></span>
        </a>
        <?php endif; ?>

        <!-- Start K2 Item Layout -->
        <!-- Plugins: BeforeDisplay -->
        <?php echo $this->item->event->BeforeDisplay; ?>

        <!-- K2 Plugins: K2BeforeDisplay -->
        <?php echo $this->item->event->K2BeforeDisplay; ?>

        <div class="blog-post single-post full-width triggerAnimation animated" data-animate="slideInUp">
          <?php if($postType == '1') : ?>
              <img alt="<?php echo $this->item->title;?>" src="<?php echo JURI::root(true).'/'.$postLink;?>">
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
          <div class="post-content">
              <div class="post-date">
              <?php if($this->item->params->get('itemDateCreated')): ?>
              <!-- Date created -->
              <?php $created_string = explode(" ", JHTML::_('date', $this->item->created , JText::_('DATE_FORMAT_LC3'))); ?><p><span><?php echo $created_string[0];?></span><?php echo $created_string[1];?></p>
              
              <?php endif; ?>
                
              </div>
              <div class="content-data">
              <?php if($this->item->params->get('itemTitle')): ?>
              <!-- Item title -->
              <h2>
                    <?php if(isset($this->item->editLink)): ?>
                    <!-- Item edit link -->
                    <span class="itemEditLink">
                        <a class="modal" rel="{handler:'iframe',size:{x:990,y:550}}" href="<?php echo $this->item->editLink; ?>">
                            <?php echo JText::_('K2_EDIT_ITEM'); ?>
                        </a>
                    </span>
                    <?php endif;?>

                <?php echo $this->item->title; ?>

                <?php if($this->item->params->get('itemFeaturedNotice') && $this->item->featured): ?>
                <!-- Featured flag -->
                <span>
                    <sup>
                        <?php echo JText::_('K2_FEATURED'); ?>
                    </sup>
                </span>
                <?php endif; ?>

              </h2>
              <?php endif; ?>
                <p>
                  <?php if($this->item->params->get('itemAuthor')): ?>
              <!-- Item Author -->
                  <?php echo JText::_('TPL_MARBLE_CREATED_BY_TEXT'); ?>&nbsp;
                  <?php if(empty($this->item->created_by_alias)): ?>
                  <a rel="author" href="<?php echo $this->item->author->link; ?>"><?php echo $this->item->author->name; ?></a>
                  <?php else: ?>
                  <?php echo $this->item->author->name; ?>
                  <?php endif; ?>
              <?php endif; ?> | <?php if($this->item->params->get('itemCommentsAnchor') && $this->item->params->get('itemComments') && ( ($this->item->params->get('comments') == '2' && !$this->user->guest) || ($this->item->params->get('comments') == '1')) ): ?>
                  <!-- Anchor link to comments below - if enabled -->
                      <?php if(!empty($this->item->event->K2CommentsCounter)): ?>
                          <!-- K2 Plugins: K2CommentsCounter -->
                          <?php echo $this->item->event->K2CommentsCounter; ?>
                      <?php else: ?>
                          <?php if($this->item->numOfComments > 0): ?>
                          <a class="itemCommentsLink k2Anchor" href="<?php echo $this->item->link; ?>#itemCommentsAnchor">
                              <span><?php echo $this->item->numOfComments; ?></span> <?php echo ($this->item->numOfComments>1) ? JText::_('K2_COMMENTS') : JText::_('K2_COMMENT'); ?>
                          </a>
                          <?php else: ?>
                          <a class="itemCommentsLink k2Anchor" href="<?php echo $this->item->link; ?>#itemCommentsAnchor">
                              <?php echo JText::_('K2_BE_THE_FIRST_TO_COMMENT'); ?>
                          </a>
                          <?php endif; ?>
                      <?php endif; ?>
                  <?php endif; ?>
                </p>
              </div>
              <?php if(!empty($this->item->fulltext)): ?>
                <?php if($this->item->params->get('itemIntroText')): ?>
                <!-- Item introtext -->
                  <?php echo $this->item->introtext; ?>
                <?php endif; ?>
                <?php if($this->item->params->get('itemFullText')): ?>
                <!-- Item fulltext -->
                  <?php echo $this->item->fulltext; ?>
                <?php endif; ?>
                <?php else: ?>
                <!-- Item text -->
                  <?php echo $this->item->introtext; ?>
              <?php endif; ?>

        <?php if( $this->item->params->get('itemTags') || $this->item->params->get('itemTwitterButton',1) || $this->item->params->get('itemFacebookButton',1) || $this->item->params->get('itemGooglePlusOneButton',1)): ?>
          <div class="share-tag-box">
              <?php if($this->item->params->get('itemTags') && count($this->item->tags)): ?>
            <!-- Item tags -->
            <ul class="post-tags">
              <li><span><?php echo JText::_('TPL_MARBLE_TAGS_TEXT');?></span></li>
              <?php foreach ($this->item->tags as $tag): ?>
                <li><a href="<?php echo $tag->link; ?>"><?php echo $tag->name; ?></a></li>
              <?php endforeach; ?>
            </ul>
            <?php endif; ?>

            <?php if($this->item->params->get('itemTwitterButton',1) || $this->item->params->get('itemFacebookButton',1) || $this->item->params->get('itemGooglePlusOneButton',1)): ?>
          <!-- Social sharing -->
            <span><?php echo JText::_('TPL_MARBLE_SHARE_THIS_POST_TEXT');?></span>
            <ul class="social-box">
              <?php if($this->item->params->get('itemFacebookButton',1)): ?>
              <!-- Facebook Button -->
              <li class="itemFacebookButton">
                  <div id="fb-root"></div>
                  <script type="text/javascript">
                      (function(d, s, id) {
                        var js, fjs = d.getElementsByTagName(s)[0];
                        if (d.getElementById(id)) return;
                        js = d.createElement(s); js.id = id;
                        js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
                        fjs.parentNode.insertBefore(js, fjs);
                      }(document, 'script', 'facebook-jssdk'));
                  </script>
                  <div class="fb-like" data-send="false" data-width="200" data-show-faces="true"></div>
              </li>
              <?php endif; ?>

              <?php if($this->item->params->get('itemTwitterButton',1)): ?>
              <!-- Twitter Button -->
              <li class="itemTwitterButton">
                  <a href="https://twitter.com/share" class="twitter-share-button" data-count="horizontal"<?php if($this->item->params->get('twitterUsername')): ?> data-via="<?php echo $this->item->params->get('twitterUsername'); ?>"<?php endif; ?>>
                      <?php echo JText::_('K2_TWEET'); ?>
                  </a>
                  <script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>
              </li>
              <?php endif; ?>

              

              <?php if($this->item->params->get('itemGooglePlusOneButton',1)): ?>
              <!-- Google +1 Button -->
              <li class="itemGooglePlusOneButton">
                  <g:plusone annotation="inline" width="120"></g:plusone>
                  <script type="text/javascript">
                    (function() {
                      window.___gcfg = {lang: 'en'}; // Define button default language here
                      var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                      po.src = 'https://apis.google.com/js/plusone.js';
                      var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
                    })();
                  </script>
              </li>
              <?php endif; ?>
              </ul>
          <?php endif; ?>
            </div>
        <?php endif; ?>

        <?php if($this->item->params->get('itemNavigation') && !JRequest::getCmd('print') && (isset($this->item->nextLink) || isset($this->item->previousLink))): ?>
        <!-- Item navigation -->
        <div class="pagination-boxer">
          <div class="prev-post">
            <?php if(isset($this->item->previousLink)): ?>
              <a class="button-third" href="<?php echo $this->item->previousLink; ?>"><i class="fa fa-angle-left"></i> <?php echo JText::_('TPL_MARBLE_PREV_TEXT');?></a>
              <p><?php echo $this->item->previousTitle; ?></p>
            <?php endif; ?>
            
          </div>
          <div class="next-post">
            <?php if(isset($this->item->nextLink)): ?>
              <a class="button-third" href="<?php echo $this->item->nextLink; ?>"><i class="fa fa-angle-right"></i> <?php echo JText::_('TPL_MARBLE_NEXT_TEXT');?></a>
              <p><?php echo $this->item->nextTitle; ?></p>
            <?php endif; ?>
          </div>
        </div>
        <?php endif; ?>  

        <?php if($this->item->params->get('commentsFormPosition')=='above' && $this->item->params->get('itemComments') && !JRequest::getInt('print') && ($this->item->params->get('comments') == '1' || ($this->item->params->get('comments') == '2' && K2HelperPermissions::canAddComment($this->item->catid)))): ?>
        <!-- Item comments form -->
          <?php echo $this->loadTemplate('comments_form'); ?>

        <?php endif; ?>  

        <!-- Plugins: AfterDisplay -->
        <?php echo $this->item->event->AfterDisplay; ?>

        <!-- K2 Plugins: K2AfterDisplay -->
        <?php echo $this->item->event->K2AfterDisplay; ?>

        <?php if($this->item->params->get('itemComments') && ( ($this->item->params->get('comments') == '2' && !$this->user->guest) || ($this->item->params->get('comments') == '1'))): ?>
        <!-- K2 Plugins: K2CommentsBlock -->
        <?php echo $this->item->event->K2CommentsBlock; ?>
        <?php endif; ?>

            <?php if($this->item->params->get('itemComments') && ($this->item->params->get('comments') == '1' || ($this->item->params->get('comments') == '2')) && empty($this->item->event->K2CommentsBlock)): ?>
            <!-- Item comments -->
            <a name="itemCommentsAnchor" id="itemCommentsAnchor"></a>

            <div class="comment-section">
            <?php if($this->item->numOfComments>0 && $this->item->params->get('itemComments') && ($this->item->params->get('comments') == '1' || ($this->item->params->get('comments') == '2'))): ?>
              <!-- Item user comments -->
              <h3><?php echo $this->item->numOfComments; ?> <?php echo ($this->item->numOfComments>1) ? JText::_('K2_COMMENTS') : JText::_('K2_COMMENT'); ?></h3>

              <ul class="comment-tree">
                <?php foreach ($this->item->comments as $key=>$comment): ?>
                <li>
                  <div class="comment-box">
                    <?php if($comment->userImage): ?>
                    <img src="<?php echo $comment->userImage; ?>" alt="<?php echo JFilterOutput::cleanText($comment->userName); ?>" />
                    <?php endif; ?>
                    <div class="comment-content">
                      <h4>
                        <?php if(!empty($comment->userLink)): ?>
                        <a href="<?php echo JFilterOutput::cleanText($comment->userLink); ?>" title="<?php echo JFilterOutput::cleanText($comment->userName); ?>" target="_blank" rel="nofollow">
                            <?php echo $comment->userName; ?>
                        </a>
                        <?php else: ?>
                        <?php echo $comment->userName; ?>
                        <?php endif; ?>
                      </h4>
                      <span><?php echo JHTML::_('date', $comment->commentDate, JText::_('K2_DATE_FORMAT_LC2')); ?></span>
                      <p><?php echo $comment->commentText; ?></p>
                      <?php if($this->inlineCommentsModeration || ($comment->published && ($this->params->get('commentsReporting')=='1' || ($this->params->get('commentsReporting')=='2' && !$this->user->guest)))): ?>
                        
                        <?php if($this->inlineCommentsModeration): ?>
                            <?php if(!$comment->published): ?>
                            <a class="commentApproveLink" href="<?php echo JRoute::_('index.php?option=com_k2&view=comments&task=publish&commentID='.$comment->id.'&format=raw')?>"><?php echo JText::_('K2_APPROVE')?></a>
                            <?php endif; ?>

                            <a class="commentRemoveLink" href="<?php echo JRoute::_('index.php?option=com_k2&view=comments&task=remove&commentID='.$comment->id.'&format=raw')?>"><?php echo JText::_('K2_REMOVE')?></a>
                        <?php endif; ?>

                            <?php if($comment->published && ($this->params->get('commentsReporting')=='1' || ($this->params->get('commentsReporting')=='2' && !$this->user->guest))): ?>
                            <a class="modal" rel="{handler:'iframe',size:{x:560,y:480}}" href="<?php echo JRoute::_('index.php?option=com_k2&view=comments&task=report&commentID='.$comment->id)?>"><?php echo JText::_('K2_REPORT')?></a>
                            <?php endif; ?>

                            <?php if($comment->reportUserLink): ?>
                            <a class="k2ReportUserButton" href="<?php echo $comment->reportUserLink; ?>"><?php echo JText::_('K2_FLAG_AS_SPAMMER'); ?></a>
                            <?php endif; ?>
                        
                      <?php endif; ?>
                      
                    </div>
                  </div>
                </li>
                <?php endforeach; ?>
              </ul>

              <div class="itemCommentsPagination">
                <?php echo $this->pagination->getPagesLinks(); ?>
                
              </div>
            <?php endif; ?>
          </div>
          <?php endif; ?>
            
            <?php if($this->item->params->get('commentsFormPosition')=='below' && $this->item->params->get('itemComments') && !JRequest::getInt('print') && ($this->item->params->get('comments') == '1' || ($this->item->params->get('comments') == '2' && K2HelperPermissions::canAddComment($this->item->catid)))): ?>
              <!-- Item comments form -->
              <?php echo $this->loadTemplate('comments_form'); ?>
            <?php endif; ?>

            <?php $user = JFactory::getUser(); if ($this->item->params->get('comments') == '2' && $user->guest): ?>
                  <div><a href="<?php echo JRoute::_('index.php?option=com_users&view=login');?>"><?php echo JText::_('K2_LOGIN_TO_POST_COMMENTS'); ?></a></div>
            <?php endif; ?>

          </div><!-- end blog-content -->
        </div><!-- end blog-post -->

      </div>
    </div>
   </div>
</div> 
