<!--
* Author : Andi Mulya I
-->
<?php

class Moueksekutor extends CI_Controller{

	function __constract(){
		parent::__constract();
	}

	public function index(){

		$data = $this->page_view("List MoU dengan Eksekutor");
		if(strlen($this->session->flashdata('message')) > 0){
			$data['message'] = $this->session->flashdata('message');
		}
		if(strlen($this->session->flashdata('message_failed')) > 0){
			$data['message_failed'] = $this->session->flashdata('message_failed');
		}
		$data['moueksekutors'] = $this->m_moueksekutor->getAll();
		$data['jenis_proyek_array'] = $this->m_moueksekutor->get_jenis_proyek_array();
		$arr_proyek = array();
		foreach($data['jenis_proyek_array'] as $r){
			$arr_proyek[$r['id_jenis_proyek']] = $r['nama_proyek'];
		}
		$data['eksekutor_array'] = $this->m_moueksekutor->get_eksekutor_array();
		$arr_eksekutor = array();
		foreach($data['eksekutor_array'] as $r){
			$arr_eksekutor[$r['id_eksekutor']] = $r['nama_eksekutor'];
		}
		$data['arr_eksekutor'] = $arr_eksekutor;
		$data['arr_proyek'] = $arr_proyek;
		$this->load->view('shared/header', $data);
		$this->load->view('index', $data);
		$this->load->view('shared/footer');
		
	}

	public function create(){
		
		$data = $this->page_view("MoU Baru");
		$data['eksekutors'] = $this->m_moueksekutor->get_eksekutor();
		$data['moudonatur'] = $this->m_moueksekutor->get_moudonatur();
		$data['provins'] = $this->m_moueksekutor->get_provinsi();
		$data['proyeks'] = $this->m_moueksekutor->get_jenis_proyek();
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
		$arr = array( 'id_mou_eksekutor' => $id );
		$result = $this->m_moueksekutor->delete_data($arr);
		if($result == 1){
			$this->session->set_flashdata('message', 'MoU Eksekutor berhasil dihapus...');
		} else {
			$this->session->set_flashdata('message_failed', 'MoU Eksekutor gagal dihapus!');
		}
  		redirect(site_url().'/moueksekutor');
		
	}

	public function prosesCreate(){
		
		$data = $this->page_view("List MoU Eksekutor");
		
		$id_eksekutor = $this->input->post('id_eksekutor');
		$id_mou_donatur = $this->input->post('id_mou_donatur');
		$tanggal_mou = getMysqlFormatDate($this->input->post('tanggal_mou')); 
		$tanggal_mou_hijriah = $this->input->post('tanggal_mou_hijriah'); 
		$tanggal_pengerjaan = getMysqlFormatDate($this->input->post('tanggal_pengerjaan')); 
		$nama_eksekutor = $this->input->post('nama_eksekutor');
		$alamat_eksekutor = $this->input->post('alamat_eksekutor');
		$jabatan_eksekutor = $this->input->post('jabatan_eksekutor');
		$kontak_eksekutor = $this->input->post('kontak_eksekutor');
		$nama_proyek = $this->input->post('nama_proyek');
		$id_jenis_proyek = $this->input->post('id_jenis_proyek');
		$deskripsi_proyek = $this->input->post('deskripsi_proyek');
		$ukuran = $this->input->post('ukuran');
		$provinsi = $this->input->post('provinsi');
		$kota = $this->input->post('kota');
		$alamat_lokasi = $this->input->post('alamat_lokasi');
		$koordinat_lokasi = $this->input->post('koordinat_lokasi');
		$nilai_proyek = str_replace(".", "", $this->input->post('nilai_proyek'));
		$is_banner = $this->input->post('is_banner');
		$is_prasasti = $this->input->post('is_prasasti');
		$pic_lokasi = $this->input->post('pic_lokasi');
		$kontak_pic_lokasi = $this->input->post('kontak_pic_lokasi');
		$alamat_pic_lokasi = $this->input->post('alamat_pic_lokasi');
		$nama_bangunan_di_lokasi = $this->input->post('nama_bangunan_di_lokasi');
		$tanggal_selesai = getMysqlFormatDate($this->input->post('tanggal_selesai')); 
		
		
		$arr = array( 'id_eksekutor' => $id_eksekutor,
						'id_mou_donatur' => $id_mou_donatur,
						'tanggal_mou' => $tanggal_mou, 
						'tanggal_mou_hijriah' => $tanggal_mou_hijriah, 
						'tanggal_pengerjaan' => $tanggal_pengerjaan, 
						'nama_eksekutor' => $nama_eksekutor,
						'alamat_eksekutor' => $alamat_eksekutor,
						'jabatan_eksekutor' => $jabatan_eksekutor,
						'kontak_eksekutor' => $kontak_eksekutor,
						'nama_proyek' => $nama_proyek,
						'id_jenis_proyek' => $id_jenis_proyek,
						'deskripsi_proyek' => $deskripsi_proyek,
						'ukuran' => $ukuran,
						'id_provinsi' => $provinsi,
						'id_kota_kab' => $kota,
						'alamat_lokasi' => $alamat_lokasi,
						'koordinat_lokasi' => $koordinat_lokasi,
						'nilai_proyek' => $nilai_proyek,
						'is_banner' => $is_banner,
						'is_prasasti' => $is_prasasti,
						'pic_lokasi' => $pic_lokasi,
						'kontak_pic_lokasi' => $kontak_pic_lokasi,
						'alamat_pic_lokasi' => $alamat_pic_lokasi,
						'nama_bangunan_di_lokasi' => $nama_bangunan_di_lokasi,
						'tanggal_selesai' => $tanggal_selesai
		 			);
		 			
		$result = $this->m_moueksekutor->input_data($arr);

		if($result == 1){
			$this->session->set_flashdata('message', 'MoU baru berhasil ditambahkan...');
	  		redirect(site_url().'/moueksekutor');
		} else {
			$data = $this->page_view("Tambah MoU Eksekutor");
			$data['message'] = "MoU baru gagal ditambahkan, silakan input kembali...";
			$data['eksekutors'] = $this->m_moueksekutor->get_eksekutor();
			$data['moudonatur'] = $this->m_moueksekutor->get_moudonatur();
			$data['provins'] = $this->m_moueksekutor->get_provinsi();
			$data['proyeks'] = $this->m_moueksekutor->get_jenis_proyek();		
			$this->load->view('shared/header', $data);
			$this->load->view('create', $data);
			$this->load->view('shared/footer');
		}
		
	}
	
	public function prosesUpdate(){
		
		$data = $this->page_view("List MoU Eksekutor");
		$id_mou_eksekutor = $this->input->post('id_mou_eksekutor');
		$id_eksekutor = $this->input->post('id_eksekutor');
		$id_mou_donatur = $this->input->post('id_mou_donatur');
		$tanggal_mou = getMysqlFormatDate($this->input->post('tanggal_mou')); 
		$tanggal_mou_hijriah = $this->input->post('tanggal_mou_hijriah'); 
		$tanggal_pengerjaan = getMysqlFormatDate($this->input->post('tanggal_pengerjaan')); 
		$nama_eksekutor = $this->input->post('nama_eksekutor');
		$alamat_eksekutor = $this->input->post('alamat_eksekutor');
		$jabatan_eksekutor = $this->input->post('jabatan_eksekutor');
		$kontak_eksekutor = $this->input->post('kontak_eksekutor');
		$nama_proyek = $this->input->post('nama_proyek');
		$id_jenis_proyek = $this->input->post('id_jenis_proyek');
		$deskripsi_proyek = $this->input->post('deskripsi_proyek');
		$ukuran = $this->input->post('ukuran');
		$provinsi = $this->input->post('id_provinsi');
		$kota = $this->input->post('kota');
		$alamat_lokasi = $this->input->post('alamat_lokasi');
		$koordinat_lokasi = $this->input->post('koordinat_lokasi');
		$nilai_proyek = str_replace(".", "", $this->input->post('nilai_proyek'));
		$is_banner = $this->input->post('is_banner');
		$is_prasasti = $this->input->post('is_prasasti');
		$pic_lokasi = $this->input->post('pic_lokasi');
		$kontak_pic_lokasi = $this->input->post('kontak_pic_lokasi');
		$alamat_pic_lokasi = $this->input->post('alamat_pic_lokasi');
		$nama_bangunan_di_lokasi = $this->input->post('nama_bangunan_di_lokasi');
		$tanggal_selesai = getMysqlFormatDate($this->input->post('tanggal_selesai')); 
		
		
		$arr = array( 'id_eksekutor' => $id_eksekutor,
						'id_mou_donatur' => $id_mou_donatur,
						'tanggal_mou' => $tanggal_mou, 
						'tanggal_mou_hijriah' => $tanggal_mou_hijriah, 
						'tanggal_pengerjaan' => $tanggal_pengerjaan, 
						'nama_eksekutor' => $nama_eksekutor,
						'alamat_eksekutor' => $alamat_eksekutor,
						'jabatan_eksekutor' => $jabatan_eksekutor,
						'kontak_eksekutor' => $kontak_eksekutor,
						'nama_proyek' => $nama_proyek,
						'id_jenis_proyek' => $id_jenis_proyek,
						'deskripsi_proyek' => $deskripsi_proyek,
						'ukuran' => $ukuran,
						'id_provinsi' => $provinsi,
						'id_kota_kab' => $kota,
						'alamat_lokasi' => $alamat_lokasi,
						'koordinat_lokasi' => $koordinat_lokasi,
						'nilai_proyek' => $nilai_proyek,
						'is_banner' => $is_banner,
						'is_prasasti' => $is_prasasti,
						'pic_lokasi' => $pic_lokasi,
						'kontak_pic_lokasi' => $kontak_pic_lokasi,
						'alamat_pic_lokasi' => $alamat_pic_lokasi,
						'nama_bangunan_di_lokasi' => $nama_bangunan_di_lokasi,
						'tanggal_selesai' => $tanggal_selesai
		 			);
		
		$result = $this->m_moueksekutor->update_data($arr, $id_mou_eksekutor);

		if($result == 1){
			$this->session->set_flashdata('message', 'MoU berhasil diperbarui...');
	  		redirect(site_url().'/moueksekutor');
		} else {
			$page_title = "Edit MoU Eksekutor";
			$message = "MoU gagal diperbarui, silakan input kembali...";
			$this->master_edit($id_role, $page_title, $message);
		}
		
	}
	
	private function master_edit($id, $page_title, $message=null){
		
		$data = $this->page_view($page_title);
		$data['eksekutors'] = $this->m_moueksekutor->get_eksekutor();
		$data['moudonatur'] = $this->m_moueksekutor->get_moudonatur();
		$data['provins'] = $this->m_moueksekutor->get_provinsi();
		$data['proyeks'] = $this->m_moueksekutor->get_jenis_proyek();
		$data['message'] = $message;
		$moueksekutors = $this->m_moueksekutor->getMoueksekutorById($id);
		$data['kotas'] = $this->m_moueksekutor->get_kotakab_by_prov($moueksekutors[0]['id_provinsi']);
		if($moueksekutors == null){
			//jika ID bernilai null, besar kemungkinan user melakukan direct hit url ke server
			redirect(site_url().'/login');
		} else {
			if($moueksekutors){
				foreach($moueksekutors as $m){
					$data['moueksekutor'] = $m;
				}
			} else {
				$data['moueksekutor'] = null;
			}
		}
		$data['moueksekutor']['tanggal_mou'] = getUserFormatDate($data['moueksekutor']['tanggal_mou']); 
		$data['moueksekutor']['tanggal_pengerjaan'] = getUserFormatDate($data['moueksekutor']['tanggal_pengerjaan']); 
		$this->load->view('shared/header', $data);
		$this->load->view('edit', $data);
		$this->load->view('shared/footer');
		
	}
	
	private function master_view($id, $page_title, $message=null){
		
		$data = $this->page_view($page_title);
		$data['eksekutors'] = $this->m_moueksekutor->get_eksekutor();
		$data['moudonatur'] = $this->m_moueksekutor->get_moudonatur();
		$data['provins'] = $this->m_moueksekutor->get_provinsi();
		$data['proyeks'] = $this->m_moueksekutor->get_jenis_proyek();
		$data['message'] = $message;
		$moueksekutors = $this->m_moueksekutor->getMoueksekutorById($id);
		$data['kotas'] = $this->m_moueksekutor->get_kotakab_by_prov($moueksekutors[0]['id_provinsi']);
		if($moueksekutors == null){
			//jika ID bernilai null, besar kemungkinan user melakukan direct hit url ke server
			redirect(site_url().'/login');
		} else {
			if($moueksekutors){
				foreach($moueksekutors as $m){
					$data['moueksekutor'] = $m;
				}
			} else {
				$data['moueksekutor'] = null;
			}
		}
		$data['moueksekutor']['tanggal_mou'] = getUserFormatDate($data['moueksekutor']['tanggal_mou']); 
		$data['moueksekutor']['tanggal_pembangunan'] = getUserFormatDate($data['moueksekutor']['tanggal_pengerjaan']); 
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
		$data['menuaktif'] = "moueksekutor";
		return $data;
	
	}
	
	public function selectkotakab(){
		
		$id = $this->uri->segment('3');
		$data['kotas'] = $this->m_moueksekutor->get_kotakab_by_prov($id);
		$this->load->view('selectkotakab', $data);
		
	}
	
}
?>