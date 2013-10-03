<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package dtechtheme
 * @subpackage dtechtheme
 * @since Dstheme
 */
get_header();
?>
<div id="wraper1">
    <div id="content">
        <?php get_sidebar(); ?>
        <section>
            <div class="under_section">
                <?php if (have_posts()) : ?>
                    <h2>
                        <?php printf(__('<tt>Search Results for: %s</tt>', 'dtechtheme'), '<tt>' . get_search_query() . '</tt>'); ?>
                    </h2>
                    <?php /* Start the Loop */ ?>
                    <?php while (have_posts()) : the_post(); ?>

                        <?php
                        /* Include the Post-Format-specific template for the content.
                         * If you want to overload this in a child theme then include a file
                         * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                         */
                        get_template_part('content', get_post_format());
                        ?>
                    <?php endwhile; ?>
                <?php else : ?>
                    <article id="post-0" class="post no-results not-found">
                        <header class="entry-header">
                            <h1 class="entry-title"><?php _e('Nothing Found', 'dtechtheme'); ?></h1>
                        </header><!-- .entry-header -->
                        <div class="entry-content">
                            <p><?php _e('Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'dtechtheme'); ?></p>
                            <b>New Search Term :</b>
                            <div class="search">
                                <a href="javascript:void(0)" onclick="$('#searchform').submit();">
                                    <?php echo CHtml::image(get_template_directory_uri() . '/images/search_img_03.jpg'); ?>
                                </a>
                                <form method="get" id="searchform" action="">
                                    <input type="hidden" name="r" value="blog"/>
                                    <input type="text" class="search_text"  name="s" id="s" placeholder="<?php esc_attr_e('Search', 'dtechtheme'); ?>" />
                                </form>
                            </div>
                        </div><!-- .entry-content -->
                    </article><!-- #post-0 -->
                <?php endif; ?>
            </div><!-- #content -->
        </section><!-- #primary -->
    </div>
</div>
<?php get_footer(); ?>