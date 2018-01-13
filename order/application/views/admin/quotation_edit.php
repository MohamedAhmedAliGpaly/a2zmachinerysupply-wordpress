<div class="container user-content-wrapper">
    <div class="row">

        <div class="col-md-12">
            <?php echo form_open('admin_controller/update_quotation'); ?>
            <input type="hidden" name="quotation_id" value="<?php echo $quotation->quotation_id; ?>">
            <fieldset>
                <legend>Quotation Edit
                    <a target="_blank" href="<?php echo site_url('admin_controller/add_another_item/'.$quotation->quotation_id) ?>" class="btn btn-warning pull-right">Add Another Item</a>
                    <a class="btn btn-success pull-right" target="_blank" href="<?php echo site_url('admin_controller/print_invoice/'.$quotation->quotation_id); ?>">Print Invoice</a>
                    <a class="btn btn-info pull-right" target="_blank" href="<?php echo site_url('admin_controller/print_sample/'.$quotation->quotation_id); ?>">Print Sample</a>
                </legend>
                <table class="table table-bordered">
                    <caption>
                        Quotation Details
                    </caption>
                    <tbody>
                    <tr>
                        <th style="width: 220px;">Quotation Id:</th>
                        <td><?php echo $quotation->quotation_id; ?></td>
                        <th style="width: 220px;">Date Created:</th>
                        <td><?php echo $quotation->created_at; ?></td>
                    </tr>
                    <tr>
                        <th>Name:</th>
                        <td><?php echo $quotation->name; ?></td>
                        <th>Email:</th>
                        <td><?php echo $quotation->email; ?></td>
                    </tr>
                    <tr>
                        <th>Phone:</th>
                        <td><?php echo $quotation->phone; ?></td>
                        <th>Mobile:</th>
                        <td><?php echo $quotation->mobile; ?></td>
                    </tr>
                    <tr>
                        <th>Total Expected Amount:</th>
                        <td class="currency"><?php echo $quotation->total_expected_price; ?></td>
                        <th>Total Quoted Amount:</th>
                        <td class="currency"><?php echo $quotation->total_quoted_price; ?></td>
                    </tr>
                    </tbody>
                </table>


                <table class="table">
                    <caption>Quotation Item List</caption>
                    <thead>
                    <tr>
                        <th>S/L</th>
                        <th>Product Description</th>
                        <th>Quantity Unit</th>
                        <th>Expected Price</th>
                        <th>Quoted Price</th>
                        <th>#</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=1;
                    foreach($quotation_detail_list->result() as $quotation_detail){ ?>
                        <input type="hidden" name="quotation_detail_id[]" value="<?php echo $quotation_detail->quotation_detail_id; ?>">
                        <tr class="tr-<?php echo $quotation_detail->quotation_detail_id; ?>">
                            <td class="text-center"><?php echo $i++; ?></td>
                            <td style="width: 45%;"><input type="text" name="product_description[]" value="<?php echo $quotation_detail->product_description; ?>" class="form-control"></td>
                            <td><input type="text" name="quantity_unit[]" value="<?php echo $quotation_detail->quantity_unit; ?>" class="form-control text-center "></td>
                            <td><input type="text" name="expected_price[]" value="<?php echo $quotation_detail->expected_price; ?>" readonly="" class="form-control text-right"></td>
                            <td><input type="text" name="quoted_price[]" value="<?php echo $quotation_detail->quoted_price; ?>" class="form-control text-right"></td>
                            <td>
                                <a onclick="ajax_delete_quotation_detail_item(<?php echo $quotation_detail->quotation_detail_id; ?>);" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></a>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="6"><input type="submit" value="Update Quotation" class="btn btn-warning btn-block"></td>
                    </tr>
                    </tfoot>
                </table>
            </fieldset>


        </div>
    </div>
</div>
<!--#user-content-wrapper-->