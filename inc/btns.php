<?php
function wpac_like_dislike_buttons($content) {

    if(is_single()) {
    $like_btn_label = get_option( 'wpac_like_btn_label', 'Like' );
    $dislike_btn_label = get_option( 'wpac_dislike_btn_label', 'Like' );

    $user_id = get_current_user_id();
    $post_id = get_the_ID();

    $like_btn_wrap = '<div class="wpac-buttons-container">';
    $like_btn = '<a href="javascript:;" onclick="wpac_like_btn_ajax('.$post_id.', '.$user_id.')" class="wpac-btn wpac-like-btn"><i class="fas fa-thumbs-up"></i> '.$like_btn_label.'</a>';
    $dislike_btn = '<a href="javascript:;" onclick="wpac_dislike_btn_ajax('.$post_id.', '.$user_id.')" class="wpac-btn wpac-dislike-btn">'.$dislike_btn_label.' <i class="fas fa-thumbs-down"></i></a>';
    $like_btn_wrap_end = '</div>';

    $wpac_ajax_response = '<div id="wpacAjaxResponse" class="wpac-ajax-response"><span></span></div>';

    $content .= $like_btn_wrap;
    $content .= $like_btn;
    $content .= $dislike_btn;
    $content .= $like_btn_wrap_end;
    $content .= $wpac_ajax_response;
    }
    return $content;

}
add_filter('the_content', 'wpac_like_dislike_buttons');
