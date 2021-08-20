<?php

function like_btn_ajax_func()
{
    global $wpdb;
    $table_name = $wpdb->prefix . "like_dislike_system";
    if (isset($_POST['pid']) && isset($_POST['uid'])) {

        $post_id = $_POST['pid'];
        $user_id = $_POST['uid'];
        $query = 'SELECT * FROM ' . $table_name . '  WHERE post_id = ' . $post_id . ' AND user_id = ' . $user_id;

        $result = $wpdb->get_results($query, 'ARRAY_A')[0];

        if ($result) {
            if ($result['like_count'] == 1) {
                echo "<span style='color:red;'> You already liked this post </span>";
            } else {
                $update_status = $wpdb->update(
                    $table_name,
                    array(
                        'like_count' => 1,
                        'dislike_count' => 0,
                    ),
                    array(
                        'post_id' => $_POST['pid'],
                        'user_id' => $_POST['uid'],
                    ),
                    array(
                        '%d',
                        '%d',
                        '%d',
                    )
                );
                if ($update_status) {
                    echo "Thank you for loving this post";
                }
            }

        } else {
            $wpdb->insert(
                $table_name,
                array(
                    'post_id' => $_POST['pid'],
                    'user_id' => $_POST['uid'],
                    'like_count' => 1,
                    'dislike_count' => 0,
                ),
                array(
                    '%d',
                    '%d',
                    '%d',
                    '%d',
                )
            );
            if ($wpdb->insert_id) {
                echo "Thank you for loving this post";
            }
        }

    }
    wp_die();
}

add_action('wp_ajax_like_btn_ajax_func', 'like_btn_ajax_func');
add_action('wp_ajax_nopriv_like_btn_ajax_func', 'like_btn_ajax_func');

function dislike_btn_ajax_func()
{
    global $wpdb;
    $table_name = $wpdb->prefix . "like_dislike_system";
    if (isset($_POST['pid']) && isset($_POST['uid'])) {

        $post_id = $_POST['pid'];
        $user_id = $_POST['uid'];
        $query = 'SELECT * FROM ' . $table_name . '  WHERE post_id = ' . $post_id . ' AND user_id = ' . $user_id;

        $result = $wpdb->get_results($query, 'ARRAY_A')[0];

        if ($result) {
            if ($result['dislike_count'] == 1) {
                echo "<span style='color:red;'> You already disliked this post </span>";
            } else {
                $update_status = $wpdb->update(
                    $table_name,
                    array(
                        'like_count' => 0,
                        'dislike_count' => 1,
                    ),
                    array(
                        'post_id' => $_POST['pid'],
                        'user_id' => $_POST['uid'],
                    ),
                    array(
                        '%d',
                        '%d',
                        '%d',
                    )
                );
                if ($update_status) {
                    echo "We apologize for your bad experience";
                    ?>
                    <script>
                        jQuery('#total_count_div').hide();
                    </script>
                    <?php

                }
            }

        } else {
            $wpdb->insert(
                $table_name,
                array(
                    'post_id' => $_POST['pid'],
                    'user_id' => $_POST['uid'],
                    'like_count' => 0,
                    'dislike_count' => 1,
                ),
                array(
                    '%d',
                    '%d',
                    '%d',
                    '%d',
                )
            );
            if ($wpdb->insert_id) {
                echo "We apologize for your bad experience";
                ?>
                <script>
                    jQuery('#total_count_div').hide();
                </script>
                <?php
            }
        }
    }
    wp_die();
}

add_action('wp_ajax_dislike_btn_ajax_func', 'dislike_btn_ajax_func');
add_action('wp_ajax_nopriv_dislike_btn_ajax_func', 'dislike_btn_ajax_func');

function total_likes_count($content)
{
    global $wpdb;
    $post_id = get_the_ID();
    $table_name = $wpdb->prefix . "like_dislike_system";
    $total_counts = $wpdb->get_var('SELECT COUNT(*) FROM ' . $table_name . '  WHERE post_id = ' . $post_id . ' AND like_count = 1');
    if ($total_counts > 0)
        $content .= '<div id="total_count_div"> This post liked <strong>' . $total_counts . '</strong> time(s) </div>';

    return $content;
}

add_filter('the_content', 'total_likes_count');
