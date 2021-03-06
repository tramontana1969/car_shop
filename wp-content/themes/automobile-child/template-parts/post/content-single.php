<?php
/**
 * Template part for displaying Single Posts
 *
 * @subpackage Automobile Shop
 * @since 1.0
 * @version 1.4
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('inner-service'); ?>>
    <div class="single-post">
        <div class="article_content">
            <div class="article-text">
                <h3 class="single-post"><?php the_title();?></h3>
                <div class="metabox">
                    <span class="entry-date"><i class="fas fa-calendar-alt"></i><?php echo esc_html( get_the_date()); ?></span>
                    <span class="entry-date"><i></i>Year: <?php echo get_post_meta($post->ID, 'Year', true);; ?></span>
                </div>
                <?php if(has_post_thumbnail()) { ?>
                    <?php the_post_thumbnail(); ?>
                <?php }?>
                <p><?php the_content(); ?></p>
                <p style="font-size: 35px; color: black">Price: <?php echo get_post_meta($post->ID, 'Price', true);?> $</p>
                <p><?php $taxonomy = get_the_taxonomies($post->ID);
                    echo print_r(($taxonomy['marks']), true); ?></p>
                <p><?php echo print_r($taxonomy['models'], true)?></p>
                <p><?php echo print_r($taxonomy['fuel_types'], true)?></p>
                <div class="single-post-tags mt-3"><?php the_tags(); ?></div>
                <hr>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    </article>