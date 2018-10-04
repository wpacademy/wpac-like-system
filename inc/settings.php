<?php
function wpac_settings_page_html() {
    //Check if current user have admin access.
    if(!is_admin()) {
        return;
    }
    ?>
        <div class="wrap">
            <h1 style="padding:10px; background:#333;color:#fff"><?= esc_html(get_admin_page_title()); ?></h1>
            <form action="options.php" method="post">
                <?php 
                    // output security fields for the registered setting "wpac-settings"
                    settings_fields( 'wpac-settings' );

                    // output setting sections and their fields
                    // (sections are registered for "wpac-settings", each field is registered to a specific section)
                    do_settings_sections( 'wpac-settings' );

                    // output save settings button
                    submit_button( 'Save Changes' );
                ?>
            </form>
        </div>
    <?

}

//Top Level Administration Menu
function wpac_register_menu_page() {
    add_menu_page(
        'WPAC Like System',
        'WPAC Settings',
        'manage_options',
        'wpac-settings',
        'wpac_settings_page_html',
        'dashicons-thumbs-up', 30 );
}
add_action('admin_menu', 'wpac_register_menu_page');

//Sub-Level Administration Menu
/* function wpac_register_menu_page() {
    add_theme_page( 'WPAC Like System', 'WPAC Settings', 'manage_options', 'wpac-settings', 'wpac_settings_page_html', 30 );
}
add_action('admin_menu', 'wpac_register_menu_page'); */

// Register settings, sections & fields.
function wpac_plugin_settings(){

    // register settings for "wpac-settings" page
    register_setting( 'wpac-settings', 'wpac_like_btn_label' );
    register_setting( 'wpac-settings', 'wpac_dislike_btn_label' );
    register_setting( 'wpac-settings', 'wpac_button_position' );
    register_setting( 'wpac-settings', 'wpac_hide_like_button' );
    register_setting( 'wpac-settings', 'wpac_hide_dislike_button' );

    // register a new section in the "wpac-setings" page
    add_settings_section(
        'wpac_label_settings_section',
        'WPAC Button Labels',
        'wpac_label_settings_section_cb',
        'wpac-settings'
    );
    add_settings_section(
        'wpac_button_settings_section',
        'WPAC Button Settings',
        'wpac_button_settings_section_cb',
        'wpac-settings'
    );

    // register fields for settings in "wpac-settings" page

    // Button Label Fields
    add_settings_field(
        'wpac_like_label_field',
        'Like Button Label',
        'wpac_like_label_field_cb',
        'wpac-settings',
        'wpac_label_settings_section'
    );
    add_settings_field(
        'wpac_dislike_label_field',
        'Dislike Button Label',
        'wpac_dislike_label_field_cb',
        'wpac-settings',
        'wpac_label_settings_section'
    );

    // Button Display & Position Fields
    add_settings_field( 
        'wpac_button_position',
        'Buttons Positions',
        'wpac_button_position_cb',
        'wpac-settings',
        'wpac_button_settings_section' 
    );
    add_settings_field( 
        'wpac_hide_like_button',
        'Hide Like Button?',
        'wpac_hide_like_button_cb',
        'wpac-settings',
        'wpac_button_settings_section' 
    );
    add_settings_field( 
        'wpac_hide_dislike_button',
        'Hide DisLike Button?',
        'wpac_hide_dislike_button_cb',
        'wpac-settings',
        'wpac_button_settings_section'
    );
}
add_action('admin_init', 'wpac_plugin_settings');

// Section callback functions
function wpac_label_settings_section_cb(){
    echo '<p>Define Button Labels</p>';
}
function wpac_button_settings_section_cb(){
    echo '<p>Button position and display settings</p>';
}
// Field callback functions
// Button Label Fields Callback Functions
function wpac_like_label_field_cb(){ 
    // get the value of the setting we've registered with register_setting()
    $setting = get_option('wpac_like_btn_label');
    // output the field
    ?>
    <input type="text" name="wpac_like_btn_label" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>">
    <?php
}

function wpac_dislike_label_field_cb(){ 
    // get the value of the setting we've registered with register_setting()
    $setting = get_option('wpac_dislike_btn_label');
    // output the field
    ?>
    <input type="text" name="wpac_dislike_btn_label" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>">
    <?php
}

// Button Display Setting Fields Functions
function wpac_button_position_cb(){ 
    // get the value of the setting we've registered with register_setting()
    $setting = get_option('wpac_button_position');
    $check_position = "";
    $position_label = "";
    if(isset($setting) & $setting == 1) {
        $position_value = 1;
        $position_label = "Before Content";

    } elseif(isset($setting) & $setting == 2){
        $position_value = 2;
        $position_label = "After Content";
    } elseif(isset($setting) & $setting == 3){
        $position_value = 3;
        $position_label = "Custom";
    } else {
        $position_value = "";
        $position_label = "";
    }
    // output the field
    ?>
    <select name="wpac_button_position" id="btnPosition">
        <?php if(isset($position_value) && $position_value != "") { ?>
        <option value="<?php echo $position_value ?>"><?php echo $position_label ?></option>
        <?php } ?>
        <option value="1">Before Content</option>
        <option value="2">After Content</option>
        <option value="3">Custom</option>
    </select>
    <?php
}
function wpac_hide_like_button_cb(){ 
    // get the value of the setting we've registered with register_setting()
    $setting = get_option('wpac_hide_like_button');
    $check_status = "";
    if(isset($setting) & $setting == "on") {
        $check_status = "checked";
    }
    // output the field
    ?>
    <input type="checkbox" name="wpac_hide_like_button" <?php echo ( $check_status )?>>
    <?php
}
function wpac_hide_dislike_button_cb(){ 
    // get the value of the setting we've registered with register_setting()
    $setting = get_option('wpac_hide_dislike_button');
    $check_status = "";
    if(isset($setting) & $setting == "on") {
        $check_status = "checked";
    }
    // output the field
    ?>
    <input type="checkbox" name="wpac_hide_dislike_button" <?php echo ( $check_status )?>>
    <?php
}