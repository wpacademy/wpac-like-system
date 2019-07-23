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