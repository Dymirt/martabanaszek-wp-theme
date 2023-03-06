<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package storefront
 */

?>

</div><!-- .col-full -->
</div><!-- #content -->

<?php do_action('storefront_before_footer'); ?>

<footer id="colophon" class="site-footer black" role="contentinfo">
    <?php if(!is_page('ciriana') || is_page('ciriana-instock')):?>
        <div class="col-full logo">
            <?php //storefront_site_title_or_logo(); ?>
            <a href="<?php echo get_site_url(); ?>" class="custom-logo-link" rel="home"><img width="276" height="67"
                                                                                             src="/wp-content/uploads/2021/12/cropped-logo_final_poziom_white.png"
                                                                                             class="custom-logo"
                                                                                             alt="Marta Banaszek"></a>
        </div>
        <div class="col-full menu">

            <?php
            /**
             * Functions hooked in to storefront_footer action
             *
             * @hooked storefront_footer_widgets - 10
             * @hooked storefront_credit         - 20
             */
            //do_action( 'storefront_footer' );

            wp_nav_menu(
                array(
                    'theme_location' => 'footer_menu',
                    'container_class' => 'footer-navigation',
                )
            );
            ?>
        </div><!-- .col-full -->
        <div class="col-full icons">
            <?php
            wp_nav_menu(
                array(
                    'theme_location' => 'footer_icon_menu',
                    'container_class' => 'footer-icon-navigation',
                    'menu_class' => "icon-list"
                )
            );
            ?>
        </div>
    <?php endif;?>

    <div class="col-full copyright">
        <p class="">&copy; 2020 Marta Banaszek</p>
        <p class="d-none d-sm-block">|</p>
        <div class="policy">
            <p class="text"><a href="/regulamin">Regulamin</a></p> |
            <p class="text"><a href="/polityka-prywatnosci">Polityka prywatnośći</a></p> |
            <p><a id="newsletterButton" class="link"> Newsletter</a></p>
            <p>|</p>
            <p class="text">Wszelkie prawa zastrzeżone</p>
        </div>
    </div>
    <div class="back-to-top"><i class="fas fa-arrow-up"></i></div>
    <div id="ebook-link" class="ebook">
        <a class="ebook-link" href="<?php echo get_site_url() ?>/landing-stylebook/">
            <img class="ebook-bg" src="<?php echo get_stylesheet_directory_uri() ?>/img/btn_mobile_2_1.png"/>
        </a>
    </div>
    <div id="cookies-info" class="cookies">
        <p>Strona korzysta z plików cookie.</p>
        <a onclick="cookiesAlertInfo()"><i class="fas fa-info-circle cookies-more-info"></i></a>
        <a onclick="cookiesClose()"><i class="fas fa-times-circle cookies-close"></i></a>
    </div>
</footer><!-- #colophon -->

<?php if (!is_front_page() && !is_page_template('template-for_partners.php' )):?>
    <div id="newsletterModal" class="modal">
        <div class="modal-content newsletter">
            <?php get_template_part('template-parts/newsletter', 'popup'); ?>
        </div>
    </div>
<?php endif; ?>


<?php if (is_product()):?>
<div id="sizeTableModal" class="modal">
    <div class="modal-content">
        <?php get_template_part('template-parts/product-size-table'); ?>
    </div>
</div>
<?php endif; ?>

<?php do_action('storefront_after_footer'); ?>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
