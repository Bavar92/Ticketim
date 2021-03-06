<?php
/**
 * @package Ticketim
 * @subpackage Ticketim
 * @since 1.0.0
 * Template Name: Home
 */

get_header();

$searchBarBanner = get_field('home_top_banner')['url'];
$searchBarTitle = get_field('home_top_banner_title');
$searchBarSubtitle = get_field('home_top_banner_subtitle');
$bannerSize = 'big';

include('search-bar.php');

?>

    <div class="desktop">
        <div class="main-content-images">
            <?php

            $banners = getMiddleBanners();
            foreach ($banners as $key => $banner):
                if ($key == 6) {
                    break;
                }
                ?>
                <div class="flip-card">
                    <div class="card">
                        <div class="card-front" style="background-image: url(<?= $banner['image']['url'] ?>)">
                            <div>
                                <h1 class="back-title"><?= $banner['title'] ?></h1>
                                <p class="back-date"><?= $banner['from_date'] ?> - <?= $banner['to_date'] ?></p>
                            </div>
                        </div>
                        <div class="card-back">
                            <div>
                                <h1 class="back-title"><?= $banner['title'] ?></h1>
                                <p class="back-caption"><?= $banner['subtitle'] ?></p>
                                <p class="back-description"><?= $banner['description'] ?></p>
                                <p class="back-date"><?= $banner['from_date'] ?> - <?= $banner['to_date'] ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="mobile">
        <h1 class="main-content-title">תבחרו האירועים הכי פופולריים</h1>
        <p class="main-content-caption"> אנחנו כאן בשביכם!</p>
    </div>


    <div class="mobile">
        <div class="main-content-images-mobile">
            <?php

            $banners = getMiddleBanners();

            foreach ($banners as $key => $banner):
                if ($key == 6) {
                    break;
                }
                ?>
                <div>
                    <img class="content-image" src="<?= $banner['image']['url'] ?>" alt="">
                    <span class="content-title"><?= $banner['title'] ?></span>
                    <span class="content-caption"><?= $banner['from_date'] ?> - <?= $banner['to_date'] ?></span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!--div class="mobile mobile-banner-container">
        <img src="assets/placeholder-image.jpg" class="mobile-banner-image" alt="">
        <span class="mobile-banner-title">הוא פשוט טקסט גולמי</span>
        <span class="mobile-banner-caption">04/05/2019 - 12/11/2019</span>
    </div-->
    <div class="user-experience-container">
        <div class="main-cube">
            <div class="container">
                <div class="wrapper">
                    <div class="cont">
                        <div class="cube">
                            <figure class="front cube-category" data-category="0">מבצעים</figure>
                            <figure class="back cube-category" data-category="1">הופעות</figure>
                            <figure class="right cube-category" data-category="2">ספורט</figure>
                            <figure class="left cube-category" data-category="3">אטרקציות</figure>
                            <figure class="top cube-category" data-category="4">פסטיבלים</figure>
                            <figure class="bottom cube-category" data-category="5">מומלצים</figure>
                        </div>
                    </div>
                </div>
            </div>
            <div class="canvas flex-container">
                <div class="col-lg-4">
                    <div class="bg cool">
                        <canvas id="tenthSection_1" height="200" width="617"></canvas>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="bg awesome">
                        <canvas id="tenthSection_2" height="200" width="1235"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <h1 class="user-experience-title desktop">מה החוויה שלך?" </h1>
        <img src="assets/pointing_person.jpg" class="user-experience-image desktop" alt="">
    </div>

    <div class="banner">
        <a href="<?= getHomePageBottomBannerLink() ?>">
            <img src="<?= getHomePageBottomBanner() ?>" class="banner-image" alt="">
            <!--span class="banner-title">הוא פשוט טקסט גולמי</span>
            <span class="banner-caption">12/11/2019</span-->
        </a>
    </div>
<?php


$posts = get_field('products_home');
global $post, $product;
if ($posts): ?>
    <div class="desktop">
        <div class="slider-container">
            <? if($products_title = get_field('products_title')) { ?>
                <h1 class="slider-container-title"><?= $products_title ?></h1>
            <? } ?>
            <div class="glider-wrapper">
                <div class="glider">
                    <?php foreach ($posts as $post): ?>
                        <a href="<?php the_permalink(); ?>" class="event-card">
                            <?php setup_postdata($post); ?>
                            <div class="event-card-image-container">
                                <?php if (has_post_thumbnail()) { ?>
                                    <? $url = wp_get_attachment_url(get_post_thumbnail_id()); ?>
                                    <img class="event-card-image" src="<?= $url ?>" alt="">
                                <?php } else { ?>
                                    <img class="event-card-image" src="assets/placeholder-image.jpg" alt="">
                                <? } ?>
                                <div class="icon-contianer">
                                    <img src="assets/view-icon.svg" alt="" class="icon">
                                    <span class="view-count"><?= gt_get_post_view(); ?></span>
                                </div>
                            </div>
                            <div class="event-card-details-container">
                                <div class="right-column">
                                    <h2 class="event-title"><?php the_title(); ?>שם של מופע</h2>

                                    <? if ($subtitle_s = get_field('subtitle_s')) { ?>
                                        <p class="event-sub-title">
                                            <?= $subtitle_s ?>
                                        </p>
                                    <? } ?>
                                    <span class="event-date">מתאריך:<? if($from_date = get_field('from_date')) { ?>
                                            <?= $from_date ?>
                                        <? } ?> עד <? if($to_date = get_field('to_date')) { ?>
                                            <?= $to_date ?>
                                        <? } ?></span>

                                </div>
                                <div class="left-column">
                                    <span class="starting-price">החל מ-</span>
                                    <span class="price"><?php echo $product->get_price() ?> €</span>
                                </div>
                            </div>
                        </a>
                    <?php endforeach; ?>

                    <?php wp_reset_postdata(); ?>
                </div>
                <button class="glider-next"><img class="arrow-next" src="assets/arrow.png" alt=""></button>
                <button class="glider-prev"><img class="arrow-prev" src="assets/arrow.png" alt=""></button>
            </div>
        </div>
    </div>
<? endif; ?>





    <script type="application/javascript" src="js/bottom-slider.js"></script>


<?php get_footer(); ?>