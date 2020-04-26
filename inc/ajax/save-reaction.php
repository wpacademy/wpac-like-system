<?php
function wpac_save_reaction_ajax_action() {
    $wpac_db = new WPAC_DB;
    $save_type = get_option('wpac_save_type');
    if(isset($_POST['uid']) && wpac_check_user($_POST['uid']) && $save_type == 1) {
        if(isset($_POST['pid']) && wpac_check_post_id($_POST['pid']) && isset($_POST['rid'])) {

            $user_id = intval($_POST['uid']);
            $post_id = intval($_POST['pid']);
            $user_ip = sanitize_text_field($_POST['uip']);
            $reaction_id = intval($_POST['rid']);

            if( !$user_id ) {
                $user_id = '';
            }
            if( !$post_id ) {
                $post_id = '';
            }
            if( !$reaction_id ) {
                $reaction_id = '';
            }
            if ( strlen( $user_id ) > 10 ) {
                $user_id = substr( $user_id, 0, 10 );
            }
            if ( strlen( $user_ip ) > 40 ) {
                $user_ip = substr( $user_ip, 0, 40 );
            }
            if ( strlen( $post_id ) > 10 ) {
                $post_id = substr( $post_id, 0, 10 );
            }
            if ( strlen( $reaction_id ) > 10 ) {
                $reaction_id = substr( $reaction_id, 0, 10 );
            }

            $check_reaction = $wpac_db->wpac_check_reaction($post_id, $user_id);

            if($check_reaction > 0) {
                _e("Sorry, you already reacted to this post","wpaclike");
            }
            else {
                $insert_reaction = $wpac_db->wpac_insert_new_reaction($user_id, $user_ip, $post_id, $reaction_id);
                if($insert_reaction == 1) {
                    _e("Reaction Saved","wpaclike");
                } else {
                    _e("Rection Could Not Be Saved!","wpaclike");
                }
            }

        }
    } elseif(isset($_POST['uid']) && $_POST['uid'] == 0 && $save_type == 1) {
        _e("You must be logged-in to react to this post", "wpaclike");
    } else {
        if(isset($_POST['pid']) && wpac_check_post_id($_POST['pid']) && isset($_POST['rid'])) {

            if(isset($_POST['uid'])) {
                $user_id = intval($_POST['uid']);
            } else {
                $user_id = 0;
            }
            $post_id = intval($_POST['pid']);
            $user_ip = sanitize_text_field($_POST['uip']);
            $reaction_id = intval($_POST['rid']);

            if( !$post_id ) {
                $post_id = '';
            }
            if( !$reaction_id ) {
                $reaction_id = '';
            }
            if ( strlen( $user_ip ) > 40 ) {
                $user_ip = substr( $user_ip, 0, 40 );
            }
            if ( strlen( $post_id ) > 10 ) {
                $post_id = substr( $post_id, 0, 10 );
            }
            if ( strlen( $reaction_id ) > 10 ) {
                $reaction_id = substr( $reaction_id, 0, 10 );
            }
            
            $check_reaction = $wpac_db->wpac_check_reaction_ip($post_id, $user_ip);

            if($check_reaction > 0) {
                _e("Sorry, you already reacted to this post","wpaclike");
            }
            else {
                $insert_reaction = $wpac_db->wpac_insert_new_reaction($user_id, $user_ip, $post_id, $reaction_id);
                if($insert_reaction == 1) {
                    _e("Reaction Saved","wpaclike");
                } else {
                    echo ($user_id." ". $user_ip ." ". $post_id ." ". $reaction_id);
                    _e("Rection Could Not Be Saved!","wpaclike");
                }
            }

        }
    }
    wp_die();
}