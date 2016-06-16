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
    
    public function get_by_email($email) {
        $this->db->where('admin_email', $email);
        $query = $this->db->get($this->table);
        if ($query->num_rows() <= 0) {
            $login['valid'] = false;
        } else {
            $login = array(
                'valid' => true,
                'data' => $query->result()
            );
        }
        return $login;
    }
    
    public function get_by_id($id){
        $this->db->where('id', $id);
        $this->db->select(array('admin_firstname', 'admin_lastname', 'admin_email', 'admin_gender', 'admin_image'));
        $get = $this->db->get($this->table);
        return $get->result();
    }
    
    public function update_by_id($id, $data) {
        $this->db->where('id', $id);
        $result['updated'] = ($this->db->update($this->table, $data)) ? true : false;
        return $result;
    }
    
}