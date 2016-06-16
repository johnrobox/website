<?php

class LoginController extends CI_Controller {
    
    private $login_err_msg = 'Invalid Email / Password';
    
    public function __construct() {
        parent::__construct();
        $this->load->library('Form');
        $this->load->library('Alert');
        $this->load->library('Generate');
        $this->load->model('AdminUser');
        $this->load->model('AdminUserLog');
    }
    
    public function index() {
        $data = array(
            'page_title' => 'Admin Login',
            'form' => array(
                'email' => $this->form->email('email', 'E-mail', false),
                'password' => $this->form->password('password', 'Password',  false),
                'token' => $this->form->hidden($this->security->get_csrf_token_name(), $this->security->get_csrf_hash())
            )
        );
        $data['form']['email']['autofocus'] = '';
       
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
                $check_login = $this->AdminUser->get_by_email($email);
                if (!$check_login['valid']) {
                    $this->session->set_flashdata('error', $this->alert->show($this->login_err_msg, 0));
                    redirect(base_url().'admin');
                    exit();
                } else {
                    $save_password = $check_login['data'][0]->admin_password;
                    if (!password_verify($clean_password, $save_password)) {
                        $this->session->set_flashdata('error', $this->alert->show($this->login_err_msg, 0));
                        redirect(base_url().'admin');
                        exit();
                    } else {
                        $admin_id = $check_login['data'][0]->id;
                        $token = $this->generate->getString(88);
                        //save login log
                        $login_log = array(
                            'admin_token' => $token,
                            'admin_lastlogin' => date('Y-m-d H:i:s'),
                            'admin_flag' => 1
                        );
                        $save_log = $this->AdminUserLog->update_by_user_id($admin_id, $login_log);
                        if (!$save_log['updated']) {
                            $this->session->set_flashdata('error', $this->alert->show('System error occur while loggin!', 0));
                            redirect(base_url().'admin');
                            exit();
                        } else {
                            $ready_to_session = array(
                                'ADMIN_LOGIN_STATUS' => true,
                                'ADMIN_LOGIN_TOKEN' => $token,
                                'ADMIN_LOGIN_ID' => $admin_id
                            );
                            $this->session->set_userdata('admin_logged_in', $ready_to_session);
                            redirect(base_url().'admin/dashboard');
                            exit();
                        }
                    }
                }
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