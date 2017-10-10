var win = jQuery(window);

function moveScroller() {
	var move = function() {
		var stickyAnchor = jQuery("#sticky-anchor");

		if ((win.scrollTop()) > (stickyAnchor.offset().top)) {
			if (win.width() >= 720) {
				jQuery("#sticky").addClass("stick");
				stickyAnchor.height(jQuery("#sticky").outerHeight());
			} else {
				jQuery(".flip-container").addClass("hover");
			}			
		} else {
			if (win.width() >= 720) {
				jQuery("#sticky").removeClass("stick");
					stickyAnchor.height(0);
				} else {
					jQuery(".flip-container").removeClass("hover");					
				}
			}
		};
	win.scroll(move);
	move();
}
