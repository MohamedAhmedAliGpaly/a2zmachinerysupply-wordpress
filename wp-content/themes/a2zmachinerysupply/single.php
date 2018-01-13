
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
                    <?php
                    wp_reset_query(); ?>
                    <?php if (have_posts()) :
                        while (have_posts()) : the_post();
                            ?>

                            <?php
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
                            $category_id = get_cat_ID($product_category[0]->name);

                            ?>


                            <div class="col-md-12">
                                <div class="single-product">
                                    <div class="row">
                                        <div class="col-md-7">
                                            <div class="product-image">
                                                <img src="<?php echo the_post_thumbnail_url( 'large' ); ?>" alt="<?php echo the_title(); ?>">
                                                <?php if (!empty($the_excerpt)){ ?>
                                                <?php } ?>
                                            </div>
                                            <div class="product-description">
                                                <p class="title"><span>Long-Description: </span></p>
                                                <?php echo the_content(); ?>
                                            </div>

                                            <?php if (!empty($the_excerpt)){ ?>
                                                <div class="product-excerpt">
                                                    <p class="title"><span>Brief-Description:</span></p>
                                                    <?php echo the_excerpt(); ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="product-info">
                                                <p>Reference: <span><?php echo get_the_ID(); ?></span></p>
                                                <h1><?php echo the_title(); ?></h1>
                                                <ul>
                                                    <?php if (!empty($product_specification_brand)){ ?>
                                                        <li>Brand: <?php echo $product_specification_brand; ?> </li>
                                                    <?php } ?>

                                                    <?php if (!empty($product_specification_country)){ ?>
                                                        <li>Made in: <?php echo $product_specification_country; ?> </li>
                                                    <?php } ?>

                                                    <?php if (!empty($product_specification_rpm)){ ?>
                                                        <li>RPM: <?php echo $product_specification_rpm; ?> </li>
                                                    <?php } ?>

                                                    <?php if (!empty($product_specification_weight)){ ?>
                                                        <li>Weight: <?php echo $product_specification_weight; ?> </li>
                                                    <?php } ?>

                                                    <?php if (!empty($product_specification_size)){ ?>
                                                        <li>Size: <?php echo $product_specification_size; ?> </li>
                                                    <?php } ?>

                                                    <?php if (!empty($product_specification_color)){ ?>
                                                        <li>Color: <?php echo $product_specification_color; ?> </li>
                                                    <?php } ?>

                                                    <?php if (!empty($product_specification_pressure)){ ?>
                                                        <li>Pressure: <?php echo $product_specification_pressure; ?> </li>
                                                    <?php } ?>

                                                    <?php if (!empty($product_specification_temperature)){ ?>
                                                        <li>Temperature: <?php echo $product_specification_temperature; ?> </li>
                                                    <?php } ?>

                                                    <?php if (!empty($product_specification_force)){ ?>
                                                        <li>Force: <?php echo $product_specification_force; ?> </li>
                                                    <?php } ?>

                                                    <?php if (!empty($product_specification_dimension)){ ?>
                                                        <li>Dimension: <?php echo $product_specification_dimension; ?> </li>
                                                    <?php } ?>

                                                    <?php if (!empty($product_specification_power)){ ?>
                                                        <li>Power: <?php echo $product_specification_power; ?> </li>
                                                    <?php } ?>

                                                    <?php if (!empty($product_specification_warranty)){ ?>
                                                        <li>Warranty: <?php echo $product_specification_warranty; ?> </li>
                                                    <?php } ?>

                                                    <?php if (!empty($product_specification_price)){ ?>
                                                        <li>Price: <?php echo $product_specification_price; ?> </li>
                                                    <?php } ?>

                                                </ul>
                                            </div>

                                            <div class="social-links">
                                                <?php echo do_shortcode('[simple-social-share]'); ?>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        endwhile;
                    endif;
                    ?>
                    <?php wp_reset_query(); ?>
                </div>
            </div>


            <div class="col-md-8">
                <div class="category-post">
                    <h2 class="">Similar Products</h2>
                    <div class="row">

                        <?php


                        $args = array( 'posts_per_page' => 8, 'orderby' => 'rand', 'offset'=> 1, 'category' => $category_id );

                        $myposts = get_posts( $args );
                        foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
                            <div class="col-md-3 col-xs-3">
                                <div class="post-inner">
                                    <div class="post-image">
                                        <img src="<?php echo the_post_thumbnail_url( 'thumbnail' ); ?>" alt="<?php echo the_title(); ?>">
                                    </div>
                                    <div class="post-title">
                                        <a href="<?php echo the_permalink(); ?>"><?php echo the_title(); ?></a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach;
                        wp_reset_postdata();?>

                    </div>


                </div>
            </div>



        </div>
    </div>
</div>

</div>

<?php get_footer(); ?>
