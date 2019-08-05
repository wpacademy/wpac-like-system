function wpac_like_btn_ajax(postId) {
    
	var post_id = postId;
	var usr_ID = wpac_ajax_url.user_id;
	
	// Save Like
	jQuery.ajax({
		url : wpac_ajax_url.ajax_url,
		type : 'post',
		data : {
			action : 'wpac_like_btn_ajax_action',
			pid : post_id,
			uid : usr_ID
		},
		success : function( response ) {
			jQuery("#wpacAjaxResponse").fadeIn();
			jQuery("#wpacAjaxResponse span").html(response);
			jQuery("#wpacAjaxResponse").delay(5000).fadeOut();
			// Update Counter
			jQuery.ajax({
				url : wpac_ajax_url.ajax_url,
				type : 'post',
				data : {
					action : 'wpac_like_btn_count_update',
					pid : post_id,
				},
				success : function( response ) {
					jQuery("#wpacLikeCount").fadeOut("fast");
					jQuery("#wpacLikeCount").fadeIn("fast");
					jQuery("#wpacLikeCount").html(response);
				}
			});
		}
	});
	
}

function wpac_dislike_btn_ajax(postId) {
    
	var post_id = postId;
	var usr_ID = wpac_ajax_url.user_id;

	//Save Dislike
	jQuery.ajax({
		url : wpac_ajax_url.ajax_url,
		type : 'post',
		data : {
			action : 'wpac_dislike_btn_ajax_action',
			pid : post_id,
			uid : usr_ID
		},
		success : function( response ) {
			jQuery("#wpacAjaxResponse").fadeIn();
			jQuery("#wpacAjaxResponse span").html(response);
			jQuery("#wpacAjaxResponse").delay(5000).fadeOut();
			// Update Counter
			jQuery.ajax({
				url : wpac_ajax_url.ajax_url,
				type : 'post',
				data : {
					action : 'wpac_dislike_btn_count_update',
					pid : post_id,
				},
				success : function( response ) {
					jQuery("#wpacDislikeCount").fadeOut();
					jQuery("#wpacDislikeCount").fadeIn();
					jQuery("#wpacDislikeCount").html(response);
				}
			});
		}
	});
	
}

function wpac_save_reaction_ajax(postId,reactionID) {
    
	var post_id = postId;
	var usr_ID = wpac_ajax_url.user_id;
	var reaction_id = reactionID;
	//console.log(usr_ID);
		jQuery.ajax({
			url : wpac_ajax_url.ajax_url,
			type : 'post',
			data : {
				action : 'wpac_save_reaction_ajax_action',
				pid : post_id,
				uid : usr_ID,
				rid : reaction_id,
			},
			success : function( response ) {
				jQuery("#wpacAjaxResponse").fadeIn();
				jQuery("#wpacAjaxResponse span").html(response);
				jQuery("#wpacAjaxResponse").delay(5000).fadeOut();
			}
		});
	
}
