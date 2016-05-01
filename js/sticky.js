function moveScroller() {
    var move = function() {
        var st = jQuery(window).scrollTop();
        var ot = jQuery("#sticky-anchor").offset().top;
        var s = jQuery("#sticky");
        if(st > ot) {
            jQuery('#sticky').addClass('stick');
        } else {
            if(st <= ot) {
                jQuery('#sticky').removeClass('stick');
            }
        }
    };
    jQuery(window).scroll(move);
    move();
}