// MAIN.JS
//--------------------------------------------------------------------------------------------------------------------------------
//This is main JS file that contains custom JS scipts and initialization used in this template*/
// -------------------------------------------------------------------------------------------------------------------------------
// Template Name: Secret.
// Author: Unbranded.
// Version 1.0 - Initial Release
// Website: http://www.unbranded.co 
// Copyright: (C) 2014 
// -------------------------------------------------------------------------------------------------------------------------------

/*global $:false */
/*global window: false */

(function(){
  "use strict";

jQuery(document).ready(function($) { 


$(function () {
	
     //Detecting viewpot dimensions
     var vH = $(window).height();
     var vW = $(window).width();

     //Vieport height calculation
     $('.full-height').height(vH);


});
// $(function ($)  : ends







//Directs inner-page menu links to correspond main page section
$(window).load(function(){
        var locationUrl = $(location).attr('href');
        var targetLocation = locationUrl.split('#');
        var targetId = '#'+targetLocation[1];
            $('.main-header li a[href='+targetId+']').trigger('click');
});





	$(document).ready(function() { 
    $(".videopost").fitVids();
    //Map open/close
    // var counter = false;
   
    // $('.map-button').click(function(){

    //   if(counter == false)
    //     {
    //       $(".map").slideDown('slow');
    //       counter = true;
    //     }
    //     else
    //     {
    //       $(".map").slideUp('slow');
    //       counter = false;
    //     }
    //     return false;
    //   });
  



      //Main header position adjustment on scroll
    //     $('#about-us').waypoint(function (event, direction) {
      
    //     if (direction === 'down') 
    //     {
    //         $('.main-header').addClass('solid-bg')            
    //     } 
    //     else 
    //     {
    //        $('.main-header').removeClass('solid-bg')  
    //     }
    // },{ offset: 200 });

    //         $('#portfolio').waypoint(function (event, direction) {
      
    //    (direction === 'down') 
        
    //         $('.main-header').addClass('solid-bg');  

    // },{ offset: 0 }); 

        




        //Home section down-scroll arrow color change
        var index = 0;
           setInterval(highlightBlock, 300); // Every 500 milliseconds

            function highlightBlock() {
                index = (index % 3) + 1; // Next index, cycling
                $('.arrow' + index).css('color', '#8e8e8e'); // Change colour

                 setTimeout(function() {
                     $('.arrow' + index).css('color', 'white'); // Change color back
                }, 150); // After 250 milliseconds
        }



        //Calcutales blog item width and applies to blog item height
        var blogH = $(".blog-item-display").width();
         $(".blog-item-text").css('height', blogH);

            $("iframe",".blog-item-display").height(blogH); 

        

        // Resets Contact-page contact-form 
        $('#contactform').trigger("reset"); //To clear contact form




        // Owl Carousel 

        $(".home-slider").owlCarousel({
            navigation : false,
            navigationText : false,
            pagination : true,
            singleItem: true,
            items : 1,
            itemsDesktop : [1199,1],
            itemsTablet: [768,1],
            itemsMobile : [479,1],

         });
         

          $(".team-slider").owlCarousel({
            navigation : true,
            navigationText : false,
            pagination : false,
            singleItem: false,
            items : 4,
            itemsDesktop: [3000,4],
            itemsDesktopSmall: [1440,4],
            itemsTablet:[1024,3],
            itemsTabletSmall: [640,2],
            itemsMobile: [360,1],

         });



         $(".testimonial-owl").owlCarousel({
            navigation : false,
            navigationText : false,
            pagination : true,
            singleItem: true,
            items : 1,
            itemsDesktop : [1199,1],
            itemsTablet: [768,1],
            itemsMobile : [479,1],

        });



          $(".services-slider").owlCarousel({
            navigation : true,
            navigationText : false,
            pagination : false,
            singleItem: false,
            items : 3,
            itemsDesktop: [3000,3],
            itemsDesktopSmall: [1440,3],
            itemsTablet:[1024,3],
            itemsTabletSmall: [640,2],
            itemsMobile: [360,1],

         });


          $(".blog-slider").owlCarousel({
            navigation : false,
            navigationText : false,
            pagination : true,
            singleItem: true,
            items : 1,
            itemsDesktop : [1199,1],
            itemsTablet: [768,1],
            itemsMobile : [479,1],

        });



          $(".blog-post-slider").owlCarousel({
            navigation : true,
            navigationText : false,
            pagination : true,
            singleItem: true,
            items : 1,
            itemsDesktop : [1199,1],
            itemsTablet: [768,1],
            itemsMobile : [479,1],

        });


        
         $(".single-project-slider").owlCarousel({
            navigation : true,
            navigationText : false,
            pagination : true,
            singleItem: true,
            items : 1,
            itemsDesktop : [1199,1],
            itemsTablet: [768,1],
            itemsMobile : [479,1],

        });
    
             
});

});

})();