<?php
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
            _e("Sorry, but you already liked this post!","wpacademy-likedisklike");
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
                _e("Thank you for loving this post!","wpacademy-likedisklike");
            }
        }
        
    }
    wp_die();
}
add_action('wp_ajax_wpac_like_btn_ajax_action', 'wpac_like_btn_ajax_action');
add_action('wp_ajax_nopriv_wpac_like_btn_ajax_action', 'wpac_like_btn_ajax_action');