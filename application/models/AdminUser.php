<?php


class AdminUser extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->table = 'admin_users';
    }
    
    public function insert_data($data) {
        if ($this->db->insert($this->table, $data)) {
            $response = array (
                'registered' => true,
                'registered_id' => $this->db->insert_id()
            );
        } else {
            $response['registered'] = false;
        }
        return $response;
    }
    
}