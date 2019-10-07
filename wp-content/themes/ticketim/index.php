<?php get_header(); ?>

<?php if (get_field('top_image_b', 'option')) { ?>
    <div class="topBox alc cover" style="<?php echo image_src(get_field("top_image_b", 'option'), "free", true); ?>">
        <div class="container">
            <h1><?php echo get_the_title(BLOG_ID); ?></h1>
        </div>
    </div>
<?php } else { ?>
    <div class="topBox withoutBg alc cover">
        <div class="container">
            <h1><?php echo get_the_title(BLOG_ID); ?></h1>
        </div>
    </div>
<?php } ?>

    <section class="post-content">

    </section>
<?php get_footer(); ?>