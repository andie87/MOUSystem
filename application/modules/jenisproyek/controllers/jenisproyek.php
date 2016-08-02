<!--
* Author : Andi Mulya Indrianto
* Email : andie.mulya.i@gmail.com
* Created Date: 30 Jul 2016
-->
<?php

class JenisProyek extends CI_Controller{

	function __constract(){
		parent::__constract();
	}

	public function index(){
		$data = $this->page_view("List Proyek");
		if(count($this->session->flashdata('message')) > 0){
			$data['message'] = $this->session->flashdata('message');
		}
		if(count($this->session->flashdata('message_failed')) > 0){
			$data['message_failed'] = $this->session->flashdata('message_failed');
		}
		$msg = $this->session->flashdata('message');
		$msg_failed = $this->session->flashdata('message_failed');
		
		$data['proyeks'] = $this->m_jenisproyek->getAll();
		$this->load->view('shared/header', $data);
		$this->load->view('index', $data);
		$this->load->view('shared/footer');
	}

	public function create(){
		
		$data = $this->page_view("Tambah proyek");
		$this->load->view('shared/header', $data);
		$this->load->view('create', $data);
		$this->load->view('shared/footer');
	}
	
	public function edit(){
		
		$page_title = "Edit proyek";
		$id = $this->uri->segment('3');
		$this->master_edit($id, $page_title);
				
	}
	
	public function delete(){
		
		$data = $this->page_view("List proyek");
		$id = $this->input->post('id');
		$arr = array( 'id_jenis_proyek' => $id );
		$result = $this->m_jenisproyek->delete_data($arr);
		if($result == 1){
			$this->session->set_flashdata('message', 'proyek berhasil dihapus...');
		} else {
			$this->session->set_flashdata('message_failed', 'proyek gagal dihapus!');
		}
  		redirect(site_url().'/jenisproyek');
		
	}

	public function prosesCreate(){
		
		$data = $this->page_view("List proyek");
		$nama_proyek = $this->input->post('nama_proyek');
		$arr = array( 'nama_proyek' => $nama_proyek);
		$result = $this->m_jenisproyek->input_data($arr);

		if($result == 1){
			$this->session->set_flashdata('message', 'proyek baru berhasil ditambahkan...');
	  		redirect(site_url().'/jenisproyek');
		} else {
			$data = $this->page_view("Tambah proyek");
			$data['message'] = "proyek baru gagal ditambahkan, silakan input kembali...";
			$this->load->view('shared/header', $data);
			$this->load->view('create', $data);
			$this->load->view('shared/footer');
		}
		
	}
	
	public function prosesEdit(){
		
		$data = $this->page_view("List proyek");
		$nama_proyek = $this->input->post('nama_proyek');
		$id_jenis_proyek = $this->input->post('id_jenis_proyek');
		$arr = array( 'nama_proyek' => $nama_proyek);
		
		$result = $this->m_jenisproyek->update_data($arr, $id_jenis_proyek);

		if($result == 1){
			$this->session->set_flashdata('message', 'proyek berhasil diperbarui...');
	  		redirect(site_url().'/jenisproyek');
		} else {
			$page_title = "Edit proyek";
			$message = "proyek gagal diperbarui, silakan input kembali...";
			$this->master_edit($id_jenis_proyek, $page_title, $message);
		}
		
	}
	
	private function master_edit($id, $page_title, $message=null){
		
		$data = $this->page_view($page_title);
		$data['message'] = $message;		
		$proyeks = $this->m_jenisproyek->getproyekById($id);
		if($proyeks == null){
			//jika ID bernilai null, besar kemungkinan proyek melakukan direct hit url ke server
			redirect(site_url().'/login');
		} else {
			if($proyeks){
				foreach($proyeks as $r){
					$data['proyek'] = $r;
				}
			} else {
				$data['proyek']['nama_proyek'] = "";
				$data['proyek']['id_jenis_proyek'] = "";
			}
		}
		$this->load->view('shared/header', $data);
		$this->load->view('edit', $data);
		$this->load->view('shared/footer');
		
	}

	private function page_view($page){
		
		//no proyek session, redirect to login page
		if($this->session->userdata('userlogin')==""){
			redirect(site_url().'/login');
		}
		
		$data['page'] = $page;
		$data['menuaktif'] = "proyek";
		return $data;
	
	}
}
