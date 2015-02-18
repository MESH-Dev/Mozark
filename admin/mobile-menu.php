<?php
global $secret_thm;

/*---------------------------------------
---------Customised Menu-----------------
-----------------------------------------*/
function secret_custom_mobile_menu($title = NULL,$onep = 0)
{
	$locations = get_nav_menu_locations();
	
    if(isset( $locations['onepmenu'] )) { $menu = wp_get_nav_menu_object( $locations['onepmenu']); }else { $menu = '';}
	_wp_menu_item_classes_by_context( $menu_items );

$return = '
<nav class="revslidemenu visible-sm visible-xs" id="sm">
  <div class="sm-wrap">';
if(isset($secret_thm['mainlogo'])):
    $return .= '<div id="logo" class="text-center">';
  	$return .= '<img title="" alt="'.get_bloginfo('name').'"  src="'.$secret_thm['mainlogo']['url'].'"/>';
  	$return .= '</div>';
endif;  	


$return .= '
    <i class="icon-remove revslidemenu-close"></i>';




if($menu != '')
	{
	$menu_items = wp_get_nav_menu_items($menu->term_id);		

	$menunu = array();
	foreach((array)$menu_items as $key => $menu_item )
	{
		$menunu[ (int) $menu_item->db_id ] = $menu_item;
	}
	unset($menu_items);

	foreach ($menunu as $i => $men ){
		if($men->menu_item_parent == '0')
		{
      $post_finder = get_post($men->object_id);
      $page_slug = $post_finder->post_name;
      $newlink   = strtolower(preg_replace('/[^a-zA-Z]/s', '', $page_slug)); 
            //Other menu items
			    //Specific additions add custom icons
				if( ( 'page' == $men->object ))
				{
					$href =  '#'.$newlink;				
                    $incl_onepage = get_post_meta($men->object_id,'secret_include_onepage',true );
                    if($incl_onepage == 'on')
                    {
						$href =  '#'.$newlink;
						$identifyClass = "is_onepage";
				    }
				    else
				    {
                       $href = $men->url;
                       $identifyClass = "not_onepage";
				    }	
				} 
				else 
				{
					$href =  $men->url;
					$identifyClass = "not_onepage";

				}
				$return .= '<a class="scroll-link '.$identifyClass.'" href="'.$href.'" id="'.$newlink.'-linker" data-soffset="60">'.$men->title.'</a>';
			    $return .=  "\n";
                if(secret_side_detect_child($i, false) ){
					$return .= secret_side_detect_child($i, true);
				}			    
		}
	}
}
	else
	{
 	  $return .= '<a id="defaultam-linker" title="Configure Menu" href="'.site_url().'/wp-admin/nav-menus.php">Configure Menu</a>';       
	}

	unset($menunu);	
	$return .= '</div>
  <!-- Navigation Trigger Button -->
  <div id="sm-trigger"></div>
</nav>
<!-- Sliding Navigation : ends -->' . "\n";

	echo $return;
}


/**/
function secret_side_detect_child($parent, $echo = false){
		
    $parent = ($parent != "") ? $parent : '0';

    $locations = get_nav_menu_locations();
	$menu = wp_get_nav_menu_object( $locations['onepmenu'] );
	$menu_items = wp_get_nav_menu_items( $menu->term_id );
	
	_wp_menu_item_classes_by_context( $menu_items );
	
	$menu_next = array();
	foreach( (array) $menu_items as $key => $menu_item ){
		if($menu_item->menu_item_parent == $parent)
			$menu_next[ (int) $menu_item->db_id ] = $menu_item;
	}
	unset ($menu_items);
	
	if( !$echo ){
		if( !empty($menu_next) )
			return true;
		else
			return false;
	} else {
		$child_ul = '' . "\n";
		$ret = '';
			foreach ( $menu_next as $i => $mnn ){

          $post_finder = get_post($mnn->object_id);
          $page_slug = $post_finder->post_name;                 
          $newlink   = strtolower(preg_replace('/[^a-zA-Z]/s', '', $page_slug)); 
			    //Specific additions add custom icons
				if( ( 'page' == $mnn->object ))
				{
					$href =  '#'.$newlink;				
                    $incl_onepage = get_post_meta($mnn->object_id,'secret_include_onepage',true );
                    if($incl_onepage == 'on')
                    {
						$href =  '#'.$newlink;
						$identifyClass = "is_onepage";
				    }
				    else
				    {
                       $href = $mnn->url;
                       $identifyClass = "not_onepage";
				    }	


				} 
				else 
				{
					$href =  $mnn->url;
					$identifyClass = "not_onepage";

				}


                $ret .= '<a class="'.$identifyClass.'" href="'.$href.'" id="p'.$newlink.'-linker" data-soffset="60">-'.$mnn->title.'</a>'. "\n";
				
			}
			unset ($menu_next);
		$child_ul_close = '' . "\n";
		
		if( !empty($ret) )
			return $child_ul . $ret . $child_ul_close;
	}    

	}