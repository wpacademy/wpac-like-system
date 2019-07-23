<?php
function wpac_format_reaction_numbers($num) {

    if($num>1000) {

            $x = round($num);
            $x_number_format = number_format($x);
            $x_array = explode(',', $x_number_format);
            $x_parts = array('k', 'm', 'b', 't');
            $x_count_parts = count($x_array) - 1;
            $x_display = $x;
            $x_display = $x_array[0] . ((int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
            $x_display .= $x_parts[$x_count_parts - 1];

            return $x_display;

    }
    return $num;

}
// Count total number of likes for given post ID
function wpac_count_likes($pid){

    global $wpdb;

    $table_name = $wpdb->prefix . "wpac_like_system";
    $post_id = $pid;
    $wpdb->hide_errors(); 
    $like_count = $wpdb->get_var( $wpdb->prepare(
        "SELECT COUNT(*) FROM `$table_name` WHERE post_id = %d AND like_count=1 ",
        $post_id
    ) );

    return $like_count;
}
// Count total number of dislikes for given post ID
function wpac_count_dislikes($pid){
        global $wpdb;

        $table_name = $wpdb->prefix . "wpac_like_system";
        $post_id = $pid;
        $wpdb->hide_errors(); 
        $dislike_count = $wpdb->get_var( $wpdb->prepare(
            "SELECT COUNT(*) FROM `$table_name` WHERE post_id = %d AND dislike_count=1",
            $post_id
        ) );
        
    return $dislike_count;
}
// Count number of individual reactions
function wpac_reaction_count($pid,$reaction) {
    global $wpdb;

    $table_name = $wpdb->prefix . "wpac_reactions_system";
    $post_id = $pid;
    $reaction_id = $reaction;
    $wpdb->hide_errors(); 
    $reaction_count = $wpdb->get_var( $wpdb->prepare(
        "SELECT COUNT(*) FROM `$table_name` WHERE post_id = %d AND reaction_id = %d",
        $post_id,
        $reaction_id
    ) );

    return $reaction_count;
}
// Check if a user has already liked the post
function wpac_check_like($pid, $uid) {
    global $wpdb;
    $table_name = $wpdb->prefix . "wpac_like_system";
    $user_id = $uid;
    $post_id = $pid;
    $check_like = $wpdb->get_var( $wpdb->prepare(
        "SELECT COUNT(*) FROM `$table_name` WHERE user_id = %d AND post_id = %d AND like_count=1 ",
        $user_id,
        $post_id
    ) );
    return $check_like;
}
// Check if a user has already disliked the post
function wpac_check_deslike($pid, $uid){
    global $wpdb;
    $table_name = $wpdb->prefix . "wpac_like_system";
    $user_id = $uid;
    $post_id = $pid;
    $check_dislike = $wpdb->get_var( $wpdb->prepare(
        "SELECT COUNT(*) FROM `$table_name` WHERE user_id = %d AND post_id = %d AND dislike_count=1 ",
        $user_id,
        $post_id
    ) );
    return $check_dislike;
}
// Check if a user has already reacted to the post
function wpac_check_reaction($pid, $uid) {
    global $wpdb;
    $table_name = $wpdb->prefix . "wpac_reactions_system";
    $user_id = $uid;
    $post_id = $pid;
    $check_reaction = $wpdb->get_var( $wpdb->prepare(
        "SELECT COUNT(*) FROM `$table_name` WHERE user_id = %d AND post_id = %d",
        $user_id,
        $post_id
    ) );
    return $check_reaction;
}
// Add new like to database
function wpac_insert_new_like($uid, $pid) {

    global $wpdb;
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    $table_name = $wpdb->prefix . "wpac_like_system";
    $wpdb->hide_errors(); 
    $user_id = $uid;
    $post_id = $pid;

    $status = 0;
    if($user_id > 0 && $user_id != "" && $post_id > 0 && $post_id != ""){
        $wpdb->insert( 
            ''.$table_name.'', 
            array( 
                'post_id' => $post_id,
                'user_id' => $user_id,
                'like_count' => 1
            ), 
            array( 
                '%d', 
                '%d',
                '%d'
            )
        );
        if($wpdb->insert_id) {
            $status = 1;
            return $status;
        } else {
            $status = 0;
            return $status;
        }
    } else {
        $status = 0;
    }
}
// Add new dislike to database
function wpac_insert_new_dislike($uid, $pid) {

    global $wpdb;
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    $table_name = $wpdb->prefix . "wpac_like_system";
    $wpdb->hide_errors(); 
    $user_id = $uid;
    $post_id = $pid;

    $status = 0;
    if($user_id > 0 && $user_id != "" && $post_id > 0 && $post_id != ""){
        $wpdb->insert(
            ''.$table_name.'',
            array(
                'post_id' => $post_id,
                'user_id' => $user_id,
                'dislike_count' => 1
            ),
            array(
                '%d',
                '%d',
                '%d'
            )
        );
        if($wpdb->insert_id) {
            $status = 1;
            return $status;
        } else {
            $status = 0;
            return $status;
        }
    } else {
        $status = 0;
    }
}
// Add new reaction to database
function wpac_insert_new_reaction($uid, $pid, $rid) {

    global $wpdb;
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    $table_name = $wpdb->prefix . "wpac_reactions_system";
    $wpdb->hide_errors(); 
    $user_id = intval($uid);
    $post_id = intval($pid);
    $reaction_id = intval($rid);

    $status = 0;
    if($user_id > 0 && $user_id != "" && $post_id > 0 && $post_id != "" && $reaction_id > 0 && $reaction_id !=""){
        $wpdb->insert( 
            ''.$table_name.'', 
            array( 
                'post_id' => $post_id,
                'user_id' => $user_id,
                'reaction_id' => $reaction_id
            ), 
            array( 
                '%d', 
                '%d',
                '%d'
            )
        );
        if($wpdb->insert_id) {
            $status = 1;
            return $status;
        } else {
            $status = 0;
            return $status;
        }
    } else {
        $status = 0;
    }
}