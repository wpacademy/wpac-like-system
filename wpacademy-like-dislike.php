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
//Include Scripts & Styles
require plugin_dir_path( __FILE__ ). 'inc/scripts.php';

//Settings Menu & Page
require plugin_dir_path( __FILE__ ). 'inc/settings.php';

// Create Table for our plugin.
require plugin_dir_path( __FILE__ ). 'inc/db.php';
register_activation_hook( __FILE__, 'wpac_likes_table' );

// Create Like & Dislike Buttons using filter.
require plugin_dir_path( __FILE__ ). 'inc/btns.php';

// Show Like & Dislike Count.
require plugin_dir_path( __FILE__ ). 'inc/show-count.php';

//WPAC Plugin Ajax Function for Like Button
function wpac_like_btn_ajax_action() {

    global $wpdb;
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

    $table_name = $wpdb->prefix . "wpac_like_system";
    if(isset($_POST['pid']) && isset($_POST['uid'])) {

        $user_id = $_POST['uid'];
        $post_id = $_POST['pid'];

        $check_like = $wpdb->get_var( $wpdb->prepare(
            "SELECT COUNT(*) FROM `$table_name` WHERE user_id = %d AND post_id = %d AND like_count=1 ",
            $user_id,
            $post_id
        ) );

        if($check_like > 0) {
            echo "Sorry, but you already liked this post!";
        }
        else {
            $wpdb->insert( 
                ''.$table_name.'', 
                array( 
                    'post_id' => $_POST['pid'], 
                    'user_id' => $_POST['uid'],
                    'like_count' => 1
                ), 
                array( 
                    '%d', 
                    '%d',
                    '%d'
                )
            );
            if($wpdb->insert_id) {
                echo "Thank you for loving this post!";
            }
        }
        
    }
    wp_die();
}
add_action('wp_ajax_wpac_like_btn_ajax_action', 'wpac_like_btn_ajax_action');
add_action('wp_ajax_nopriv_wpac_like_btn_ajax_action', 'wpac_like_btn_ajax_action');
    
//WPAC Plugin Ajax Function for DisLike Button
function wpac_dislike_btn_ajax_action() {
    
    global $wpdb;
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    
    $table_name = $wpdb->prefix . "wpac_like_system";
    if(isset($_POST['pid']) && isset($_POST['uid'])) {
        
        $user_id = $_POST['uid'];
        $post_id = $_POST['pid'];
        

        $check_dislike = $wpdb->get_var( $wpdb->prepare(
            "SELECT COUNT(*) FROM `$table_name` WHERE user_id = %d AND post_id = %d AND dislike_count=1 ",
            $user_id,
            $post_id
        ) );
        
        if($check_dislike > 0) {
            echo "Sorry, but you already disliked this post!";
        }
        else {
            $wpdb->insert(
                      ''.$table_name.'',
                      array(
                            'post_id' => $_POST['pid'],
                            'user_id' => $_POST['uid'],
                            'dislike_count' => 1
                            ),
                      array(
                            '%d',
                            '%d',
                            '%d'
                            )
                      );
            if($wpdb->insert_id) {
                echo "That's sad! :(";
            }
        }
        
    }
    wp_die();
}
add_action('wp_ajax_wpac_dislike_btn_ajax_action', 'wpac_dislike_btn_ajax_action');
add_action('wp_ajax_nopriv_wpac_dislike_btn_ajax_action', 'wpac_dislike_btn_ajax_action');

?>
