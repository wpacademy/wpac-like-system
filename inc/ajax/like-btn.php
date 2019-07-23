<?php
function wpac_like_btn_ajax_action() {

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
            _e("Sorry, you already liked/disliked this post or you are not logged-in","wpacademy-likedisklike");
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