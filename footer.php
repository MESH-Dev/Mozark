<?php global $secret_thm;  ?>
<?php
if(is_page_template('the-onepage.php'))
 {

    if(isset($secret_thm['map_lattitude']) AND isset($secret_thm['map_longitude']) AND $secret_thm['map_longitude'] != '' AND $secret_thm['map_lattitude'] != ''):
      //Map Options
      wp_enqueue_script('googlesettings');
      wp_enqueue_script('pg-map');
      wp_enqueue_script('pg-mapinit');

    //Finalize it here
      $secret_maplati   = $secret_thm['map_lattitude']; 
      $secret_maplongi  = $secret_thm['map_longitude']; 
      $secret_mapicon   = $secret_thm['map_marker_icon']['url']; 
      $secret_map_array = array('latti' => $secret_maplati,'longi'=>$secret_maplongi,'mmarker'=>$secret_mapicon);
      wp_localize_script('pg-mapinit', 'maphandle', $secret_map_array);  


?>
<section id="map-button" class="bg-color-dark color-light">
    <!-- Inner-section : starts -->
      <section class="map-button inner-section">
          <p><?php echo _e('Locate Us On Map','secretlang'); ?></p>
        </section>
        <div id="map" class="map">
          
      </div>
    <!-- inner-section : ends -->       
</section>
<?php 
    endif;  
  } 
?>
  <section id="footer" class="footer">
        <!-- Inner-section :starts -->
        <section class="inner-section">
          <!-- Container : starts -->
          <div class="container">
            <div class="row">
              <div class="col-md-12">

<?php if(isset($secret_thm['favicon']) AND $secret_thm['mainlogo']['url'] !='') { ?>
         <img src="<?php echo $secret_thm['mainlogo']['url']; ?>" alt="logo">
<?php } ?>                
                <div class="footer-social-icons">

          <?php if(isset($secret_thm['linkedin']) AND $secret_thm['linkedin'] !=''): ?>
          <a target="_blank" href="http://linkedin.com/<?php echo $secret_thm['linkedin']; ?>" target="_blank" class="social-icon"><i class="fa fa-linkedin-square"></i></a>
          <?php endif; ?>
          <?php if(isset($secret_thm['facebook']) AND $secret_thm['facebook'] !=''): ?>          
          <a target="_blank" href="http://facebook.com/<?php echo $secret_thm['facebook']; ?>" target="_blank" class="social-icon"><i class="fa fa-facebook-square"></i></a>
          <?php endif; ?>
          <?php if(isset($secret_thm['gplus']) AND $secret_thm['gplus'] !=''): ?>          
          <a target="_blank" href="http://plus.google.com/<?php echo $secret_thm['gplus']; ?>" target="_blank" class="social-icon"><i class="fa fa-google-plus-square"></i></a>
          <?php endif; ?>
          <?php if(isset($secret_thm['twitter']) AND $secret_thm['twitter'] !=''): ?>          
          <a target="_blank" href="http://twitter.com/<?php echo $secret_thm['twitter']; ?>" target="_blank" class="social-icon"><i class="fa fa-twitter"></i></a>
          <?php endif; ?>
          <?php if(isset($secret_thm['social_custom']) AND $secret_thm['social_custom'] !=''): 
                  echo $secret_thm['social_custom'];
                endif;
          ?>



                  
                </div>
                <p><?php echo $secret_thm['footer_copyright'];?></p>
              </div>  
            </div>
            <a href="#mastwrap" class="to-top scroll-link" data-soffset="0"><img src="<?php echo get_template_directory_uri();?>/images/arrow_top.png" alt="arrow_top"></a>
          </div>
          <!-- Container : ends -->
        </section>
        <!-- Inner-section : ends -->
      </section>


</section>
<!-- ^ Master Wrap : from old one ends -->


<?php


/*----------------------------------------------
--------Video BG------------------------------
------------------------------------------------*/
if(isset($secret_thm['unique_video_id']) AND isset($secret_thm['bg_mode']) AND $secret_thm['unique_video_id'] != '' AND $secret_thm['bg_mode'] == '1' AND is_page_template('the-onepage.php'))
{
     $video_id = $secret_thm['unique_video_id'];
     wp_localize_script('bgvideo-init', 'hdvideo', $video_id); 
}
else
{
    //Remove bst scripts and styles
    wp_dequeue_script("bgvideo");
    wp_dequeue_script("bgvideo-init");
 }


/*----------------------------------------------
--------Animation Management-------------------
------------------------------------------------*/

if(isset($secret_thm['bg_img_slider']) AND $secret_thm['bg_img_slider'] != '' AND is_page_template('the-onepage.php') )
{
  if(isset($secret_thm['bg_mode']) AND $secret_thm['bg_mode'] == '3'):
      $slides  = array();
      foreach($secret_thm['bg_img_slider'] AS $bgsl)
      {
        array_push($slides, $bgsl['image']);
      }
      wp_localize_script('bgnd_init', 'slides', $slides);
  else:
   wp_dequeue_script("bgnd");
   wp_dequeue_script("bgnd_init");
   wp_deregister_script("bgnd");   
   wp_deregister_script("bgnd_init");    
  endif;   
}
else
{
   wp_dequeue_script("bgnd");
   wp_dequeue_script("bgnd_init");
   wp_deregister_script("bgnd");   
   wp_deregister_script("bgnd_init");
}


/*----------------------------------------------
--------Remove Non Used Scripts for OnePage-----
------------------------------------------------*/
if(!is_page_template('the-onepage.php'))
 {

    $theme_singpage = array( 'home_url' => home_url());
    wp_localize_script('issingle', 'singobj', $theme_singpage);

    wp_dequeue_script('waypoints_stick');
    wp_dequeue_script('waypoint-init');

 }
 else
 {
    wp_dequeue_script('issingle');

 }


/*---------------------------------------
--------Animation Management-------------
-----------------------------------------*/

if(!is_page_template('the-onepage.php'))
 {
    wp_dequeue_script('triganim'); 
    wp_dequeue_style('animatecss');  
 }



wp_footer(); 
?> 
</body>
</html>