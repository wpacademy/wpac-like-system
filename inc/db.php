<?php
function wpac_create_db_tables() {
    global $wpdb;
    $wpac_db_version = WPAC_DB_VER;
    $wpac_installed_db_version = get_option( 'wpac_db_version' );
    $table_name = $wpdb->prefix . "wpac_like_system";
    $table_name_2 = $wpdb->prefix . "wpac_reactions_system";
    $charset_collate = $wpdb->get_charset_collate();

    if(!$wpac_installed_db_version) {
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

        $sql = "CREATE TABLE $table_name (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            user_id mediumint(9) NOT NULL,
            post_id mediumint(9) NOT NULL,
            like_count mediumint(9) NOT NULL,
            dislike_count mediumint(9) NOT NULL,
            cookie_id mediumint(10),
            user_ip varchar(50),
            time timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY  (id)
        ) $charset_collate;";
        dbDelta( $sql );
        $sql = "CREATE TABLE $table_name_2 (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            user_id mediumint(9) NOT NULL,
            post_id mediumint(9) NOT NULL,
            reaction_id mediumint(9) NOT NULL,
            cookie_id mediumint(10),
            user_ip varchar(50),
            time timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY  (id)
        ) $charset_collate;";

        dbDelta( $sql );
        add_option( 'wpac_db_version', $wpac_db_version );

    } else {
        if($wpac_installed_db_version != $wpac_db_version) {

            require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
            $sql = "CREATE TABLE $table_name (
                id mediumint(9) NOT NULL AUTO_INCREMENT,
                user_id mediumint(9) NOT NULL,
                post_id mediumint(9) NOT NULL,
                like_count mediumint(9) NOT NULL,
                dislike_count mediumint(9) NOT NULL,
                cookie_id mediumint(10),
                user_ip varchar(50),
                time timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                PRIMARY KEY  (id)
            ) $charset_collate;";
            dbDelta( $sql );
            $sql = "CREATE TABLE $table_name_2 (
                id mediumint(9) NOT NULL AUTO_INCREMENT,
                user_id mediumint(9) NOT NULL,
                post_id mediumint(9) NOT NULL,
                reaction_id mediumint(9) NOT NULL,
                cookie_id mediumint(10),
                user_ip varchar(50),
                time timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                PRIMARY KEY  (id)
            ) $charset_collate;";
    
            dbDelta( $sql );

            update_option( "wpac_db_version", $wpac_db_version );
        }
    }
    
}
