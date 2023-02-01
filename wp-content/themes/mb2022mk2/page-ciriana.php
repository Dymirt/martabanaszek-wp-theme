<?php

wp_enqueue_style('for-partners', get_stylesheet_directory_uri() . '/assets/css/for-partners_page.css');

get_header(); ?>

<div id="primary" class="content-area frontpage">
    <main id="main" class="site-main" role="main" data-aos="fade-right" data-aos-duration="1000" data-aos-anchor-placement="top-center">

<section class="fullpage" data-aos="fade-in" data-aos-duration="500">
			<div class="wrapper h50">
                <div class="video-overlay"></div>
                <video class="bg-video" id="video2" autoplay loop muted playsinline>
                    <source src="<?php echo get_stylesheet_directory_uri()?>/img/s2/chapter4_25fps.mp4" type="video/mp4">
                </video>
                <div class="overlay caption">
                    <h5>Zapoznaj się z marką</h5>
                    <h1>MB Marta Banaszek</h1>
                </div>
			</div>
	</section>

    </main><!-- #main -->
    <!-- Here Comes a PAGE -->

    <div class='align-items-stretch' style='background-color: black; padding: 4rem 0;'>
        <h2 class='strong-header' style="text-align: center; color: white">o Marce</h2>
        <div class="container" style="text-align: center; font-weight: 500;font-size: 14.4px; color:white; max-width: 900px;">
            <p>
                MB Marta Banaszek marka modowa, powstała w 2017 roku. Od początku istnienia najważniejszą dla Nas wartością jest zaufanie klientek, zdobyte dzięki transparentności oraz ciężkiej pracy. Wypracowaliśmy indywidualne podejście do klientki, które stało się domeną marki MB, widoczne we wszystkich projektach. W ten sposób pracujemy na wzajemne zaufanie i budujemy długofalową relację z naszymi klientkami.
                <br><br>Dla MB Marta Banaszek transparentność to podstawa, bez której nasze projekty nie ujrzałyby światła dziennego. Transparentność, to przede wszystkim gra w „otwarte karty”, gdzie każdy klient ma możliwość śledzenia całego procesu tworzenia. To biznes wykwalifikowanych rzemieślników pracujących na miejscu w Studio i otwartych na pracę z klientem.
                <br><br>Spełniamy marzenia kobiet o kreacjach - odzwierciedlając je w naszych projektach. Niezwykle projekty ubrań, które można nosić na wielkie wydarzenia wprost na czerwony dywan, jak i w życiu codziennym. </p>

        </div>
    </div>
    <div class='container'>
        <h2 style="text-align: center; color: white;">Nasze najlepsze produkty</h2>
        <div class="row row-cols-1 row-cols-md-3 g-4 ">
            <?php
            $args = array(
                'post_type' => 'product',
                'posts_per_page' => 100,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'product_tag',
                        'terms' => 'for-partners',
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
        <h2 style="text-align: center; color: white;">Wykończenia</h2>
        <?php
        $args = array(
            'post_type' => 'attachment',
            'post_mime_type' => 'image',
            'post_status' => 'inherit',
            'posts_per_page' => 100,
            'orderby' => 'rand',
            's' => '#forpartnersfinishes',
        );
        $query_images = new WP_Query($args);
        $images = array();
        foreach ($query_images->posts as $image) {
            $images[] = $image->ID;
        }
        $gallery_shortcode = '[gallery ids="' . implode(", ", $images) . '" size="large"  link="file"]';
        echo do_shortcode($gallery_shortcode); ?>
    </div>
    <div class="container">
        <h2 style="text-align: center; color: white;" >Galeria Zdjęć</h2>
        <?php
        $args = array(
            'post_type' => 'attachment',
            'post_mime_type' => 'image',
            'post_status' => 'inherit',
            'posts_per_page' => 100,
            'orderby' => 'rand',
            's' => '#forpartnersgalery',
        );
        $query_images = new WP_Query($args);
        $images = array();
        foreach ($query_images->posts as $image) {
            $images[] = $image->ID;
        }
        $gallery_shortcode = '[gallery ids="' . implode(", ", $images) . '" size="large"  link="file"]';
        echo do_shortcode($gallery_shortcode); ?>

    </div>
    <div class='container'>
        <h2 style="text-align: center; color: white;">Kontakt</h2>

        <div style="text-align: center; font-size: 1.5rem; margin-bottom: 2rem;">
            Zapraszamy do współpracy Partnerów z Polski, jaki i zagranicy. Oferujemy atrakcyjne warunki współpracy, profesjonalną obsługę i sprawny serwis.
Zachęcamy do kontaktu poprzez poniższy formularz.
            </div>
            <div style='max-width:350px; margin: auto'><?php echo apply_shortcodes('[contact-form-7 id="65772" title="For-partners-form"]'); ?></div>
            
        

    
    </div>



</div><!-- #primary -->

<?php
get_footer('shop');
