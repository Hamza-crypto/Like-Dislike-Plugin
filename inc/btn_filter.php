<?php

function ld_buttons_func($content){
    $like_btn_label = get_option('ld_like_btn_label','Like');
    $dislike_btn_label = get_option('ld_dislike_btn_label', 'Dislike');

    $userid = get_current_user_id();
    $postid = get_the_ID();

    $like_btn_wrap = '<div class="ld-buttons-container">';
    $like_btn = '<a href="javascript:;" onclick="ld_like_btn_ajax( ' . $postid . ' , '. $userid .' )" class="ld-btn ld-like-btn"> ' .  $like_btn_label .' </a>';
    $dislike_btn = '<a href="javascript:;" onclick="ld_dislike_btn_ajax( ' . $postid . ' , '. $userid .' )"  class="ld-btn ld-dislike-btn">' .  $dislike_btn_label .' </a>';
    $like_btn_wrap_end = '</div>';

    $response_div_start = '<div id="response_div" class="ld-buttons-response"> ';

    $content .= $like_btn_wrap;
    $content .= $like_btn;
    $content .= $dislike_btn;
    $content .= $like_btn_wrap_end;

    $content .= $response_div_start;
    $content .= $like_btn_wrap_end;

    return $content;
}
add_filter('the_content' , 'ld_buttons_func');