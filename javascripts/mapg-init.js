(function(){
  "use strict";

jQuery(document).ready(function($) { 





//Pre Init

     function mapInit()
     {

              $("#map").gMap({
            controls: {
                        panControl: true,
                        zoomControl: true,
                        mapTypeControl: true,
                        scaleControl: false,
                        streetViewControl: true,
                        overviewMapControl: false
                    },
                scrollwheel: false,
                // maptype: 'HYBRID',
                markers: [
                    {
                        latitude: maphandle.latti,
                        longitude: maphandle.longi,
                        icon: {
                            image: maphandle.mmarker,
                            iconsize: [154, 75],
                            iconanchor: [154,75]
                        }            
                    }
                ],    
                zoom: 18
              });


     }

// google.maps.event.addDomListener(window, "resize", function() {
//  var center = map.getCenter();
//  google.maps.event.trigger(map, "resize");
//  map.setCenter(center); 
// });

/*-----------------------------------------------------
Google Map
------------------------------------------------------*/

$(function ($) {
/*---------------------------------------
Toggle Section
------------------------------------------*/
//$(".map").hide();
var first = 0;
//Toggles
$(".map-button").click(function (e) {
         e.preventDefault();
         $(this).next(".map").slideToggle("slow");
         $("html, body").animate({
            scrollTop: $('.map-button').offset().top-20 + "px"
        }, {
            duration: 500,
            easing: "swing"
        }); 

         first++;
         if(first == 1)
          {
               mapInit()
          }
          



});






});
// $(function ($)  : ends
});
})();
//  JSHint wrapper $(function ($)  : ends