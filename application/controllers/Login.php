<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
  public function __construct() {
		parent::__construct();

    date_default_timezone_set('Asia/Jakarta');

    $this->load->library('encryption');

		// Check session
    if(is_login()) {
      redirect('dasbor');
    }
	}

  public function index() {
    $this->load->view('login/index');
  }

  public function do_login() {
    $username = $this->input->post('username');
    $kata_sandi = $this->input->post('kata_sandi');
    
    $query = $this->db->get_where('tb_administrator', array('username' => $username));

    if($query->num_rows() > 0) {
      $data = $query->row();

      if($this->encryption->decrypt($data->kata_sandi) === $kata_sandi) {  //nyalain ini kalo pengen dibalikin semula
      // if (md5($kata_sandi) == $data->kata_sandi) {                            //ini kalau pake md5    
        $this->session->set_userdata('logged_in', true);
        $this->session->set_userdata('id_administrator', $data->id_administrator);
        $this->session->set_userdata('nama_lengkap', $data->nama_lengkap);
        $this->session->set_userdata('username', $data->username);

        redirect('dasbor');
      } else {
        $this->session->set_flashdata('status', 'Gagal');
        $this->session->set_flashdata('message', 'Maaf, kata sandi Anda tidak benar.');
      

        redirect('login');
      }
    } else {
      $this->session->set_flashdata('status', 'Gagal');
      $this->session->set_flashdata('message', 'Maaf, akun Anda tidak dapat digunakan atau belum terdaftar.');
      //$this->session->set_flashdata('message', $this->encryption->encrypt('admin1'));

      redirect('login');
    }
  }
}
