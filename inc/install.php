<?php


function ld_create_table()
{
    global $wpdb;

    $table_name = $wpdb->prefix . "like_dislike_system";
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
  id mediumint(9) NOT NULL AUTO_INCREMENT,
  time datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
  user_id mediumint(9) NOT NULL,
  post_id mediumint(9) NOT NULL,
  like_count mediumint(9) NOT NULL,
  dislike_count mediumint(9) NOT NULL,
  PRIMARY KEY  (id)
) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}

function ld_destroy_table()
{
    global $wpdb;
    $table_name = $wpdb->prefix . "like_dislike_system";
    $sql = "DROP TABLE IF EXISTS $table_name";
    $wpdb->query($sql);
    delete_option("ld_like_btn_label");
    delete_option("ld_dislike_btn_label");

}

