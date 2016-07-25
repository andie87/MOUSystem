<!--
* Author : Andi Mulya Indrianto
* Email : andie.mulya.i@gmail.com
* Created Date: 16 Jul 2016
-->
<?php

class Donatur extends CI_Controller{

	function __constract(){
		parent::__constract();
		$this->authenticate_user();
	}

	public function index(){
		$data = $this->page_view("List Donatur");
		if(count($this->session->flashdata('message')) > 0){
			$data['message'] = $this->session->flashdata('message');
		}
		if(count($this->session->flashdata('message_failed')) > 0){
			$data['message_failed'] = $this->session->flashdata('message_failed');
		}
		$msg = $this->session->flashdata('message');
		$msg_failed = $this->session->flashdata('message_failed');
		
		$data['donaturs'] = $this->m_donatur->getAll();
		$this->load->view('shared/header', $data);
		$this->load->view('index', $data);
		$this->load->view('shared/footer');
	}

	public function create(){
		$data = $this->page_view("Tambah Donatur");
		$this->load->view('shared/header', $data);
		$this->load->view('create', $data);
		$this->load->view('shared/footer');
	}

	public function prosesCreate(){
		$data = $this->page_view("List Donatur");
		$nama = $this->input->post('nama');
		$negara = $this->input->post('negara');
		$alamat = $this->input->post('alamat');
		$kontak = $this->input->post('kontak');
		$email = $this->input->post('email');
		$pic = $this->input->post('pic');

		$this->form_validation->set_rules('nama','Nama Donatur','required',
			array('required'=>'%s harus di isi.'));
		$this->form_validation->set_rules('negara','Negara Asal','required',
			array('required'=>'%s harus di isi.'));
		$this->form_validation->set_rules('email','Email','required',
			array('required'=>'%s harus di isi.'));
		$this->form_validation->set_rules('pic','Nama PIC','required',
			array('required'=>'%s harus di isi.'));

		if ($this->form_validation->run() == FALSE){
			$data = $this->page_view("List Donatur");
			$this->load->view('shared/header', $data);
			$this->load->view('create', $data);
			$this->load->view('shared/footer');
        }
        else{ 
			$data = array(
				'nama_donatur' => $nama,
				'asal_negara' => $negara,
				'alamat' => $alamat,
				'no_kontak' => $kontak,
				'email' => $email,
				'nama_pic' => $pic
				);

			$result = $this->m_donatur->input_data($data);
			if($result == 1){
				$this->session->set_flashdata('message', 'Donatur baru berhasil ditambahkan...');
		  		redirect(site_url().'/donatur');
			} 
			else {
				$data = $this->page_view("Tambah Donatur");
				$data['message_failed'] = "Donatur baru gagal ditambahkan, silakan input kembali...";
				$this->load->view('shared/header', $data);
				$this->load->view('create', $data);
				$this->load->view('shared/footer');
			}
		}
	}

	public function edit(){
		$page_title = "Edit Eksekutor";
		$id = $this->uri->segment('3');
		$this->master_edit($id, $page_title);
	}

	public function prosesEdit(){ 
		$data = $this->page_view("List Donatur");
		$nama = $this->input->post('nama');
		$negara = $this->input->post('negara');
		$alamat = $this->input->post('alamat');
		$kontak = $this->input->post('kontak');
		$email = $this->input->post('email');
		$pic = $this->input->post('pic');
		$id_donatur = $this->input->post('id_donatur');

		$this->form_validation->set_rules('nama','Nama Donatur','required',
			array('required'=>'%s harus di isi.'));
		$this->form_validation->set_rules('negara','Negara Asal','required',
			array('required'=>'%s harus di isi.'));
		$this->form_validation->set_rules('email','Email','required',
			array('required'=>'%s harus di isi.'));
		$this->form_validation->set_rules('pic','Nama PIC','required',
			array('required'=>'%s harus di isi.'));

		if ($this->form_validation->run() == FALSE){
			$page_title = "Edit Donatur";
			$message = "Donatur gagal diperbarui, silakan input kembali...";
			$this->master_edit($id_donatur, $page_title, $message);
        }
        else{ 
			$data = array(
				'nama_donatur' => $nama,
				'asal_negara' => $negara,
				'alamat' => $alamat,
				'no_kontak' => $kontak,
				'email' => $email,
				'nama_pic' => $pic
				);

			$result = $this->m_donatur->update_data($data, $id_donatur);
			if($result == 1){
				$this->session->set_flashdata('message', 'Donatur berhasil diperbarui...');
		  		redirect(site_url().'/donatur');
			} else {
				$page_title = "Edit Donatur";
				$message = "Donatur gagal diperbarui, silakan input kembali...";
				$this->master_edit($id_donatur, $page_title, $message);
			}	
		}
	}

	public function delete(){
		$data = $this->page_view("List Donatur");
		$id = $this->input->post('id');
		$arr = array( 'id_donatur' => $id );
		$result = $this->m_donatur->hapus_data($arr);
		if($result == 1){
			$this->session->set_flashdata('message', 'Donatur berhasil dihapus...');
		} else {
			$this->session->set_flashdata('message_failed', 'Donatur gagal dihapus!');
		}
  		redirect(site_url().'/donatur');
	}

	private function master_edit($id, $page_title, $message=null){
		
		$data = $this->page_view($page_title);
		$data['message'] = $message;
		$donaturs = $this->m_donatur->get_donatur_byID($id);
		if($donaturs == null){
			//jika ID bernilai null, besar kemungkinan user melakukan direct hit url ke server
			redirect(site_url().'/login');
		} 
		else {
			if($donaturs){
				foreach($donaturs as $r){
					$data['donatur'] = $r;
				}
			} 
			//else {
			// 	$data['user']['nama_user'] = "";
			// 	$data['user']['id_user'] = "";
			// }
		}
		$this->load->view('shared/header', $data);
		$this->load->view('edit', $data);
		$this->load->view('shared/footer');
		
	}

	private function page_view($page){
		
		$data['page'] = $page;
		$data['menuaktif'] = "donatur";
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