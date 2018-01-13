<div class="container">
    <div class="row">
        <div class="col-md-12 contentWrapper">

            <?php echo form_open('admin_controller/search_user'); ?>
            <table class="table table-condensed">
                <caption>Search User</caption>
                <tbody>
                <tr>
                    <td><input type="text" name="company_name" placeholder="Company Name" value="<?php echo ($this->input->post('company_name'))?$this->input->post('company_name'):NULL; ?>" class="form-control"></td>
                    <td><input type="text" name="name" placeholder="Name" value="<?php echo ($this->input->post('name'))?$this->input->post('name'):NULL; ?>" class="form-control"></td>
                    <td><input type="text" name="email" placeholder="E-mail" value="<?php echo ($this->input->post('email'))?$this->input->post('email'):NULL; ?>" class="form-control"></td>
                    <td><input type="text" name="company_address" placeholder="Address" value="<?php echo ($this->input->post('company_address'))?$this->input->post('company_address'):NULL; ?>" class="form-control"></td>
                </tr>
                <tr>
                    <td><input type="text" name="phone" placeholder="Phone" value="<?php echo ($this->input->post('phone'))?$this->input->post('phone'):NULL; ?>" class="form-control"></td>
                    <td><input type="text" name="mobile" placeholder="Mobile" value="<?php echo ($this->input->post('mobile'))?$this->input->post('mobile'):NULL; ?>" class="form-control"></td>
                    <td><input type="text" name="web_url" placeholder="Web URL" value="<?php echo ($this->input->post('web_url'))?$this->input->post('web_url'):NULL; ?>" class="form-control"></td>
                    <td><input type="submit" name="" value="Find" class="btn btn-warning btn-block"></td>
                </tr>
                </tbody>
            </table>
            <?php echo form_close(); ?>



            <table class="table table-striped table-bordered table-hover table-sorted">
                <caption>User List</caption>
                <thead>
                    <tr>
                        <th>S/L</th>
                        <th>Company Name</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Mobile</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($this->uri->segment(3) != NULL) {
                        $i = ($this->uri->segment(3) + 1);
                    } else {
                        $i = 1;
                    }
                    foreach ($user_list->result() as $user) {
                        ?>
                        <tr class="tr-<?php echo $user->user_id; ?>">
                            <td style="width: 50px; text-align: center;"><?php echo $i++; ?></td>
                            <td><?php echo $user->company_name; ?></td>
                            <td><?php echo $user->name; ?></td>
                            <td><?php echo $user->email; ?></td>
                            <td><?php echo $user->phone; ?></td>
                            <td><?php echo $user->mobile; ?></td>
                            <td style="width: 110px;">
                                <div class="dropdown">
                                    <button class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        Controllers
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                        <li><a href="<?php echo site_url('admin_controller/user_edit/'.$user->user_id) ?>">Edit</a></li>
                                        <li role="separator" class="divider"></li>
                                        <li><a style="cursor: pointer;" onclick="ajax_delete_user(<?php echo $user->user_id; ?>);">Delete</a></li>
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
<!--/.contentWrapper-->