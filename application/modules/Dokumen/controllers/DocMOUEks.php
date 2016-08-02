<!--
* Author : Andi Mulya Indrianto
* Email : andie.mulya.i@gmail.com
* Created Date: 31 Jul 2016
-->
<?php

class DocMOUEks extends CI_Controller{

	function __constract(){
		parent::__constract();
	}

	public function index(){
		$data = $this->page_view("List Dokumen MOU Eksekutor");
		if(count($this->session->flashdata('message')) > 0){
			$data['message'] = $this->session->flashdata('message');
		}
		if(count($this->session->flashdata('message_failed')) > 0){
			$data['message_failed'] = $this->session->flashdata('message_failed');
		}
		$data['Docs'] = $this->m_DocMOUEks->getAll();
		$this->load->view('shared/header', $data);
		$this->load->view('index', $data);
		$this->load->view('shared/footer');
	}

	public function lists(){
		$id = $this->uri->segment('4');
		$data = $this->page_view("List Dokumen MOU Eksekutor");
		if(count($this->session->flashdata('message')) > 0){
			$data['message'] = $this->session->flashdata('message');
		}
		if(count($this->session->flashdata('message_failed')) > 0){
			$data['message_failed'] = $this->session->flashdata('message_failed');
		}
		$data['Docs'] = $this->m_DocMOUEks->getAllByIdMOU($id);
		$this->load->view('shared/header', $data);
		$this->load->view('index', $data);
		$this->load->view('shared/footer');
		
	}

	public function create(){
		
		$data = $this->page_view("Tambah Dokumen MOU Eksekutor");
		$data['mous'] = $this->m_DocMOUEks->getAllMOU();
		$this->load->view('shared/header', $data);
		$this->load->view('create', $data);
		$this->load->view('shared/footer');
	}
	
	public function edit(){
		
		$page_title = "Edit Dokumen MOU Eksekutor";
		$id = $this->uri->segment('4');
		$this->master_edit($id, $page_title);
				
	}
	
	public function delete(){
		
		$data = $this->page_view("List Dokumen MOU Eksekutor");
		$id = $this->input->post('id');
		$arr = array( 'id_dokumen_mou_eksekutor' => $id );
		$result = $this->m_DocMOUEks->delete_data($arr);
		if($result == 1){
			$this->session->set_flashdata('message', 'Dokumen MOU Eksekutor berhasil dihapus...');
		} else {
			$this->session->set_flashdata('message_failed', 'Dokumen MOU Eksekutor gagal dihapus!');
		}
  		redirect(site_url().'/dokumen/DocMOUEks');
		
	}

	public function prosesCreate(){
		
		$data = $this->page_view("List Dokumen MOU Eksekutor");
		$id_mou_eksekutor = $this->input->post('id_mou_eksekutor');
		$nama_file = $this->input->post('nama_file');
		$alamat_file = $this->input->post('alamat_file');

		$arr = array( 'id_mou_eksekutor' => $id_mou_eksekutor,
			'nama_file' => $nama_file,
			'alamat_file' => $alamat_file);

		$result = $this->m_DocMOUEks->input_data($arr);

		if($result == 1){
			$this->session->set_flashdata('message', 'Dokumen MOU Eksekutor baru berhasil ditambahkan...');
	  		redirect(site_url().'/DocMOUEks');
		} else {
			$data = $this->page_view("Tambah Dokumen MOU Eksekutor");
			$data['mous'] = $this->m_DocMOUEks->getAllMOU();
			$data['message'] = "Dokumen MOU Eksekutor baru gagal ditambahkan, silakan input kembali...";
			$this->load->view('shared/header', $data);
			$this->load->view('create', $data);
			$this->load->view('shared/footer');
		}
		
	}
	
	public function prosesUpdate(){
		
		$data = $this->page_view("List Dokumen MOU Eksekutor");
		$id_mou_eksekutor = $this->input->post('id_mou_eksekutor');
		$nama_file = $this->input->post('nama_file');
		$alamat_file = $this->input->post('alamat_file');
		$id_dokumen_mou_eksekutor = $this->input->post('id_dokumen_mou_eksekutor');

		$arr = array( 'id_mou_eksekutor' => $id_mou_eksekutor,
			'nama_file' => $nama_file,
			'alamat_file' => $alamat_file);
		
		$result = $this->m_DocMOUEks->update_data($arr, $id_dokumen_mou_eksekutor);

		if($result == 1){
			$this->session->set_flashdata('message', 'Dokumen MOU Eksekutor berhasil diperbarui...');
	  		redirect(site_url().'/dokumen/DocMOUEks');
		} else {
			$page_title = "Edit Dokumen MOU Eksekutor";
			$message = "Dokumen MOU Eksekutor gagal diperbarui, silakan input kembali...";
			$this->master_edit($id_dokumen_mou_eksekutor, $page_title, $message);
		}
		
	}
	
	private function master_edit($id, $page_title, $message=null){
		
		$data = $this->page_view($page_title);
		$data['message'] = $message;		
		$data['mous'] = $this->m_DocMOUEks->getAllMOU();
		$DocMOUEkss = $this->m_DocMOUEks->getDocMOUEksById($id);
		if($DocMOUEkss == null){
			//jika ID bernilai null, besar kemungkinan DocMOUEks melakukan direct hit url ke server
			redirect(site_url().'/login');
		} else {
			if($DocMOUEkss){
				foreach($DocMOUEkss as $r){
					$data['docs'] = $r;
				}
			} else {
				$data['docs']['nama_file'] = "";
				$data['docs']['id_dokumen_mou_eksekutor'] = "";
			}
		}
		$this->load->view('shared/header', $data);
		$this->load->view('edit', $data);
		$this->load->view('shared/footer');
		
	}

	private function page_view($page){
		
		//no DocMOUEks session, redirect to login page
		if($this->session->userdata('userlogin')==""){
			redirect(site_url().'/login');
		}
		
		$data['page'] = $page;
		$data['menuaktif'] = "dokumen";
		return $data;
	
	}
}
