<?php
function custom_post_type_partners()
{
    $labels = array(
        'name' => _x('Partners', 'Post Type General Name', 'twentytwenty'),
    );
    $args = array(
        'label' => __('partners', 'twentytwenty'),
        'description' => __('Partners', 'twentytwenty'),
        'labels' => $labels,
        'supports' => array('title', 'thumbnail',),
        'hierarchical' => false,
        'exclude_from_search' => true,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => false,
        'show_in_admin_bar' => true,
        'menu_position' => 5,
        'can_export' => true,
        'has_archive' => true,
        'publicly_queryable' => true,
        'capability_type' => 'post',
        'show_in_rest' => false,
        'menu_icon' => 'dashicons-networking',
        'register_meta_box_cb' => 'partners_add_custom_meta_box'

    );
    register_post_type('partners', $args);
}

add_action('init', 'custom_post_type_partners', 0);

function partners_add_custom_meta_box() {
    add_meta_box(
        'partners_meta_box', // ID
        'Partner URL', // Title
        'partners_show_custom_meta_box', // Callback function
        'partners', // Post type
        'normal', // Context
        'high' // Priority
    );
}

function partners_show_custom_meta_box($post) {
    $partner_url = get_post_meta($post->ID, 'partner_url', true);
    ?>
    <label for="partner_url">Partner URL:</label>
    <input type="text" id="partner_url" name="partner_url" value="<?php echo esc_url($partner_url); ?>" />
    <?php
}

function partners_save_custom_meta_box($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    if (isset($_POST['partner_url'])) {
        update_post_meta($post_id, 'partner_url', esc_url($_POST['partner_url']));
    }
}
add_action( 'save_post', 'partners_save_custom_meta_box' );
