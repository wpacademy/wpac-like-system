function wpac_like_btn_ajax(postId,usrid) {
    
	var post_id = postId;
    var usr_ID = usrid;
	jQuery.ajax({
		url : wpac_ajax_url.ajax_url,
		type : 'post',
		data : {
			action : 'wpac_like_btn_ajax_action',
			pid : post_id,
			uid : usr_ID
		},
		success : function( response ) {
            jQuery("#wpacAjaxResponse span").html(response);
		}
	});
}

function wpac_dislike_btn_ajax(postId,usrid) {
    
	var post_id = postId;
    var usr_ID = usrid;
	jQuery.ajax({
		url : wpac_ajax_url.ajax_url,
		type : 'post',
		data : {
			action : 'wpac_dislike_btn_ajax_action',
			pid : post_id,
			uid : usr_ID
		},
		success : function( response ) {
            jQuery("#wpacAjaxResponse span").html(response);
		}
	});
}