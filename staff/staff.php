<?php
include_once('post_type_register.php');
include_once('post_type_meta.php');
include_once('post_type_columns.php');
include_once('post_type_shortcode.php');

function staff_assets(){
    // The paths have been slightly modified since the assets are now in a plugin.

    /* Origin:
    wp_register_script( 'jquery_datatables_js',  get_template_directory_uri() . '/staff/asset/js/jquery.dataTables.min.js', array(),null,true );
    */
    wp_register_script( 'jquery_datatables_js',  plugins_url( 'asset/js/jquery.dataTables.min.js' , __FILE__ ), array(),null,true );
    wp_enqueue_script( 'jquery_datatables_js' );

    /* Origin:
    wp_register_style( 'jquery_datatables_css',  get_template_directory_uri() . '/staff/asset/css/jquery.dataTables.css');
    */
    wp_register_style( 'jquery_datatables_css',  plugins_url( 'asset/css/jquery.dataTables.css' , __FILE__ ));
    wp_enqueue_style( 'jquery_datatables_css' );
}

add_action('wp_enqueue_scripts', 'staff_assets');
?>

