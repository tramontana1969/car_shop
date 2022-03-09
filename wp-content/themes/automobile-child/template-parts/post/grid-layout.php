<?php
/**
 * Template part for displaying posts
 *
 * @subpackage Automobile Shop
 * @since 1.0
 * @version 1.4
 */
?>

<div class="col-lg-4 col-md-4">
    <article id="post-<?php the_ID(); ?>" <?php post_class('inner-service grid-layout'); ?>>
        <div class="article_content">
            <h3 id="title_<?php the_ID(); ?>"><?php the_title(); ?></h3>
            <div class="post-date">
                <span class="entry-date"><span><?php echo esc_html( get_the_date()); ?></span></span>
            </div>
            <?php
            if(has_post_thumbnail()) {
                the_post_thumbnail();
            }?>
            <p><?php the_excerpt(); ?></p>
            <br>
            <p><?php
                $taxonomy = get_the_taxonomies($post->ID);
                echo print_r(($taxonomy['marks']), true);
                ?></p>
            <p>
                <?php echo print_r($taxonomy['models'], true)?>
            </p>
            <br>
            <p>Year: <?php echo get_post_meta($post->ID, 'Year', true); ?></p>
            <p style="font-size: 30px; color: black"><?php echo get_post_meta($post->ID, 'Price', true); ?> $</p>
            <div class="read-btn">
                <a href="<?php the_permalink(); ?>"><span><?php esc_html_e('Read More','automobile-shop'); ?></span><span class="screen-reader-text"><?php esc_html_e('Read More','automobile-shop'); ?></span></a>
            </div>
            <div class="clearfix"></div>
        </div>
    </article>
</div>