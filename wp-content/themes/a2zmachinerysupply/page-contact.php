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
                <div class="col-md-8 address-wrapper">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="page-title">Contact Us</h1>
                        </div>

                        <div class="col-md-12">
                            <h2 style="font-family: 'Orbitron', sans-serif; color: #ff8800; margin: 0 0 15px; padding: 0; font-weight: 500">A<span style="">2</span>Z Machinery Supply</h2>
                        </div>

                        <div class="col-md-6">
                            <ul>
                                <li>Address: </li>
                                <li>
                                    43/44 Nawabpur Road, Shewli Market, <br>Shop #9 (Nine), Dhaka: 1100, Bangladesh, Asia.
                                </li>
                            </ul>

                            <ul>
                                <li>Contact Details: </li>
                                <li><i class="glyphicon glyphicon-phone-alt"></i> <a href="tel:029588952">9588952 (Show Room)</a></li>
                                <li><i class="fa fa-phone"></i> <a href="tel:+8801712548889">01712-548889 (Proprietor)</a></li>
                                <li> <i class="fa fa-phone"></i> <a href="tel:+8801676717945">01676-717945 (Co-Proprietor)</a></li>
<!--                                <li> <i class="fa fa-phone"></i> <a href="tel:+8801770520203">+88 - 01770520203 (Sales Executive)</a></li>-->
<!--                                <li><i class="fa fa-phone"></i> <a href="tel:+8801675874654">+88-01675-874654 (Co-Proprietor)</a></li>-->
<!--                                <li><i class="fa fa-phone"></i> <a href="tel:+8801950565741">+88 - 01950565741 (Sales Executive)</a></li>-->
<!--                                <li><i class="fa fa-envelope"></i> <a href="mailto:info@a2zmachinerysupply.com">info@a2zmachinerysupply.com</a></li>-->
                                <li><i class="fa fa-envelope"></i> <a href="mailto:masudrk2015@gmail.com">masudrk2015@gmail.com</a></li>
<!--                                <li><i class="fa fa-envelope"></i> <a href="mailto:masudrk2015@yahoo.com">masudrk2015@yahoo.com</a></li>-->
                            </ul>

                            <ul>
                                <li>Opening Time: </li>
                                <li>
                                    Opening: 9:00 AM &amp; Closing: 6:00 PM
                                </li>
                            </ul>
                        </div>

                        <div class="col-md-6 maps">
<!--                            <h1 style="text-align: center; font-size: 30px; margin-top: 30px; border-bottom: 1px solid #f5f5f5; padding-bottom: 5px;">Our Location</h1>-->
                            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d7305.7287931166275!2d90.40783094229737!3d23.71653606352035!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b8ffe962d0f3%3A0x4c2b3b393d2eb808!2sA2z+Machinery+Supply!5e0!3m2!1sen!2sbd!4v1472879423987" width="100%" frameborder="0" style="margin-top: 4px; height: 248px; border: 7px solid #f5f5f5; margin-bottom: 20px; pointer-events: none;"></iframe>
                        </div>
						
						
						<div class="col-lg-12 feedback-form-wrapper">
                            <h1>Feedback / Inquiry</h1>
                            <p style="margin: 0 0 10px 0;">We're happy to answer questions or concerns. Please fill out the form below if you need assistance: </p>
							<?php echo do_shortcode('[contact-form-7 id="241" title="Feedback Form"]'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php get_footer(); ?>