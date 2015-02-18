<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 * @category Jasco
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/webdevstudios/Custom-Metaboxes-and-Fields-for-WordPress
 */

add_filter( 'cmb_meta_boxes', 'cmb_sample_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function cmb_sample_metaboxes( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = 'secret_';


	/**
	 * Metabox to be displayed on a single page ID
	 */
	$meta_boxes['page_metabox'] = array(
		'id'         => 'page_metabox',
		'title'      => __( 'Page Options', 'secretlang' ),
		'pages'      => array( 'page', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		//'show_on'    => array( 'key' => 'id', 'value' => array( 2, ), ), // Specific post IDs to display this metabox
		'fields'     => array(
			array(
				'name' => __( 'Include to One Page', 'secretlang' ),
				'desc' => __( 'This page will appear as a One-Page section', 'secretlang' ),
				'id'   => $prefix . 'include_onepage',
				'type' => 'checkbox',
			),	
			array(
				'name' => __( 'Sub-Heading', 'secretlang' ),
				'desc' => __( '', 'secretlang' ),
				'id'   => $prefix . 'page_subheading',
				'type' => 'text',
				'sanitization_cb' => false
			),						
			array(
				'name' => __( 'Background Image', 'secretlang' ),
				'desc' => __( 'Parallax Background Image', 'secretlang' ),
				'id'   => $prefix . 'page_bg',
				'type' => 'file',
			),
			// array(
			// 	'name' => __( 'Enable Parallax', 'secretlang' ),
			// 	'desc' => __( 'Background Color will be the overlay color', 'secretlang' ),
			// 	'id'   => $prefix . 'enb_parallax',
			// 	'type' => 'checkbox',
			// ),			
            array(
				'name'    => __( 'Background Color', 'cmb' ),
				'desc'    => __( 'Overlay/Background Color', 'cmb' ),
				'id'      => $prefix . 'bg_color',
				'type'    => 'colorpicker',
				'default' => '#ffffff'
			),
			array(
				'name' => __( 'Hide Section Title', 'secretlang' ),
				'desc' => __( 'Show/Hide Section title', 'secretlang' ),
				'id'   => $prefix . 'enb_title',
				'type' => 'checkbox',
			),				
            array(
				'name'    => __( 'Section Title Color', 'cmb' ),
				'desc'    => __( '', 'cmb' ),
				'id'      => $prefix . 'title_color',
				'type'    => 'colorpicker',
				'default' => '#000'
			),
			array(
				'name' => __( 'Heading Animation', 'secretlang' ),
				'desc' => __( 'Appearance Animation for heading', 'secretlang' ),
				'id'   => $prefix . 'heading_animation',
                'type'    => 'select',
				'options' => array(
					'' => 'None',
					'fadeIn' => 'fadeIn',
                    'flash' => 'flash',
					'pulse' => 'pulse',
					'shake' => 'shake',
					'swing' => 'swing',
					'tada' => 'tada',
					'wobble' => 'wobble',
					'bounceIn' => 'bounceIn',
					'bounceInDown' => 'bounceInDown',
					'bounceInLeft' => 'bounceInLeft',
					'bounceInRight' => 'bounceInRight',
					'bounceInUp' => 'bounceInUp',
					'bounceOut' => 'bounceOut',
					'bounceOutDown' => 'bounceOutDown',
					'bounceOutLeft' => 'bounceOutLeft',
					'bounceOutRight' => 'bounceOutRight',
					'bounceOutUp' => 'bounceOutUp',
					'fadeInDown' => 'fadeInDown',
					'fadeInDownBig' => 'fadeInDownBig',
					'fadeInLeft' => 'fadeInLeft',
					'fadeInLeftBig' => 'fadeInLeftBig',
					'fadeInRight' => 'fadeInRight',
					'fadeInRightBig' => 'fadeInRightBig',
					'fadeInUp' => 'fadeInUp',
					'fadeInUpBig' => 'fadeInUpBig',
					'flip' => 'flip',
					'flipInX' => 'flipInX',
					'flipInY' => 'flipInY',				
					'lightSpeedIn' => 'lightSpeedIn',
					'rotateIn' => 'rotateIn',
					'rotateInDownLeft' => 'rotateInDownLeft',
					'rotateInDownRight' => 'rotateInDownRight',
					'rotateInUpLeft' => 'rotateInUpLeft',
					'rotateInUpRight' => 'rotateInUpRight',
					'slideInDown' => 'slideInDown',
					'slideInLeft' => 'slideInLeft',
					'slideInRight' => 'slideInRight'
				)
				),



		)
	);

	/**
	 * Metabox to be displayed on a single page ID
	 */
	$meta_boxes['page_metabox_two'] = array(
		'id'         => 'page_metabox_two',
		'title'      => __( 'Spacing Adjustments', 'secretlang' ),
		'pages'      => array( 'page', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		//'show_on'    => array( 'key' => 'id', 'value' => array( 2, ), ), // Specific post IDs to display this metabox
		'fields'     => array(
			array(
				'name' => __( 'Padding Top', 'secretlang' ),
				'desc' => __( 'px - Defalt padding top: 0px', 'secretlang' ),
				'id'   => $prefix . 'pad_top',
				'type' => 'text_small',
				'default' => '0'
			),			
			array(
				'name' => __( 'Padding Bottom', 'secretlang' ),
				'desc' => __( 'px - Default Padding bottom:100px;', 'secretlang' ),
				'id'   => $prefix . 'pad_bottom',
				'type' => 'text_small',
				'default' => '0'
			),
			array(
				'name' => __( 'Disable Content Container', 'secretlang' ),
				'desc' => __( 'Create 100% wide sections', 'secretlang' ),
				'id'   => $prefix . 'enb_container',
				'type' => 'checkbox',
			),			
            		

		)
	);




	/**
	 * Metabox to be displayed on a services
	 */
	$meta_boxes['about_page_metabox'] = array(
		'id'         => 'about_page_metabox',
		'title'      => __( 'About Page Metabox', 'secretlang' ),
		'pages'      => array( 'services_item', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		//'show_on'    => array( 'key' => 'id', 'value' => array( 2, ), ), // Specific post IDs to display this metabox
		'fields'     => array(
			array(
				'name' => __( 'Icon', 'secretlang' ),
				'desc' => __( 'Icon appears inside the diamond', 'secretlang' ),
				'id'   => $prefix . 'ub_serv_icon',
				'type' => 'file',
			),			
			array(
				'name' => __( 'Short Decription', 'secretlang' ),
				'desc' => __( 'This short description appears as content in shortcodes. Contents added through native content area will be displayed on stand alone page only', 'secretlang' ),
				'id'   => $prefix . '_about_test_text',
				'type' => 'textarea',
			),
		)
	);

	/**
	 * Metabox to be displayed on portfolio
	 */
	$meta_boxes['works_aj_metabox'] = array(
		'id'         => 'works_aj_metabox',
		'title'      => __( 'Portfolio Meta Options', 'secretlang' ),
		'pages'      => array( 'portfolio_item', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		//'show_on'    => array( 'key' => 'id', 'value' => array( 2, ), ), // Specific post IDs to display this metabox
		'fields'     => array(
			array(
				'name' => __( 'Tile Click Action', 'secretlang' ),
				'desc' => __( '', 'secretlang' ),
				'id'   => $prefix . 'ub_port_mode',
                'type'    => 'select',
				'options' => array(
					'lightbox'   => __( 'Lightbox Image Only', 'secretlang' ),
					'project_page'    => __( 'Standalone Project Page', 'secretlang' ),
				 )
				),
            array(
				'name'         => __( 'Lightbox Image', 'cmb' ),
				'desc'         => __( 'Upload Image', 'cmb' ),
				'id'           => $prefix . 'port_lightbox_image',
				'type'         => 'file',
				'preview_size' => array( 50, 50 ), // Default: array( 50, 50 )
			),							
			array(
				'name' => __( 'Project Page Link Behaviour', 'secretlang' ),
				'desc' => __( 'Check to open the project page in new tab', 'secretlang' ),
				'id'   => $prefix . 'port_open_tab',
                'type'    => 'checkbox',
			),				
		

		)
	);


	/**
	 * Metabox to be displayed on POSTS
	 */
	$meta_boxes['posts_home_metabox'] = array(
		'id'         => 'posts_home_metabox',
		'title'      => __( 'Posts in One-Page Styles', 'secretlang' ),
		'pages'      => array( 'post', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		//'show_on'    => array( 'key' => 'id', 'value' => array( 2, ), ), // Specific post IDs to display this metabox
		'fields'     => array(
            array(
				'name'         => __( 'Thumbnail Position', 'cmb' ),
				'desc'         => __( 'Thumbnail/Slider/Video position', 'cmb' ),
				'id'           => $prefix . 'post_thumbpos',
				'type'         => 'radio_inline',
				'options'      => array(
				        'left' => __( 'Left', 'cmb' ),
				        'Right'   => __( 'Right', 'cmb' ),
				        'none'     => __( 'Content Only', 'cmb' ),
				    ),
			),		
			array(
			    'name' => 'Show this post in One-Page section',
			    'desc' => 'Check to show this post in One-Page section',
			    'id' => $prefix . 'post_showonepage',
			    'type' => 'checkbox'
			),
		

		)
	);




	/**
	 * Metabox to be displayed on POSTS
	 */
	$meta_boxes['posts_common_metabox'] = array(
		'id'         => 'posts_common_metabox',
		'title'      => __( 'Post Format Options', 'secretlang' ),
		'pages'      => array( 'post', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		//'show_on'    => array( 'key' => 'id', 'value' => array( 2, ), ), // Specific post IDs to display this metabox
		'fields'     => array(
            array(
				'name'         => __( 'Image Gallery', 'cmb' ),
				'desc'         => __( 'Upload or add multiple images. - Gallery Post', 'cmb' ),
				'id'           => $prefix . '_post_slider',
				'type'         => 'file_list',
				'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
			),		
			array(
				'name' => __( 'Embeded Audio', 'secretlang' ),
				'desc' => __( 'Soundcloud Embedding Codes (iFrame) - Audio Post', 'secretlang' ),
				'id'   => $prefix . 'post_audioembed',
				'type' => 'textarea_small',
				'sanitization_cb' => false
			),

			array(
				'name' => __( 'Embeded Video', 'secretlang' ),
				'desc' => __( 'Vimeo/Youtube Embedding Codes (iFrame) - Video Post', 'secretlang' ),
				'id'   => $prefix . 'post_videoembed',
				'type' => 'textarea_small',
				'sanitization_cb' => false
			),			

		)
	);

	return $meta_boxes;
}

add_action( 'init', 'cmb_initialize_cmb_meta_boxes', 9999 );
/**
 * Initialize the metabox class.
 */
function cmb_initialize_cmb_meta_boxes() {

	if ( ! class_exists( 'cmb_Meta_Box' ) )
		require_once 'init.php';

}
