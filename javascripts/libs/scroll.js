//SMOOTH TOP DOWN SCROLLING
jQuery(document).ready(function($) { 

(function(){
  "use strict";



//Mobile Only Navigation Scroll
function moveTo(contentArea){
            var goPosition = $(contentArea).offset().top;
            $('html,body').animate({ scrollTop: goPosition}, 'slow');
        }


//Desktop Navigation Scroll
$(document).ready(function() {

    $(".scroll-link").click(function() {
    	var ScrollOffset = $(this).attr('data-soffset');
    	//alert(ScrollOffset);
        $("html, body").animate({
            scrollTop: $($(this).attr("href")).offset().top-ScrollOffset + "px"
        }, {
            duration: 1500,
            easing: "swing"
        });
        //$(this).addClass('menuactive');
        return false;
    });

//Highlighter

var page_stack = $.makeArray();
var stack_top = 0;
    $('.page-section').waypoint(function (direction) {
        if (direction === 'down') 
        {
            $('.desknav li a').removeClass('menuactive');
            $('.desknav li a[href=#'+$(this).attr('id')+']').addClass('menuactive'); 
            stack_top = stack_top+1; 
            page_stack[stack_top] = $(this).attr('id');
            
        } 
        else 
        {
            stack_top = stack_top-1;
            $('.desknav li a').removeClass('menuactive');
            $('.desknav li a[href=#'+page_stack[stack_top]+']').addClass('menuactive');
            
        }
    },{ offset: 100 });


});


  })();

});