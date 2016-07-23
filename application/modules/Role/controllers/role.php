<!--
* Author : Ahmad Shodiqi
-->
<?php

class Role extends CI_Controller{

	function __constract(){
		parent::__constract();
		$this->authenticate_user();
	}

	public function index(){

		$data = $this->page_view("List Role");
		if(count($this->session->flashdata('message')) > 0){
			$data['message'] = $this->session->flashdata('message');
		}
		if(count($this->session->flashdata('message_failed')) > 0){
			$data['message_failed'] = $this->session->flashdata('message_failed');
		}
		$msg = $this->session->flashdata('message');
		$msg_failed = $this->session->flashdata('message_failed');
		$data['roles'] = $this->m_role->getAll();
		$this->load->view('shared/header', $data);
		$this->load->view('index', $data);
		$this->load->view('shared/footer');
		
	}

	public function create(){
		
		$data = $this->page_view("Tambah Role");
		$this->load->view('shared/header', $data);
		$this->load->view('create', $data);
		$this->load->view('shared/footer');
	}
	
	public function edit(){
		
		$page_title = "Edit Role";
		$id = $this->uri->segment('3');
		$this->master_edit($id, $page_title);
				
	}
	
	public function delete(){
		
		$data = $this->page_view("List Role");
		$id = $this->input->post('id');
		$arr = array( 'id_role' => $id );
		$result = $this->m_role->delete_data($arr);
		if($result == 1){
			$this->session->set_flashdata('message', 'Role berhasil dihapus...');
		} else {
			$this->session->set_flashdata('message_failed', 'Role gagal dihapus!');
		}
  		redirect(site_url().'/role');
		
	}

	public function prosesCreate(){
		
		$data = $this->page_view("List Role");
		$nama = $this->input->post('nama');
		$arr = array( 'nama_role' => $nama );
		$result = $this->m_role->input_data($arr);

		if($result == 1){
			$this->session->set_flashdata('message', 'Role baru berhasil ditambahkan...');
	  		redirect(site_url().'/role');
		} else {
			$data = $this->page_view("Tambah Role");
			$data['message'] = "Role baru gagal ditambahkan, silakan input kembali...";
			$this->load->view('shared/header', $data);
			$this->load->view('create', $data);
			$this->load->view('shared/footer');
		}
		
	}
	
	public function prosesUpdate(){
		
		$data = $this->page_view("List Role");
		$nama_role = $this->input->post('nama_role');
		$id_role = $this->input->post('id_role');
		$arr = array( 'nama_role' => $nama_role, 'id_role' => $id_role );
		$result = $this->m_role->update_data($arr);

		if($result == 1){
			$this->session->set_flashdata('message', 'Role berhasil diperbarui...');
	  		redirect(site_url().'/role');
		} else {
			$page_title = "Edit Role";
			$message = "Role gagal diperbarui, silakan input kembali...";
			$this->master_edit($id_role, $page_title, $message);
		}
		
	}
	
	private function master_edit($id, $page_title, $message=null){
		
		$data = $this->page_view($page_title);
		$data['message'] = $message;
		$roles = $this->m_role->getRoleById($id);
		if($roles == null){
			//jika ID bernilai null, besar kemungkinan user melakukan direct hit url ke server
			redirect(site_url().'/login');
		} else {
			if($roles){
				foreach($roles as $r){
					$data['role'] = $r;
				}
			} else {
				$data['role']['nama_role'] = "";
				$data['role']['id_role'] = "";
			}
		}
		$this->load->view('shared/header', $data);
		$this->load->view('edit', $data);
		$this->load->view('shared/footer');
		
	}
	
	private function page_view($page){
		
		$data['page'] = $page;
		$data['menuaktif'] = "role";
		return $data;
	
	}
	
	//fuction pengecekan autentikasi user
	private function authenticate_user(){
		//no user session, redirect to login page
		if($this->session->userdata('userlogin')==""){
			redirect(site_url().'/login');
		}
	}
	
}
?>