<?php
/*
Plugin Name: Staff Table Demo
Plugin URI: http://joebuckle.me/use-wordpress-custom-post-types-and-datatables-to-create-a-searchable-staff-table/
Description: This is the packaged code that relates to the blog post
Version: 0.1
Author: Joe Buckle
Author URI: http://joebuckle.me
*/

/* NOTES
This code has been converted into a plugin to ensure it works out-of-the-box
*/

include_once('staff/staff.php');

// Flush rewrite rules on activation
function my_rewrite_flush() {

    register_staff_member();

    // ATTENTION: This is *only* done during plugin activation hook in this example!
    // You should *NEVER EVER* do this on every page load!!
    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'my_rewrite_flush' );
?>