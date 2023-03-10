<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package storefront
 */

get_header(); ?>
	<?php do_action( 'menu'); ?>
	<div class="content-area-wrapper">
		
	<div id="primary" class="content-area news">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) :

			get_template_part( 'loop' );
			/*echo do_shortcode('[ajax_load_more 
				preloaded="true" 
				loading_style="infinite classic" 
				images_loaded="false" 
				posts_per_page="10" 
				repeater="posts"]');
			*/

		else :

			get_template_part( 'content', 'none' );

		endif;
		?>

		</main><!-- #main -->
	</div><!-- #primary -->
	</div>
<?php
//do_action( 'storefront_sidebar' );
get_footer();
