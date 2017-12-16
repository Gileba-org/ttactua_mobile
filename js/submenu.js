jQuery(document).ready(function(){
    jQuery(".deeper").prepend('<span class="submenu submenu-closed"> </span>');
    jQuery(".deeper.active span.submenu:first").removeClass("submenu-closed");
    jQuery(".deeper.active span.submenu:first").addClass("submenu-open");
    jQuery(".deeper.active.current span.submenu:first").removeClass("submenu-closed");
    jQuery(".deeper.active.current span.submenu:first").addClass("submenu-open");
});

jQuery(document).on('click', 'span.submenu', function() {
    jQuery(this).toggleClass("submenu-closed");
    jQuery(this).toggleClass("submenu-open");	
});