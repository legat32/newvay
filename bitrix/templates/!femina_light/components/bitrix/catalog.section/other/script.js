$(document).ready( function() {

	// Sly-галерея
	var $frame = $('#sly-section-centered');
	var $wrap  = $frame.parent();
	$frame.sly({
		horizontal: 1,
		itemNav: 'basic',
		smart: 0,
		activateOn: 'click',
		mouseDragging: 1,
		touchDragging: 1,
		releaseSwing: 1,
		startAt: 0,
		scrollBar: $wrap.parent().find('.scrollbar'),
		scrollBy: 1,
		speed: 600,
		elasticBounds: 1,
		easing: 'easeOutExpo',
		dragHandle: 1,
		dynamicHandle: 1,
		clickBar: 1
		});
			
	});