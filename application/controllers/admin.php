<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_admin', 'ADM', TRUE);
		$this->load->model('M_config', 'CONF', TRUE);
	}

	public function index()
	{
		if($this->session->userdata('logged_in') == TRUE){
			$where_admin['admin_user']		= $this->session->userdata('admin_user');
			$data['admin']					= $this->ADM->get_admin('',$where_admin);
			$data['web']					= $this->ADM->identitaswebsite();
			$data['dashboard_info']			= TRUE;
      $data['breadcrumb']             = 'Dashboard';
			$data['dashboard']				= 'admin/dashboard/statistik';
			$data['content']				= 'admin/dashboard/statistik';
			$data['jml_data_admin']		= $this->ADM->count_all_admin('');
			$data['jml_data_toko']		= $this->ADM->count_all_toko('');
			$data['jml_data_transaksi']		= $this->ADM->count_all_transaksi('');
			$data['jml_data_produk']	= $this->ADM->count_all_produk('');
			$data['menu_terpilih']			= '1';
			$data['submenu_terpilih']		= '1';
			$this->load->vars($data);
			$this->load->view('admin/home');
		} else {
			redirect("wp_login");
		}
	 }

	 //Fungsi Ubah Kata Sandi
	 public function edit_password($filter1='', $filter2='', $filter3='')
	 {
		 if ($this->session->userdata('logged_in') == TRUE) {
			 $where_admin['admin_user']			= $this->session->userdata('admin_user');
			 $data['web']					= $this->ADM->identitaswebsite();
			 $data['admin']						= $this->ADM->get_admin('',$where_admin);
			 @date_default_timezone_set('Asia/Jakarta');
			 $data['dashboard_info']			= FALSE;
			 $data['content']					= 'admin/content/pengaturan/edit_password';
			 $data['menu_terpilih']				= '1';
			 $data['submenu_terpilih']			= '';
			 $data['validasi']					= array('admin_pass_recent'=>'Password Sekarang','admin_pass'=>'Password Baru','admin_pass_ulang'=>'Password Baru');

			 $data['admin_user']				= $this->session->userdata('admin_user');
			 $data['admin_pass_recent']			= ($this->input->post('admin_pass_recent'))?$this->input->post('admin_pass_recent'):'';
			 $data['admin_pass']				= ($this->input->post('admin_pass'))?$this->input->post('admin_pass'):'';
			 $data['admin_pass_ulang']			= ($this->input->post('admin_pass_ulang'))?$this->input->post('admin_pass_ulang'):'';
			 $data['admin_pass2']				= ($this->input->post('admin_pass2'))?$this->input->post('admin_pass2'):'';

			 $simpan							= $this->input->post('simpan');
			 if($simpan){
				 if(do_hash($data['admin_pass_recent'], 'md5') == $data['admin']->admin_pass) {
					if($data['admin_pass'] == $data['admin_pass_ulang']) {
						$where_edit['admin_user']	= validasi_sql($data['admin_user']);
						if($data['admin_pass'] <> '') {
							$edit['admin_pass']		= validasi_sql(do_hash(($data['admin_pass']), 'md5'));
							$edit['admin_pass2']		= validasi_sql($data['admin_pass']);
						}
						$this->ADM->update_admin($where_edit, $edit);
						$this->session->set_flashdata('success','Password Berhasil Diubah!,');
							redirect("admin/edit_password");

					} else {
						$this->session->set_flashdata('error','Password Tidak Sesuai!,');
						redirect("admin/edit_password");
					}
				} else {
					$this->session->set_flashdata('warning','Password Sekarang Salah!,');
					redirect("admin/edit_password");
				}
			}
		$this->load->vars($data);
		$this->load->view('admin/home');
		} else {
			redirect("wp_login");
		}
	}
}