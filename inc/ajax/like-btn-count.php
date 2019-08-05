<?php
function wpac_like_btn_count_update() {
    if(isset($_POST['pid']) && wpac_check_post_id($_POST['pid'])) {

        $post_id = intval($_POST['pid']);

        if( !$post_id ) {
            $post_id = '';
        }
        if ( strlen( $post_id ) > 10 ) {
            $post_id = substr( $post_id, 0, 10 );
        }
        if($post_id != "" && $post_id > 0) {
            $like_count = wpac_count_likes($post_id);
            $like_count = wpac_format_reaction_numbers($like_count);
            echo $like_count;
        } else {
            _e("invalid post id", "wpaclike");
        }
    }
    wp_die();
}