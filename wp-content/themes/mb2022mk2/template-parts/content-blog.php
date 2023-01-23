<?php
/**
 * Template used to display post content.
 *
 * @package storefront
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php
	/**
	 * Functions hooked in to storefront_loop_post action.
	 *
	 * @hooked storefront_post_header          - 10
	 * @hooked storefront_post_content         - 30
	 */
	//echo 'blog';
	//do_action( 'storefront_loop_post' );

	?>
    <header class="entry-header">
    <?php

    /**
     * Functions hooked in to storefront_post_header_before action.
     *
     * @hooked storefront_post_meta - 10
     */
    //do_action( 'storefront_post_header_before' );

    if ( is_single() ) {
        the_title( '<h1 class="entry-title">', '</h1>' );
    } else {
        the_title( sprintf( '<h2 class="alpha entry-title"><a class="underline" href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
    }
	if ( has_post_thumbnail() ) {
		?><a href="<?php the_permalink() ?>"><?php the_post_thumbnail('medium_large');?></a><?php
	}
    //do_action( 'storefront_post_header_after' );
    ?>
    </header><!-- .entry-header -->
	<div class="entry-content">
	<?php

	/**
	 * Functions hooked in to storefront_post_content_before action.
	 *
	 * @hooked storefront_post_thumbnail - 10
	 */
	//do_action( 'storefront_post_content_before' );
	the_excerpt();
	?>

	<p><a class="read-more underline" href="<?php the_permalink() ?>"><?php echo __('Read more');?></a></p>

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
