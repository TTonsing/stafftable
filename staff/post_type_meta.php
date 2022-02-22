<?php
// Function that adds a meta box to 'Staff Member'
function staff_meta() {
    add_meta_box( 'staff_meta', 'Staff Details', 'staff_meta_functions', 'staff_member', 'normal', 'high' );
}

// Form in the meta box
function staff_meta_functions() {

    global $post;

    wp_nonce_field( plugin_basename( __FILE__ ), 'staff_meta_functions_nonce' ); // Create nonce to protect post

    // If meta exists, get it
    $first_name = get_post_meta($post->ID, '_first_name', true);
    $last_name = get_post_meta($post->ID, '_last_name', true);
    $position = get_post_meta($post->ID, '_position', true);
    $notes = get_post_meta($post->ID, '_notes', true);
    ?>
<p>
    <label for="first_name">First Name</label>
    <input class="widefat" type="text" name="_first_name" id="first_name" value="<?php
        if(isset($first_name)) {
            echo $first_name;
        }
        ?>" />
</p>
<p>
    <label for="last_name">Last Name</label>
    <input class="widefat" type="text" name="_last_name" id="last_name" value="<?php
        if(isset($last_name)) {
            echo $last_name;
        }
        ?>" />
</p>
<p>
    <label for="position">Position</label>
    <input class="widefat" type="text" name="_position" id="position" value="<?php
        if(isset($position)) {
            echo $position;
        }
        ?>" />
</p>
<p>
    <label for="notes">Notes</label>
    <textarea class="widefat" rows="10" name="_notes" id="notes"><?php
        if(isset($notes)) {
            echo $notes;
        }
        ?></textarea>
</p>
<?php
}

// Save any editted meta
function staff_meta_save($post_id, $post) {
    global $post;

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
        return false;


    if ( !current_user_can( 'edit_post', $post->ID ) ) {
        return $post->ID;
    }

    if (!wp_verify_nonce( $_POST['staff_meta_functions_nonce'], plugin_basename( __FILE__ ) ) ) {

    } else {
        if($_POST['_first_name']) {
            update_post_meta($post->ID, '_first_name', $_POST['_first_name']);
        } else {
            update_post_meta($post->ID, '_first_name', '');
        }
        if($_POST['_last_name']) {
            update_post_meta($post->ID, '_last_name', $_POST['_last_name']);
        } else {
            update_post_meta($post->ID, '_last_name', '');
        }
        if($_POST['_position']) {
            update_post_meta($post->ID, '_position', $_POST['_position']);
        } else {
            update_post_meta($post->ID, '_position', '');
        }
        if($_POST['_notes']) {
            update_post_meta($post->ID, '_notes', $_POST['_notes']);
        } else {
            update_post_meta($post->ID, '_notes', '');
        }
    }

    return false;
}

// Hooks
add_action( 'admin_menu', 'staff_meta' );
add_action( 'save_post', 'staff_meta_save', 1, 2);
?>