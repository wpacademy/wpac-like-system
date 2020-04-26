<?php
function wpac_dislike_btn_ajax_action() {

    $wpac_db = new WPAC_DB;
    $success_text = get_option('wpac_status_message_liked', 'Your Dislike is Saved Successfully');
    $error_text_liked = get_option('wpac_status_error_liked', 'Sorry, you already liked this post');
    $error_text_disliked = get_option('wpac_status_error_liked', 'You have already Disliked this post');
    $error_text_general = get_option('wpac_status_message_error_general', 'There was an unknown error. Please contact Webmaster');
    $error_text_login = get_option('wpac_status_message_error_login', 'You must be logged-in to like this post');
    $save_type = get_option('wpac_save_type');

    if(isset($_POST['uid']) && wpac_check_user($_POST['uid']) && $save_type == 1){
        if(isset($_POST['pid']) && wpac_check_post_id($_POST['pid'])) {
            
            $user_id = intval($_POST['uid']);
            $post_id = intval($_POST['pid']);
            $user_ip = sanitize_text_field($_POST['uip']);

            if( !$user_id ) {
                $user_id = '';
            }
            if( !$post_id ) {
                $post_id = '';
            }
            if ( strlen( $user_ip ) > 40 ) {
                $user_ip = substr( $user_ip, 0, 40 );
            }
            if ( strlen( $user_id ) > 10 ) {
                $user_id = substr( $user_id, 0, 10 );
            }
            if ( strlen( $post_id ) > 10 ) {
                $post_id = substr( $post_id, 0, 10 );
            }
            $check_like = $wpac_db->wpac_check_like($post_id, $user_id);
            $check_dislike = $wpac_db->wpac_check_deslike($post_id, $user_id);
            
            if($check_like > 0) {
                echo esc_textarea( $error_text_liked );
            } elseif($check_dislike > 0) {
                echo esc_textarea( $error_text_disliked );
            }
            else {
                $insert_dislike = $wpac_db->wpac_insert_new_dislike($user_id, $user_ip, $post_id);
                if($insert_dislike == 1) {
                    echo esc_textarea( $success_text );
                } else {
                    echo esc_textarea( $error_text_general );
                }
            }
            
        }
    } elseif(isset($_POST['uid']) && $_POST['uid'] == 0 && $save_type == 1) {
        echo esc_textarea( $error_text_login );
    } else {
        if(isset($_POST['pid']) && wpac_check_post_id($_POST['pid']) && isset($_POST['uip'])) {

            if(isset($_POST['uid'])) {
                $user_id = intval($_POST['uid']);
            } else {
                $user_id = 0;
            }
            $user_ip = sanitize_text_field($_POST['uip']);
            $user_id = intval($_POST['uid']);
            $post_id = intval($_POST['pid']);

            if( !$post_id ) {
                $post_id = '';
            }
            if ( strlen( $user_ip ) > 40 ) {
                $user_ip = substr( $user_ip, 0, 40 );
            }
            if ( strlen( $post_id ) > 10 ) {
                $post_id = substr( $post_id, 0, 10 );
            }
            $check_like = $wpac_db->wpac_check_like_ip($post_id, $user_ip);
            $check_dislike = $wpac_db->wpac_check_deslike_ip($post_id, $user_ip);
            
            if($check_like > 0) {
                echo esc_textarea( $error_text_liked );
            } elseif($check_dislike > 0) {
                echo esc_textarea( $error_text_disliked );
            }
            else {
                $insert_dislike = $wpac_db->wpac_insert_new_dislike($user_id, $user_ip, $post_id);
                if($insert_dislike == 1) {
                    echo esc_textarea( $success_text );
                } else {
                    echo esc_textarea( $error_text_general );
                }
            }
            
        }
    }
    wp_die();
}