<?php

get_header();

do_action('menu'); ?>

    <div class="content-area-wrapper">
        <div id="primary" class="content-area <?php echo get_post_type() ?> rh">
            <main id="main" class="site-main" role="main">
                <div class="container">
                    <h1 class="page-title"><?php post_type_archive_title();?></h1>

                    <?php get_template_part('loop'); ?>
                </div>

            </main><!-- #main -->
        </div><!-- #primary -->
    </div>
<?php
//do_action( 'storefront_sidebar' );
get_footer();