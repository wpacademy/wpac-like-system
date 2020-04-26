<?php
function wpac_settings_page_html() {
    //Check if current user have admin access.
    if(!is_admin()) {
        return;
    }
    echo '<div class="wrap">';
        echo '<h1 class="wpac-plugin-settings-head">'.esc_html(get_admin_page_title()).'</h1>';
        echo '<form action="options.php" method="post" class="wpac-setting-form">';

            // output security fields for the registered setting "wpac-settings"
            settings_fields( 'wpac-settings' );

            // output setting sections and their fields
            // (sections are registered for "wpac-settings", each field is registered to a specific section)
            do_settings_sections( 'wpac-settings' );

            // output save settings button
            submit_button( 'Save Changes' );

        echo '</form>';
    echo '</div>';

}
function wpac_button_settings_page_cb() {
    //Check if current user have admin access.
    if(!is_admin()) {
        return;
    }
    echo '<div class="wrap">';
        echo '<h1 class="wpac-plugin-settings-head">'.esc_html(get_admin_page_title()).'</h1>';
        echo '<form action="options.php" method="post" class="wpac-setting-form">';

            // output security fields for the registered setting "wpac-settings"
            settings_fields( 'wpac-button-settings' );

            // output setting sections and their fields
            // (sections are registered for "wpac-settings", each field is registered to a specific section)
            do_settings_sections( 'wpac-button-settings' );

            // output save settings button
            submit_button( 'Save Changes' );

        echo '</form>';
    echo '</div>';

}
function wpac_reaction_settings_page_cb(){
    //Check if current user have admin access.
    if(!is_admin()) {
        return;
    }
    echo '<div class="wrap">';
        echo '<h1 class="wpac-plugin-settings-head">'.esc_html(get_admin_page_title()).'</h1>';
        echo '<form action="options.php" method="post" class="wpac-setting-form">';

            // output security fields for the registered setting "wpac-settings"
            settings_fields( 'wpac-reaction-settings' );

            // output setting sections and their fields
            // (sections are registered for "wpac-settings", each field is registered to a specific section)
            do_settings_sections( 'wpac-reaction-settings' );

            // output save settings button
            submit_button( 'Save Changes' );

        echo '</form>';
    echo '</div>';
}
function wpac_sharing_settings_page_cb(){
    //Check if current user have admin access.
    if(!is_admin()) {
        return;
    }
    echo '<div class="wrap">';
        echo '<h1 class="wpac-plugin-settings-head">'.esc_html(get_admin_page_title()).'</h1>';
        echo '<form action="options.php" method="post" class="wpac-setting-form">';

            // output security fields for the registered setting "wpac-settings"
            settings_fields( 'wpac-sharing-settings' );

            // output setting sections and their fields
            // (sections are registered for "wpac-settings", each field is registered to a specific section)
            do_settings_sections( 'wpac-sharing-settings' );

            // output save settings button
            submit_button( 'Save Changes' );

        echo '</form>';
    echo '</div>';
}