<?php
function wpac_register_menu_page() {
    add_menu_page(
        'WPAC Like & Reaction System',
        'WPAC Settings',
        'manage_options',
        'wpac-settings',
        'wpac_settings_page_html',
        'dashicons-thumbs-up', 30 );
}
add_action('admin_menu', 'wpac_register_menu_page');
function wpac_register_button_settings_page() {
    add_submenu_page(
        'wpac-settings',
        'Like & Dislike Button Settings',
        'Like/Dislike',
        'manage_options',
        'wpac-button-settings',
        'wpac_button_settings_page_cb' );
}
add_action('admin_menu', 'wpac_register_button_settings_page');
function wpac_register_reaction_settings_page() {
    add_submenu_page(
        'wpac-settings',
        'Reactions Settings',
        'Reactions',
        'manage_options',
        'wpac-reaction-settings',
        'wpac_reaction_settings_page_cb' );
}
add_action('admin_menu', 'wpac_register_reaction_settings_page');
function wpac_register_sharing_settings_page() {
    add_submenu_page(
        'wpac-settings',
        'Sharing Settings',
        'Sharing',
        'manage_options',
        'wpac-sharing-settings',
        'wpac_sharing_settings_page_cb' );
}
add_action('admin_menu', 'wpac_register_sharing_settings_page');