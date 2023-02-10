<?php
/**
 * The main template file for Partners CPT
 *
 */

get_header(); ?>
<?php do_action('menu'); ?>
    <div class="content-area-wrapper">
    <div id="primary" class="content-area partners">
        <main id="main" class="site-main" role="main">
            <h1 class="page-title">DOTYCZCZAS ZAUFALI NAM</h1>
            <div class="row row-cols-3 row-cols-md-6">
                <?php
                while (have_posts()) :
                    the_post();
                    do_action('storefront_page_before');
                    get_template_part('template-parts/content', 'partners');
                endwhile; // End of the loop.
                ?>
            </div>
        </main><!-- #main -->
    </div><!-- #primary -->
    </div>
<?php
//do_action( 'storefront_sidebar' );
get_footer();
