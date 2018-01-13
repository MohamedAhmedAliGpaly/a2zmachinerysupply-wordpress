<?php
// Register Widget
function my_widget() {

    $args = array(
        'id'            => 'left_sidebar',
        'class'         => 'left-sidebar',
        'name'          => __( 'Lest Sidebar', 'a2zmachinerysupply' ),
        'description'   => __( 'For category left sidebar items', 'a2zmachinerysupply' ),
    );
    register_sidebar( $args );

    $args = array(
        'id'            => 'newsletter_widget',
        'class'         => 'newsletter-widget',
        'name'          => __( 'Newsletter Widget', 'a2zmachinerysupply' ),
        'description'   => __( 'For newsletter items', 'a2zmachinerysupply' ),
    );
    register_sidebar( $args );

}
add_action( 'widgets_init', 'my_widget' );