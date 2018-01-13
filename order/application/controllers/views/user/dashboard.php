<div class="container">
    <div class="row">


        <?php if($user->company_name == "Undefined" OR $user->company_address == "Undefined" OR $user->web_url == "Undefined" OR $user->phone == "Undefined" OR $user->mobile == "Undefined" OR $user->name == "Undefined"){?>
            <div class="col-md-12">
                <div class="alert alert-danger" role="alert"><strong>Attention!</strong> Please complete your profile information. <a href="<?php echo site_url('user_controller/my_profile'); ?>">My Profile</a> </div>
            </div>
        <?php } ?>


        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Total Processing</h3>
                        </div>
                        <div class="panel-body text-center">
                            <span class=" badge"><?php echo ($quotation_processing > 0)?$quotation_processing:0; ?></span>
                        </div>
                    </div>
                </div>


                <div class="col-md-4">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title">Total Quoted</h3>
                        </div>
                        <div class="panel-body text-center">
                            <span class=" badge"><?php echo ($quotation_quoted > 0)?$quotation_quoted:0; ?></span>
                        </div>
                    </div>
                </div>


                <div class="col-md-4">
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            <h3 class="panel-title">Total Pending</h3>
                        </div>
                        <div class="panel-body text-center">
                            <span class=" badge"><?php echo ($quotation_pending > 0)?$quotation_pending:0; ?></span>
                        </div>
                    </div>
                </div>


                <div class="col-md-4">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <h3 class="panel-title">Total Completed</h3>
                        </div>
                        <div class="panel-body text-center">
                            <span class=" badge"><?php echo ($quotation_completed > 0)?$quotation_completed:0; ?></span>
                        </div>
                    </div>
                </div>


                <div class="col-md-4">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <h3 class="panel-title">Total Canceled</h3>
                        </div>
                        <div class="panel-body text-center">
                            <span class=" badge"><?php echo ($quotation_canceled > 0)?$quotation_canceled:0; ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <table class="table table-bordered">
                <caption>
                    Details of Your Profile
                </caption>
                <tbody>
                <tr>
                    <th>Name:</th>
                    <td><?php echo $user->name; ?></td>
                    <th>Company Name:</th>
                    <td><?php echo $user->company_name; ?></td>
                </tr>
                <tr>
                    <th>Address:</th>
                    <td colspan="3"><?php echo $user->company_address; ?></td>
                </tr>
                <tr>
                    <th>Phone:</th>
                    <td><?php echo $user->phone; ?></td>
                    <th>Mobile:</th>
                    <td><?php echo $user->mobile; ?></td>
                </tr>
                <tr>
                    <th>Email:</th>
                    <td><?php echo $user->email; ?></td>
                    <th>Web Url:</th>
                    <td><?php echo $user->web_url; ?></td>
                </tr>
                </tbody>
            </table>
        </div>

        <div class="col-md-12">
            <table class="table table-bordered table-sorted">
                <caption>Latest 5 Quotations </caption>
                <thead>
                <tr>
                    <th>Q. ID</th>
                    <th>Date</th>
                    <th>Company Name</th>
                    <th>Expected Total</th>
                    <th>Quoted Total</th>
                    <th>Status</th>
                    <th>#</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $i = 1;
                foreach ($quotation_list->result() as $quotation) {
                    ?>

                    <?php
                    if($quotation->status == 'processing'){
                        echo '<tr class="tr-'.$quotation->quotation_id.'">';
                    }elseif($quotation->status == 'quoted'){
                        echo '<tr class="bg-info tr-'.$quotation->quotation_id.'">';
                    }elseif($quotation->status == 'pending'){
                        echo '<tr class="bg-warning tr-'.$quotation->quotation_id.'">';
                    }elseif($quotation->status == 'completed'){
                        echo '<tr class="bg-success tr-'.$quotation->quotation_id.'">';
                    }elseif($quotation->status == 'canceled'){
                        echo '<tr class="bg-danger tr-'.$quotation->quotation_id.'">';
                    }
                    ?>
                        <td style="width: 80px; text-align: center; class="text-center"><?php echo $quotation->quotation_id; ?></td>
                        <td><?php echo $quotation->created_at; ?></td>
                        <td><?php echo $quotation->company_name; ?></td>
                        <td class="currency text-right"><?php echo ($quotation->total_expected_price)?$quotation->total_expected_price:'0'; ?></td>
                        <td class="currency text-right"><?php echo ($quotation->total_quoted_price)?$quotation->total_quoted_price:'0'; ?></td>
                        <td class="text-center"><?php echo ucfirst($quotation->status); ?></td>
                        <td style="width: 110px;" class="text-center">
                            <div class="dropdown">
                            <button class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                Controllers
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                <li><a target="_blank" href="<?php echo site_url('user_controller/redirect_quotation_edit/'.$quotation->quotation_id); ?>">Edit</a></li>
<!--                                <li role="separator" class="divider"></li>-->
<!--                                <li><a href="--><?php //echo site_url('user_controller/processing/'.$quotation->quotation_id); ?><!--">Processing</a></li>-->
<!--                                <li role="separator" class="divider"></li>-->
<!--                                <li><a href="#" oncontextmenu="return false" onclick="ajax_canceled_quotation(<?php //echo $quotation->quotation_id; ?>//);">Canceled</a></li>-->
                                <li role="separator" class="divider"></li>
                                <li><a target="_blank" href="<?php echo site_url('user_controller/print_invoice/'.$quotation->quotation_id); ?>">Print Invoice</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a target="_blank" href="<?php echo site_url('user_controller/print_sample/'.$quotation->quotation_id); ?>">Print Sample</a></li>
                            </ul>
                        </div></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>

    </div>
</div>