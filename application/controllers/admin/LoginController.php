<?php

class LoginController extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
        $data['page_title'] = 'Admin Login';
        $this->load->view('admin/headers/head', $data);
        $this->load->view('admin/contents/login');
        $this->load->view('admin/footers/foot');
    }
    
    public function login_exec() {
        if (!$this->input->post()) {
            redirect(base_url().'admin');
            exit();
        } else {
            $validate_login = array(
                array(
                    'field' => 'email',
                    'label' => 'Email',
                    'rules' => 'required|valid_email|trim'
                ),
                array(
                    'field' => 'password',
                    'label' => 'Password',
                    'rules' => 'required|trim'
                )
            );
            $this->form_validation->set_rules($validate_login);
            if ($this->form_validation->run() ==  false) {
                $this->index();
            } else {
                $email = trim($this->input->post('email'));
                $password = trim($this->input->post('password'));
                $clean_email = $this->security->xss_clean($email);
                $clean_password = $this->security->xss_clean($password);
                
            }
        }
    }
    
    public function menu() {
        $this->load->view('admin/headers/head');
        $this->load->view('admin/headers/navbar-top');
        $this->load->view('admin/headers/navbar-side');
        $this->load->view('admin/contents/blank-page');
        $this->load->view('admin/footers/foot');
    }
    
    public function new_menu() {
        $this->load->view('admin/contents/blank-page');
    }
}