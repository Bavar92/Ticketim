(function () {
    window.addEventListener("load", function () {
        var body = document.getElementsByTagName('body')[0]

        var logos = document.getElementsByClassName('logo')
        var navItems = document.getElementsByClassName('nav-item')
        var subCategories = document.getElementsByClassName('sub-category')
        var mobileSubCategories = document.getElementsByClassName('mobile-sub-category')
        var mobileCategories = document.getElementsByClassName('category-title')
        var bugerButton = document.getElementById('bugerButton')
        var sidemenu = document.getElementById('sidemenu')
        var params = new URLSearchParams(window.location.search)
        var searchForm = document.getElementById('searchForm')
        var excludeSearchForm = ['contact-us', 'main-events-details']
        var filterSortFooter = document.getElementById('filterSortFooter')

        var count = 0;
        window.addEventListener('scroll', function aa(e) {
            // print "false" if direction is down and "true" if up
            if (this.oldScroll > this.scrollY) {
                document.getElementById('mobileHeader').style.top = '0'

                if (filterSortFooter) {
                    filterSortFooter.style.bottom = '0'
                }

                count = 0
            } else {
                if (count > 40) {
                    document.getElementById('mobileHeader').style.top = '-200px'
                    if (filterSortFooter) {

                        filterSortFooter.style.bottom = '-200px'
                    }
                } else {
                    count++
                }
            }
            this.oldScroll = this.scrollY;
        })

        for (let i = 0; i < excludeSearchForm.length; i++) {
            const page = excludeSearchForm[i];

            if (location.pathname.indexOf(page) !== -1) {
                searchForm.style.display = 'none'
            }
        }

        if (window.innerWidth < 768 && location.pathname.indexOf('home') === -1) {
            searchForm.style.display = 'none'
            document.getElementById('mobileLogo').style.display = 'none'
            document.getElementById('headerSearchButton').style.display = 'block'
            document.getElementById('close-header-form').addEventListener('click', function () {
                var mobileSearchForm = document.getElementById('headerSearchForm')
                mobileSearchForm.style.transform = 'translateY(-1200%)'
            })
            document.getElementById('headerSearchButton').addEventListener('click', function () {
                var mobileSearchForm = document.getElementById('headerSearchForm')
                mobileSearchForm.style.transform = 'translateY(120%) translateX(-50%)'
                mobileSearchForm.style.maxHeight = 'unset'
                mobileSearchForm.style.height = '300px'
                mobileSearchForm.paddingTop = '10px'

            })
        } else {
            document.getElementById('mobileLogo').style.display = 'block'
            document.getElementById('headerSearchButton').style.display = 'none'
            document.getElementById('headerSearchForm').style.display = 'none'
        }


        for (let i = 0; i < logos.length; i++) {

            logos[i].addEventListener('click', function () {
                location.href = 'pages/home/content.php'
            });
        }

        for (var i = 0; i < navItems.length; i++) {

            if ((params.get('category') !== null && Number(params.get('category'))) === i) {
                navItems[i].style.borderBottom = '4px solid #00aeef'
                // 16px the current padding and minus 4px for the border
                navItems[i].style.paddingBottom = '16px'
            }
        }

        for (var i = 0; i < subCategories.length; i++) {

            // so we don't confuse between null and 0
            if ((params.get('sub_category') !== null && Number(params.get('sub_category'))) === i) {
                subCategories[i].style.color = 'black'
                subCategories[i].style.fontWeight = 'bold'
            }
        }

        bugerButton.addEventListener('click', function () {
            sidemenu.style.transform = 'translateX(0)'
            body.style.overflow = 'hidden';
        })

        sidemenu.addEventListener('click', function () {
            sidemenu.style.transform = 'translateX(100vw)'
            body.style.overflow = 'auto';
        })

        // change so you get the sub category from the dataset and not the index
        for (var i = 0; i < mobileCategories.length; i++) {
            var subCount = 0

            for (var j = 0; j < mobileSubCategories.length; j++) {
                if (Number(mobileSubCategories[j].dataset.category) === i) {
                    subCount++;
                    mobileSubCategories[j].addEventListener('click', function (e) {
                        if (e.target.dataset.category === 0) {
                            location.href = 'pages/home/sales.php?' + 'sub_category=' + e.target.dataset.sub

                        } else if (e.target.dataset.category === 3) {
                            location.href = 'pages/home/attractions.php?' + 'sub_category=' + e.target.dataset.sub
                        } else {
                            location.href = 'pages/home/content.php?category=' + e.target.dataset.category + '&sub_category=' + e.target.dataset.sub
                        }
                    })
                }

                // check which sub category is currently selected and highlight it in the menu
                if (
                    (params.get('sub_category') !== null && Number(params.get('sub_category'))) === j &&
                    (params.get('category') !== null && Number(params.get('category'))) === i
                ) {

                    mobileSubCategories[j].style.backgroundColor = 'white'
                }
            }

            mobileCategories[i].addEventListener('click', function (e) {
                e.stopPropagation();

                if (e.path[2].style.maxHeight.split('px')[0] > 30) {
                    e.path[2].style.maxHeight = '30px'
                    e.target.style.color = '#333333'
                    e.path[1].childNodes[3].style.display = 'none'

                } else {
                    // 55px for each sub-category
                    e.path[2].style.maxHeight = subCount * 55 + 30 + 'px'
                    e.target.style.color = '#00aeef'
                    e.path[1].childNodes[3].style.display = 'block'
                }

            }, false);
        }



        flatpickr(document.getElementById('date-input'), {
            mode: 'range',
            locale: 'he',
            onChange: function (selectedDates, dateStr, instance) {

                // if he only chose 1 day
                if (selectedDates.length === 1) {
                    document.getElementById('date-input').textContent = new Date(selectedDates[0]).toISOString().split('T')[0]
                    // if he chose a range of days 
                } else if (selectedDates.length === 2) {
                    document.getElementById('date-input').textContent = new Date(selectedDates[0]).toISOString().split('T')[0] + ' - ' + new Date(selectedDates[1]).toISOString().split('T')[0]

                }
            },
        })

        var extendForm = document.getElementById('extend-form')
        var closeForm = document.getElementById('close-form')

        if(extendForm) {
            extendForm.addEventListener('click', function (e) {
                e.path[2].style.bottom = '-270px'
                e.path[2].style.maxHeight = '300px'
                e.path[2].style.height = '300px'
                e.target.style.display = 'none'
            })
        }

        if(closeForm) {
            closeForm.addEventListener('click', function (e) {
                e.path[2].style.bottom = '-25px'
                e.path[2].style.maxHeight = '50px'
                setTimeout(function () {
                    extendForm.style.display = 'block'
                }, 300)
            })
        }

        function filterCountryCity(string) {

            var newArr = [];

            if(string = '') {
                return newArr;
            }
        
            for(var i in countryCityList) {
        
                if(countryCityList[i].name.indexOf(string) > -1) {
                    newArr.push(countryCityList[i]);
                }
            }
        
            return newArr;
        }

        jQuery('#search-bar-location').keyup(function() {
            
            var string = $(this).val();

            var list = filterCountryCity(string);

            $('#countries-autocomplete-container').html();

            for(var i in list) {
                $('#countries-autocomplete-container').append('<li>' + list[i].name + '</li>');
            }

            $('#countries-autocomplete-container').css('display', 'block');
        });

        jQuery('#search-bar-location').blur(function() {
            
            $('#countries-autocomplete-container').css('display', 'none');
        });

        function filterArtists(string) {

            var newArr = [];

            if(string = '') {
                return newArr;
            }
        
            for(var i in artistsList) {
        
                if(artistsList[i].name.indexOf(string) > -1) {
                    newArr.push(artistsList[i]);
                }
            }
        
            return newArr;
        }

        jQuery('#search-bar-artist').keyup(function() {
            
            var string = $(this).val();

            var list = filterArtists(string);

            $('#artists-autocomplete-container').html();

            for(var i in list) {
                $('#artists-autocomplete-container').append('<li>' + list[i].name + '</li>');
            }

            $('#artists-autocomplete-container').css('display', 'block');
        });

        jQuery('#search-bar-location').blur(function() {
            
            $('#artists-autocomplete-container').css('display', 'none');
        });

        // edit before this line
    })


})();