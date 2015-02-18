(function(){
  "use strict";

jQuery(document).ready(function($) { 

   
$(document).ready(function(){

   if( !device.tablet() && !device.mobile() ) {
 
	$('.animated').appear(function() {
	 $(this).each(function(){ 
	    $(this).css('visibility','visible');
	    $(this).addClass($(this).data('fx'));
	   });
	},{accY: -180});
   
   } //Anim remover
   else
   {
   		$(".animated").removeClass("animated");
   }

});


});
 })(jQuery);
//  JSHint wrapper $(function ($)  : ends  