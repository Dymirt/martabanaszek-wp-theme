<?php

wp_enqueue_style('for-partners', get_stylesheet_directory_uri() . '/assets/css/for-partners_page.css');

get_header(); ?>
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

        <div class='align-items-stretch' style='background-color: black; padding: 4rem 0;'>
            <h2 class='strong-header' style="text-align: center; color: white">o Marce</h2>
            <div class="container"
                 style="text-align: center; font-weight: 500;font-size: 14.4px; color:white; max-width: 900px;">
                <p>
                    MB Marta Banaszek marka modowa, powstała w 2017 roku. Od początku istnienia najważniejszą dla Nas
                    wartością jest zaufanie klientek, zdobyte dzięki transparentności oraz ciężkiej pracy.
                    Wypracowaliśmy indywidualne podejście do klientki, które stało się domeną marki MB, widoczne we
                    wszystkich projektach. W ten sposób pracujemy na wzajemne zaufanie i budujemy długofalową relację z
                    naszymi klientkami.
                    <br><br>Dla MB Marta Banaszek transparentność to podstawa, bez której nasze projekty nie ujrzałyby
                    światła dziennego. Transparentność, to przede wszystkim gra w „otwarte karty”, gdzie każdy klient ma
                    możliwość śledzenia całego procesu tworzenia. To biznes wykwalifikowanych rzemieślników pracujących
                    na miejscu w Studio i otwartych na pracę z klientem.
                    <br><br>Spełniamy marzenia kobiet o kreacjach - odzwierciedlając je w naszych projektach. Niezwykle
                    projekty ubrań, które można nosić na wielkie wydarzenia wprost na czerwony dywan, jak i w życiu
                    codziennym. </p>

            </div>
        </div>
        <div class=''>
            <h2 style="text-align: center; color: white;">Dostępne produkty</h2>
            <div class="row row-cols-1 row-cols-md-3 g-4 ">
                <?php
                $args = array(
                    'post_type' => 'product',
                    'posts_per_page' => 100,
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'product_tag',
                            'terms' => 'ciriana-instock',
                            'field' => 'slug',
                            'operator' => 'IN'
                        )
                    ),
                    'meta_query' => array(
                        array(
                            'key' => '_stock_status',
                            'value' => 'instock'
                        )
                    )
                );
                $loop = new WP_Query($args);
                if ($loop->have_posts()) {
                    while ($loop->have_posts()) : $loop->the_post();
                        get_template_part('template-parts/for_partners/content', 'product');
                    endwhile;
                } else {
                    echo __('No products found');
                }
                wp_reset_postdata();
                ?>
            </div>
        </div>

        <div class="container">
            <?php get_template_part('template-parts/for_partners/content', 'finishes_gallery')?>
        </div>

        <div class="container">
            <?php get_template_part('template-parts/for_partners/content', 'gallery')?>
        </div>

        <div class='container'>
            <h2 style="text-align: center; color: white;">Kontakt</h2>

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
