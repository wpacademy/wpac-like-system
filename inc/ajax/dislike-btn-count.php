<?php
function wpac_dislike_btn_count_update() {
    $wpac_db = new WPAC_DB;
    if(isset($_POST['pid']) && wpac_check_post_id($_POST['pid'])) {

        $post_id = intval($_POST['pid']);

        if( !$post_id ) {
            $post_id = '';
        }
        if ( strlen( $post_id ) > 10 ) {
            $post_id = substr( $post_id, 0, 10 );
        }
        if($post_id != "" && $post_id > 0) {
            $dislike_count = $wpac_db->wpac_count_dislikes($post_id);
            $dislike_count = wpac_format_reaction_numbers($dislike_count);
            echo $dislike_count;
        } else {
            _e("invalid post id", "wpaclike");
        }
    }
    wp_die();
}