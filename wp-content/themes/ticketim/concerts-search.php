<?php
/**
 * @package Ticketim
 * @subpackage Ticketim
 * @since 1.0.0
 * Template Name: Concerts Search
 */


get_header(); 

function build_search_events($events)
{

    foreach ($events as $key => $value) {
        echo '<div class="search-event-wrapper">';
        echo '<img src="assets/placeholder-image.jpg" class="search-event-image" /> ';
        echo '<div class="search-event-details-container">';
        echo '<h1 class="search-event-title">דיוויד גארט</h1>';
        echo '<div class="search-event-location-container">';
        echo '<img src="assets/location-blue.svg" class="search-event-location-icon" />';
        echo '<span class="search-event-location">שטוקהולם</span>';
        echo '</div>';
        echo '</div>';
        echo '<img src="assets/location-blue.svg" class="search-event-type-icon" />';
        echo '</div>';
    }
}

$artists = getArtists();

$searchBarBanner   = get_field('concerts_top_banner')['url'];
$searchBarTitle    = get_field('concerts_top_banner_title');
$searchBarSubtitle = get_field('concerts_top_banner_subtitle');
$bottomBannerLink  = get_field('live_bottom_banner_link');
$bottomBannerImage = get_field('live_bottom_banner')['image'];
$bannerSize        = 'small';

include('search-bar.php');
?>

<div class="desktop">
    <div class="search-container">
        <form class="search-form" action="">
            <h1 class="search-form-title">סנן אופן תצוגה בעמוד</h1>
            <div class="categories-checkboxes-wrapper">
                <div class="search-category">
                    <label class="checkbox-container">
                        <input type="checkbox" name="" id="searchSports" class="checkbox">
                        <span class="checkmark"></span>
                    </label>
                    <label for="searchSports" class="search-category-title">ספורט</label>
                </div>
                <div class="search-category">
                    <label class="checkbox-container">
                        <input type="checkbox" name="" id="searchConcerts" class="checkbox">
                        <span class="checkmark"></span>
                    </label>
                    <label for="searchConcerts" class="search-category-title">הופעות</label>
                </div>
                <div class="search-category">
                    <label class="checkbox-container">
                        <input type="checkbox" name="" id="searchAttractions" class="checkbox">
                        <span class="checkmark"></span>
                    </label>
                    <label for="searchAttractions" class="search-category-title">אטרקציות/ מחוזות זמר</label>
                </div>
                <div class="search-category">
                    <label class="checkbox-container">
                        <input type="checkbox" name="" id="searchFestivals" class="checkbox">
                        <span class="checkmark"></span>
                    </label>
                    <label for="searchFestivals" class="search-category-title">פסטיבלים</label>
                </div>
            </div>
            <div class="input-container">
                <div class="icon-input">
                    <input type="text" name="" class="text-input" placeholder="עיר/מדינה">
                    <img src="assets/location-blue.svg" class="icon" alt="">
                </div>
                <!-- https://flatpickr.js.org/examples/#range-calendar -->
                <div class="icon-input">
                    <div id="desktop-search-date-input" class="date-picker">תאריך</div>
                    <img src="assets/calendar-blue.svg" class="icon" alt="">
                </div>
            </div>
            <div class="search-category-container">
                <div class="search-category-select closed">
                    <div class="category-title-wrapper">
                        <h1 class="filter-category-title">הופעות</h1>
                        <img src="assets/black-left-arrow.svg" class="down-arrow" alt="">
                    </div>
                    <ul class="search-sub-categories-list">
                    <?php foreach ($artists as $artist) :?>
                        <li class="search-sub-category" data-sub="" data-category="">
                            <img src="assets/eye-blue.svg" class="filter-sub-category-icon" />
                            <?=$artist['name']?>
                        </li>
                    <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </form>
        <div class="search-events-container">

        </div>
    </div>
</div>

<?php

function sliders($events)
{

    foreach ($events as $key => $event) {
        echo '<div class="event-card">
            <div class="event-card-image-container">
                <img class="event-card-image" src="assets/placeholder-image.jpg" alt="">
                <div class="icon-contianer">
                    <img src="assets/view-icon.svg" alt="" class="icon">
                    <span class="view-count">120</span>
                </div>
            </div>
            <div class="event-card-details-container">
                <div class="right-column">
                    <h2 class="event-title">שם של מופע</h2>
                    <p class="event-sub-title">טיסה + 3 לילות במלון 4* + כרטיס </p>
                    <span class="event-date">מתאריך: 06/06/2019 עד 09/06/2019</span>

                </div>
                <div class="left-column">
                    <span class="starting-price">החל מ-</span>
                    <span class="price">586 €</span>
                </div>
            </div>
        </div>';
    }
}
?>

<div class="banner">
    <a href="<?=$bottomBannerLink ?>">
        <img src="<?=$bottomBannerImage?>" class="banner-image" alt="">
        <!--span class="banner-title">הוא פשוט טקסט גולמי</span>
        <span class="banner-caption">12/11/2019</span-->
    </a>
</div>

<div class="desktop">
    <div class="slider-container">
        <h1 class="slider-container-title">חבילות או אירועים שמשתמשים צפו לאחרונה</h1>
        <div class="glider-wrapper">
            <div class="glider">
                <?php sliders([1, 2, 3, 4, 5]) ?>
            </div>
            <button class="glider-next"><img class="arrow-next" src="assets/arrow.png" alt=""></button>
            <button class="glider-prev"><img class="arrow-prev" src="assets/arrow.png" alt=""></button>
        </div>
    </div>
</div>

<div class="mobile">
    <div class="mobile-event-cards">
        <h1 class="mobile-event-cards-title">חבילות או אירועים
            שמשתמשים צפו לאחרונה</h1>
        <?php sliders([1, 2, 3, 4, 5]) ?>
    </div>
</div>
<script type="application/javascript" src="js/bottom-slider.js"></script>


<?php get_footer(); ?>