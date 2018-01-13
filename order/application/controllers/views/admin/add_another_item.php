<div class="container user-content-wrapper">
    <div class="row">

        <div class="col-md-12">
            <?php echo form_open('admin_controller/save_quotation'); ?>
            <?php
            if(!empty($success)){
                echo '<div class="alert alert-info" role="alert"><strong>Heads up! </strong>'.$success.'</div>';
            }
            ?>
            <fieldset>
                <legend>Add Another Item </legend>
                <table class="table" style="margin-bottom: 0px;">
                    <tbody>
                    <tr>
                        <td style="width: 15%;">
                            <label>Quotation Id:</label> <span class="text-danger">(Auto)</span>
                            <input typeof="text" name="quotation_id" readonly="" required="" value="<?php echo (isset($quotation_id)?$quotation_id:1); ?>" class="form-control">
                        </td>
                        <td style="width: 25%;">
                            <label>Date Created:</label> <span class="text-danger">(Auto)</span>
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
                            <input type="text" name="product_description" required="" placeholder="Example: 6202 ZZ NTN JAPAN BALL BEARING" class="form-control" autofocus="">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Quantity Unit: </label> <span class="text-danger">(Required)</span>
                            <input type="text" name="quantity_unit" placeholder="12" required="" class="form-control">
                        </td>

                        <td>
                            <label>Expected Price:</label> <span class="text-success">(Not Required)</span>
                            <input type="text" name="expected_price" placeholder="150" class="form-control">
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


        </div>
    </div>
</div>
<!--#user-content-wrapper-->