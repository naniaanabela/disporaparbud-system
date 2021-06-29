<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pariwisata extends CI_Controller {
  public function __construct() {
		parent::__construct();

		date_default_timezone_set('Asia/Jakarta');

		$this->load->library('grocery_CRUD');
		$this->load->library('excel');

		$this->load->model('m_pariwisata');
		
		$this->session->set_userdata('title', 'Pariwisata');
		$this->session->set_userdata('subtitle', 'Kelola data objek wisata.');

		// Check session
    if(!is_login()) {
      redirect('login');
    }
	}

  public function index() {
		$crud = new grocery_CRUD();
		$state = $crud->getState();
    $state_info = $crud->getStateInfo();

		$crud->set_language('indonesian');
		$crud->set_theme('datatables');
		$crud->set_table('tb_pariwisata');
		$crud->set_subject('Pariwisata');
		$crud->columns('objek_wisata', 'wisnus', 'wisman', 'sarana_prasarana', 'daya_tarik', 'tahun');

		$crud->display_as('id_pariwisata', '#');
		$crud->display_as('tahun', 'Tahun');
		$crud->display_as('objek_wisata', 'Objek Wisata');
		$crud->display_as('wisnus', 'Wisatawan Nusantara');
		$crud->display_as('wisman', 'Wisatawan Mancanegara');
		$crud->display_as('sarana_prasarana', 'Sarana Prasarana');
		$crud->display_as('daya_tarik', 'Daya Tarik');
		$crud->display_as('ditambahkan_oleh', 'Ditambahkan Oleh');

		$crud->field_type('ditambahkan_oleh', 'hidden', NULL);

		$crud->fields(array('objek_wisata', 'wisnus', 'wisman', 'sarana_prasarana', 'daya_tarik', 'tahun'));
		$crud->required_fields(array('objek_wisata', 'wisnus', 'wisman', 'sarana_prasarana', 'daya_tarik', 'tahun'));
		// $crud->unique_fields(array('objek_wisata'));

		$crud->callback_add_field('tahun', function() {
      return '<input type="number" class="form-control" name="tahun" value="' . date('Y') . '" step="1" />';
    });

		$crud->callback_edit_field('tahun', function($value, $primary_key) {
      return '<input type="number" class="form-control" name="tahun" value="' . $value . '" step="1" />';
    });

		$crud->callback_add_field('wisnus', function() {
      return '<input type="number" class="form-control" name="wisnus" value="" min="0" step="1" />';
    });

		$crud->callback_edit_field('wisnus', function($value, $primary_key) {
      return '<input type="number" class="form-control" name="wisnus" value="' . $value . '" min="0" step="1" />';
    });

		$crud->callback_add_field('wisman', function() {
      return '<input type="number" class="form-control" name="wisman" value="" min="0" step="1" />';
    });

		$crud->callback_edit_field('wisman', function($value, $primary_key) {
      return '<input type="number" class="form-control" name="wisman" value="' . $value . '" min="0" step="1" />';
    });

		$crud->callback_add_field('sarana_prasarana', function() {
      return '<input type="number" class="form-control" name="sarana_prasarana" value="" min="0" step="0.00001" />';
    });

		$crud->callback_edit_field('sarana_prasarana', function($value, $primary_key) {
      return '<input type="number" class="form-control" name="sarana_prasarana" value="' . $value . '" min="0" step="0.00001" />';
    });

		$crud->callback_add_field('daya_tarik', function() {
      return '<input type="number" class="form-control" name="daya_tarik" value="" min="0" step="0.00001" />';
    });

		$crud->callback_edit_field('daya_tarik', function($value, $primary_key) {
      return '<input type="number" class="form-control" name="daya_tarik" value="' . $value . '" min="0" step="0.00001" />';
    });

		$crud->callback_before_delete(array($this, 'pariwisata_before_delete'));

		$crud->unset_read();
		$crud->unset_clone();
		$crud->unset_export();
		$crud->unset_print();
		$crud->unset_bootstrap();

		$output = $crud->render(); 

		$this->load->view('template', (array) $output);
	}

	public function pariwisata_before_delete($primary_key) {
		$pariwisata = $this->db->get_where('v_pariwisata', array('id_pariwisata' => $primary_key))->row();

		$semua_perhitungan = $this->db->get_where('v_perhitungan', array('tahun' => $pariwisata->tahun));

		if($semua_perhitungan->num_rows() > 0) {
			foreach($semua_perhitungan->result() as $row) {
				$delete = false;
				$data_olah = unserialize($row->data_olah);

				foreach($data_olah as $data) {
					if($data['id_pariwisata'] === $pariwisata->id_pariwisata) {
						$delete = true;
					}
				}

				if($delete) {
					$this->db->delete('tb_perhitungan', array('id_perhitungan' => $row->id_perhitungan));
				}
			}
		}

		return true;
	}

	public function import() {
		$this->session->set_userdata('title', 'Impor Data');
		$this->session->set_userdata('subtitle', 'Unggah data secara massal dari file excel. Unduh contoh file excel <a href="' . base_url('assets/excel/format.xlsx') . '" download>disini</a>.');

		$this->load->view('pariwisata/import');
	}

	public function do_import() {
		$this->session->set_userdata('title', 'Hasil Impor');
		
		$config['upload_path']		= './assets/uploads/excel/';
		$config['allowed_types']  = 'xls|xlsx';
		$config['max_size']       = 5000;
		$config['overwrite'] 			= true;

		$this->load->library('upload', $config);

		if(!$this->upload->do_upload('excel')) {
			$error = $this->upload->display_errors();

			$this->session->set_userdata('subtitle', $error);

			$this->load->view('pariwisata/import_failed');
		} else {
			$arr = array();
			$excel_file = $this->upload->data();
			$result = PHPExcel_IOFactory::load($excel_file['full_path']);
			$success = 0;
			
			foreach($result->getWorksheetIterator() as $worksheet) {
				$highestRow = $worksheet->getHighestRow();
				$highestColumn = $worksheet->getHighestColumn();
				$i = 1;

				for($row=2; $row<=$highestRow; $row++) {
					$tahun = (int) $worksheet->getCellByColumnAndRow(0, $row)->getValue();
					$objek_wisata = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
					$wisnus = (int) $worksheet->getCellByColumnAndRow(2, $row)->getValue();
					$wisman = (int) $worksheet->getCellByColumnAndRow(3, $row)->getValue();
					$sarana_prasarana = (double) $worksheet->getCellByColumnAndRow(4, $row)->getValue();
					$daya_tarik = (double) $worksheet->getCellByColumnAndRow(5, $row)->getValue();

					if($tahun !== 0 && $objek_wisata !== NULL) {
						$data = array(
							'tahun' => $tahun,
							'objek_wisata' => $objek_wisata,
							'wisnus' => $wisnus,
							'wisman' => $wisman,
							'sarana_prasarana' => $sarana_prasarana,
							'daya_tarik' => $daya_tarik,
							'ditambahkan_oleh' => $this->session->userdata('id_administrator') // nanti ambil dari session login
						);

						$exists = $this->m_pariwisata->check($tahun, $objek_wisata);

						if($exists) {
							$update = $this->db->update('tb_pariwisata', $data, array('tahun' => $tahun, 'objek_wisata' => $objek_wisata));

							if($update) {
								$success += 1;

								$data['status'] = "<label class='badge badge-success'>Sukses</label>";
							} else {
								$data['status'] = "<label class='badge badge-danger'>Gagal</label>";
							}
						} else {
							$insert = $this->db->insert('tb_pariwisata', $data);

							if($insert) {
								$success += 1;

								$data['status'] = "<label class='badge badge-success'>Sukses</label>";
							} else {
								$data['status'] = "<label class='badge badge-danger'>Gagal</label>";
							}
						}

						array_push($arr, $data);
					}
				}
			}

			$this->session->set_userdata('subtitle', $success . " dari " . ($highestRow - 1) . " berhasil unggah.");
			
			$parser['result'] = $arr;

			$this->load->view('pariwisata/import_success', $parser);
		}
	}
}
