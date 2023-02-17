<?php
/**
 * The template for displaying cart page.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 */

get_header(); ?>

                <?php
                /**
                 * Functions hooked in to storefront_page add_action
                 *
                 * @hooked storefront_page_header          - 10
                 * @hooked storefront_page_content         - 20
                 */
                remove_action('storefront_page', 'storefront_page_header', 10);
                do_action( 'storefront_page' );
                ?>
<script>
    /*const shipping = document.getElementsByClassName('woocommerce-shipping-totals')[0].getElementsByTagName('td')[0];
    shipping.innerHTML = 'Od 0 zł';

    const cart_subtotal = document.getElementsByClassName('cart-subtotal')[0].getElementsByTagName('bdi')[0];
    const order_total = document.getElementsByClassName('order-total')[0].getElementsByTagName('bdi')[0];

    const cart_subtotal_value = parseFloat(cart_subtotal.innerText.replaceAll(' ', ''));
    const order_total_value = parseFloat(order_total.innerText.replaceAll(' ', ''));

    const shipping_value = order_total_value - cart_subtotal_value;
    shipping.innerHTML = `<bdi>${shipping_value}<span class="woocommerce-Price-currencySymbol"> zł</span></bdi>`*/

</script>
<?php
get_footer();
