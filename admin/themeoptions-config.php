<?php
if (!function_exists('redux_init')) :
	function redux_init() {

	$args = array();


	// For use with a tab example below
	$tabs = array();

	ob_start();

	$ct = wp_get_theme();
	$theme_data = $ct;
	$item_name = $theme_data->get('Name'); 
	$tags = $ct->Tags;
	$screenshot = $ct->get_screenshot();
	$class = $screenshot ? 'has-screenshot' : '';

	$customize_title = sprintf( __( 'Customize &#8220;%s&#8221;','secretlang' ), $ct->display('Name') );

	?>
	<div id="current-theme" class="<?php echo esc_attr( $class ); ?>">
		<?php if ( $screenshot ) : ?>
			<?php if ( current_user_can( 'edit_theme_options' ) ) : ?>
			<a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize" title="<?php echo esc_attr( $customize_title ); ?>">
				<img src="<?php echo esc_url( $screenshot ); ?>" alt="<?php esc_attr_e( 'Current theme preview' ); ?>" />
			</a>
			<?php endif; ?>
			<img class="hide-if-customize" src="<?php echo esc_url( $screenshot ); ?>" alt="<?php esc_attr_e( 'Current theme preview' ); ?>" />
		<?php endif; ?>

		<h4>
			<?php echo $ct->display('Name'); ?>
		</h4>

		<div>
			<ul class="theme-info">
				<li><?php printf( __('By %s','secretlang'), $ct->display('Author') ); ?></li>
				<li><?php printf( __('Version %s','secretlang'), $ct->display('Version') ); ?></li>
				<li><?php echo '<strong>'.__('Tags', 'secretlang').':</strong> '; ?><?php printf( $ct->display('Tags') ); ?></li>
			</ul>
			<p class="theme-description"><?php echo $ct->display('Description'); ?></p>
			<?php if ( $ct->parent() ) {
				printf( ' <p class="howto">' . __( 'This <a href="%1$s">child theme</a> requires its parent theme, %2$s.' ) . '</p>',
					__( 'http://codex.wordpress.org/Child_Themes','secretlang' ),
					$ct->parent()->display( 'Name' ) );
			} ?>
			
		</div>

	</div>

	<?php
	$item_info = ob_get_contents();
	    
	ob_end_clean();

	$sampleHTML = '';
	if( file_exists( dirname(__FILE__).'/info-html.html' )) {
		/** @global WP_Filesystem_Direct $wp_filesystem  */
		global $wp_filesystem;
		if (empty($wp_filesystem)) {
			require_once(ABSPATH .'/wp-admin/includes/file.php');
			WP_Filesystem();
		}  		
		$sampleHTML = $wp_filesystem->get_contents(dirname(__FILE__).'/info-html.html');
	}

	// BEGIN Sample Config

	// Setting dev mode to true allows you to view the class settings/info in the panel.
	// Default: true
	$args['dev_mode'] = false;

	// Set the icon for the dev mode tab.
	// If $args['icon_type'] = 'image', this should be the path to the icon.
	// If $args['icon_type'] = 'iconfont', this should be the icon name.
	// Default: info-sign
	//$args['dev_mode_icon'] = 'info-sign';

	// Set the class for the dev mode tab icon.
	// This is ignored unless $args['icon_type'] = 'iconfont'
	// Default: null
	//$args['dev_mode_icon_class'] = '';

	// Set a custom option name. Don't forget to replace spaces with underscores!
	$args['opt_name'] = 'secret_thm';

	// Setting system info to true allows you to view info useful for debugging.
	// Default: false
	//$args['system_info'] = true;


	// Set the icon for the system info tab.
	// If $args['icon_type'] = 'image', this should be the path to the icon.
	// If $args['icon_type'] = 'iconfont', this should be the icon name.
	// Default: info-sign
	//$args['system_info_icon'] = 'info-sign';

	// Set the class for the system info tab icon.
	// This is ignored unless $args['icon_type'] = 'iconfont'
	// Default: null
	//$args['system_info_icon_class'] = 'icon-large';

	$theme = wp_get_theme();

	$args['display_name'] = $theme->get('Name');
	//$args['database'] = "theme_mods_expanded";
	$args['display_version'] = $theme->get('Version');

	// If you want to use Google Webfonts, you MUST define the api key.
	$args['google_api_key'] = 'AIzaSyAX_2L_UzCDPEnAHTG7zhESRVpMPS4ssII';

	// Define the starting tab for the option panel.
	// Default: '0';
	//$args['last_tab'] = '0';

	// Define the option panel stylesheet. Options are 'standard', 'custom', and 'none'
	// If only minor tweaks are needed, set to 'custom' and override the necessary styles through the included custom.css stylesheet.
	// If replacing the stylesheet, set to 'none' and don't forget to enqueue another stylesheet!
	// Default: 'standard'
	//$args['admin_stylesheet'] = 'standard';

	// Setup custom links in the footer for share icons


	// Enable the import/export feature.
	// Default: true
	$args['show_import_export'] = true;

	// Set the icon for the import/export tab.
	// If $args['icon_type'] = 'image', this should be the path to the icon.
	// If $args['icon_type'] = 'iconfont', this should be the icon name.
	// Default: refresh
	//$args['import_icon'] = 'refresh';
    //$args['icon_type'] = 'fa fa-sliders';
	// Set the class for the import/export tab icon.
	// This is ignored unless $args['icon_type'] = 'iconfont'
	// Default: null
	//$args['import_icon_class'] = '';

	/**
	 * Set default icon class for all sections and tabs
	 * @since 3.0.9
	 */
	//$args['default_icon_class'] = '';


	// Set a custom menu icon.
	$args['menu_icon'] = get_template_directory_uri().'/admin/menu_icon.png';

	// Set a custom title for the options page.
	// Default: Options
	$args['menu_title'] = __('Theme Options', 'secretlang');

	// Set a custom page title for the options page.
	// Default: Options
	$args['page_title'] = __('Theme Options', 'secretlang');

	// Set a custom page slug for options page (wp-admin/themes.php?page=***).
	// Default: redux_options
	$args['page_slug'] = 'ub_theme_options';

	$args['default_show'] = true;
	$args['default_mark'] = '*';

	// Set a custom page capability.
	// Default: manage_options
	//$args['page_cap'] = 'manage_options';

	// Set the menu type. Set to "menu" for a top level menu, or "submenu" to add below an existing item.
	// Default: menu
	//$args['page_type'] = 'submenu';

	// Set the parent menu.
	// Default: themes.php
	// A list of available parent menus is available at http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
	//$args['page_parent'] = 'options-general.php';

	// Set a custom page location. This allows you to place your menu where you want in the menu order.
	// Must be unique or it will override other items!
	// Default: null
	$args['page_position'] = 55;

	// Set a custom page icon class (used to override the page icon next to heading)
	//$args['page_icon'] = 'icon-themes';

	// Set the icon type. Set to "iconfont" for Elusive Icon, or "image" for traditional.
	// Redux no longer ships with standard icons!
	// Default: iconfont
	//$args['icon_type'] = 'iconfont';

	// Disable the panel sections showing as submenu items.
	// Default: true
	//$args['allow_sub_menu'] = false;
	    
	// Set ANY custom page help tabs, displayed using the new help tab API. Tabs are shown in order of definition.
	$args['help_tabs'][] = array(
	    'id' => 'redux-opts-1',
	    'title' => __('Theme Information 1', 'secretlang'),
	    'content' => __('<p>This is the tab content, HTML is allowed.</p>', 'secretlang')
	);
	$args['help_tabs'][] = array(
	    'id' => 'redux-opts-2',
	    'title' => __('Theme Information 2', 'secretlang'),
	    'content' => __('<p>This is the tab content, HTML is allowed.</p>', 'secretlang')
	);

	// Set the help sidebar for the options page.                                        
	$args['help_sidebar'] = __('<p>This is the sidebar content, HTML is allowed.</p>', 'secretlang');


	// Add HTML before the form.
	if (!isset($args['global_variable']) || $args['global_variable'] !== false ) {
		if (!empty($args['global_variable'])) {
			$v = $args['global_variable'];
		} else {
			$v = str_replace("-", "_", $args['opt_name']);
		}
		$args['intro_text'] = sprintf( __('<p>Theme Options</p>', 'secretlang' ), $v );
	} else {
		$args['intro_text'] = __('<p>Theme Options</p>', 'secretlang');
	}

	// Add content after the form.
	$args['footer_text'] = __('<p></p>', 'secretlang');

	// Set footer/credit line.
	//$args['footer_credit'] = __('<p>This text is displayed in the options panel footer across from the WordPress version (where it normally says \'Thank you for creating with WordPress\'). This field accepts all HTML.</p>', 'secretlang');


	$sections = array();              

	//Background Patterns Reader
	$sample_patterns_path = ReduxFramework::$_dir . '../sample/patterns/';
	$sample_patterns_url  = ReduxFramework::$_url . '../sample/patterns/';
	$sample_patterns      = array();

	if ( is_dir( $sample_patterns_path ) ) :
		
	  if ( $sample_patterns_dir = opendir( $sample_patterns_path ) ) :
	  	$sample_patterns = array();

	    while ( ( $sample_patterns_file = readdir( $sample_patterns_dir ) ) !== false ) {

	      if( stristr( $sample_patterns_file, '.png' ) !== false || stristr( $sample_patterns_file, '.jpg' ) !== false ) {
	      	$name = explode(".", $sample_patterns_file);
	      	$name = str_replace('.'.end($name), '', $sample_patterns_file);
	      	$sample_patterns[] = array( 'alt'=>$name,'img' => $sample_patterns_url . $sample_patterns_file );
	      }
	    }
	  endif;
	endif;


	$sections[] = array(
		'title' => __('General Settings', 'secretlang'),
		'desc' => __('Basic theme settings', 'secretlang'),
		'icon' => 'fa fa-cogs',
	    // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
		'fields' => array(				
             array('title' => __('Logo', 'secretlang'),
					"desc" => __("", 'secretlang'),
					"id"   => "mainlogo",
					"type" => "media"

				),
            array('title'  => __('Retina Logo (2x)', 'secretlang'),
					"desc" => __("Logo for HiDPI/Retina Ready Devices Like Smartphones File naming:logonam2x@.fmt", 'secretlang'),
					"id"   => "retinalogo",
					"std"  => "",
					"mod"  => "min",
					"type" => "media"
				), 
          
            array( "title" => __('Favicon', 'secretlang'),
					"desc" => __("Website Favicon", 'secretlang'),
					"id"   => "favicon",
					"mod"  => "min",
					"type" => "media"),	
            array( "title"   => __('Footer Text', 'secretlang'),
					"desc"   => __("Copyright text", 'secretlang'),
					"id"     => "footer_copyright",
					"default"    => "Copyright &copy; 2014. All rights reserved",
					"type"   => "textarea", 
                 ),
           array( 	"title" 		=> "Menu Location",
             	        "type" 		=> "switch",
						"id" 		=> "menu_location",
						"default"   => 1,
						"on" 		=> "One Page Menu",
						"off" 		=> "Native Menu",					
						"desc" 		=> __("Choose 'One Page Menu' for optimized One-Page navigation. The 'Native Menu' is for default wordpress navigation", 'secretlang'),
				),

			array(
				'id'=>'990',
				'type' => 'divide'
				),	


               array(
                        'id'   => 'blog_url',
                        'type' => 'text',
                        'title'=> __('Blog Page URL', 'secretlang'),
                        'desc' => __('Absolute URL to stanadlone Blog Page', 'secretlang'),
               ),
               array(
                        'id'      => 'more_blog_label',
                        'type'    => 'text',
                        'title'   => __('Blog Page URL - Button Label', 'secretlang'),
                        'default' => 'Read More',
                        'desc'    => __('Absolute URL to stanadlone Blog Page', 'secretlang'),
               ),	               	
			array(
				'id'=>'991',
				'type' => 'divide'
				),	
               array(
                        'id' => 'tracking-code',
                        'type' => 'textarea',
                        'title' => __('Tracking Code', 'secretlang'),
                        'subtitle' => __('Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.', 'secretlang'),
                        'validate' => 'js',
                        'desc' => 'Google Analytics Tracking Code',
               ),											
			
			)
		);

	$sections[] = array(
		'title' => __('Background Options', 'secretlang'),
		'desc' => __('Settings for "Home Page" with video background', 'secretlang'),
		'icon' => 'fa fa-desktop',
	    // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
		'fields' => array(				

            array('title'  => __('Background Mode', 'secretlang'),
					"desc" => __("Hero Section Background Mode", 'secretlang'),
					"id"   => "bg_mode",
					'validate' => '',
					"type" => "radio",
					'options'  => array(
					        '1' => 'Video', 
					        '2' => 'Image', 
					        '3' => 'Slider'
					    ),
					'default' => '2'					
				),  

            array('title'  => __('Video Unique ID', 'secretlang'),
					"desc" => __("Ex Youtube:jiyIcz7wUH0<br/>Vimeo:31241154", 'secretlang'),
					"id"   => "unique_video_id",
					'validate' => 'no_special_chars',
					"type" => "text",
					'required' => array( 
						    array('bg_mode','equals','1'), 
						)

				),   
            array('title'  => __('Fall Back Image', 'secretlang'),
					"desc" => __("To be displayed on mobile devices which does not support flash video playback", 'secretlang'),
					"id"   => "video_fallback_image",
					"type" => "media",
					'required' => array( 
						    array('bg_mode','equals','1'), 
						)					
				), 

            array('title'  => __('Background Slider', 'secretlang'),
					"desc" => __("Ensure that you haven't uploaded any images for Hero Section in page meta", 'secretlang'),
					"id"   => "bg_img_slider",
					"type" => "slides",
					'required' => array( 
						    array('bg_mode','equals','3'), 
						)					
				), 
			array(
			    
			    'id' => 'info_critical_imagebg',
    			'type' => 'info',
    			'style' => 'info',
    			'icon' => 'el-icon-info-sign',
    			'title' => __('Background Slider', 'secretlang'),
    			'desc' => __('Please upload Image through page meta option for background', 'secretlang'),
				'required' => array( 
						    array('bg_mode','equals','2'), 
						    )
				),            
			array(
			    
			    'id' => 'info_critical_slider',
    			'type' => 'info',
    			'style' => 'critical',
    			'icon' => 'el-icon-info-sign',
    			'title' => __('Background Slider', 'secretlang'),
    			'desc' => __('Ensure that you haven\'t uploaded Background images through Page Meta option', 'secretlang'),
				'required' => array( 
						    array('bg_mode','equals','3'), 
						    )
				),
			array(
			    
			    'id' => 'info_critical_video',
    			'type' => 'info',
    			'style' => 'critical',
    			'icon' => 'el-icon-info-sign',
    			'title' => __('Background Video', 'secretlang'),
    			'desc' => __('Ensure that you haven\'t uploaded Background images through Page Meta option', 'secretlang'),
				'required' => array( 
						    array('bg_mode','equals','1'), 
				)
			),
          )
		);



	$sections[] = array(
		'icon' => 'fa fa-laptop',
		'title' => __('Appearance Customization', 'secretlang'),
		'fields' => array
		 (

			array(
				'id'=>'promcolor',
				'type' => 'color',
				'title' => __('Theme Color Scheme', 'secretlang'), 
				'subtitle' => __('Prominent theme color scheme. (Excluding color choose options enabled blocks)', 'secretlang'),
				'default' => '#b3a68a',
				'validate' => 'color',
				),            
			array(
				'id'=>'custom-css',
				'type' => 'textarea',
				'title' => __('Custom CSS', 'secretlang'), 
				'subtitle' => __('Quickly add some CSS to your theme by adding it to this block.', 'secretlang'),
				'desc' => __('This field is even CSS validated!', 'secretlang'),
				'validate' => 'css',
				),

		)
	);
/*----Contact form------------*/		

	$sections[] = array(
		'icon' => 'fa fa-envelope',
		'title' => __('Contact Form Options', 'secretlang'),
		'fields' => array(

			array(
				'id'=>'contact_email',
				'type' => 'text',
				'default' => '',
				'title' => __('Contact reception Email', 'secretlang'), 
				'desc' => __('Email to receive contact form data', 'secretlang'),
				'validate' => 'email',
				),	

           array(
	                'title'   => __('Name Label', 'secretlang'),
					"desc"    => __("Label for name, replace with your own language", 'secretlang'),
					"id"      => "label_name",
					"default" => "Name",
					"type"    => "text"
				),

          array( "title"   => __("Name - Validation error message", 'secretlang'),
				 "desc"    => __("Label for name, replace with your own language", 'secretlang'),
				 "id"      => "label_name_error",
				 "default" => "Name must not be empty",
				 "type"    => "text"
				 ),											
array( "title"   => __("Email Label",'secretlang'),
					"desc"    => __("Label for email, replace with your own language", 'secretlang'),
					"id" => "label_email",
					"default" => "Email",
					"type" => "text"),
array( "title"   => __("Email - Validation error message",'secretlang'),
					"desc"    => __("Label for email, replace with your own language", 'secretlang'),
					"id" => "label_email_error",
					"default" => "Enter a valid email!",
					"type" => "text"),
array( "title"   => __("Subject Label",'secretlang'),
					"desc"    => __("Label for phone field, replace with your own language", 'secretlang'),
					"id" => "label_subject",
					"default" => "Subject",
					"type" => "text"),
array( "title"   => __("Subject - Validation error message",'secretlang'),
					"desc"    => __("Replace with your own language", 'secretlang'),
					"id" => "label_subject_error",
					"default" => "Subject cannot be empty",
					"type" => "text"),
array( "title"   => __("Message Label",'secretlang'),
					"desc"    => __("Label for email, replace with your own language", 'secretlang'),
					"id" => "label_message",
					"default" => "Message",
					"type" => "text"),
array( "title"   => __("Message - Validation error message",'secretlang'),
					"desc"    => __("Replace with your own language", 'secretlang'),
					"id" => "label_message_error",
					"default" => "Message must not be empty!",
					"type" => "text"),
 array( "title"   => __("Send Button",'secretlang'),
					"desc"    => __("Label for send message button", 'secretlang'),
					"id" => "label_sendmsg",
					"default" => "Send Message",
					"type" => "text"),
array( "title"   => __("Success Message",'secretlang'),
					"desc"    => __("On Successful submission", 'secretlang'),
					"id" => "msg_success",
					"default" => "Message sent successfully!",
					"type" => "text"),
array( "title"   => __("Failure Message",'secretlang'),
					"desc"    => __("On Successful submission", 'secretlang'),
					"id" => "msg_fail",
					"default" => "Oops! Something went wrong try again!",
					"type" => "text")			



		)
	);

	$sections[] = array(
		'title' => __('Map Options', 'secretlang'),
		'desc' => __('Settings for Google maps on OnePage footer', 'secretlang'),
		'icon' => 'fa fa-map-marker',
	    // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
		'fields' => array(	
				
			array(
				'id'=>'map_marker_icon',
				'type' => 'media',
				'title' => __('Map Marker Icon', 'secretlang'), 
				'subtitle' => __('Icon on exact location on map', 'secretlang'),
				),


            array('title'  => __('Lattitude', 'secretlang'),
					"desc" => __("Lattitude of your Location", 'secretlang'),
					"id"   => "map_lattitude",
					"type" => "text",
				),   
            array('title'  => __('Longitude', 'secretlang'),
					"desc" => __("Longitude of your location", 'secretlang'),
					"id"   => "map_longitude",
					"type" => "text",
				), 


            
              				
			)
		);

/*----------*/

	$sections[] = array(
		'icon' => 'fa fa-group',
		'title' => __('Social Media Options', 'secretlang'),
		'fields' => array(

array(
       'id' => 'section-start',
       'type' => 'section',
       'title' => __('Sharing Buttons', 'secretlang'),
       'subtitle' => __('Select areas to show built-in sharing buttons', 'secretlang'),
       'indent' => true 
   ),
            array( "title"    => "Standloane Pages",
						"desc"   => "Check to Enable",
						"id"     => "standalone_pages",
						"default"    => 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",							
						"type" 		=> "switch"),
            array( "title"    => "Portfolio Standloane Pages",
						"desc"   => "Check to Enable",
						"id"     => "port_standalone_pages",
						"default"    => 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",							
						"type" 		=> "switch"),
            array( "title"    => "Single Post Page",
						"desc"   => "Check to Enable",
						"id"     => "post_single",
						"default"    => 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",							
						"type" 		=> "switch"),            
array(
    'id'     => 'section-end',
    'type'   => 'section',
    'indent' => false,
),

            array( "title"    => "Twitter",
						"desc"   => "Twitter profile id",
						"id"     => "twitter",
						"default"    => "pixelglimpse",
						"type"   => "text"),

            array( "title"    => "LinkedIn",
						"desc"   => "Linked profile id",
						"id"     => "linkedin",
						"default"    => "",
						"type"   => "text"),

            array( "title"    => "Facebook",
						"desc"   => "Facebook profile id",
						"id"     => "facebook",
						"default"    => "",
						"type"   => "text"),

            array( "title"    => "Google Plus",
						"desc"   => "Google Plus profile id",
						"id"     => "gplus",
						"default"    => "",
						"type"   => "text"), 

            array( "title"    => "Custom Social Media",
						"desc"   => 'EX: <a href="http://sitename.tld/userid"><i class="icon-ICONNAME"></i></a>. (Icons through IcoMoon)',
						"id"     => "social_custom",
						"default"    => '',
						"type"   => "textarea"), 						       
		)
	);






	/**
	 *  Note here I used a 'heading' in the sections array construct
	 *  This allows you to use a different title on your options page
	 * instead of reusing the 'title' value.  This can be done on any 
	 * section - kp
	 */
	
			
			

	if (function_exists('wp_get_theme')){
	$theme_data = wp_get_theme();
	$theme_uri = $theme_data->get('ThemeURI');
	$description = $theme_data->get('Description');
	$author = $theme_data->get('Author');
	$version = $theme_data->get('Version');
	$tags = $theme_data->get('Tags');
	}else{
	$theme_data = wp_get_theme(trailingslashit(get_stylesheet_directory()).'style.css');
	$theme_uri = $theme_data['URI'];
	$description = $theme_data['Description'];
	$author = $theme_data['Author'];
	$version = $theme_data['Version'];
	$tags = $theme_data['Tags'];
	}	

	$theme_info = '<div class="redux-framework-section-desc">';
	$theme_info .= '<p class="redux-framework-theme-data description theme-uri">'.__('<strong>Theme URL:</strong> ', 'secretlang').'<a href="'.$theme_uri.'" target="_blank">'.$theme_uri.'</a></p>';
	$theme_info .= '<p class="redux-framework-theme-data description theme-author">'.__('<strong>Author:</strong> ', 'secretlang').$author.'</p>';
	$theme_info .= '<p class="redux-framework-theme-data description theme-version">'.__('<strong>Version:</strong> ', 'secretlang').$version.'</p>';
	$theme_info .= '<p class="redux-framework-theme-data description theme-description">'.$description.'</p>';
	if ( !empty( $tags ) ) {
		$theme_info .= '<p class="redux-framework-theme-data description theme-tags">'.__('<strong>Tags:</strong> ', 'secretlang').implode(', ', $tags).'</p>';	
	}
	$theme_info .= '</div>';

	if(file_exists(dirname(__FILE__).'/README.md')){
	$sections['theme_docs'] = array(
				'icon' => ReduxFramework::$_url.'assets/img/glyphicons/glyphicons_071_book.png',
				'title' => __('Documentation', 'secretlang'),
				'fields' => array(
					array(
						'id'=>'17',
						'type' => 'raw',
						'content' => file_get_contents(dirname(__FILE__).'/README.md')
						),				
				),
				
				);
	}//if


	$sections[] = array(
		'type' => 'divide',
	);

	$sections[] = array(
		'icon' => 'el-icon-info-sign',
		'title' => __('Theme Information', 'secretlang'),
		'desc' => __('<p class="description">This is the Description. Again HTML is allowed</p>', 'secretlang'),
		'fields' => array(
			array(
				'id'=>'raw_new_info',
				'type' => 'raw',
				'content' => $item_info,
				)
			),   
		);


	if(file_exists(trailingslashit(dirname(__FILE__)) . 'README.html')) {
	    $tabs['docs'] = array(
			'icon' => 'el-icon-book',
			    'title' => __('Documentation', 'secretlang'),
	        'content' => nl2br(file_get_contents(trailingslashit(dirname(__FILE__)) . 'README.html'))
	    );
	}

	global $ReduxFramework;
	$ReduxFramework = new ReduxFramework($sections, $args, $tabs);

	// END Sample Config
	}
	add_action('init', 'redux_init');
endif;

/**
 
 	Custom function for filtering the sections array. Good for child themes to override or add to the sections.
 	Simply include this function in the child themes functions.php file.
 
 	NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
 	so you must use get_template_directory_uri() if you want to use any of the built in icons
 
 **/
if ( !function_exists( 'redux_add_another_section' ) ):
	function redux_add_another_section($sections){
	    //$sections = array();
	    $sections[] = array(
	        'title' => __('Section via hook', 'secretlang'),
	        'desc' => __('<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'secretlang'),
			'icon' => 'el-icon-paper-clip',
			    // Leave this as a blank section, no options just some intro text set above.
	        'fields' => array()
	    );

	    return $sections;
	}
	add_filter('redux/options/redux_demo/sections', 'redux_add_another_section');
	// replace redux_demo with your opt_name
endif;
/**

	Filter hook for filtering the args array given by a theme, good for child themes to override or add to the args array.

**/
if ( !function_exists( 'redux_change_framework_args' ) ):
	function redux_change_framework_args($args){
	    //$args['dev_mode'] = true;
	    
	    return $args;
	}
	add_filter('redux/options/redux_demo/args', 'redux_change_framework_args');
	// replace redux_demo with your opt_name
endif;
/**

	Filter hook for filtering the default value of any given field. Very useful in development mode.

**/
if ( !function_exists( 'redux_change_option_defaults' ) ):
	function redux_change_option_defaults($defaults){
	    $defaults['str_replace'] = "Testing filter hook!";
	    
	    return $defaults;
	}
	add_filter('redux/options/redux_demo/defaults', 'redux_change_option_defaults');
	// replace redux_demo with your opt_name
endif;

/** 

	Custom function for the callback referenced above

 */
if ( !function_exists( 'redux_my_custom_field' ) ):
	function redux_my_custom_field($field, $value) {
	    print_r($field);
	    print_r($value);
	}
endif;

/**
 
	Custom function for the callback validation referenced above

**/
if ( !function_exists( 'redux_validate_callback_function' ) ):
	function redux_validate_callback_function($field, $value, $existing_value) {
	    $error = false;
	    $value =  'just testing';
	    /*
	    do your validation
	    
	    if(something) {
	        $value = $value;
	    } elseif(something else) {
	        $error = true;
	        $value = $existing_value;
	        $field['msg'] = 'your custom error message';
	    }
	    */
	    
	    $return['value'] = $value;
	    if($error == true) {
	        $return['error'] = $field;
	    }
	    return $return;
	}
endif;
/**

	This is a test function that will let you see when the compiler hook occurs. 
	It only runs if a field	set with compiler=>true is changed.

**/
if ( !function_exists( 'redux_test_compiler' ) ):
	function redux_test_compiler($options, $css) {
		echo "<h1>The compiler hook has run!";
		//print_r($options); //Option values
		print_r($css); //So you can compile the CSS within your own file to cache
	    $filename = dirname(__FILE__) . '/avada' . '.css';

			    global $wp_filesystem;
			    if( empty( $wp_filesystem ) ) {
			        require_once( ABSPATH .'/wp-admin/includes/file.php' );
			        WP_Filesystem();
			    }

			    if( $wp_filesystem ) {
			        $wp_filesystem->put_contents(
			            $filename,
			            $css,
			            FS_CHMOD_FILE // predefined mode settings for WP files
			        );
			    }

	}
	//add_filter('redux/options/redux_demo/compiler', 'redux_test_compiler', 10, 2);
	// replace redux_demo with your opt_name
endif;


/**

	Remove all things related to the Redux Demo mode.

**/
if ( !function_exists( 'redux_remove_demo_options' ) ):
	function redux_remove_demo_options() {
		
		// Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
		if ( class_exists('ReduxFrameworkPlugin') ) {
			remove_filter( 'plugin_row_meta', array( ReduxFrameworkPlugin::get_instance(), 'plugin_meta_demo_mode_link'), null, 2 );
		}

		// Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
		remove_action('admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices' ) );	

	}
	//add_action( 'redux/plugin/hooks', 'redux_remove_demo_options' );	
endif;
