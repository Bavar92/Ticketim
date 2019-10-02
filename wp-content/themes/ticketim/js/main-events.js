(function () {
    window.addEventListener("load", function () {

        var body = document.getElementsByTagName('body')[0]

        var filterButton = document.getElementById('filterButton')
        var filterIcon = document.getElementById('filterIcon')
        var filterText = document.getElementById('filterText')
        var filterSidemenu = document.getElementById('filterSidemenu')
        var filterCategories = document.getElementsByClassName('filter-category-title')
        var filterSubCategories = document.getElementsByClassName('filter-sub-category')
        var sortButton = document.getElementById('sortButton')
        var sortIcon = document.getElementById('sortIcon')
        var sortText = document.getElementById('sortText')
        var sortSidemenu = document.getElementById('sortSidemenu')
        var sortCategories = document.getElementsByClassName('sort-category')

        if(filterButton) {
            filterButton.addEventListener('click', function () {
                filterIcon.src = 'assets/filter-blue.svg'
                filterText.style.color = '#00aeef'
                filterSidemenu.style.transform = 'translateX(0)'
                body.style.overflow = 'hidden';
            })
        }

        filterSidemenu.addEventListener('click', function () {
            filterSidemenu.style.transform = 'translateX(100vw)'
            body.style.overflow = 'auto';
        });

        for (let i = 0; i < filterCategories.length; i++) {
            var count = 0;

            for (var j = 0; j < filterSubCategories.length; j++) {
                if (Number(filterSubCategories[j].dataset.category) === i) {
                    count++;

                    // you should probably add an event listener here which every time is clicked
                    // it adds a key or an entry to an object
                    // just like a react state
                    // and then when someone clicks confirm to filter
                    // just send that object to the server or something ?
                    // oh you also need e.stopPropagation(); in the event listener
                    filterSubCategories[j].addEventListener('click', function (e) {
                        e.stopPropagation()

                        if (e.path[0].children[0].src.indexOf('assets/eye-grey.svg') !== -1) {
                            e.path[0].children[0].src = 'assets/eye-blue.svg'
                            e.path[0].style.backgroundColor = '#ebebeb'
                        } else {
                            e.path[0].children[0].src = 'assets/eye-grey.svg'
                            e.path[0].style.backgroundColor = 'white'

                        }
                    })
                }

                // check which sub category is currently selected and highlight it in the menu
                // if (
                //     (params.get('sub_category') !== null && Number(params.get('sub_category'))) === j &&
                //     (params.get('category') !== null && Number(params.get('category'))) === i
                // ) {

                //     mobileSubCategories[j].style.backgroundColor = 'white'
                // }
            }


            filterCategories[i].addEventListener('click', function (e) {
                e.stopPropagation();

                if (e.path[2].style.minHeight.split('px')[0] > 30) {
                    e.path[2].style.minHeight = '30px'
                    e.target.style.color = '#333333'
                    e.path[1].childNodes[3].style.display = 'none'

                } else {
                    // 55px for each sub-category
                    e.path[2].style.minHeight = count * 55 + 30 + 'px'
                    e.target.style.color = '#00aeef'
                    e.path[1].childNodes[3].style.display = 'block'
                }
            }, false)

        }


        sortButton.addEventListener('click', function () {
            sortIcon.src = 'assets/sort-blue.svg'
            sortText.style.color = '#00aeef'
            sortSidemenu.style.transform = 'translateX(0)'
            body.style.overflow = 'hidden';
        })

        sortSidemenu.addEventListener('click', function () {
            sortSidemenu.style.transform = 'translateX(100vw)'
            body.style.overflow = 'auto';
        })

        document.getElementById('sortInputContainer').addEventListener('click', function (e) {
            e.stopPropagation()
        })

        for (let i = 0; i < sortCategories.length; i++) {
            const element = sortCategories[i];

            sortCategories[i].addEventListener('click', function (e) {
                e.stopPropagation()
            })

        }

        flatpickr(document.getElementById('sort-date-input'), {
            mode: 'range',
            locale: 'he',
            onChange: function (selectedDates, dateStr, instance) {

                // if he only chose 1 day
                if (selectedDates.length === 1) {
                    document.getElementById('sort-date-input').textContent = new Date(selectedDates[0]).toISOString().split('T')[0]
                    // if he chose a range of days
                } else if (selectedDates.length === 2) {
                    document.getElementById('sort-date-input').textContent = new Date(selectedDates[0]).toISOString().split('T')[0] + ' - ' + new Date(selectedDates[1]).toISOString().split('T')[0]

                }
            },
        })

        // edit before this line
    })


})();