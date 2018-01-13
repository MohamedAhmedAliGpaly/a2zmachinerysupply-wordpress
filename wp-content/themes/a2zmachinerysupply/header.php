<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri().'/img/fav.png'; ?>" type="image/x-icon" />
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Bootstrap -->
    <link href="<?php echo get_template_directory_uri().'/css/bootstrap.min.css'; ?>" rel="stylesheet" media="screen">
    <link href="<?php echo get_template_directory_uri().'/css/bootstrap-theme.min.css'; ?>" rel="stylesheet" media="screen">
    <link href="<?php echo get_template_directory_uri().'/css/font-awesome.min.css'; ?>" rel="stylesheet" media="screen">
    <link href="<?php echo get_template_directory_uri().'/css/flexslider.css'; ?>" rel="stylesheet" media="screen">
    <link href="<?php echo get_template_directory_uri().'/style.css'; ?>" rel="stylesheet">
    <link href="<?php echo get_template_directory_uri().'/css/media.css'; ?>" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <?php
    if(is_category() or is_single() or is_page() or is_search()){
        ?>
        <style type="text/css">
            .menu-wrapper{
                border-bottom: 1px solid #d2dae3;
            }

        </style>
    <?php
    }
    ?>

    <?php
    if(!is_home()){
        ?>
        <style type="text/css">
            .slider-wrapper, .hot-product-wrapper{
                display: none;
            }
        </style>
    <?php
    }
    ?>

    <?php
    $paged = get_query_var('paged');
    if($paged > 0){ ?>
        <style type="text/css">
            .menu-wrapper{
                border-bottom: 1px solid #d2dae3;
            }

            .slider-wrapper, .hot-product-wrapper{
                /*display: none;*/
            }
        </style>
    <?php }
    ?>


    <style type="text/css">
        .hide-product-inner{
            display: none;
        }
    </style>

    <?php

    if(isset($_SESSION['detail_list'])){
        ?>
        <style type="text/css">
            .hide-product-inner{
                display: block;
            }

            .hide-product-block{
                display: none;
            }
        </style>
    <?php
    }
    ?>


    <?php wp_head(); ?>
</head>
<body>

<div class="top-navigation-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-5 col-xs-12">
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'top_menu',
                    'menu_class'     => '',
                    'container' => 'div',
                    'container_class' => 'top-menu',
                ) );
                ?>
            </div>
            <div class="col-md-2 col-xs-12">
                <div class="shop-phone">
                    <i class="glyphicon glyphicon-earphone"></i> 01676-717-945
                </div>
            </div>
            <div class="col-md-5 hidden-xs hidden-sm">
                <form class="navbar-form navbar-right searchform" role="search" method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search Product" value="<?php echo get_search_query(); ?>" name="s" id="s" required="">
                    </div>
                    <button type="submit" class="btn" id="searchsubmit" value="<?php echo esc_attr_x( 'Search', 'submit button' ); ?>">Search</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!--.top-navigation-wrapper-->


<div class="logo-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <a class="online-quotation-left" target="_blank" href="http://www.a2zmachinerysupply.com/order/">
                    <img src="<?php echo get_template_directory_uri().'/img/create-online-quotation-left.png'; ?>" alt="Make a Quotation - A2z Machinery Supply">
                </a>
                <a href="<?php echo home_url(); ?>">
                    <img src="<?php echo get_template_directory_uri().'/img/logo.png'; ?>" alt="Logo A2z Machinery Supply">
                </a>
                <a class="online-quotation-right" target="_blank" href="http://www.a2zmachinerysupply.com/order/">
                    <img src="<?php echo get_template_directory_uri().'/img/create-online-quotation-right.png'; ?>" alt="Make a Quotation - A2z Machinery Supply">
                </a>
            </div>
            <div class="col-md-12 text-center visible-xs visible-sm responsive-create-online-quotation">
                <a class="" target="_blank" href="http://www.a2zmachinerysupply.com/order/">
                    <img src="<?php echo get_template_directory_uri().'/img/create-online-quotation-right.png'; ?>" alt="Make a Quotation - A2z Machinery Supply">
                </a>
            </div>
        </div>
    </div>
</div>
<!--.logo-wrapper-->



<div class="menu-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav class="navbar">
                    <div class="container-fluid">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <?php
                            wp_nav_menu( array(
                                'theme_location' => 'main_menu',
                                'menu_class'     => '',
                                'container' => 'div',
                                'container_class' => 'main-menu',
                            ) );
                            ?>
                        </div><!-- /.navbar-collapse -->
                    </div><!-- /.container-fluid -->
                </nav>
            </div>
        </div>
    </div>
</div>
<!--.main-menu-wrapper-->

<div class="slider-wrapper">
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
            <li data-target="#carousel-example-generic" data-slide-to="3"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <img src="<?php echo get_template_directory_uri().'/img/slide/bearing-slide.jpg'; ?>" alt="Slide 1 A2z Machinery Supply">
            </div>
            <div class="item">
                <img src="<?php echo get_template_directory_uri().'/img/slide/boiler-slide.jpg'; ?>" alt="Slide 1 A2z Machinery Supply">
            </div>
            <div class="item">
                <img src="<?php echo get_template_directory_uri().'/img/slide/v-belt-slide.jpg'; ?>" alt="Slide 1 A2z Machinery Supply">
            </div>
            <div class="item">
                <img src="<?php echo get_template_directory_uri().'/img/slide/tools-slide.jpg'; ?>" alt="Slide 1 A2z Machinery Supply">
            </div>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>
<!--.slider-wrapper-->

<div class="hot-product-wrapper">
    <img src="<?php echo get_template_directory_uri().'/img/hot-product.jpg'; ?>" alt="Hot Product A2z Machinery Supply">
</div>
<!--.hot-product-wrapper-->
