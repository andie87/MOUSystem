<!--
* Author : Ahmad Shodiqi
-->
<?php

class Kecamatan extends CI_Controller{

	function __constract(){
		parent::__constract();
	}

	public function index(){
		$data = $this->page_view("List Kecamatan", "view");
		if(count($this->session->flashdata('message')) > 0){
			$data['message'] = $this->session->flashdata('message');
		}
		if(count($this->session->flashdata('message_failed')) > 0){
			$data['message_failed'] = $this->session->flashdata('message_failed');
		}
		$data['kecamatan'] = $this->m_kecamatan->getAll();
		$this->load->view('shared/header', $data);
		$this->load->view('index', $data);
		$this->load->view('shared/footer');
	}

	public function lists(){
		$id = $this->uri->segment('3');
		$data = $this->page_view("List Kota", "view");
		if(count($this->session->flashdata('message')) > 0){
			$data['message'] = $this->session->flashdata('message');
		}
		if(count($this->session->flashdata('message_failed')) > 0){
			$data['message_failed'] = $this->session->flashdata('message_failed');
		}
		$data['kotas'] = $this->m_kecamatan->getAllByProvinsi($id);
		$this->load->view('shared/header', $data);
		$this->load->view('index', $data);
		$this->load->view('shared/footer');
		
	}

	public function create(){
		
		$data = $this->page_view("Tambah Kecamatan", "create");
		$data['provinces'] = $this->m_provinsi->getAll();
		$this->load->view('shared/header', $data);
		$this->load->view('create', $data);
		$this->load->view('shared/footer');
	}
	
	public function edit(){
		
		$page_title = "Edit Kecamatan";
		$id = $this->uri->segment('3');
		$this->master_edit($id, $page_title);
				
	}
	
	public function delete(){
		
		$data = $this->page_view("List Kecamatan", "delete");
		$id = $this->input->post('id');
		$arr = array( 'id_kecamatan' => $id );
		$result = $this->m_kecamatan->delete_data($arr);
		if($result == 1){
			$this->session->set_flashdata('message', 'Kecamatan berhasil dihapus...');
		} else {
			$this->session->set_flashdata('message_failed', 'Kecamatan gagal dihapus!');
		}
  		redirect(site_url().'/kecamatan');
		
	}

	public function prosesCreate(){
		
		$data = $this->page_view("List Kecamatan", "create");
		$id_kota_kab = $this->input->post('id_kota_kab');
		$nama_kecamatan = $this->input->post('nama_kecamatan');
		$arr = array( 'id_kota_kab' => $id_kota_kab, 'nama_kecamatan' => $nama_kecamatan);
		$result = $this->m_kecamatan->input_data($arr);

		if($result == 1){
			$this->session->set_flashdata('message', 'kecamatan baru berhasil ditambahkan...');
	  		redirect(site_url().'/kecamatan');
		} else {
			$data = $this->page_view("Tambah Kecamatan", "create");
			$data['provinces'] = $this->m_provinsi->getAll();
			$data['message'] = "kecamatan baru gagal ditambahkan, silakan input kembali...";
			$this->load->view('shared/header', $data);
			$this->load->view('create', $data);
			$this->load->view('shared/footer');
		}
		
	}
	
	public function prosesUpdate(){
		
		$data = $this->page_view("List Kecamatan", "edit");
		$id_kota_kab = $this->input->post('id_kota_kab');
		$nama_kecamatan = $this->input->post('nama_kecamatan');
		$id_kecamatan = $this->input->post('id_kecamatan');
		$arr = array( 'id_kota_kab' => $id_kota_kab,
						'nama_kecamatan' => $nama_kecamatan );
		
		$result = $this->m_kecamatan->update_data($arr, $id_kecamatan);

		if($result == 1){
			$this->session->set_flashdata('message', 'kecamatan berhasil diperbarui...');
	  		redirect(site_url().'/kecamatan');
		} else {
			$page_title = "Edit Kecamatan";
			$message = "kecamatan gagal diperbarui, silakan input kembali...";
			$this->master_edit($id_kecamatan, $page_title, $message);
		}
		
	}
	
	private function master_edit($id, $page_title, $message=null){
		
		$data = $this->page_view($page_title, "edit");
		$data['message'] = $message;		
		$kecamatan = $this->m_kecamatan->getKecamatanById($id);
		if($kecamatan == null){
			//jika ID bernilai null, besar kemungkinan kota melakukan direct hit url ke server
			redirect(site_url().'/login');
		}
		$data['kecamatan_selected'] = $kecamatan[0];
		$kota_by_kec = $this->m_kecamatan->getKotaByKecamatan($kecamatan[0]['id_kota_kab']);
		$data['kota_selected'] = $kota_by_kec[0];
		$data['provinces'] = $this->m_kecamatan->get_provinsi();
		$data['kota'] = $this->m_kecamatan->getKotaByProvinsi($kota_by_kec[0]['id_provinsi']);
		$this->load->view('shared/header', $data);
		$this->load->view('edit', $data);
		$this->load->view('shared/footer');
		
	}
	
	public function selectkotakab(){
		
		$id = $this->uri->segment('3');
		$data['kotas'] = $this->m_moudonatur->get_kotakab_by_prov($id);
		$this->load->view('selectkotakab', $data);
		
	}
	
	private function page_view($page, $access_level){
		
		//no kota session, redirect to login page
		if($this->session->userdata('userlogin')==""){
			redirect(site_url().'/login');
		}
		
		//manage access
		$access_kecamatan = "kecamatan";
		$granted_access = $this->session->userdata('access');
		
		if(isset($granted_access[$access_kecamatan])){
			if(strpos($granted_access[$access_kecamatan], $access_level) === false){
				//jika tidak ada akses ke function ini maka arahkan ke dashboard
				redirect(site_url().'/dashboard');
			}
		} else {
			//jika tidak ada akses ke halaman ini maka arahkan ke dashboard
			redirect(site_url().'/dashboard');
		}
		
		$data['page'] = $page;
		$data['menuaktif'] = $access_kecamatan;
		$data['menu'] = $this->session->userdata('access');
		return $data;
	
	}
}
