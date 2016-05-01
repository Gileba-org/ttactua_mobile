function moveScroller() {
    var move = function() {
        var st = jQuery(window).scrollTop();
        var ot = jQuery("#sticky-anchor").offset().top;
        var s = jQuery("#sticky");
        if(st > ot) {
            jQuery('#sticky').addClass('stick');
			jQuery('#sticky-anchor').height(jQuery('#sticky').outerHeight());
        } else {
            if(st <= ot) {
                jQuery('#sticky').removeClass('stick');
				jQuery('#sticky-anchor').height(0);
           }
        }
    };
    jQuery(window).scroll(move);
    move();
}