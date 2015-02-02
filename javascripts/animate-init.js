// ANIMATE-INIT.JS
//--------------------------------------------------------------------------------------------------------------------------------
//This is  JS file that activates element animation effects used in this template*/
// -------------------------------------------------------------------------------------------------------------------------------
// Template Name: SECRET.
// Version: 1.0 Initial Release
// Release Date: 19th AUgust 2014
// Author: Unbranded.
// Website: http://www.Unbranded.co 
// Copyright: (C) 2014 
// -------------------------------------------------------------------------------------------------------------------------------

/*global $:false */
/*global window: false */

(function(){
  "use strict";


$(function ($) {

    //ANIMATED ELEMENTS TRIGGERING
    $('.animated').appear(function() {
     $(this).each(function(){ 
        $(this).addClass('activate');
        $(this).addClass($(this).data('fx'));
       });
    },{accY: -150});

   
});
// $(function ($)  : ends

})();
//  JSHint wrapper $(function ($)  : ends







	

