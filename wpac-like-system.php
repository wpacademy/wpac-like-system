<?php
/*
* Plugin Name: WPAC Like System
* Plugin URI: https://github.com/wpacademy/wpac-like-system
* Author: WPacademy.PK
* Author URI: https://wpacademy.pk
* Description: Simple Post Like & Dislike System.
* Version: 1.0.0
* License: GPL2
* License URI:  https://www.gnu.org/licenses/gpl-2.0.html
* Text Domain: wpaclike
*/

//If this file is called directly, abort.
if (!defined( 'WPINC' )) {
    die;
}

//Define Constants
if ( !defined('WPAC_PLUGIN_VERSION')) {
    define('WPAC_PLUGIN_VERSION', '1.0.0');
}
if ( !defined('WPAC_PLUGIN_DIR')) {
    define('WPAC_PLUGIN_DIR', plugin_dir_url( __FILE__ ));
}
// Create Table for our plugin.
require plugin_dir_path( __FILE__ ). 'inc/db.php';
register_activation_hook( __FILE__, 'wpac_likes_table' );

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
require plugin_dir_path( __FILE__ ). 'inc/validate.php';

// Functions to performa database related quries.
require plugin_dir_path( __FILE__ ). 'inc/db-functions.php';

//Include Scripts & Styles
require plugin_dir_path( __FILE__ ). 'inc/scripts.php';

//Settings Menu & Page
require plugin_dir_path( __FILE__ ). 'inc/settings.php';

// Create Like & Dislike Buttons using filter.
require plugin_dir_path( __FILE__ ). 'inc/btns.php';

// WPAC Shortcodes.
require plugin_dir_path( __FILE__ ). 'inc/shortcodes.php';


//WPAC Plugin Ajax Function for Like Button
function wpac_like_btn_ajax_action() {
    $like_click = get_option('wpac_click_btn');
    $like_click_success = get_option('wpac_click_like_btn');
    if(isset($_POST['pid']) && isset($_POST['uid']) && wpac_check_post_id($_POST['pid']) && wpac_check_user($_POST['uid'])) {

        $user_id = intval($_POST['uid']);
        $post_id = intval($_POST['pid']);

        if( !$user_id ) {
            $user_id = '';
        }
        if( !$post_id ) {
            $post_id = '';
        }
        if ( strlen( $user_id ) > 10 ) {
            $user_id = substr( $user_id, 0, 10 );
        }
        if ( strlen( $post_id ) > 10 ) {
            $post_id = substr( $post_id, 0, 10 );
        }

        $check_like = wpac_check_like($post_id, $user_id);
        $check_dislike = wpac_check_deslike($post_id, $user_id);
        if($check_like > 0 || $check_dislike > 0) {
            _e( $like_click ,"wpacademy-likedisklike");
        }
        else {
            $insert_like = wpac_insert_new_like($user_id, $post_id);
            if($insert_like == 1) {
                _e( $like_click_success ,"wpacademy-likedisklike");
            } else {
                _e("There was an error adding your like count, please try again or contact webmaster!","wpacademy-likedisklike");
            }
        }
        
    }
    wp_die();
}
add_action('wp_ajax_wpac_like_btn_ajax_action', 'wpac_like_btn_ajax_action');
add_action('wp_ajax_nopriv_wpac_like_btn_ajax_action', 'wpac_like_btn_ajax_action');
    
//WPAC Plugin Ajax Function for DisLike Button
function wpac_dislike_btn_ajax_action() {
    $like_click = get_option('wpac_click_btn');
    $dislike_click_success = get_option('wpac_click_dislike_btn');
    if(isset($_POST['pid']) && isset($_POST['uid']) && wpac_check_user($_POST['uid']) && wpac_check_post_id($_POST['pid'])) {
        
        $user_id = wp_strip_all_tags($_POST['uid']);
        $post_id = wp_strip_all_tags($_POST['pid']);
        
        $check_like = wpac_check_like($post_id, $user_id);
        $check_dislike = wpac_check_deslike($post_id, $user_id);
        
        if($check_dislike > 0 || $check_like > 0) {
            _e( $like_click ,"wpacademy-likedisklike");
        }
        else {
            $insert_like = wpac_insert_new_dislike($user_id, $post_id);
            if($insert_like == 1) {
                _e($dislike_click_success ,"wpacademy-likedisklike");
            } else {
                _e("There was an error adding your dislike count, please try again or contact webmaster!","wpacademy-likedisklike");
            }
        }
        
    }
    wp_die();
}
add_action('wp_ajax_wpac_dislike_btn_ajax_action', 'wpac_dislike_btn_ajax_action');
add_action('wp_ajax_nopriv_wpac_dislike_btn_ajax_action', 'wpac_dislike_btn_ajax_action');

?>
