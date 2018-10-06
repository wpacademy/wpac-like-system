<?php

function wpac_like_dislike_buttons($content) {

    // Get display & position settings for buttons
    $btns_position = get_option('wpac_button_position', '2');
    $like_btn_hide = get_option('wpac_hide_like_button', 'off');
    $dislike_btn_hide = get_option('wpac_hide_dislike_button', 'off');
    $stat_position = get_option('wpac_stats_position', '1');

    // Fetch labels for buttons
    $like_btn_label = get_option( 'wpac_like_btn_label', 'Like' );
    $dislike_btn_label = get_option( 'wpac_dislike_btn_label', 'Dislike' );

    $user_id = get_current_user_id();
    $post_id = get_the_ID();
    $like_count = wpac_count_likes($post_id);
    $like_count = number_format($like_count);
    $dislike_count = wpac_count_dislikes($post_id);
    $dislike_count  = number_format($dislike_count);

    // Make sure single post is being viewed.
    if(is_single()) {
        
        $btns_wrap_start = '<div class="wpac-buttons-container">';
        $like_btn = '<div class="wpac-btn-container">';
        $like_btn .= '<a href="javascript:;" onclick="wpac_like_btn_ajax('.$post_id.')" class="wpac-btn wpac-like-btn wpac-flat-btn">';

        if($stat_position == 2) {
            $like_btn .= '<span class="wpac-btn-icon"><i class="fas fa-thumbs-up"></i> '.$like_count.' </span>';

        } else {
            $like_btn .= '<span class="wpac-btn-icon"><i class="fas fa-thumbs-up"></i></span>';
        }
        $like_btn .= '<span class="wpac-btn-label">'.$like_btn_label.'</span>';
        $like_btn .= '</a>';
        $like_btn .= '</div>';

        $dislike_btn = '<div class="wpac-btn-container">';
        $dislike_btn .= '<a href="javascript:;" onclick="wpac_dislike_btn_ajax('.$post_id.')" class="wpac-btn wpac-dislike-btn wpac-flat-btn">';
        
        if($stat_position == 2) {
            $dislike_btn .= '<span class="wpac-btn-icon"><i class="fas fa-thumbs-down"></i> '.$dislike_count.' </span>';
        } else {
            $dislike_btn .= '<span class="wpac-btn-icon"><i class="fas fa-thumbs-down"></i></span>';
        }
        $dislike_btn .= '<span class="wpac-btn-label">'.$dislike_btn_label.'</span>';
        $dislike_btn .= '</a>';
        $dislike_btn .= '</div>';
        $btns_wrap_end = '</div>';

        if($stat_position == 1) {
            $stat_count_string = '<div class="wpac-count-stats"><p>This post has been Liked <strong>'.$like_count.'</strong> time(s) & Disliked <strong>'.$dislike_count.'</strong> time(s)</p></div>';
        }

        $wpac_ajax_response = '<div id="wpacAjaxResponse" class="wpac-ajax-response"><span></span></div>';

        if(isset($btns_position) && $btns_position == 1) {

            $before_content_btns = "";
            $before_content_btns .= $btns_wrap_start;
            if(isset($like_btn_hide) && $like_btn_hide =="on") {
                $like_btn = "" ;
            }
            if(isset($dislike_btn_hide) && $dislike_btn_hide =="on") {
                $dislike_btn == "";
            }
            $before_content_btns .= $like_btn;
            $before_content_btns .= $dislike_btn;
            
            $before_content_btns .= $btns_wrap_end;
            $before_content_btns .= $wpac_ajax_response;
            if($stat_position == 1) {
                $before_content_btns .= $stat_count_string;
            }
            $content = $before_content_btns . $content;

        } elseif(isset($btns_position) && $btns_position == 2) {

            $content .= $btns_wrap_start;
            if(isset($like_btn_hide) && $like_btn_hide =="on") {
                $like_btn = "";
            }
            if(isset($dislike_btn_hide) && $dislike_btn_hide =="on") {
                $dislike_btn = "";
            }
            $content .= $like_btn;
            $content .= $dislike_btn;
            $content .= $btns_wrap_end;
            $content .= $wpac_ajax_response;
            if($stat_position == 1) {
                $content .= $stat_count_string;
            }

        } else {
            $content = $content;
        }
    }
    return $content;

}
add_filter('the_content', 'wpac_like_dislike_buttons');
