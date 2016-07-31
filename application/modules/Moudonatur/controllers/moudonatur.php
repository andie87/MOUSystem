<!--
* Author : Ahmad Shodiqi
-->
<?php

class Moudonatur extends CI_Controller{

	function __constract(){
		parent::__constract();
	}

	public function index(){

		$data = $this->page_view("List MoU dengan Donatur");
		if(strlen($this->session->flashdata('message')) > 0){
			$data['message'] = $this->session->flashdata('message');
		}
		if(strlen($this->session->flashdata('message_failed')) > 0){
			$data['message_failed'] = $this->session->flashdata('message_failed');
		}
		$data['moudonaturs'] = $this->m_moudonatur->getAll();
		$data['jenis_proyek_array'] = $this->m_moudonatur->get_jenis_proyek_array();
		$arr_proyek = array();
		foreach($data['jenis_proyek_array'] as $r){
			$arr_proyek[$r['id_jenis_proyek']] = $r['nama_proyek'];
		}
		$data['arr_proyek'] = $arr_proyek;
		$this->load->view('shared/header', $data);
		$this->load->view('index', $data);
		$this->load->view('shared/footer');
		
	}

	public function create(){
		
		$data = $this->page_view("MoU Baru");
		$data['donaturs'] = $this->m_moudonatur->get_donatur();
		$data['provins'] = $this->m_moudonatur->get_provinsi();
		$data['proyeks'] = $this->m_moudonatur->get_jenis_proyek();
		$this->load->view('shared/header', $data);
		$this->load->view('create', $data);
		$this->load->view('shared/footer');
	}
	
	public function edit(){
		
		$page_title = "Edit MoU";
		$id = $this->uri->segment('3');
		$this->master_edit($id, $page_title);
				
	}
	
	public function view(){
		
		$page_title = "View MoU";
		$id = $this->uri->segment('3');
		$this->master_view($id, $page_title);
				
	}
	
	public function delete(){
		
		$data = $this->page_view("List Role");
		$id = $this->input->post('id');
		$arr = array( 'id_mou_donatur' => $id );
		$result = $this->m_moudonatur->delete_data($arr);
		if($result == 1){
			$this->session->set_flashdata('message', 'MoU Donatur berhasil dihapus...');
		} else {
			$this->session->set_flashdata('message_failed', 'MoU Donatur gagal dihapus!');
		}
  		redirect(site_url().'/moudonatur');
		
	}

	public function prosesCreate(){
		
		$data = $this->page_view("List MoU Donatur");
		
		$donatur = $this->input->post('donatur');
		$no_proyek = $this->input->post('no_proyek');
		$nama_proyek = $this->input->post('nama_proyek');
		$alamat_proyek = $this->input->post('alamat_proyek');
		$provinsi = $this->input->post('provinsi');
		$kota = $this->input->post('kota');
		$jenis_proyek = $this->input->post('jenis_proyek');
		$desc_proyek = $this->input->post('desc_proyek');
		$dirham = str_replace(".", "", $this->input->post('dirham'));
		$rupiah = str_replace(".", "", $this->input->post('rupiah'));
		$tgl_pembangunan = getMysqlFormatDate($this->input->post('tgl_pembangunan')); 
		$tgl_mou = getMysqlFormatDate($this->input->post('tgl_mou')); 
		
		$arr = array( 'id_donatur' => $donatur,
						'tanggal_mou' => $tgl_mou,
						'nomor_proyek' => $no_proyek,
						'nama_proyek' => $nama_proyek,
						'alamat_proyek' => $alamat_proyek,
						'id_provinsi' => $provinsi,
						'id_kota_kab' => $kota,
						'id_jenis_proyek' => $jenis_proyek,
						'deskripsi_proyek' => $desc_proyek,
						'harga_dirham' => $dirham,
						'harga_rupiah' => $rupiah,
						'tanggal_pembangunan' => $tgl_pembangunan,
		 			);
		 			
		$result = $this->m_moudonatur->input_data($arr);

		if($result == 1){
			$this->session->set_flashdata('message', 'MoU baru berhasil ditambahkan...');
	  		redirect(site_url().'/moudonatur');
		} else {
			$data = $this->page_view("Tambah MoU Donatur");
			$data['message'] = "MoU baru gagal ditambahkan, silakan input kembali...";
			$this->load->view('shared/header', $data);
			$this->load->view('create', $data);
			$this->load->view('shared/footer');
		}
		
	}
	
	public function prosesUpdate(){
		
		$data = $this->page_view("List MoU Donatur");
		
		$donatur = $this->input->post('donatur');
		$no_proyek = $this->input->post('no_proyek');
		$nama_proyek = $this->input->post('nama_proyek');
		$alamat_proyek = $this->input->post('alamat_proyek');
		$provinsi = $this->input->post('provinsi');
		$kota = $this->input->post('kota');
		$jenis_proyek = $this->input->post('jenis_proyek');
		$desc_proyek = $this->input->post('desc_proyek');
		$dirham = str_replace(".", "", $this->input->post('dirham'));
		$rupiah = str_replace(".", "", $this->input->post('rupiah'));
		$tgl_pembangunan = getMysqlFormatDate($this->input->post('tgl_pembangunan')); 
		$tgl_mou = getMysqlFormatDate($this->input->post('tgl_mou')); 
		$progress = $this->input->post('progress');
		$id_mou_donatur = $this->input->post('mou_donatur');
		
		$arr = array( 'id_donatur' => $donatur,
						'tanggal_mou' => $tgl_mou,
						'nomor_proyek' => $no_proyek,
						'nama_proyek' => $nama_proyek,
						'alamat_proyek' => $alamat_proyek,
						'id_provinsi' => $provinsi,
						'id_kota_kab' => $kota,
						'id_jenis_proyek' => $jenis_proyek,
						'deskripsi_proyek' => $desc_proyek,
						'harga_dirham' => $dirham,
						'harga_rupiah' => $rupiah,
						'tanggal_pembangunan' => $tgl_pembangunan,
						'progress' => $progress,
		 			);
		
		$result = $this->m_moudonatur->update_data($arr, $id_mou_donatur);

		if($result == 1){
			$this->session->set_flashdata('message', 'MoU berhasil diperbarui...');
	  		redirect(site_url().'/moudonatur');
		} else {
			$page_title = "Edit MoU Donatur";
			$message = "MoU gagal diperbarui, silakan input kembali...";
			$this->master_edit($id_role, $page_title, $message);
		}
		
	}
	
	private function master_edit($id, $page_title, $message=null){
		
		$data = $this->page_view($page_title);
		$data['donaturs'] = $this->m_moudonatur->get_donatur();
		$data['provins'] = $this->m_moudonatur->get_provinsi();
		$data['proyeks'] = $this->m_moudonatur->get_jenis_proyek();
		$data['message'] = $message;
		$moudonaturs = $this->m_moudonatur->getMoudonaturById($id);
		$data['kotas'] = $this->m_moudonatur->get_kotakab_by_prov($moudonaturs[0]['id_provinsi']);
		if($moudonaturs == null){
			//jika ID bernilai null, besar kemungkinan user melakukan direct hit url ke server
			redirect(site_url().'/login');
		} else {
			if($moudonaturs){
				foreach($moudonaturs as $m){
					$data['moudonatur'] = $m;
				}
			} else {
				$data['moudonatur'] = null;
			}
		}
		$data['moudonatur']['tanggal_mou'] = getUserFormatDate($data['moudonatur']['tanggal_mou']); 
		$data['moudonatur']['tanggal_pembangunan'] = getUserFormatDate($data['moudonatur']['tanggal_pembangunan']); 
		$this->load->view('shared/header', $data);
		$this->load->view('edit', $data);
		$this->load->view('shared/footer');
		
	}
	
	private function master_view($id, $page_title, $message=null){
		
		$data = $this->page_view($page_title);
		$data['donaturs'] = $this->m_moudonatur->get_donatur();
		$data['provins'] = $this->m_moudonatur->get_provinsi();
		$data['proyeks'] = $this->m_moudonatur->get_jenis_proyek();
		$data['message'] = $message;
		$moudonaturs = $this->m_moudonatur->getMoudonaturById($id);
		$data['kotas'] = $this->m_moudonatur->get_kotakab_by_prov($moudonaturs[0]['id_provinsi']);
		if($moudonaturs == null){
			//jika ID bernilai null, besar kemungkinan user melakukan direct hit url ke server
			redirect(site_url().'/login');
		} else {
			if($moudonaturs){
				foreach($moudonaturs as $m){
					$data['moudonatur'] = $m;
				}
			} else {
				$data['moudonatur'] = null;
			}
		}
		$data['moudonatur']['tanggal_mou'] = getUserFormatDate($data['moudonatur']['tanggal_mou']); 
		$data['moudonatur']['tanggal_pembangunan'] = getUserFormatDate($data['moudonatur']['tanggal_pembangunan']); 
		$this->load->view('shared/header', $data);
		$this->load->view('view', $data);
		$this->load->view('shared/footer');
		
	}
	
	private function page_view($page){
		
		//no user session, redirect to login page
		if($this->session->userdata('userlogin')==""){
			redirect(site_url().'/login');
		}
		
		$data['page'] = $page;
		$data['menuaktif'] = "moudonatur";
		return $data;
	
	}
	
	public function selectkotakab(){
		
		$id = $this->uri->segment('3');
		$data['kotas'] = $this->m_moudonatur->get_kotakab_by_prov($id);
		$this->load->view('selectkotakab', $data);
		
	}
	
}
?>