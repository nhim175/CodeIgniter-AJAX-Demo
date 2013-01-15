<?php
class PhongBan_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function get_all() {
        return $this->db->get('phong_ban');
    }
    public function update($id, $name) {
        $this->db->where('pb_id', $id);
        $this->db->update('phong_ban', array('ten' => $name));
    }
    public function delete($id) {
        $this->db->delete('phong_ban', array('pb_id' => $id));
    }
    public function insert($name) {
        $this->db->insert('phong_ban', array('ten' => $name));
    }
    
}