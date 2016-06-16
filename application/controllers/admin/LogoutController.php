<?php

class LogoutController extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('AdminUserLog');
    }
    
    public function logout() {
        $id = $this->session->userdata('admin_logged_in')['ADMIN_LOGIN_ID'];
        $log = array(
            'admin_lastlogout' => date('Y-m-d H:i:s'),
            'admin_flag' => 0
        );
        $save_log = $this->AdminUserLog->update_by_user_id($id, $log);
        if (!$save_log['updated']) {
            redirect(base_url().'admin/admin-logout');
            exit();
        }  else {
            $this->session->unset_userdata('admin_logged_in');
            $this->session->sess_destroy();
            redirect(base_url().'admin');
            exit();
        }
    }
    
}

