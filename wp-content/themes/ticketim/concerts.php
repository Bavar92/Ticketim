<?php
/**
 * @package Ticketim
 * @subpackage Ticketim
 * @since 1.0.0
 * Template Name: Concerts
 */


get_header(); 

$artists = getArtists();

$packages = [];
foreach($artists as $artist) {
    
    $firstShow = getArtistSingleShow($artist['code'], true);
    $lastShow  = getArtistSingleShow($artist['code'], false);

    $packages[] = [
        'title'    => $package->post_title,
        'artist'   => $artist['name'],
        'image'    => $artist['image']['url'],
        'package'  => $package->ID,
        'from'     => $firstShow->meta['from_date'][0],
        'to'       => $lastShow->meta['to_date'][0],
    ];
}

function build_filter_sub_categories($sub_categories, $main_category_id)
{
    echo '<ul class="mobile-sub-categories-list">';

    foreach ($sub_categories as $key => $sub) {
        echo '<li class="filter-sub-category" data-sub="' . $key . '" data-category="' . $main_category_id . '"><img src="assets/eye-blue.svg" class="filter-sub-category-icon" />'  . $sub . '</li>' . "\n";
    }

    echo '</ul>';
}

$searchBarBanner   = get_field('concerts_top_banner')['url'];
$searchBarTitle    = get_field('concerts_top_banner_title');
$searchBarSubtitle = get_field('concerts_top_banner_subtitle');
$bannerSize        = 'small';

include('search-bar.php');

?>

<div class="desktop">
    <div class="main-content-images">
    <?php 
        $banners = getConcertsBanners();

        foreach($banners as $key => $banner): 
            if($key == 6) {
                break;
            }
        ?>
        <div class="flip-card">
            <div class="card">
                <div class="card-front">
                    <img class="content-image" src="<?=$banner['image']['url'] ?>" alt="<?=$banner['title'] ?>">
                </div>
                <div class="card-back">
                    <h1 class="back-title"><?=$banner['title'] ?></h1>
                    <p class="back-caption"><?=$banner['subtitle'] ?></p>
                    <p class="back-description"><?=$banner['description'] ?></p>
                    <p class="back-date"><?=$banner['from_date'] ?> - <?=$banner['to_date'] ?></p>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<div class="main-events">
    <div class="desktop-order">
        <?php 
            foreach($packages as $package): ?>
            <div class="event-card">
                <div class="event-card-image-container">
                    <a href="/artist/?artist=<?=$package['artist']?>">
                        <img class="event-card-image" src="<?=$package['image']?>" alt="">
                    </a>
                    <div class="icon-contianer">
                        <img src="assets/view-icon.svg" alt="" class="icon">
                    </div>
                </div>
                <div class="event-card-details-container">
                    <div class="right-column">
                        <h2 class="event-title"><?=$package['artist']?></h2>
                        <p class="event-sub-title"><?=$package['title']?></p>
                        <span class="event-date">מתאריך: <?=date('d.m.Y', strtotime($package['from']))?> עד <?=date('d.m.Y', strtotime($package['to']))?></span>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <?php if(count($artists) > 8):?>
    <div class="view-more">להציג עוד</div>
    <?php endif;?>
</div>

<div class="mobile">
    <div class="filter-sort-footer" id="filterSortFooter">
        <div id="filterButton" class="filter-sort-container">
            <span class="filter-sort-text" id="filterText">סנן</span>
            <img src="assets/filter-grey.svg" class="filter-sort-icon" id="filterIcon" alt="">
        </div>
        <div class="line">|</div>
        <div id="sortButton" class="filter-sort-container">
            <span class="filter-sort-text" id="sortText">מיין</span>
            <img src="assets/sort-grey.svg" class="filter-sort-icon" id="sortIcon" alt="">
        </div>
    </div>
</div>

<div class="mobile">
    <div class="sidemenu" id="filterSidemenu">
        <div class="filter-categories">
            <img src="assets/x.svg" class="close" alt="">
            <div class="category">
                <div class="category-title-wrapper result">
                    <h1 class="filter-category-title">הופעות</h1>
                    <img src="assets/down_arrow.svg" class="down-arrow" alt="">
                </div>
                <?php build_filter_sub_categories(array('Sweet child', 'Sweet child'), 0) ?>
            </div>
            <div class="category">
                <div class="category-title-wrapper">
                    <h1 class="filter-category-title">הופעות</h1>
                    <img src="assets/down_arrow.svg" class="down-arrow" alt="">
                </div>
                <?php build_filter_sub_categories(array('Sweet child', 'Sweet child'), 1) ?>
            </div>
            <div class="category">
                <div class="category-title-wrapper">
                    <h1 class="filter-category-title">הופעות</h1>
                    <img src="assets/down_arrow.svg" class="down-arrow" alt="">
                </div>
                <?php build_filter_sub_categories(array('Sweet child', 'Sweet child'), 2) ?>
            </div>
            <div class="category">
                <div class="category-title-wrapper">
                    <h1 class="filter-category-title">הופעות</h1>
                    <img src="assets/down_arrow.svg" class="down-arrow" alt="">
                </div>
                <?php build_filter_sub_categories(array('Sweet child', 'Sweet child'), 3) ?>
            </div>
            <div class="category">
                <div class="category-title-wrapper">
                    <h1 class="filter-category-title">הופעות</h1>
                    <img src="assets/down_arrow.svg" class="down-arrow" alt="">
                </div>
                <?php build_filter_sub_categories(array('Sweet child', 'Sweet child'), 4) ?>
            </div>
        </div>
        <div class="filter-actions-container">
            <button class="confirm-filters">אישור</button>
            <button class="clean-filters">נקה הכל</button>
        </div>
    </div>
    <div class="sidemenu" id="sortSidemenu">
        <form class="sort-categories">
            <img src="assets/x.svg" class="close" alt="">
            <div class="input-container" id="sortInputContainer">
                <div class="icon-input">
                    <input type="text" name="" class="text-input" placeholder="עיר/מדינה">
                    <img src="assets/location-blue.svg" class="icon" alt="">
                </div>
                <!-- https://flatpickr.js.org/examples/#range-calendar -->
                <div class="icon-input">
                    <div id="sort-date-input" class="date-picker">תאריך</div>
                    <img src="assets/calendar-blue.svg" class="icon" alt="">
                </div>
            </div>
            <div class="sort-category">
                <label class="checkbox-container">
                    <input type="checkbox" name="" id="sortSport" class="checkbox">
                    <span class="checkmark"></span>
                </label>
                <label for="sortSport" class="sort-category-title">ספורט</label>
            </div>
            <div class="sort-category">
                <label class="checkbox-container">
                    <input type="checkbox" name="" id="sortConcerts" class="checkbox">
                    <span class="checkmark"></span>
                </label>
                <label for="sortConcerts" class="sort-category-title">הופעות</label>
            </div>
            <div class="sort-category">
                <label class="checkbox-container">
                    <input type="checkbox" name="" id="sortAttractions" class="checkbox">
                    <span class="checkmark"></span>
                </label>
                <label for="sortAttractions" class="sort-category-title">אטרקציות/ מחוזות זמר</label>
            </div>
            <div class="sort-category">
                <label class="checkbox-container">
                    <input type="checkbox" name="" id="sortFestivals" class="checkbox">
                    <span class="checkmark"></span>
                </label>
                <label for="sortFestivals" class="sort-category-title">פסטיבלים</label>
            </div>
        </form>
        <div class="filter-actions-container">
            <button class="confirm-filters">אישור</button>
            <button class="clean-filters">נקה הכל</button>
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
    <a href="<?=getConcertsBottomBannerLink() ?>">
        <img src="<?=getConcertsBottomBanner()?>" class="banner-image" alt="">
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