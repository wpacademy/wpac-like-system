<?php
function wpac_show_count($content){
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
add_filter('the_content', 'wpac_show_count');