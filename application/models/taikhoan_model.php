<?php
class TaiKhoan_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }
    
    public function check_login($username, $password) {
        $user = $this->db->get_where('tai_khoan', array('ten_dn' => $username, 'mat_khau' => $password));
        if($user->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}