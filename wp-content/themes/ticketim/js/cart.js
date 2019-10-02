jQuery(document).ready(function() {
    
    $('.additional-product-radio').click(function() {
        
        $('.additional-product-radio').each(function () {
            $(this).removeClass('selected');
        });

        $(this).addClass('selected');
    });

})