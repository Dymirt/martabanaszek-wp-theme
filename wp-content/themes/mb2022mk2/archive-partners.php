<?php
/**
 * The main template file for Partners CPT
 *
 */

get_header(); ?>
<?php do_action('menu'); ?>
    <div class="content-area-wrapper">
    <div id="primary" class="content-area partners">
        <main id="main" class="site-main" role="main" style="margin-top: 80px">
            <h1 class="page-title" style="color: white; background-color: black; margin-bottom: 0">DOTYCZCZAS ZAUFALI NAM</h1>
            <div class="row" style="background-color: black">
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
