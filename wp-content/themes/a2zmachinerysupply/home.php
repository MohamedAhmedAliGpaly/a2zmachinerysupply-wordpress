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
                    <div class="col-md-12 ">
                        <div class="filter-list">
                            <form method="post" action="">
                                <button class="btn" value="1" name="detail_list">Details List: <i class="glyphicon glyphicon-th-list"></i></button>
                                <button class="btn" value="1" name="short_list">Short List: <i class="glyphicon glyphicon-th"></i></button>
                            </form>
                        </div>
                    </div>

                    <?php
//&category_name=ball-roller-bearings
                    query_posts('posts_per_page=15&offset=0&orderby=rand');

                    if (have_posts()) :
                        while ( have_posts() ) : the_post();
                            $product_specification_brand = get_post_meta( get_the_ID(), 'product_specification_brand', true );
                            $product_specification_country = get_post_meta( get_the_ID(), 'product_specification_country', true );
                            $product_specification_size = get_post_meta( get_the_ID(), 'product_specification_size', true );
                            $product_specification_weight = get_post_meta( get_the_ID(), 'product_specification_weight', true );
                            $product_specification_color = get_post_meta( get_the_ID(), 'product_specification_color', true );
                            $product_specification_pressure = get_post_meta( get_the_ID(), 'product_specification_pressure', true );
                            $product_specification_temperature = get_post_meta( get_the_ID(), 'product_specification_temperature', true );
                            $product_specification_force = get_post_meta( get_the_ID(), 'product_specification_force', true );
                            $product_specification_rpm = get_post_meta( get_the_ID(), 'product_specification_rpm', true );
                            $product_specification_dimension = get_post_meta( get_the_ID(), 'product_specification_dimension', true );
                            $product_specification_power = get_post_meta( get_the_ID(), 'product_specification_power', true );
                            $product_specification_warranty = get_post_meta( get_the_ID(), 'product_specification_warranty', true );
                            $product_specification_price = get_post_meta( get_the_ID(), 'product_specification_price', true );
                            $product_category = get_the_category();
                            $the_excerpt = get_the_excerpt();
                            ?>


                            <div class="col-md-4 col-xs-4 hide-product-block">
                                <div class="product-block">
                                    <a href="<?php echo the_permalink(); ?>">
                                        <img src="<?php echo the_post_thumbnail_url( 'thumbnail' ); ?>" alt="<?php echo the_title(); ?>">
                                    </a>
                                    <h2><a href="<?php echo the_permalink(); ?>"><?php echo the_title(); ?></a></h2>
                                    <?php if(is_super_admin() or is_admin()){
                                        echo edit_post_link('<strong>EDIT THE POST</strong>');
                                    } ?>
                                </div>
                            </div>



                            <div class="col-md-12 hide-product-inner">
                                <div class="product-inner">
                                    <div class="product-image">
                                        <a href="<?php echo the_permalink(); ?>">
                                            <img src="<?php echo the_post_thumbnail_url( 'thumbnail' ); ?>" alt="<?php echo the_title(); ?>">
                                        </a>
                                    </div>
                                    <div class="product-description">
                                        <h2><a href="<?php echo the_permalink(); ?>"><?php echo the_title(); ?></a>
                                            <?php if(is_super_admin() or is_admin()){
                                                echo edit_post_link('<i style="color: red;">EDIT</i>');
                                            } ?>
                                        </h2>
                                        <ul>
                                            <?php if (!empty($product_specification_brand)){ ?>
                                                <li><kbd>Brand: <?php echo $product_specification_brand; ?></kbd> </li>
                                            <?php } ?>

                                            <?php if (!empty($product_specification_country)){ ?>
                                                <li><kbd>Country: <?php echo $product_specification_country; ?></kbd> </li>
                                            <?php } ?>

                                            <?php if (!empty($product_specification_rpm)){ ?>
                                                <li><kbd>RPM: <?php echo $product_specification_rpm; ?></kbd> </li>
                                            <?php } ?>

                                            <?php if (!empty($product_specification_weight)){ ?>
                                                <li><kbd>Weight: <?php echo $product_specification_weight; ?></kbd> </li>
                                            <?php } ?>

                                            <?php if (!empty($product_specification_size)){ ?>
                                                <li><kbd>Size: <?php echo $product_specification_size; ?></kbd> </li>
                                            <?php } ?>

                                            <?php if (!empty($product_specification_color)){ ?>
                                                <li><kbd>Color: <?php echo $product_specification_color; ?></kbd> </li>
                                            <?php } ?>

                                            <?php if (!empty($product_specification_pressure)){ ?>
                                                <li><kbd>Pressure: <?php echo $product_specification_pressure; ?></kbd> </li>
                                            <?php } ?>

                                            <?php if (!empty($product_specification_temperature)){ ?>
                                                <li><kbd>Temperature: <?php echo $product_specification_temperature; ?></kbd> </li>
                                            <?php } ?>

                                            <?php if (!empty($product_specification_force)){ ?>
                                                <li><kbd>Force: <?php echo $product_specification_force; ?></kbd> </li>
                                            <?php } ?>

                                            <?php if (!empty($product_specification_dimension)){ ?>
                                                <li><kbd>Dimension: <?php echo $product_specification_dimension; ?></kbd> </li>
                                            <?php } ?>

                                            <?php if (!empty($product_specification_power)){ ?>
                                                <li><kbd>Power: <?php echo $product_specification_power; ?></kbd> </li>
                                            <?php } ?>

                                            <?php if (!empty($product_specification_warranty)){ ?>
                                                <li><kbd>Warranty: <?php echo $product_specification_warranty; ?></kbd> </li>
                                            <?php } ?>

                                            <?php if (!empty($product_specification_price)){ ?>
                                                <li><kbd>Price: <?php echo $product_specification_price; ?></kbd> </li>
                                            <?php } ?>

                                            <?php if (!empty($product_category[0]->name)){ ?>
                                                <li><kbd>Category: <?php echo $product_category[0]->name; ?></kbd> </li>
                                            <?php } ?>
                                        </ul>

                                        <?php if (!empty($the_excerpt)){ ?>
                                            <div class="product-excerpt">
                                                <p>Brief-Description: <?php echo $the_excerpt; ?></p>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        <?php
                        endwhile;
                    else:
                        echo _e("<p class='text-center' style='margin: 15px 0 5px 0; padding: 0;'><i class='fa fa-smile-o fa-3x'></i></p><h3  style='margin: 0; padding: 0;' class='text-center'>Nothing Found!</h3>");
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





