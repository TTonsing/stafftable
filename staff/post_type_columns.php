<?php
// Custom column Display
add_filter( 'manage_edit-staff_member_columns', 'edit_staff_member_columns' ) ;

function edit_staff_member_columns( $columns ) {
    $columns = array(
        'thumbnail' => ('Thumbnail'),
        'first_name' => __( 'First Name' ),
        'last_name' => __(' Last Name' ),
        'position' => __('Position'),
        'edit' => __('Edit')
    );
    return $columns;
}

// What to display in each list column
add_action( 'manage_staff_member_posts_custom_column', 'manage_staff_member_columns', 10, 2 );

function manage_staff_member_columns( $column, $post_id ) {

    // Get meta if exists
    $thumbnail = get_the_post_thumbnail( $post_id, 'thumbnail' );
    $first_name = get_post_meta( $post_id, '_first_name', true );
    $last_name = get_post_meta( $post_id, '_last_name', true );
    $position = get_post_meta( $post_id, '_position', true );

    switch( $column ) {

        case 'thumbnail' :
            if ( empty( $thumbnail))
                echo __( 'Unknown' );
            else
                echo $thumbnail;
            break;

        case 'first_name' :
            if ( empty( $first_name ) ) {
                echo __( 'Unknown' );
            } else {
                echo $first_name;
            }
            break;

        case 'last_name' :
            if ( empty( $last_name ) ) {
                echo __( 'Unknown' );
            } else {
                echo $last_name;
            }
            break;

        case 'position' :
            if ( empty( $position ) ) {
                echo __( 'Unknown' );
            } else {
                echo $position;
            }
            break;
        case 'edit' :
            //echo '<a href="/wp-admin/post.php?post='.$post_id.'&action=edit">EDIT</a>';
			$admin_post_url1=site_url('wp-admin/post.php?post=');
			//echo '<script>alert($admin_post_url1);</script>';
			echo '<a href="'.$admin_post_url1.''.$post_id.'&action=edit">EDIT</a>';
            break;
    }
}

// Which columns are filterable
add_filter( 'manage_edit-staff_member_sortable_columns', 'staff_sortable_columns' );

function staff_sortable_columns( $columns ) {
    $columns['first_name'] = 'first_name';
    $columns['last_name'] = 'last_name';
    $columns['position'] = 'position';
    return $columns;
}
?>