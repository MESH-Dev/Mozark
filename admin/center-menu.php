<?php
function secret_center_menu($mode=NULL)
{
global $secret_thm;
//onepage , sticky
if($mode != 'onepage'):
  $mde =    "stuck";
  $mde_id = "navigationstuck";
else:  
  $mde =    "";
  $mde_id = "navigation";
endif;

//Fetching the Locations

  $locations = get_nav_menu_locations();
    if(isset( $locations['onepmenu'] )) { $menu = wp_get_nav_menu_object( $locations['onepmenu']); }else { $menu = '';}
  _wp_menu_item_classes_by_context( $menu_items );


?>

<nav id="<?php echo $mde_id; ?>" class="hidden-sm hidden-xs navigation-section  secondary-bg <?php echo $mde; ?>">
  <!-- inner-section : starts -->
  <section class="inner-section">
    <!-- container : starts -->
    <section class="container">
      <div class="row">
        <article class="col-md-12 text-center">
              <nav>
                <ul class="desknav">

<?php
$return = '';
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
                $identifyClass = "scroll-link  is_onepage";
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
        $return .= '<li><a class="'.$identifyClass.'" href="'.$href.'" id="'.$newlink.'-linker" data-soffset="45">'.$men->title.'</a>';
               if(secret_detect_child($i, false) ){
          $return .= secret_detect_child($i, true);
        }
                $return .=  '</li>'."\n";

    }
  }
}
  else
  {
    $return .= '';       
  }

  echo $return;

?>



                </ul>
              </nav>
              <div class="text-center site-title-pos">
              <a href="<?php echo site_url(); ?>">
                 <?php 
                 if(isset($secret_thm['mainlogo']) AND $secret_thm['mainlogo']['url'] != ''):
                  echo '<img class="img-responsive" src="'.$secret_thm['mainlogo']['url'].'" title="'.get_bloginfo('name').'" alt="'.get_bloginfo('name').'">';
                 else:
                  echo get_bloginfo('name'); 
                 endif;
                 ?>
              </a>
              </div>  
        </article>
      </div>
    </section>
    <!-- container : ends -->
  </section>
  <!-- inner-section : ends -->
</nav>
<?php } 




function secret_detect_child($parent, $echo = false){
    
  $parent = ($parent != "") ? $parent : '0';
  $locations = get_nav_menu_locations();
  $menu = wp_get_nav_menu_object( $locations[ 'onepmenu' ] );
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
    $child_ul = '<ul>' . "\n";
    $ret = '';
      foreach ( $menu_next as $i => $mnn ){


          //Specific additions add custom icons
        if( ( 'page' == $mnn->object ))
        {
          $post_finder = get_post($mnn->object_id);
          $page_slug = $post_finder->post_name;                 
          $newlink   = strtolower(preg_replace('/[^a-zA-Z]/s', '', $page_slug)); 
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



        $ret .= '<li><a class="scroll-link '.$identifyClass.'" href="'.$href.'" id="'.$newlink.'-linker" data-soffset="50">'.$mnn->title.'</a></li>' . "\n";
      }
      unset ($menu_next);
    $child_ul_close = '</ul>' . "\n";
    
    if( !empty($ret) )
      return $child_ul . $ret . $child_ul_close;
  }    

  }









?>