<!--
* Author : Ahmad Shodiqi
-->
<?php

class User extends CI_Controller{

	function __constract(){
		parent::__constract();
	}

	public function index(){

		$data = $this->page_view("List User", "view");
		if(count($this->session->flashdata('message')) > 0){
			$data['message'] = $this->session->flashdata('message');
		}
		if(count($this->session->flashdata('message_failed')) > 0){
			$data['message_failed'] = $this->session->flashdata('message_failed');
		}
		$role_array = $this->m_user->get_role_array();
		
		$arr_role = array();
		foreach($role_array as $r){
			$arr_role[$r['id_role']] = $r['nama_role'];
		}
		$data['arr_role'] = $arr_role;
		
		$data['users'] = $this->m_user->getAll();
		$this->load->view('shared/header', $data);
		$this->load->view('index', $data);
		$this->load->view('shared/footer');
		
	}

	public function create(){
		
		$data = $this->page_view("Tambah User", "create");
		$data['roles'] = $this->m_role->getAll();
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
		
		$data = $this->page_view("List User", "delete");
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
		
		$data = $this->page_view("List User", "create");
		$nama_user = $this->input->post('nama_user');
		$user_login = $this->input->post('user_login');
		$password = sha1($this->input->post('password'));
		$nomor_kontak = $this->input->post('nomor_kontak');
		$email = $this->input->post('email');
		$id_role = $this->input->post('id_role');

		$this->load->library('upload');
        $nmfile = "foto_".$nama_user.time(); //nama file saya beri nama langsung dan diikuti fungsi time
        $config['upload_path'] = './uploads/foto profil'; //path folder
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
        $config['max_size'] = '2048'; //maksimum besar file 2M
        //$config['max_width']  = '1288'; //lebar maksimum 1288 px
        //$config['max_height']  = '768'; //tinggi maksimu 768 px
        $config['file_name'] = $nmfile; //nama yang terupload nantinya
 
        $this->upload->initialize($config);
         
        

		if($id_role == ""){
			$data = $this->page_view("Tambah User", "create");
			$data['roles'] = $this->m_role->getAll();
			$data['message'] = "Role harus diisi, silakan input kembali...";
			$this->load->view('shared/header', $data);
			$this->load->view('create', $data);
			$this->load->view('shared/footer');
		}else{
			$arr = array( 'nama_user' => $nama_user, 
							'user_login' => $user_login,
							'password' => $password, 
							'no_kontak' => $nomor_kontak, 
							'email' => $email );
			$result = $this->m_user->input_data($arr);

			if($result == 1){
				$id_user = $this->m_user->get_iduser($nama_user,$user_login);
				$arr = array('id_user' => $id_user,
								'id_role' => $id_role);
				$result = $this->m_user->input_role($arr);

				$pesan_foto = "";

				if($result == 1){
					if($_FILES['foto']['name'])
        			{
			            if ($this->upload->do_upload('foto'))
			            {
			                $id_user = $this->m_user->get_iduser($nama_user,$user_login);
			                $gbr = $this->upload->data();
			                $data = array(
			                  'nama_file' =>$gbr['file_name'],
			                  'jenis_foto' =>$gbr['file_type'],
			                  'id_user' =>$id_user                   
			                );
			 
			                $this->m_user->insert_foto($data); //akses model untuk menyimpan ke database
			                $pesan_foto = "foto berhasil di upload";
			            }else{
			                $pesan_foto = "foto gagal di upload";
			            }
			        }
					$this->session->set_flashdata('message', 'User baru berhasil ditambahkan...,'.$pesan_foto);
			  		redirect(site_url().'/user');
				} else {
					$data = $this->page_view("Tambah User", "create");
					$data['message'] = "User baru gagal ditambahkan </br>".$result." </br>, silakan input kembali...";
					$this->load->view('shared/header', $data);
					$this->load->view('create', $data);
					$this->load->view('shared/footer');
				}
			}
			else {
				$data = $this->page_view("Tambah User", "create");
				$data['message'] = "User baru gagal ditambahkan </br>".$result." </br>, silakan input kembali...";
				$this->load->view('shared/header', $data);
				$this->load->view('create', $data);
				$this->load->view('shared/footer');
			}
		}
	}
	
	public function prosesUpdate(){
		
		$data = $this->page_view("List User", "edit");
		$nama_user = $this->input->post('nama_user');
		$user_login = $this->input->post('user_login');
		$password = $this->input->post('password');
		$no_kontak = $this->input->post('no_kontak');
		$email = $this->input->post('email');
		$id_user = $this->input->post('id_user');
		$id_role = $this->input->post('id_role');

		$this->load->library('upload');
        $nmfile = "foto_".$nama_user.time(); //nama file saya beri nama langsung dan diikuti fungsi time
        $config['upload_path'] = './uploads/foto profil'; //path folder
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
        $config['max_size'] = '2048'; //maksimum besar file 2M
       //$config['max_width']  = '1288'; //lebar maksimum 1288 px
        //$config['max_height']  = '768'; //tinggi maksimu 768 px
        $config['file_name'] = $nmfile; //nama yang terupload nantinya
 
        $this->upload->initialize($config);

		$arr = array( 'nama_user' => $nama_user, 
						'user_login' => $user_login, 
						'no_kontak' => $no_kontak, 
						'email' => $email );
		
		if(strlen($password) > 0){
			$arr['password'] = sha1($password);
		}
		
		
		$result = $this->m_user->update_data($arr, $id_user);
		if($id_role != ""){
			$arr = array('id_role' => $id_role);
			$result = $this->m_user->update_role($arr, $id_user);
		}
		if($result == 1){
			if($_FILES['foto']['name'])
			{
	            if ($this->upload->do_upload('foto'))
	            {
	                $gbr = $this->upload->data();
	                $data = array(
	                  'nama_file' =>$gbr['file_name'],
	                  'jenis_foto' =>$gbr['file_type']      
	                );
	 				if($this->session->userdata('foto')){
		                $this->m_user->update_foto($data, $id_user); //akses model untuk menyimpan ke database
		            }else{
		            	$data['id_user'] = $id_user;             
		            	$this->m_user->insert_foto($data); 
		            }
	                $pesan_foto = "dan foto berhasil di upload";
	                $this->session->unset_userdata('foto');
	                $this->session->set_userdata('foto', $gbr['file_name']);
	            }else{
	                $pesan_foto = "dan foto gagal di upload";
	            }
	        }
			$this->session->set_flashdata('message', 'User berhasil diperbarui...'.$pesan_foto);
	  		redirect(site_url().'/user');
		} else {
			$page_title = "Edit User";
			$message = "User gagal diperbarui, silakan input kembali...";
			$this->master_edit($id_user, $page_title, $message);
		}
		
	}
	
	private function master_edit($id, $page_title, $message=null){
		
		$data = $this->page_view($page_title, "edit");
		$data['message'] = $message;
		$data['roles'] = $this->m_role->getAll();
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
	
	private function page_view($page, $access_level){
		
		//no user session, redirect to login page
		if($this->session->userdata('userlogin')==""){
			redirect(site_url().'/login');
		}
		
		//manage access
		$access_user = "user";
		$granted_access = $this->session->userdata('access');
		if(isset($granted_access[$access_user])){
			if(strpos($granted_access[$access_user], $access_level) === false){
				//jika tidak ada akses ke function ini maka arahkan ke dashboard
				redirect(site_url().'/dashboard');
			}
		} else {
			//jika tidak ada akses ke halaman ini maka arahkan ke dashboard
			redirect(site_url().'/dashboard');
		}
		
		$data['page'] = $page;
		$data['menuaktif'] = $access_user;
		$data['menu'] = $this->session->userdata('access');
		return $data;
	
	}
	
}
?>