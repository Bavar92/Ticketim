jQuery(document).ready(function() {
    
    $('.category-title-wrapper.live').click(function() {
        
        var elements = $(this).parent().children();
        for(var i = 0; i < elements.length; i++) {
            $(elements[i]).removeClass('selected');
        }

        $(this).addClass('selected');
        $('.bottom-cart-strip .left-side .price-container .price').html($(this).attr('data-price'));
        $('.bottom-cart-strip .left-side .price-container .description').html($(this).attr('data-title'));

        currentVariation.variation_id = $(this).attr('data-variation');
    });

    $('#strip-add-to-cart').click(function() {
        
        jQuery.ajax({
            type : "post",
            dataType : "json",
            url : myAjax.ajax_url,
            data : { action: 'add_product_to_cart', product_id: currentVariation.product_id, quantity: currentVariation.quantity, variation_id: currentVariation.variation_id },
            success: function(response) {
               console.log(response);
            }
         })  
    });

})