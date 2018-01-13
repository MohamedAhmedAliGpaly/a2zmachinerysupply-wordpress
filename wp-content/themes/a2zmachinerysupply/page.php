<?php

$page_id = get_the_ID();
$page = get_post($page_id);
$slug = $page->post_name;




if ($slug == 'contact') {
    require_once 'page-contact.php';
} elseif ($slug == 'about') {
    require_once 'page-about.php';
} elseif ($slug == 'how-to-quotation') {
    require_once 'page-how-to-quotation.php';
} elseif ($slug == 'store') {
    require_once 'page-store.php';
}
else{
    ?>
    <?php get_header(); ?>

    <div class="container-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <?php custom_breadcrumbs(); ?>

                </div>
                <div class="col-md-4">
                    <?php get_sidebar(); ?>
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="page-title">Store</h1>
                        </div>
                        <?php
                        if (have_posts()) :
                            while ( have_posts() ) : the_post();
                                ?>
                                <div class="col-md-12">
                                    <?php the_content(); ?>
                                </div>
                            <?php
                            endwhile;
                        else:
                            echo _e("Nothing Found!");
                        endif;
                        ?>

                        <div class="col-md-12">
                            <?php if (function_exists("pagination")) {
                                pagination($additional_loop->max_num_pages);
                            } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php get_footer(); ?>


<?php } ?>




