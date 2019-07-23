<?php
/*
* Plugin Name: WPAC Like & Reaction System
* Plugin URI: https://github.com/wpacademy/wpac-like-system
* Author: WPacademy.PK
* Author URI: https://wpacademy.pk
* Description: The Most Simple WordPress Post Like, Dislike & Reaction System. 
* Version: 2.0.0
* License: GPL2
* License URI:  https://www.gnu.org/licenses/gpl-2.0.html
* Text Domain: wpaclike
*/

//If this file is called directly, abort.
if (!defined( 'WPINC' )) {
    die;
}

//Define Constants
if ( !defined('WPAC_PLUGIN_DIR')) {
    define('WPAC_PLUGIN_DIR', plugin_dir_url( __FILE__ ));
}
if ( !defined('WPAC_PLUGIN_DIR_PATH')) {
    define('WPAC_PLUGIN_DIR_PATH', plugin_dir_path( __FILE__ ));
}
//Get value for system type
$wpac_system_type = get_option('wpac_system_type');

// Create Table for our plugin.
require WPAC_PLUGIN_DIR_PATH. 'inc/db.php';
register_activation_hook( __FILE__, 'wpac_likes_table' );
register_activation_hook( __FILE__, 'wpac_reactions_table' );

// remove all option setting on deactivation
register_deactivation_hook( __FILE__, function(){
    delete_option('wpac_like_btn_label');
    delete_option('wpac_dislike_btn_label');
    delete_option('wpac_button_position');
    delete_option('wpac_hide_like_button');
    delete_option('wpac_hide_dislike_button');
    delete_option('wpac_stats_position');
});

// WPAC Validation Functions.
require WPAC_PLUGIN_DIR_PATH. 'inc/validate.php';

// Functions to performa database related quries.
require WPAC_PLUGIN_DIR_PATH. 'inc/db-functions.php';

//Include Scripts & Styles
require WPAC_PLUGIN_DIR_PATH. 'inc/scripts.php';

//Settings Menu & Page
require WPAC_PLUGIN_DIR_PATH. 'inc/settings.php';

// Display the Like/Dislike or Reaction System based on user selection.
if(isset($wpac_system_type) && $wpac_system_type == 1) {
    require WPAC_PLUGIN_DIR_PATH. 'inc/btns.php';
} else {
    require WPAC_PLUGIN_DIR_PATH. 'inc/reactions.php';
}

// WPAC Shortcodes.
require WPAC_PLUGIN_DIR_PATH. 'inc/shortcodes.php';

//WPAC Plugin Ajax Function for Like Button
require WPAC_PLUGIN_DIR_PATH. 'inc/ajax/like-btn.php';
add_action('wp_ajax_wpac_like_btn_ajax_action', 'wpac_like_btn_ajax_action');
add_action('wp_ajax_nopriv_wpac_like_btn_ajax_action', 'wpac_like_btn_ajax_action');
    
//WPAC Plugin Ajax Function for DisLike Button
require WPAC_PLUGIN_DIR_PATH. 'inc/ajax/dislike-btn.php';
add_action('wp_ajax_wpac_dislike_btn_ajax_action', 'wpac_dislike_btn_ajax_action');
add_action('wp_ajax_nopriv_wpac_dislike_btn_ajax_action', 'wpac_dislike_btn_ajax_action');

//WPAC Plugin Ajax Function for Saving Reaction
require WPAC_PLUGIN_DIR_PATH. 'inc/ajax/save-reaction.php';
add_action('wp_ajax_wpac_save_reaction_ajax_action', 'wpac_save_reaction_ajax_action');
add_action('wp_ajax_nopriv_wpac_save_reaction_ajax_action', 'wpac_save_reaction_ajax_action');

?>
