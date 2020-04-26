<?php

// Reactions Display Setting Fields
function wpac_sharing_desktop_position_cb(){ 
    // get the value of the setting we've registered with register_setting()
    $setting = get_option('wpac_sharing_desktop_position');

    // output the field
    ?>
    <select name="wpac_sharing_desktop_position">
        <?php
        switch($setting) {

            case 1:
                echo '<option value="1">Left</option>';
                echo '<option value="2">Right</option>';
                echo '<option value="3">Bottom</option>';
                break;
            case 2:
                echo '<option value="2">Right</option>';
                echo '<option value="1">Left</option>';
                echo '<option value="3">Bottom</option>';
                break;
            case 3:
                echo '<option value="3">Bottom</option>';
                echo '<option value="2">Right</option>';
                echo '<option value="1">Left</option>';
                break;
            default: 
                echo '<option value="1">Left</option>';
                echo '<option value="2">Right</option>';
                echo '<option value="3">Bottom</option>';
            
        }
        ?>
    </select>
    <?php
}
function wpac_sharing_mobile_position_cb(){ 
    // get the value of the setting we've registered with register_setting()
    $setting = get_option('wpac_sharing_mobile_position');

    // output the field
    ?>
    <select name="wpac_sharing_mobile_position">
        <?php
        switch($setting) {

            case 1:
                echo '<option value="1">Left</option>';
                echo '<option value="2">Right</option>';
                echo '<option value="3">Bottom</option>';
                echo '<option value="4">Hide on Mobile</option>';
                break;
            case 2:
                echo '<option value="2">Right</option>';
                echo '<option value="1">Left</option>';
                echo '<option value="3">Bottom</option>';
                echo '<option value="4">Hide on Mobile</option>';
                break;
            case 3:
                echo '<option value="3">Bottom</option>';
                echo '<option value="2">Right</option>';
                echo '<option value="1">Left</option>';
                echo '<option value="4">Hide on Mobile</option>';
                break;
            case 4:
                echo '<option value="4">Hide on Mobile</option>';
                echo '<option value="3">Bottom</option>';
                echo '<option value="2">Right</option>';
                echo '<option value="1">Left</option>';
                break;
            default: 
                echo '<option value="1">Left</option>';
                echo '<option value="2">Right</option>';
                echo '<option value="3">Bottom</option>';
                echo '<option value="4">Hide on Mobile</option>';
        }
        ?>
    </select>
    <?php
}