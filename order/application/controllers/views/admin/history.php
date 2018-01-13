<div class="container user-content-wrapper">
    <div class="row">

        <div class="col-md-12">

            <?php echo form_open('admin_controller/search_history_list'); ?>
            <table class="table table-condensed">
                <caption>Search Keyword</caption>
                <tbody>
                <tr>
                    <td><input type="text" name="created_at" placeholder="Date" value="<?php echo ($this->input->post('created_at'))?$this->input->post('created_at'):NULL; ?>" class="form-control"></td>
                    <td><input type="text" name="reason" placeholder="Reason" value="<?php echo ($this->input->post('reason'))?$this->input->post('reason'):NULL; ?>" class="form-control"></td>
                    <td><input type="text" name="quotation_id" placeholder="Quotation ID" value="<?php echo ($this->input->post('quotation_id'))?$this->input->post('quotation_id'):NULL; ?>" class="form-control"></td>
                    <td><input type="text" name="company_name" placeholder="Company Name" value="<?php echo ($this->input->post('company_name'))?$this->input->post('company_name'):NULL; ?>" class="form-control"></td>
                    <td><input type="text" name="user_id" placeholder="User ID" value="<?php echo ($this->input->post('user_id'))?$this->input->post('user_id'):NULL; ?>" class="form-control"></td>
                </tr>
                <tr>
                    <td><input type="text" name="company_address" placeholder="Company Address" value="<?php echo ($this->input->post('company_address'))?$this->input->post('company_address'):NULL; ?>" class="form-control"></td>
                    <td><input type="text" name="phone" placeholder="Phone" value="<?php echo ($this->input->post('phone'))?$this->input->post('phone'):NULL; ?>" class="form-control"></td>
                    <td><input type="text" name="mobile" placeholder="Mobile" value="<?php echo ($this->input->post('mobile'))?$this->input->post('mobile'):NULL; ?>" class="form-control"></td>
                    <td><input type="text" name="email" placeholder="E-mail" value="<?php echo ($this->input->post('email'))?$this->input->post('email'):NULL; ?>" class="form-control"></td>
                    <td><input type="text" name="web_url" placeholder="Web URL" value="<?php echo ($this->input->post('web_url'))?$this->input->post('web_url'):NULL; ?>" class="form-control"></td>
                </tr>
                <tr>
                    <td><input type="text" name="product_description" placeholder="Item Description" value="<?php echo ($this->input->post('product_description'))?$this->input->post('product_description'):NULL; ?>" class="form-control"></td>
                    <td><input type="text" name="quantity_unit" placeholder="Quantity Unit" value="<?php echo ($this->input->post('company_name'))?$this->input->post('company_name'):NULL; ?>" class="form-control"></td>
                    <td><input type="text" name="expected_price" placeholder="Expected Price" value="<?php echo ($this->input->post('expected_price'))?$this->input->post('expected_price'):NULL; ?>" class="form-control"></td>
                    <td><input type="text" name="quoted_price" placeholder="Quoted Price" value="<?php echo ($this->input->post('quoted_price'))?$this->input->post('quoted_price'):NULL; ?>" class="form-control"></td>
                    <td colspan="2">
                        <input type="submit" name="" value="Find" class="btn btn-warning btn-block">
                    </td>
                </tr>
                </tbody>
            </table>
            <?php echo form_close(); ?>


            <table class="table table-bordered table-sorted">
                <caption>History Item</caption>
                <thead>
                <tr>
                    <th>Date</th>
                    <th>Reason</th>
                    <th>Company Name</th>
                    <th>Product Description</th>
                    <th>Qty.</th>
                    <th>Ex. Price</th>
                    <th>Qu. Price</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $i = 1;
                foreach ($history_list->result() as $history) {
                    ?>

                    <tr>
                        <td><?php echo $history->created_at; ?></td>
                        <td><?php echo $history->reason.' - '.$history->quotation_id; ?></td>
                        <td><?php echo $history->company_name.' - '.$history->user_id; ?></td>
                        <td><?php echo $history->product_description; ?></td>
                        <td class="text-center"><?php echo $history->quantity_unit; ?></td>
                        <td class="currency text-right"><?php echo $history->expected_price; ?></td>
                        <td class="currency text-right"><?php echo $history->quoted_price; ?></td>
                    </tr>
                <?php } ?>
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="7"><?php echo $this->pagination->create_links(); ?></td>
                </tr>
                </tfoot>
            </table>




        </div>
    </div>
</div>
<!--#user-content-wrapper-->