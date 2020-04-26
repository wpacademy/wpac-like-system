<?php
/*
* Static Functions for WPAC Reaction System
*/
function wpac_format_reaction_numbers($num) {

    if($num>1000) {
            $x = round($num);
            $x_number_format = number_format($x);
            $x_array = explode(',', $x_number_format);
            $x_parts = array('k', 'm', 'b', 't');
            $x_count_parts = count($x_array) - 1;
            $x_display = $x;
            $x_display = $x_array[0] . ((int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
            $x_display .= $x_parts[$x_count_parts - 1];

            return $x_display;
    } else {
        $under_1k = "";
        if($num == 1000) {
            $under_1k = "1k+";
        } elseif($num > 900) {
            $under_1k = "0.9k";
        } elseif($num > 800) {
            $under_1k = "0.8k";
        } elseif($num > 700) {
            $under_1k = "0.7k";
        } elseif($num > 600) {
            $under_1k = "0.6k";
        } elseif($num > 500) {
            $under_1k = "0.5k";
        } else {
            $under_1k = $num;
        }
        return $under_1k;
    }
    return $num;

}
// Function to get the client ip address
function wpac_get_client_ip() {
    $ip_address = '';
    //whether ip is from share internet
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip_address = $_SERVER['HTTP_CLIENT_IP'];
    }
    //whether ip is from proxy
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    //whether ip is from remote address
    else {
        $ip_address = $_SERVER['REMOTE_ADDR'];
    }
 
    return $ip_address;
}
function wpac_default_post_thumb(){
    echo WPAC_PLUGIN_DIR. 'assets/img/thumb.jpg';
}
function wpac_get_postion_txt($id){
    switch($id) {

        case 1:
            return 'left';
            break;
        case 2:
            return 'right';
            break;
        case 3:
            return 'bottom';
            break;
        default: 
            return 'left';
        
    }
}
function wpac_social_sharing_icons(){
    $desktop_position = wpac_get_postion_txt(get_option('wpac_sharing_desktop_position','left'));
    $mobile_position = wpac_get_postion_txt(get_option('wpac_sharing_mobile_position','bottom'));
    $FB_url = "http://www.facebook.com/sharer.php?u=".get_the_permalink(get_the_ID());
    $TW_url = "https://twitter.com/share?url=".get_the_permalink(get_the_ID());
    $WA_url = "https://api.whatsapp.com/send?&text=".get_the_title(get_the_ID())." ".get_the_permalink(get_the_ID());
    ?>
    <div class="wpac-social-bar desktop-<?php echo $desktop_position ?> mobile-<?php echo $mobile_position ?>">
        <a href="javascript:" onclick="openShareWindow('<?php echo $FB_url ?>')" class="wpac-share-icon fb">
            <i class="fa fa-facebook"></i>
        </a>
        <a href="javascript:" onclick="openShareWindow('<?php echo $TW_url ?>')" class="wpac-share-icon tw">
            <i class="fa fa-twitter"></i>
        </a>
        <a href="javascript:" onclick="openShareWindow('<?php echo $WA_url ?>')" class="wpac-share-icon wa">
            <i class="fa fa-whatsapp"></i>
        </a>
        <a href="mailto:?subject=<?php echo get_the_title(get_the_ID()) ?>&body=<?php echo get_the_permalink(get_the_ID()) ?>" class="wpac-share-icon em">
            <i class="fa fa-envelope"></i>
        </a>
    </div>
    <?php
}
add_action('wp_footer', 'wpac_social_sharing_icons');