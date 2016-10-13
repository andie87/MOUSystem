<!--
* Author : Ahmad Shodiqi
-->
<?php

class Pembayaraneksekutor extends CI_Controller{

	function __constract(){
		parent::__constract();
	}
	
	public function download(){
		
		$this->load->helper('download');
		$id = $this->uri->segment('3');
		$doc = $this->m_moueksekutor->getPembayaranById($id);
		if(count($doc) > 0){
			if(strlen($doc[0]['file']) > 1){
				$data = file_get_contents($doc[0]['file']); // Read the file's contents
				$name = basename($doc[0]['file']);
				force_download($name, $data);	
			} else {
				$this->session->set_flashdata('message', 'File belum di-upload!');
				redirect(site_url().'/pembayaraneksekutor/index');	
			}
		} 
		
	}
	
	public function pembayaranView(){
		
		$this->master_pembayaran("view");
		
	}
	
	public function search_noproyek(){
		
		$nomor_proyek = $this->input->post('nomor_proyek');
		$no_proyek_eksekutor = array('nomor_proyek_pembayaran_eksekutor' => $nomor_proyek);
		$this->session->set_userdata($no_proyek_eksekutor);
		$this->session->set_flashdata("messageOK", "Nomor proyek <label style='color:yellow'>".$nomor_proyek."</label> telah dipilih...");
		redirect(site_url().'/pembayaraneksekutor/index');
		
	}
	
	public function index(){
		
		$granted_access = $this->session->userdata('access');
		if(strpos($granted_access['pembayaraneksekutor'], 'create') !== false){
			$this->master_pembayaran("create");
		} else {
			$this->master_pembayaran("view");
		}

	}
	
	private function master_pembayaran($pembayaran_view){
		
		$page_title = "Pembayaran Eksekutor";
		$data = $this->page_view($page_title, $pembayaran_view);

		if(strlen($this->session->flashdata('message')) > 0){
			$data['message'] = $this->session->flashdata('message');	
		} else if(strlen($this->session->flashdata('messageOK')) > 0){
			$data['messageOK'] = $this->session->flashdata('messageOK');
		}
		
		$data['moudonatur'] = $this->m_moueksekutor->get_moudonatur();
		$data['nomor_proyek'] = $this->session->userdata("nomor_proyek_pembayaran_eksekutor");
		$data['pembayaran'] = $this->m_moueksekutor->getPembayaranByNomorProyek($data['nomor_proyek']);	
		
		$this->load->view('shared/header', $data);
		$this->load->view($pembayaran_view, $data);
		$this->load->view('shared/footer');
		
	}
	
	public function createPembayaran(){
		
		$nomor_proyek = $this->session->userdata("nomor_proyek_pembayaran_eksekutor");
		if(strlen($nomor_proyek) < 1){
			$this->session->set_flashdata('message', "Silakan pilih nomor proyek terlebih dahulu...");
			redirect(site_url().'/pembayaraneksekutor/index');
		}
		$nominal_pembayaran = str_replace(".", "", $this->input->post('nominal_pembayaran'));
		$persen_pembayaran = $this->input->post('persen_pembayaran');
		$pembayaran_ke = $this->input->post('pembayaran_ke');
		$tgl_pembayaran = getMysqlFormatDate($this->input->post('tgl_pembayaran')); 
		$tgl_deadline_pembayaran = getMysqlFormatDate($this->input->post('tgl_deadline_pembayaran')); 
		
		$path = "./uploads/pembayaran eksekutor/".$nomor_proyek."/";
		if(!is_dir($path)) {
	    	mkdir($path,0755,TRUE);
	    } 
		$config['upload_path'] = $path;
		$config['allowed_types'] = '*';
		$config['max_size'] = 0;
		$this->load->library('upload', $config);
			
		$this->upload->do_upload('file');
		$filename = $this->upload->file_name;
		$upload_data = $this->upload->data(); 
		$nama_file = $upload_data['file_name'];
		if(strlen($nama_file) > 0){
			$alamat_file = $config['upload_path'].$nama_file;
		} else {
			$alamat_file = null;
		}
		
		$arr = array( 'nomor_proyek' => $nomor_proyek,
						'nominal_pembayaran' => $nominal_pembayaran,
						'persen_pembayaran' => $persen_pembayaran,
						'pembayaran_ke' => $pembayaran_ke,
						'tanggal_pembayaran' => $tgl_pembayaran,
						'tanggal_deadline_pembayaran' => $tgl_deadline_pembayaran,
						'file' => $alamat_file
		 			);
		 			
		$result = $this->m_moueksekutor->input_data_pembayaran($arr);

		if($result == 1){
			$this->session->set_flashdata('messageOK', "Pembayaran Eksekutor berhasil disimpan");
		} else {
			$this->session->set_flashdata('message', "Pembayaran Eksekutor gagal disimpan");
		}
		
        $this->session->set_flashdata('id_mou_eksekutor', $id);
		redirect(site_url().'/pembayaraneksekutor/index');
		
	}
	
	public function deletePembayaran(){
		
		$id = $id = $this->uri->segment('3');
		$arr = array( 'id_pembayaran_eksekutor' => $id );
		$result = $this->m_moueksekutor->delete_pembayaran($arr);
		if($result == 1){
			$this->session->set_flashdata('messageOK', 'Pembayaran berhasil dihapus...');
		} else {
			$this->session->set_flashdata('message', 'Pembayaran gagal dihapus!');
		}
		redirect(site_url().'/pembayaraneksekutor/index');
		
	}
	
	public function editPembayaran(){
		
		$page_title = "Pembayaran Eksekutor";
		$id = $this->uri->segment('3');
		$data = $this->page_view($page_title, "edit");
		
		$dok = $this->m_moueksekutor->getPembayaranById($id);
		$data['dok'] = $dok[0];
		$data['nomor_proyek'] = $this->session->userdata("nomor_proyek_pembayaran_eksekutor");
		$data['pembayaran'] = $this->m_moueksekutor->getPembayaranByNomorProyek($data['nomor_proyek']);
		$data['moudonatur'] = $this->m_moudonatur->get_moudonatur();
		$data['nomor_proyek'] = $this->session->userdata("nomor_proyek_pembayaran_eksekutor");
		
		$this->load->view('shared/header', $data);
		$this->load->view('editPembayaran', $data);
		$this->load->view('shared/footer');
		
	}
	
	public function updatePembayaran(){
		
		$id_pembayaran_eksekutor = $this->input->post('pembayaran_eksekutor');
		$nominal_pembayaran = str_replace(".", "", $this->input->post('nominal_pembayaran'));
		$persen_pembayaran = $this->input->post('persen_pembayaran');
		$pembayaran_ke = $this->input->post('pembayaran_ke');
		$tgl_pembayaran = getMysqlFormatDate($this->input->post('tgl_pembayaran')); 
		$tgl_deadline_pembayaran = getMysqlFormatDate($this->input->post('tgl_deadline_pembayaran')); 
		
		$arr = array( 'nominal_pembayaran' => $nominal_pembayaran,
						'persen_pembayaran' => $persen_pembayaran,
						'pembayaran_ke' => $pembayaran_ke,
						'tanggal_pembayaran' => $tgl_pembayaran,
						'tanggal_deadline_pembayaran' => $tgl_deadline_pembayaran
		 			);
		 			
		$path = "./uploads/pembayaran eksekutor/".$id_pembayaran_eksekutor."/";
		if(!is_dir($path)) {
	    	mkdir($path,0755,TRUE);
	    } 
		$config['upload_path'] = $path;
		$config['allowed_types'] = '*';
		$config['max_size'] = 0;
		$this->load->library('upload', $config);
			
		$this->upload->do_upload('file');
		$filename = $this->upload->file_name;
		$upload_data = $this->upload->data(); 
		$nama_file = $upload_data['file_name'];
		if(strlen($nama_file) > 0){
			$alamat_file = $config['upload_path'].$nama_file;
		} else {
			$alamat_file = null;
		}
		
		//menyimpan file upload
		if($alamat_file != null){
			$arr['file'] = $alamat_file;
		}
		 			
		$result = $this->m_moueksekutor->update_data_pembayaran($arr, $id_pembayaran_eksekutor);

		if($result == 1){
			$this->session->set_flashdata('messageOK', "Pembayaran Eksekutor berhasil di-update");
		} else {
			$this->session->set_flashdata('message', "Pembayaran Eksekutor gagal di-update");
		}
		
        $this->session->set_flashdata('id_mou_eksekutor', $id);
		redirect(site_url().'/pembayaraneksekutor/index');
		
	}
	
	private function page_view($page, $access_level){
		
		//no user session, redirect to login page
		if($this->session->userdata('userlogin')==""){
			redirect(site_url().'/login');
		}
		
		//manage access
		$access_pembayaraneksekutor = "pembayaraneksekutor";
		
		$granted_access = $this->session->userdata('access');
		if(isset($granted_access[$access_pembayaraneksekutor])){
			if(strpos($granted_access[$access_pembayaraneksekutor], $access_level) === false){
				//jika tidak ada akses ke function ini maka arahkan ke dashboard
				redirect(site_url().'/dashboard');
			}
		} else {
			//jika tidak ada akses ke halaman ini maka arahkan ke dashboard
			redirect(site_url().'/dashboard');
		}
		
		$data['page'] = $page;
		$data['menuaktif'] = $access_pembayaraneksekutor;
		$data['menu'] = $this->session->userdata('access');
		return $data;
	
	}
	
}
?>