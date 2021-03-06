<!--
* Author : Ahmad Shodiqi
-->
<?php

class Role extends CI_Controller{

	function __constract(){
		parent::__constract();
	}

	public function index(){

		$data = $this->page_view("List Role", "view");
		if(count($this->session->flashdata('message')) > 0){
			$data['message'] = $this->session->flashdata('message');
		}
		if(count($this->session->flashdata('message_failed')) > 0){
			$data['message_failed'] = $this->session->flashdata('message_failed');
		}
		$data['roles'] = $this->m_role->getAll();
		$this->load->view('shared/header', $data);
		$this->load->view('index', $data);
		$this->load->view('shared/footer');
		
	}

	public function create(){
		
		$data = $this->page_view("Tambah Role", "create");
		$data['modules'] = $this->m_role->getAllModule();
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
		
		$data = $this->page_view("List Role", "delete");
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
		
		$data = $this->page_view("List Role", "create");
		$nama = $this->input->post('nama');
		$arr = array( 'nama_role' => $nama );
		$result = $this->m_role->input_data($arr);
		$role = $this->m_role->getRoleByName($nama);
		$modules = $this->m_role->getAllModule();
		foreach ($modules->result() as $module) {
			$arr = array('id_role' => $role[0]->id_role,
				'id_module'=> $module->id_module,
				'view' => false,
				'edit' => false,
				'create' => false,
				'delete' => false );
			$result = $this->m_role->input_access($arr);
		}
		
		if($result == 1){
			$this->session->set_flashdata('message', 'Role baru berhasil ditambahkan...');
	  		redirect(site_url().'/role');
		} else {
			$data = $this->page_view("Tambah Role", "create");
			$data['message'] = "Role baru gagal ditambahkan, silakan input kembali...";
			$this->load->view('shared/header', $data);
			$this->load->view('create', $data);
			$this->load->view('shared/footer');
		}
		
	}
	
	public function prosesUpdate(){
		
		$data = $this->page_view("List Role", "edit");
		$nama_role = $this->input->post('nama_role');
		$id_role = $this->input->post('id_role');
		$view = $this->input->post('view');
		$view_minus_biaya = $this->input->post('view_minus_biaya');
		$edit = $this->input->post('edit');
		$create = $this->input->post('create');
		$delete = $this->input->post('delete');
		$arr = array( 'nama_role' => $nama_role, 'id_role' => $id_role );
		$result = $this->m_role->update_data($arr);

		try{
			$this->m_role->reset_access($id_role);
			foreach ($view as $key => $value) {
				$id_role_rights = explode("_", $value)[0];
				$this->m_role->update_access("1", "role_rights.view", $id_role_rights);
			}
			foreach ($edit as $key => $value) {
				$id_role_rights = explode("_", $value)[0];
				$this->m_role->update_access("1", "role_rights.edit", $id_role_rights);
			}
			foreach ($create as $key => $value) {
				$id_role_rights = explode("_", $value)[0];
				$this->m_role->update_access("1", "role_rights.create", $id_role_rights);
			}
			foreach ($delete as $key => $value) {
				$id_role_rights = explode("_", $value)[0];
				$this->m_role->update_access("1", "role_rights.delete", $id_role_rights);
			}
			foreach ($view_minus_biaya as $key => $value) {
				$id_role_rights = explode("_", $value)[0];
				$this->m_role->update_access("1", "role_rights.view_minus_biaya", $id_role_rights);
			}
		}
		catch (Exception $e){
			$result = 0;
		}

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
		
		$data = $this->page_view($page_title, "edit");
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
		$data['modules'] = $this->m_role->getAllModule();
		$data['access'] = $this->m_role->getAccess($data['role']['id_role']);
		$this->load->view('shared/header', $data);
		$this->load->view('edit', $data);
		$this->load->view('shared/footer');
		
	}
	
	private function page_view($page, $access_level){
		
		//no user session, redirect to login page
		if($this->session->userdata('userlogin')==""){
			redirect(site_url().'/login');
		}
		
		//manage access
		$access_role = "role";
		$granted_access = $this->session->userdata('access');
		if(isset($granted_access[$access_role])){
			if(strpos($granted_access[$access_role], $access_level) === false){
				//jika tidak ada akses ke function ini maka arahkan ke dashboard
				redirect(site_url().'/dashboard');
			}
		} else {
			//jika tidak ada akses ke halaman ini maka arahkan ke dashboard
			redirect(site_url().'/dashboard');
		}
		
		$data['page'] = $page;
		$data['menuaktif'] = $access_role;
		$data['menu'] = $this->session->userdata('access');
		return $data;
	
	}
	
}
?>