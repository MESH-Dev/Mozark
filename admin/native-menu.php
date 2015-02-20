<?php

function secret_native_menu($mode=NULL)
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

echo '<nav id="'.$mde_id.'" class="hidden-xs hidden-sm navigation-section secondary-bg '.$mde.'">
  <section class="inner-section">
    <!-- container : starts -->
    <section class="container">
      <div class="row">
        <article class="col-md-12 text-center">';
$defaults = array(
	'theme_location'  => 'native',
	'container'       => 'ul',
	'container_id'    => 'nav',
	'menu_class'      => 'reimenu scrolling-links',
	'menu_id'         => 'nav',
	'echo'            => true,
	'fallback_cb'     => '',
	'items_wrap'      => '<ul id="%1$s" class="desknav %2$s">%3$s</ul>',
	'depth'           => 0,
);
wp_nav_menu($defaults);
?>
            <div class="text-center site-title-pos">
              <a href="<?php echo site_url(); ?>">
                 <?php
                 if($secret_thm['mainlogo']['url'] != ''):
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

<?php
}
?>
