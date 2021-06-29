<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrator extends CI_Controller {
  public function __construct() {
    parent::__construct();

    date_default_timezone_set('Asia/Jakarta');

    $this->load->library('grocery_CRUD');
    $this->load->library('encryption');
    
    $this->session->set_userdata('title', 'Administrator');
    $this->session->set_userdata('subtitle', 'Kelola data administrator.');

    // Check session
    if(!is_login()) {
      redirect('login');
    }
  }

  public function index() {
    $crud = new grocery_CRUD();
    $state = $crud->getState(); 
      $state_info = $crud->getStateInfo();

    $crud->set_language('indonesian'); //setting bahasa untuk tampilan crud
    $crud->set_theme('datatables'); //setting tema yang digunakan untuk view tabel 
    $crud->set_table('tb_administrator'); //memanggil database yang digunakan 
    $crud->set_subject('Administrator'); 
    $crud->columns('nama_lengkap', 'username', 'kata_sandi');

    $crud->display_as('id_administrator', '#');
    $crud->display_as('nama_lengkap', 'Nama Lengkap');
    $crud->display_as('username', 'Username');
    $crud->display_as('kata_sandi', 'Kata Sandi');

    $crud->field_type('kata_sandi', 'password');

    
      $crud->fields(array('nama_lengkap', 'username', 'kata_sandi'));
    $crud->required_fields(array('nama_lengkap', 'username', 'kata_sandi'));
    $crud->unique_fields(array('username'));

    $crud->callback_add_field('kata_sandi', function() {
      return '<input type="password" class="form-control" name="kata_sandi" />';
    });

    $crud->callback_edit_field('kata_sandi', function($value, $primary_key) {
      return '<input type="password" class="form-control" name="kata_sandi" value="’.$this->encryption->decrypt($value).’" />';
    });

    $crud->callback_edit_field('nama_lengkap', function() {
      return '<input type="text" class="form-control" name="nama_lengkap" value="'. $_SESSION['nama_lengkap'].'" />';
    });

    if($state == "edit") {
      $crud->callback_edit_field('username', function($value, $primary_key) {
        return '<input type="text" class="form-control" name="username" value="' . $_SESSION['username'] . '" readonly />'; //menonaktifkan field username agar tidak bisa di ubah
      });
    }

    $crud->callback_before_insert(array($this, 'encrypt_password_insert_callback')); //encrypt password
    $crud->callback_before_update(array($this, 'encrypt_password_update_callback')); //encrypt password 

    $crud->unset_read();
    $crud->unset_clone();
    $crud->unset_export();
    $crud->unset_print();
    $crud->unset_bootstrap();
    $crud->unset_add(); // menghilangkan tombol tambah data
    $crud->unset_delete(); //menghilangkan tombol hapus data
    //$crud->unsetSearchColumns(['nama_lengkap', 'username', 'kata_sandi']);
    $crud->unset_back_to_list(); //matiin tombol kembali dan save
    // $crud->unset_columns(array('nama_lengkap', 'username', 'kata_sandi'));

    $crud->where([
      'username' => $_SESSION['username']
    ]);
    
    $crud->set_lang_string('list_edit','Ubah Password'); //to change label name


    $output = $crud->render();

    $this->load->view('template', (array) $output);
  }

  public function encrypt_password_insert_callback($post_array) {
    $post_array['kata_sandi'] = $this->encryption->encrypt($post_array['kata_sandi']);

    return $post_array;
  }

  public function encrypt_password_update_callback($post_array, $primary_key) {
    $post_array['kata_sandi'] = $this->encryption->encrypt($post_array['kata_sandi']);

    return $post_array;
  }
}