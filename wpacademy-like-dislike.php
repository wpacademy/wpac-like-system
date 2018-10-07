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

// Functions to performa database related quries.
require plugin_dir_path( __FILE__ ). 'inc/db-functions.php';

//Include Scripts & Styles
require plugin_dir_path( __FILE__ ). 'inc/scripts.php';

//Settings Menu & Page
require plugin_dir_path( __FILE__ ). 'inc/settings.php';

// Create Like & Dislike Buttons using filter.
require plugin_dir_path( __FILE__ ). 'inc/btns.php';


//WPAC Plugin Ajax Function for Like Button
function wpac_like_btn_ajax_action() {

    if(isset($_POST['pid']) && isset($_POST['uid'])) {

        $user_id = $_POST['uid'];
        $post_id = $_POST['pid'];
        $check_like = wpac_check_like($post_id, $user_id);
        if($check_like > 0) {
            _e("Sorry, you already liked this post or you are not logged-in","wpacademy-likedisklike");
        }
        else {
            $insert_like = wpac_insert_new_like($user_id, $post_id);
            if($insert_like == 1) {
                _e("Thank you for likig this post","wpacademy-likedisklike");
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
  
    if(isset($_POST['pid']) && isset($_POST['uid'])) {
        
        $user_id = $_POST['uid'];
        $post_id = $_POST['pid'];
        
        $check_dislike = wpac_check_deslike($post_id, $user_id);
        
        if($check_dislike > 0) {
            _e("Sorry, you already disliked this post or you are not logged-in","wpacademy-likedisklike");
        }
        else {
            $insert_like = wpac_insert_new_dislike($user_id, $post_id);
            if($insert_like == 1) {
                _e("Post has been disliked successfully!","wpacademy-likedisklike");
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
