(function($) {
	'use strict';
	
	var loadingDone = function() {
		if($('loading-wrapper').length > 0) {
			$('body').addClass('overflow-hidden')
		}
		
		$('.loader-effect').addClass('loading-close')
		                   .on('transitionend webkitTransitionEnd oTransitionEnd otransitionend MSTransitionEnd', function(event) {
			                   if(event.eventPhase === 2) {
				                   $('.loading-wrapper').fadeOut(500,
					                   function() {
						                   $('body').removeClass('overflow-hidden');
					                   });
			                   }
		                   });
	};
	
	$(window).on('load', function() {
		loadingDone();
	});
})(jQuery);