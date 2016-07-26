<!--
* Author : Andi Mulya Indrianto
* Email : andie.mulya.i@gmail.com
* Created Date: 26 Jul 2016
-->
<?php

class Provinsi extends CI_Controller{

	function __constract(){
		parent::__constract();
	}

	public function index(){

		$data = $this->page_view("List Provinsi");
		if(count($this->session->flashdata('message')) > 0){
			$data['message'] = $this->session->flashdata('message');
		}
		if(count($this->session->flashdata('message_failed')) > 0){
			$data['message_failed'] = $this->session->flashdata('message_failed');
		}
		$data['provinces'] = $this->m_provinsi->getAll();
		$this->load->view('shared/header', $data);
		$this->load->view('index', $data);
		$this->load->view('shared/footer');
		
	}

	public function create(){
		
		$data = $this->page_view("Tambah provinsi");
		$this->load->view('shared/header', $data);
		$this->load->view('create', $data);
		$this->load->view('shared/footer');
	}
	
	public function edit(){
		
		$page_title = "Edit provinsi";
		$id = $this->uri->segment('3');
		$this->master_edit($id, $page_title);
				
	}
	
	public function delete(){
		
		$data = $this->page_view("List provinsi");
		$id = $this->input->post('id');
		$arr = array( 'id_provinsi' => $id );
		$result = $this->m_provinsi->delete_data($arr);
		if($result == 1){
			$this->session->set_flashdata('message', 'provinsi berhasil dihapus...');
		} else {
			$this->session->set_flashdata('message_failed', 'provinsi gagal dihapus!');
		}
  		redirect(site_url().'/provinsi');
		
	}

	public function prosesCreate(){
		
		$data = $this->page_view("List provinsi");
		$nama_provinsi = $this->input->post('nama_provinsi');
		$arr = array( 'nama_provinsi' => $nama_provinsi);
		$result = $this->m_provinsi->input_data($arr);

		if($result == 1){
			$this->session->set_flashdata('message', 'provinsi baru berhasil ditambahkan...');
	  		redirect(site_url().'/provinsi');
		} else {
			$data = $this->page_view("Tambah provinsi");
			$data['message'] = "provinsi baru gagal ditambahkan, silakan input kembali...";
			$this->load->view('shared/header', $data);
			$this->load->view('create', $data);
			$this->load->view('shared/footer');
		}
		
	}
	
	public function prosesUpdate(){
		
		$data = $this->page_view("List provinsi");
		$nama_provinsi = $this->input->post('nama_provinsi');
		$id_provinsi = $this->input->post('id_provinsi');
		$arr = array( 'nama_provinsi' => $nama_provinsi);
		
		$result = $this->m_provinsi->update_data($arr, $id_provinsi);

		if($result == 1){
			$this->session->set_flashdata('message', 'provinsi berhasil diperbarui...');
	  		redirect(site_url().'/provinsi');
		} else {
			$page_title = "Edit provinsi";
			$message = "provinsi gagal diperbarui, silakan input kembali...";
			$this->master_edit($id_provinsi, $page_title, $message);
		}
		
	}
	
	private function master_edit($id, $page_title, $message=null){
		
		$data = $this->page_view($page_title);
		$data['message'] = $message;
		$provinsis = $this->m_provinsi->getprovinsiById($id);
		if($provinsis == null){
			//jika ID bernilai null, besar kemungkinan provinsi melakukan direct hit url ke server
			redirect(site_url().'/login');
		} else {
			if($provinsis){
				foreach($provinsis as $r){
					$data['provinsi'] = $r;
				}
			} else {
				$data['provinsi']['nama_provinsi'] = "";
				$data['provinsi']['id_provinsi'] = "";
			}
		}
		$this->load->view('shared/header', $data);
		$this->load->view('edit', $data);
		$this->load->view('shared/footer');
		
	}

	private function page_view($page){
		
		//no provinsi session, redirect to login page
		if($this->session->userdata('userlogin')==""){
			redirect(site_url().'/login');
		}
		
		$data['page'] = $page;
		$data['menuaktif'] = "wilayah";
		return $data;
	
	}
}
