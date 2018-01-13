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
                            <h1 class="page-title">How To Quotation</h1>
                        </div>
                        <div class="col-md-12">
                            <img width="100%" src="<?php echo get_template_directory_uri().'/img/how-to.jpg' ?>">

                            <style type="">
                                ol{
                                    margin-top: 25px;
                                    list-style: none;
                                }
                                ol li a{
                                    font-size: 18px;
                                    line-height: 1.6em;
                                    text-transform: capitalize;
                                    color: red;
                                    transition: all 0.3s ease;
                                }

                                ol li a:hover{
                                    color: #ff8800;
                                }

                                ol span{
                                    color: #000000;
                                }

                            </style>

                            <ol>
                                <li><a target="_blank" href="http://www.order.a2zmachinerysupply.com/signup/"><span>1.</span> Goto Signup Page</a> </li>
                                <li><a target="_blank" href="http://www.order.a2zmachinerysupply.com/login"><span>2.</span> Goto Login Page</a> </li>
                            </ol>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php get_footer(); ?>