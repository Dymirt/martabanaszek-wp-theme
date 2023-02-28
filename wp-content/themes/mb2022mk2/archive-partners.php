<?php
/**
 * The main template file for Partners CPT
 *
 */

get_header(); ?>

<style>
    body{
        background-color: black;
    }
</style>
<?php do_action('menu'); ?>
    <div class="content-area-wrapper">
    <div id="primary" class="content-area partners">
        <main id="main" class="site-main" role="main">
            <div class="container">
                <h1 class="page-title" style="color: white;">DOTYCZCZAS ZAUFALI NAM</h1>
                <div class="row">
                    <?php
                    $args = array(
                            'post_type' => 'partners',
                            'orderby' => 'rand',
                            'posts_per_page' => 100,
                    );
                    $query = new WP_Query( $args );

                    while ($query->have_posts()) :
                        $query->the_post();
                        do_action('storefront_page_before');
                        get_template_part('template-parts/content', 'partners');
                    endwhile; // End of the loop.
                    ?>
                </div>
            </div>
        </main><!-- #main -->
    </div><!-- #primary -->
    </div>
<?php
//do_action( 'storefront_sidebar' );
get_footer();
