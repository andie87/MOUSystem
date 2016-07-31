<!--
* Author : Andi Mulya Indrianto
* Email : andie.mulya.i@gmail.com
* Created Date: 23 Jul 2016
-->
<?php

class Eksekutor extends CI_Controller{

	function __constract(){
		parent::__constract();
	}

	public function index(){
		$data = $this->page_view("List Eksekutor");
		if(count($this->session->flashdata('message')) > 0){
			$data['message'] = $this->session->flashdata('message');
		}
		if(count($this->session->flashdata('message_failed')) > 0){
			$data['message_failed'] = $this->session->flashdata('message_failed');
		}
		$msg = $this->session->flashdata('message');
		$msg_failed = $this->session->flashdata('message_failed');
		
		$data['eksekutors'] = $this->m_eksekutor->getAll();
		$this->load->view('shared/header', $data);
		$this->load->view('index', $data);
		$this->load->view('shared/footer');
	}

	public function create(){
		$data = $this->page_view("Tambah Eksekutor");
		$this->load->view('shared/header', $data);
		$this->load->view('create', $data);
		$this->load->view('shared/footer');
	}

	public function prosesCreate(){
		$data = $this->page_view("List Eksekutor");
		$nama = $this->input->post('nama');
		$alamat = $this->input->post('alamat');
		$kontak = $this->input->post('kontak');
		$email = $this->input->post('email');
		$pic = $this->input->post('pic');

		$this->form_validation->set_rules('nama','Nama Eksekutor','required',
			array('required'=>'%s harus di isi.'));
		$this->form_validation->set_rules('kontak','No Kontak','required',
			array('required'=>'%s harus di isi.'));
		$this->form_validation->set_rules('email','Email','required',
			array('required'=>'%s harus di isi.'));
		$this->form_validation->set_rules('pic','Nama PIC','required',
			array('required'=>'%s harus di isi.'));

		if ($this->form_validation->run() == FALSE){
			$data = $this->page_view("Tambah Eksekutor");
			$this->load->view('shared/header', $data);
			$this->load->view('create', $data);
			$this->load->view('shared/footer');
        }
        else{ 
			$data = array(
				'nama_eksekutor' => $nama,
				'alamat' => $alamat,
				'no_kontak' => $kontak,
				'email' => $email,
				'nama_pic' => $pic
				);

			$result = $this->m_eksekutor->input_data($data);
			if($result == 1){
				$this->session->set_flashdata('message', 'Eksekutor baru berhasil ditambahkan...');
		  		redirect(site_url().'/eksekutor');
			} 
			else {
				$data = $this->page_view("Tambah Eksekutor");
				$data['message_failed'] = "Eksekutor baru gagal ditambahkan, silakan input kembali...";
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

		$data = $this->page_view("List Eksekutor");
		$nama = $this->input->post('nama');
		$alamat = $this->input->post('alamat');
		$kontak = $this->input->post('kontak');
		$email = $this->input->post('email');
		$pic = $this->input->post('pic');
		$id_eksekutor = $this->input->post('id_eksekutor');

		$this->form_validation->set_rules('nama','Nama Eksekutor','required',
			array('required'=>'%s harus di isi.'));
		$this->form_validation->set_rules('kontak','No Kontak','required',
			array('required'=>'%s harus di isi.'));
		$this->form_validation->set_rules('email','Email','required',
			array('required'=>'%s harus di isi.'));
		$this->form_validation->set_rules('pic','Nama PIC','required',
			array('required'=>'%s harus di isi.'));

		if ($this->form_validation->run() == FALSE){
			$page_title = "Edit Eksekutor";
			$message = "Eksekutor gagal diperbarui, silakan input kembali...";
			$this->master_edit($id_eksekutor, $page_title, $message);
        }
        else{ 
			$data = array(
				'nama_eksekutor' => $nama,
				'alamat' => $alamat,
				'no_kontak' => $kontak,
				'email' => $email,
				'nama_pic' => $pic
				);

			$result = $this->m_eksekutor->update_data($data, $id_eksekutor);
			if($result == 1){
				$this->session->set_flashdata('message', 'Eksekutor berhasil diperbarui...');
		  		redirect(site_url().'/eksekutor');
			} else {
				$page_title = "Edit Eksekutor";
				$message = "Eksekutor gagal diperbarui, silakan input kembali...";
				$this->master_edit($id_eksekutor, $page_title, $message);
			}													
		}
	}

	public function delete(){
		$data = $this->page_view("List Eksekutor");
		$id = $this->input->post('id');
		$arr = array( 'id_eksekutor' => $id );
		$result = $this->m_eksekutor->hapus_data($arr);
		if($result == 1){
			$this->session->set_flashdata('message', 'Eksekutor berhasil dihapus...');
		} else {
			$this->session->set_flashdata('message_failed', 'Eksekutor gagal dihapus!');
		}
  		redirect(site_url().'/eksekutor');
	}

	private function master_edit($id, $page_title, $message=null){
		
		$data = $this->page_view($page_title);
		$data['message'] = $message;
		$eksekutors = $this->m_eksekutor->get_eksekutor_byID($id);
		if($eksekutors == null){
			//jika ID bernilai null, besar kemungkinan user melakukan direct hit url ke server
			redirect(site_url().'/login');
		} 
		else {
			if($eksekutors){
				foreach($eksekutors as $r){
					$data['eksekutor'] = $r;
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

		//no user session, redirect to login page
		if($this->session->userdata('userlogin')==""){
			redirect(site_url().'/login');
		}
		$data['page'] = $page;
		$data['menuaktif'] = "eksekutor";
		return $data;	
	}
}
?>