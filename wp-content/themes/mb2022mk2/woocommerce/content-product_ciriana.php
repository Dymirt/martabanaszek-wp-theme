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


// Ensure visibility.

?>
<div class="col">
    <div class='card' id='<?php the_ID(); ?>'>
        <div class="card-header">
            <div id="carousel-<?php the_ID(); ?>" class="carousel slide">
                <div class="carousel-indicators">
                    <?php
                    for ($i = 0; $i <= count($attimages); ++$i) {
                        if ($i == 0) { ?>
                            <button type="button"
                                    data-bs-target="#carousel-<?php the_ID(); ?>"
                                    data-bs-slide-to="<?php echo $i; ?>"
                                    class="active"
                                    aria-current="true"
                                    aria-label="Slide <?php echo $i + 1; ?>"></button>
                        <?php } else { ?>
                            <button type="button"
                                    data-bs-target="#carousel-<?php the_ID(); ?>"
                                    data-bs-slide-to="<?php echo $i; ?>"
                                    aria-label="Slide <?php echo $i + 1; ?>"></button>
                        <?php } ?>
                    <?php } ?>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="<?php the_post_thumbnail_url(); ?>" class="card-img-top" alt="...">
                    </div>
                    <?php
                    foreach ($attimages as $image) { ?>
                        <div class="carousel-item">
                            <img src="<?php echo wp_get_attachment_url($image->ID); ?>" class="card-img-top" alt="...">
                        </div>
                    <?php }
                    ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carousel-<?php the_ID(); ?>"
                        data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carousel-<?php the_ID(); ?>"
                        data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <div class="card-body">
            <h5 class='card-title' style='height: 5rem; font-weight:600; padding-top: 1rem; padding-bottom: 1em;'>
                <?php the_title(); ?>
            </h5>
            <div class='card-text'
                 style="height: 150px; overflow: auto; color: black"><?php woocommerce_template_single_excerpt(); ?></div>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-4">
                    <h6>Nasza cena:</h6>
                    <span class="badge text-bg-dark"><?php do_action('woocommerce_after_shop_loop_item_title'); ?></span>
                </div>
                <div class="col-8">
                    <h6>Proponowana cena:</h6>
                    <div id="priceform-<?php the_ID(); ?>">
                        <form class="input-group input-group-sm mb-3"
                              onsubmit="savePriceProposal(<?php the_ID(); ?>,'<?php echo get_permalink();?>', '<?php echo get_woocommerce_currency_symbol() ?>', this['price-offer'].value); return false">
                            <input type="number" name="price-offer" min="1" class="form-control"
                                   value="<?php echo wc_get_price_to_display($product) ?>">
                            <span class="input-group-text"><?php echo get_woocommerce_currency_symbol() ?></span>
                            <button class="btn btn-outline-dark">Zapisz</button>
                            <a id='<?php the_ID(); ?>-sendButton' class="btn btn-outline-success" style="display: none">Wyślij</a>
                        </form>
                    </div>
                </div>
            </div>
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