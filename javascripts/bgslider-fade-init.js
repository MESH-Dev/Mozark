// BGSLIDER-INIT.JS
//--------------------------------------------------------------------------------------------------------------------------------
//This is  JS file that activates a type of BG Image Slideshow used in this template*/
// -------------------------------------------------------------------------------------------------------------------------------
// Template Name: DIGNITY.
// Author: Designova.
// Website: http://www.designova.net 
// Copyright: (C) 2013 
// -------------------------------------------------------------------------------------------------------------------------------

/*global $:false */
/*global window: false */
jQuery(document).ready(function($) { 
(function(){
  "use strict";

$(function ($) {

    //BG SLIDESHOW WITH ZOOM EFFECT
    $.mbBgndGallery.buildGallery({
                containment:"body",
                timer:4000,
                effTimer:3000,
                controls:false, //updated in v1.1
                grayScale:false,
                shuffle:true,
                preserveWidth:false,
                preserveTop: true,
                effect:"fade",
                images:slides,
                onStart:function(){},
                onPause:function(){},
                onPlay:function(opt){},
                onChange:function(opt,idx){},
                onNext:function(opt){},
                onPrev:function(opt){}
            });


   
});
// $(function ($)  : ends

})();
//  JSHint wrapper $(function ($)  : ends
});