

if($('body').hasClass('home')) {
    (function () {
        window.addEventListener("load", function () {

            new Glider(document.querySelector('.glider'), {
                slidesToShow: 3,
                slidesToScroll: 1,
                arrows: {
                    prev: '.glider-prev',
                    next: '.glider-next'
                },
            })


            // edit before this line
        })


    })();
}