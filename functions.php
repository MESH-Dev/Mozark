<?php
/*
functions.php
*/
global $secret_pagenow;
//Plugin Activation
require_once(get_template_directory().'/admin/class-tgm-plugin-activation.php');
//Theme Options
if ( class_exists('ReduxFrameworkPlugin') ) {
 require_once(get_template_directory().'/admin/themeoptions-config.php');
}
// // //Custom Post types
require_once (get_template_directory()."/admin/custom-post-types.php");
//Theme Stylesadmin
require_once (get_template_directory()."/admin/theme-styles.php");

//Theme Menus
require_once (get_template_directory()."/admin/center-menu.php");
require_once (get_template_directory()."/admin/native-menu.php");
require_once (get_template_directory()."/admin/mobile-menu.php");


require_once(get_template_directory()."/admin/cmb/theme-metaoptions.php");
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

/*---------------------------------------
---------Reason Initialiszation---------
-----------------------------------------*/
function secret_setup() 
  {

    //Feed links
		add_theme_support( 'automatic-feed-links' );

		//Nav menu
    register_nav_menus( array(
      'onepmenu'   => __( 'One Page Menu', 'secretlang' ),
      'native' => __( 'Native Menu', 'secretlang' ),
    ));    

    //Content width
		if (!isset( $content_width ) ) $content_width = 900;

		//Initiate custom post types
    add_action( 'init', 'secret_portfolio');

    // Standard Size Thumbnails
		load_theme_textdomain('secretlang', get_template_directory() . '/languages');

    // Standard Size Thumbnails
		add_theme_support( 'post-thumbnails', array('portfolio_item','post' ) );
        //Post formats
        add_theme_support(
			'post-formats', array(
				'gallery',
				'audio',
				'video'
			)
		);
    
    // Standard Size Thumbnails
		set_post_thumbnail_size( 400, 400, true ); 
		//Function to crop all thumbnails
		if(false === get_option("thumbnail_crop")) {
		add_option("thumbnail_crop", "1");
		} else {
		update_option("thumbnail_crop", "1");
		}	

   //Thumbnail Sizes

    if ( function_exists( 'add_image_size' ) ) {
        add_image_size( 'portfolio-thumb',355, 455, 9999 );
        add_image_size( 'blog-one-thumb',400, 400, 9999 );
    }



    //Custom Header
		$head_args = array(
			'default-image'   => get_template_directory_uri() . '/images/cover.jpg',
				'flex-width'    => true,
				'width'         => 1170,
				'flex-height'   => true,
				'height'        => 200,
		);
		add_theme_support( 'custom-header', $head_args );



  }
  add_action( 'after_setup_theme', 'secret_setup' );

 //Comment reply enqueue
  if(is_singular()): wp_enqueue_script( "comment-reply" ); endif;







/*---------------------------------------
---------Format comment Callback-----------
-----------------------------------------*/

function secret_format_comments($comment, $args, $depth) 
{
   $GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class('commentlists'); ?>>
                    <div class="blog-comment-image">
                        <?php 
                                $defimg = get_template_directory_uri(). "/images/avatar.png";
                                if(get_avatar($comment)):
                                  echo get_avatar($comment,$size='100');
                                else:
                                ?>
                                <img src="<?php echo $defimg; ?>"  alt="avatar" />
                               <?php endif; 
                        ?>
                    </div>  

                    <div class="blog-comment-spec">
                      <h5> <?php printf(__('%s','secretlang'), get_comment_author_link()) ?> 
                          <?php
                          $authID = get_the_author_meta('ID');                                              
                          if($authID == $comment->user_id)
                           echo "- Author";
                          else
                           echo "";
                          ?></h5>  
                      <h6> /   <?php comment_time('F jS, Y'); ?> / </h6>
                     <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
                     <?php edit_comment_link(__('&nbsp;,Edit','secretlang'),'<span class="edit-comment">', '</span>'); ?>

                      <p><?php comment_text() ?></p>                    
                    </div> 
                    <div class="float-clear"></div>
                  </li>


<?php
}

/*---------------------------------
Title Mode
-----------------------------------*/
function theme_name_wp_title( $title, $sep ) {
  if ( is_feed() ) {
    return $title;
  }
  
  global $page, $paged;

  // Add the blog name
  $title .= get_bloginfo( 'name', 'display' );

  // Add the blog description for the home/front page.
  $site_description = get_bloginfo( 'description', 'display' );
  if ( $site_description && ( is_home() || is_front_page() ) ) {
    $title .= " $sep $site_description";
  }

  // Add a page number if necessary:
  if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
    $title .= " $sep " . sprintf( __( 'Page %s', '_s' ), max( $paged, $page ) );
  }

  return $title;
}


add_filter( 'wp_title', 'theme_name_wp_title', 10, 2 );
/*---------------------------------
Important Plugin Activation Check
-----------------------------------*/
add_action( 'tgmpa_register', 'secret_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function secret_register_required_plugins() {

  /**
   * Array of plugin arrays. Required keys are name and slug.
   * If the source is NOT from the .org repo, then source is also required.
   */
  $plugins = array(

    // This is an example of how to include a plugin pre-packaged with a theme
    array(
      'name'            => 'Unbranded Secret Shortcodes', // The plugin name
      'slug'            => 'ub-secret', // The plugin slug (typically the folder name)
      'source'          => get_stylesheet_directory() . '/libs/ub-secret.zip', // The plugin source
      'required'        => true, // If false, the plugin is only 'recommended' instead of required
      'version'         => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
      'force_activation'    => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
      'force_deactivation'  => true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
      'external_url'      => '', // If set, overrides default API URL and points to an external URL
    ),


    // This is an example of how to include a plugin from the WordPress Plugin Repository
    array(
      'name'    => 'Redux Framework',
      'slug'    => 'redux-framework',
      'required'  => true,
      'force_activation'    => true,
      'force_deactivation'  => true,
    ),

    // This is an example of how to include a plugin from the WordPress Plugin Repository
    array(
      'name'    => 'WP Retina 2x',
      'slug'    => 'wp-retina-2x',
      'required'  => false,
      'force_activation'    => false,
    ),

    // This is an example of how to include a plugin from the WordPress Plugin Repository
    array(
      'name'    => 'Crop Thumbnails',
      'slug'    => 'crop-thumbnails',
      'required'  => false,
      'force_activation'    => false,
    ),


  );

  // Change this to your theme text domain, used for internationalising strings
  $theme_text_domain = 'secretlang';

  /**
   * Array of configuration settings. Amend each line as needed.
   * If you want the default strings to be available under your own theme domain,
   * leave the strings uncommented.
   * Some of the strings are added into a sprintf, so see the comments at the
   * end of each line for what each argument will be.
   */
  $config = array(
    'domain'          => $theme_text_domain,          // Text domain - likely want to be the same as your theme.
    'default_path'    => '',                          // Default absolute path to pre-packaged plugins
    'parent_menu_slug'  => 'themes.php',        // Default parent menu slug
    'parent_url_slug'   => 'themes.php',        // Default parent URL slug
    'menu'            => 'install-required-plugins',  // Menu slug
    'has_notices'       => true,                        // Show admin notices or not
    'is_automatic'      => false,             // Automatically activate plugins after installation or not
    'message'       => '',              // Message to output right before the plugins table
    'strings'         => array(
      'page_title'                            => __( 'Install Required Plugins', $theme_text_domain ),
      'menu_title'                            => __( 'Install Plugins', $theme_text_domain ),
      'installing'                            => __( 'Installing Plugin: %s', $theme_text_domain ), // %1$s = plugin name
      'oops'                                  => __( 'Something went wrong with the plugin API.', $theme_text_domain ),
      'notice_can_install_required'           => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
      'notice_can_install_recommended'      => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
      'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
      'notice_can_activate_required'          => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
      'notice_can_activate_recommended'     => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
      'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
      'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
      'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
      'install_link'                  => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
      'activate_link'                 => _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
      'return'                                => __( 'Return to Required Plugins Installer', $theme_text_domain ),
      'plugin_activated'                      => __( 'Plugin activated successfully.', $theme_text_domain ),
      'complete'                  => __( 'All plugins installed and activated successfully. %s', $theme_text_domain ), // %1$s = dashboard link
      'nag_type'                  => 'updated' // Determines admin notice type - can only be 'updated' or 'error'
    )
  );

  tgmpa( $plugins, $config );

}




/*---------------------------------
Excerpt Length
-----------------------------------*/
function secret_excerpt_length($length) {
	return 12;
}
add_filter( 'excerpt_length', 'secret_excerpt_length', 999 );
function secret_excerpt_more( $more ) {
	return '';
}
add_filter('excerpt_more', 'secret_excerpt_more');

/*---------------------------------
HEX to RGB Converter
-----------------------------------*/

function secret_hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   return implode(",", $rgb); // returns the rgb values separated by commas
   //return $rgb; // returns an array with the rgb values
}




/*-----------------------------------
Menu Walker
-------------------------------------*/
class add_span_walker extends Walker_Nav_Menu {
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        global $wp_query;
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        $class_names = '';

        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

        $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
        $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

        $output .= $indent . '<li' . $id . $class_names .'>';

        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;

        if ( 'primary' == $args->theme_location ) {
            $submenus = 0 == $depth || 1 == $depth ? get_posts( array( 'post_type' => 'nav_menu_item', 'numberposts' => 1, 'meta_query' => array( array( 'key' => '_menu_item_menu_item_parent', 'value' => $item->ID, 'fields' => 'ids' ) ) ) ) : false;
            $item_output .= ! empty( $submenus ) ? ( 0 == $depth ? '<span>&nbsp;&#x25BC;</span>' : '<span class="sub-arrow"></span>' ) : '';
        }
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}



/*---------------------------------
Push Font Awesome to Redux
-----------------------------------*/

function secret_newIconFont() {
    wp_register_style(
        'redux-font-awesome',get_template_directory_uri().'/fonts/fa/css/font-awesome.min.css',
        array(),
        time(),
        'all'
    );  
    wp_enqueue_style( 'redux-font-awesome' );
}
// This example assumes your opt_name is set to redux_demo, replace with your opt_name value
add_action( 'redux/page/secret_thm/enqueue', 'secret_newIconFont' );


/*---------------------------------
Custom Styles
-----------------------------------*/
function secret_add_class_next_post_link($html){
    $html = str_replace('<a','<a class="button"',$html);
    return $html;
    }
add_filter('next_post_link','secret_add_class_next_post_link',10,1);
    function secret_add_class_previous_post_link($html){
    $html = str_replace('<a','<a class="button"',$html);
    return $html;
    }
add_filter('previous_post_link','secret_add_class_previous_post_link',10,1);




/*---------------------------------------
--------Script and Style Enqueue---------
-----------------------------------------*/
    
   //Styles
   add_action('wp_enqueue_scripts','secret_css_common');

   //Scripts
   add_action('wp_enqueue_scripts','secret_always_loading_scripts');
   add_action('wp_enqueue_scripts','secret_theme_core_inits');

   //Combined Inits
  //add_action('wp_enqueue_scripts','secret_ytplayer_inits');  
  add_action('wp_enqueue_scripts','secret_mapsection_inits');  
  add_action('wp_enqueue_scripts','secret_contactform_inits');  
  add_action('wp_enqueue_scripts','secret_portfolio_scripts');  

  add_action('wp_enqueue_scripts','secret_mobilenavigation_init');  
  add_action('wp_enqueue_scripts','secret_video_init');  
  add_action('wp_enqueue_scripts','secret_slider_init');  
  add_action('wp_enqueue_scripts','secret_vinobox_lb');
  add_action('wp_enqueue_scripts','secret_waypoint_effect');      
  
  

  //add_action('wp_enqueue_scripts','secret_parallax_init');
  add_action('wp_enqueue_scripts','secret_slider_init');
  add_action('wp_enqueue_scripts','secret_trigger_anim');
  add_action('wp_enqueue_scripts','secret_bgnd_slider');  
  

/*---------------------*********------------------------
Scripts : Initialize
-----------------------*********-----------------------*/
function secret_always_loading_scripts() 
{ 
    //Top Loading Scripts
    wp_enqueue_script('jquery');
    wp_enqueue_script("modernizer", get_template_directory_uri(). "/javascripts/libs/modernizr.custom.min.js");  
    wp_enqueue_script("pace", get_template_directory_uri(). "/javascripts/libs/pace.min.js",array(),false,true);
    wp_enqueue_script("bootstrap", get_template_directory_uri(). "/bootstrap/js/bootstrap.js",array(),false,true);
    //libs
     wp_enqueue_script("waypoints", get_template_directory_uri(). "/javascripts/libs/waypoints.js",array(),false,true);
    wp_enqueue_script("easing", get_template_directory_uri(). "/javascripts/libs/jquery.easing.1.3.js",array(),false,true);
    wp_enqueue_script("retina", get_template_directory_uri(). "/javascripts/libs/retina.js",array(),false,true);
    wp_enqueue_script("devicemin", get_template_directory_uri(). "/javascripts/libs/device.min.js",array(),false,true);
    wp_enqueue_script("appear", get_template_directory_uri(). "/javascripts/libs/jquery.appear.js",array(),false,true);
    wp_enqueue_script("owl", get_template_directory_uri(). "/javascripts/libs/owl.carousel.js",array(),false,true);
    wp_enqueue_script("scroll", get_template_directory_uri(). "/javascripts/libs/scroll.js",array(),false,true);
    wp_enqueue_script("fitvideo", get_template_directory_uri(). "/javascripts/libs/jquery.fitvids.js",array(),false,true);
    wp_enqueue_script("issingle", get_template_directory_uri(). "/javascripts/issingle.js",array(),false,true);
    
}


/*Accordion*/
function secret_mapsection_inits()
{  
   wp_register_script("googlesettings","http://maps.google.com/maps/api/js?sensor=false",array(),false,true);  
   wp_register_script("pg-map", get_template_directory_uri(). "/javascripts/libs/jquery.gmap.min.js",array(),false,true);
   wp_register_script("pg-mapinit", get_template_directory_uri(). "/javascripts/mapg-init.js",array(),false,true);
}

/*Accordion*/
function secret_contactform_inits()
{  
   wp_register_script("form-validation", get_template_directory_uri(). "/javascripts/form-validation.js",array(),false,true);
}




/*----------------------------------------------
Masonary Port
-----------------------------------------------*/
function secret_portfolio_scripts() {

    wp_register_script("shuffle", get_template_directory_uri(). "/javascripts/libs/jquery.shuffle.min.js",array(),'1.0.0',true);
    wp_register_script("shuffle-init", get_template_directory_uri(). "/javascripts/portfolio-init.js",array(),'1.0.0',true);

}



function secret_theme_core_inits()
{ 
    wp_enqueue_script("theme-main", get_template_directory_uri(). "/javascripts/main.js",array(),false,true);
}







function secret_bgnd_slider() {
  wp_enqueue_style("bgnd-sty", get_template_directory_uri(). "/stylesheets/libs/bgndGallery.css");   
  wp_enqueue_script("bgnd", get_template_directory_uri(). "/javascripts/libs/mb.bgndGallery.js",array(),false,true);  
  wp_enqueue_script('bgnd_init', get_template_directory_uri() . '/javascripts/bgslider-fade-init.js', array(), '1.0.0', true );
}

/*----------------------------------------------
Sliding Navigation
-----------------------------------------------*/
function secret_mobilenavigation_init() {
 wp_enqueue_style("slidemenu", get_template_directory_uri(). "/stylesheets/slidingmenu.css");    
 wp_enqueue_script('mobmenu', get_template_directory_uri() . '/javascripts/slidingmenu.js', array(), '1.0.0', true );
  
}



/*----------------------------------------------
Video HD
-----------------------------------------------*/
function secret_video_init() {
    wp_enqueue_script("bgvideo", get_template_directory_uri(). "/javascripts/libs/okvideo.js",array(),'1.0.0',true);
    wp_enqueue_script("bgvideo-init", get_template_directory_uri(). "/javascripts/bgvideo-init.js",array(),'1.0.0',true);
}

/*----------------------------------------------
Slider
-----------------------------------------------*/
function secret_slider_init() {

    wp_register_script("slider_script", get_template_directory_uri(). "/javascripts/libs/superslides.min.js",array(),'1.0.0',true);
    wp_register_script("slider_init", get_template_directory_uri(). "/javascripts/superslides-init.js",array(),'1.0.0',true);
}





/*----------------------------------------------
Animation Management
-----------------------------------------------*/
function secret_trigger_anim() {
        wp_enqueue_style("animatecss", get_template_directory_uri(). "/stylesheets/libs/animate.css");  
        wp_enqueue_script('triganim', get_template_directory_uri(). "/javascripts/animation-init.js",array(),'1.0.0',true);  
    }  


/*----------------------------------------------
Venobox Management
-----------------------------------------------*/
function secret_vinobox_lb() {
        wp_enqueue_style("venobox-css", get_template_directory_uri(). "/stylesheets/libs/venobox.css");  
        wp_enqueue_script('venobox-lib', get_template_directory_uri(). "/javascripts/libs/venobox.min.js",array(),'1.0.0',true);
        wp_enqueue_script('venobox-init', get_template_directory_uri(). "/javascripts/venobox-init.js",array(),'1.0.0',true);    
    }  

/*----------------------------------------------
Waypoint Sticky
-----------------------------------------------*/
function secret_waypoint_effect() {
  wp_enqueue_script("issingle", get_stylesheet_directory_uri()."/javascripts/issingle.js",array(),false,true); 
  wp_enqueue_script("waypoints_stick", get_template_directory_uri(). "/javascripts/libs/waypoints-sticky.min.js",array(),false,true);
  wp_enqueue_script("waypoint-init", get_stylesheet_directory_uri()."/javascripts/menu-sticky-init.js",array(),false,true); 
}

 /*---------------------------------
Custom Styles
-----------------------------------*/

add_filter('next_posts_link_attributes', 'next_posts_link_attributes');
add_filter('previous_posts_link_attributes', 'next_posts_link_attributes');


function next_posts_link_attributes() {
    return 'class="button"';
}


/*---------------------------------
Custom Styles
-----------------------------------*/
function secret_my_styles() {
  global $secret_thm;


//Realtime Modification
  wp_enqueue_style('custom-style',get_template_directory_uri() . '/stylesheets/custom_css.css');

  //Theme Prominent Color

  $custom_css ='  
  .blog-header-section
  {
    background:url('.get_header_image().') center center no-repeat;
    background-size:cover;
  }

';





//Admin Bar active
  $custom_css .='';
  if ( is_admin_bar_showing() ) {
        $custom_css .= "
        .navigation-section
        {
          top:32px;
        }

        ";
  }
if(isset($secret_thm['promcolor']) AND $secret_thm['promcolor'] != ''):
  $prom_color = $secret_thm['promcolor'];
//Link Color Modification
  $custom_css .= '
.sub-heading:after{
  background: '.$prom_color.';
}
.social-icon:hover{
  background: '.$prom_color.';
}
.bg-color-gold{
  background: '.$prom_color.';
}
.color-gold{
  color: '.$prom_color.';
}
.button-01:hover{
  background: '.$prom_color.';
  border: 2px solid '.$prom_color.';
  color: #fff;
}
.button-02:hover{
  background: '.$prom_color.';
  border: 2px solid '.$prom_color.';
}
.main-header ul li:hover a{
  color: '.$prom_color.';
  
}
.down-scroll:hover{
  border: 2px solid '.$prom_color.';
  background: '.$prom_color.';
}
.about-content h4:after{
  background: '.$prom_color.';
}
.filter.active{
  background: '.$prom_color.';
}
.testimonial h3{
  color: '.$prom_color.';
}
.testimonial-owl.owl-theme .owl-controls .owl-page.active span, .testimonial-owl.owl-theme .owl-controls.clickable .owl-page:hover span{
  background: '.$prom_color.';
  border: 2px solid '.$prom_color.';
}
.services-column h4{
  border-bottom: 2px solid '.$prom_color.';
}
.pricing-column:hover > .pricing-head{
  background: '.$prom_color.';
}
.pricing-column:hover > .sland path{
  fill: '.$prom_color.';
}
.blog-item-text h4:before {
    background: '.$prom_color.';
}
.blog-slider.owl-theme .owl-controls .owl-page.active span, .blog-slider.owl-theme .owl-controls.clickable .owl-page:hover span{
  background: '.$prom_color.';
  border: 2px solid '.$prom_color.';
}
.contact-address h2:hover{
  border: 2px solid '.$prom_color.';
  background: '.$prom_color.';
}
.contact-form button:hover{
  background: '.$prom_color.';
  border: 2px solid '.$prom_color.';
}
.alert{
  background: '.$prom_color.';
}
.map-button:hover{
  background: '.$prom_color.';
}
.to-top:hover{
  background: '.$prom_color.';
}
.inner-page-section-heading:after{
  background: '.$prom_color.';
}
.blog-post-text h1:after{
  background: '.$prom_color.';
}
.blog-post-slider.owl-theme .owl-controls .owl-page.active span, .testimonial-owl.owl-theme .owl-controls.clickable .owl-page:hover span{
  background: '.$prom_color.';
  border: 2px solid '.$prom_color.';
}
.blog-quote-post h4{
  color: '.$prom_color.';
}
.blog-quote-post h4:before{
  background: '.$prom_color.';
}
.blog-quote-post h4:after{
  background: '.$prom_color.';
}
.button:hover{
  background: '.$prom_color.';
  border: 2px solid '.$prom_color.';
}
.blog-post-details-text-quote{
  border-left: 2px solid '.$prom_color.';
}
.blog-post-details-text-quote h4{
  color: '.$prom_color.';
}
.blog-post-details-text-quote h4:before{
  background: '.$prom_color.';
}
.share-social-icon:hover{
  background: '.$prom_color.';
  border: 2px solid '.$prom_color.';
}
.blog-post-comments h1{
  border-bottom: 2px solid '.$prom_color.';
}
.related-post-text h4{
  border-bottom: 2px solid '.$prom_color.';
}
.single-project-slider.owl-theme .owl-controls .owl-page.active span, .single-project-slider.owl-theme .owl-controls.clickable .owl-page:hover span{
  background: '.$prom_color.';
  border: 2px solid '.$prom_color.';
}
.single-project-text h2:after{
  background: '.$prom_color.';
}
.single-project-details h3:after{

  background: '.$prom_color.';
}
.thanks-page span{
  color: '.$prom_color.';
}
.blog-item-text h4
{
  border-bottom:2px solid '.$prom_color.';
}
.pace .pace-activity {
  background: '.$prom_color.';
}
.desknav li a:hover
{
  color: '.$prom_color.';
}
'; 
endif;
  //Custom CSS
  if(isset($secret_thm['custom-css']) AND $secret_thm['custom-css'] != ''):
   $custom_css .= $secret_thm['custom-css'];
  else:
   $custom_css .= '';
  endif;


 wp_add_inline_style( 'custom-style', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'secret_my_styles');