<?php
/**  */

require get_stylesheet_directory() . '/inc/functions-custom-variation-fields.php'; // Custom product variations meta
require get_stylesheet_directory() . '/inc/functions-admin.php'; // Admin functions (Magazyn)
require get_stylesheet_directory() . '/inc/functions-filter.php';
require get_stylesheet_directory() . '/inc/widgets/functions-recently-viewed.php';
require get_stylesheet_directory() . '/inc/functions-cpt.php';
require get_stylesheet_directory() . '/inc/functions-partners-cpt.php';

function my_theme_enqueue_styles()
{
    if (!is_front_page()){
        $parent_style = 'parent-style'; // Storefront styles
        wp_enqueue_style($parent_style, get_template_directory_uri() . '/style.css');
        wp_enqueue_style('jquery-ui', get_stylesheet_directory_uri() . '/js/jquery-ui.min.css');
    }

    wp_enqueue_style('bootstrap', "https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css", array(), '5.3.0');
    wp_enqueue_style('child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array($parent_style, 'bootstrap'),
        wp_get_theme()->get('Version')
    );
}

add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');

function load_custom_scripts()
{
    if (is_front_page()){
        wp_enqueue_script('front-page-lazy-load-video', get_stylesheet_directory_uri() . '/assets/js/front_page_lazy_load_video.js', array(), '', true);
    }

    wp_register_script('custom_scripts', get_stylesheet_directory_uri() . '/js/mb2020_scripts.js', array(), date("YmdHi", filemtime(get_stylesheet_directory() . '/js/mb2020_scripts.js')), );
    wp_register_script('fontawesome', 'https://kit.fontawesome.com/7a0bc25598.js', array(), '', true);

    wp_enqueue_script('imagesLoaded', 'https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.min.js', array(),'', true);
    wp_enqueue_script('martabanaszek_main_theme', get_stylesheet_directory_uri() . '/assets/js/main.js', array(), '1.0', true);
    wp_enqueue_script('bootstrap_bundle', "https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js", array(), '5.3.0', true);

    //if(!is_user_logged_in()){
    wp_enqueue_script('custom_scripts');
    wp_enqueue_script('fontawesome');

    //}

}

add_action('wp_enqueue_scripts', 'load_custom_scripts');

function martabanaszek_dequeue_styles(){
    if (is_front_page()) {

        wp_dequeue_style('wc-blocks-style');
        wp_dequeue_style('wp-block-library');
        wp_dequeue_style('storefront-gutenberg-blocks');
        wp_dequeue_style('wc-price-based-country-frontend');
        wp_dequeue_style('contact-form-7');
        wp_dequeue_style('storefront-jetpack-widgets');
        //wp_dequeue_style('storefront-style');
        //wp_dequeue_style('storefront-woocommerce-style');

        wp_dequeue_script('wc-price-based-country-ajax-geo');
        wp_dequeue_script('contact-form-7');
        wp_dequeue_script('wpcf7-recaptcha');


        // Inpost enqueue styles with priority 75
        wp_dequeue_style('easypack-front');
        wp_dequeue_style('geowidget-4.5-css');
        wp_dequeue_script('inpost-sdk-for-javascript');

    }
    if (is_page_template('template-for_partners.php' )):

        // Inpost enqueue styles with priority 75
        wp_dequeue_style('easypack-front');
        wp_dequeue_style('geowidget-4.5-css');
        wp_dequeue_script('inpost-sdk-for-javascript');

    endif;

    wp_dequeue_script('imagesLoaded'); // Very long response
}
add_action('wp_enqueue_scripts', 'martabanaszek_dequeue_styles', 999);


function masonry_load()
{
    if (is_home()) {
        wp_enqueue_script('masonry', 'https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js', ['jquery', 'imagesLoaded']);
    }
}

add_action('wp_enqueue_scripts', 'masonry_load');

function masonry_init()
{
    if (is_home()) {
        $cache_buster = date("YmdHi", filemtime(get_stylesheet_directory() . '/js/masonry_init.js'));
        wp_enqueue_script('masonry_init', '/wp-content/themes/MB2020/js/masonry_init.js', ['jquery', 'masonry', 'imagesLoaded'], $cache_buster);
        clearstatcache();
    }
}

add_action('wp_enqueue_scripts', 'masonry_init', 11);


// Load translation files from your child theme instead of the parent theme
function MB2020_locale()
{
    load_child_theme_textdomain('MB2020', get_stylesheet_directory() . '/languages');
}

//add_action('after_setup_theme', 'MB2020_locale');

add_filter('woocommerce_get_availability_text', 'customizing_stock_availability_text', 1, 2);
function customizing_stock_availability_text($availability, $product)
{
    if (!$product->is_in_stock()) {
        $availability = __('Out of stock', 'woocommerce');
    } elseif ($product->managing_stock() && $product->is_on_backorder(1)) {
        $availability = $product->backorders_require_notification() ? __('Available on backorder. <br> Your order will be ready in up to 30 work days.', 'MB2020') : '';
    } elseif ($product->managing_stock()) {
        $availability = wc_format_stock_for_display($product);
    } else {
        $availability = '';
    }

    return $availability;
}

add_action('template_redirect', 'define_default_payment_gateway');
function define_default_payment_gateway()
{
    if (is_checkout() && !is_wc_endpoint_url()) {
        // HERE define the default payment gateway ID
        $default_payment_id = 'transferuj';

        WC()->session->set('chosen_payment_method', $default_payment_id);
    }
}

/**
 * Remove description field from product editing
 */
function remove_product_editor()
{
    remove_post_type_support('product', 'editor');
}
add_action('init', 'remove_product_editor');

/**
 * Show cart contents / total Ajax
 */

function woocommerce_header_add_to_cart_fragment($fragments)
{
    global $woocommerce;

    ob_start();
    if ($woocommerce->cart->cart_contents_count > 0) {
        echo('<span class="cart-total-count" style="background: red">' . $woocommerce->cart->cart_contents_count . '</span>');
    }
    ?>
    <?php
    $fragments['span.cart-total-count'] = ob_get_clean();
    return $fragments;
}
add_filter('woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');


function my_custom_add_to_cart_message($message)
{
    $message .= sprintf('<a href="%s" class="button wc-backward">%s</a>', get_permalink(woocommerce_get_page_id('shop')), esc_html__('Continue shopping', 'woocommerce'));
    return $message;
}
add_filter('wc_add_to_cart_message_html', 'my_custom_add_to_cart_message');


// Replace Posts label as News in Admin Panel 

function change_post_menu_label()
{
    global $menu;
    global $submenu;
    $menu[5][0] = 'News';
    $submenu['edit.php'][5][0] = 'News';
    $submenu['edit.php'][10][0] = 'Add News';
    echo '';
}

function change_post_object_label()
{
    global $wp_post_types;
    $labels = &$wp_post_types['post']->labels;
    $labels->name = 'News';
    $labels->singular_name = 'News';
    $labels->add_new = 'Add News';
    $labels->add_new_item = 'Add News';
    $labels->edit_item = 'Edit News';
    $labels->new_item = 'News';
    $labels->view_item = 'View News';
    $labels->search_items = 'Search News';
    $labels->not_found = 'No News found';
    $labels->not_found_in_trash = 'No News found in Trash';
}

add_action('init', 'change_post_object_label');
add_action('admin_menu', 'change_post_menu_label');

/**
 * Menu registrations
 */
function mytheme_register_nav_menu()
{
    register_nav_menus(array(
        'footer_menu' => __('Footer Menu', 'Menu w stopce'),
        'footer_icon_menu' => __('Footer Icon Menu', 'Ikonki w stopce'),

    ));
}
add_action('after_setup_theme', 'mytheme_register_nav_menu', 0);

/**
 * Register our sidebars and widgetized areas.
 *
 */
function MB2020_widgets_init()
{
    register_sidebar(array(
        'name' => 'Top below navbar',
        'id' => 'top-below-navbar',
        'before_widget' => '<div>',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="">',
        'after_title' => '</h2>',
    ));
    register_sidebar(array(
        'name' => 'Bottom full width',
        'id' => 'bottom-full-width',
        'before_widget' => '<div class="content-area products related">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="">',
        'after_title' => '</h2>',
    ));
}

add_action('widgets_init', 'MB2020_widgets_init');

add_action('init', 'custom_taxonomy_collection');
function custom_taxonomy_collection()
{
    $labels = array(
        'name' => 'Collections',
        'singular_name' => 'Collection',
        'menu_name' => 'Collections',
        'all_items' => 'All Collections',
        'parent_item' => 'Parent Collections',
        'parent_item_colon' => 'Parent Collections:',
        'new_item_name' => 'New Collection Name',
        'add_new_item' => 'Add New Collection',
        'edit_item' => 'Edit Collection',
        'update_item' => 'Update Collection',
        'separate_items_with_commas' => 'Separate Collections with commas',
        'search_items' => 'Search Collections',
        'add_or_remove_items' => 'Add or remove Collections',
        'choose_from_most_used' => 'Choose from the most used Collections',
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
    );
    register_taxonomy('collection', 'product', $args);
    register_taxonomy_for_object_type('collection', 'product');
}

function storefront_post_header()
{
    ?>
    <header class="entry-header">
        <?php

        /**
         * Functions hooked in to storefront_post_header_before action.
         *
         * @hooked storefront_post_meta - 10
         */
        //do_action( 'storefront_post_header_before' );

        if (is_single()) {
            the_title('<h1 class="entry-title">', '</h1>');
        } else {
            the_title(sprintf('<h2 class="alpha entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>');
        }

        //do_action( 'storefront_post_header_after' );
        ?>
    </header><!-- .entry-header -->
    <?php
}

function storefront_post_content()
{
    ?>
    <div class="entry-content">
        <?php

        /**
         * Functions hooked in to storefront_post_content_before action.
         *
         * @hooked storefront_post_thumbnail - 10
         */
        do_action('storefront_post_content_before');

        the_content();
        ?>

        <?php
        do_action('storefront_post_content_after');

        wp_link_pages(
            array(
                'before' => '<div class="page-links">' . __('Pages:', 'storefront'),
                'after' => '</div>',
            )
        );
        ?>
    </div><!-- .entry-content -->
    <?php
}
/*
function storefront_post_excerpt()
{
    ?>
    <div class="entry-content">
        <?php


         //Functions hooked in to storefront_post_content_before action.

         // @hooked storefront_post_thumbnail - 10

        do_action('storefront_post_content_before');

        the_excerpt();
        ?>

        <p><a href="<?php the_permalink() ?>"><?php echo __('Read more'); ?></a></p>

        <?php
        do_action('storefront_post_content_after');

        wp_link_pages(
            array(
                'before' => '<div class="page-links">' . __('Pages:', 'storefront'),
                'after' => '</div>',
            )
        );
        ?>
    </div><!-- .entry-content -->
    <?php
}
*/
function storefront_before_content()
{
    dynamic_sidebar('top-below-navbar');
        ?>
    </div><!-- #primary-sidebar -->
    <?php do_action('menu'); ?>
    <div class="content-area-wrapper">
    <div id="primary" class="content-area shop">
    <main id="main" class="site-main" role="main">
    <?php
}

function storefront_after_content()
{
    ?>
    </main><!-- #main -->
    </div><!-- #primary -->
    </div>
    <?php
    if (is_active_sidebar('bottom-full-width')) : ?>
        <div id="bottom-widgets" class="content-area-wrapper bottom-widgets" role="complementary">
            <?php dynamic_sidebar('bottom-full-width'); ?>
        </div><!-- #primary-sidebar -->
    <?php endif;
}

add_action('init', 'remove_storefront_unused_elements');
function remove_storefront_unused_elements()
{
    remove_action('storefront_single_post_bottom', 'storefront_display_comments', 20);
    remove_action('storefront_after_footer', 'storefront_sticky_single_add_to_cart', 999);
    remove_action('storefront_single_post_bottom', 'storefront_post_taxonomy', 5);
    remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
    remove_action('woocommerce_after_single_product_summary', 'storefront_single_product_pagination', 30);
    remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);

    //remove_action( 'storefront_header', 'storefront_product_search', 40 );
    //remove_action( 'storefront_loop_post', 'storefront_post_taxonomy', 40 );
}


/**
 * Main menu left sidebar
 * @return void
 */
function mb2020_menu_slide_out_hidden()
{
    echo('<div class="slide-out-pane black hidden">
    <div class="menu-wrap black left">
        <div class="menu-sidebar">');
    wp_nav_menu(
        array(
            'theme_location' => 'primary',
            'container_class' => 'primary-navigation',
        )
    );
    echo('</div>
        </div>
    </div>');
}

add_action('menu_hidden', 'mb2020_menu_slide_out_hidden');



/*
function wc_dropdown_variation_attribute_options($args = array())
{
    $args = wp_parse_args(
        apply_filters('woocommerce_dropdown_variation_attribute_options_args', $args),
        array(
            'options' => false,
            'attribute' => false,
            'product' => false,
            'selected' => false,
            'name' => '',
            'id' => '',
            'class' => '',
            'show_option_none' => __('Choose an option', 'woocommerce'),
        )
    );

    // Get selected value.
    if (false === $args['selected'] && $args['attribute'] && $args['product'] instanceof WC_Product) {
        $selected_key = 'attribute_' . sanitize_title($args['attribute']);
        $args['selected'] = isset($_REQUEST[$selected_key]) ? wc_clean(wp_unslash($_REQUEST[$selected_key])) : $args['product']->get_variation_default_attribute($args['attribute']); // WPCS: input var ok, CSRF ok, sanitization ok.
    }

    $options = $args['options'];
    $product = $args['product'];
    $attribute = $args['attribute'];
    $name = $args['name'] ? $args['name'] : 'attribute_' . sanitize_title($attribute);
    $id = $args['id'] ? $args['id'] : sanitize_title($attribute);
    $class = $args['class'];
    $show_option_none = (bool)$args['show_option_none'];
    $show_option_none_text = $args['show_option_none'] ? $args['show_option_none'] : __('Choose an option', 'woocommerce'); // We'll do our best to hide the placeholder, but we'll need to show something when resetting options.

    if (empty($options) && !empty($product) && !empty($attribute)) {
        $attributes = $product->get_variation_attributes();
        $options = $attributes[$attribute];
    }

    $html = '<select id="' . esc_attr($id) . '" class="' . esc_attr($class) . '" name="' . esc_attr($name) . '" data-attribute_name="attribute_' . esc_attr(sanitize_title($attribute)) . '" data-show_option_none="' . ($show_option_none ? 'yes' : 'no') . '">';
    //$html .= '<option value="">' . esc_html( $show_option_none_text ) . '</option>';

    if (!empty($options)) {
        if ($product && taxonomy_exists($attribute)) {
            // Get terms if this is a taxonomy - ordered. We need the names too.
            $terms = wc_get_product_terms(
                $product->get_id(),
                $attribute,
                array(
                    'fields' => 'all',
                )
            );

            foreach ($terms as $term) {
                if (in_array($term->slug, $options, true)) {
                    $html .= '<option value="' . esc_attr($term->slug) . '" ' . selected(sanitize_title($args['selected']), $term->slug, false) . '>' . esc_html(apply_filters('woocommerce_variation_option_name', $term->name, $term, $attribute, $product)) . '</option>';
                }
            }
        } else {
            foreach ($options as $option) {
                // This handles < 2.4.0 bw compatibility where text attributes were not sanitized.
                $selected = sanitize_title($args['selected']) === $args['selected'] ? selected($args['selected'], sanitize_title($option), false) : selected($args['selected'], $option, false);
                $html .= '<option value="' . esc_attr($option) . '" ' . $selected . '>' . esc_html(apply_filters('woocommerce_variation_option_name', $option, null, $attribute, $product)) . '</option>';
            }
        }
    }

    $html .= '</select>';

    echo apply_filters('woocommerce_dropdown_variation_attribute_options_html', $html, $args); // WPCS: XSS ok.
}
*/
function mytheme_infinite_scroll_init()
{
    add_theme_support('infinite-scroll', array(
        'type' => 'scroll',
        'container' => 'masonry-grid',
        'render' => 'mytheme_infinite_scroll_render',
        'footer' => false,
        'wrapper' => false,
        'posts_per_page' => 10,
    ));
}

function jetpack_setup_override()
{
    apply_filters('storefront_jetpack_infinite_scroll_args', array(
            'type' => 'click',
            'container' => 'masonry-grid',
            'render' => 'mytheme_infinite_scroll_render',
            'footer' => false,
            'wrapper' => false,
        )
    );
}

add_action('init', 'jetpack_setup_override', 0);
/*
function mytheme_infinite_scroll_render()
{
    while (have_posts()) : the_post();
        //echo 'test';
        //get_template_part( 'template-parts/content', 'post' );

        if (function_exists('storefront_is_product_archive') && storefront_is_product_archive()) {
            wc_get_template_part('content', 'product');
        } else {
            get_template_part('template-parts/content', 'post');
        }
    endwhile;


}
*/

//add_filter('woocommerce_variable_sale_price_html', 'shop_variable_product_price', 10, 2);
//add_filter('woocommerce_variable_price_html','shop_variable_product_price', 10, 2 );

/*
function shop_variable_product_price($price, $product)
{
    $variation_min_reg_price = $product->get_variation_regular_price('min', true);
    $variation_min_sale_price = $product->get_variation_sale_price('min', true);
    if ($product->is_on_sale() && !empty($variation_min_sale_price)) {
        if (!empty($variation_min_sale_price))
            $price = '<del class="strike">' . wc_price($variation_min_reg_price) . '</del>
        <ins class="highlight">' . wc_price($variation_min_sale_price) . '</ins>';
    } else {
        if (!empty($variation_min_reg_price))
            $price = '<ins class="highlight">' . wc_price($variation_min_reg_price) . '</ins>';
        else
            $price = '<ins class="highlight">' . wc_price($product->regular_price) . '</ins>';
    }
    return $price;
}
*/

/**
 * Disable WordPress image compression
 */
add_filter('wp_editor_set_quality', function ($arg) {
    return 100;
});
add_filter('jpeg_quality', function ($arg) {
    return 100;
});

// Register product custom thumbnails
add_theme_support( 'custom-product-thumbnails' );
add_image_size( 'custom-product-thumbnails', 800, 1200 , true);
add_filter('single_product_archive_thumbnail_size', function ($size){ return 'custom-product-thumbnails';});


// Query for 'for-partners' pages
function bm_get_product_query($page_slug){
    if ($page_slug === "dla-partnerow"):
        // All products with 'for-partners' tag
        return array(
                'post_type' => 'product',
                'posts_per_page' => 100,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'product_tag',
                        'terms' => 'for-partners',
                        'field' => 'slug',
                        'operator' => 'IN'
                    )
                )
        );

    elseif ($page_slug === 'ciriana'):
        // All products with 'for-partners' or with 'ciriana' tag
        return array(
                'post_type' => 'product',
                'posts_per_page' => 100,
                'tax_query' => array(
                    'relation' => 'OR',
                    array(
                        'taxonomy' => 'product_tag',
                        'terms' => 'for-partners',
                        'field' => 'slug',
                        'operator' => 'IN'
                    ),
                    array(
                        'taxonomy' => 'product_tag',
                        'terms' => 'ciriana',
                        'field' => 'slug',
                        'operator' => 'IN'
                    )
                )
        );
    elseif ($page_slug === 'ciriana-instock'):
        // All products with 'ciriana-instock' and "instock" status
        return array(
                'post_type' => 'product',
                'posts_per_page' => 100,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'product_tag',
                        'terms' => 'ciriana-instock',
                        'field' => 'slug',
                        'operator' => 'IN'
                    )
                ),
                'meta_query' => array(
                    array(
                        'key' => '_stock_status',
                        'value' => 'instock'
                    )
                )
        );
    endif;
}

// Change Partners Custom Post Type Archive Title
function custom_post_type_partners_archive_title( $title ) {
    if ( is_post_type_archive( 'partners' ) ) {
        $title = 'DOTYCZCZAS ZAUFALI NAM';
    }
    return $title;
}
add_filter( 'post_type_archive_title', 'custom_post_type_partners_archive_title' );


/* Change BLOG excerpt length */
function wplab_custom_excerpt_length( $length ) {
    return 15;
}
add_filter( 'excerpt_length', 'wplab_custom_excerpt_length', 999 );