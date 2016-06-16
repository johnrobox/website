
<script>
    $(document).ready(function(){
        $('#update').click(function(){
            var res_field = document.getElementById("profile_image").value;
            var extension = res_field.substr(res_field.lastIndexOf('.') + 1).toLowerCase();
            var allowedExtensions = ['jpg', 'jpeg', 'png'];
            if (!res_field) {
                $('.errProfileMsg').text('Please browse your profile image!');
            } else {
                if (allowedExtensions.indexOf(extension) === -1) {
                    $('.errProfileMsg').text('Invalid file format. Only '+ allowedExtensions.join(', ') + ' are allowed!');
                } else {
                    $('.errProfileMsg').text('');
                    $('#imageLoadingUploadProfile').toggle();
                    var fd = new FormData(document.getElementById("fileinfo"));
                    fd.append("label", "WEBUPLOAD");
                    $.ajax({
                      url: "<?php echo base_url();?>admin/admin-update-profile_exec",
                      type: "POST",
                      data: fd,
                      processData: false,  // tell jQuery not to process the data
                      contentType: false   // tell jQuery not to set contentType
                    }).done(function( data ) {
                        if (typeof data.error == 'undefined') {
                            //location.reload();
                        } else {
                            $('#errorMessage').text(data.error);
                        }
                    });
                    return false;
                }
            }
        })
    });
    
    var loadFile = function(event) {
    var reader = new FileReader();
    reader.onload = function(){
            var output = document.getElementById('output');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    };
</script>

<!-- Modal - change profile -->
<div class="modal fade" id="changeProfile">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Change profile picture
            </div>
            <div class="modal-body">
                <?php
                if (!empty($account[0]->admin_image)) {
                    $profile = 'users/'.$account[0]->admin_image;
                } else if ($account[0]->admin_gender == 1) {
                    $profile = 'default/male.jpg';
                } else {
                    $profile = 'default/female.jpg';
                }
                ?>
                <div class="row">
                    <div class="col-sm-6">
                        <img src="<?php echo base_url().'images/admin/'.$profile;?>" id="output" class="img-circle img-responsive center-block" style="height: 200px; width: 200px; border: 1px solid black"/>
                    </div>
                    <div class="col-sm-6">
                        <img src="<?php echo base_url().'images/admin/default/please_wait.gif';?>" class="img-responsive" id="imageLoadingUploadProfile" style="display: none;">
                        <?php echo form_open('', array('id' => 'fileinfo', 'name' => 'fileinfo', 'onsubmit' => 'return submitForm()')); ?>
                        <?php
                        $for_profile = array(
                            'type' => 'file',
                            'name' => 'profile_image',
                            'id' => 'profile_image',
                            'accept' => 'image/*',
                            'onchange' => 'loadFile(event)',
                            'class' => 'form-control'
                        );
                        echo form_input($for_profile);
                        ?>
                        <span class="errProfileMsg text-red"></span>
                        <br>
                        <?php
                        $submit_btn = array(
                            'class' => 'btn btn-primary',
                            'id' => 'update',
                            'content' => 'Change'
                        );
                        echo form_button($submit_btn);
                        
                        $cancel_btn = array(
                            'class' => 'btn btn-default',
                            'content' => 'Cancel',
                            'data-dismiss' => 'modal'
                        );
                        echo form_button($cancel_btn);
                        ?>
                        <?php echo form_close(); ?>
                    </div>
                </div>
                
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>