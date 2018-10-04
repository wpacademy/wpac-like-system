<?php

function wpac_like_dislike_buttons($content) {

    // Get display & position settings for buttons
    $btns_position = get_option('wpac_button_position', '2');
    $like_btn_status = get_option('wpac_hide_like_button', 'on');
    $dislike_btn_status = get_option('wpac_hide_dislike_button', 'on');

    // Fetch labels for buttons
    $like_btn_label = get_option( 'wpac_like_btn_label', 'Like' );
    $dislike_btn_label = get_option( 'wpac_dislike_btn_label', 'Dislike' );

    $user_id = get_current_user_id();
    $post_id = get_the_ID();

    // Make sure single post is being viewed.
    if(is_single()) {
        
        $btns_wrap_start = '<div class="wpac-buttons-container">';
        $like_btn = '<a href="javascript:;" onclick="wpac_like_btn_ajax('.$post_id.', '.$user_id.')" class="wpac-btn wpac-like-btn"><i class="fas fa-thumbs-up"></i> '.$like_btn_label.'</a>';
        $dislike_btn = '<a href="javascript:;" onclick="wpac_dislike_btn_ajax('.$post_id.', '.$user_id.')" class="wpac-btn wpac-dislike-btn">'.$dislike_btn_label.' <i class="fas fa-thumbs-down"></i></a>';
        $btns_wrap_end = '</div>';

        $wpac_ajax_response = '<div id="wpacAjaxResponse" class="wpac-ajax-response"><span></span></div>';

        if(isset($btns_position) && $btns_position == 1) {

            $before_content_btns = "";
            $before_content_btns .= $btns_wrap_start;
            if(isset($like_btn_status) && $like_btn_status !="on") {
                $before_content_btns .= $like_btn;
            }
            if(isset($dislike_btn_status) && $dislike_btn_status !="on") {
                $before_content_btns .= $dislike_btn;
            }
            $before_content_btns .= $btns_wrap_end;
            $before_content_btns .= $wpac_ajax_response;

            $content = $before_content_btns . $content;

        } elseif(isset($btns_position) && $btns_position == 2) {

            $content .= $btns_wrap_start;
            if(isset($like_btn_status) && $like_btn_status !="on") {
                $content .= $like_btn;
            }
            if(isset($dislike_btn_status) && $dislike_btn_status !="on") {
                $content .= $dislike_btn;
            }
            $content .= $btns_wrap_end;
            $content .= $wpac_ajax_response;

        } else {
            $content = $content;
        }
    }
    return $content;

}
add_filter('the_content', 'wpac_like_dislike_buttons');
