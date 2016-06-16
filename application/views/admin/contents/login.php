

<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default" style="margin-top: 100px;">
                <div class="panel-heading">
                    <h3 class="panel-title">Please Sign In</h3>
                </div>
                <div class="panel-body">
                    <?php echo form_open(base_url().'admin/admin-login-exec'); ?>
                    <div class="form-group">
                        <?php
                        echo $this->session->flashdata('error');
                        echo form_error('email', '<div class="text-red text-center">', '</div>');
                        echo form_input($form['email']);
                        ?>
                    </div>
                    <div class="form-group">
                        <?php
                        echo form_error('password', '<div class="text-red text-center">', '</div>');
                        echo form_input($form['password']);
                        ?>
                    </div>
                    <?php
                    echo form_input($form['token']);
                    ?>
                   
                    <div class="checkbox">
                        <label>
                            <?php
                            $login_remember = array(
                                'type' => 'checkbox',
                                'name' => 'remember',
                                'value' => 'Remember Me'
                            );
                            echo form_checkbox($login_remember);
                            ?>Remember Me
                        </label>
                    </div>
                    <?php 
                        $login_submit = array(
                            'type' => 'submit',
                            'class' => 'btn btn-lg btn-default btn-block',
                            'content' => 'Login'
                        );
                        echo form_button($login_submit);
                    ?>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>