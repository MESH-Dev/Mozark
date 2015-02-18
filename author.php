<?php
 get_header(); 
?>
    <!-- Blog-home : starts -->
      <section id="blog-details-home" class="blog-home text-center color-light blog-header-section">
      <div class="blog-home-overlay" style="background:rgba(0,0,0,0.5)">
          <h1><?php printf( __( 'All posts by %s', 'secretlang' ), get_the_author() ); ?></h1>
       </div>               
      </section>
    <!-- Blog-home : ends -->

<div class="pad-top pad-bottom">
<?php
if (have_posts()) :    
while ( have_posts() ) : the_post();
?>

      <section id="blog-standard-post"class="container  pad-bottom-half">
        <section class="row">
          <div class="col-md-12">
            <div class="blog-standard-post text-center">
               
<?php
            $secret_format = get_post_format();
            switch($secret_format)
            {
              //Gallery Post Type
              case 'gallery':
                $secret_sliderimages    =  get_post_meta($post->ID,'secret__post_slider',true);
                if($secret_sliderimages !=''):
                echo '<div class="owl-carousel blog-post-slider">';                           
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
              <div class="blog-post-text">
            <?php if(is_sticky()): 
                   echo '<div class="stick_icon"><img src="'.get_template_directory_uri().'/images/sticky.png" alt="sticky"/></div>'; 
            endif; ?>   
              
                <h1><?php the_title(); ?></h1>
                <h5><a href="<?php echo get_day_link(get_the_time('Y'), get_the_time('m'),get_the_time('d')); ?>"><span class="stat_hl"><?php echo get_the_date('F jS'); ?></span></a> / <?php _e('By','secretlang'); ?> <a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>"><span class="stat_hl"><?php the_author(); ?></span></a> / <?php _e('in','secretlang'); ?>
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
                <p><?php the_excerpt(); ?></p>
                <a class="button-01" href="<?php echo get_permalink(); ?>"><?php _e('Read More','secretlang'); ?></a>
              </div>
            </div>
          </div>  
        </section>
      </section>


<?php 
endwhile;

?>


    <!-- Container :starts -->
      <section class="container text-center ">
        <section class="row">
          <div class="col-md-2">
            <?php next_posts_link( '&larr; Older Posts'); ?>   
          </div>
         <div class="col-md-2 col-md-offset-8">
            <?php previous_posts_link( 'Newer Posts&rarr;' );  ?>
          </div>
        </section>
      </section>
    <!-- Container : ends -->
<?php    
endif;
?>
</div>
<?php get_footer(); ?>