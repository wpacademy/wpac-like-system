<?php
function wpac_system_type_cb(){ 
    // get the value of the setting we've registered with register_setting()
    $setting = get_option('wpac_system_type');
    // output the field
    ?>
    <select name="wpac_system_type" id="btnPosition" onchange="wpac_btn_position_select()">
        <?php 
            switch($setting){
                case 1:
                    echo '<option value="1">Like/Dislike</option>';
                    echo '<option value="2">Reactions</option>';
                    break;
                case 2:
                    echo '<option value="2">Reactions</option>';
                    echo '<option value="1">Like/Dislike</option>';
                    break;
                default:
                    echo '<option value="1">Like/Dislike</option>';
                    echo '<option value="2">Reactions</option>';
            }
        ?>
    </select>
    <?php
}
//Error Messages and Status Text
function wpac_status_message_liked_cb(){ 
    // get the value of the setting we've registered with register_setting()
    $setting = get_option('wpac_status_message_liked');
    // output the field
    ?>
    <input type="text" name="wpac_status_message_liked" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>">
    <?php
}
function wpac_status_error_liked_cb(){ 
    // get the value of the setting we've registered with register_setting()
    $setting = get_option('wpac_status_error_liked');
    // output the field
    ?>
    <input type="text" name="wpac_status_error_liked" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>">
    <?php
}
function wpac_status_message_disliked_cb(){ 
    // get the value of the setting we've registered with register_setting()
    $setting = get_option('wpac_status_message_disliked');
    // output the field
    ?>
    <input type="text" name="wpac_status_message_disliked" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>">
    <?php
}
function wpac_status_error_disliked_cb(){ 
    // get the value of the setting we've registered with register_setting()
    $setting = get_option('wpac_status_error_disliked');
    // output the field
    ?>
    <input type="text" name="wpac_status_error_disliked" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>">
    <?php
}

function wpac_status_message_reaction_cb(){ 
    // get the value of the setting we've registered with register_setting()
    $setting = get_option('wpac_status_message_reaction');
    // output the field
    ?>
    <input type="text" name="wpac_status_message_reaction" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>">
    <?php
}
function wpac_status_message_error_login_cb(){ 
    // get the value of the setting we've registered with register_setting()
    $setting = get_option('wpac_status_message_error_login');
    // output the field
    ?>
    <input type="text" name="wpac_status_message_error_login" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>">
    <?php
}
function wpac_status_message_error_general_cb(){ 
    // get the value of the setting we've registered with register_setting()
    $setting = get_option('wpac_status_message_error_general');
    // output the field
    ?>
    <input type="text" name="wpac_status_message_error_general" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>">
    <?php
}