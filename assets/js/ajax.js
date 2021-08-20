function ld_like_btn_ajax( post_id , user_id ) {

    var post_id = post_id;
    var user_id = user_id;

    jQuery.ajax(
        {
            url : ld_ajax_url.ajax_url,
            type : 'POST',
            data : {
                action : 'like_btn_ajax_func',
                pid : post_id,
                uid : user_id,
            },
            success : function( response ) {
                jQuery('#response_div').html(response);
            }
        }

    );

}


function ld_dislike_btn_ajax( post_id , user_id ) {

    var post_id = post_id;
    var user_id = user_id;

    jQuery.ajax(
        {
            url : ld_ajax_url.ajax_url,
            type : 'POST',
            data : {
                action : 'dislike_btn_ajax_func',
                pid : post_id,
                uid : user_id,
            },
            success : function( response ) {
                jQuery('#response_div').html(response);
            }
        }

    );

}