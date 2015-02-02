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
                     $wpcats = get_categories(array('type' => 'portfolio_item', 'taxonomy' => 'portfolio_category'));
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
      <section id="single-project" class="single-project page-section">
        <!-- Inner-section : starts -->
        <section class="inner-section">
          <!-- Container : starts -->
          <div class="container">      



                      <?php the_content(); ?>

<?php endwhile; ?>
              <div class="row">
              <div class="col-md-12"> 

<?php if(isset($secret_thm['port_standalone_pages']) AND $secret_thm['port_standalone_pages'] == 1 ): ?>
              <div class="single-project-share">
                  <h4><?php _e('Share','secretlang'); ?></h4>
                  <a href="http://www.facebook.com/sharer/sharer.php?u=<?php print(urlencode(get_permalink())); ?>&title=<?php print(urlencode(the_title())); ?>" target="_blank" class="share-social-icon"><img src="<?php echo get_template_directory_uri();?>/images/blog-details/facebook.png" alt="facebook-icon"></a>
                  <a href="http://twitter.com/home?status=<?php print(urlencode(the_title())); ?>+<?php print(urlencode(get_permalink())); ?>" target="_blank" class="share-social-icon"><img src="<?php echo get_template_directory_uri();?>/images/blog-details/twitter.png" alt="twitter-icon"></a>
                  <a href="https://plus.google.com/share?url=<?php print(urlencode(get_permalink())); ?>" target="_blank" class="share-social-icon"><img src="<?php echo get_template_directory_uri();?>/images/blog-details/googleplus.png" alt="googleplus-icon"></a>
                  <a href="http://pinterest.com/pin/create/bookmarklet/?url=<?php print(urlencode(get_permalink())); ?>&is_video=false&description=<?php print(urlencode(the_title())); ?>" target="_blank" class="share-social-icon"><img src="<?php echo get_template_directory_uri();?>/images/blog-details/pintrest.png" alt="pinterest-icon"></a>
                <div class="float-clear"></div>
              </div>
<?php endif; ?>

                <div class="row project-link">



    <?php $prev_post = get_previous_post(); ?>
    <?php if ( !empty( $prev_post ) ) : ?>  
            <a href="<?php echo get_permalink( $prev_post->ID ); ?>"><img src="<?php echo get_template_directory_uri();?>/images/single-project/left_arrow_big.png"></a>
    <?php endif; ?>
    <?php $next_post = get_next_post(); ?>
    <a href="<?php echo home_url();?>"><img src="<?php echo get_template_directory_uri(); ?>/images/single-project/back_to_portfolio.png"></a>    
    <?php if ( !empty( $next_post ) ) : ?>  
            <a href="<?php echo get_permalink( $next_post->ID ); ?>"><img src="<?php echo get_template_directory_uri();?>/images/single-project/right_arrow_big.png"></a>
    <?php endif; ?>

                </div>
              </div>  
            </div>







              </div>
           </section>
</section>


   





<?php
$tags = wp_get_post_tags($post->ID);
if ($tags) {
    $tag_ids = array();
    foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;

    $args=array(
        'tag__in' => $tag_ids,
        'post__not_in' => array($post->ID),
        'showposts'=>4, // Number of related posts that will be shown.
        'caller_get_posts'=>1,
        'post_type' => 'portfolio_item', 
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