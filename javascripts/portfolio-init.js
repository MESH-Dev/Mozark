(function(){
  "use strict";
//VIEWPORT DETECTION:


jQuery(document).ready(function($) { 
 $(document).ready(function() {

/*-----------------------------------------------------
Shuffle Grid
-------------------------------------------------------*/
			/* initialize shuffle plugin */
			var $grid = $('#grid');
			$grid.shuffle({
				itemSelector: '.shuf-item' // the selector for the items in the grid
			});

			/* reshuffle when user clicks a filter item */
			$('#filter li a').click(function (e) {
				e.preventDefault();
				// set active class
				$('#filter li a').removeClass('active');
				$(this).addClass('active');
				// get group name from clicked item
				var groupName = $(this).attr('data-group');
				// reshuffle grid
				$grid.shuffle('shuffle', groupName );
			});


	});
});

})();