<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined('ABSPATH') || exit;

get_header('shop');


?>
<?php

$countryCityList = getCountryCityList();
$artistsList = getArtists();

?>

    <script type="application/javascript">

        var countryCityList = <?=json_encode($countryCityList)?>;
        var artistsList = <?=json_encode($artistsList)?>;

    </script>
<? $term = get_queried_object();
$searchBarBanner = get_field('top_image', $term)['url'];
$bannerSize = 'big';
?>
    <div class="main-banner-wrapper <?= $bannerSize == 'big' ? '' : 'small' ?>">
        <img src="<?= $searchBarBanner ?>" class="main-banner" alt="">

        <h1 class="main-banner-title"><?= $searchBarTitle ?></h1>
        <p class="main-banner-description"><?= $searchBarSubtitle ?></p>
        <div class="form-header" id="searchForm">
            <div class="submit-container mobile">
                <input type="submit" class="submit" id="extend-form" value="">
                <img src="assets/search.svg" class="submit-icon " alt="">
            </div>
            <div class="icon-input">
                <input type="text" name="" class="text-input" placeholder="אמן/קבוצה" id="search-bar-artist">
                <img src="assets/people.svg" class="icon" alt="">
                <ul class="autocomplete-container" id="artists-autocomplete-container"></ul>
            </div>
            <div class="icon-input">
                <input type="text" name="" class="text-input" placeholder="עיר/מדינה" id="search-bar-location">
                <img src="assets/location.svg" class="icon" alt="">
                <ul class="autocomplete-container" id="countries-autocomplete-container"></ul>
            </div>
            <!-- https://flatpickr.js.org/examples/#range-calendar -->
            <div class=" icon-input">
                <div id="date-input" class="date-picker">תאריך</div>
                <img src="assets/calendar.svg" class="icon" alt="">
            </div>
            <div class=" icon-input">
                <select name="" class="text-input">
                    <option value="" disabled selected>סוג האירוע</option>
                    <option value="">הופעה</option>
                    <option value="">ספורט</option>
                    <option value="">אטרקציות ומחזות זמר</option>
                    <option value="">פסטיבלים</option>
                </select>
                <img src="assets/type.svg" class="icon" alt="">
            </div>
            <!-- 2 submit down here 1 for desktop and other for mobile -->
            <div class="submit-container desktop">
                <input type="submit" class="submit" value="">
                <img src="assets/search.svg" class="submit-icon" alt="">
            </div>
            <div class="submit-container mobile" id="close-form">
                <input type="submit" class="submit" value="">
                <img src="assets/search.svg" class="submit-icon" alt="">
            </div>
        </div>
    </div>
    <div class="desktop">
        <div class="main-content-images">
            <?php

            $banners = getMiddleBannersCategory();
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
    <div class="wrap categories-parent">
        <?php
        $term = get_queried_object();

        //Get all children of this term;
        $children = get_terms('product_cat', array('parent' => $term->term_id));

        if ($children): ?>

            <?php foreach ($children as $child):
                echo '<h3>' . $child->name . '</h3>';
                $args = array('post_type' => 'product', 'taxonomy' => 'product_cat', 'term' => $child->slug, 'post_status' => 'publish', 'posts_per_page' => -1);
                $child_posts = new WP_Query ($args);
                ?>
                <div class="categories-child">
                    <div class="category-items">
                        <?php while ($child_posts->have_posts()) : $child_posts->the_post(); ?>
                            <a href="<?php the_permalink(); ?>" class="event-card">
                                <div class="event-card-image-container">
                                    <?php if (has_post_thumbnail()) { ?>
                                        <? $url = wp_get_attachment_url(get_post_thumbnail_id()); ?>
                                        <img class="event-card-image" src="<?= $url ?>" alt="">
                                    <?php } else { ?>
                                        <img class="event-card-image" src="assets/placeholder-image.jpg" alt="">
                                    <? } ?>
                                    <div class="icon-contianer">
                                        <img src="assets/view-icon.svg" alt="" class="icon">
                                    </div>
                                </div>
                                <div class="event-card-details-container">
                                    <div class="right-column">
                                        <h2 class="event-title"><?php the_title(); ?></h2>
                                        <? if ($subtitle_s = get_field('subtitle_s')) { ?>
                                            <p class="event-sub-title">
                                                <?= $subtitle_s ?>
                                            </p>
                                        <? } ?>
                                        <span class="event-date">מתאריך:<? if ($from_date = get_field('from_date')) { ?>
                                                <?= $from_date ?>
                                            <? } ?> עד <? if ($to_date = get_field('to_date')) { ?>
                                                <?= $to_date ?>
                                            <? } ?></span>
                                    </div>
                                </div>
                            </a>
                        <?php endwhile; ?>
                    </div>
                    <div class="wrap-button">
                        <? $term_link = get_term_link($child); ?>
                        <a href="<?= $term_link ?>" class="btn">Learn more</a>
                    </div>
                </div>
            <?php
            endforeach; ?>

        <?php
        endif; ?>
    </div>

<? if ($full_image_c = get_field('full_image_c', $term)['url']) { ?>
    <a class="full-image cover alc" href="<? the_field('link_c', $term) ?>"
       style="background-image: url(<?= $full_image_c ?>)">
        <div class="wrap mini">
           <div class="flex">
               <? if ($text_on_image_left = get_field('text_on_image_left', $term)) { ?>
                   <div class="text-left half">
                       <?= $text_on_image_left ?>
                   </div>
               <? } ?>
               <? if ($text_on_image_right = get_field('text_on_image_right', $term)) { ?>
                   <div class="text-right half">
                       <?= $text_on_image_right ?>
                       <span class="fas fa-arrow-left"></span>
                   </div>
               <? } ?>
           </div>
        </div>
    </a>
<? } ?>


<?php get_footer('shop');