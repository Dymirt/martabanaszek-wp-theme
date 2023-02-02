<?php

/**
 * The header for our theme.
 *
 * Displays all the <head> section and everything up till <div id="content">
 *
 * @package mb2023
 */

?>
    <!doctype html>
<html <?php language_attributes(); ?>>

    <head>


        <!-- Google Tag Manager -->
        <script>
            (function (w, d, s, l, i) {
                w[l] = w[l] || [];
                w[l].push({
                    'gtm.start': new Date().getTime(),
                    event: 'gtm.js'
                });
                var f = d.getElementsByTagName(s)[0],
                    j = d.createElement(s),
                    dl = l != 'dataLayer' ? '&l=' + l : '';
                j.async = true;
                j.src =
                    'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
                f.parentNode.insertBefore(j, f);
            })(window, document, 'script', 'dataLayer', 'GTM-NJDTS87');
        </script>
        <!-- End Google Tag Manager -->

        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-145492556-5"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }

            gtag('js', new Date());

            gtag('config', 'UA-145492556-5');
        </script>
        <!-- End Global site tag (gtag.js) - Google Analytics -->

        <meta charset="<?php bloginfo('charset'); ?>">

        <!-- Bootstrap 5.2 -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
              integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
              crossorigin="anonymous">
        <!-- End Bootstrap  -->

        <!-- XFN 1.1 relationships meta data profile -->
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <!-- End XFN 1.1 relationships meta data profile -->

        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

        <!--  Animate On Scroll -->
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <!-- End Animate On Scroll -->


        <!-- Font Awesome -->
        <link rel="stylesheet"
              href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- End Font Awesome -->

        <link href="https://fonts.cdnfonts.com/css/barlow" rel="stylesheet">

        <?php wp_head(); ?>
    </head>

<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

    <!-- Google Tag Manager (noscript) -->
    <noscript>
        <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NJDTS87" height="0" width="0"
                style="display:none;visibility:hidden"></iframe>
    </noscript>
    <!-- End Google Tag Manager (noscript) -->

<?php do_action('storefront_before_site'); ?>

<div id="page" class="hfeed site">
<?php do_action('storefront_before_header'); ?>

    <header id="masthead" class="site-header black" role="banner" style="<?php storefront_header_styles(); ?>">

        <?php
        /**
         * Functions hooked into storefront_header action
         *
         * @hooked storefront_header_container                 - 0
         * @hooked storefront_skip_links                       - 5
         * @hooked storefront_social_icons                     - 10
         * @hooked storefront_site_branding                    - 20
         * @hooked storefront_secondary_navigation             - 30
         * @hooked storefront_product_search                   - 40
         * @hooked storefront_header_container_close           - 41
         * @hooked storefront_primary_navigation_wrapper       - 42
         * @hooked storefront_primary_navigation               - 50
         * @hooked storefront_header_cart                      - 60
         * @hooked storefront_primary_navigation_wrapper_close - 68
         */
        //do_action( 'storefront_header' );

        //hamburgermenu

        //logo

        //language switcher
        //favourites
        //cart
        //facebook
        //instagram
        ?>

        <div class="header-row">
            <div class="header-col"></div>
            <div class="header-col" style="height: auto">
                <?php //storefront_site_title_or_logo();
                ?>
                <a href="" class="custom-logo-link " rel="home" style="display: grid; margin-top: 10px;">
                    <img width="276"
                         src="/wp-content/themes/mb2022mk2/assets/img/ciriana/ciriana_logo_biale.png"
                         class="custom-logo"
                         alt="Marta Banaszek"
                         style="height: auto; margin: 0">
                    <div class="row" id="bymarta">
                        <div class="col-2" style="padding: 0; width: 22px; font-size: 10px;">by</div>
                        <div class="col-10" style="padding: 0;">
                            <img src="/wp-content/themes/mb2022mk2/assets/img/ciriana/logo-białe-marta-banaszek.png"
                                 style="height: auto; margin: 0">
                        </div>
                    </div>
                </a>

            </div>
            <div class="header-col">
            </div>
        </div>
    </header><!-- #masthead -->

<?php
/**
 * Functions hooked in to storefront_before_content
 *
 * @hooked storefront_header_widget_region - 10
 * @hooked woocommerce_breadcrumb - 10
 */
//do_action( 'storefront_before_content' );
?>

    <div id="content" class="site-content" tabindex="-1">
        <div class="col-full no-margin">

<?php
do_action('storefront_content_top');
