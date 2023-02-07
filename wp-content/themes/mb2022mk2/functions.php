<?php
/**  */

require get_stylesheet_directory() . '/inc/functions-custom-variation-fields.php';
require get_stylesheet_directory() . '/inc/functions-admin.php';

function my_theme_enqueue_styles() {
 
    $parent_style = 'parent-style'; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.
 
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'jquery-ui', get_stylesheet_directory_uri() . '/js/jquery-ui.min.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );

function load_custom_scripts() {
    wp_register_script('custom_scripts', get_stylesheet_directory_uri() . '/js/mb2020_scripts.js', array(), date("YmdHi", filemtime( get_stylesheet_directory() . '/js/mb2020_scripts.js')));
    wp_register_script('fontawesome', 'https://kit.fontawesome.com/7a0bc25598.js');

    wp_enqueue_script('imagesLoaded', 'https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.min.js');
    wp_enqueue_script('martabanaszek_main_theme', get_stylesheet_directory_uri() . '/assets/js/main.js', array(), '1.0', true);
    wp_enqueue_script('martabanaszek_bootstrap_bundle', "https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js", array(), '5.3.0', true);

    //if(!is_user_logged_in()){
        wp_enqueue_script('custom_scripts'); 
        wp_enqueue_script('fontawesome'); 

    //}
    
}
/**
 * Register Custom Navigation Walker
 */
function register_navwalker(){
	require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';
}

add_action( 'wp_enqueue_scripts', 'load_custom_scripts' );

function masonry_load() {
    if(is_home()){
        wp_enqueue_script('masonry', 'https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js', ['jquery', 'imagesLoaded']); 
    }
}
add_action( 'wp_enqueue_scripts', 'masonry_load' );

function masonry_init() {
    if(is_home()){
        $cache_buster = date("YmdHi", filemtime( get_stylesheet_directory() . '/js/masonry_init.js'));
        wp_enqueue_script('masonry_init', '/wp-content/themes/MB2020/js/masonry_init.js',['jquery', 'masonry', 'imagesLoaded'], $cache_buster); 
        clearstatcache();
    }
}
add_action( 'wp_enqueue_scripts', 'masonry_init', 11 );



// Load translation files from your child theme instead of the parent theme
function MB2020_locale() {
    load_child_theme_textdomain( 'MB2020', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'MB2020_locale' );

add_filter( 'woocommerce_get_availability_text', 'customizing_stock_availability_text', 1, 2);
function customizing_stock_availability_text( $availability, $product ) {
    if ( ! $product->is_in_stock() ) {
        $availability = __( 'Out of stock', 'woocommerce' );
    }
    elseif ( $product->managing_stock() && $product->is_on_backorder( 1 ) )
    {
        $availability = $product->backorders_require_notification() ? __( 'Available on backorder. <br> Your order will be ready in up to 30 work days.', 'MB2020' ) : '';
    }
    elseif ( $product->managing_stock() )
    {
        $availability = wc_format_stock_for_display( $product );
    }
    else
    {
        $availability = '';
    }

    return $availability;
}

add_action( 'template_redirect', 'define_default_payment_gateway' );
function define_default_payment_gateway(){
    if( is_checkout() && ! is_wc_endpoint_url() ) {
        // HERE define the default payment gateway ID
        $default_payment_id = 'transferuj';

        WC()->session->set( 'chosen_payment_method', $default_payment_id );
    }
}

function remove_product_editor(){
  remove_post_type_support( 'product', 'editor' );
}
add_action( 'init', 'remove_product_editor' );

/**
 * Show cart contents / total Ajax
 */
add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );

function woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;

	ob_start();
    if($woocommerce->cart->cart_contents_count >0){
        echo('<span class="cart-total-count" style="background: red">'.$woocommerce->cart->cart_contents_count.'</span>');
    }
	?>
	<?php
	$fragments['span.cart-total-count'] = ob_get_clean();
	return $fragments;
}

add_filter( 'wc_add_to_cart_message_html', 'my_custom_add_to_cart_message' );
function my_custom_add_to_cart_message( $message ) {
    $message .= sprintf( '<a href="%s" class="button wc-backward">%s</a>', get_permalink( woocommerce_get_page_id( 'shop' ) ), esc_html__( 'Continue shopping', 'woocommerce' ));
    return $message;
}

/*
* Creating a function to create our CPT
*/

// Replace Posts label as News in Admin Panel 

function change_post_menu_label() {
    global $menu;
    global $submenu;
    $menu[5][0] = 'News';
    $submenu['edit.php'][5][0] = 'News';
    $submenu['edit.php'][10][0] = 'Add News';
    echo '';
}
function change_post_object_label() {
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
add_action( 'init', 'change_post_object_label' );
add_action( 'admin_menu', 'change_post_menu_label' );
 
function custom_post_type_portfolio() {
 
    // Set UI labels for Custom Post Type
        $labels = array(
            'name'                => _x( 'Portfolio', 'Post Type General Name', 'twentytwenty' ),
            //'singular_name'       => _x( 'Wpis portfolio', 'Post Type Singular Name', 'twentytwenty' ),
            //'menu_name'           => __( 'Portfolio', 'twentytwenty' ),
            //'parent_item_colon'   => __( 'Parent Portfolio', 'twentytwenty' ),
            //'all_items'           => __( 'All posts' ),
            //'view_item'           => __( 'View Portfolio', 'twentytwenty' ),
            //'add_new_item'        => __( 'Add New Portfolio', 'twentytwenty' ),
            //'add_new'             => __( 'Add New', 'twentytwenty' ),
            //'edit_item'           => __( 'Edit Portfolio', 'twentytwenty' ),
            //'update_item'         => __( 'Update Portfolio', 'twentytwenty' ),
            //'search_items'        => __( 'Search Portfolio', 'twentytwenty' ),
            //'not_found'           => __( 'Not Found', 'twentytwenty' ),
            //'not_found_in_trash'  => __( 'Not found in Trash', 'twentytwenty' ),
        );
         
    // Set other options for Custom Post Type
         
        $args = array(
            'label'               => __( 'portfolio', 'twentytwenty' ),
            'description'         => __( 'Portfolio', 'twentytwenty' ),
            'labels'              => $labels,
            // Features this CPT supports in Post Editor
            'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
            // You can associate this CPT with a taxonomy or custom taxonomy. 
            'taxonomies'          => array( 'category', 'post_tag' ),
            /* A hierarchical CPT is like Pages and can have
            * Parent and child items. A non-hierarchical CPT
            * is like Posts.
            */ 
            'hierarchical'        => false,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'menu_position'       => 5,
            'can_export'          => true,
            'has_archive'         => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'capability_type'     => 'post',
            'show_in_rest'        => true,
            'menu_icon'           => 'dashicons-layout'
     
        );
         
        // Registering your Custom Post Type
        register_post_type( 'portfolio', $args ); 
    }
     
    function custom_post_type_blog() {
 
        // Set UI labels for Custom Post Type
            $labels = array(
                'name'                => _x( 'Blog', 'Post Type General Name', 'twentytwenty' ),
                //'singular_name'       => _x( 'Wpis portfolio', 'Post Type Singular Name', 'twentytwenty' ),
                //'menu_name'           => __( 'Portfolio', 'twentytwenty' ),
                //'parent_item_colon'   => __( 'Parent Portfolio', 'twentytwenty' ),
                //'all_items'           => __( 'All posts' ),
                //'view_item'           => __( 'View Portfolio', 'twentytwenty' ),
                //'add_new_item'        => __( 'Add New Portfolio', 'twentytwenty' ),
                //'add_new'             => __( 'Add New', 'twentytwenty' ),
                //'edit_item'           => __( 'Edit Portfolio', 'twentytwenty' ),
                //'update_item'         => __( 'Update Portfolio', 'twentytwenty' ),
                //'search_items'        => __( 'Search Portfolio', 'twentytwenty' ),
                //'not_found'           => __( 'Not Found', 'twentytwenty' ),
                //'not_found_in_trash'  => __( 'Not found in Trash', 'twentytwenty' ),
            );
             
        // Set other options for Custom Post Type
             
            $args = array(
                'label'               => __( 'blog', 'twentytwenty' ),
                'description'         => __( 'Blog', 'twentytwenty' ),
                'labels'              => $labels,
                // Features this CPT supports in Post Editor
                'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
                // You can associate this CPT with a taxonomy or custom taxonomy. 
                'taxonomies'          => array( 'category', 'post_tag' ),
                /* A hierarchical CPT is like Pages and can have
                * Parent and child items. A non-hierarchical CPT
                * is like Posts.
                */ 
                'hierarchical'        => false,
                'public'              => true,
                'show_ui'             => true,
                'show_in_menu'        => true,
                'show_in_nav_menus'   => true,
                'show_in_admin_bar'   => true,
                'menu_position'       => 5,
                'can_export'          => true,
                'has_archive'         => true,
                'exclude_from_search' => false,
                'publicly_queryable'  => true,
                'capability_type'     => 'post',
                'show_in_rest'        => true,
                'menu_icon'           => 'dashicons-text-page
                '
         
            );
             
            // Registering your Custom Post Type
            register_post_type( 'blog', $args );
         
    }
    /* Hook into the 'init' action so that the function
    * Containing our post type registration is not 
    * unnecessarily executed. 
    */
     
    add_action( 'init', 'custom_post_type_blog', 0 );
    add_action( 'init', 'custom_post_type_portfolio', 0 );

function mytheme_register_nav_menu(){
    register_nav_menus( array(
        'footer_menu'  => __( 'Footer Menu', 'Menu w stopce' ),
        'footer_icon_menu'  => __( 'Footer Icon Menu', 'Ikonki w stopce' ),

        ) );
}
add_action( 'after_setup_theme', 'mytheme_register_nav_menu', 0 );
    
    /**
 * Register our sidebars and widgetized areas.
 *
 */
function MB2020_widgets_init() {

    register_sidebar( array(
		'name'          => 'Top below navbar',
		'id'            => 'top-below-navbar',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => 'Right slide out',
        'id'            => 'right-slide-out',
        'class'         => 'right-slide-out menu-wrap',
		'before_widget' => '<div class="menu-sidebar">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="">',
		'after_title'   => '</h2>',
    ) );
    register_sidebar( array(
		'name'          => 'Bottom full width',
		'id'            => 'bottom-full-width',
		'before_widget' => '<div class="content-area products related">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="">',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'MB2020_widgets_init' );

add_action( 'init', 'custom_taxonomy_collection' );
function custom_taxonomy_collection()  {
$labels = array(
    'name'                       => 'Collections',
    'singular_name'              => 'Collection',
    'menu_name'                  => 'Collections',
    'all_items'                  => 'All Collections',
    'parent_item'                => 'Parent Collections',
    'parent_item_colon'          => 'Parent Collections:',
    'new_item_name'              => 'New Collection Name',
    'add_new_item'               => 'Add New Collection',
    'edit_item'                  => 'Edit Collection',
    'update_item'                => 'Update Collection',
    'separate_items_with_commas' => 'Separate Collections with commas',
    'search_items'               => 'Search Collections',
    'add_or_remove_items'        => 'Add or remove Collections',
    'choose_from_most_used'      => 'Choose from the most used Collections',
);
$args = array(
    'labels'                     => $labels,
    'hierarchical'               => true,
    'public'                     => true,
    'show_ui'                    => true,
    'show_admin_column'          => true,
    'show_in_nav_menus'          => true,
    'show_tagcloud'              => true,
);
register_taxonomy( 'collection', 'product', $args );
register_taxonomy_for_object_type( 'collection', 'product' );
}

function storefront_post_header() {
    ?>
    <header class="entry-header">
    <?php

    /**
     * Functions hooked in to storefront_post_header_before action.
     *
     * @hooked storefront_post_meta - 10
     */
    //do_action( 'storefront_post_header_before' );

    if ( is_single() ) {
        the_title( '<h1 class="entry-title">', '</h1>' );
    } else {
        the_title( sprintf( '<h2 class="alpha entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
    }

    //do_action( 'storefront_post_header_after' );
    ?>
    </header><!-- .entry-header -->
    <?php
}

function storefront_post_content() {
    ?>
    <div class="entry-content">
    <?php

    /**
     * Functions hooked in to storefront_post_content_before action.
     *
     * @hooked storefront_post_thumbnail - 10
     */
    do_action( 'storefront_post_content_before' );

    the_content();
    ?>
    
    <?php
    do_action( 'storefront_post_content_after' );

    wp_link_pages(
        array(
            'before' => '<div class="page-links">' . __( 'Pages:', 'storefront' ),
            'after'  => '</div>',
        )
    );
    ?>
    </div><!-- .entry-content -->
    <?php
}

function storefront_post_excerpt() {
    ?>
    <div class="entry-content">
    <?php

    /**
     * Functions hooked in to storefront_post_content_before action.
     *
     * @hooked storefront_post_thumbnail - 10
     */
    do_action( 'storefront_post_content_before' );

    the_excerpt();
    ?>

    <p><a href="<?php the_permalink() ?>"><?php echo __('Read more');?></a></p>
    
    <?php
    do_action( 'storefront_post_content_after' );

    wp_link_pages(
        array(
            'before' => '<div class="page-links">' . __( 'Pages:', 'storefront' ),
            'after'  => '</div>',
        )
    );
    ?>
    </div><!-- .entry-content -->
    <?php
}

function storefront_before_content() {
    ?>
    <?php if ( is_active_sidebar( 'top-below-navbar' ) ) : ?>
        <div id="primary-sidebar" class="menu-sidebar widget-area" role="complementary">
            <?php 
                do_action( 'storefront_before_content' );
                dynamic_sidebar( 'top-below-navbar' ); 
            ?>
        </div><!-- #primary-sidebar -->
    <?php endif; ?>
    <?php do_action( 'menu'); ?>
    <div class="content-area-wrapper">
    <div id="primary" class="content-area shop">
        <main id="main" class="site-main" role="main">
    <?php
}

function storefront_after_content() {
    ?>
        </main><!-- #main -->
    </div><!-- #primary -->
    </div>
    <?php
    if ( is_active_sidebar( 'right-slide-out' ) ) : ?>
		<div class="slide-out-pane right">
			<div class="menu-wrap click right">
                <?php dynamic_sidebar( 'right-slide-out' ); ?>
			</div>
		</div>
    <?php endif; ?>
    <?php
    if ( is_active_sidebar( 'bottom-full-width' ) ) : ?>
        <div id="bottom-widgets" class="content-area-wrapper bottom-widgets" role="complementary">
            <?php dynamic_sidebar( 'bottom-full-width' ); ?>
        </div><!-- #primary-sidebar -->
    <?php endif;
}

add_action( 'init', 'remove_storefront_unused_elements' );
function remove_storefront_unused_elements() {
    remove_action( 'storefront_single_post_bottom', 'storefront_display_comments', 20);
    remove_action( 'storefront_after_footer', 'storefront_sticky_single_add_to_cart', 999 );
    remove_action( 'storefront_single_post_bottom', 'storefront_post_taxonomy', 5 );
    remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
    remove_action( 'woocommerce_after_single_product_summary', 'storefront_single_product_pagination', 30 );
    remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

    //remove_action( 'storefront_header', 'storefront_product_search', 40 );
    //remove_action( 'storefront_loop_post', 'storefront_post_taxonomy', 40 );
}
add_action( 'woocommerce_before_shop_loop', 'add_filter_toggle', 25 );

function add_filter_toggle() {
	echo('<button class="toggle-filter-button click right"><i class="fas fa-filter"></i> Filtruj produkty</button>');
}

add_action( 'menu', 'mb2020_menu_slide_out' );
add_action( 'menu_hidden', 'mb2020_menu_slide_out_hidden' );

function mb2020_menu_slide_out() {
    
    echo('<div class="slide-out-pane">
    <div class="menu-wrap left">
        <div class="menu-sidebar">');
        wp_nav_menu(
            array(
                'theme_location'  => 'primary',
                'container_class' => 'primary-navigation',
            )
        );
            echo('</div>
        </div>
    </div>');
}
function mb2020_menu_slide_out_hidden() {
    
    echo('<div class="slide-out-pane black hidden">
    <div class="menu-wrap black left">
        <div class="menu-sidebar">');
        wp_nav_menu(
            array(
                'theme_location'  => 'primary',
                'container_class' => 'primary-navigation',
            )
        );
            echo('</div>
        </div>
    </div>');
}

add_action( 'wp_print_scripts', 'remove_storefront_unused_scripts', 100 );
function remove_storefront_unused_scripts() {
    //wp_dequeue_script( 'storefront-sticky-add-to-cart' );
}


//require_once(get_stylesheet_directory().'/widgets/wc-recently-viewed.php');
function add_custom_widgets() {
    register_widget( 'WC_Widget_Recently_Viewed_MB2020' );
}
add_action( 'widgets_init', 'add_custom_widgets' );

/**
 * Widget recently viewed.
 */
class WC_Widget_Recently_Viewed_MB2020 extends WC_Widget {

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->widget_cssclass    = 'woocommerce widget_recently_viewed_products';
		$this->widget_description = __( "MB2020 Display a list of a customer's recently viewed products.", 'woocommerce' );
		$this->widget_id          = 'woocommerce_recently_viewed_products';
		$this->widget_name        = __( 'Recent Viewed Products MB2020', 'woocommerce' );
		$this->settings           = array(
			'title'  => array(
				'type'  => 'text',
				'std'   => __( 'Recently Viewed Products', 'woocommerce' ),
				'label' => __( 'Title', 'woocommerce' ),
			),
			'number' => array(
				'type'  => 'number',
				'step'  => 1,
				'min'   => 1,
				'max'   => 15,
				'std'   => 10,
				'label' => __( 'Number of products to show', 'woocommerce' ),
			),
		);

		parent::__construct();
	}

	/**
	 * Output widget.
	 *
	 * @see WP_Widget
	 * @param array $args     Arguments.
	 * @param array $instance Widget instance.
	 */
	public function widget( $args, $instance ) {
		$viewed_products = ! empty( $_COOKIE['woocommerce_recently_viewed'] ) ? (array) explode( '|', wp_unslash( $_COOKIE['woocommerce_recently_viewed'] ) ) : array(); // @codingStandardsIgnoreLine
		$viewed_products = array_reverse( array_filter( array_map( 'absint', $viewed_products ) ) );

		if ( empty( $viewed_products ) ) {
			return;
		}

		ob_start();

		$number = ! empty( $instance['number'] ) ? absint( $instance['number'] ) : $this->settings['number']['std'];

		$query_args = array(
			'posts_per_page' => $number,
			'no_found_rows'  => 1,
			'post_status'    => 'publish',
			'post_type'      => 'product',
			'post__in'       => $viewed_products,
			'orderby'        => 'post__in',
		);

		if ( 'yes' === get_option( 'woocommerce_hide_out_of_stock_items' ) ) {
			$query_args['tax_query'] = array(
				array(
					'taxonomy' => 'product_visibility',
					'field'    => 'name',
					'terms'    => 'outofstock',
					'operator' => 'NOT IN',
				),
			); // WPCS: slow query ok.
		}

		$r = new WP_Query( apply_filters( 'woocommerce_recently_viewed_products_widget_query_args', $query_args ) );

		if ( $r->have_posts() ) {

			$this->widget_start( $args, $instance );

			echo wp_kses_post( apply_filters( 'woocommerce_before_widget_product_list', '<ul class="products columns-3">' ) );

			$template_args = array(
				'widget_id' => isset( $args['widget_id'] ) ? $args['widget_id'] : $this->widget_id,
			);

			while ( $r->have_posts() ) {
				$r->the_post();
				wc_get_template( 'content-product.php', $template_args );
			}

			echo wp_kses_post( apply_filters( 'woocommerce_after_widget_product_list', '</ul>' ) );

			$this->widget_end( $args );
		}

		wp_reset_postdata();

		$content = ob_get_clean();

		echo $content; // WPCS: XSS ok.
	}
}

function wc_dropdown_variation_attribute_options( $args = array() ) {
    $args = wp_parse_args(
        apply_filters( 'woocommerce_dropdown_variation_attribute_options_args', $args ),
        array(
            'options'          => false,
            'attribute'        => false,
            'product'          => false,
            'selected'         => false,
            'name'             => '',
            'id'               => '',
            'class'            => '',
            'show_option_none' => __( 'Choose an option', 'woocommerce' ),
        )
    );

    // Get selected value.
    if ( false === $args['selected'] && $args['attribute'] && $args['product'] instanceof WC_Product ) {
        $selected_key     = 'attribute_' . sanitize_title( $args['attribute'] );
        $args['selected'] = isset( $_REQUEST[ $selected_key ] ) ? wc_clean( wp_unslash( $_REQUEST[ $selected_key ] ) ) : $args['product']->get_variation_default_attribute( $args['attribute'] ); // WPCS: input var ok, CSRF ok, sanitization ok.
    }

    $options               = $args['options'];
    $product               = $args['product'];
    $attribute             = $args['attribute'];
    $name                  = $args['name'] ? $args['name'] : 'attribute_' . sanitize_title( $attribute );
    $id                    = $args['id'] ? $args['id'] : sanitize_title( $attribute );
    $class                 = $args['class'];
    $show_option_none      = (bool) $args['show_option_none'];
    $show_option_none_text = $args['show_option_none'] ? $args['show_option_none'] : __( 'Choose an option', 'woocommerce' ); // We'll do our best to hide the placeholder, but we'll need to show something when resetting options.

    if ( empty( $options ) && ! empty( $product ) && ! empty( $attribute ) ) {
        $attributes = $product->get_variation_attributes();
        $options    = $attributes[ $attribute ];
    }

    $html  = '<select id="' . esc_attr( $id ) . '" class="' . esc_attr( $class ) . '" name="' . esc_attr( $name ) . '" data-attribute_name="attribute_' . esc_attr( sanitize_title( $attribute ) ) . '" data-show_option_none="' . ( $show_option_none ? 'yes' : 'no' ) . '">';
    //$html .= '<option value="">' . esc_html( $show_option_none_text ) . '</option>';

    if ( ! empty( $options ) ) {
        if ( $product && taxonomy_exists( $attribute ) ) {
            // Get terms if this is a taxonomy - ordered. We need the names too.
            $terms = wc_get_product_terms(
                $product->get_id(),
                $attribute,
                array(
                    'fields' => 'all',
                )
            );

            foreach ( $terms as $term ) {
                if ( in_array( $term->slug, $options, true ) ) {
                    $html .= '<option value="' . esc_attr( $term->slug ) . '" ' . selected( sanitize_title( $args['selected'] ), $term->slug, false ) . '>' . esc_html( apply_filters( 'woocommerce_variation_option_name', $term->name, $term, $attribute, $product ) ) . '</option>';
                }
            }
        } else {
            foreach ( $options as $option ) {
                // This handles < 2.4.0 bw compatibility where text attributes were not sanitized.
                $selected = sanitize_title( $args['selected'] ) === $args['selected'] ? selected( $args['selected'], sanitize_title( $option ), false ) : selected( $args['selected'], $option, false );
                $html    .= '<option value="' . esc_attr( $option ) . '" ' . $selected . '>' . esc_html( apply_filters( 'woocommerce_variation_option_name', $option, null, $attribute, $product ) ) . '</option>';
            }
        }
    }

    $html .= '</select>';

    echo apply_filters( 'woocommerce_dropdown_variation_attribute_options_html', $html, $args ); // WPCS: XSS ok.
}

function mytheme_infinite_scroll_init() {
    add_theme_support( 'infinite-scroll', array(
        'type'      => 'scroll',
        'container' => 'masonry-grid',
        'render'    => 'mytheme_infinite_scroll_render',
        'footer'    => false,
        'wrapper'   => false,
        'posts_per_page' => 10,
    ) );
}

function jetpack_setup_override() {
    apply_filters('storefront_jetpack_infinite_scroll_args', array(
                'type'      => 'click',
                'container' => 'masonry-grid',
                'render'    => 'mytheme_infinite_scroll_render',
                'footer'    => false,
                'wrapper'   => false,
            )
    );
}


add_action( 'init', 'jetpack_setup_override', 0 );

function mytheme_infinite_scroll_render() {
    while ( have_posts() ) : the_post();
        //echo 'test';
        //get_template_part( 'template-parts/content', 'post' );

        if ( function_exists( 'storefront_is_product_archive' ) && storefront_is_product_archive() ) {
            wc_get_template_part( 'content', 'product' );
        } else {
            get_template_part( 'template-parts/content', 'post' );
        }
    endwhile;


}

//Remove woocommerce_sale_flash completely
//add_filter('woocommerce_sale_flash', 'woo_custom_hide_sales_flash');
function woo_custom_hide_sales_flash()
{
    return false;
}


//add_filter('woocommerce_variable_sale_price_html', 'shop_variable_product_price', 10, 2);
//add_filter('woocommerce_variable_price_html','shop_variable_product_price', 10, 2 );
function shop_variable_product_price( $price, $product ){
    $variation_min_reg_price = $product->get_variation_regular_price('min', true);
    $variation_min_sale_price = $product->get_variation_sale_price('min', true);
    if ( $product->is_on_sale() && !empty($variation_min_sale_price)){
        if ( !empty($variation_min_sale_price) )
            $price = '<del class="strike">' .  wc_price($variation_min_reg_price) . '</del>
        <ins class="highlight">' .  wc_price($variation_min_sale_price) . '</ins>';
    } else {
        if(!empty($variation_min_reg_price))
            $price = '<ins class="highlight">'.wc_price( $variation_min_reg_price ).'</ins>';
        else
            $price = '<ins class="highlight">'.wc_price( $product->regular_price ).'</ins>';
    }
    return $price;
}

// Disable WordPress image compression
add_filter( 'wp_editor_set_quality', function($arg) {return 100;});
add_filter('jpeg_quality', function($arg){return 100;});