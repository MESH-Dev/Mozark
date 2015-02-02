<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<?php   global $secret_thm; ?>
<meta charset="<?php bloginfo('charset'); ?>">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="<?php echo get_bloginfo('description'); ?>"/>
<meta name="keywords" content="<?php bloginfo('categories'); ?>"/>

<?php if(isset($secret_thm['favicon']) AND $secret_thm['favicon']['url'] !='') { ?>
<link rel="shortcut icon" href="<?php echo $secret_thm['favicon']['url'] ; ?>">
<?php } ?>
<!--[if lt IE 9]>
  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<?php 
if(isset($secret_thm['tracking-code']) AND $secret_thm['tracking-code']!=''):
	echo stripslashes($secret_thm['tracking-code']); 
endif;
?>

<?php wp_head();  ?>
</head>

<body <?php body_class(); ?>>

 <?php
 if(!is_page_template('the-onepage.php')):
  if($secret_thm['menu_location'] == 1):	
    secret_center_menu($mode="other");
  else:
    secret_native_menu($mode="other");
  endif;
 endif;
 ?>
<?php secret_custom_mobile_menu(); ?>
<!-- Master Wrap : starts -->
<section id="mastwrap" class="mast-wrap sliding">