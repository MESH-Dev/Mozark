<?php get_header(); 

    while(have_posts()) : the_post();     

            if(has_post_thumbnail()): 
              $thumbnail_img     =  wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), '', true, '');
               $bg_banner         = ' style="background:url('.$thumbnail_img[0].') center center; background-size:cover;" ';
            else:
               $bg_banner         = '';
            endif;
?>




    <!-- Blog-home : starts -->
      <section id="blog-details-home" class="blog-home text-center color-light blog-header-section" <?php echo $bg_banner;?>>
      <div class="blog-home-overlay" style="background:rgba(0,0,0,0.5)">
        <h1><?php the_title(); ?></h1>
                     <?php
                     $wpcats = get_the_category();
                      if($wpcats):
                        $cats = array();
                         $cnt = 0;
                         foreach ($wpcats as $c) 
                          {
                              $cats[] = '<h4>' . $c->cat_name.'</h4>';
                              
                              

                              $cnt++;
                          }
                        $lister = implode('<img src="'.get_template_directory_uri().'/images/blogs/divider.png" alt="icon">', $cats);
                        echo " ".$lister;
                      endif;
                 ?>
       </div>               
      </section>
    <!-- Blog-home : ends -->




    <!--  Blog Post Details Gallery : starts -->
      <!-- Container : starts -->
      <section id="blog-post-gallery" class="container pad-top-50 pad-bottom-50">
        <section class="row">
          <div class="col-md-12">
            <div class="">


<?php
            $andy_format = get_post_format();
            switch($andy_format)
            {
              //Gallery Post Type
              case 'gallery':
                $secret_sliderimages    =  get_post_meta($post->ID,'secret__post_slider',true);
                if($secret_sliderimages !=''):
                echo '<div class="blog-post-gallery owl-carousel blog-post-slider">';                           
                          foreach ($secret_sliderimages as $sl_img) 
                           {
                              echo ' <div><img src="'.$sl_img.'" alt="Slide" /></div>';
                           }                        
                echo  '</div>';
                else:
                echo '<div class="blog-single-image">';
                 the_post_thumbnail('full', array('class' => "img-responsive",) );
                echo '</div>';
                endif;                  
              break; 
              //Audio Post
              case 'audio':
               $theme_post_audio = get_post_meta($post->ID,'secret_post_audioembed',true);
               if($theme_post_audio !=""):
                echo '<div class="blog-single-image">
                   '.$theme_post_audio.'
                    </div>';
               else:
                echo '<div class="blog-single-image">';
                 the_post_thumbnail('full', array('class' => "img-responsive",) );
                echo '</div>';
               endif; 
              break;
              //Video Post
              case 'video':
               $thm_post_video = get_post_meta($post->ID,'secret_post_videoembed',true);
               if($thm_post_video !=""):
                echo '<div class="blog-single-image videopost">
                   '.$thm_post_video.'
                    </div>';
               else:
                echo '<div class="blog-single-image">';
                 the_post_thumbnail('full', array('class' => "img-responsive",) );
                echo '</div>';
               endif; 
              break;

              //Default Fall Back
              default:
                echo '<div class="blog-single-image">';
                 the_post_thumbnail('full', array('class' => "img-responsive",) );
                echo '</div>';
              break; 





            } //Switch case ends 
  ?>








              <div class="blog-post-text blog-post-details-text"> 
                <h1 class="text-center"><?php the_title(); ?></h1>
                     <h5 class="text-center"><a href="<?php echo get_day_link(get_the_time('Y'), get_the_time('m'),get_the_time('d')); ?>"><span class="stat_hl"><?php echo get_the_date('F jS'); ?></span></a> / <?php _e('By','secretlang'); ?> <a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>"><span class="stat_hl"><?php the_author(); ?></span></a> / <?php _e('in','secretlang'); ?>
                     <?php
                     $wpcats = get_the_category();
                      if($wpcats):
                        $cats = array();
                         foreach ($wpcats as $c) 
                          {
                              $cats[] = '<a href="'.get_category_link($c->term_id).'"><span class="stat_hl">' . $c->cat_name.'</span></a>';
                          }
                        $lister = implode(",", $cats);
                        echo " ".$lister;
                      endif;
                      ?></span>  /  <span><?php comments_number( 'no comments', 'one comment', '% comments' );?></span></h5>

                      <?php the_content(); ?>
                      <?php wp_link_pages(); ?>
                
              </div>

              <div class="blog-post-share">
                <div class="blog-post-share-text float-left">
                  <img src="<?php echo get_template_directory_uri();?>/images/blog-details/tag-icon.png">
                  <p>  <?php the_tags('',',',''); ?></p>
                </div>
                <?php if(isset($secret_thm['post_single']) AND $secret_thm['post_single'] == 1 ): ?>
                <div class="blog-post-share-social-icons float-right text-center">
                  <h4><?php _e('Share','secretlang'); ?></h4>
                  <a href="http://www.facebook.com/sharer/sharer.php?u=<?php print(urlencode(get_permalink())); ?>&title=<?php print(urlencode(the_title())); ?>" target="_blank" class="share-social-icon"><img src="<?php echo get_template_directory_uri();?>/images/blog-details/facebook.png" alt="facebook-icon"></a>
                  <a href="http://twitter.com/home?status=<?php print(urlencode(the_title())); ?>+<?php print(urlencode(get_permalink())); ?>" target="_blank" class="share-social-icon"><img src="<?php echo get_template_directory_uri();?>/images/blog-details/twitter.png" alt="twitter-icon"></a>
                  <a href="https://plus.google.com/share?url=<?php print(urlencode(get_permalink())); ?>" target="_blank" class="share-social-icon"><img src="<?php echo get_template_directory_uri();?>/images/blog-details/googleplus.png" alt="googleplus-icon"></a>
                  <a href="http://pinterest.com/pin/create/bookmarklet/?url=<?php print(urlencode(get_permalink())); ?>&is_video=false&description=<?php print(urlencode(the_title())); ?>" target="_blank" class="share-social-icon"><img src="<?php echo get_template_directory_uri();?>/images/blog-details/pintrest.png" alt="pinterest-icon"></a>
                </div>
                <div class="float-clear"></div>
                <?php endif; ?>

              </div>
            </div>
          </div>  
        </section>
      </section>
      <!-- Container : ends -->
    <!-- Blog Post Details Gallery : ends -->


 <?php 
    if (comments_open() || get_comments_number() ) {
            comments_template();
    
    }
  ?>

<?php endwhile; ?>


<?php
$tags = wp_get_post_tags($post->ID);
if ($tags) {
    $tag_ids = array();
    foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;

    $args=array(
        'tag__in' => $tag_ids,
        'post__not_in' => array($post->ID),
        'showposts'=>4, // Number of related posts that will be shown.
        'caller_get_posts'=>1
    );
    $my_query = new wp_query($args);
    if( $my_query->have_posts() ) {

?>
    <section id="related-posts" class="related-posts page-section bg-color-dark">
      <section class="inner-section">
        <div class="container">
          <div class="row">

<?php
        echo '<h1 class="section-heading inner-page-section-heading color-light">'._e('Related Posts','secretlang').'</h1>';
        while ($my_query->have_posts()) {
            $my_query->the_post();
        ?>
            <a href="<?php the_permalink(); ?>">
            <div class="col-md-3 col-sm-6 col-xs-12 related-post-column">
              <div>
                <?php the_post_thumbnail('full', array('class' => "img-responsive",)); ?>
              </div>
              <div class="related-post-text">
                <h4><?php the_title(); ?></h4>
                <h5><?php the_time('M j, Y') ?></h5>
              </div>
            </div>
            </a>


          
        <?php
        }

    }
?>
          </div>
        </div>
     </section>
   </section>  
<?php

}
?>


       





<?php get_footer(); ?>