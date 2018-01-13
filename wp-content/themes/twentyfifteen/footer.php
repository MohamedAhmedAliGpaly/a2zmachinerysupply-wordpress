<div class="brand-wrapper">

    <div class="flexslider">
        <ul class="slides">
            <?php
            $args = array(
                'posts_per_page'   => 15,
                'orderby'          => 'rand',
                'post_type'        => 'product_logo',
                'post_status'      => 'publish',
            );
            query_posts( $args );

            if (have_posts()) :
                while ( have_posts() ) : the_post();
                    ?>
                    <li>
                        <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php echo the_title(); ?>">
                    </li>
                <?php endwhile; ?>
            <?php else:
                echo _e("Nothing Found!");
            endif; ?>
        </ul>
    </div>

</div>
<!--.brand-wrapper-->





<div class="newsletter-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h4>Newsletter</h4>
                <p>Subscribe to the Securax mailing list to receive updates on new arrivals, special offers and other discount information.</p>
            </div>
            <div class="col-md-6">
                <ul>
                    <?php if ( is_active_sidebar( 'newsletter_widget' ) ) { ?>
                    <?php dynamic_sidebar( 'newsletter_widget' ); ?>
            </div>
            <?php } ?>
            </ul>
        </div>
    </div>
</div>
</div>
<!--.newsletter-wrapper-->



<div class="footer-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-xs-6">
                <h3>Information</h3>
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'footer_left_menu',
                ) );
                ?>
            </div>
            <div class="col-md-3 col-xs-6">
                <h3>Categories</h3>
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'footer_menu',
                ) );
                ?>
            </div>
            <div class="col-md-3 col-xs-6">
                <h3>Concerns</h3>
                <ul>
                    <li><a target="_blank" href="http://www.sbh.upokar.com">Star Bearing House</a> </li>
                </ul>
            </div>
            <div class="col-md-3 col-xs-6">
                <!--            <h3>Store Information</h3>-->
                <ul class="address">
                    <li><i class="fa fa-map-marker"></i> A2z Machinery Supply, 43/44 Nawabpur Road, Shewli Market, Shop #9 (Nine), Dhaka: 1100.</li>
                    <li><i class="fa fa-phone"></i> <a href="tel:01676717945">01676-717945</a> </li>
                    <li><i class="fa fa-envelope"></i> <a href="mailto:info@a2zmachinerysupply.com">info@a2zmachinerysupply.com</a> </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!--.footer-menu-wrapper-->





<div class="copyright-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-xs-12">
                <p><a href="http://www.a2zmachinerysupply.com/">Copyright © <?php echo date('Y'); ?> a2z machinery supply. All rights reserved.</a></p>
            </div>
            <div class="col-md-6 col-xs-12">
                <ul>
                    <li><a target="_blank" href="https://www.facebook.com/a2zmachinerysupply/"><i class="fa fa-facebook"></i> </a> </li>
                    <li><a target="_blank" href="https://twitter.com/masudrk2015"><i class="fa fa-twitter"></i> </a> </li>
                    <li><a target="_blank" href="https://plus.google.com/collection/wqw2XB"><i class="fa fa-google-plus"></i> </a> </li>
                    <li><a target="_blank" href="https://bd.linkedin.com/in/md-masudul-kabir-2696b4127"><i class="fa fa-linkedin"></i> </a> </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!--.copyright-wrapper-->




<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script type="text/javascript" src="<?php echo get_template_directory_uri().'/js/bootstrap.js'; ?>"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri().'/js/flexslider.js'; ?>"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri().'/js/scripts.js'; ?>"></script>
<?php wp_footer(); ?>

<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/57cadecda767d83b45f31417/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->

</body>
</html>