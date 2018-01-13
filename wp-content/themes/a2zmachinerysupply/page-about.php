<?php get_header(); ?>

<style type="text/css">
	.img-circle{
		border: 6px solid white;
		box-shadow: 0px 1px 4px rgba(0, 0, 0, 0.1);
	}
	
</style>

    <div class="container-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <?php custom_breadcrumbs(); ?>

                </div>
                <div class="col-md-4">
                    <?php get_sidebar(); ?>
                </div>
                <div class="col-md-8 about-us-wrapper">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="page-title">About Us</h1>
                        </div>

                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <center>
                                <img class="img-circle" src="<?php echo get_template_directory_uri().'/img/nurmohammad.jpg' ?>" />

                                    <strong>Nur Mohammad Khandaker</strong><br>
                                    Managing Directory of<br>
                                    A2z Machinery Supply and<br>
                                    Star Bearing House

                            </center>
                        </div>
                        <div class="col-md-4"></div>

                        <div class="col-md-12">
                            <br>
                            <p>Thanks to visit our website. Welcome to A2z Machinery Supply. A2z Machinery Supply is a trusted name of quality & commitment in Ball & Roller Bearing, Boiler & Pneumatic, V-Belt & Timing Belt, Hand Tools & Power Tools, Fire & Safety Equipments etc.</p>
                            <br>
                            <p>Since 1992. We have 25 years experience in this sector. Our target is to satisfy our clients and customers. Our reputation is the satisfaction of our customer. We think service is the way to go ached. So we always try to give our best service to our valuable clients.</p>
                            <br>
                            <p>We get Online Quotations for giving you a best price with best quality <a href="http://a2zmachinerysupply.com/order/" target="_blank">Click Here</a> . We deliver the product to your Office, Work Place or Factory on your necessary. </p>
                            <br>
                            <p>Hope our service will satisfy you. Your satisfaction is our hope. Thanks to stay with us. Welcome to the digital world.</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


<?php get_footer(); ?>