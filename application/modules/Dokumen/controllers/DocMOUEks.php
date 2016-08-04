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
		$this->load->view('indexDokumenEksekutor', $data);
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
		$this->load->view('indexDokumenEksekutor', $data);
		$this->load->view('shared/footer');
		
	}

	public function create(){
		
		$data = $this->page_view("Tambah Dokumen MOU Eksekutor");
		$data['mous'] = $this->m_DocMOUEks->getAllMOU();
		$this->load->view('shared/header', $data);
		$this->load->view('createDokumenEksekutor', $data);
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
		
		$data = $this->page_view("Tambah Dokumen MOU Eksekutor");
		$id_mou_eksekutor = $this->input->post('id_mou_eksekutor');

		$config['upload_path'] = './uploads/mou eksekutor';
		$config['allowed_types'] = '*';

		$this->load->library('upload', $config);

		$this->form_validation->set_rules('id_mou_eksekutor','No Proyek','required',
			array('required'=>'%s harus di isi.'));
		if (empty($_FILES['file']['name']))
		{
		    $this->form_validation->set_rules('file', 'Dokumen', 'required',
			array('required'=>'%s harus di isi.'));
		}

		if ($this->form_validation->run() == FALSE){
			$data = $this->page_view("Tambah Dokumen MOU Eksekutor");
			$data['mous'] = $this->m_DocMOUEks->getAllMOU();
			$this->load->view('shared/header', $data);
			$this->load->view('createDokumenEksekutor', $data);
			$this->load->view('shared/footer');
        }
		else{
	        if ( ! $this->upload->do_upload('file'))
	        {
	            $error = array('error' => $this->upload->display_errors());
	            $data = $this->page_view("Tambah Dokumen MOU Eksekutor");
				$data['mous'] = $this->m_DocMOUEks->getAllMOU();
				$data['message'] = "Dokumen MOU Eksekutor baru gagal ditambahkan, silakan input kembali... ".$error['error'];
				$this->load->view('shared/header', $data);
				$this->load->view('createDokumenEksekutor', $data);
				$this->load->view('shared/footer');
	        }
	        else
	        {
	        	$upload_data = $this->upload->data(); 
				$nama_file = $upload_data['file_name'];
				$alamat_file = $config['upload_path'].$nama_file;

	        	$arr = array( 'id_mou_eksekutor' => $id_mou_eksekutor,
				'nama_file' => $nama_file,
				'alamat_file' => $alamat_file);

				$result = $this->m_DocMOUEks->input_data($arr);

				if($result == 1){
					$this->session->set_flashdata('message', 'Dokumen MOU Eksekutor baru berhasil ditambahkan...');
			  		redirect(site_url().'/dokumen/DocMOUEks');
				} else {
					$data = $this->page_view("Tambah Dokumen MOU Eksekutor");
					$data['mous'] = $this->m_DocMOUEks->getAllMOU();
					$data['message'] = "Dokumen MOU Eksekutor baru gagal ditambahkan, silakan input kembali...";
					$this->load->view('shared/header', $data);
					$this->load->view('createDokumenEksekutor', $data);
					$this->load->view('shared/footer');
				}
	        }
        }		
	}
	
	public function prosesUpdate(){
		
		$data = $this->page_view("Edit Dokumen MOU Eksekutor");
		$id_mou_eksekutor = $this->input->post('id_mou_eksekutor');
		$id_dokumen_mou_eksekutor = $this->input->post('id_dokumen_mou_eksekutor');

		$config['upload_path'] = './uploads/mou eksekutor';
		$config['allowed_types'] = '*';

		$this->load->library('upload', $config);

		$this->form_validation->set_rules('id_mou_eksekutor','No Proyek','required',
			array('required'=>'%s harus di isi.'));
		
		if ($this->form_validation->run() == FALSE){
			$data = $this->page_view("Tambah Dokumen MOU Eksekutor");
			$data['mous'] = $this->m_DocMOUEks->getAllMOU();
			$this->load->view('shared/header', $data);
			$this->load->view('createDokumenEksekutor', $data);
			$this->load->view('shared/footer');
        }
		else{
			if (empty($_FILES['file']['name']))
			{
			    $arr = array( 'id_mou_eksekutor' => $id_mou_eksekutor);
				
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
			else{
		        if ( ! $this->upload->do_upload('file'))
		        {
		            $error = array('error' => $this->upload->display_errors());
		            $data = $this->page_view("Tambah Dokumen MOU Eksekutor");
					$data['mous'] = $this->m_DocMOUEks->getAllMOU();
					$data['message'] = "Dokumen MOU Eksekutor baru gagal diperbarui, silakan input kembali... ".$error['error'];
					$this->load->view('shared/header', $data);
					$this->load->view('editDokumenEksekutor', $data);
					$this->load->view('shared/footer');
		        }
		        else
		        {
		        	$upload_data = $this->upload->data(); 
					$nama_file = $upload_data['file_name'];
					$alamat_file = $config['upload_path'].$nama_file;

		        	$arr = array( 'id_mou_eksekutor' => $id_mou_eksekutor,
					'nama_file' => $nama_file,
					'alamat_file' => $alamat_file);

					$result = $this->m_DocMOUEks->update_data($arr, $id_dokumen_mou_eksekutor);

					if($result == 1){
						$this->session->set_flashdata('message', 'Dokumen MOU Eksekutor baru berhasil diperbarui...');
				  		redirect(site_url().'/dokumen/DocMOUEks');
					} else {
						$data = $this->page_view("Tambah Dokumen MOU Eksekutor");
						$data['mous'] = $this->m_DocMOUEks->getAllMOU();
						$data['message'] = "Dokumen MOU Eksekutor baru gagal diperbarui, silakan input kembali...";
						$this->load->view('shared/header', $data);
						$this->load->view('editDokumenEksekutor', $data);
						$this->load->view('shared/footer');
					}
		        }
		    }
        }

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
		$DocMOUEkss = $this->m_DocMOUEks->get_dokumen_byID($id);
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
		$this->load->view('editDokumenEksekutor', $data);
		$this->load->view('shared/footer');
		
	}

	public function download(){
		$this->load->helper('download');
		$id = $this->uri->segment('4');
		$DocMOUEkss = $this->m_DocMOUEks->get_dokumen_byID($id);
		foreach($DocMOUEkss as $r){
			$docs = $r;
		}
		$data = file_get_contents($docs['alamat_file']); // Read the file's contents
		$name = basename($docs['nama_file']);
		force_download($name, $data);
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
