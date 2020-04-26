<?php
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
    $position_style = "";
    if(isset($setting) & $setting == 3) {
        $position_style = ' style="display: block"';

    }
    // output the field
    ?>
    <select name="wpac_button_position" id="btnPosition" onchange="wpac_btn_position_select()">
        <?php
            switch($setting) {

                case 1:
                    echo '<option value="1">Before Content</option>';
                    echo '<option value="2">After Content</option>';
                    echo '<option value="3">Custom</option>';
                    break;
                case 2:
                    echo '<option value="2">After Content</option>';
                    echo '<option value="1">Before Content</option>';
                    echo '<option value="3">Custom</option>';
                    break;
                case 3:
                    echo '<option value="3">Custom</option>';
                    echo '<option value="2">After Content</option>';
                    echo '<option value="1">Before Content</option>';
                    break;
                default: 
                    echo '<option value="1">Before Content</option>';
                    echo '<option value="2">After Content</option>';
                    echo '<option value="3">Custom</option>';
                
            }
        ?>
    </select>
    <pre class="wpac-short-code-notice"<?php echo $position_style ?>>Use this shortcode to display on custom location <strong>[WPAC_LIKE_SYSTEM]</strong></pre>
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
function wpac_like_dislike_count_cb(){ 
    // get the value of the setting we've registered with register_setting()
    $setting = get_option('wpac_like_dislike_count');
    $check_status = "";
    if(isset($setting) & $setting == "on") {
        $check_status = "checked";
    }
    // output the field
    ?>
    <input type="checkbox" name="wpac_like_dislike_count" <?php echo ( $check_status )?>>
    <?php
}
function wpac_like_dislike_vs_bar_cb(){ 
    // get the value of the setting we've registered with register_setting()
    $setting = get_option('wpac_like_dislike_vs_bar');
    $check_status = "";
    if(isset($setting) & $setting == "on") {
        $check_status = "checked";
    }
    // output the field
    ?>
    <input type="checkbox" name="wpac_like_dislike_vs_bar" <?php echo ( $check_status )?>>
    <?php
}