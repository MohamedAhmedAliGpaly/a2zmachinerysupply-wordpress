/**
 * Created by Masud on 30/04/2016.
 */

$(document).ready(function(){



    // #.Redirect form
    $(function () {
        $('.redirect-form').submit();
    });


    // #.Currency
    $('.currency').currency({
        region: 'BDT',
        thousands: ',',
        decimal: '.',
        decimals: 2
    });


    $(".table-sorted").tablesorter({
        /*sortList: [[0, 0]],
         widgets: ['zebra']*/
    });


});


// #.Ajax delete user
function ajax_delete_user(user_id) {
    var c = confirm("Are you sure?");

    if (c === true) {
        $.ajax({
            type: 'get',
            url: 'ajax_delete_user',
            data: {
                user_id : user_id
            },
            success: function (response) {
                if(response === 'deleted'){
                    $('.tr-' + user_id).hide('slow');
                }
            }
        });
    }
}


// #.Ajax trash quotation
function ajax_trash_quotation(quotation_id) {
    var c = confirm("Are you sure?");

    if (c === true) {
        $.ajax({
            type: 'get',
            url: 'ajax_trash_quotation',
            data: {
                quotation_id : quotation_id
            },
            success: function (response) {
                if(response === 'deleted'){
                    $('.tr-' + quotation_id).hide('slow');
                }
            }
        });
    }
}


// #.Redirect form
$(function () {
    $('.redirect-form').submit();
});



// #.Ajax delete quotation detail item
function ajax_delete_quotation_detail_item(quotation_detail_id) {

    var c = confirm("Are you sure?");

    if (c === true) {
        $.ajax({
            type: 'get',
            url: 'ajax_delete_quotation_detail_item',
            data: {
                quotation_detail_id : quotation_detail_id
            },
            success: function (response) {
                if(response === 'deleted'){
                    $('.tr-' + quotation_detail_id).hide('slow');
                }
            }
        });
    }
}


// #.Ajax delete category
function ajax_delete_category(category_id) {
    var c = confirm("Are you sure?");

    if (c === true) {
        $.ajax({
            type: 'get',
            url: 'ajax_delete_category',
            data: {
                category_id : category_id
            },
            success: function (response) {
                if(response === 'deleted'){
                $('.tr-' + category_id).hide('slow');
                }
            }
        });
    }
}


// #.Ajax delete product
function ajax_delete_product(product_id) {
    var c = confirm("Are you sure?");

    if (c === true) {
        $.ajax({
            type: 'get',
            url: 'ajax_delete_product',
            data: {
                product_id : product_id
            },
            success: function (response) {
                if(response === 'deleted'){
                    $('.tr-' + product_id).hide('slow');
                }
            }
        });
    }
}



// #.Ajax cancelled quotation
function ajax_canceled_quotation(quotation_id) {
    var c = confirm("Are you sure?");

    if (c === true) {
        $.ajax({
            type: 'get',
            url: 'ajax_canceled_quotation',
            data: {
                quotation_id : quotation_id
            },
            success: function (response) {
                if(response === 'canceled'){
                    $('.tr-' + quotation_id).hide('slow');
                }
            }
        });
    }
}

// #.Ajax cancelled quotation
function ajax_quotation_details_item_delete(quotation_detail_id) {
    var c = confirm("Are you sure?");

    if (c === true) {
        $.ajax({
            type: 'get',
            url: 'ajax_quotation_details_item_delete/',
            data: {
                quotation_detail_id : quotation_detail_id
            },
            success: function (response) {
                if(response === 'deleted'){
                    $('.tr-' + quotation_detail_id).hide('slow');
                }
            }
        });
    }
}