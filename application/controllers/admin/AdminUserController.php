<?php

class AdminUserController extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->library('form');
        $this->load->model('AdminUser');
        $this->load->model('AdminUserLog');
        $this->load->library('alert');
        $this->acountInfo = $this->AdminUser->get_by_id($this->session->userdata('admin_logged_in')['ADMIN_LOGIN_ID']);
    }
    
    public function register() {
        $data = array(
            'page_title' => 'Admin - Register Admin User',
            'head_title' => 'Register Admin User',
            'account' => $this->acountInfo,
            'fields' => array(
                'firstname' => $this->form->text('admin_firstname', 'Firstname', false),
                'lastname' => $this->form->text('admin_lastname', 'Lastname', false),
                'email' => $this->form->email('admin_email', 'Email', false),
                'password' => $this->form->password('admin_password', 'Password', false),
                'password_conf' => $this->form->password('admin_password_conf', 'Password confirm', false)
            ),
            'button' => array(
                'submit' => $this->form->submit('Add'),
                'reset' => $this->form->reset('Refresh')
            ),
            'select' => array(
                'gender' => array(
                    "" => 'Select Gender',
                    1 => 'Male',
                    2 => 'Female'
                )
            )
        );
        $this->load->view('admin/headers/head', $data);
        $this->load->view('admin/headers/navbar-top');
        $this->load->view('admin/headers/navbar-side');
        $this->load->view('admin/contents/admin-register-user');
        $this->load->view('admin/modals/account-settings');
        $this->load->view('admin/modals/logout');
        $this->load->view('admin/footers/footer-link');
        $this->load->view('admin/footers/foot');
    }
    
    public function register_exec() {
        $validate = array(
            array(
                'field' => 'admin_firstname',
                'label' => 'Firstname',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'admin_lastname',
                'label' => 'Lastname',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'admin_email',
                'label' => 'Email',
                'rules' => 'trim|required|valid_email|is_unique[admin_users.admin_email]',
            ),
            array(
                'field' => 'admin_password',
                'label' => 'Password',
                'rules' => 'trim|required|min_length[8]'
            ),
            array(
                'field' => 'admin_password_conf',
                'label' => 'Password Confirm',
                'rules' => 'trim|required|matches[admin_password]'
            ),
            array(
                'field' => 'admin_gender',
                'label' => 'Gender',
                'rules' => 'required'
            )
        );
        
        $this->form_validation->set_rules($validate);
        if ($this->form_validation->run() == false) {
            $this->register();
        } else {
            $firstname = trim($this->input->post('admin_firstname'));
            $lastname = trim($this->input->post('admin_lastname'));
            $email = trim($this->input->post('admin_email'));
            $password = trim($this->input->post('admin_password'));
            $gender = $this->input->post('admin_gender');
            $new_user = array(
                'admin_firstname' => $firstname,
                'admin_lastname' => $lastname,
                'admin_email' => $email,
                'admin_password' => password_hash($password, PASSWORD_BCRYPT),
                'admin_gender' => $gender
            );
            $admin_user = $this->AdminUser->insert_data($new_user);
            if (!$admin_user['registered']) {
                $this->session->set_flashdata('error', $this->alert->show('Cannot register new user!', 0));
            } else {
                $new_user_log = array(
                    'admin_id' => $admin_user['registered_id'],
                    'admin_created' => date('Y-m-d H:i:s')
                );
                $admin_user_log = $this->AdminUserLog->insert_data($new_user_log);
                if (!$admin_user_log['inserted']) {
                    $this->session->set_flashdata('success', $this->alert->show('Cannot complete admin registration!', 0));
                } else {
                    $this->session->set_flashdata('success', $this->alert->show('Admin user added success!', 1));
                }
            }
            redirect(base_url().'admin/admin-register-user');
            exit();
        }
    }
    
    
    public function all() {
        $data = array(
            'page_title' => 'Admin - List of admin users',
            'head_title' => 'List Admin User',
            'account' => $this->acountInfo
        );
        $this->load->view('admin/headers/head', $data);
        $this->load->view('admin/headers/navbar-top');
        $this->load->view('admin/headers/navbar-side');
        $this->load->view('admin/contents/admin-all-user');
        $this->load->view('admin/modals/account-settings');
        $this->load->view('admin/modals/logout');
        $this->load->view('admin/footers/footer-link');
        $this->load->view('admin/footers/foot');
    }
    
}