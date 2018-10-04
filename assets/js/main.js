
function wpac_btn_position_select(){
    var currentval = jQuery("#btnPosition").val();
    if(currentval == 3) {
        jQuery(".wpac-short-code-notice").show();
    } else {
        jQuery(".wpac-short-code-notice").hide();
    }

}