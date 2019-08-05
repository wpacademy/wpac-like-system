<?php
function wpac_save_reaction_ajax_action() {

    if(isset($_POST['uid']) && wpac_check_user($_POST['uid'])) {
        if(isset($_POST['pid']) && wpac_check_post_id($_POST['pid']) && isset($_POST['rid'])) {

            $user_id = intval($_POST['uid']);
            $post_id = intval($_POST['pid']);
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
            if ( strlen( $post_id ) > 10 ) {
                $post_id = substr( $post_id, 0, 10 );
            }
            if ( strlen( $reaction_id ) > 10 ) {
                $reaction_id = substr( $reaction_id, 0, 10 );
            }

            $check_reaction = wpac_check_reaction($post_id, $user_id);

            if($check_reaction > 0) {
                _e("Sorry, you already reacted to this post","wpaclike");
            }
            else {
                $insert_reaction = wpac_insert_new_reaction($user_id, $post_id, $reaction_id);
                if($insert_reaction == 1) {
                    _e("Reaction Saved","wpaclike");
                } else {
                    _e("Rection Could Not Be Saved!","wpaclike");
                }
            }

        }
    } else {
        _e("You must be logged-in to react to this post", "wpaclike");
    }
    wp_die();
}