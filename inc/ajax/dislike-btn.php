<?php
function wpac_dislike_btn_ajax_action() {

    $success_text = get_option('wpac_status_message_liked', 'Your Dislike is Saved Successfully');
    $error_text_disliked = get_option('wpac_status_error_liked', 'You have already Disliked this post');
    $error_text_general = get_option('wpac_status_message_error_general', 'There was an unknown error. Please contact Webmaster');
    $error_text_login = get_option('wpac_status_message_error_login', 'You must be logged-in to like this post');

    if(isset($_POST['uid']) && wpac_check_user($_POST['uid'])){
        if(isset($_POST['pid']) && wpac_check_post_id($_POST['pid'])) {
            
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
            
            if($check_dislike > 0 || $check_like > 0) {
                echo esc_textarea( $error_text_disliked );
            }
            else {
                $insert_dislike = wpac_insert_new_dislike($user_id, $post_id);
                if($insert_dislike == 1) {
                    echo esc_textarea( $success_text );
                } else {
                    echo esc_textarea( $error_text_general );
                }
            }
            
        }
    } else {
        echo esc_textarea( $error_text_login );
    }
    wp_die();
}