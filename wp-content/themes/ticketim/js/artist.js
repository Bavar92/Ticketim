jQuery(document).ready(function() {

   jQuery('.category-title-wrapper').click(function() {

      var artist   = $(this).attr('data-artist');
      var location = $(this).attr('data-location');
      $('.artist-events-container').css('top', 100);

      $('.artist-events-container').empty();

      jQuery.ajax({
         type : "post",
         dataType : "json",
         url : myAjax.ajax_url,
         data : { action: 'get_products_by_artist_and_location', artist: artist, location: location },
         success: function(response) {
            
            for(var i in response) {
               $('.artist-events-container').append('<a href="#">'+
                  '<div class="artist-event-wrapper">' + 
                     '<div class="artist-event-title">' + response[i].name + '</div>' +
                     '<div class="artist-event-price">' +
                        '<span class="price-prefix">החל מ-</span>' +
                        '<span class="price-text">' + response[i].price + '</span>' +
                     '</div>' +
                  '</div>' +
               '</a>');
            }

         }
      })  
   })

});