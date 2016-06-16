
<script>
$(document).ready(function() {
    $('#submit_changes').click(function() {
        var firstname = $('#account_firstname').val();
        var lastname = $('#account_lastname').val();
        var email = $('#account_email').val();
        var gender = $('#account_gender').val();
        var req = ' is required.';
        var error = false;
        // validate firstname
        if (!firstname) {
            error = true;
            $('.firstname_err').text('Firstname'+req);
        } else {
            $('.firstname_err').text('');
        }
        // validate lastname
        if (!lastname) {
            error = true;
            $('.lastname_err').text('Lastname'+req);
        } else {
            $('.lastname_err').text('');
        }
        // validate email
        var email_reg = /[A-Z0-9._%+-]+@[A-Z0-9.-]+.[A-Z]{2,4}/igm;
        if (!email) {
            error = true;
            $('.email_err').text('Email'+req);
        } else if (!email_reg.test(email)) {
            error = true;
            $('.email_err').text('Invalid email address');
        } else {
            $('.email_err').text('');
        }
        // validate gender
        if (!gender) {
            error = true;
            $('.gender_err').text('Gender'+req);
        } else {
            $('.gender_err').text('');
        }
        
        if (!error) {
            $.ajax({
                url : 'admin-update-account-exec',
                type : 'post',
                dataType : 'json',
                data : {
                    csrf_webox_name : '<?php echo $this->security->get_csrf_hash();?>',
                    admin_firstname : firstname,
                    admin_lastname : lastname,
                    admin_email : email,
                    admin_gender : gender
                },
                success : function(data) {
                    location.reload();
                },
                error : function(error) {
                    alert('error');
                }
            });
        } 
    });
})
</script>
<div class="modal fade" id="editAccountModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="fa fa-gear"></span> Settings
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="account_firstname">Firstname </label>
                    <div class="firstname_err text-red"></div>
                    <?php
                    $for_firstname = array(
                        'type' => 'text',
                        'name' => 'account_firstname',
                        'id' => 'account_firstname',
                        'class' => 'form-control',
                        'value' => $account[0]->admin_firstname
                    );
                    echo form_input($for_firstname);
                    ?>
                </div>
                
                <div class="form-group">
                    <label for="account_lastname">Lastname </label>
                    <div class="lastname_err text-red"></div>
                    <?php 
                        $for_lastname = array(
                        'type' => 'text',
                        'name' => 'account_lastname',
                        'id' => 'account_lastname',
                        'class' => 'form-control',
                        'value' => $account[0]->admin_lastname
                    );
                    echo form_input($for_lastname);
                    ?>
                </div>
                
                <div class="form-group">
                    <label for="account_email">Email</label>
                    <div class="email_err text-red"></div>
                    <?php
                    $for_email = array(
                        'type' => 'email',
                        'name' => 'account_email',
                        'id' => 'account_email',
                        'class' => 'form-control',
                        'value' => $account[0]->admin_email
                    );
                    echo form_input($for_email);
                    ?>
                </div>
                
                <div class="form-group">
                    <label for="account_gender">Gender</label>
                    <div class="gender_err text-red"></div>
                    <?php 
                    $for_gender = array(
                        '' => 'Select gender',
                        1 => 'Male',
                        2 => 'Female'
                    );
                    echo form_dropdown('account_gender', $for_gender, $account[0]->admin_gender, 'class="form-control" id="account_gender"');
                    ?>
                </div>
                
                
            </div>
            <div class="modal-footer">
                <?php
                $submit_btn = array(
                    'class' => 'btn btn-primary',
                    'id' => 'submit_changes',
                    'content' => '<span class="fa fa-pencil-square-o"></span> Update'
                );
                echo form_button($submit_btn);
                
                $cancel_btn = array(
                    'class' => 'btn btn-default',
                    'data-dismiss' => 'modal',
                    'content' => '<span class="fa fa-times"></span> Cancel'
                );
                echo form_button($cancel_btn);
                ?>
            </div>
        </div>
    </div>
</div>