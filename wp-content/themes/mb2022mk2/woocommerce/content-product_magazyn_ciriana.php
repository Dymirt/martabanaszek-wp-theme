<?php

/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined('ABSPATH') || exit;

global $product;
$attimages = get_attached_media('image', $product->ID);
$variations = $product->get_available_variations();
$ciriana_variations = [];

foreach ($variations as $i => $variation){
    if (get_post_meta( $variation['variation_id'], 'ciriana-stock-quantity', true ) > 0):
        $ciriana_variations[] = $variation;
    endif;
}
$variations = $ciriana_variations;

if (count($ciriana_variations) > 0 ):
    ?>
    <tr>
        <td><img src="<?php the_post_thumbnail_url(); ?>" style="width: 100%;"></td>
        <td><a href="<?php
            echo get_admin_url();
            echo 'post.php?post=';
            echo the_ID();
            echo '&action=edit'; ?>"><?php the_title(); ?></a></td>
        <?php if (count($variations) > 0 ) { ?>
            <td>
            <table class="variations_table">
                <thead>
                <tr>
                    <th>Opis wariantu</th>
                    <th>Ilość</th>
                    <th>Cena min.(zł)</th>
                    <th>Cena w sklepie(zł)</th>
                </tr>
                </thead>
                <?php

                foreach ($variations as $i => $variation){
                    $variation_o = new WC_Product_Variation( $variation['variation_id'] );
                    $variation_stock = get_post_meta($variation['variation_id'], 'ciriana-stock-quantity', true);
                    $minimum_price_pln = get_post_meta( $variation['variation_id'], 'minimum-price-pln', true );
                    echo "<tr>
                            <td>" . $variation_o->get_attribute_summary() . "</td>                            <td>" . $variation_stock . "</td>
                            <td>" . $minimum_price_pln . "</td>
                            <td>" . $variation_o->get_display_price() . "</td>   
                          </tr>";
                }
                ?>
            </table>
            </td><?php } ?>

    </tr>

<?php endif;


