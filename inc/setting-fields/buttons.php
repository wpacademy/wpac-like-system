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
    $check_position = "";
    $position_label = "";
    $position_style = "";
    if(isset($setting) & $setting == 1) {
        $position_value = 1;
        $position_label = "Before Content";

    } elseif(isset($setting) & $setting == 2){
        $position_value = 2;
        $position_label = "After Content";
    } elseif(isset($setting) & $setting == 3){
        $position_value = 3;
        $position_label = "Custom";
        $position_style = ' style="display: block"';
    } else {
        $position_value = "";
        $position_label = "";
    }
    // output the field
    ?>
    <select name="wpac_button_position" id="btnPosition" onchange="wpac_btn_position_select()">
        <?php if(isset($position_value) && $position_value != "") { ?>
        <option value="<?php echo $position_value ?>"><?php echo $position_label ?></option>
        <?php } ?>
        <option value="1">Before Content</option>
        <option value="2">After Content</option>
        <option value="3">Custom</option>
    </select>
    <pre class="wpac-short-code-notice"<?php echo $position_style ?>>Use this shortcode to display on custom location <strong>[WPAC_LIKE_SYSTEM]</strong></pre>
    <?php
}
// Stats Position Field for Likes & Dislikes
function wpac_stats_position_cb(){ 
    // get the value of the setting we've registered with register_setting()
    $setting = get_option('wpac_stats_position');
    $position_value = "";
    $position_label = "";
    if(isset($setting) & $setting == 1) {

        $position_value = 1;
        $position_label = "Below The Buttons";

    } elseif(isset($setting) & $setting == 2){

        $position_value = 2;
        $position_label = "Inside The Buttons";

    } else{

        $position_value = 3;
        $position_label = "Hide Stats";

    } 
    // output the field
    ?>
    <select name="wpac_stats_position" id="btnPosition" onchange="wpac_btn_position_select()">
        <?php if(isset($position_value) && $position_value != "") { ?>
        <option value="<?php echo $position_value ?>"><?php echo $position_label ?></option>
        <?php } ?>
        <option value="1">Below The Buttons</option>
        <option value="2">Inside The Buttons</option>
        <option value="3">Hide Stats</option>
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