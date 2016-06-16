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
    
    public function update_by_user_id($user_id, $data) {
        $this->db->where('admin_id', $user_id);
        $result['updated'] = ($this->db->update($this->table, $data)) ? true : false;
        return $result;
    }
    
    public function update_by_id_token($id, $token, $data) {
        $this->db->where('admin_id', $id);
        $this->db->where('admin_token', $token);
        $result['updated'] = ($this->db->update($this->table, $data)) ? true : false;
        return $result;
    }
    
}