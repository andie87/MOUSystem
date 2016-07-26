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
		$data = $this->page_view("List Kota");
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
		$data = $this->page_view("List Kota");
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
		
		$data = $this->page_view("Tambah kota");
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
		
		$data = $this->page_view("List kota");
		$id = $this->input->post('id');
		$arr = array( 'id_kota' => $id );
		$result = $this->m_kota->delete_data($arr);
		if($result == 1){
			$this->session->set_flashdata('message', 'kota berhasil dihapus...');
		} else {
			$this->session->set_flashdata('message_failed', 'kota gagal dihapus!');
		}
  		redirect(site_url().'/kota/list/'.$id);
		
	}

	public function prosesCreate(){
		
		$data = $this->page_view("List kota");
		$nama_kota = $this->input->post('nama_kota');
		$arr = array( 'nama_kota' => $nama_kota);
		$result = $this->m_kota->input_data($arr);

		if($result == 1){
			$this->session->set_flashdata('message', 'kota baru berhasil ditambahkan...');
	  		redirect(site_url().'/kota');
		} else {
			$data = $this->page_view("Tambah kota");
			$data['message'] = "kota baru gagal ditambahkan, silakan input kembali...";
			$this->load->view('shared/header', $data);
			$this->load->view('create', $data);
			$this->load->view('shared/footer');
		}
		
	}
	
	public function prosesUpdate(){
		
		$data = $this->page_view("List kota");
		$nama_kota = $this->input->post('nama_kota');
		$id_kota = $this->input->post('id_kota');
		$arr = array( 'nama_kota' => $nama_kota);
		
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
		
		$data = $this->page_view($page_title);
		$data['message'] = $message;
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
				$data['kota']['nama_kota'] = "";
				$data['kota']['id_kota'] = "";
			}
		}
		$this->load->view('shared/header', $data);
		$this->load->view('edit', $data);
		$this->load->view('shared/footer');
		
	}

	private function page_view($page){
		
		//no kota session, redirect to login page
		if($this->session->userdata('userlogin')==""){
			redirect(site_url().'/login');
		}
		
		$data['page'] = $page;
		$data['menuaktif'] = "wilayah";
		return $data;
	
	}
}
