<?php
// Validation functions
function wpac_check_user($uid) {

    // scenario 1: empty
    if (empty($uid)) {
        return false;
    }
    // scenario 2: numeric
    if (!is_numeric($uid)) {
        return false;
    }

    return true;
}
function wpac_check_post_id($pid) {

    // scenario 1: empty
    if (empty($pid)) {
        return false;
    }
    // scenario 2: numeric
    if (!is_numeric($pid)) {
        return false;
    }

    return true;
}