<?php

wp_enqueue_style('stylebook_page', get_stylesheet_directory_uri() . '/assets/css/stylebook_page.css');

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main" data-aos="fade-right" data-aos-duration="1000" data-aos-anchor-placement="top-center">
        <!-- Here Comes a PAGE -->
        <div class="landing-background-top">
            <div class="container">
                <div class="row">
                    <div class="col-0 col-md-7 lending-empty ">
                    </div>
                    <div id=landing-top-text class="col-12 col-md-4">
                        <h2><strong>Mam dla Ciebie Prezent!</strong></h2>
                        <p>Odbierz <strong>bezpłatny StyleBook,</strong> w którym pokażę Ci jak krok po kroku stworzysz swoją wymarzoną garderobę i odnajdziesz swój niepowtarzalny styl.</p>
                        <a href="#landing-form-block">
                            <button class="landing-button"><span class="icon"></span>Odbierz</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div id='landing-form-block' class="container landing-background-bottom ">
            <div class="row justify-content-between" style='margin-top: 5%;'>
                <div class="col-12 col-md-4 order-2 order-md-1">
                    <h3><strong>Wpisz adres e-mail,<br>na który ma zostać wysłany<br>
                            StyleBook</strong></h3>
                    <?php echo apply_shortcodes('[contact-form-7 id="65695" title="Landing-stylebook-form"]'); ?>
                    <p style="font-size: 12.8px;
font-weight: 300;">Informacja o przetwarzaniu danych osobowych. Będziemy przetwarzać Pani/Pana (lub Państwa) dane osobowe w celu utrzymania relacji z klientem</p>
                </div>
                <div class="col-12 col-md-7 order-1 order-md-2">
                    <img style='' src="<? echo get_stylesheet_directory_uri() ?>/img/landing/tablet.png">
                </div>
            </div>
        </div>
        <!-- END PAGE -->
    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
