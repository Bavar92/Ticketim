<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see        https://docs.woocommerce.com/document/template-structure/
 * @package    WooCommerce/Templates
 * @version     1.6.4
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

get_header('shop'); ?>
<? if ($top_image_s = get_field('top_image_s')) { ?>
    <div class="top-block cover" style="background-image: url(<?= $top_image_s["url"] ?>)">
        <div class="wrap">
        </div>
    </div>
<? } else { ?>
    <div class="top-block cover" style="background-image: url('<?php echo theme() ?>/assets/placeholder-image.jpg')">
        <div class="wrap">
        </div>
    </div>
<? } ?>

    <div class="wrap mini">
        <div class="flex">
            <div class="single-text">

                <?php
                /**
                 * Hook: woocommerce_single_product_summary.
                 *
                 * @hooked woocommerce_template_single_title - 5
                 * @hooked woocommerce_template_single_rating - 10
                 * @hooked woocommerce_template_single_price - 10
                 * @hooked woocommerce_template_single_excerpt - 20
                 * @hooked woocommerce_template_single_add_to_cart - 30
                 * @hooked woocommerce_template_single_meta - 40
                 * @hooked woocommerce_template_single_sharing - 50
                 * @hooked WC_Structured_Data::generate_product_data() - 60
                 */
                do_action('woocommerce_single_product_summary');
                ?>
                <?

                if (get_field('from_date') || get_field('to_date')) { ?>
                    <div class="date">
                        <? the_field('from_date') ?> <? if (get_field('from_date') && get_field('to_date')) { ?> - <? } ?><? the_field('to_date') ?>
                    </div>
                <? } ?>
            </div>
            <div class="gallery-images flex">
                <?php
                $images = get_field('image_gallery');
                if ($images): ?>
                    <div class="image-mini">
                        <?php foreach ($images as $image): ?>
                            <div class="image">
                                <img src="<?php echo $image['sizes']['gallery']; ?>"
                                     alt="<?php echo $image['alt']; ?>"/>
                                <p><?php echo $image['caption']; ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="image-big">
                        <?php foreach ($images as $image): ?>
                            <div class="image">
                                <img src="<?php echo $image['sizes']['gallery']; ?>"
                                     alt="<?php echo $image['alt']; ?>"/>
                                <p><?php echo $image['caption']; ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <? if ($trip = get_field('trip_t')) { ?>
            <div class="trip style-custom-single">
                <? foreach ($trip as $tr) { ?>
                    <h2><?= $tr['type_trip'] ?></h2>
                    <div class="wrapper flex">
                        <div class="directions half alc">
                            <p><?= $tr['date'] ?></p>
                            <p><?= $tr['from_city'] ?></p>
                            <p><?= $tr['to_city'] ?></p>
                        </div>
                        <? if ($flight = $tr['flight']) { ?>
                            <div class="flight half">
                                <? foreach ($flight as $f) { ?>
                                    <div class="flight-info">
                                        <div class="header alc">
                                            <p><strong>וודר בלונדון</strong></p>
                                            <p><?= $tr['date'] ?></p>
                                            <p>וודר בלונדון</p>
                                            <p><?= $f['flight_time'] ?></p>
                                        </div>
                                        <div class="body alc">
                                            <div class="company col-3">
                                                <? $image = $f['company_icon'] ?>
                                                <img src="<?= $image['sizes']['medium'] ?>" alt="<?= $image['alt'] ?>">
                                                <p><?= $f['company_name'] ?></p>
                                            </div>
                                            <div class="departure col-3">
                                                <div class="alc">
                                                    <p class="abbr"><?= $f['departure_city'] ?></p>
                                                    <p><?= $f['departure_time'] ?></p>
                                                </div>
                                                <p><?= $f['departure_airport'] ?></p>
                                            </div>
                                            <div class="arrival col-3">
                                                <div class="alc">
                                                    <p class="abbr"><?= $f['arrival_city'] ?></p>
                                                    <p><?= $f['arrival_time'] ?></p>
                                                </div>
                                                <p><?= $f['arrival_airport'] ?></p>
                                            </div>
                                            <div class="code col-3">
                                                <p><strong>Code</strong></p>
                                                <p><?= $f['airplane_number'] ?></p>
                                            </div>
                                        </div>
                                        <div class="bottom-info"><?= $f['short_description'] ?></div>
                                    </div>
                                <? } ?>
                            </div>
                        <? } ?>
                    </div>
                <? } ?>
            </div>
        <? } ?>

    </div>


<?php
/**
 * woocommerce_after_main_content hook.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action('woocommerce_after_main_content');
?>

<?php get_footer('shop');

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
