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

//WPAC Plugin Ajax Function for Like Button
function wpac_like_btn_ajax_action() {

    global $wpdb;
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

    $table_name = $wpdb->prefix . "wpac_like_system";
    if(isset($_POST['pid']) && isset($_POST['uid'])) {

        $user_id = $_POST['uid'];
        $post_id = $_POST['pid'];

         $check_like = $wpdb->get_var( $wpdb->prepare(
            "SELECT COUNT(*) FROM %s WHERE user_id = %d AND post_id = %d AND like_count=1 ",
              $table_name,
              $user_id,
              $post_id
            ) );

        if($check_like > 0) {
            echo "Sorry, buyt you already liked this post!";
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
            "SELECT COUNT(*) FROM %s WHERE user_id = %d AND post_id = %d AND dislike_count=1 ",
              $table_name,
              $user_id,
              $post_id
            ) );
        
        if($check_dislike > 0) {
            echo "Sorry, buyt you already disliked this post!";
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

function wpac_show_like_count($content){
    if(is_single()) {
        global $wpdb;
        $table_name = $wpdb->prefix . "wpac_like_system";
        $post_id = get_the_ID();
        $like_count = $wpdb->get_var( "SELECT COUNT(*) FROM $table_name WHERE post_id='$post_id' AND like_count=1 " );
        $dislike_count = $wpdb->get_var( "SELECT COUNT(*) FROM $table_name WHERE post_id='$post_id' AND dislike_count=1 " );
        $like_count_result = "<center>This post has been liked <strong>".$like_count."</strong>, time(s) & disliked <strong>".$dislike_count."</strong> time(s) </center>";
        $content .= $like_count_result;
    }
    return $content;
}
add_filter('the_content', 'wpac_show_like_count');
?>
