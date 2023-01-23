<?php
/**
 * Variable product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/variable.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.5
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
	}
	//echo('test');
	global $product;
	// get arr as varition id - value and vaiation attr name - key
	$product_variations_arr = $product->get_available_variations();
	//var_dump($product_variations_arr);
	$varitions_id_value_arr = [];
	foreach ($product_variations_arr as $variation_arr) {
		$varitions_id_value_arr[ current( $variation_arr['attributes'] ) ] = $variation_arr['variation_id'];
	}
	
	$attribute_keys = array_keys( $attributes );
	
	do_action( 'woocommerce_before_add_to_cart_form' ); ?>
	
	<?php
	
	function print_attribute_radio($checked_value, $value, $label, $name, $varitions_id_value_arr)
	{
		$checked = sanitize_title($checked_value) === $checked_value ? checked($checked_value, sanitize_title($value) , false) : checked($checked_value, $value, false);
		$input_name = 'attribute_' . esc_attr($name);
		$esc_value = esc_attr($value);
		$id = esc_attr($name . '_v_' . $value);
		$filtered_label = apply_filters('woocommerce_variation_option_name', $label);
		printf('<div><input type="radio" data-variation-id="%6$s" data-attribute-name="%1$s" name="%1$s" value="%2$s" id="%3$s" %4$s><label for="%3$s">%5$s</label></div>', $input_name, $esc_value, $id, $checked, $filtered_label, $varitions_id_value_arr[$value]);
	}
	
	
	?>
	<form class="variations_form cart" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->get_id() ); ?>" data-product_variations="<?php echo htmlspecialchars( wp_json_encode( $available_variations ) ) ?>">
		<?php do_action( 'woocommerce_before_variations_form' ); ?>
	
		<?php if ( empty( $available_variations ) && false !== $available_variations ) : ?>
			<p class="stock out-of-stock"><?php _e( 'This product is currently out of stock and unavailable.', 'woocommerce' ); ?></p>
		<?php else : ?>
		<?php foreach ( $attributes as $attribute_name => $options ) : 
	
			if (sanitize_title($attribute_name) == 'pa_rozmiar'):
				$sanitized_name = sanitize_title($attribute_name);
				if (isset($_REQUEST['attribute_' . $sanitized_name])) {
					$checked_value = $_REQUEST['attribute_' . $sanitized_name];
				}
				elseif (isset($selected_attributes[$sanitized_name])) {
					$checked_value = $selected_attributes[$sanitized_name];
				}
				else {
					$checked_value = '';
				}
	
				?>
				<h3>Choose Your Size</h3>
				<ul class="product-size">
					<?php
						foreach($options as $option) {
							echo '<li class="size">';
							print_attribute_radio($checked_value, $option, $option, $sanitized_name, $varitions_id_value_arr);
							echo '</li>';
						}
					?>
				</ul>
	
				<input type="hidden" name="attribute_pa_rozmiar" value="">
	
				<script type="text/javascript">
					jQuery('.product-size > li').click(function(e) {
						jQuery('.product-size > li').removeClass('size-selected');
						jQuery(this).addClass('size-selected');
						var option_id = jQuery(this).find("input").attr("checked", true);
	
						var variation_value = jQuery(this).find("input").attr("checked", true).val();
						var variation_id = jQuery(this).find("input").attr("checked", true).attr('data-variation-id')
	
						// set choosen variation in hiden inputs
						jQuery('input[name=variation_id]').val( variation_id );
						jQuery('input[name=attribute_pa_rozmiar]').val( variation_value );
					 });
				</script>
			<?php endif; ?>
			<table class="variations" cellspacing="0">
				<tbody>
	
						<tr>
							<td class="label"><label for="<?php echo sanitize_title( $attribute_name ); ?>"><?php echo wc_attribute_label( $attribute_name ); ?></label></td>
							<td class="value">
								<?php
									//$selected = isset( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) ? wc_clean( stripslashes( urldecode( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) ) ) : $product->get_variation_default_attribute( $attribute_name );
									//wc_dropdown_variation_attribute_options( array( 'options' => $options, 'attribute' => $attribute_name, 'product' => $product, 'selected' => $selected ) );
									//echo end( $attribute_keys ) === $attribute_name ? apply_filters( 'woocommerce_reset_variations_link', '<a class="reset_variations" href="#">' . esc_html__( 'Clear', 'woocommerce' ) . '</a>' ) : '';
								?>
							</td>
						</tr>
					<?php endforeach;?>
				</tbody>
			</table>
	
			<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
	
			<div class="single_variation_wrap">
				<?php
					/**
					 * woocommerce_before_single_variation Hook.
					 */
					do_action( 'woocommerce_before_single_variation' );
	
					/**
					 * woocommerce_single_variation hook. Used to output the cart button and placeholder for variation data.
					 * @since 2.4.0
					 * @hooked woocommerce_single_variation - 10 Empty div for variation data.
					 * @hooked woocommerce_single_variation_add_to_cart_button - 20 Qty and cart button.
					 */
					do_action( 'woocommerce_single_variation' );
	
					/**
					 * woocommerce_after_single_variation Hook.
					 */
					do_action( 'woocommerce_after_single_variation' );
				?>
			</div>
	
			<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
		<?php endif; ?>
	
		<?php do_action( 'woocommerce_after_variations_form' ); ?>
	</form>
	
	<?php
	do_action( 'woocommerce_after_add_to_cart_form' );