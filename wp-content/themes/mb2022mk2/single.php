<?php
/**
 * The template for displaying all single posts.
 *
 * @package storefront
 */

get_header(); ?>
	<div id="primary" class="content-area post single">
		<main id="main" class="site-main" role="main">

		<?php
		while ( have_posts() ) :
			the_post();

			//do_action( 'storefront_single_post_before' );

			//get_template_part( 'template-parts/content', 'single' );

			if( get_post_type() === 'portfolio') {
				get_template_part( 'template-parts/content', 'single-'.get_post_type() );
			}
			else if (  get_post_type() === 'blog' ) {
				get_template_part( 'template-parts/content', 'single-'.get_post_type() );
			}
			else { 
				get_template_part( 'template-parts/content', 'single' );
			}

			//do_action( 'storefront_single_post_after' );

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->
	
<?php
//do_action( 'storefront_sidebar' );
get_footer();
