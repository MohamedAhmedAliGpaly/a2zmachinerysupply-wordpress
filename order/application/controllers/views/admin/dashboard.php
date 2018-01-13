<div class="container  admin-content-wrapper">
    <div class="row">


        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            <h3 class="panel-title">Total Quotations</h3>
                        </div>
                        <div class="panel-body text-center">
                            <span class=" badge"><?php echo $quotation_query->num_rows(); ?></span>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title">Total Users</h3>
                        </div>
                        <div class="panel-body text-center">
                            <span class=" badge"><?php echo $user_query->num_rows(); ?></span>
                        </div>
                    </div>
                </div>
            </div>
            </div>


            <div class="col-md-12">
                <table class="table table-bordered table-sorted">
                    <caption>Latest 25 Quotations</caption>
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
                            ?>
                            <tr>
                        <?php }
                        elseif($quotation->status == 'completed'){
                            ?>
                            <tr class="bg-success">
                        <?php }
                        elseif($quotation->status == 'quoted'){
                            ?>
                            <tr class="bg-info">
                        <?php }
                        elseif($quotation->status == 'pending'){
                            ?>
                            <tr class="bg-warning">
                        <?php }
                        elseif($quotation->status == 'canceled'){
                            ?>
                            <tr class="bg-danger">
                        <?php
                        }
                        ?>
                        <td class="text-center" style="width: 80px;" title="User ID :: <?php echo $quotation->user_id; ?>, Name :: <?php echo $quotation->name; ?>, E-mail :: <?php echo $quotation->email; ?>, Phone:: <?php echo $quotation->phone; ?> | MOBILE :: <?php echo $quotation->mobile; ?>"><?php echo $quotation->quotation_id; ?></td>
                        <td><?php echo $quotation->created_at; ?></td>
                        <td><?php echo $quotation->company_name; ?></td>
                        <td class="currency text-right"><?php echo ($quotation->total_expected_price)?$quotation->total_expected_price:'0'; ?></td>
                        <td class="currency text-right"><?php echo ($quotation->total_quoted_price)?$quotation->total_quoted_price:'0'; ?></td>
                        <td class="text-center"><?php echo ucfirst($quotation->status); ?></td>
                        <td style="width: 100px;" class="text-center">
                            <div class="dropdown">
                                <button class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    Controllers
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                    <li><a target="_blank" href="<?php echo site_url('admin_controller/redirect_quotation_edit/'.$quotation->quotation_id) ?>">Edit</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="<?php echo site_url('admin_controller/processing/'.$quotation->quotation_id) ?>">Processing</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="<?php echo site_url('admin_controller/quoted/'.$quotation->quotation_id) ?>">Quoted</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="<?php echo site_url('admin_controller/pending/'.$quotation->quotation_id) ?>">Pending</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="<?php echo site_url('admin_controller/completed/'.$quotation->quotation_id) ?>">Completed</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="<?php echo site_url('admin_controller/canceled/'.$quotation->quotation_id) ?>">Canceled</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a target="_blank" href="<?php echo site_url('admin_controller/print_invoice/'.$quotation->quotation_id) ?>">Print Invoice</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a target="_blank" href="<?php echo site_url('admin_controller/print_sample/'.$quotation->quotation_id) ?>">Print Sample</a></li>
                                </ul>
                            </div>
                        </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>