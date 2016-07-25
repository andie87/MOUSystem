<!--
* Author : Ahmad Shodiqi
-->
<?php

class User extends CI_Controller{

	function __constract(){
		parent::__constract();
	}

	public function index(){

		$data = $this->page_view("List User");
		if(count($this->session->flashdata('message')) > 0){
			$data['message'] = $this->session->flashdata('message');
		}
		if(count($this->session->flashdata('message_failed')) > 0){
			$data['message_failed'] = $this->session->flashdata('message_failed');
		}
		$data['users'] = $this->m_user->getAll();
		$this->load->view('shared/header', $data);
		$this->load->view('index', $data);
		$this->load->view('shared/footer');
		
	}

	public function create(){
		
		$data = $this->page_view("Tambah User");
		$this->load->view('shared/header', $data);
		$this->load->view('create', $data);
		$this->load->view('shared/footer');
	}
	
	public function edit(){
		
		$page_title = "Edit User";
		$id = $this->uri->segment('3');
		$this->master_edit($id, $page_title);
				
	}
	
	public function delete(){
		
		$data = $this->page_view("List User");
		$id = $this->input->post('id');
		$arr = array( 'id_user' => $id );
		$result = $this->m_user->delete_data($arr);
		if($result == 1){
			$this->session->set_flashdata('message', 'User berhasil dihapus...');
		} else {
			$this->session->set_flashdata('message_failed', 'User gagal dihapus!');
		}
  		redirect(site_url().'/user');
		
	}

	public function prosesCreate(){
		
		$data = $this->page_view("List User");
		$nama_user = $this->input->post('nama_user');
		$user_login = $this->input->post('user_login');
		$password = sha1($this->input->post('password'));
		$nomor_kontak = $this->input->post('nomor_kontak');
		$email = $this->input->post('email');
		$arr = array( 'nama_user' => $nama_user, 
						'user_login' => $user_login,
						'password' => $password, 
						'no_kontak' => $nomor_kontak, 
						'email' => $email );
		$result = $this->m_user->input_data($arr);

		if($result == 1){
			$this->session->set_flashdata('message', 'User baru berhasil ditambahkan...');
	  		redirect(site_url().'/user');
		} else {
			$data = $this->page_view("Tambah User");
			$data['message'] = "User baru gagal ditambahkan, silakan input kembali...";
			$this->load->view('shared/header', $data);
			$this->load->view('create', $data);
			$this->load->view('shared/footer');
		}
		
	}
	
	public function prosesUpdate(){
		
		$data = $this->page_view("List User");
		$nama_user = $this->input->post('nama_user');
		$user_login = $this->input->post('user_login');
		$password = $this->input->post('password');
		$no_kontak = $this->input->post('no_kontak');
		$email = $this->input->post('email');
		$id_user = $this->input->post('id_user');
		$arr = array( 'nama_user' => $nama_user, 
						'user_login' => $user_login, 
						'no_kontak' => $no_kontak, 
						'email' => $email );
		
		if(strlen($password) > 0){
			$arr['password'] = sha1($password);
		}
		
		
		$result = $this->m_user->update_data($arr, $id_user);

		if($result == 1){
			$this->session->set_flashdata('message', 'User berhasil diperbarui...');
	  		redirect(site_url().'/user');
		} else {
			$page_title = "Edit User";
			$message = "User gagal diperbarui, silakan input kembali...";
			$this->master_edit($id_user, $page_title, $message);
		}
		
	}
	
	private function master_edit($id, $page_title, $message=null){
		
		$data = $this->page_view($page_title);
		$data['message'] = $message;
		$users = $this->m_user->getUserById($id);
		if($users == null){
			//jika ID bernilai null, besar kemungkinan user melakukan direct hit url ke server
			redirect(site_url().'/login');
		} else {
			if($users){
				foreach($users as $r){
					$data['user'] = $r;
				}
			} else {
				$data['user']['nama_user'] = "";
				$data['user']['id_user'] = "";
			}
		}
		$this->load->view('shared/header', $data);
		$this->load->view('edit', $data);
		$this->load->view('shared/footer');
		
	}
	
	private function page_view($page){
		
		//no user session, redirect to login page
		if($this->session->userdata('userlogin')==""){
			redirect(site_url().'/login');
		}
		
		$data['page'] = $page;
		$data['menuaktif'] = "user";
		return $data;
	
	}
	
}
?>