<div class="container user-content-wrapper">
    <div class="row">


        <div class="col-md-12">
            <fieldset>
            <?php echo form_open('admin_controller/save_quotation'); ?>
            <?php
            if(!empty($success)){
                echo '<div class="alert alert-info" role="alert"><strong>Heads up! </strong>'.$success.'</div>';
            }
            ?>
                <legend>Create New Quotation
                    <a class="btn btn-info pull-right" target="_blank" href="<?php echo site_url('user_controller/print_invoice/'.$quotation_id); ?>">Print Invoice</a>
                    <a class="btn btn-success pull-right" target="_blank" href="<?php echo site_url('user_controller/print_sample/'.$quotation_id); ?>">Print Sample</a>
                </legend>
                <table class="table" style="margin-bottom: 0px;">
                    <tbody>
                    <tr>
                        <td style="width: 25%;">
                            <label>Quotation Id:</label>  <span class="text-danger">(Auto)</span>
                            <input typeof="text" name="quotation_id" readonly="" required="" value="<?php echo (isset($quotation_id)?$quotation_id:1); ?>" class="form-control">
                        </td>
                        <td style="width: 40%;">
                            <label>Date Created:</label>  <span class="text-danger">(Auto)</span>
                            <input typeof="text" name="created_at" readonly="" value="<?php echo DATETIMENOW(); ?>" class="form-control">
                        </td>
                        <td></td>
                    </tr>
                    </tbody>
                </table>



                <table class="table">
                    <tbody>
                    <tr>
                        <td colspan="2">
                            <label>Item Description: </label> <span class="text-danger">(Required)</span>
                            <input type="text" name="product_description" required="" class="form-control" autofocus="" title="Enter your item description what you need.">
<!--                            <p class="text-muted">Enter your product details accordingly your </p>-->
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Quantity: </label> <span class="text-danger">(Required)</span>
                            <input type="text" name="quantity_unit" required="" class="form-control" title="How many quantity you need to buy.">
<!--                            <p class="text-muted">Enter the quantity you need</p>-->
                        </td>

                        <td>
                            <label>Expected Price:</label> <span class="text-success">(Not Required)</span>
                            <input type="text" name="expected_price" class="form-control" title="Which price you want to pay for this product.">
<!--                            <p class="text-muted">Enter your desired price</p>-->
                        </td>
                    </tr>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="3"><input type="submit" class="btn btn-warning btn-block" value="Add Item" </td>
                    </tr>
                    </tfoot>
                </table>
                <?php echo form_close(); ?>
            </fieldset>


            <table class="table table-striped table-bordered table-hover table-sorted">
                <caption>Description of Items</caption>
                <thead>
                <tr>
                    <th>S/L</th>
                    <th>Item Description</th>
                    <th>Quantity Unit</th>
                    <th>Expected Price</th>
                    <th>Expected Total</th>
                    <th>#</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $i = 1;
                foreach ($quotation_list->result() as $quotation) {
                    ?>
                    <tr class="tr-<?php echo $quotation->quotation_detail_id; ?>">
                        <td style="width: 50px; text-align: center;"><?php echo $i++; ?></td>
                        <td><?php echo $quotation->product_description; ?></td>
                        <td class="text-right"><?php echo $quotation->quantity_unit; ?></td>
                        <td class="currency text-right"><?php echo $quotation->expected_price; ?></td>
                        <td class="currency text-right"><?php echo ($quotation->quantity_unit * $quotation->expected_price); ?></td>
                        <td style="width: 100px;" class="text-center">
                            <a oncontextmenu="return false" class="btn btn-danger" onclick="ajax_quotation_details_item_delete(<?php echo $quotation->quotation_detail_id; ?>);">Delete Item</a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>




        </div>
    </div>
</div>
<!--#user-content-wrapper-->