<div class="container user-content-wrapper">
    <div class="row">

        <div class="col-md-12">

            <?php echo form_open('admin_controller/search_quotation_item'); ?>
            <table class="table table-condensed">
                <caption>Search Keyword</caption>
                <tbody>
                <tr>
                    <td><input type="text" name="quotation_id" placeholder="Quotation ID" value="<?php echo ($this->input->post('quotation_id'))?$this->input->post('quotation_id'):NULL; ?>" class="form-control"></td>
                    <td><input type="text" name="created_at" placeholder="Date" value="<?php echo ($this->input->post('created_at'))?$this->input->post('created_at'):NULL; ?>" class="form-control"></td>
                    <td><input type="text" name="name" placeholder="Name" value="<?php echo ($this->input->post('name'))?$this->input->post('name'):NULL; ?>" class="form-control"></td>
                    <td><input type="text" name="company_name" placeholder="Company Name" value="<?php echo ($this->input->post('company_name'))?$this->input->post('company_name'):NULL; ?>" class="form-control"></td>
                </tr>
                <tr>
                    <td><input type="text" name="company_address" placeholder="Company Address" value="<?php echo ($this->input->post('company_address'))?$this->input->post('company_address'):NULL; ?>" class="form-control"></td>
                    <td><input type="text" name="phone" placeholder="Phone" value="<?php echo ($this->input->post('phone'))?$this->input->post('phone'):NULL; ?>" class="form-control"></td>
                    <td><input type="text" name="mobile" placeholder="Mobile" value="<?php echo ($this->input->post('mobile'))?$this->input->post('mobile'):NULL; ?>" class="form-control"></td>
                    <td><input type="text" name="email" placeholder="E-mail" value="<?php echo ($this->input->post('email'))?$this->input->post('email'):NULL; ?>" class="form-control"></td>
                </tr>
                <tr>
                    <td><input type="text" name="web_url" placeholder="Web URL" value="<?php echo ($this->input->post('web_url'))?$this->input->post('web_url'):NULL; ?>" class="form-control"></td>
                    <td><input type="text" name="product_description" placeholder="Item Description" value="<?php echo ($this->input->post('product_description'))?$this->input->post('product_description'):NULL; ?>" class="form-control"></td>
                    <td><input type="text" name="expected_price" placeholder="Expected Price" value="<?php echo ($this->input->post('expected_price'))?$this->input->post('expected_price'):NULL; ?>" class="form-control"></td>
                    <td><input type="text" name="quoted_price" placeholder="Quoted Price" value="<?php echo ($this->input->post('quoted_price'))?$this->input->post('quoted_price'):NULL; ?>" class="form-control"></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="text" name="status" placeholder="Status" value="<?php echo ($this->input->post('status'))?$this->input->post('status'):NULL; ?>" class="form-control">
                    </td>

                    <td colspan="2">
                        <input type="submit" name="" value="Find" class="btn btn-warning btn-block">
                    </td>
                </tr>
                </tbody>
            </table>
            <?php echo form_close(); ?>


            <table class="table table-bordered table-sorted">
                <caption>Quotations Item List</caption>
                <thead>
                <tr>
                    <th>Q. ID</th>
                    <th>Date</th>
                    <th>Product Description</th>
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
                                <li><a href="<?php echo site_url('admin_controller/redirect_quotation_edit/'.$quotation->quotation_id) ?>">Edit</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="#">Print Quotation</a></li>
                            </ul>
                        </div>
                        </td>
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