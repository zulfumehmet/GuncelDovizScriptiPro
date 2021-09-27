(function($) {
	
	$.fn.albumPreviews = function() {
		
		return this.each(function(){
			
			var album = $(this),
				loop = null, images = $();
				
			if(!album.data('images')){
				// The data-images attribute is missing. Skip this album.
				return true;
			}
			
			var sources = album.data("images").split('|');
			
			album.on('mouseenter', function(){

				if(!images.length){
					// The images have not been loaded yet
					
					$.each(sources,function(){
						images = images.add('<img src="' + this + '" />');
					});

					// Start the animation after the first photo is loaded
					images.first().load(function() {
						album.trigger('startAnimation');
					});
					
					album
						.append(images)
						.addClass('loading');
				}
				else{
					// Start the animation directly
					album.trigger('startAnimation');
				}

				
			}).on('mouseleave', function(){
				album.trigger('stopAnimation');
			});
			
			
			// Custom events:
			
			album.on('startAnimation',function(){
				
				var iteration = 0;
				
				// Start looping through the photos
				(function animator(){
					
					album.removeClass('loading');

					// Hide the currently visible photo,
					// and show the next one:
					
					album.find('img').filter(function(){
						return ($(this).css('opacity') == 1);
					}).animate({
						'opacity' : 0
					}).nextFirst('img').animate({
						'opacity' : 1
					});

					loop = setTimeout(animator, 1000);	// Once per second

				})();
				
			});
			
			album.on('stopAnimation',function(){
				
				album.removeClass('loading');
				// stop the animation
				clearTimeout(loop);
			});
			
		});

	};
	
	// This jQuery method will return the next
	// element of the specified type, or the
	// first one if it doesn't exist
	
	$.fn.nextFirst = function(e) {
		var next = this.nextAll(e).first(); 
		return (next.length) ? next : this.prevAll(e).last();
	};

})(jQuery);
