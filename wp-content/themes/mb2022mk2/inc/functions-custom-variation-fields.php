<?php
// Adding price option to product variations
add_action('woocommerce_variation_options_pricing', 'custom_variation_price_fields', 10, 3);
function custom_variation_price_fields($loop, $variation_data, $variation)
{
    woocommerce_wp_text_input(
        array(
            'id' => 'variable_minimum_price-pln[' . $loop . ']',
            'type' => 'number',
            'label' => 'Cena minimalna(zł)',
            'wrapper_class' => 'form-row form-row-first',
            'placeholder' => '',
            'desc_tip' => false,
            'description' => '',
            'value' => get_post_meta($variation->ID, 'minimum-price-pln', true)
        )
    );

    woocommerce_wp_text_input(
        array(
            'id' => 'variable_minimum_price-eur[' . $loop . ']',
            'type' => 'number',
            'label' => 'Cena minimalna(€)',
            'wrapper_class' => 'form-row form-row-first',
            'placeholder' => '',
            'desc_tip' => false,
            'description' => '',
            'value' => get_post_meta($variation->ID, 'minimum-price-eur', true)
        )
    );

    woocommerce_wp_text_input(
        array(
            'id' => 'variable_ciriana_regular_price[' . $loop . ']',
            'type' => 'number',
            'label' => 'Cena regularna CIRIANA(€)',
            'wrapper_class' => 'form-row form-row-first',
            'placeholder' => '',
            'desc_tip' => false,
            'description' => '',
            'value' => get_post_meta($variation->ID, 'ciriana-regular-price', true)
        )
    );

    woocommerce_wp_text_input(
        array(
            'id' => 'variable_ciriana_wholesale_price[' . $loop . ']',
            'type' => 'number',
            'label' => 'Cena hurtowa CIRIANA(€)',
            'wrapper_class' => 'form-row form-row-first',
            'placeholder' => '',
            'desc_tip' => false,
            'description' => '',
            'value' => get_post_meta($variation->ID, 'ciriana-wholesale-price', true)
        )
    );
}

// Save price option product variations
add_action('woocommerce_save_product_variation', 'custom_variation_price_fields_save', 10, 2);
function custom_variation_price_fields_save($variation_id, $loop)
{

// Cena minimalna PLN
    $text_field = !empty($_POST['variable_minimum_price-pln'][$loop]) ? $_POST['variable_minimum_price-pln'][$loop] : '';
    update_post_meta($variation_id, 'minimum-price-pln', sanitize_text_field($text_field));

// Cena minimalna EUR
    $text_field = !empty($_POST['variable_minimum_price-eur'][$loop]) ? $_POST['variable_minimum_price-eur'][$loop] : '';
    update_post_meta($variation_id, 'minimum-price-eur', sanitize_text_field($text_field));

// Cena regularna CIRIANA(€)
    $text_field = !empty($_POST['variable_ciriana_regular_price'][$loop]) ? $_POST['variable_ciriana_regular_price'][$loop] : '';
    update_post_meta($variation_id, 'ciriana-regular-price', sanitize_text_field($text_field));

// Cena hurtowa CIRIANA(€)
    $text_field = !empty($_POST['variable_ciriana_wholesale_price'][$loop]) ? $_POST['variable_ciriana_wholesale_price'][$loop] : '';
    update_post_meta($variation_id, 'ciriana-wholesale-price', sanitize_text_field($text_field));
}