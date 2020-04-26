function wpac_like_btn_ajax(postId) {
    
	var post_id = postId;
	var usr_ID = wpac_ajax_url.user_id;
	var usr_IP = wpac_ajax_url.user_ip;
	//alert(usr_ID);
	// Save Like
	jQuery.ajax({
		url : wpac_ajax_url.ajax_url,
		type : 'post',
		data : {
			action : 'wpac_like_btn_ajax_action',
			pid : post_id,
			uip: usr_IP,
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
	var usr_IP = wpac_ajax_url.user_ip;
	
	//Save Dislike
	jQuery.ajax({
		url : wpac_ajax_url.ajax_url,
		type : 'post',
		data : {
			action : 'wpac_dislike_btn_ajax_action',
			pid : post_id,
			uid : usr_ID,
			uip: usr_IP,
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
	var usr_IP = wpac_ajax_url.user_ip;
	var reaction_id = reactionID;
	//console.log(usr_ID,usr_IP,reaction_id,post_id);
		jQuery.ajax({
			url : wpac_ajax_url.ajax_url,
			type : 'post',
			data : {
				action : 'wpac_save_reaction_ajax_action',
				pid : post_id,
				uid : usr_ID,
				uip: usr_IP,
				rid : reaction_id,
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
						action : 'wpac_reaction_count_update',
						pid : post_id,
						rid : reaction_id
					},
					success : function( response ) {
						if(reaction_id == 1){
							jQuery("#wpacR1").fadeOut();
							jQuery("#wpacR1").fadeIn();
							jQuery("#wpacR1").html(response);
						} else if(reaction_id == 2){
							jQuery("#wpacR2").fadeOut();
							jQuery("#wpacR2").fadeIn();
							jQuery("#wpacR2").html(response);
						} else if(reaction_id == 3){
							jQuery("#wpacR3").fadeOut();
							jQuery("#wpacR3").fadeIn();
							jQuery("#wpacR3").html(response);
						} else if(reaction_id == 4){
							jQuery("#wpacR4").fadeOut();
							jQuery("#wpacR4").fadeIn();
							jQuery("#wpacR4").html(response);
						} else if(reaction_id == 5){
							jQuery("#wpacR5").fadeOut();
							jQuery("#wpacR5").fadeIn();
							jQuery("#wpacR5").html(response);
						} else {
							jQuery("#wpacR6").fadeOut();
							jQuery("#wpacR6").fadeIn();
							jQuery("#wpacR6").html(response);
						}
					}
				});
			}
		});
	
}
