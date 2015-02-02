// SLIDINGMENU.JS
//--------------------------------------------------------------------------------------------------------------------------------
//JS for operating the sliding menu*/
// -------------------------------------------------------------------------------------------------------------------------------
// Author: Designova.
// Website: http://www.designova.net 
// Copyright: (C) 2013 
// -------------------------------------------------------------------------------------------------------------------------------

/*global $:false */
/*global window: false */

(function(){
  "use strict";
jQuery(document).ready(function($) {
$(function ($) {

// Menu Action
$('#sm-trigger, .revslidemenu-close').on('click', function(){
    $('#sm-trigger').toggleClass('active');
    $('#mastwrap').toggleClass('sliding-toright');
    $('#sm').toggleClass('revslidemenu-open');
    $('#mastwrap').addClass('nav-opened');
});
$('#mastwrap').on('click', function(){
    $('#mastwrap').removeClass('sliding-toright');
    $('#sm').removeClass('revslidemenu-open');
});

});
// $(function ($)  : ends
});

})(jQuery);
//  JSHint wrapper $(function ($)  : ends

