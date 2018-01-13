<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?php echo base_url('img/fav.png'); ?>" type="image/ico" />
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo isset($title)?$title.' - A2z Machinery Supply Bangladesh | a2zmachinerysupply.com':'A2z Machinery Supply Bangladesh | a2zmachinerysupply.com'; ?></title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url('css/reset.css'); ?>" rel="stylesheet" media="all">
    <link href="<?php echo base_url('css/bootstrap.css'); ?>" rel="stylesheet" media="all">
    <link href="<?php //echo base_url('css/bootstrap-theme.min.css'); ?>" rel="stylesheet" media="all">
    <link href="<?php echo base_url('css/theme/slate.css'); ?>" rel="stylesheet" media="all">
    <link href="<?php //echo base_url('css/non-responsive.css'); ?>" rel="stylesheet" media="all">
    <link href="<?php echo base_url('css/admin-side-navigation.css'); ?>" rel="stylesheet" media="all">
    <link href="<?php echo base_url('css/font-awesome.css'); ?>" rel="stylesheet" media="all">
    <link href="<?php echo base_url('css/jquery-ui.css'); ?>" rel="stylesheet" media="all">
    <link href="<?php echo base_url('css/table-sorter.css'); ?>" rel="stylesheet" media="all">
    <link href="<?php echo base_url('css/style.css'); ?>" rel="stylesheet" media="all">
    <link href="<?php echo base_url('css/media.css'); ?>" rel="stylesheet" media="all">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?php echo base_url('js/jquery.min.js'); ?>"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url('js/jquery-ui.js'); ?>"></script>
    <script src="<?php echo base_url('js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo base_url('js/admin-side-navigation.js'); ?>"></script>
    <script src="<?php echo base_url('js/table-sorter.js'); ?>"></script>
    <script src="<?php echo base_url('js/currency.js'); ?>"></script>
    <script src="<?php echo base_url('js/script.js'); ?>"></script>

    <style type="text/css">
        .divider-wrapper{
            border-bottom: 1px solid #3e3e3e;
            margin-bottom: 30px;
            display: none;
        }

    </style>

    <?php
    if ($this->session->userdata('logged_in') != TRUE) { ?>
        <style type="text/css">
            .hidden-menu{
                display: none;
            }

            .divider-wrapper{
                display: block;
            }

            .hidden-top-menu{
                display: none;
            }
        </style>
    <?php
    }
    ?>


</head>
<body>


<div class="page-wrapper">
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="top-menu hidden-top-menu">
                    <ul id="menu-top-menu" class="">
                        <li class=""><a target="_blank" href="http://www.a2zmachinerysupply.com/">Home</a></li>
                        <li class=""><a target="_blank" href="http://www.a2zmachinerysupply.com/about/">About</a></li>
                        <li class=""><a target="_blank" href="http://www.a2zmachinerysupply.com/contact/">Contact</a></li>
                        <li class=""><a target="_blank" href="http://www.a2zmachinerysupply.com/how-to-quotation/">How To Order</a></li>


                        <div class="pull-right">
                            <?php if ($this->session->userdata('name') != NULL) { ?>
                                <li><a href="<?php echo site_url('user_controller/dashboard'); ?>">Welcome, <?php echo $this->session->userdata('name'); ?></a></li>

                            <?php } else { ?>
                                <li><a href="<?php echo site_url('site_controller/login'); ?>">Login</a></li>
                            <?php } ?>

                            <?php if ($this->session->userdata('logged_in')) { ?>
                                <li><a href="<?php echo site_url('user_controller/logout'); ?>">Logout</a></li>
                            <?php } else { ?>
                                <li><a href="<?php echo site_url('site_controller/signup'); ?>">Signup</a></li>
                            <?php } ?>
                        </div>


                    </ul>

                </div>
            </div>

            <div class="col-md-12 logo-wrapper">
                <img src="<?php echo base_url('/img/logo.png'); ?>">
            </div>


            <div class="col-md-12">
                <div class="divider-wrapper">
                        <div class="top-menu">
                            <ul id="menu-top-menu" class="">
                                <li class=""><a target="_blank" href="http://www.a2zmachinerysupply.com/">Home</a></li>
                                <li class=""><a target="_blank" href="http://www.a2zmachinerysupply.com/about/">About</a></li>
                                <li class=""><a target="_blank" href="http://www.a2zmachinerysupply.com/contact/">Contact</a></li>
                                <li class=""><a target="_blank" href="http://www.a2zmachinerysupply.com/how-to-quotation/">How To Order</a></li>


                                <div class="pull-right">
                                    <?php if ($this->session->userdata('name') != NULL) { ?>
                                        <li><a href="<?php echo site_url('user_controller/dashboard'); ?>">Welcome, <?php echo $this->session->userdata('name'); ?></a></li>

                                    <?php } else { ?>
                                        <li><a href="<?php echo site_url('login'); ?>">Login</a></li>
                                    <?php } ?>

                                    <?php if ($this->session->userdata('logged_in')) { ?>
                                        <li><a href="<?php echo site_url('logout'); ?>">Logout</a></li>
                                    <?php } else { ?>
                                        <li><a href="<?php echo site_url('signup'); ?>">Signup</a></li>
                                    <?php } ?>
                                </div>


                            </ul>

                        </div>
                </div>
            </div>


            <div class="col-md-12 hidden-menu">
                <nav class="navbar navbar-default" style="margin-top: 18px;">
                    <div class="container-fluid">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="<?php echo site_url('user_controller/dashboard'); ?>">DASHBOARD</a>
                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                            <ul class="nav navbar-nav">
                                <li><a title="Create a new quotation" href="<?php echo site_url('user_controller/quotation_entry'); ?>">Create New Quotation</a></li>

                                <li><a title="View of all quotations" href="<?php echo site_url('user_controller/quotation_list'); ?>">All Quotations</a></li>
                                <li><a title="View of all quotation items" href="<?php echo site_url('user_controller/quotation_item_list'); ?>">All Quotation Items</a></li>

                                <li><a title="View your profile information" href="<?php echo site_url('user_controller/my_profile'); ?>">My Profile</a></li>
                                <li><a title="Change your old password" href="<?php echo site_url('site_controller/change_password'); ?>">Change Password</a></li>
                            </ul>

                            <ul class="nav navbar-nav navbar-right hidden">
                                <li><a href="#">Quotations <span class="badge text-info">30</span></a></li>
                            </ul>
                        </div><!-- /.navbar-collapse -->
                    </div><!-- /.container-fluid -->
                </nav>
            </div>

        </div>
    </div>
    <!--/.headerWrapper-->





   





