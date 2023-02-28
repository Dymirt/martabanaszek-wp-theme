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
$variations_id = $product->get_children();

$variations = $product->get_available_variations();
if (count($variations) > 0) {
    $minimum_price_pln = get_post_meta($variations[0]['variation_id'], 'minimum-price-pln', true);
} else {
    $minimum_price_pln = 0;
}


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
                 style="height: 150px; overflow: auto; color: black">
                <?php woocommerce_template_single_excerpt();
                if (is_page( 'ciriana-instock' )){
                    ?><strong>Dostępne rozmiary i warianty:<br></strong><?php
                    foreach ($variations_id as $variation_id) {
                        $variation_o = new WC_Product_Variation($variation_id);
                        $variation_stock = $variation_o->get_stock_quantity();
                        if ($variation_stock > 0) {
                            echo $variation_o->get_attribute_summary() . " (" . $variation_stock . "szt.)<br>";
                        }
                    }
                }
                ?>
            </div>
        </div>
        <?php
         if (is_page('ciriana') || is_page('ciriana-instock')){?>
             <div class="card-footer">
                 <div class="row">
                     <div class="col-5" style="padding-right: 0">
                         <h6>Nasza cena:</h6>
                         <span class="badge text-bg-dark">
                        <?php
                        if (is_page('ciriana')){
                            echo $minimum_price_pln; ?>.00 zł<?php
                        } else {
                            do_action('woocommerce_after_shop_loop_item_title');
                        }
                        ?>
                    </span>
                     </div>
                     <div class="col-7" style="padding-left: 0">
                         <h6>Proponowana cena:</h6>
                         <div id="priceform-<?php the_ID(); ?>">
                             <form class="input-group input-group-sm mb-3" onsubmit="savePriceProposal(<?php the_ID(); ?>,'<?php echo get_permalink(); ?>', '<?php echo get_woocommerce_currency_symbol() ?>', this['price-offer'].value); return false">
                                 <input type="number"
                                        name="price-offer"
                                        min="1"
                                        class="form-control"
                                        value="<?php
                                        if (is_page('ciriana')){
                                            echo $minimum_price_pln;
                                        } else {
                                            echo wc_get_price_to_display($product);
                                        }
                                        ?>">
                                 <span class="input-group-text"><?php echo get_woocommerce_currency_symbol() ?></span>
                                 <button class="btn btn-outline-dark">Zapisz</button>
                                 <a id='<?php the_ID(); ?>-sendButton' class="btn btn-outline-success" style="display: none">Wyślij</a>
                             </form>
                         </div>
                     </div>
                 </div>
             </div>
         <?php } ?>
    </div>
</div>