
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <span class="fa fa-plus"></span> Register
            </div>
            <div class="panel-body">
                <?php echo form_open(base_url().'admin/admin-register-user-exec'); ?>
                
                <!-- for firstname field -->
                <div class="form-group">
                    <label for="admin_firstname">Firstname</label>
                    <?php
                    echo form_error('admin_firstname', '<div class="text-red">', '</div>');
                    echo form_input($fields['firstname']);
                    ?>
                </div>
                
                <!-- for lastname field -->
                <div class="form-group">
                    <label for="admin_lastname">Lastname</label>
                    <?php
                    echo form_error('admin_lastname', '<div class="text-red">', '</div>');
                    echo form_input($fields['lastname']);
                    ?>
                </div>
                
                <!-- for email field -->
                <div class="form-group">
                    <label for="admin_email">Email</label>
                    <?php
                    echo form_error('admin_email', '<div class="text-red">', '</div>');
                    echo form_input($fields['email']);
                    ?>
                </div>
                
                <!-- for password field -->
                <div class="form-group">
                    <label for="admin_password">Password</label>
                    <?php
                    echo form_error('admin_password', '<div class="text-red">', '</div>');
                    echo form_input($fields['password']);
                    ?>
                </div>
                
                <!-- for password confirm field -->
                <div class="form-group">
                    <label for="admin_password_conf">Password Confirm</label>
                    <?php
                    echo form_error('admin_password_conf', '<div class="text-red">', '</div>');
                    echo form_input($fields['password_conf']);
                    ?>
                </div>
                
                <!-- for gender field -->
                <div class="form-group">
                    <label for="admin_gender">Gender</label>
                    <?php
                    echo form_error('admin_gender', '<div class="text-red">', '</div>');
                    echo form_dropdown('admin_gender', $select['gender'], 0, 'class="form-control" id="admin_gender"');
                    ?>
                </div>
                
                <?php
                // submit button
                echo form_button($button['submit']);
                
                // reset button
                echo form_button($button['reset']);
                ?>
                
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
                
