jQuery(document).ready(function() {
    
    $('.category-title-wrapper.result').click(function() {
        
        if($(this).parent().hasClass('closed')) {
            $(this).parent().removeClass('closed');
        } else {
            $(this).parent().addClass('closed');
        }
    })

})