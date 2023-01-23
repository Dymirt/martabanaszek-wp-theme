<?php
/**
 * Template used to display post content.
 *
 * @package storefront
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('item'); ?>>

	<?php
	/**
	 * Functions hooked in to storefront_loop_post action.
	 *
	 * @hooked storefront_post_header          - 10
	 * @hooked storefront_post_content         - 30
	 */
	//echo 'post';
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


	if ( has_post_thumbnail() ) {
		?><a href="<?php the_permalink() ?>"><?php the_post_thumbnail( 'medium' );?></a><?php
	}


    //do_action( 'storefront_post_header_after' );
    ?>
    </header><!-- .entry-header -->
	<div class="entry-content">
	<?php
	if ( is_single() ) {
        the_title( '<h1 class="entry-title">', '</h1>' );
    } else {
        the_date( 'd-m-Y', '<h5>', '</h5>' );
        the_title( sprintf( '<h2 class="alpha entry-title"><a class="" href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );

	}
	/**
	 * Functions hooked in to storefront_post_content_before action.
	 *
	 * @hooked storefront_post_thumbnail - 10
	 */
	//do_action( 'storefront_post_content_before' );
	//the_excerpt();
	?>

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
