<?php
function wpac_likes_table() {
    global $wpdb;

    $table_name = $wpdb->prefix . "wpac_like_system";
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
    id mediumint(9) NOT NULL AUTO_INCREMENT,
    time timestamp DEFAULT '0000-00-00 00:00:00' NOT NULL,
    user_id mediumint(9) NOT NULL,
    post_id mediumint(9) NOT NULL,
    like_count mediumint(9) NOT NULL,
    dislike_count mediumint(9) NOT NULL,
    PRIMARY KEY  (id)
    ) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}
function wpac_reactions_table() {
    global $wpdb;

    $table_name = $wpdb->prefix . "wpac_reactions_system";
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
    id mediumint(9) NOT NULL AUTO_INCREMENT,
    user_id mediumint(9) NOT NULL,
    post_id mediumint(9) NOT NULL,
    reaction_id mediumint(9) NOT NULL,
    time timestamp DEFAULT '0000-00-00 00:00:00' NOT NULL,
    
    PRIMARY KEY  (id)
    ) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}
