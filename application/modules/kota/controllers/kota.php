<!--
* Author : Andi Mulya Indrianto
* Email : andie.mulya.i@gmail.com
* Created Date: 26 Jul 2016
-->
<?php

class Kota extends CI_Controller{

	function __constract(){
		parent::__constract();
	}

	public function index(){
		$data = $this->page_view("List Kota", "view");
		if(count($this->session->flashdata('message')) > 0){
			$data['message'] = $this->session->flashdata('message');
		}
		if(count($this->session->flashdata('message_failed')) > 0){
			$data['message_failed'] = $this->session->flashdata('message_failed');
		}
		$data['kotas'] = $this->m_kota->getAll();
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
		$data['kotas'] = $this->m_kota->getAllByProvinsi($id);
		$this->load->view('shared/header', $data);
		$this->load->view('index', $data);
		$this->load->view('shared/footer');
		
	}

	public function create(){
		
		$data = $this->page_view("Tambah kota", "create");
		$data['provinces'] = $this->m_provinsi->getAll();
		$this->load->view('shared/header', $data);
		$this->load->view('create', $data);
		$this->load->view('shared/footer');
	}
	
	public function edit(){
		
		$page_title = "Edit kota";
		$id = $this->uri->segment('3');
		$this->master_edit($id, $page_title);
				
	}
	
	public function delete(){
		
		$data = $this->page_view("List kota", "delete");
		$id = $this->input->post('id');
		$arr = array( 'id_kota_kab' => $id );
		$result = $this->m_kota->delete_data($arr);
		if($result == 1){
			$this->session->set_flashdata('message', 'kota berhasil dihapus...');
		} else {
			$this->session->set_flashdata('message_failed', 'kota gagal dihapus!');
		}
  		redirect(site_url().'/kota');
		
	}

	public function prosesCreate(){
		
		$data = $this->page_view("List kota", "create");
		$id_provinsi = $this->input->post('id_provinsi');
		$nama_kota = $this->input->post('nama_kota');
		$arr = array( 'id_provinsi' => $id_provinsi,
			'nama_kota_kab' => $nama_kota);
		$result = $this->m_kota->input_data($arr);

		if($result == 1){
			$this->session->set_flashdata('message', 'kota baru berhasil ditambahkan...');
	  		redirect(site_url().'/kota');
		} else {
			$data = $this->page_view("Tambah kota", "create");
			$data['provinces'] = $this->m_provinsi->getAll();
			$data['message'] = "kota baru gagal ditambahkan, silakan input kembali...";
			$this->load->view('shared/header', $data);
			$this->load->view('create', $data);
			$this->load->view('shared/footer');
		}
		
	}
	
	public function prosesUpdate(){
		
		$data = $this->page_view("List kota", "edit");
		$id_provinsi = $this->input->post('id_provinsi');
		$nama_kota = $this->input->post('nama_kota_kab');
		$id_kota = $this->input->post('id_kota_kab');
		$arr = array( 'id_provinsi' => $id_provinsi,
			'nama_kota_kab' => $nama_kota);
		
		$result = $this->m_kota->update_data($arr, $id_kota);

		if($result == 1){
			$this->session->set_flashdata('message', 'kota berhasil diperbarui...');
	  		redirect(site_url().'/kota');
		} else {
			$page_title = "Edit kota";
			$message = "kota gagal diperbarui, silakan input kembali...";
			$this->master_edit($id_kota, $page_title, $message);
		}
		
	}
	
	private function master_edit($id, $page_title, $message=null){
		
		$data = $this->page_view($page_title, "edit");
		$data['message'] = $message;		
		$data['provinces'] = $this->m_provinsi->getAll();
		$kotas = $this->m_kota->getkotaById($id);
		if($kotas == null){
			//jika ID bernilai null, besar kemungkinan kota melakukan direct hit url ke server
			redirect(site_url().'/login');
		} else {
			if($kotas){
				foreach($kotas as $r){
					$data['kota'] = $r;
				}
			} else {
				$data['kota']['nama_kota_kab'] = "";
				$data['kota']['id_kota_kab'] = "";
			}
		}
		$this->load->view('shared/header', $data);
		$this->load->view('edit', $data);
		$this->load->view('shared/footer');
		
	}

	private function page_view($page, $access_level){
		
		//no kota session, redirect to login page
		if($this->session->userdata('userlogin')==""){
			redirect(site_url().'/login');
		}
		
		//manage access
		$access_kota = "kota";
		$granted_access = $this->session->userdata('access');
		
		if(isset($granted_access[$access_kota])){
			if(strpos($granted_access[$access_kota], $access_level) === false){
				//jika tidak ada akses ke function ini maka arahkan ke dashboard
				redirect(site_url().'/dashboard');
			}
		} else {
			//jika tidak ada akses ke halaman ini maka arahkan ke dashboard
			redirect(site_url().'/dashboard');
		}
		
		$data['page'] = $page;
		$data['menuaktif'] = $access_kota;
		$data['menu'] = $this->session->userdata('access');
		return $data;
	
	}
}
