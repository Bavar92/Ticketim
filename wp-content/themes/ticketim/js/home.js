(function () {
    window.addEventListener("load", function () {
        var cubeFaces = document.getElementsByClassName('cube-category')

        for (var i = 0; i < cubeFaces.length; i++) {
            var cubeFace = cubeFaces[i];

            cubeFace.addEventListener('click', function (e) {
                location.href = 'pages/home/content.php?category=' + e.target.dataset.category
            })
        }

        // edit before this line
    })


})();