<?php

if( !function_exists('wpac_plugin_scripts')) {
    function wpac_plugin_scripts() {

        //Plugin Frontend CSS
        wp_enqueue_style('wpac-css', WPAC_PLUGIN_DIR. 'assets/css/style.css');

        //FontAwesome CSS
        wp_enqueue_style( 'wpac-font-awesome', WPAC_PLUGIN_DIR. 'assets/font-awesome/css/fontawesome-all.min.css', array(), NULL);
        
        //Plugin Frontend JS
        wp_enqueue_script('wpac-js', WPAC_PLUGIN_DIR. 'assets/js/main.js', 'jQuery', '1.0.0', true );

        //Plugin Ajax JS
        wp_enqueue_script('wpac-ajax', WPAC_PLUGIN_DIR. 'assets/js/ajax.js', 'jQuery', '1.0.0', true );

        wp_localize_script( 'wpac-ajax', 'wpac_ajax_url', array(
            'ajax_url' => admin_url( 'admin-ajax.php' )
        ));
    }
    add_action('wp_enqueue_scripts', 'wpac_plugin_scripts');
}