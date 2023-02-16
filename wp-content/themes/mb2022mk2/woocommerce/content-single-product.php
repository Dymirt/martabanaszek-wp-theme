<?php
/**
 * The template for displaying product content in the single-product.php template
 */

defined('ABSPATH') || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action('woocommerce_before_single_product');

if (post_password_required()) {
    echo get_the_password_form(); // WPCS: XSS ok.
    return;
}

$attimages = get_attached_media('image', $product->ID);

?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class('', $product); ?>>

    <div class="details">

            <?php
            /**
             * Hook: woocommerce_before_single_product_summary.
             *
             * @hooked woocommerce_show_product_sale_flash - 10
             * @hooked woocommerce_show_product_images - 20
             */
            //do_action( 'woocommerce_before_single_product_summary' );
            ?>
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

        <div class="product-summary">

                <?php
                /**
                 * Hook: woocommerce_single_product_summary.
                 *
                 * @hooked woocommerce_template_single_title - 5
                 * @hooked woocommerce_template_single_rating - 10
                 * @hooked woocommerce_template_single_price - 10
                 * @hooked woocommerce_template_single_excerpt - 20
                 * @hooked woocommerce_template_single_add_to_cart - 30
                 * @hooked woocommerce_template_single_meta - 40
                 * @hooked woocommerce_template_single_sharing - 50
                 * @hooked WC_Structured_Data::generate_product_data() - 60
                 */
                do_action('woocommerce_single_product_summary');
                ?>

        </div>
    </div>

    <?php
    /**
     * Hook: woocommerce_after_single_product_summary.
     *
     * @hooked woocommerce_output_product_data_tabs - 10
     * @hooked woocommerce_upsell_display - 15
     * @hooked woocommerce_output_related_products - 20
     */
    do_action('woocommerce_after_single_product_summary');
    ?>
</div>

<?php //do_action('woocommerce_after_single_product'); ?>
