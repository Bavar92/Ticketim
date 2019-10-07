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
<? } ?>

<?php

$images = get_field('image_gallery');

if ($images): ?>
    <div class="wrap mini">
        <div class="flex">
            <div class="single-text">
                <h1><? the_title() ?></h1>
                <? if ($product_type = get_field('product_type')) { ?>
                    <div class="type">
                        <?= $product_type ?>
                    </div>
                <? } ?>
                <?

                if (get_field('from_date') || get_field('to_date')) { ?>
                    <div class="date">
                        <? the_field('from_date') ?> <? if (get_field('from_date') && get_field('to_date')) { ?> - <? } ?><? the_field('to_date') ?>
                    </div>
                <? } ?>
            </div>
            <div class="gallery-images flex">
                <div class="image-mini">
                    <?php foreach ($images as $image): ?>
                        <div class="image">
                            <img src="<?php echo $image['sizes']['gallery']; ?>" alt="<?php echo $image['alt']; ?>"/>
                            <p><?php echo $image['caption']; ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="image-big">
                    <?php foreach ($images as $image): ?>
                        <div class="image">
                            <img src="<?php echo $image['sizes']['gallery']; ?>" alt="<?php echo $image['alt']; ?>"/>
                            <p><?php echo $image['caption']; ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>

            </div>

        </div>

    </div>
<?php endif; ?>


<?php while (have_posts()) : the_post(); ?>

    <?php wc_get_template_part('content', 'single-product'); ?>

<?php endwhile; // end of the loop. ?>

<?php
/**
 * woocommerce_after_main_content hook.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action('woocommerce_after_main_content');
?>

<?php
/**
 * woocommerce_sidebar hook.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
do_action('woocommerce_sidebar');
?>

<?php get_footer('shop');

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
