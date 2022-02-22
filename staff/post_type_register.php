<?php
// Create staff member post type
function register_staff_member() {
    register_post_type( 'staff_member',
        array(
            'labels' => array(
                'name' => __( 'Staff Members' ),
                'singular_name' => __( 'Staff Member' ),
                'menu_name' => __( 'Staff Members' ),
                'all_items' => __( 'All Staff Members' ),
                'add_new' => __( 'Add New Staff Members' ),
                'add_new_item' => __( 'Add New Staff Members' ),
                'edit_item' => __( 'Edit Staff Member' ),
                'new_item' => __( 'New Staff Member' ),
                'view_item' => __( 'View Staff Member' ),
                'search_items' => __( 'Search Staff Members' ),
                'not_found' => __( 'Staff Member Not Found' ),
                'not_found_in_trash' => __( 'Staff Member Not Found In Trash' ),
                'parent_item_colon' => __( 'Parent Staff Member' ),
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array('thumbnail'),
        )
    );
}

add_action( 'init', 'register_staff_member' );
?>