<?php get_header(); 
global $secret_thm; 
while(have_posts()) : the_post();     
$secret_bg_image        =   get_post_meta($post->ID,'secret_page_bg',true);
if($secret_bg_image!=''): $abj = "url('".$secret_bg_image."') center top no-repeat; background-size:cover;"; else: $abj=''; endif;
$secret_page_subheading   =  get_post_meta($post->ID,'secret_page_subheading',true);
?>




    <!-- Blog-home : starts -->
      <section id="blog-details-home" class="blog-home text-center blog-header-section color-light" style="background:<?php echo $abj;?>">
      <div class="blog-home-overlay" style="background:rgba(0,0,0,0.5)">
        <h1><?php the_title(); ?></h1>
                     <?php
                     echo $secret_page_subheading 
                 ?>
       </div>               
      </section>
    <!-- Blog-home : ends -->




    <!--  Blog Post Details Gallery : starts -->
      <!-- Container : starts -->
      <section id="blog-post-gallery" class="container pad-top-50 pad-bottom-50">
        <section class="row">
          <div class="col-md-12">
            <div class="text-center">

              <div class="blog-post-text blog-post-details-text"> 

                      <?php the_content(); ?>

                <div class="clearfix"></div>
              </div>
             <?php if(isset($secret_thm['standalone_pages']) AND $secret_thm['standalone_pages'] == 1 ): ?>
              <div class="single-project-share">
                  <h4><?php _e('Share','secretlang'); ?></h4>
                  <a href="http://www.facebook.com/sharer/sharer.php?u=<?php print(urlencode(get_permalink())); ?>&title=<?php print(urlencode(the_title())); ?>" target="_blank" class="share-social-icon"><img src="<?php echo get_template_directory_uri();?>/images/blog-details/facebook.png" alt="facebook-icon"></a>
                  <a href="http://twitter.com/home?status=<?php print(urlencode(the_title())); ?>+<?php print(urlencode(get_permalink())); ?>" target="_blank" class="share-social-icon"><img src="<?php echo get_template_directory_uri();?>/images/blog-details/twitter.png" alt="twitter-icon"></a>
                  <a href="https://plus.google.com/share?url=<?php print(urlencode(get_permalink())); ?>" target="_blank" class="share-social-icon"><img src="<?php echo get_template_directory_uri();?>/images/blog-details/googleplus.png" alt="googleplus-icon"></a>
                  <a href="http://pinterest.com/pin/create/bookmarklet/?url=<?php print(urlencode(get_permalink())); ?>&is_video=false&description=<?php print(urlencode(the_title())); ?>" target="_blank" class="share-social-icon"><img src="<?php echo get_template_directory_uri();?>/images/blog-details/pintrest.png" alt="pinterest-icon"></a>
                <div class="float-clear"></div>
              </div>
            <?php endif; ?>
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
        echo '<h1 class="section-heading inner-page-section-heading color-light">Related Posts</h1>';
        while ($my_query->have_posts()) {
            $my_query->the_post();
        ?>
            <div class="col-md-3 col-sm-6 col-xs-12 related-post-column">
              <div>
                <?php the_post_thumbnail('full', array('class' => "img-responsive",)); ?>
              </div>
              <div class="related-post-text">
                <h4><?php the_title(); ?></h4>
                <h5><?php the_time('M j, Y') ?></h5>
              </div>
            </div>


          
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