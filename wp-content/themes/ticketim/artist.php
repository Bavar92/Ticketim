<?php
/**
 * @package Ticketim
 * @subpackage Ticketim
 * @since 1.0.0
 * Template Name: Artist
 */


get_header(); 

$searchBarBanner   = get_field('artist_top_banner')['url'];
$searchBarTitle    = get_field('artist_top_banner_title');
$searchBarSubtitle = get_field('artist_top_banner_subtitle');
$bottomBannerLink  = get_field('artist_bottom_banner_link');
$bottomBannerImage = get_field('artist_bottom_banner')['image'];
$bannerSize        = 'small';

include('search-bar.php');

$artist    = getArtistByName($_GET['artist']);
$locations = getArtistShowsLocations($_GET['artist']);
$hot       = getHotArtistShowsLocations($_GET['artist']);

?>

<div class="desktop ">
    <div class="artist-container">
        <div class="artist-inner-top-section">
            <div class="text-side">
                <h1><?=$artist['name']?></h1>
                <p class="bold">טקסט טקסט טקסט טקסט טקסט טקסט טקסט טקסט טקסט טקסט טקסט 
                טקסט טקסט טקסט טקסט טקסט טקסט טקסט טקסט טקסט טקסט טקסט 
                טקסט טקסט טקסט טקסט טקסט טקסט טקסט טקסט טקסט טקסט טקסט 
                טקסט טקסט טקסט טקסט טקסט טקסט טקסט טקסט טקסט טקסט טקסט 
                </p>
                <p>טקסט טקסט טקסט טקסט טקסט טקסט טקסט טקסט טקסט טקסט טקסט 
                טקסט טקסט טקסט טקסט טקסט טקסט טקסט טקסט טקסט טקסט טקסט 
                טקסט טקסט טקסט טקסט טקסט טקסט טקסט טקסט טקסט טקסט טקסט 
                טקסט טקסט טקסט טקסט טקסט טקסט טקסט טקסט טקסט טקסט טקסט 
                </p>
            </div>
            <div class="gallery-side">
                <div class="gallery-large">
                    <div class="gallery-large">
                        <img src="<?=$artist['image']['url']?>" alt="" />
                    </div>
                </div>
                <div class="gallery-small-container">
                    <div class="gallery-small-image"></div>
                    <div class="gallery-small-image"></div>
                    <div class="gallery-small-image"></div>
                </div>
            </div>
        </div>
        <div class="artist-inner-container">
            <div class="right-side">
                <div class="artist-list-title">
                    <h2>הופעות חמות
                        <img class="title-icon" src="assets/fire-blue.svg" alt="הופעות חמות" />
                    </h2>
                </div>
                <div class="search-container artist">
                    <form class="search-form" action="">
                        <?php foreach($hot as $location): ?>
                        <div class="search-category-container">
                            <div class="search-category-select artist">
                                <div class="category-title-wrapper" data-artist="<?=$location['artist'][0] ?>" data-location="<?=$location['location'][0] ?>">
                                    <h1 class="filter-category-title"><?=$location['location'][0] ?></h1>
                                    <div class="filter-category-date">
                                        <span>
                                            <?=date('d.m.Y', strtotime($location['date'][0])) ?>
                                        </span>
                                        <img src="assets/black-left-arrow.svg" class="down-arrow" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </form>

                </div>

                <div class="artist-list-title">
                    <h2>כל האירועים של <?=$artist['name']?></h2>
                </div>
                <div class="search-container artist">
                    <form class="search-form" action="">
                        <?php foreach($locations as $location): ?>
                        <div class="search-category-container">
                            <div class="search-category-select artist">
                                <div class="category-title-wrapper" data-artist="<?=$location['artist'][0] ?>" data-location="<?=$location['location'][0] ?>">
                                    <h1 class="filter-category-title"><?=$location['location'][0] ?></h1>
                                    <div class="filter-category-date">
                                        <span>
                                            <?=date('d.m.Y', strtotime($location['date'][0])) ?>
                                        </span>
                                        <img src="assets/black-left-arrow.svg" class="down-arrow" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </form>
                </div>
            </div>
            <div class="left-side">
                <div class="artist-events-container"></div>
            </div>
        </div>
    </div>
</div>

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