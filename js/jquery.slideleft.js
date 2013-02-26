/** jQuery slideLeft
  *  Adds a slide movement from left to right
  *  @author Gabriele Romanato <http://gabrieleromanato.com, http://onwebdev.blogspot.com>
  *  @version 1.0
  *  @license Public
  */

(function($) {

	$.fn.slideLeft = function(options) {
	
		var that = this;
		
		var defaults = {
			speed: 600,
			callback: function() {}
		};
		
		options = $.extend(defaults, options);
		
		var computedWidth = parseInt(that.width());
		var parentWidth = parseInt(that.parent().css('width'));
		
		that.css('width', 0);
	
		
				
		return that.each(function() {
		  
		    if(computedWidth < parentWidth) {
		    
		    	that.css('display', 'block').
		    	animate({
		    		width: computedWidth
		    	}, options.speed, options.callback);
		    
		    
		    } else {
		    
		    	that.css('display', 'block').
		    	animate({
		    		width: parentWidth
		    	}, options.speed, options.callback);
		    
		    }
							
		
		});
		
	
	
	};


})(jQuery);