<?php
$btns_position = get_option('wpac_reaction_position', '2');
function wpac_reactions_system($content) {

    $wpac_db = new WPAC_DB;
    // Get display & position settings for reactoions
    $btns_position = get_option('wpac_reaction_position', '2');
    $reactions_style = get_option('wpac_reaction_style', '1');
    $hide_reaction_stats = get_option('wpac_hide_reaction_count', 'off');
    $hide_reaction_label = get_option('wpac_hide_reaction_label', 'off');

    // Fetch labels for reactions
    $reaction_label_1 = get_option( 'wpac_reaction_1_label', 'Like' );
    $reaction_label_2 = get_option( 'wpac_reaction_2_label', 'Love' );
    $reaction_label_3 = get_option( 'wpac_reaction_3_label', 'Haha' );
    $reaction_label_4 = get_option( 'wpac_reaction_4_label', 'Shocked' );
    $reaction_label_5 = get_option( 'wpac_reaction_5_label', 'Sad' );
    $reaction_label_6 = get_option( 'wpac_reaction_6_label', 'Angry' );

    //fetch Stats for reactions
    $user_id = get_current_user_id();
    $post_id = get_the_ID();

    $like_reactions = $wpac_db->wpac_reaction_count($post_id, 1);
    $like_reactions = wpac_format_reaction_numbers($like_reactions);

    $heart_reactions = $wpac_db->wpac_reaction_count($post_id, 2);
    $heart_reactions = wpac_format_reaction_numbers($heart_reactions);

    $laugh_reactions = $wpac_db->wpac_reaction_count($post_id, 3);
    $laugh_reactions = wpac_format_reaction_numbers($laugh_reactions);

    $amazed_reactions = $wpac_db->wpac_reaction_count($post_id, 4);
    $amazed_reactions = wpac_format_reaction_numbers($amazed_reactions);

    $sad_reactions = $wpac_db->wpac_reaction_count($post_id, 5);
    $sad_reactions = wpac_format_reaction_numbers($sad_reactions);

    $angry_reactions = $wpac_db->wpac_reaction_count($post_id, 6);
    $angry_reactions = wpac_format_reaction_numbers($angry_reactions);


    // Make sure single post is being viewed.
    if(is_single()) {

            if($reactions_style == 2){
                $reactions_wrap_start = '<div class="wpac-reactions-container emoji-reactions">';
            } else {
                $reactions_wrap_start = '<div class="wpac-reactions-container font-reactions">';
            }

            //Like Reaction Button
            $like_reaction = '<div class="wpac-reaction-icon-box wpac-like-reaction">';
                $like_reaction .= '<a href="javascript:" onclick="wpac_save_reaction_ajax('.$post_id.',1)" class="wpac-reaction">';

                    if($reactions_style == 2){
                        $like_reaction .= '<span class="wpac-reaction-icon"><img src="'.WPAC_PLUGIN_DIR.'/assets/img/emoji_like_1.png" alt="Like Reaction"></span>';
                    } else {
                        $like_reaction .= '<span class="wpac-reaction-icon"><i class="far fa-smile"></i></span>';
                    }
                    if($hide_reaction_stats != "on") {
                        $like_reaction .= '<span id="wpacR1" class="wpac-reaction-count">'.$like_reactions.'</span>';
                    }
                    if($hide_reaction_label != "on") {
                        $like_reaction .= '<span class="wpac-reation-tooltip">'.$reaction_label_1.'</span>';
                    }

                $like_reaction .= '</a>';
            $like_reaction .= '</div>';

            //Love Reaction Button
            $love_reaction = '<div class="wpac-reaction-icon-box wpac-love-reaction">';
                $love_reaction .= '<a href="javascript:" onclick="wpac_save_reaction_ajax('.$post_id.',2)" class="wpac-reaction">';

                    if($reactions_style == 2){
                        $love_reaction .= '<span class="wpac-reaction-icon"><img src="'.WPAC_PLUGIN_DIR.'/assets/img/emoji_love_1.png" alt="Like Reaction"></span>';
                    } else {
                        $love_reaction .= '<span class="wpac-reaction-icon"><i class="far fa-grin-hearts"></i></span>';
                    }
                    if($hide_reaction_stats != "on") {
                        $love_reaction .= '<span id="wpacR2" class="wpac-reaction-count">'.$heart_reactions.'</span>';
                    }
                    if($hide_reaction_label != "on") {
                        $love_reaction .= '<span class="wpac-reation-tooltip">'.$reaction_label_2.'</span>';
                    }

                $love_reaction .= '</a>';
            $love_reaction .= '</div>';

            //Laugh Reaction Button
            $laugh_reaction = '<div class="wpac-reaction-icon-box wpac-laugh-reaction">';
                $laugh_reaction .= '<a href="javascript:" onclick="wpac_save_reaction_ajax('.$post_id.',3)" class="wpac-reaction">';

                    if($reactions_style == 2){
                        $laugh_reaction .= '<span class="wpac-reaction-icon"><img src="'.WPAC_PLUGIN_DIR.'/assets/img/emoji_laugh_1.png" alt="Like Reaction"></span>';
                    } else {
                        $laugh_reaction .= '<span class="wpac-reaction-icon"><i class="far fa-grin-squint-tears"></i></span>';
                    }
                    if($hide_reaction_stats != "on") {
                        $laugh_reaction .= '<span id="wpacR3" class="wpac-reaction-count">'.$laugh_reactions.'</span>';
                    }
                    if($hide_reaction_label != "on") {
                        $laugh_reaction .= '<span class="wpac-reation-tooltip">'.$reaction_label_3.'</span>';
                    }

                $laugh_reaction .= '</a>';
            $laugh_reaction .= '</div>';

            //Amazed Reaction Button
            $amazed_reaction = '<div class="wpac-reaction-icon-box wpac-amazed-reaction">';
                $amazed_reaction .= '<a href="javascript:" onclick="wpac_save_reaction_ajax('.$post_id.',4)" class="wpac-reaction">';

                    if($reactions_style == 2){
                        $amazed_reaction .= '<span class="wpac-reaction-icon"><img src="'.WPAC_PLUGIN_DIR.'/assets/img/emoji_shocked_1.png" alt="Like Reaction"></span>';
                    } else {
                        $amazed_reaction .= '<span class="wpac-reaction-icon"><i class="far fa-flushed"></i></span>';
                    }
                    if($hide_reaction_stats != "on") {
                        $amazed_reaction .= '<span id="wpacR4" class="wpac-reaction-count">'.$amazed_reactions.'</span>';
                    }
                    if($hide_reaction_label != "on") {
                        $amazed_reaction .= '<span class="wpac-reation-tooltip">'.$reaction_label_4.'</span>';
                    }

                $amazed_reaction .= '</a>';
            $amazed_reaction .= '</div>';

            //Sad Reaction Button
            $sad_reaction = '<div class="wpac-reaction-icon-box wpac-sad-reaction">';
                $sad_reaction .= '<a href="javascript:" onclick="wpac_save_reaction_ajax('.$post_id.',5)" class="wpac-reaction">';

                    if($reactions_style == 2){
                        $sad_reaction .= '<span class="wpac-reaction-icon"><img src="'.WPAC_PLUGIN_DIR.'/assets/img/emoji_sad_1.png" alt="Like Reaction"></span>';
                    } else {
                        $sad_reaction .= '<span class="wpac-reaction-icon"><i class="far fa-sad-tear"></i></span>';
                    }
                    if($hide_reaction_stats != "on") {
                        $sad_reaction .= '<span id="wpacR5" class="wpac-reaction-count">'.$sad_reactions.'</span>';
                    }
                    if($hide_reaction_label != "on") {
                        $sad_reaction .= '<span class="wpac-reation-tooltip">'.$reaction_label_5.'</span>';
                    }

                $sad_reaction .= '</a>';
            $sad_reaction .= '</div>';

            //Angry Reaction Button
            $angry_reaction = '<div class="wpac-reaction-icon-box wpac-angry-reaction">';
                $angry_reaction .= '<a href="javascript:" onclick="wpac_save_reaction_ajax('.$post_id.',6)" class="wpac-reaction">';

                    if($reactions_style == 2){
                        $angry_reaction .= '<span class="wpac-reaction-icon"><img src="'.WPAC_PLUGIN_DIR.'/assets/img/emoji_angry_1.png" alt="Like Reaction"></span>';
                    } else {
                        $angry_reaction .= '<span class="wpac-reaction-icon"><i class="far fa-angry"></i></span>';
                    }
                    if($hide_reaction_stats != "on") {
                        $angry_reaction .= '<span id="wpacR6" class="wpac-reaction-count">'.$angry_reactions.'</span>';
                    }
                    if($hide_reaction_label != "on") {
                        $angry_reaction .= '<span class="wpac-reation-tooltip">'.$reaction_label_6.'</span>';
                    }

                $angry_reaction .= '</a>';
            $angry_reaction .= '</div>';
        
        $reactions_wrap_end = '</div>';
        $wpac_ajax_response = '<div id="wpacAjaxResponse" class="wpac-ajax-response"><span></span></div>';

        if(isset($btns_position) && $btns_position == 1) {

            $before_content_btns = "";
            $before_content_btns .= $reactions_wrap_start;

            $before_content_btns .= $like_reaction;
            $before_content_btns .= $love_reaction;
            $before_content_btns .= $laugh_reaction;
            $before_content_btns .= $amazed_reaction;
            $before_content_btns .= $sad_reaction;
            $before_content_btns .= $angry_reaction;
            
            $before_content_btns .= $reactions_wrap_end;
            $before_content_btns .= $wpac_ajax_response;

            $content = $before_content_btns . $content;

        } else {

            $content .= $reactions_wrap_start;

            $content .= $like_reaction;
            $content .= $love_reaction;
            $content .= $laugh_reaction;
            $content .= $amazed_reaction;
            $content .= $sad_reaction;
            $content .= $angry_reaction;

            $content .= $reactions_wrap_end;
            $content .= $wpac_ajax_response;

        }
    }
    return $content;

}
function wpac_shortcode_position_notice(){
    $notice = "<h3>You need to select CUSTOM location to use this SHORTCODE</h3>";
    return $notice;
}
if($btns_position == 3) {
    add_shortcode( 'WPAC_LIKE_SYSTEM' , 'wpac_reactions_system' );
} else {
    add_filter('the_content', 'wpac_reactions_system');
    add_shortcode( 'WPAC_LIKE_SYSTEM' , 'wpac_shortcode_position_notice' );
}
