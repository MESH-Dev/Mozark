// BGSLIDER-INIT.JS
//--------------------------------------------------------------------------------------------------------------------------------
//This is  JS file that activates a type of BG Image Slideshow used in this template*/
// -------------------------------------------------------------------------------------------------------------------------------
// Template Name: SECRET.
// Author: Unbranded.
// Website: http://www.Unbranded.co
// Copyright: (C) 2014
// -------------------------------------------------------------------------------------------------------------------------------

/*global $:false */
/*global window: false */

$(window).load(function(){
    
    //BG SLIDESHOW WITH ZOOM EFFECT
    $.mbBgndGallery.buildGallery({
                containment:"body",
                timer:1000,
                effTimer:8000,
                controls:"#controls",
                grayScale:false,
                shuffle:true,
                preserveWidth:false,
                preserveTop: true,
                effect:{enter:{left:0,opacity:0},exit:{left:0,opacity:0}, enterTiming:"ease-in", exitTiming:"ease-in"},
    //effect:{enter:{transform:"scale("+(1+ Math.random()*2)+")",opacity:0},exit:{transform:"scale("+(Math.random()*2)+")",opacity:0}},

                // If your server allow directory listing you can use:
                // (however this doesn't work locally on your computer)

                //folderPath:"testImage/",

                // else:

                 images:[
                 "images/home/home-slider-img1.jpg",
                 "images/home/home-slider-img2.jpg",
                 "images/home/home-slider-img3.jpg",
                 "images/home/home-slider-img4.jpg",
                 ],

                onStart:function(){},
                onPause:function(){},
                onPlay:function(opt){},
                onChange:function(opt,idx){},
                onNext:function(opt){},
                onPrev:function(opt){}
            });


   
});








    

