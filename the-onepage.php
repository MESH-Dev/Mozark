<?php
/**
 * Template Name: The One Page
 *
 * @author Secret (unbranded.co)
 * @theme Secret - Creative
 */
get_header();
global $secret_thm;
$secret_count = 0;
//$secret_countPages = wp_count_posts('page')->publish;
$secret_pages = get_pages( 'sort_order=asc&sort_column=menu_order&depth=1');
$secret_totalOnepages = 0;
//count one pages only
foreach($secret_pages as $secret_pag):
  $secret_include_onepage = get_post_meta($secret_pag->ID,'secret_include_onepage',true );
  $secret_templ_name      = get_post_meta($secret_pag->ID, '_wp_page_template', true );
  $secret_filename        = preg_replace('"\.php$"', '', $secret_templ_name);
  if($secret_include_onepage == 1 &&  $secret_filename !='the-onepage') { $secret_totalOnepages++; }
endforeach;

//Pages to sections published pages
foreach($secret_pages as $secret_pag):

setup_postdata($secret_pag);
//Anchor point and title
$secret_new_title       =  strtolower(preg_replace('/[^a-zA-Z]/s', '', $secret_pag->post_name));
$secret_templ_name      =  get_post_meta($secret_pag->ID, '_wp_page_template', true );
$secret_filename        =  preg_replace('"\.php$"', '', $secret_templ_name);
//Check wether to include in one page
$secret_include_onepage =  get_post_meta($secret_pag->ID,'secret_include_onepage',true );
$secret_enb_parallax    =  get_post_meta($secret_pag->ID,'secret_enb_parallax',true );
$secret_enb_title       =  get_post_meta($secret_pag->ID,'secret_enb_title',true );
$secret_enb_container   =  get_post_meta($secret_pag->ID,'secret_enb_container',true );
$secret_title_color     =  get_post_meta($secret_pag->ID,'secret_title_color',true );
$secret_pad_top         =  get_post_meta($secret_pag->ID,'secret_pad_top',true );;
$secret_pad_bottom      =  get_post_meta($secret_pag->ID,'secret_pad_bottom',true );;
//Get Other Meta Items
$secret_bg_color        =  get_post_meta($secret_pag->ID,'secret_bg_color',true);

$secret_heading_animation      =  get_post_meta($secret_pag->ID,'secret_heading_animation',true );;

//OPtional BG Img
$secret_bg_image        =   get_post_meta($secret_pag->ID,'secret_page_bg',true);

if($secret_bg_color !=''){ $secret_bg_color = $secret_bg_color; } else {$secret_bg_color ='#FFF';}

if($secret_include_onepage == 'on') { $secret_count++; }
if($secret_include_onepage == 'on' AND $secret_count == '2')
{
  if($secret_thm['menu_location'] == 1):
    secret_center_menu($mode="onepage");
  else:
    secret_native_menu($mode="onepage");
  endif;
}

//Headings
$secret_page_heading      =  $secret_pag->post_title;
$secret_page_subheading   =  get_post_meta($secret_pag->ID,'secret_page_subheading',true);
/*-------------------------------------
 Splash Page
--------------------------------------*/
if($secret_include_onepage == 'on' AND $secret_filename == 'hero-section')
   {
//cooking Parallax Overlay

  $par_ovl_open  = '<div class="full-height sec_overlay" style="background:rgba('.secret_hex2rgb($secret_bg_color).',0.5);">';
  $par_ovl_close = '</div>';


  if($secret_bg_image!=''): $abj = "url('".$secret_bg_image."') center top no-repeat; background-size:cover;"; else: $abj=''; endif;
  //Removing background color if video BG active
  if(isset($secret_thm['bg_mode']) AND $secret_thm['bg_mode'] == '1' OR $secret_thm['bg_mode'] == '3')
  {
    $secret_bg_color = 'rgba('.secret_hex2rgb($secret_bg_color).',0.3)';
  }

?>

<div id="<?php echo $secret_new_title;?>" class="home full-height" style="background:<?php echo $abj; ?> <?php echo $secret_bg_color; ?>;">
  <?php echo $par_ovl_open; ?>
    <?php if($secret_enb_container != 'on'): ?>
     <div class="container">
      <?php the_content();?>
    </div>
    <?php else: ?>
      <?php the_content();?>
    <?php endif; ?>
  <?php echo $par_ovl_close; ?>
  </div>
</div>


<?php
}

/*-------------------------------------
Default One-Page Section - Blog Template
--------------------------------------*/
elseif($secret_include_onepage == 'on' && $secret_filename == 'blog-section')
{
//cooking Parallax Overlay
  if($secret_enb_parallax == 'on')
  {
     $par_ovl_open  = '<div class="parallax-ovl" style="background:rgba('.secret_hex2rgb($secret_bg_color).',0.9);">';
     $par_ovl_close = '</div>';
     $par_class     = 'parallax';
  }
  else
  {
     $par_ovl_open ='';
     $par_ovl_close ='';
     $par_class     = '';
  }

 //Padding Adjusters
  $padding = '';
  if($secret_pad_top !=''):
   $padding   .= 'padding-top:'.$secret_pad_top.'px; ';
  endif;
  if($secret_pad_bottom !=''):
   $padding   .= ' padding-bottom:'.$secret_pad_bottom.'px;';
  endif;
  if($secret_bg_image!=''): $abj = "url('".$secret_bg_image."') center top no-repeat; background-size:cover;"; else: $abj=''; endif;
?>
<section id="<?php echo $secret_new_title;?>" class="page-section" style="background:<?php echo $abj; ?> <?php echo $secret_bg_color; ?>;">
  <?php echo $par_ovl_open; ?>
  <div style="<?php echo $padding; ?>">

      <!-- Add Padding for container less pages -->
      <?php if($secret_enb_title != 'on'): ?>
       <div class="container">
        <div class="row">
                <div class="col-md-12">
          <h1 class="section-heading text-center animated" style="color:<?php echo $secret_title_color; ?>" data-fx="<?php echo $secret_heading_animation; ?>"><?php echo $secret_page_heading; ?></h1>
          <p class="sub-heading text-center"><?php echo $secret_page_subheading; ?></p>
          </div>
        </div>
        </div>
       </div>
     <?php endif; ?>

    <div class="container">
     <div class="row">
      <div class="col-md-12">
      <section class="blog-contents">
      <?php

      $loop = new WP_Query( array( 'post_type' => 'post', 'orderby' => 'date', 'order' => 'DESC','posts_per_page' => 10,'paged'=>false) );
      while ($loop->have_posts() ):
      $loop->the_post();
      //Check if included for One Page
      $enabled_on_onep    =  get_post_meta($post->ID,'secret_post_showonepage',true);

      //Switch For post
      if($enabled_on_onep == 'on'):



      //Thumbnail POsition(left,right,none)
      $thumb_pos_meta    =  get_post_meta($post->ID,'secret_post_thumbpos',true);
      switch($thumb_pos_meta)
      {
        case 'left':
          $thumb_pos = 'item-position-01';
          $pos_img   = 'left';
        break;

        case 'Right':
          $thumb_pos = 'item-position-03';
          $pos_img   = 'right';
        break;

        case 'none':
          $thumb_pos = '';
          $pos_img   = '';
        break;
      }

      //Formats and related meta options



      //Title Block Categories and Author Block
      $renblog_post_title   =   get_the_title($post->ID);
      $rei_permalink        =   get_permalink($post->ID);

      ?>



                <!-- Blog Item One -->
                <div class="blog-item text-center">
                  <div class="blog-item-display <?php echo $thumb_pos;?>">
            <?php
            if(has_post_thumbnail()):
               $thumbnail_img     =  wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'blog-one-thumb', true, '');
               $thumbnail_image   = '<img src="'.$thumbnail_img[0].'"  alt="'.get_the_title().'" class="img-responsive"/>';
            else:
               $thumbnail_image   = '';
            endif;
            ?>

<?php
            $sec_blogformat = get_post_format();
            switch($sec_blogformat)
            {
              //Gallery Post Type
              case 'gallery':
                $sec_blogsliderimages    =  get_post_meta($post->ID,'secret__post_slider',true);
                if($sec_blogsliderimages !=''):
                echo '<div class="owl-carousel blog-slider">';
                          foreach ($sec_blogsliderimages as $sl_img)
                           {
                              echo ' <div class=""><img src="'.$sl_img.'" alt="Slide" class="img-responsive"/></div>';
                           }
                echo  '</div>';
                else:
                  echo $thumbnail_image;
                endif;
              break;
              //Audio Post
              case 'audio':
               $sec_blogaudio = get_post_meta($post->ID,'secret_post_audioembed',true);
               if($sec_blogaudio !=""):
                echo '<div class="">
                   '.$sec_blogaudio.'
                    </div>';
               else:
                  echo $thumbnail_image;
               endif;
              break;
              //Video Post
              case 'video':
               $sec_blogvideo = get_post_meta($post->ID,'secret_post_videoembed',true);
               if($sec_blogvideo !=""):
                echo '<div class="video-frame">
                   '.$sec_blogvideo.'
                    </div>';
               else:
                  echo $thumbnail_image;
               endif;
              break;

              //Default Fall Back
              default:
                echo $thumbnail_image;
              break;
           }
?>
                  </div>
                  <a href="<?php echo $rei_permalink ?>" target="_blank">
                    <div class="blog-item-text <?php echo $thumb_pos;?>">
                      <!--Pos Adjuster -->
                      <?php if($pos_img != ''):?>
                      <img src="<?php echo get_template_directory_uri();?>/images/triangle-<?php echo $pos_img;?>.png" class="triangle-<?php echo $pos_img;?>" alt="image">
                      <?php endif; ?>
                      <h4><?php echo $renblog_post_title; ?></h4>
                      <h5><?php echo get_the_date('d'); ?>&nbsp;<?php echo get_the_date('M'); ?>, <?php echo get_the_date('Y'); ?></h5>
                      <p><?php echo get_the_excerpt();  ?></p>
                    </div>
                  </a>
                </div>

<?php
       endif;
      endwhile;
?>
 <!--Carousel--></section>
              </div>

    </div>
    <?php if(isset($secret_thm['blog_url']) AND $secret_thm['blog_url'] != '' ): ?>
     <div class="text-center"><a href="<?php echo $secret_thm['blog_url']; ?>" target="_blank" class="button-01"><?php echo $secret_thm['more_blog_label']; ?></a></div>
    <?php endif; ?>
   </div>

   </div>
  <?php echo $par_ovl_close; ?>

</section>
<!-- Subsection to be added here -->

<?php
}


/*-------------------------------------
Default One-Page Section
--------------------------------------*/
elseif($secret_include_onepage == 'on' && $secret_filename != 'the-onepage')
{

//cooking Parallax Overlay
  if($secret_enb_parallax == 'on')
  {
     $par_ovl_open  = '<div class="parallax-ovl" style="background:rgba('.secret_hex2rgb($secret_bg_color).',0.9);">';
     $par_ovl_close = '</div>';
  }
  else
  {
     $par_ovl_open ='';
     $par_ovl_close ='';
  }

 //Padding Adjusters
  $padding = '';
  if($secret_pad_top !=''):
   $padding   .= 'padding-top:'.$secret_pad_top.'px; ';
  endif;
  if($secret_pad_bottom !=''):
   $padding   .= ' padding-bottom:'.$secret_pad_bottom.'px;';
  endif;
  if($secret_bg_image!=''): $abj = "url('".$secret_bg_image."') center top no-repeat; background-size:cover;"; else: $abj=''; endif;
?>

<section id="<?php echo $secret_new_title;?>" class="page-section" style="background:<?php echo $abj; ?> <?php echo $secret_bg_color; ?>;">
  <?php echo $par_ovl_open; ?>
  <div style="<?php echo $padding; ?>">


      <!-- Add Padding for container less pages -->
      <?php if($secret_enb_title != 'on'): ?>
       <div class="container">
        <div class="row">
          <div class="col-md-12">
					 <h1 class="section-heading text-center animated" style="color:<?php echo $secret_title_color; ?>" data-fx="<?php echo $secret_heading_animation; ?>"><?php echo $secret_page_heading; ?></h1>
					 <p class="sub-heading text-center"><?php echo $secret_page_subheading; ?></p>
					</div>
				</div>
        </div>
     <?php endif; ?>

     <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>></div>
    <?php if($secret_enb_container != 'on'): ?>
     <div class="container">
      <?php the_content();?>
    </div>
    <?php else: ?>
      <?php the_content();?>
    <?php endif; ?>

    </div>
  <?php echo $par_ovl_close; ?>
</section>



<?php
}
endforeach;
get_footer();
