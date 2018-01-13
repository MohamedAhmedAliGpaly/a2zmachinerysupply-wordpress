<?php
// Register Nav
function my_nav() {

    $locations = array(
        'top_menu' => __( 'Top Menu', 'a2zmachinerysupply' ),
        'main_menu' => __( 'Main Menu', 'a2zmachinerysupply' ),
        'left_menu' => __( 'Left Menu', 'a2zmachinerysupply' ),
        'footer_menu' => __( 'Footer Menu', 'a2zmachinerysupply' ),
        'footer_left_menu' => __( 'Footer Left Menu', 'a2zmachinerysupply' ),
    );
    register_nav_menus( $locations );
}
add_action( 'init', 'my_nav' );