<?php if ( has_post_thumbnail() ) { ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

        <div class="entry-content">
            <a href="<?php the_permalink() ?>">
                <?php
                if (get_post_type() === 'product'):
                    the_post_thumbnail( 'custom-product-thumbnails' );
                else:
                the_post_thumbnail( 'medium' );
                endif;
                ?>
                <div class="overlay">
                    <h2 class="alpha entry-title">
                        <?php
                        the_title();
                        ?>
                    </h2>
                    <?php
                    if (get_post_type() === 'blog' || get_post_type() === 'news'):
                        if (get_post_type() === 'blog'):
                            the_excerpt(); ?>
                        <p><small><?php the_date();?></small></p>
                        <?php
                        endif;
                    elseif (get_post_type() === 'product'):
                        do_action('woocommerce_after_shop_loop_item_title') ?>
                    <?php
                        else: ?>
                            <p><small><?php the_date();?></small></p>
                        <?php
                    endif;?>
                </div>
            </a>
            <?php
            do_action( 'storefront_post_content_after' );

            wp_link_pages(
                array(
                    'before' => '<div class="page-links">' . __( 'Pages:', 'storefront' ),
                    'after'  => '</div>',
                )
            );
            ?>
        </div><!-- .entry-content -->
    </article><!-- #post-## -->
<?php } ?>
