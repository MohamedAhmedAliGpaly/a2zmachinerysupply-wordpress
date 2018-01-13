<div class="container  user-content-wrapper">
    <div class="row">

        <div class="col-md-10 col-md-offset-1">
            <?php echo form_open('user_controller/update_profile'); ?>
            <?php
            if(!empty($success)){
                echo '<div class="alert alert-info" role="alert"><strong>Heads up! </strong>'.$success.'</div>';
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
                            <label>Your Name:</label>
                            <input type="text" value="<?php echo $user->name; ?>" name="name" class="form-control">
                        </td>
                        <td>
                            <label>Your Email:</label>
                            <input type="text" value="<?php echo $user->email; ?>" name="email" class="form-control" required="" readonly="">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Your Phone:</label>
                            <input type="text" value="<?php echo $user->phone; ?>" name="phone" class="form-control">
                        </td>
                        <td>
                            <label>Your Mobile:</label>
                            <input type="text" value="<?php echo $user->mobile; ?>" name="mobile" class="form-control" required="" readonly="">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <label>Company Web Url:</label>
                            <input type="text" value="<?php echo $user->web_url; ?>" name="web_url" class="form-control">
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
<!--#user-content-wrapper-->