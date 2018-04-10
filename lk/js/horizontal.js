jQuery(function($){
	'use strict';

	// -------------------------------------------------------------
	//   Force Centered Navigation
	// -------------------------------------------------------------
	
(function () {
		
var $frame = $('#forcecentered');
		
var $wrap  = $frame.parent();

		// Call Sly on frame

var sly = new Sly($frame, {
			
horizontal: 1,
			
itemNav: 'forceCentered',

smart: 1,

activateMiddle: 1,
			
activateOn: 'click',
			
mouseDragging: 1,
			
touchDragging: 1,
			
releaseSwing: 1,
			
startAt: 3,
			
scrollBar: $wrap.find('.scrollbar'),
			
scrollBy: 0,
		
speed: 300,
			
elasticBounds: 1,
			
easing: 'easeOutExpo',
			
dragHandle: 1,
			
dynamicHandle: 1,
			
clickBar: 1,


cycleBy: '',//items
cycleInterval: 5000,			
// Buttons
			
prev: $wrap.find('.prev'),
			
next: $wrap.find('.next')

	}, 
{
load: function () {
	var wid =$('ul.clearfix').width() + 256;
	$('ul.clearfix').width(wid);
},
change: function() {
var t = this.rel; 
var cou = this.items.length-1;
	if (0 == t.activeItem) {		
		this.activate(cou-1);	
	} else if (cou == t.activeItem) {
		this.activate(1);		
	}
}
}).init();	
$(window).resize(function(e) {
      sly.reload();
});	
	}());

	
});



