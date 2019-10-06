$ = jQuery;
$(document).ready(function () {







    var tabi = $('.image-mini .image');
    tabi.click(function() {
        tabi.removeClass('active');
        $(this).addClass('active');
        $('.image-big .image').hide().eq($(this).index()).fadeIn(500);
    });
    tabi.eq(0).click();

});