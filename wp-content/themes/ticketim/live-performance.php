<?php
/**
 * @package Ticketim
 * @subpackage Ticketim
 * @since 1.0.0
 * Template Name: Live performance
 */


get_header(); 

$searchBarBanner   = get_field('live_top_banner')['url'];
$searchBarTitle    = get_field('live_top_banner_title');
$searchBarSubtitle = get_field('live_top_banner_subtitle');
$bottomBannerLink  = get_field('live_bottom_banner_link');
$bottomBannerImage = get_field('live_bottom_banner')['image'];
$bannerSize        = 'small';

include('search-bar.php');

$ticketData  = getProductData($_GET['product_id']);
$productData = wc_get_product($_GET['product_id']);
$variations  = $productData->get_available_variations();

$lowestPrice = ['price' => 9999999, 'title' => ''];
foreach($variations as $varient) {

    if($lowestPrice['price'] > $varient['display_price']) {
        $lowestPrice['price'] = $varient['display_price'];
        $lowestPrice['title'] = $varient['attributes']['attribute_ticket-type'];
        $lowestPrice['id']    = $varient['variation_id'];
    }
}

?>

<script type="text/javascript">

    var currentVariation = {
        product_id: <?=$_GET['product_id']?>,
        variation_id: '<?=$lowestPrice['id']?>',
        quantity: 1,
    };

</script>

<div class="desktop">
    <div class="performance-container">
        <div class="artist-inner-top-section">
            <div class="text-side">
                <h1><?=$ticketData->meta['artist']['name']?></h1>
                <div class="info-line">
                    <img src="assets/location.png" class="icon" alt="" />
                    <?=$ticketData->meta['city'][0]?>
                </div>
                <div class="info-line">
                    <img src="assets/music.png" class="icon" alt="" />
                    הופעות
                </div>
                <div class="info-line">
                    <img src="assets/calendar-blue.svg" class="icon" alt="" />
                    <?=date('d.m.Y', strtotime($ticketData->meta['from_date'][0]))?>
                </div>
                <div class="info-line">
                    <img src="assets/package-type.png" class="icon" alt="" />
                    כרטיס בלבד
                </div>

                <div class="comment">
                    בלעדי לטיקטים!<br />
                    שירות טיקטים 360 - הדרך שלכם להבטיח <br />
                    את החבילה המושלמת
                </div>
            </div>
            <div class="gallery-side">
                <div class="gallery-large">
                    <div class="gallery-large">
                        <img src="<?=$ticketData->meta['artist']['image']['url']?>" alt="" />
                    </div>
                </div>
                <div class="gallery-small-container">
                    <div class="gallery-small-image"></div>
                    <div class="gallery-small-image"></div>
                    <div class="gallery-small-image"></div>
                </div>
            </div>
        </div>

        <div class="artist-list-title">
            <h2>פרטי כרטיסים</h2>
        </div>
        <div class="search-container live">
            <form class="search-form" action="">

            <div class="search-category-container">
                <div class="search-category-select live">

                <?php foreach($variations as $key => $varient): ?>
                <?php if($key == 0):?>
                    <div class="category-title-wrapper live selected" data-title="<?=$varient['attributes']['attribute_ticket-type']?>" data-price="<?=$varient['display_price']?>" data-variation="<?=$varient['variation_id']?>">
                        <h1 class="filter-category-title"><?=$varient['attributes']['attribute_ticket-type']?></h1>
                        <div class="left-side-container">
                            <div class="price-container">
                                <span class="price"><?=$varient['display_price']?></span>
                                    <span class="text">מחיר בסיס</span>
                            </div>
                            <img src="assets/black-left-arrow.svg" class="down-arrow" alt="">
                        </div>
                </div>
                <?php else: ?>
                <div class="category-title-wrapper live" data-title="<?=$varient['attributes']['attribute_ticket-type']?>" data-price="<?=$varient['display_price']?>" data-variation="<?=$varient['variation_id']?>">
                        <h1 class="filter-category-title"><?=$varient['attributes']['attribute_ticket-type']?></h1>
                        <div class="left-side-container">
                            <div class="price-container">
                                <span class="price">+<?=($varient['display_price'] - $lowestPrice['price'])?></span>
                                    <span class="text">תוספת לאדם</span>
                            </div>
                            <img src="assets/black-left-arrow.svg" class="down-arrow" alt="">
                        </div>
                    </div>
                <?php endif; ?>
                <?php endforeach; ?>

            </div>
            </div>

        </form>

        <div class="left-side">
                <div class="map-container">
                    <a data-fancybox="gallery" href="http://localhost:8888/wp-content/uploads/2019/08/kombank-arena-m-20408-1-1024-x-1024-copy@3x.png">
                        <img src="http://localhost:8888/wp-content/uploads/2019/08/kombank-arena-m-20408-1-1024-x-1024-copy@3x.png" alt="" />
                    </a>   
                </div>
        </div>

    </div>
</div>
<div class="bottom-cart-strip">
    <div class="right-side"></div>
    <div class="left-side">
        <div class="price-container">
            <div class="price"><?=$lowestPrice['price']?></div>
            <div class="description"><?=$lowestPrice['title']?></div>
        </div>
        <div class="amount-container">
            <div class="inner-container">
                <div class="title">כמות</div>
                <div class="selector"></div>
            </div>
        </div>
        <div class="button-container">
            <button class="add-to-cart" id="strip-add-to-cart">
                <span>הוסף לסל</span>
                <img src="assets/cart-white.png" alt="" />
            </button>
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