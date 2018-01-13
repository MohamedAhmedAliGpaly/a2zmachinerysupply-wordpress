/**
 * Created by Masud on 06-Aug-16.
 */

$(document).ready(function(){

    $('.carousel').carousel();

	

    $('.flexslider').flexslider({
        animation: "slide",
        animationLoop: false,
        itemWidth: 150,
        itemMargin: 15,
        minItems: 2,
        maxItems: 15,
        controlNav: false,
        start: function(slider){
            $('body').removeClass('loading');
        }
    });



    $('.newsletter-email').val('Enter your e-mail');



    $('.left-sidebar .newsletter input[type="email"]').addClass('form-control');
    $('.left-sidebar .newsletter input[type="submit"]').addClass('btn');

    $('.left-sidebar .searchform input[type="text"]').addClass('form-control');
    $('.left-sidebar .searchform input[type="text"]').attr('placeholder', 'Enter product keyword');
    $('.left-sidebar .searchform input[type="submit"]').addClass('btn');

    $('.left-sidebar .calendar_wrap table').addClass('table table-bordered table-striped');




    $('.feedback-form-wrapper input[name="your-name"]').attr('placeholder', 'Enter your full name');
    $('.feedback-form-wrapper input[name="your-name"]').addClass('form-control');

    $('.feedback-form-wrapper input[name="your-email"]').attr('placeholder', 'Enter your valid e-mail');
    $('.feedback-form-wrapper input[name="your-email"]').addClass('form-control');

    $('.feedback-form-wrapper input[name="your-company-name"]').attr('placeholder', 'Enter your company name');
    $('.feedback-form-wrapper input[name="your-company-name"]').addClass('form-control');

    $('.feedback-form-wrapper input[name="your-phone-number"]').attr('placeholder', 'Enter your phone number');
    $('.feedback-form-wrapper input[name="your-phone-number"]').addClass('form-control');

    $('.feedback-form-wrapper input[name="your-subject"]').attr('placeholder', 'Enter your desire subject');
    $('.feedback-form-wrapper input[name="your-subject"]').addClass('form-control');

    $('.feedback-form-wrapper textarea').attr('placeholder', 'Enter your valuable message');
    $('.feedback-form-wrapper textarea').addClass('form-control');

    $('.feedback-form-wrapper input[type="submit"]').addClass('btn');
    $('.feedback-form-wrapper input[type="submit"]').attr('value', 'SEND QUERY');



});