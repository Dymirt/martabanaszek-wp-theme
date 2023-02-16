<?php

wp_enqueue_style('for-partners', get_stylesheet_directory_uri() . '/assets/css/for-partners_page.css');

get_header('ciriana'); ?>
<?php
// STARTS - wrapp your content with this conditional statement
if (post_password_required()) :

    // if your post is password protected with our Pro version, show our password form instead
    echo get_the_password_form();

/* display the password protected content if the correct password is entered */
else:?>
    <div id="primary" class="content-area ciriana">
            <section class="video-header">
                    <video autoplay loop muted playsinline>
                        <source src="<?php echo get_stylesheet_directory_uri() ?>/img/s2/chapter4_25fps.mp4"
                                type="video/mp4">
                    </video>
            </section>

        <div class='container'>
            <h2 style="text-align: center; color: white; padding: 2rem;">Nasze najlepsze produkty</h2>
            <div class="row row-cols-1 row-cols-md-3 g-4 ">
                <?php
                $args = array(
                    'post_type' => 'product',
                    'posts_per_page' => 100,
                    'tax_query' => array(
                        'relation' => 'OR',
                        array(
                            'taxonomy' => 'product_tag',
                            'terms' => 'for-partners',
                            'field' => 'slug',
                            'operator' => 'IN'
                        ),
                        array(
                            'taxonomy' => 'product_tag',
                            'terms' => 'ciriana',
                            'field' => 'slug',
                            'operator' => 'IN'
                        )
                    ),
                );
                $loop = new WP_Query($args);
                if ($loop->have_posts()) {
                    while ($loop->have_posts()) : $loop->the_post();
                        wc_get_template_part('content', 'product_ciriana');
                    endwhile;
                } else {
                    echo __('No products found');
                }
                wp_reset_postdata();
                ?>
            </div>
        </div>

        <div class="container">
            <?php get_template_part('template-parts/content', 'finishes_gallery')?>
        </div>

        <div class="container">
            <?php get_template_part('template-parts/content', 'for_partners_gallery')?>
        </div>

        <div class='container' id="contact">
            <h2 style="text-align: center; color: white; padding: 2rem;">Kontakt</h2>

            <div style="text-align: center; font-size: 1.5rem; margin-bottom: 2rem;">
                Zapraszamy do współpracy Partnerów z Polski, jaki i zagranicy. Oferujemy atrakcyjne warunki współpracy,
                profesjonalną obsługę i sprawny serwis.
                Zachęcamy do kontaktu poprzez poniższy formularz.
            </div>
            <div style='max-width:350px; margin: auto'><?php echo apply_shortcodes('[contact-form-7 id="65871" title="ciriana-price-offer-form"]'); ?></div>


        </div>


    </div><!-- #primary -->
<?php endif;
// ENDS - hide custom fields with PPWP password protection
?>
<?php
get_footer('ciriana');
