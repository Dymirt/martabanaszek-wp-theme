<?php
/**
 * The loop template file.
 *
 * Included on pages like index.php, archive.php and search.php to display a loop of posts
 * Learn more: https://codex.wordpress.org/The_Loop
 *
 * @package storefront
 */

do_action( 'storefront_loop_before' );
echo ('<div id="infinite-scroll" class="flex">');
while ( have_posts() ) :
	the_post();

	/**
	 * Include the Post-Format-specific template for the content.
	 * If you want to override this in a child theme, then include a file
	 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
	 */
	//get_template_part( 'content', get_post_format() );

    if( get_post_type() === 'portfolio' || get_post_type() === 'blog' || get_post_type() === 'post') {
        get_template_part( 'template-parts/content', get_post_type() );
    }
    else if ( has_post_format( array( 'gallery', 'video', 'image' ) ) ) {
        get_template_part( 'template-parts/content', get_post_format() );
    }
    else { 
        get_template_part( 'template-parts/content', 'single' );
    }


endwhile;
echo('</div>');
/**
 * Functions hooked in to storefront_paging_nav action
 *
 * @hooked storefront_paging_nav - 10
 */
do_action( 'storefront_loop_after' );
