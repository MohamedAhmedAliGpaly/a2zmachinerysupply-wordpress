<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo isset($title)?$title:'Undefined Title'; ?></title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url('css/reset.css'); ?>" rel="stylesheet" media="all">
    <link href="<?php echo base_url('css/bootstrap.css'); ?>" rel="stylesheet" media="all">
    <link href="<?php echo base_url('css/bootstrap-theme.min.css'); ?>" rel="stylesheet" media="all">
    <link href="<?php //echo base_url('css/theme/slate.css'); ?>" rel="stylesheet" media="all">
    <link href="<?php //echo base_url('css/non-responsive.css'); ?>" rel="stylesheet" media="all">
    <link href="<?php echo base_url('css/admin-side-navigation.css'); ?>" rel="stylesheet" media="all">
    <link href="<?php echo base_url('css/font-awesome.css'); ?>" rel="stylesheet" media="all">
    <link href="<?php echo base_url('css/jquery-ui.css'); ?>" rel="stylesheet" media="all">
    <link href="<?php echo base_url('css/table-sorter.css'); ?>" rel="stylesheet" media="all">
    <link href="<?php echo base_url('css/style.css'); ?>" rel="stylesheet" media="all">

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
        body, html{
            background: #FFFFFF;
            color: #000000;
        /*font-family: "Helvetica Neue",arial,sans;*/
            line-height: 21px;
        }

        p{
            margin: 0;
            padding: 0 0 2px 0;
        }

        .table th{
            font-weight: 700;
            color: inherit;
        }

    </style>

</head>
<body>

<div style="width: 8.27in; padding: 22px;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-6">
                <h3 class="text-uppercase" style="font-weight: 700;">A2Z Machinery Supply</h3>
                <p>43/44 Nawabpur Road, Shewly Market, <br>Dhaka: 1100, Bangladesh.</p>
                <br>
                <p>02-9588952</p>
                <p>+88-01676717945</p>
                <p>masudrk2015@gmail.com</p>
                <p>www.a2zmachinerysupply.com</p>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                <h1 style="font-weight: 700;">INVOICE</h1>
                <p><?php echo date('d-F-Y', strtotime($quotation_list->created_at)); ?></p>
                <p>Invoice #<?php echo $quotation_list->quotation_id; ?></p>
                <br>
                <p style="font-weight: 700;"><?php echo 'Att: '. $quotation_list->name; ?></p>
                <p  style="font-weight: 700;"><?php echo $quotation_list->company_name; ?></p>
                <p><?php echo $quotation_list->company_address; ?></p>
            </div>


            <div class="col-md-12">
                <table class="table table-bordered table-striped table-condensed" style="margin-top: 30px;">
                    <thead>
                    <tr>
                        <th style="width: 45px;">#</th>
                        <th>Item Description</th>
                        <th>Quantity</th>
                        <th>Unit Price ($)</th>
                        <th>Total ($)</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php
                    $i=1;
                    $quotation_total = 0;
                    $total_qty = 0;
                    foreach($quotation_item_list->result() as $quotation_item){
                        $quotation_total += ($quotation_item->quantity_unit * $quotation_item->quoted_price);
                        $total_qty += $quotation_item->quantity_unit;
                        ?>

                        <tr>
                            <td class="text-center"><?php echo $i++; ?></td>
                            <td><?php echo $quotation_item->product_description; ?></td>
                            <td class="text-right" style="width: 12%;"><?php echo $quotation_item->quantity_unit; ?></td>
                            <td class="text-right currency" style="width: 16%;"><?php echo $quotation_item->quoted_price; ?></td>
                            <td class="text-right currency" style="width: 16%;"><?php echo ($quotation_item->quantity_unit * $quotation_item->quoted_price); ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>

                    <tfoot>
                    <tr>
                        <td colspan="7" style="height: 5px;"></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="font-weight: 700;">Total</td>
                        <td class="text-right" style="font-weight: 700;"><?php echo $total_qty; ?></td>
                        <td></td>
                        <td class="text-right currency" style="font-weight: 700;"><?php echo $quotation_total; ?></td>
                    </tr>
                    </tfoot>
                </table>

                <p class="text-center"><span style="font-weight: bold;">In word:</span> <?php echo convert_number_to_words($quotation_total).'.'; ?></p>
                <p></p>
                <p class="text-center">Many thanks for your quotation. I look forward to doing business with you again.</p>

                <br>
                <br>
                <p class="pull-right" style="border-top: 1px solid">
                    Authorized Signature
                </p>

                <p class="pull-left" style="border-top: 1px solid">
                    Received Signature
                </p>
            </div>

        </div>
    </div>
</div>



</body>
</html>