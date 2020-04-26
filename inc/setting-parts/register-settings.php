<?php
function wpac_plugin_settings(){

    // register settings for "wpac-settings" page
    register_setting( 'wpac-settings', 'wpac_system_type', ['default' => '1']);
    register_setting( 'wpac-settings', 'wpac_save_type', ['default' => '1']);
    register_setting( 'wpac-settings', 'wpac_status_message_liked', ['default' => 'Your Like is Saved Successfully']);
    register_setting( 'wpac-settings', 'wpac_status_error_liked', ['default' => 'Sorry, you already liked this post']);
    register_setting( 'wpac-settings', 'wpac_status_message_disliked', ['default' => 'Your Dislike is Saved Successfully']);
    register_setting( 'wpac-settings', 'wpac_status_error_disliked', ['default' => 'You have already Disliked this post']);
    register_setting( 'wpac-settings', 'wpac_status_message_reaction', ['default' => 'Your reaction is saved successfully']);
    register_setting( 'wpac-settings', 'wpac_status_message_error_login', ['default' => 'You must be logged-in to like or dislike this post']);
    register_setting( 'wpac-settings', 'wpac_status_message_error_general', ['default' => 'There was an unknown error. Please contact Webmaster']);

    //Register Settings for "wpac-button-settings" page
    register_setting( 'wpac-button-settings', 'wpac_like_btn_label', ['default' => 'Like']);
    register_setting( 'wpac-button-settings', 'wpac_dislike_btn_label', ['default' => 'Dislike']);
    register_setting( 'wpac-button-settings', 'wpac_button_position', ['default' => '2']);
    register_setting( 'wpac-button-settings', 'wpac_hide_like_button', ['default' => 'off']);
    register_setting( 'wpac-button-settings', 'wpac_hide_dislike_button', ['default' => 'off']);
    register_setting( 'wpac-button-settings', 'wpac_like_dislike_count', ['default' => 'on']);
    register_setting( 'wpac-button-settings', 'wpac_like_dislike_vs_bar', ['default' => 'on']);

    //Register Settings for "wpac-reaction-settings" page
    register_setting( 'wpac-reaction-settings', 'wpac_reaction_position', ['default' => '2']);
    register_setting( 'wpac-reaction-settings', 'wpac_reaction_style', ['default' => '1']);
    register_setting( 'wpac-reaction-settings', 'wpac_hide_reaction_count', ['default' => 'off']);
    register_setting( 'wpac-reaction-settings', 'wpac_hide_reaction_label', ['default' => 'off']);
    register_setting( 'wpac-reaction-settings', 'wpac_reaction_1_label', ['default' => 'Like']);
    register_setting( 'wpac-reaction-settings', 'wpac_reaction_2_label', ['default' => 'Love']);
    register_setting( 'wpac-reaction-settings', 'wpac_reaction_3_label', ['default' => 'Haha']);
    register_setting( 'wpac-reaction-settings', 'wpac_reaction_4_label', ['default' => 'Shocked']);
    register_setting( 'wpac-reaction-settings', 'wpac_reaction_5_label', ['default' => 'Sad']);
    register_setting( 'wpac-reaction-settings', 'wpac_reaction_6_label', ['default' => 'Angry']);

    //Register Settings for "wpac-sharing-settings" page
    register_setting( 'wpac-sharing-settings', 'wpac_sharing_desktop_position', ['default' => '1']);
    register_setting( 'wpac-sharing-settings', 'wpac_sharing_mobile_position', ['default' => '3']);

    // register a new section in the "wpac-setings" page
    add_settings_section(
        'wpac_general_settings_section',
        'General Settings',
        'wpac_general_settings_section_cb',
        'wpac-settings'
    );
    add_settings_section(
        'wpac_status_texts_section',
        'Status & Error Texts',
        'wpac_status_texts_section_cb',
        'wpac-settings'
    );
    add_settings_section(
        'wpac_label_settings_section',
        'Button Labels',
        'wpac_label_settings_section_cb',
        'wpac-button-settings'
    );
    add_settings_section(
        'wpac_button_settings_section',
        'Button Settings',
        'wpac_button_settings_section_cb',
        'wpac-button-settings'
    );
    add_settings_section(
        'wpac_reaction_settings_section',
        'Reaction Settings',
        'wpac_reaction_settings_section_cb',
        'wpac-reaction-settings'
    );
    add_settings_section(
        'wpac_reaction_labels_section',
        'Reaction Labels',
        'wpac_reaction_labels_section_cb',
        'wpac-reaction-settings'
    );
    add_settings_section(
        'wpac_sharing_setting_section',
        'Sharing Bar Position',
        'wpac_sharing_setting_section_cb',
        'wpac-sharing-settings'
    );
    // register fields for settings in "wpac-settings" page

    //System Type
    add_settings_field( 
        'wpac_system_type',
        'System Type',
        'wpac_system_type_cb',
        'wpac-settings',
        'wpac_general_settings_section' 
    );
    //Save Type
    add_settings_field( 
        'wpac_save_type',
        'Who Can Like/React',
        'wpac_save_type_cb',
        'wpac-settings',
        'wpac_general_settings_section' 
    );
    //Status & Error Texts
    add_settings_field( 
        'wpac_status_message_liked',
        'Liked Success',
        'wpac_status_message_liked_cb',
        'wpac-settings',
        'wpac_status_texts_section' 
    );
    add_settings_field( 
        'wpac_status_error_liked',
        'Liked Error',
        'wpac_status_error_liked_cb',
        'wpac-settings',
        'wpac_status_texts_section' 
    );
    add_settings_field( 
        'wpac_status_message_disliked',
        'Disliked Success',
        'wpac_status_message_disliked_cb',
        'wpac-settings',
        'wpac_status_texts_section' 
    );
    add_settings_field( 
        'wpac_status_error_disliked',
        'Disliked Error',
        'wpac_status_error_disliked_cb',
        'wpac-settings',
        'wpac_status_texts_section' 
    );
    add_settings_field( 
        'wpac_status_message_reaction',
        'Reaction Saved',
        'wpac_status_message_reaction_cb',
        'wpac-settings',
        'wpac_status_texts_section' 
    );
    add_settings_field( 
        'wpac_status_message_error_login',
        'Login Error',
        'wpac_status_message_error_login_cb',
        'wpac-settings',
        'wpac_status_texts_section' 
    );
    add_settings_field( 
        'wpac_status_message_error_general',
        'General Error',
        'wpac_status_message_error_general_cb',
        'wpac-settings',
        'wpac_status_texts_section' 
    );
    // Button Label Fields
    add_settings_field(
        'wpac_like_label_field',
        'Like Button Label',
        'wpac_like_label_field_cb',
        'wpac-button-settings',
        'wpac_label_settings_section'
    );
    add_settings_field(
        'wpac_dislike_label_field',
        'Dislike Button Label',
        'wpac_dislike_label_field_cb',
        'wpac-button-settings',
        'wpac_label_settings_section'
    );

    // Button Display & Position Fields
    add_settings_field( 
        'wpac_button_position',
        'Buttons Positions',
        'wpac_button_position_cb',
        'wpac-button-settings',
        'wpac_button_settings_section' 
    );
    add_settings_field( 
        'wpac_hide_like_button',
        'Hide Like Button?',
        'wpac_hide_like_button_cb',
        'wpac-button-settings',
        'wpac_button_settings_section' 
    );
    add_settings_field( 
        'wpac_hide_dislike_button',
        'Hide DisLike Button?',
        'wpac_hide_dislike_button_cb',
        'wpac-button-settings',
        'wpac_button_settings_section'
    );
    add_settings_field( 
        'wpac_like_dislike_count',
        'Show Like & Dislike Count?',
        'wpac_like_dislike_count_cb',
        'wpac-button-settings',
        'wpac_button_settings_section' 
    );
    add_settings_field( 
        'wpac_like_dislike_vs_bar',
        'Show Like vs Dislike Bar?',
        'wpac_like_dislike_vs_bar_cb',
        'wpac-button-settings',
        'wpac_button_settings_section' 
    );

    //Reactions Icon Labels
    add_settings_field(
        'wpac_reaction_1_label',
        'Like Reaction Label',
        'wpac_reaction_1_label_cb',
        'wpac-reaction-settings',
        'wpac_reaction_labels_section'
    );
    add_settings_field(
        'wpac_reaction_2_label',
        'Love Reaction Label',
        'wpac_reaction_2_label_cb',
        'wpac-reaction-settings',
        'wpac_reaction_labels_section'
    );
    add_settings_field(
        'wpac_reaction_3_label',
        'Laugh Reaction Label',
        'wpac_reaction_3_label_cb',
        'wpac-reaction-settings',
        'wpac_reaction_labels_section'
    );
    add_settings_field(
        'wpac_reaction_4_label',
        'Amazed Reaction Label',
        'wpac_reaction_4_label_cb',
        'wpac-reaction-settings',
        'wpac_reaction_labels_section'
    );
    add_settings_field(
        'wpac_reaction_5_label',
        'Sad Reaction Label',
        'wpac_reaction_5_label_cb',
        'wpac-reaction-settings',
        'wpac_reaction_labels_section'
    );
    add_settings_field(
        'wpac_reaction_6_label',
        'Angry Reaction Label',
        'wpac_reaction_6_label_cb',
        'wpac-reaction-settings',
        'wpac_reaction_labels_section'
    );
    //Reactions Display & Position
    add_settings_field(
        'wpac_reaction_position',
        'Reaction Icons Position',
        'wpac_reaction_position_cb',
        'wpac-reaction-settings',
        'wpac_reaction_settings_section'
    );
    add_settings_field(
        'wpac_reaction_style',
        'Reaction Style',
        'wpac_reaction_style_cb',
        'wpac-reaction-settings',
        'wpac_reaction_settings_section'
    );
    add_settings_field(
        'wpac_hide_reaction_count',
        'Hide Reactions Count?',
        'wpac_hide_reaction_count_cb',
        'wpac-reaction-settings',
        'wpac_reaction_settings_section'
    );
    add_settings_field(
        'wpac_hide_reaction_label',
        'Hide Reactions Label?',
        'wpac_hide_reaction_label_cb',
        'wpac-reaction-settings',
        'wpac_reaction_settings_section'
    );
    //Sharing Bar Display & Position
    add_settings_field(
        'wpac_sharing_desktop_position',
        'Sharing Bar Position: Desktop',
        'wpac_sharing_desktop_position_cb',
        'wpac-sharing-settings',
        'wpac_sharing_setting_section'
    );
    add_settings_field(
        'wpac_sharing_mobile_position',
        'Sharing Bar Position: Mobile',
        'wpac_sharing_mobile_position_cb',
        'wpac-sharing-settings',
        'wpac_sharing_setting_section'
    );
}
add_action('admin_init', 'wpac_plugin_settings');

// Section callback functions
function wpac_general_settings_section_cb(){
    _e('<p>General Settings for WPAC</p>', 'wpaclike');
}
function wpac_status_texts_section_cb(){
    _e('<p>Plugin Generated Status & Error Texts. Modify them as you like</p>', 'wpaclike');
}
function wpac_label_settings_section_cb(){
    _e('<p>Define Button Labels</p>', 'wpaclike');
}
function wpac_button_settings_section_cb(){
    _e('<p>Button position and display settings</p>', 'wpaclike');
}
function wpac_reaction_settings_section_cb(){
    _e('<p>Manage Reaction Icons Position</p>', 'wpaclike');
}
function wpac_reaction_labels_section_cb(){
    _e('<p>Manage Reaction Icons Position</p>', 'wpaclike');
}
function wpac_sharing_setting_section_cb(){
    _e('<p>Manage Sharing Icons Position</p>', 'wpaclike');
}