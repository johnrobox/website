<?php

class AdminUserLog extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->table = 'admin_user_logs';
    }
    
    public function insert_data($data) {
        $response['inserted'] = ($this->db->insert($this->table, $data)) ? true : false;
        return $response;
    }
}