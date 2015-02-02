<?php


function secret_css_common() 
{
  global $secret_thm;
  //Preloader and BS

    wp_enqueue_style("bootstrap", get_template_directory_uri(). "/bootstrap/css/bootstrap.min.css");
    wp_enqueue_style("bootstrap-thm", get_template_directory_uri(). "/bootstrap/css/bootstrap-theme.min.css");
    //wp_enqueue_style("fontawesome", get_template_directory_uri(). "/stylesheets/fa/css/font-awesome.min.css");
    wp_enqueue_style("fonts", get_template_directory_uri()."/stylesheets/fonts.css");
    wp_enqueue_style("elgant-icon", get_template_directory_uri()."/stylesheets/libs/elegant-iconfont.css");

    wp_enqueue_style("pace", get_template_directory_uri()."/stylesheets/libs/pace-loader.css");
    wp_enqueue_style("owl-car", get_template_directory_uri()."/stylesheets/libs/owl.carousel.css");
    wp_enqueue_style("owl-thm", get_template_directory_uri()."/stylesheets/libs/owl.theme.css");
    wp_enqueue_style("owl-trans", get_template_directory_uri()."/stylesheets/libs/owl.transitions.css");
    wp_enqueue_style("venobox", get_template_directory_uri()."/stylesheets/libs/venobox.css");

  //Google fonts
    wp_enqueue_style("font_s1", "http://fonts.googleapis.com/css?family=Raleway:300,400,700,900");
    wp_enqueue_style("font_s2", "http://fonts.googleapis.com/css?family=Crimson+Text:400,600,700");
    wp_enqueue_style("font_s3", "http://fonts.googleapis.com/css?family=Playfair+Display:400,700,900");
    wp_enqueue_style("font_s4", "http://fonts.googleapis.com/css?family=PT+Sans:400,700");
    wp_enqueue_style("font_s5", "http://fonts.googleapis.com/css?family=Merriweather:400,700");
    wp_enqueue_style("font_s6", "http://fonts.googleapis.com/css?family=EB+Garamond:400");
    wp_enqueue_style("font_awesome", get_template_directory_uri().'/fonts/fa/css/font-awesome.min.css');

    //Main
    wp_enqueue_style("thm-main", get_template_directory_uri(). "/stylesheets/main.css"); 
   
    //Theme Styles
    wp_enqueue_style("style", get_template_directory_uri(). "/style.css");  
    wp_enqueue_style("thm-responsive", get_template_directory_uri(). "/stylesheets/main-responsive.css"); 
    //wp_enqueue_style("thm-retina", get_template_directory_uri(). "/stylesheets/main-retina.css"); 
}

//Less





//Standard Navigation Styles
