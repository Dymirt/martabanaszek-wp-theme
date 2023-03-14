<?php

function theme_add_instock_page(){
    add_menu_page(
        'Stany magazynowe',
        'Magazyn',
        'manage_options',
        'magazyn',
        'theme_create_instock_page',
        'dashicons-media-spreadsheet',
        56

    );
}
add_action('admin_menu', 'theme_add_instock_page');

function theme_create_instock_page(){
    require_once get_stylesheet_directory() . '/inc/templates/admin-magazyn.php';
}



function theme_add_ciriana_instock_page(){
    add_menu_page(
        'Stany magazynowe CIRIANA',
        'Magazyn CIRIANA',
        'manage_options',
        'magazyn-ciriana',
        'theme_create_ciriana_instock_page',
        'dashicons-media-spreadsheet',
        56

    );
}
add_action('admin_menu', 'theme_add_ciriana_instock_page');

function theme_create_ciriana_instock_page(){
    require_once get_stylesheet_directory() . '/inc/templates/admin-magazyn_ciriana.php';
}
