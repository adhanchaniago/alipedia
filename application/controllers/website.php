<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Website extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_admin', 'ADM', TRUE);
		$this->load->model('M_config', 'CONF', TRUE);
	}

	public function index()
	{
		if($this->session->userdata('logged_in') == TRUE) {
			$where_admin['admin_user']		= $this->session->userdata('admin_user');
			$data['admin']					= $this->ADM->get_admin('',$where_admin);
			$data['web']					= $this->ADM->identitaswebsite();
			$data['dashboard_info']			= TRUE;
            $data['breadcrumb']             = 'Dashboard';
			$data['content'] 				= 'admin/dashboard/statistik';
			$data['menu_terpilih']			= '1';
			$data['submenu_terpilih']		= '1';
			$this->load->vars($data);
			$this->load->view('admin/home');
		} else {
			redirect("wp_login");
		}
	}

	//FUNCTION IDENTITAS
    public function identitas($filter1='', $filter2='', $filter3='')
    {
		 if($this->session->userdata('logged_in') == TRUE) {
			$where_admin['admin_user']		= $this->session->userdata('admin_user');
			$data['admin']					= $this->ADM->get_admin('',$where_admin);
			$data['web']					= $this->ADM->identitaswebsite();
			@date_default_timezone_set('Asia/Jakarta');
			$data['dashboard_info']			= FALSE;
            $data['breadcrumb']             = 'Identitas Website';
			$data['content']				= 'admin/content/website/identitas';
			$data['menu_terpilih']			= '1';
			$data['submenu_terpilih']		= '1';
			$data['action']					= (empty($filter1))?'view':$filter1;
			$data['validate']				= array('identitas_website'=>'Nama Website',
													'identitas_deskripsi'=>'Deskripsi',
													'identitas_keyword'=>'Keyword',
													'identitas_notelp'=>'No Telepon',
													'identitas_email'=>'Email',
													'identitas_fb'=>'Facebook',
													'identitas_tw'=>'Twitter',
													'identitas_yb'=>'Youtube',
													'identitas_maps'=>'Koordinat Google Maps',
													'identitas_favicon' => 'Favicon');
			if($data['action'] == 'view' ) {
				$data['berdasarkan']		= array('identitas_website'=>'Identitas Website');
				$data['cari']				= ($this->input->post('cari'))?$this->input->post('cari'):'identitas_website';
				$data['q']					= ($this->input->post('q'))?$this->input->post('q'):'';
				$data['halaman']			= (empty($filter2))?1:$filter2;
				$data['batas']				= 10;
				$data['page']				= ($data['halaman']-1) * $data['batas'];
				$like_identitas[$data['cari']]	= $data['q'];
				$data['jml_data']			= $this->ADM->count_all_identitas('', $like_identitas);
				$data['jml_halaman']		= ceil($data['jml_data']/$data['batas']);
			} elseif ($data['action'] == 'tambah') {
				$data['onload']						= 'identitas_website';
				$data['identitas_website']			= ($this->input->post('identitas_website'))?$this->input->post('identitas_website'):'';
				$data['identitas_deskripsi']		= ($this->input->post('identitas_deskripsi'))?$this->input->post('identitas_deskripsi'):'';
				$data['identitas_keyword']			= ($this->input->post('identitas_keyword'))?$this->input->post('identitas_keyword'):'';
				$data['identitas_email']			= ($this->input->post('identitas_email'))?$this->input->post('identitas_email'):'';
				$data['identitas_fb']				= ($this->input->post('identitas_fb'))?$this->input->post('identitas_fb'):'';
				$data['identitas_tw']				= ($this->input->post('identitas_tw'))?$this->input->post('identitas_tw'):'';
				$data['identitas_gp']				= ($this->input->post('identitas_gb'))?$this->input->post('identitas_gp'):'';
				$data['identitas_yb']				= ($this->input->post('identitas_yb'))?$this->input->post('identitas_yb'):'';
				$data['identitas_maps']				= ($this->input->post('identitas_maps'))?$this->input->post('identitas_maps'):'';
				$data['identitas_favicon']			= ($this->input->post('identitas_favicon'))?$this->input->post('identitas_favicon'):'';
				$simpan								=  $this->input->post('simpan');
				if($simpan) {
					$insert['identitas_website']	= validasi_sql($data['identitas_website']);
					$insert['identitas_deskripsi']	= validasi_sql($data['identitas_deskripsi']);
					$insert['identitas_keyword']	= validasi_sql($data['identitas_keyword']);
					$insert['identitas_notelp']		= validasi_sql($data['identitas_notelp']);
					$insert['identitas_email']		= validasi_sql($data['identitas_email']);
					$insert['identitas_fb']			= validasi_sql($data['identitas_fb']);
					$insert['identitas_tw']			= validasi_sql($data['identitas_tw']);
					$insert['identitas_gp']			= validasi_sql($data['identitas_gp']);
					$insert['identitas_yb']			= validasi_sql($data['identitas_yb']);
					$insert['identitas_maps']			= validasi_sql($data['identitas_maps']);
					$insert['identitas_favicon']	= validasi_sql($data['identitas_favicon']);
					$this->ADM->insert_identitas($insert);
					$this->session->set_flashdata('success','Data identitas telah berhasil ditambahkan!,');
					redirect("website/identitas/edit/1");
				}
			} elseif ($data['action'] == 'edit') {
				$where['identitas_id'] 			=  $filter2;
				$data['onload']					= 'identitas_website';
				$where_identitas['identitas_id']= $filter2;
				$identitas						= $this->ADM->get_identitas('',$where_identitas);
				$data['identitas_id']			= ($this->input->post('identitas_id'))?$this->input->post('identitas_id'):$identitas->identitas_id;
				$data['identitas_website']		= ($this->input->post('identitas_website'))?$this->input->post('identitas_website'):$identitas->identitas_website;
				$data['identitas_deskripsi']	= ($this->input->post('identitas_deskripsi'))?$this->input->post('identitas_deskripsi'):$identitas->identitas_deskripsi;
				$data['identitas_keyword']		= ($this->input->post('identitas_keyword'))?$this->input->post('identitas_keyword'):$identitas->identitas_keyword;
				$data['identitas_alamat']		= ($this->input->post('identitas_alamat'))?$this->input->post('identitas_alamat'):$identitas->identitas_alamat;
				$data['identitas_notelp']		= ($this->input->post('identitas_notelp'))?$this->input->post('identitas_notelp'):$identitas->identitas_notelp;
				$data['identitas_email']		= ($this->input->post('identitas_email'))?$this->input->post('identitas_email'):$identitas->identitas_email;
				$data['identitas_fb']			= ($this->input->post('identitas_fb'))?$this->input->post('identitas_fb'):$identitas->identitas_fb;
				$data['identitas_tw']			= ($this->input->post('identitas_tw'))?$this->input->post('identitas_tw'):$identitas->identitas_tw;
				$data['identitas_gp']			= ($this->input->post('identitas_gp'))?$this->input->post('identitas_gp'):$identitas->identitas_gp;
				$data['identitas_yb']			= ($this->input->post('identitas_yb'))?$this->input->post('identitas_yb'):$identitas->identitas_yb;
				$data['identitas_maps']			= ($this->input->post('identitas_maps'))?$this->input->post('identitas_maps'):$identitas->identitas_maps;
				$data['identitas_favicon']		= ($this->input->post('identitas_favicon'))?$this->input->post('identitas_favicon'):$identitas->identitas_favicon;
				$simpan							= $this->input->post('simpan');
				if($simpan) {
					$gambar	= upload_image("identitas_favicon", "./assets/");
					$data['identitas_favicon']	= $gambar;
					$where_edit['identitas_id']				= validasi_sql($data['identitas_id']);
					$edit['identitas_website']				= validasi_sql($data['identitas_website']);
					$edit['identitas_deskripsi']			= validasi_sql($data['identitas_deskripsi']);
					$edit['identitas_keyword']				= validasi_sql($data['identitas_keyword']);
					$edit['identitas_alamat']				= validasi_sql($data['identitas_alamat']);
					$edit['identitas_notelp']				= validasi_sql($data['identitas_notelp']);
					$edit['identitas_email']				= validasi_sql($data['identitas_email']);
					$edit['identitas_fb']					= validasi_sql($data['identitas_fb']);
					$edit['identitas_tw']					= validasi_sql($data['identitas_tw']);
					$edit['identitas_gp']					= validasi_sql($data['identitas_gp']);
					$edit['identitas_yb']					= validasi_sql($data['identitas_yb']);
					$edit['identitas_maps']					= validasi_sql($data['identitas_maps']);
					if ($data['identitas_favicon']) {
						$row = $this->ADM->get_identitas('*', $where_edit);
						@unlink('./assets/'.$row->identitas_favicon);
						$edit['identitas_favicon']	= validasi_sql($data['identitas_favicon']);
					}
					$this->ADM->update_identitas($where_edit, $edit);
					$this->session->set_flashdata('success','Identitas Website telah berhasil diedit!,');
					redirect("website/identitas/edit/1");
				}
			} elseif ($data['action'] == 'hapus') {
				$where_delete['identitas_id']		= validasi_sql($filter2);
				$this->ADM->delete_identitas($where_delete);
				$this->session->set_flashdata('warning','Identitas Website telah berhasil dihapus!,');
				redirect("website/identitas/edit/1");
			}

			$this->load->vars($data);
			$this->load->view('admin/home');
		 } else {
			 redirect("wp_login");
			}
    }

	//FUNCTION KATEGORI
	public function kategori($filter1='', $filter2='', $filter3='')
	{
		if ($this->session->userdata('logged_in') == TRUE){
			error_reporting(0);
			$where_admin['admin_user'] 	= $this->session->userdata('admin_user');
			$data['admin'] 				= $this->ADM->get_admin('',$where_admin);
			$data['web']				= $this->ADM->identitaswebsite();
			@date_default_timezone_set('Asia/Jakarta');
			$data['dashboard_info']		= FALSE;
            $data['breadcrumb']         = 'Daftar Kategori';
			$data['content'] 			= 'admin/content/website/kategori';
			$data['menu_terpilih']		= '1';
			$data['submenu_terpilih']	= '1';
			$data['action']				= (empty($filter1))?'view':$filter1;
			$data['validate']		= array('kategori_jenis'=>'Jenis Kategori');
			if ($data['action'] == 'view'){
				$data['berdasarkan']		= array('kategori_jenis'=>'Jenis Kategori');
				$data['cari']				= ($this->input->post('cari'))?$this->input->post('cari'):'kategori_jenis';
				$data['q']					= ($this->input->post('q'))?$this->input->post('q'):'';
				$data['halaman']			= (empty($filter2))?1:$filter2;
				$data['batas']				= 20;
				$data['page']				= ($data['halaman']-1) * $data['batas'];
				$like_kategori[$data['cari']]	= $data['q'];
				$data['jml_data']			= $this->ADM->count_all_kategori("", $like_kategori);
				$data['jml_halaman'] 		= ceil($data['jml_data']/$data['batas']);
			} elseif ($data['action'] == 'tambah'){
				$data['onload']				= 'kategori_jenis';
				$data['kategori_jenis']			= ($this->input->post('kategori_jenis'))?$this->input->post('kategori_jenis'):'';
				$data['kategori_icon']			= ($this->input->post('kategori_icon'))?$this->input->post('kategori_icon'):'';
				$simpan						= $this->input->post('simpan');
				if ($simpan){
					$insert['kategori_jenis']	= validasi_sql($data['kategori_jenis']);
					$insert['kategori_icon']	= validasi_sql($data['kategori_icon']);
					$insert['kategori_created']	= date("Y-m-d H:i:s");
					$this->ADM->insert_kategori($insert);
					$this->session->set_flashdata('success','Kategori baru telah berhasil ditambahkan!,');
					redirect("website/kategori");
				}
			} elseif ($data['action'] == 'edit'){
				$where['kategori_id']	= $filter2;
				$data['onload']				= 'kategori_jenis';
				$where_kategori['kategori_id']	= $filter2;
				$kategori 						= $this->ADM->get_kategori('*', $where_kategori);
				$data['kategori_id']			= ($this->input->post('kategori_id'))?$this->input->post('kategori_id'):$kategori->kategori_id;
				$data['kategori_jenis']		= ($this->input->post('kategori_jenis'))?$this->input->post('kategori_jenis'):$kategori->kategori_jenis;
				$data['kategori_icon']		= ($this->input->post('kategori_icon'))?$this->input->post('kategori_icon'):$kategori->kategori_icon;
				$simpan						= $this->input->post('simpan');
				if ($simpan){
					$where_edit['kategori_id']= validasi_sql($data['kategori_id']);
					$edit['kategori_jenis']		= validasi_sql($data['kategori_jenis']);
					$edit['kategori_icon']		= validasi_sql($data['kategori_icon']);
					$this->ADM->update_kategori($where_edit, $edit);
					$this->session->set_flashdata('warning','Kategori baru telah berhasil diedit!,');
					redirect("website/kategori");
				}
			} elseif ($data['action'] == 'hapus'){
				$where_delete['kategori_id']		= validasi_sql($filter2);
				$this->ADM->delete_kategori($where_delete);
				$this->session->set_flashdata('warning','Kategori telah berhasil dihapus!,');
				redirect("website/kategori");
			}
			$this->load->vars($data);
			$this->load->view('admin/home');
		} else {
			redirect("wp_login");
		}
	}

		//FUNCTION Rekening
		public function rekening($filter1='', $filter2='', $filter3='')
		{
			if ($this->session->userdata('logged_in') == TRUE){
				error_reporting(0);
				$where_admin['admin_user'] 	= $this->session->userdata('admin_user');
				$data['admin'] 				= $this->ADM->get_admin('',$where_admin);
				$data['web']				= $this->ADM->identitaswebsite();
				@date_default_timezone_set('Asia/Jakarta');
				$data['dashboard_info']		= FALSE;
				$data['breadcrumb']         = 'Daftar Rekening';
				$data['content'] 			= 'admin/content/website/rekening';
				$data['menu_terpilih']		= '1';
				$data['submenu_terpilih']	= '1';
				$data['action']				= (empty($filter1))?'view':$filter1;
				if ($data['action'] == 'view'){
			
				} elseif ($data['action'] == 'tambah'){
				
				} elseif ($data['action'] == 'edit'){
					$where['admin_user']	= $filter2;
					$data['onload']				= 'admin_user';
					$where_toko['admin_user']	= $filter2;
					$toko 						= $this->ADM->get_toko('*', $where_toko);
					$data['toko_id']			= ($this->input->post('toko_id'))?$this->input->post('toko_id'):$toko->toko_id;
					$data['toko_bank']		= ($this->input->post('toko_bank'))?$this->input->post('toko_bank'):$toko->toko_bank;
					$data['toko_norek']		= ($this->input->post('toko_norek'))?$this->input->post('toko_norek'):$toko->toko_norek;
					$data['toko_atasnama']		= ($this->input->post('toko_atasnama'))?$this->input->post('toko_atasnama'):$toko->toko_atasnama;
					$simpan						= $this->input->post('simpan');
					if ($simpan){
						$where_edit['toko_id']= validasi_sql($data['toko_id']);
						$edit['toko_bank']		= validasi_sql($data['toko_bank']);
						$edit['toko_norek']		= validasi_sql($data['toko_norek']);
						$edit['toko_atasnama']		= validasi_sql($data['toko_atasnama']);
						$this->ADM->update_toko($where_edit, $edit);
						$this->session->set_flashdata('warning','Rekening telah berhasil diedit!,');
						redirect("website/rekening/edit/admin");
					}
				} elseif ($data['action'] == 'hapus'){
			
				}
				$this->load->vars($data);
				$this->load->view('admin/home');
			} else {
				redirect("wp_login");
			}
		}

	//FUNCTION PRODUK
	public function produk($filter1='', $filter2='', $filter3='')
	{
		if ($this->session->userdata('logged_in') == TRUE){
			error_reporting(0);
			$where_admin['admin_user'] 	= $this->session->userdata('admin_user');
			$data['admin'] 				= $this->ADM->get_admin('',$where_admin);
			$data['web']				= $this->ADM->identitaswebsite();
			@date_default_timezone_set('Asia/Jakarta');
			$data['dashboard_info']		= FALSE;
            $data['breadcrumb']         = 'Daftar Produk';
			$data['content'] 			= 'admin/content/website/produk';
			$data['menu_terpilih']		= '1';
			$data['submenu_terpilih']	= '1';
			$data['action']				= (empty($filter1))?'view':$filter1;
			$data['validate']		= array('produk_nama'=>'Produk Nama');
			if ($data['action'] == 'view'){
				$data['berdasarkan']		= array('produk_nama'=>'Produk Nama');
				$data['cari']				= ($this->input->post('cari'))?$this->input->post('cari'):'produk_nama';
				$data['q']					= ($this->input->post('q'))?$this->input->post('q'):'';
				$data['halaman']			= (empty($filter2))?1:$filter2;
				$data['batas']				= 20;
				$data['page']				= ($data['halaman']-1) * $data['batas'];
				$like_produk[$data['cari']]	= $data['q'];
				$data['jml_data']			= $this->ADM->count_all_produk("", $like_produk);
				$data['jml_halaman'] 		= ceil($data['jml_data']/$data['batas']);
			} elseif ($data['action'] == 'hapus'){
				$where_delete['produk_id']		= validasi_sql($filter2);
				$this->ADM->delete_produk($where_delete);
				$this->session->set_flashdata('warning','Produk telah berhasil dihapus!,');
				redirect("website/produk");
			}
			$this->load->vars($data);
			$this->load->view('admin/home');
		} else {
			redirect("wp_login");
		}
	}

	public function kategori_detail($kategori_id="")
	{
		if ($this->session->userdata('logged_in') == TRUE){
			$where_admin['admin_user'] 	= $this->session->userdata('admin_user');
			$data['admin'] 				= $this->ADM->get_admin('',$where_admin);
			$data['web']					= $this->ADM->identitaswebsite();
			$where_kategori['kategori_id']= $kategori_id;
			$data['kategori'] 			= $this->ADM->get_kategori('*', $where_kategori);
			$data['action']			= 'detail';
			$this->load->vars($data);
			$this->load->view('admin/content/website/kategori');
		} else {
			redirect("wp_login");
		}
	}

	//FUNCTION TOKO
	public function toko($filter1='', $filter2='', $filter3='')
	{
		if ($this->session->userdata('logged_in') == TRUE){
			error_reporting(0);
			$where_admin['admin_user'] 	= $this->session->userdata('admin_user');
			$data['admin'] 				= $this->ADM->get_admin('',$where_admin);
			$data['web']				= $this->ADM->identitaswebsite();
			@date_default_timezone_set('Asia/Jakarta');
			$data['dashboard_info']		= FALSE;
            $data['breadcrumb']         = 'Daftar Toko';
			$data['content'] 			= 'admin/content/website/toko';
			$data['menu_terpilih']		= '1';
			$data['submenu_terpilih']	= '1';
			$data['action']				= (empty($filter1))?'view':$filter1;
			$data['validate']		= array('toko_nama'=>'Nama Toko');
			if ($data['action'] == 'view'){
				$data['berdasarkan']		= array('toko_nama'=>'Nama Toko');
				$data['cari']				= ($this->input->post('cari'))?$this->input->post('cari'):'toko_nama';
				$data['q']					= ($this->input->post('q'))?$this->input->post('q'):'';
				$data['halaman']			= (empty($filter2))?1:$filter2;
				$data['batas']				= 10;
				$data['page']				= ($data['halaman']-1) * $data['batas'];
				$like_toko[$data['cari']]	= $data['q'];
				$data['jml_data']			= $this->ADM->count_all_toko("", $like_toko);
				$data['jml_halaman'] 		= ceil($data['jml_data']/$data['batas']);
			$this->load->vars($data);
			$this->load->view('admin/home');
			}
		} else {
			redirect("wp_login");
		}
	}

	//FUNCTION TOKO
	public function transaksiall($filter1='', $filter2='', $filter3='')
	{
		if ($this->session->userdata('logged_in') == TRUE){
			error_reporting(0);
			$where_admin['admin_user'] 	= $this->session->userdata('admin_user');
			$data['admin'] 				= $this->ADM->get_admin('',$where_admin);
			$data['web']				= $this->ADM->identitaswebsite();
			@date_default_timezone_set('Asia/Jakarta');
			$data['dashboard_info']		= FALSE;
            $data['breadcrumb']         = 'Daftar Transaksi';
			$data['content'] 			= 'admin/content/website/transaksiall';
			$data['menu_terpilih']		= '1';
			$data['submenu_terpilih']	= '1';
			$data['action']				= (empty($filter1))?'view':$filter1;
			$data['validate']		= array('transaksi_id'=>'No Transaksi');
			if ($data['action'] == 'view'){
				$data['berdasarkan']		= array('transaksi_id'=>'No Transaksi');
				$data['cari']				= ($this->input->post('cari'))?$this->input->post('cari'):'transaksi_id';
				$data['q']					= ($this->input->post('q'))?$this->input->post('q'):'';
				$data['halaman']			= (empty($filter2))?1:$filter2;
				$data['batas']				= 10;
				$data['page']				= ($data['halaman']-1) * $data['batas'];
				$like_transaksi[$data['cari']]	= $data['q'];
				$data['jml_data']			= $this->ADM->count_all_transaksi("", $like_transaksi);
				$data['jml_halaman'] 		= ceil($data['jml_data']/$data['batas']);
			$this->load->vars($data);
			$this->load->view('admin/home');
			}
		} else {
			redirect("wp_login");
		}
	}

	//Fungsi Transaksi
	public function transaksi($filter1='', $filter2='', $filter3='')
	{
		if($this->session->userdata('logged_in') == TRUE){
			$where_admin['admin_user']		= $this->session->userdata('admin_user');
			$data['admin']					= $this->ADM->get_admin('',$where_admin);
			$data['web']					= $this->ADM->identitaswebsite();
			$data['dashboard_info']			= TRUE;
     		$data['breadcrumb']             = 'Home';
			$data['content']				= 'admin/content/website/transaksi';
			$data['menu_terpilih']			= '1';
			$data['submenu_terpilih']		= '1';
			$data['action']				= (empty($filter1))?'view':$filter1;
			if ($data['action'] == 'view') {
				$data['berdasarkan']		= array('invoice_id'=>'No Invoice');
				$data['cari']				= ($this->input->post('cari'))?$this->input->post('cari'):'invoice_id';
				$data['q']					= ($this->input->post('q'))?$this->input->post('q'):'';
				$data['halaman']			= (empty($filter2))?1:$filter2;
				$data['batas']				= 4;
				$data['page']				= ($data['halaman']-1) * $data['batas'];
				$like_invoice[$data['cari']]	= $data['q'];
				$data['jml_data']			= $this->ADM->count_all_invoice("", $like_invoice);
				$data['jml_halaman'] 		= ceil($data['jml_data']/$data['batas']);
			}
			$this->load->vars($data);
			$this->load->view('admin/home');
		} else {
			redirect("wp_login");
		}
	}

	//Fungsi Konfirmasi Pembayaran
	public function konfirmasipembayarantoko($transaksi_id="")
	{
		if ($this->session->userdata('logged_in') == TRUE){
			$where_admin['admin_user'] 			= $this->session->userdata('admin_user');
			$data['admin'] 						= $this->ADM->get_admin('',$where_admin);
			$data['web']						= $this->ADM->identitaswebsite();
			$where_transaksi['transaksi_id']	= $transaksi_id;
			$data['transaksi'] 					= $this->ADM->get_transaksi('*', $where_transaksi);
			$data['action']						= 'toko';
			 
			$data['transaksi_bukti']	= ($this->input->post('transaksi_bukti'))?$this->input->post('transaksi_bukti'):'';
			$simpan					= $this->input->post('simpan');
			if ($simpan){
				$gambar	= upload_image("transaksi_bukti", "./assets/images/transaksi/", "400x400");
				$data['transaksi_bukti']	= $gambar;
				if ($data['transaksi_bukti']) { 
					$edit['transaksi_bukti']	= $data['transaksi_bukti']; 
				}
				$edit['transaksi_statusadmin']	= "paid";
				$this->ADM->update_transaksi($where_transaksi, $edit);
				$this->session->set_flashdata('success','Konfirmasi Pembayaran Toko Telah Berhasil!');
				redirect("website/transaksi");
			}
			$this->load->vars($data);
			$this->load->view('admin/content/website/transaksi');
		} else {
			redirect("wp_login");
		}
	}

	//Fungsi Konfirmasi Pembayaran
	public function konfirmasipembayaranpembeli($invoice_id="")
	{
		if ($this->session->userdata('logged_in') == TRUE){
			$where_admin['admin_user'] 			= $this->session->userdata('admin_user');
			$data['admin'] 						= $this->ADM->get_admin('',$where_admin);
			$data['web']						= $this->ADM->identitaswebsite();
			$where_invoice['invoice_id']	= $invoice_id;
			$data['invoice'] 					= $this->ADM->get_invoice('*', $where_invoice);
			$data['action']						= 'pembeli';
			 
			$data['invoice_resi']	= ($this->input->post('invoice_resi'))?$this->input->post('invoice_resi'):'';
			$data['invoice_dikirim']	= ($this->input->post('invoice_dikirim'))?$this->input->post('invoice_dikirim'):'';
			$data['invoice_sampai']	= ($this->input->post('invoice_sampai'))?$this->input->post('invoice_sampai'):'';
			$simpan					= $this->input->post('simpan');
			if ($simpan){
				$gambar	= upload_image("invoice_resi", "./assets/images/resi/", "400x400");
				$data['invoice_resi']	= $gambar;
				if ($data['invoice_resi']) { 
					$edit['invoice_resi']	= $data['invoice_resi']; 
				}

				$edit['invoice_dikirim']	= $data['invoice_dikirim'];
				$edit['invoice_sampai']	= $data['invoice_sampai'];
				$edit['invoice_confirm']	= "true";
				$this->ADM->update_invoice($where_invoice, $edit);

				$edit2['transaksi_end']	= "true";
				$this->ADM->update_transaksi($where_invoice, $edit2);
				$this->session->set_flashdata('success','Konfirmasi Pembelian Ke pembeli Telah Berhasil!');
				redirect("website/transaksi");
			}
			$this->load->vars($data);
			$this->load->view('admin/content/website/transaksi');
		} else {
			redirect("wp_login");
		}
	}
	
	private function ckeditor($text) {
		return '
		<script type="text/javascript" src="'.base_url().'editor/ckeditor.js"></script>
		<script type="text/javascript">
		var editor = CKEDITOR.replace("'.$text.'",
		{
			filebrowserBrowseUrl 	  : "'.base_url().'finder/ckfinder.html",
			filebrowserImageBrowseUrl : "'.base_url().'finder/ckfinder.html?Type=Images",
			filebrowserFlashBrowseUrl : "'.base_url().'finder/ckfinder.html?Type=Flash",
			filebrowserUploadUrl 	  : "'.base_url().'finder/core/connector/php/connector.php?command=QuickUpload&type=Files",
			filebrowserImageUploadUrl : "'.base_url().'finder/core/connector/php/connector.php?command=QuickUpload&type=Images",
			filebrowserFlashUploadUrl : "'.base_url().'finder/core/connector/php/connector.php?command=QuickUpload&type=Flash",
			filebrowserWindowWidth    : 900,
			filebrowserWindowHeight   : 700,
			toolbarStartupExpanded 	  : false,
			height					  : 400
		}
		);
	</script>';
	}
}