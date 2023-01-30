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

// Ensure visibility.

 ?>
 <div class="col">
<div class='card' id='<?php the_ID(); ?>'>
    <div class="card-header">
    <img src="<?php the_post_thumbnail_url();?>" class="card-img-top" alt="..." style="object-fit: cover;
aspect-ratio: 1/1.5;">
    </div>
    <div class="card-body">
        <h5 class='card-title' style='height: 5rem; font-weight:600; padding-top: 1rem; padding-bottom: 1em;'>
            <?php the_title(); ?>
        </h5>
        <div class='card-text' style="height: 150px; overflow: auto; color: black"><?php woocommerce_template_single_excerpt(); ?></div>

    <?php 
        // Use this in futute to create modal product galery
        $attimages = get_attached_media('image', $product->ID);
        foreach ($attimages as $image) {
         wp_get_attachment_url($image->ID) . '<br>';
        }
    ?>

    </div>
    <?php

    /**
     * Hook: woocommerce_before_shop_loop_item.
     *
     * @hooked woocommerce_template_loop_product_link_open - 10
     */
    //do_action('woocommerce_before_shop_loop_item'); // Link to product


    /**
     * Hook: woocommerce_before_shop_loop_item_title.
     *
     * @hooked woocommerce_show_product_loop_sale_flash - 10
     * @hooked woocommerce_template_loop_product_thumbnail - 10
     */
    //do_action('woocommerce_before_shop_loop_item_title'); // Product immage

    /**
     * Hook: woocommerce_shop_loop_item_title.
     *
     * @hooked woocommerce_template_loop_product_title - 10
     */
    //do_action('woocommerce_shop_loop_item_title'); // Product title

    /**
     * Hook: woocommerce_after_shop_loop_item_title.
     *
     * @hooked woocommerce_template_loop_rating - 5
     * @hooked woocommerce_template_loop_price - 10
     */
    //do_action('woocommerce_after_shop_loop_item_title'); // Product price

    /**
     * Hook: woocommerce_after_shop_loop_item.
     *
     * @hooked woocommerce_template_loop_product_link_close - 5
     * @hooked woocommerce_template_loop_add_to_cart - 10
     */
    //do_action('woocommerce_after_shop_loop_item');

    ?>
</div>
</div>