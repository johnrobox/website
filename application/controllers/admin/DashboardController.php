<?php

class DashboardController extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        if (!$this->session->has_userdata('admin_logged_in') && !$this->session->userdata('admin_logged_in')) 
            redirect (base_url().'admin');
        $this->load->model('AdminUser');
        $this->acountInfo = $this->AdminUser->get_by_id($this->session->userdata('admin_logged_in')['ADMIN_LOGIN_ID']);
    }
    
    public function dashboard() {
        $data = array(
            'page_title' => 'Admin - Dashboard',
            'head_title' => 'Dashboard',
            'account' => $this->acountInfo
        );
        $this->load->view('admin/headers/head', $data);
        $this->load->view('admin/headers/navbar-top');
        $this->load->view('admin/headers/navbar-side');
        $this->load->view('admin/contents/admin-dashboard');
        $this->load->view('admin/modals/account-settings');
        $this->load->view('admin/modals/change_profile');
        $this->load->view('admin/modals/logout');
        $this->load->view('admin/footers/footer-link');
        $this->load->view('admin/footers/foot');
    }
}

