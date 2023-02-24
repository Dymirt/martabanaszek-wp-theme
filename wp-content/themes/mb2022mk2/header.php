<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 */

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <!-- Google Tag Manager -->
    <script>(function (w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start':
                    new Date().getTime(), event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-NJDTS87');</script>
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
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2.0">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

    <!-- AOS performance issue
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    -->
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

<!-- Google Tag Manager (noscript) -->
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NJDTS87"
            height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) -->


<div id="page" class="hfeed site">
    <header id="masthead" class="site-header black" role="banner">
        <div class="header-row">
            <div class="header-col">
                <span class="toggle-button left">
                    <div class="menu-bar menu-bar-top"></div>
                    <div class="menu-bar menu-bar-middle"></div>
                    <div class="menu-bar menu-bar-bottom"></div>
                </span>
                <?php do_action('menu_hidden'); ?>
            </div>
            <div class="header-col">
                <?php
                global $post;
                $page_name = $post->post_name;
                if ($page_name == 'ciriana' || $page_name == 'ciriana-instock'){
                    get_template_part('template-parts/header/content', 'ciriana_by_mb');
                } else {
                    get_template_part('template-parts/header/content', 'mb');
                }
                ?>
            </div>
            <div class="header-col">
                <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'secondary',
                        'container_class' => 'secondary-navigation',
                        'menu_class' => 'icon-list'
                    )
                );
                ?>
            </div>
        </div>

    </header><!-- #masthead -->

    <div id="content" class="site-content" tabindex="-1">
        <div class="col-full no-margin">
