<?php
/**
 * @package Ticketim
 * @subpackage Ticketim
 * @since 1.0.0
 */

get_header(); ?>

<?php
if ('' !== get_post()->post_content) { ?>
    <div class="wysiwyg">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <?php the_content(); ?>
        <?php endwhile; endif; ?>
    </div>
<?php } ?>

<?php get_footer();
