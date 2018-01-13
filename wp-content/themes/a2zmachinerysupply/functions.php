<?php
include('inc/support.php');
include('inc/nav.php');
include('inc/widget.php');
include('inc/meta.php');
include('inc/script.php');
include('inc/style.php');
include('inc/post-type.php');
include('inc/breadcrumb.php');
include('inc/pagination.php');
include('inc/duplicate.php');


session_start();
if(empty($_SESSION['detail_list'])){
    if(isset($_POST['detail_list'])){
        $_SESSION['detail_list'] = true;
    }
}

if(isset($_POST['short_list'])){
    unset($_SESSION['detail_list']);
}



function my_register_post_tags() {
    register_taxonomy( 'post_tag', array() );
}
add_action( 'init', 'my_register_post_tags' );



/*function limit_posts_per_archive_page() {

    if ( is_category() ) {
        set_query_var('posts_per_archive_page', 18);
    }elseif ( is_search() ){
        set_query_var('posts_per_archive_page', 18);
    }else{
        set_query_var('posts_per_archive_page', 18);
    }
}
add_filter('pre_get_posts', 'limit_posts_per_archive_page');*/




















































