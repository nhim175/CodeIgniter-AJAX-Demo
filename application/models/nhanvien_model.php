<?php
class NhanVien_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function get_all() {
        $this->db->select('*');
        $this->db->from('nhan_vien');
        $this->db->join('phong_ban', 'phong_ban.pb_id = nhan_vien.pb_id','left');
        return $this->db->get();
    }
    
    public function get_nv_in_pb($id) {
        $this->db->select('*');
        $this->db->from('nhan_vien');
        $this->db->join('phong_ban', 'phong_ban.pb_id = nhan_vien.pb_id');
        $this->db->where('phong_ban.pb_id', $id);
        return $this->db->get();
    }
    
    public function update($id, $name, $bday, $pb_id) {
        $this->db->where('nv_id', $id);
        $this->db->update('nhan_vien', array('ho_ten' => $name, 'ngay_sinh' => $bday, 'pb_id' => $pb_id));
    }
    
    public function delete($id) {
        $this->db->delete('nhan_vien', array('nv_id' => $id));
    }
    
    public function insert($name, $bday, $pb_id) {
        $this->db->insert('nhan_vien', array('ho_ten' => $name, 'ngay_sinh' => $bday, 'pb_id' => $pb_id));
    }
}