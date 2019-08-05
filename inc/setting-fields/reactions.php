<?php

//Reaction Labels (Tooltips)
function wpac_reaction_1_label_cb(){ 
    // get the value of the setting we've registered with register_setting()
    $setting = get_option('wpac_reaction_1_label');
    // output the field
    ?>
    <input type="text" name="wpac_reaction_1_label" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>">
    <?php
}
function wpac_reaction_2_label_cb(){ 
    $setting = get_option('wpac_reaction_2_label');
    ?>
    <input type="text" name="wpac_reaction_2_label" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>">
    <?php
}
function wpac_reaction_3_label_cb(){ 
    $setting = get_option('wpac_reaction_3_label');
    ?>
    <input type="text" name="wpac_reaction_3_label" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>">
    <?php
}
function wpac_reaction_4_label_cb(){ 
    $setting = get_option('wpac_reaction_4_label');
    ?>
    <input type="text" name="wpac_reaction_4_label" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>">
    <?php
}
function wpac_reaction_5_label_cb(){ 
    $setting = get_option('wpac_reaction_5_label');
    ?>
    <input type="text" name="wpac_reaction_5_label" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>">
    <?php
}
function wpac_reaction_6_label_cb(){ 
    $setting = get_option('wpac_reaction_6_label');
    ?>
    <input type="text" name="wpac_reaction_6_label" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>">
    <?php
}

// Reactions Display Setting Fields
function wpac_reaction_position_cb(){ 
    // get the value of the setting we've registered with register_setting()
    $setting = get_option('wpac_reaction_position');

    // output the field
    ?>
    <select name="wpac_reaction_position" id="reactionPosition" onchange="wpac_reaction_position_select()">
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
    <pre class="wpac-short-code-notice"<?php echo $position_style ?>>Use this shortcode to display on custom location <strong>[WPAC_REACTION_SYSTEM]</strong></pre>
    <?php
}
function wpac_reaction_style_cb(){ 
    // get the value of the setting we've registered with register_setting()
    $setting = get_option('wpac_reaction_style');

    // output the field
    ?>
    <select name="wpac_reaction_style" id="reactionPosition" onchange="wpac_reaction_position_select()">
        <?php
        switch($setting) {

            case 1:
                echo '<option value="1">Font Icons</option>';
                echo '<option value="2">Emoticons</option>';
                break;
            case 2:
                echo '<option value="2">Emoticons</option>';
                echo '<option value="1">Font Icons</option>';
                break;
            default: 
                echo '<option value="1">Font Icons</option>';
                echo '<option value="2">Emoticons</option>';
        }
        ?>
    </select>
    <?php
}
// Show hor hide reactions count & label (tooltip)
function wpac_hide_reaction_count_cb(){ 
    // get the value of the setting we've registered with register_setting()
    $setting = get_option('wpac_hide_reaction_count');
    $check_status = "";
    if(isset($setting) & $setting == "on") {
        $check_status = "checked";
    }
    // output the field
    ?>
    <input type="checkbox" name="wpac_hide_reaction_count" <?php echo ( $check_status )?>>
    <?php
}
function wpac_hide_reaction_label_cb(){ 
    // get the value of the setting we've registered with register_setting()
    $setting = get_option('wpac_hide_reaction_label');
    $check_status = "";
    if(isset($setting) & $setting == "on") {
        $check_status = "checked";
    }
    // output the field
    ?>
    <input type="checkbox" name="wpac_hide_reaction_label" <?php echo ( $check_status )?>>
    <?php
}