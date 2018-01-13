<div class="container user-content-wrapper">
    <div class="row">


        <div class="col-md-12">

            <?php echo form_open('user_controller/search_quotation_item'); ?>
            <table class="table table-condensed">
                <caption>Search Keyword</caption>
                <tbody>
                <tr>
                    <td><input type="text" name="quotation_id" placeholder="Quotation ID" value="<?php echo ($this->input->post('quotation_id'))?$this->input->post('quotation_id'):NULL; ?>" class="form-control"></td>
                    <td><input type="text" name="created_at" placeholder="Date" value="<?php echo ($this->input->post('created_at'))?$this->input->post('created_at'):NULL; ?>" class="form-control"></td>
                    <td><input type="text" name="product_description" placeholder="Item Description" value="<?php echo ($this->input->post('product_description'))?$this->input->post('product_description'):NULL; ?>" class="form-control"></td>
                </tr>
                <tr>
                    <td><input type="text" name="expected_price" placeholder="Expected Price" value="<?php echo ($this->input->post('expected_price'))?$this->input->post('expected_price'):NULL; ?>" class="form-control"></td>
                    <td><input type="text" name="quoted_price" placeholder="Quoted Price" value="<?php echo ($this->input->post('quoted_price'))?$this->input->post('quoted_price'):NULL; ?>" class="form-control"></td>
                    <td><input type="text" name="status" placeholder="Status" value="<?php echo ($this->input->post('status'))?$this->input->post('status'):NULL; ?>" class="form-control"></td>
                </tr>
                <tr>
                    <td colspan="3">
                        <input type="submit" name="" value="Find" class="btn btn-warning btn-block">
                    </td>
                </tr>
                </tbody>
            </table>
            <?php echo form_close(); ?>


            <table class="table table-bordered table-sorted">
                <caption>All Quotation Items</caption>
                <thead>
                <tr>
                    <th>Q. ID</th>
                    <th>Date</th>
                    <th>Item Description</th>
                    <th>Quantity</th>
                    <th>Expected Price</th>
                    <th>Quoted Price</th>
                    <th>#</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $i = 1;
                foreach ($quotation_item_list->result() as $quotation) {
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
                        <td style="width: 80px; text-align: center;"><?php echo $quotation->quotation_id; ?></td>
                        <td><?php echo $quotation->created_at; ?></td>
                        <td><?php echo $quotation->product_description; ?></td>
                        <td class="text-center"><?php echo $quotation->quantity_unit; ?></td>
                        <td class="currency text-right"><?php echo $quotation->expected_price; ?></td>
                        <td class="currency text-right"><?php echo $quotation->quoted_price; ?></td>
                        <td style="width: 110px;" class="text-center">
                            <div class="dropdown">
                            <button class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                Controllers
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                <li><a target="_blank" href="<?php echo site_url('user_controller/redirect_quotation_edit/'.$quotation->quotation_id) ?>">Edit</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a target="_blank" href="<?php echo site_url('user_controller/print_invoice/'.$quotation->quotation_id); ?>">Print Invoice</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a target="_blank" href="<?php echo site_url('user_controller/print_sample/'.$quotation->quotation_id); ?>">Print Sample</a></li>
                            </ul>
                        </div>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="6"><?php echo $this->pagination->create_links(); ?></td>
                </tr>
                </tfoot>
            </table>




        </div>
    </div>
</div>
<!--#user-content-wrapper-->