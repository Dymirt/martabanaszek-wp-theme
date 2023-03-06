<?php
/**
 * Template used to display post content on single pages.
 *
 * @package storefront
 */

?>
	<?php
	do_action( 'storefront_post_content_before' );
	?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>style="background-color: white" >


		<?php do_action( 'menu'); ?>
	<div class="content-area-wrapper">

	<?php
	//echo('single-blog');
	do_action( 'storefront_single_post_top' );

	/**
	 * Functions hooked into storefront_single_post add_action
	 *
	 * @hooked storefront_post_header          - 10
	 * @hooked storefront_post_content         - 30
	 */
	//do_action( 'storefront_single_post' );
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
        the_title( sprintf( '<h2 class="alpha entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
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

    the_content();
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
    <?php

	/**
	 * Functions hooked in to storefront_single_post_bottom action
	 *
	 * @hooked storefront_post_nav         - 10
	 * @hooked storefront_display_comments - 20
	 */
	do_action( 'storefront_single_post_bottom' );
	?>
	</div>
    <div class="clearfix"></div>
</article><!-- #post-## -->
