<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <base href="/wp-content/themes/ticketim/">

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/he.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css"/>
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>

    <script type="application/javascript" src="js/bottom-slider.js"></script>
    <script type="application/javascript" src="assets/packages/glider.min.js"></script>
    <script type="application/javascript" src="js/header.js"></script>
    <script type="application/javascript" src="js/main-events.js"></script>
    <script type="application/javascript" src="js/search.js"></script>
    <script type="application/javascript" src="js/live_performance.js"></script>
    <script type="application/javascript" src="js/cart.js"></script>
    <link rel="stylesheet" href="css/edits.css">
    <link rel="stylesheet" href="assets/packages/glider.min.css">
    <link rel="stylesheet" href="assets/packages/cube.css">
    <link rel="stylesheet" href="css/partials/footer.css">
    <link rel="stylesheet" href="css/partials/header.css">
    <link rel="stylesheet" href="css/partials/bottom-slider.css">
    <link rel="stylesheet" href="css/pages/main-events.css">
    <link rel="stylesheet" href="css/pages/desktop-search.css">
    <link rel="stylesheet" href="css/pages/live-performance.css">
    <link rel="stylesheet" href="css/pages/cart.css">
    <link rel="stylesheet" href="css/common/artist-top.css">
    <link rel="stylesheet" href="css/common/cart-strip.css">
    <link rel="stylesheet" href="css/common/base.css">
    <link rel="stylesheet" href="css/common/event-card.css">


    <link rel="stylesheet" href="css/pages/home.css">
    <script type="application/javascript" src="js/home.js"></script>

    <link rel="stylesheet" href="css/pages/artist.css">
    <?php wp_head(); ?>
</head>
<?php

function getArtistsList()
{
    return get_field('artists_list', 'options');
}

function getArtistsBanners()
{
    return get_field('artists_banners', 'options');
}

function build_sub_categories($sub_categories, $banners = [])
{
    echo '<ul class="left-border sub-categories-list">';
    foreach ($sub_categories as $key => $sub) {
        if ($key == 5) {
            echo '</ul>';
            echo '<ul class="sub-categories-list">';
        }

        echo '<li class="sub-category"><a href="/artist/?artist=' . $sub['name'] . '">' . $sub['name'] . '</a></li>' . "\n";
    }
    echo '</ul>';

    if (count($sub_categories) <= 5 && count($banners) > 2) {
        echo '<div class="banners alc"><div class="banner">
            <a href="' . $banners[0]['image']['url'] . '"><img src="' . $banners[0]['image']['url'] . '" /></a>
        </div>';
        echo '<div class="banner">
            <a href="' . $banners[1]['image']['url'] . '"><img src="' . $banners[1]['image']['url'] . '" /></a>
        </div>';
        echo '<div class="banner">
            <a href="' . $banners[2]['image']['url'] . '"><img src="' . $banners[2]['image']['url'] . '" /></a>
        </div></div>';
    } else if (count($sub_categories) <= 10 && count($banners) > 1) {
        echo '<div class="banners alc"><div class="banner">
            <a href="' . $banners[0]['image']['url'] . '"><img src="' . $banners[0]['image']['url'] . '" /></a>
        </div>';
        echo '<div class="banner">
            <a href="' . $banners[1]['image']['url'] . '"><img src="' . $banners[1]['image']['url'] . '" /></a>
        </div></div>';
    } else if (count($banners) > 0) {
        echo '<div class="banners alc"><div class="banner">
            <a href="' . $banners[0]['image']['url'] . '"><img src="' . $banners[0]['image']['url'] . '" /></a>
        </div></div>';
    }
}

;

function build_mobile_sub_categories($sub_categories)
{
    echo '<ul class="mobile-sub-categories-list">';

    foreach ($sub_categories as $key => $sub) {
        echo '<li class="mobile-sub-category" data-sub="' . $key . '">' . $sub['name'] . '</li>' . "\n";
    }

    echo '</ul>';
}

?>

<body <?= body_class() ?>>
<div class="main-header">
    <div class="top-header">
        <div class="top-header-details">
            <img src="assets/clock.svg" class="smaller-icon" alt="">
            <span><? the_field('time', 'option') ?></span>
        </div>
        <div class="top-header-details">
            <img src="assets/phone.svg" class="smaller-icon" alt="">
            <span><a href="tel:<? the_field('phone', 'option') ?>"><? the_field('phone', 'option') ?></a></span>
        </div>
        <div class="top-header-details">

            <?php
            add_shortcode('woo_cart_but', 'woo_cart_but');

            function woo_cart_but()
            {
                ob_start();

                $cart_count = WC()->cart->cart_contents_count;
                $cart_url = wc_get_cart_url();

                ?>

                <a class="menu-item cart-contents" href="<?php echo $cart_url; ?>" title="Cart">
                    <i class="cart-contents-count fas fa-shopping-cart">
                        <?php
                        if ($cart_count > 0) {
                            ?>
                            <u><?php echo $cart_count; ?></u>
                            <?php
                        }
                        ?>
                    </i>
                </a>
                <?php

                return ob_get_clean();

            }

            echo do_shortcode("[woo_cart_but]"); ?>

        </div>


    </div>
    <div class="bottom-header">
        <a href="<? site_url() ?>/" class="logo">
            <img src="assets/logo.png" alt="logo">
        </a>
        <div class="nav-item-wrapper">
            <h1 class="nav-item" data-category="0">מבצעים חמים</h1>
            <div class="expander">
                <div class="subcategories-wrapper">
                    <?php build_sub_categories([]) ?>
                </div>
            </div>
        </div>
        <div class="nav-item-wrapper">
            <h1 class="nav-item"><a href="concerts">הופעות</a></h1>
            <div class="expander">
                <div class="subcategories-wrapper">
                    <?php build_sub_categories(getArtistsList(), getArtistsBanners()) ?>
                </div>
            </div>
        </div>
        <div class="nav-item-wrapper">
            <h1 class="nav-item">ספורט</h1>
            <div class="expander">
                <div class="subcategories-wrapper">
                    <?php build_sub_categories([]) ?>
                </div>
            </div>
        </div>
        <div class="nav-item-wrapper">
            <h1 class="nav-item">אטרקציות ומחזות זמר</h1>
            <div class="expander">
                <div class="subcategories-wrapper">
                    <?php build_sub_categories([]) ?>
                </div>
            </div>
        </div>
        <div class="nav-item-wrapper">
            <h1 class="nav-item">פסטיבלים</h1>
            <div class="expander">
                <div class="subcategories-wrapper">
                    <?php build_sub_categories([]) ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="fixed-header" id="mobileHeader">
    <div class="mobile-main-header">
        <div class="top-header">
            <div class="form-header" style="position:absolute; transform: translateY(-1000%);" id="headerSearchForm">
                <div class="icon-input">
                    <input type="text" name="" class="text-input" placeholder="אמן/קבוצה">
                    <img src="assets/people.svg" class="icon" alt="">
                </div>
                <div class="icon-input">
                    <input type="text" name="" class="text-input" placeholder="עיר/מדינה">
                    <img src="assets/location.svg" class="icon" alt="">
                </div>
                <!-- https://flatpickr.js.org/examples/#range-calendar -->
                <div class=" icon-input">
                    <div id="date-input" class="date-picker">תאריך</div>
                    <img src="assets/calendar.svg" class="icon" alt="">
                </div>
                <div class=" icon-input">
                    <select name="" class="text-input">
                        <option value="" disabled selected>סוג האירוע</option>
                        <option value="">Option 1</option>
                        <option value="">Option 1</option>
                    </select>
                    <img src="assets/type.svg" class="icon" alt="">
                </div>
                <!-- 2 submit down here 1 for desktop and other for mobile -->
                <div class="submit-container desktop">
                    <input type="submit" class="submit" value="">
                    <img src="assets/search.svg" class="submit-icon" alt="">
                </div>
                <div class="submit-container mobile" id="close-header-form">
                    <input type="submit" class="submit" value="">
                    <img src="assets/search.svg" class="submit-icon" alt="">
                </div>
            </div>
            <img class="logo" src="assets/logo.png" id="mobileLogo" alt="">
            <span id="headerSearchButton" class="header-search">חיפוש מתקדם<img src="assets/search-black.svg"
                                                                                style="width: 20px;margin-right: 10px;"/></span>
            <div class="actions">
                <div class="cart-container">
                    <img src="assets/cart.svg" class="icon" alt="">
                    <div class="cart">2</div>
                </div>
                <img src="assets/cripple.svg" class="smaller-icon" alt="">
            </div>
        </div>
        <div class="bottom-header">
            <div class="buger-button" id="bugerButton">
                <span class="line">&nbsp;</span>
                <span class="line">&nbsp;</span>
                <span class="line">&nbsp;</span>
            </div>
            <img class="mushroom" src="assets/menu.svg" alt="">
            <div class="sidemenu" id="sidemenu">
                <div class="categories">
                    <img src="assets/x.svg" class="close" alt="">
                    <div class="category">
                        <div class="category-title-wrapper">
                            <h1 class="category-title">הופעות</h1>
                            <img src="assets/down_arrow.svg" class="down-arrow" alt="">
                        </div>
                        <?php build_mobile_sub_categories(array('Sweet child', 'Sweet child'), 0) ?>
                    </div>
                    <div class="category">
                        <div class="category-title-wrapper">
                            <h1 class="category-title">הופעות</h1>
                            <img src="assets/down_arrow.svg" class="down-arrow" alt="">
                        </div>
                        <?php build_mobile_sub_categories(array('Sweet child', 'Sweet child'), 1) ?>
                    </div>
                    <div class="category">
                        <div class="category-title-wrapper">
                            <h1 class="category-title">הופעות</h1>
                            <img src="assets/down_arrow.svg" class="down-arrow" alt="">
                        </div>
                        <?php build_mobile_sub_categories(array('Sweet child', 'Sweet child'), 2) ?>
                    </div>
                    <div class="category">
                        <div class="category-title-wrapper">
                            <h1 class="category-title">הופעות</h1>
                            <img src="assets/down_arrow.svg" class="down-arrow" alt="">
                        </div>
                        <?php build_mobile_sub_categories(array('Sweet child', 'Sweet child'), 3) ?>
                    </div>
                    <div class="category">
                        <div class="category-title-wrapper">
                            <h1 class="category-title">הופעות</h1>
                            <img src="assets/down_arrow.svg" class="down-arrow" alt="">
                        </div>
                        <?php build_mobile_sub_categories(array('Sweet child', 'Sweet child'), 4) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    