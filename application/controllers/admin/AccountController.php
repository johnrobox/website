<?php

class AccountController extends CI_Controller {
    
    private $err_update = 'Error in updating account data. Please try to submit again.';
    
    public function __construct() {
        parent::__construct();
        $this->load->library('alert');
        $this->load->model('AdminUser');
        $this->load->model('AdminUserLog');
        
        // session
        $sess_account = $this->session->userdata('admin_logged_in');
        $admin_id = $sess_account['ADMIN_LOGIN_ID'];
        $token = $sess_account['ADMIN_LOGIN_TOKEN'];
    }
    
    public function settings() {
        
        
    }
    
    public function update_exec() {
        $update_tr = array();
        $validate = array(
            array(
                'field' => 'admin_firstname',
                'label' => 'Firstname',
                'rules' => 'required'
            ),
            array(
                'field' => 'admin_lastname',
                'label' => 'Lastname',
                'rules' => 'required'
            ),
            array(
                'field' => 'admin_email',
                'label' => 'Email',
                'rules'  => 'required'
            ),
            array(
                'field' => 'admin_gender',
                'label' => 'Gender',
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($validate);
        if ($this->form_validation->run() ==  false) {
            $this->session->set_flashdata('error', $this->alert->show('Error in submition of form. Please try modifiy your account.', 0));
            $update_tr['updated'] = false;
        } else {
            // sanitize data
            $firstname = $this->input->post('admin_firstname');
            $lastname = $this->input->post('admin_lastname');
            $email = $this->input->post('admin_email');
            $gender = $this->input->post('admin_gender');
            
            $sess_account = $this->session->userdata('admin_logged_in');
            $admin_id = $sess_account['ADMIN_LOGIN_ID'];
            $token = $sess_account['ADMIN_LOGIN_TOKEN'];
            $data['admin_modified'] = date('Y-m-d H:i:s');
            $update_log = $this->AdminUserLog->update_by_id_token($admin_id, $token, $data);
            if (!$update_log['updated']) {
                $this->session->set_flashdata('error', $this->alert->show($this->err_update, 0));
                $update_tr['updated'] = false;
            } else {
                $prepare_data = array(
                    'admin_firstname' => $firstname,
                    'admin_lastname' => $lastname,
                    'admin_email' => $email,
                    'admin_gender' => $gender
                );
                $update_data =  $this->AdminUser->update_by_id($admin_id, $prepare_data);
                if (!$update_data['updated']) {
                    $this->session->set_flashdata('error', $this->alert->show($this->err_update, 0));
                    $update_tr['updated'] = false;
                } else {
                    $this->session->set_flashdata('success', $this->alert->show('Account update success!', 1));
                    $update_tr['updated'] = false;
                }
            }
        }
        echo json_encode($update_tr);
    }
    
    public function update_profile_exec(){
        
    }
    
}

