<?php
function custom_post_type_portfolio()
{

    // Set UI labels for Custom Post Type
    $labels = array(
        'name' => _x('Portfolio', 'Post Type General Name', 'twentytwenty'),
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
        'label' => __('portfolio', 'twentytwenty'),
        'description' => __('Portfolio', 'twentytwenty'),
        'labels' => $labels,
        // Features this CPT supports in Post Editor
        'supports' => array('title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields',),
        // You can associate this CPT with a taxonomy or custom taxonomy.
        'taxonomies' => array('category', 'post_tag'),
        /* A hierarchical CPT is like Pages and can have
        * Parent and child items. A non-hierarchical CPT
        * is like Posts.
        */
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'menu_position' => 5,
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'post',
        'show_in_rest' => true,
        'menu_icon' => 'dashicons-layout'

    );

    // Registering your Custom Post Type
    register_post_type('portfolio', $args);
}
add_action('init', 'custom_post_type_portfolio', 0);

function custom_post_type_blog()
{

    // Set UI labels for Custom Post Type
    $labels = array(
        'name' => _x('Blog', 'Post Type General Name', 'twentytwenty'),
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
        'label' => __('blog', 'twentytwenty'),
        'description' => __('Blog', 'twentytwenty'),
        'labels' => $labels,
        // Features this CPT supports in Post Editor
        'supports' => array('title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields',),
        // You can associate this CPT with a taxonomy or custom taxonomy.
        'taxonomies' => array('category', 'post_tag'),
        /* A hierarchical CPT is like Pages and can have
        * Parent and child items. A non-hierarchical CPT
        * is like Posts.
        */
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'menu_position' => 5,
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'post',
        'show_in_rest' => true,
        'menu_icon' => 'dashicons-text-page
                '

    );

    // Registering your Custom Post Type
    register_post_type('blog', $args);

}
add_action('init', 'custom_post_type_blog', 0);
