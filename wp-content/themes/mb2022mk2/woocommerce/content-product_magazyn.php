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


// Ensure visibility.

?>

        <?php
        #foreach ($variations as $variation => $val){
        #    $variation_o = new WC_Product_Variation( $val['variation_id'] );
        #    $variation_stock = $variation_o->get_stock_quantity();
        #    echo "$variation_stock <br>";
        #}
        ?>


    <tr>
        <td><img src="<?php the_post_thumbnail_url(); ?>" class="" style="width: 100px; height: 150px; object-fit: cover"></td>
        <td><a href="<?php
            echo get_admin_url();
            echo 'post.php?post=';
            echo the_ID();
            echo '&action=edit'; ?>"><?php the_title(); ?></a></td>
        <td class="<?php echo $product -> stock_status;?>"><?php echo $product -> stock_status;?></td>
        <?php if (count($variations) > 0 ) { ?>
        <td>
            <table style="width: 100%">
                <thead>
                    <tr>
                        <th style="width: 180px;">Opis wariantu</th>
                        <th>Ilość</th>
                        <th>Cena min.(zł)</th>
                        <th>Cena w sklepie(zł)</th>
                    </tr>
                </thead>
                <?php

                foreach ($variations as $i => $variation){
                        $variation_o = new WC_Product_Variation( $variation['variation_id'] );
                        $variation_stock = $variation_o->get_stock_quantity();
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


