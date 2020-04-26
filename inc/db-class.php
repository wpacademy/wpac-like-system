<?php

class WPAC_DB {

    private $wpdb;
    public $likes_table;
    public $reactions_table;
    public $post_id;
    public $user_id;
    public $user_ip;
    public $reaction_id;
    public $status;
    public $post_like_count;
    public $post_dislike_count;
    public $post_reaction_count;
    public $post_like_count_key;
    public $post_dislike_count_key;
    public $post_reaction_count_key;

    public function __construct() {

        global $wpdb;
        $this->wpdb = $wpdb;

        $this->likes_table = $this->wpdb->prefix . "wpac_like_system";
        $this->reactions_table = $this->wpdb->prefix . "wpac_reactions_system";
        
        $this->post_like_count_key = "_wpac_post_likes";
        $this->post_dislike_count_key = "_wpac_post_dislikes";
        $this->post_reaction_count_key = "_wpac_post_reactions";

    }
    // Count total number of likes for given post ID
    public function wpac_count_likes($pid){
        $this->post_id = $pid;
        $this->wpdb->hide_errors(); 
        $like_count = $this->wpdb->get_var( $this->wpdb->prepare(
            "SELECT COUNT(*) FROM `$this->likes_table` WHERE post_id = %d AND like_count=1 ",
            $this->post_id
        ) );

        return $like_count;
    }
    // Count total number of dislikes for given post ID
    public function wpac_count_dislikes($pid){

        $this->post_id = $pid;
        $this->wpdb->hide_errors(); 
        $dislike_count = $this->wpdb->get_var( $this->wpdb->prepare(
            "SELECT COUNT(*) FROM `$this->likes_table` WHERE post_id = %d AND dislike_count=1",
            $this->post_id
        ) );
        
        return $dislike_count;
    }
    // Count number of all reactions
    public function wpac_reactions_count($pid,$rid) {

        $this->post_id = $pid;
        $this->reaction_id = $rid;
        $this->wpdb->hide_errors(); 
        $reaction_count = $this->wpdb->get_var( $this->wpdb->prepare(
            "SELECT COUNT(*) FROM `$this->reactions_table` WHERE post_id = %d",
            $this->post_id,
            $this->reaction_id
        ) );

        return $reaction_count;
    }
    // Count number of individual reactions
    public function wpac_reaction_count($pid,$rid) {

        $this->post_id = $pid;
        $this->reaction_id = $rid;
        $this->wpdb->hide_errors(); 
        $reaction_count = $this->wpdb->get_var( $this->wpdb->prepare(
            "SELECT COUNT(*) FROM `$this->reactions_table` WHERE post_id = %d AND reaction_id = %d",
            $this->post_id,
            $this->reaction_id
        ) );

        return $reaction_count;
    }
    // Check if a user has already liked the post
    public function wpac_check_like($pid, $uid) {
        $this->post_id = $pid;
        $this->user_id = $uid;
        $check_like = $this->wpdb->get_var( $this->wpdb->prepare(
            "SELECT COUNT(*) FROM `$this->likes_table` WHERE user_id = %d AND post_id = %d AND like_count=1 ",
            $this->user_id,
            $this->post_id
        ) );
        return $check_like;
    }
    //Check user like by IP address
    public function wpac_check_like_ip($pid, $uip) {

        $this->post_id = $pid;
        $this->user_ip = $uip;
        $check_like = $this->wpdb->get_var( $this->wpdb->prepare(
            "SELECT COUNT(*) FROM `$this->likes_table` WHERE user_ip = %s AND post_id = %d AND like_count=1 ",
            $this->user_ip,
            $this->post_id
        ) );
        return $check_like;
    }
    // Check if a user has already disliked the post
    public function wpac_check_deslike($pid, $uid){

        $this->post_id = $pid;
        $this->user_id = $uid;
        $check_dislike = $this->wpdb->get_var( $this->wpdb->prepare(
            "SELECT COUNT(*) FROM `$this->likes_table` WHERE user_id = %d AND post_id = %d AND dislike_count=1 ",
            $this->user_id,
            $this->post_id
        ) );
        return $check_dislike;
    }
    //Check user disliked by IP
    public function wpac_check_deslike_ip($pid, $uip){

        $this->post_id = $pid;
        $this->user_ip = $uip;
        $check_dislike = $this->wpdb->get_var( $this->wpdb->prepare(
            "SELECT COUNT(*) FROM `$this->likes_table` WHERE user_ip = %s AND post_id = %d AND dislike_count=1 ",
            $this->user_ip,
            $this->post_id
        ) );
        return $check_dislike;
    }
    // Check if a user has already reacted to the post
    public function wpac_check_reaction($pid, $uid) {

        $this->post_id = $pid;
        $this->user_id = $uid;
        $check_reaction = $this->wpdb->get_var( $this->wpdb->prepare(
            "SELECT COUNT(*) FROM `$this->reactions_table` WHERE user_id = %d AND post_id = %d",
            $this->user_id,
            $this->post_id
        ) );
        return $check_reaction;
    }
    //Check Reacction Status by IP
    public function wpac_check_reaction_ip($pid, $uip) {

        $this->post_id = $pid;
        $this->user_ip = $uip;
        $check_reaction = $this->wpdb->get_var( $this->wpdb->prepare(
            "SELECT COUNT(*) FROM `$this->reactions_table` WHERE user_ip = %s AND post_id = %d",
            $this->user_ip,
            $this->post_id
        ) );
        return $check_reaction;
    }
    // Add new like to database
    public function wpac_insert_new_like($uid, $uip, $pid) {

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        $this->post_id = $pid;
        $this->user_ip = $uip;
        $this->user_id = $uid;
        $this->status = 0;

        if($this->post_id > 0 && $this->post_id != ""){
            $this->wpdb->insert( 
                ''.$this->likes_table.'', 
                array( 
                    'post_id' => $this->post_id,
                    'user_id' => $this->user_id,
                    'user_ip' => $this->user_ip,
                    'like_count' => 1
                ), 
                array( 
                    '%d', 
                    '%d',
                    '%s',
                    '%d'
                )
            );
            if($this->wpdb->insert_id) {
                $this->status = 1;

                $this->post_like_count = get_post_meta($this->post_id, $this->post_like_count_key, true);
                if($this->post_like_count==''){
                    $this->post_like_count = 0;
                    delete_post_meta($this->post_id, $this->post_like_count_key);
                    add_post_meta($this->post_id, $this->post_like_count_key, '1');
                } else{
                    $this->post_like_count = $this->wpac_count_likes($this->post_id);
                    update_post_meta($this->post_id, $this->post_like_count_key, $this->post_like_count);
                }
            } else {
                $this->status = 0;
            }
        } else {
            $this->status = 0;
        }
        return $this->status;
    }
    // Add new dislike to database
    public function wpac_insert_new_dislike($uid, $uip, $pid) {

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        $this->post_id = $pid;
        $this->user_ip = $uip;
        $this->user_id = $uid;
        $this->status = 0;

        if($this->post_id > 0 && $this->post_id != ""){
            $this->wpdb->insert(
                ''.$this->likes_table.'',
                array(
                    'post_id' => $this->post_id,
                    'user_id' => $this->user_id,
                    'user_ip' => $this->user_ip,
                    'dislike_count' => 1
                ),
                array(
                    '%d',
                    '%d',
                    '%s',
                    '%d'
                )
            );
            if($this->wpdb->insert_id) {
                $this->status = 1;
                $this->post_dislike_count = get_post_meta($this->post_id, $this->post_dislike_count_key, true);
                if($this->post_dislike_count==''){
                    $this->post_dislike_count = 0;
                    delete_post_meta($this->post_id, $this->post_dislike_count_key);
                    add_post_meta($this->post_id, $this->post_dislike_count_key, '1');
                } else{
                    $this->post_dislike_count = $this->wpac_count_likes($this->post_id);
                    update_post_meta($this->post_id, $this->post_dislike_count_key, $this->post_dislike_count);
                }
            } else {
                $this->status = 0;
            }
        } else {
            $this->status = 0;
        }
        return $this->status;
    }
    // Add new reaction to database
    public function wpac_insert_new_reaction($uid, $uip, $pid, $rid) {

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        //$this->wpdb->hide_errors(); 
        $this->user_id = intval($uid);
        $this->user_ip = $uip;
        $this->post_id = intval($pid);
        $this->reaction_id = intval($rid);

        $this->status = 0;
        if($this->post_id > 0 && $this->post_id != "" && $this->reaction_id > 0 && $this->reaction_id !=""){
            $this->wpdb->insert( 
                ''.$this->reactions_table.'', 
                array( 
                    'post_id' => $this->post_id,
                    'user_id' => $this->user_id,
                    'user_ip' => $this->user_ip,
                    'reaction_id' => $this->reaction_id
                ), 
                array( 
                    '%d', 
                    '%d',
                    '%s',
                    '%d'
                )
            );
            if($this->wpdb->insert_id) {
                $this->status = 1;
                $this->post_reaction_count = get_post_meta($this->post_id, $this->post_reaction_count_key, true);
                if($this->post_reaction_count==''){
                    $this->post_reaction_count = 0;
                    delete_post_meta($this->post_id, $this->post_reaction_count_key);
                    add_post_meta($this->post_id, $this->post_reaction_count_key, '1');
                } else{
                    $this->post_reaction_count = $this->wpac_count_likes($this->post_id);
                    update_post_meta($this->post_id, $this->post_reaction_count_key, $this->post_reaction_count);
                }
            } else {
                $this->status = 0;
            }
        } else {
            $this->status = 0;
        }
        return $this->status;
    }
}