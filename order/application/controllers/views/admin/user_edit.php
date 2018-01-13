<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <?php echo form_open('admin_controller/update_user'); ?>
            <input type="hidden" value="<?php echo $user->user_id; ?>" name="user_id">
            <?php
            if(!empty($success)){
                echo '<div class="alert alert-info" role="alert"><strong>Heads up! </strong> User information updated successfully.</div>';
            }
            ?>
            <fieldset>
                <legend>My Profile</legend>
                <table class="table">
                    <tbody>
                    <tr>
                        <td colspan="2">
                            <label>Company Name:</label>
                            <input type="text" value="<?php echo $user->company_name; ?>" name="company_name" class="form-control">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <label>Company Address:</label>
                            <textArea name="company_address" class="form-control" style="height: 75px;"><?php echo $user->company_address; ?></textArea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Name:</label>
                            <input type="text" value="<?php echo $user->name; ?>" name="name" class="form-control">
                        </td>
                        <td>
                            <label>Email:</label>
                            <input type="text" value="<?php echo $user->email; ?>" name="email" class="form-control">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Phone:</label>
                            <input type="text" value="<?php echo $user->phone; ?>" name="phone" class="form-control">
                        </td>
                        <td>
                            <label>Mobile:</label>
                            <input type="text" value="<?php echo $user->mobile; ?>" name="mobile" class="form-control">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <label>Company Web Url:</label>
                            <input type="text" value="<?php echo $user->web_url; ?>" name="web_url" class="form-control">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <label>IP Address:</label>
                            <input type="text" value="<?php echo $user->ip_address; ?>" name="ip_address" class="form-control" readonly="">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <label>User Agent:</label>
                            <input type="text" value="<?php echo $user->user_agent; ?>" name="user_agent" class="form-control" readonly="">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Created At:</label>
                            <input type="text" value="<?php echo $user->created_at; ?>" name="create_at" class="form-control" readonly="">
                        </td>
                        <td>
                            <label>Updated At:</label>
                            <input type="text" value="<?php echo $user->updated_at; ?>" name="update_at" class="form-control" readonly="">
                        </td>
                    </tr>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="2"><input type="submit" class="btn btn-warning btn-block" value="Update Profile" </td>
                    </tr>
                    </tfoot>
                </table>
                <?php echo form_close(); ?>
            </fieldset>


        </div>
    </div>
</div>