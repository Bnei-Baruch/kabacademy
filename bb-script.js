jQuery(function ($) {
        /*jQuery('#loginformWarpper').on('click', '.close', function (e) {
         jQuery('#loginformWarpper').hide();
         });
         jQuery('#showLoginForm').on('click', function (e) {
         jQuery('#loginformWarpper').show();
         });*/

function tablednav() {
    if ($('.single-namaste_lesson .column1 .tabs').length > 0) {
        var tabs = $('.single-namaste_lesson .column1 .tabs');
        var tabs_nav = $('.single-namaste_lesson .column1 .tabs-nav');

        if (tabs.outerWidth(true) > tabs_nav.outerWidth(true)) {
            tabs.addClass('tablednav');
        } else if (tabs.outerWidth(true) < tabs_nav.outerWidth(true)) {
            tabs.removeClass('tablednav');
        }

    }
}
$(window).resize(tablednav);
tablednav();
});

jQuery(function ($) {
	$('.pagination').addClass( "no-ajax" );
});



