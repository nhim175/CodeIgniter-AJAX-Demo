<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('html');        
        $this->load->helper('form');
        $this->load->model('nhanvien_model');
        $this->load->model('phongban_model');
        $this->load->model('taikhoan_model');
    }
    public function index() {
        if(!isset($this->session->userdata['username'])) {
            redirect('home/login', 'refresh');
        } else {
            $data['title'] = 'Quản lý nhân viên';
            $this->load->view('index', $data);
        }
    }
    
    public function login() {
        $data['title'] = 'Đăng nhập';
        if($this->input->post('username') && $this->input->post('password')) {
            $username = $this->input->post('username');
            $password = md5($this->input->post('password'));
            if($this->taikhoan_model->check_login($username, $password)) {
                //log in thành công
                $this->session->set_userdata(array('username' => $username));
                redirect('home/index', 'refresh');
            } else {
                $data['sai_mk'] = 1;
                $this->load->view('dang_nhap', $data);
            }
        } else {
            if(isset($this->session->userdata['username'])) {
                $this->load->view('index', $data);
            }
            $data['sai_mk'] = 0;
            $this->load->view('dang_nhap', $data);
        }
           
    }
    
    public function logout() {
        $this->session->sess_destroy();
        redirect('home/index', 'refresh');
    }
    
    public function load_phongban() {
        if(isset($this->session->userdata['username'])) {
            $data['phong_ban'] = $this->phongban_model->get_all()->result();
            $this->load->view('ajax/phong_ban', $data);
        }
    }
    
    public function load_nhanvien() {
        if(isset($this->session->userdata['username'])) {
            $data['phong_ban'] = $this->phongban_model->get_all()->result();
            $data['nhan_vien'] = $this->nhanvien_model->get_all()->result();
            $this->load->view('ajax/nhan_vien', $data);
        }
    }
    
    public function update_nhanvien() {
        if(isset($this->session->userdata['username'])) {
            $id = $this->input->post('id');
            $name = $this->input->post('name');
            $bday = $this->input->post('bday');
            $pb_id = $this->input->post('pb_id');
            $this->nhanvien_model->update($id, $name, $bday, $pb_id);
        }
    }
    public function delete_nhanvien() {
        if(isset($this->session->userdata['username'])) {
            $id = $this->input->post('id');
            $this->nhanvien_model->delete($id);
        }
    }
    
    public function insert_nhanvien() {
        if(isset($this->session->userdata['username'])) {
            $name = $this->input->post('name');
            $pb_id = $this->input->post('pb_id');
            $bday = $this->input->post('bday');
            $this->nhanvien_model->insert($name, $bday, $pb_id);
        }
    }
    
    public function insert_phongban() {
        if(isset($this->session->userdata['username'])) {
            $name = $this->input->post('name');
            $this->phongban_model->insert($name);
        }
    }
    
    public function update_phongban() {
        if(isset($this->session->userdata['username'])) {
            $id = $this->input->post('id');
            $name = $this->input->post('name');
            $this->phongban_model->update($id, $name);
        }
    }
    
    public function delete_phongban() {
        if(isset($this->session->userdata['username'])) {
            $id = $this->input->post('id');
            $this->phongban_model->delete($id);
        }
    }
    
    public function get_nv_in_pb() {
        if(isset($this->session->userdata['username'])) {
            $id = $this->input->post('id');
            $data['balloon'] = $this->nhanvien_model->get_nv_in_pb($id)->result();
            $this->load->view('ajax/balloon', $data);
        }
    }
}