<?php get_header(); ?>
<?php gt_set_post_view(); ?>
<section class="content">
    <div class="container">
        <article>
            <h1><?php the_title(); ?></h1>

                <div class="wysiwyg">
                    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                        <?php the_content(); ?>
                    <?php endwhile; endif; ?>
                </div>

            <a class="button" href="<?php echo get_permalink(BLOG_ID); ?>">Go back</a>
        </article>
        <aside>
            <?php dynamic_sidebar("Blog Sidebar") ?>
        </aside>
    </div>
</section>

<?php get_footer(); ?>

