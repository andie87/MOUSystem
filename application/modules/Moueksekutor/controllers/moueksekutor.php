<!--
* Author : Andi Mulya I
-->
<?php

class Moueksekutor extends CI_Controller{

	function __constract(){
		parent::__constract();
	}

	public function index(){

		$data = $this->page_view("List MoU dengan Eksekutor", "view");
		if(strlen($this->session->flashdata('message')) > 0){
			$data['message'] = $this->session->flashdata('message');
		}
		if(strlen($this->session->flashdata('message_failed')) > 0){
			$data['message_failed'] = $this->session->flashdata('message_failed');
		}

		if( $this->input->post('key') != null ){
			$data['no_proyek'] = $this->input->post('no_proyek') == null ? null : $this->input->post('no_proyek');
			$data['nama_proyek'] = $this->input->post('nama_proyek') == null ? null : $this->input->post('nama_proyek');
			$data['alamat_proyek'] = $this->input->post('alamat_proyek') == null ? null : $this->input->post('alamat_proyek');
			$data['progress'] = $this->input->post('progress') == null ? null : $this->input->post('progress');
			$data['from_mou'] = $this->input->post('from_mou') == null ? null : $this->input->post('from_mou');
			$data['to_mou'] = $this->input->post('to_mou') == null ? null : $this->input->post('to_mou');
			$data['from_pengerjaan'] = $this->input->post('from_pengerjaan') == null ? null : $this->input->post('from_pengerjaan');
			$data['to_pengerjaan'] = $this->input->post('to_pengerjaan') == null ? null : $this->input->post('to_pengerjaan');
			$data['jenis_proyek'] = $this->input->post('jenis_proyek') == "All" ? null : $this->input->post('jenis_proyek');
			$data['moueksekutors'] = $this->m_moueksekutor->getAll($data);
			$data['search'] = "in";
		} else {
			$data['moueksekutors'] = $this->m_moueksekutor->getAll();
			$data['search'] = "";
		}

		if($this->input->post('report') > 0){
			$this->load->helper('download');
			$data['moueksekutors'] = $this->m_moueksekutor->getAllinArray($data);
			for($i=0; $i<count($data['moueksekutors']); $i++) {
				//mengambil nama donatur
				$donatur = $this->m_moueksekutor->getEksekutorById($data['moueksekutors'][$i]['id_eksekutor']);
				$data['moueksekutors'][$i]['nama_eksekutor'] = $donatur[0]['nama_eksekutor'];
				//mengambil nama provinsi
				$provinsi = $this->m_moudonatur->getProvinsiById($data['moueksekutors'][$i]['id_provinsi']);
				if(count($provinsi) > 0){
					$data['moueksekutors'][$i]['nama_provinsi'] = $provinsi[0]['nama_provinsi'];
				} else {
					$data['moueksekutors'][$i]['nama_provinsi'] = "";
				}
				//mengambil nama kota
				$kota = $this->m_moudonatur->getKotaKabById($data['moueksekutors'][$i]['id_kota_kab']);
				if(count($kota) > 0){
					$data['moueksekutors'][$i]['nama_kota'] = $kota[0]['nama_kota_kab'];
				} else {
					$data['moueksekutors'][$i]['nama_kota'] = "";
				}
				//mengambil nama kecamatan
				$kecamatan = $this->m_moudonatur->getKecamatanById($data['moueksekutors'][$i]['id_kecamatan']);
				if(count($kecamatan) > 0){
					$data['moueksekutors'][$i]['nama_kecamatan'] = $kecamatan[0]['nama_kecamatan'];	
				} else {
					$data['moueksekutors'][$i]['nama_kecamatan'] = "";
				}
				
				
				$jenis_proyek = $this->m_moudonatur->getJenisProyekById($data['moueksekutors'][$i]['id_jenis_proyek']);
				$data['moueksekutors'][$i]['jenis_proyek'] = $jenis_proyek[0]['nama_proyek'];
			}
			$text = $this->load->view('report', $data, true);
			$name = 'report_mou_eksekutor.html';
			force_download($name, $text);
			
		}

		$data['proyeks'] = $this->m_moudonatur->get_jenis_proyek();
		$data['jenis_proyek_array'] = $this->m_moueksekutor->get_jenis_proyek_array();
		$arr_proyek = array();
		foreach($data['jenis_proyek_array'] as $r){
			$arr_proyek[$r['id_jenis_proyek']] = $r['nama_proyek'];
		}
		$data['eksekutor_array'] = $this->m_moueksekutor->get_eksekutor_array();
		$arr_eksekutor = array();
		foreach($data['eksekutor_array'] as $r){
			$arr_eksekutor[$r['id_eksekutor']] = $r['nama_eksekutor'];
		}
		$data['arr_eksekutor'] = $arr_eksekutor;
		$data['arr_proyek'] = $arr_proyek;
		$data['granted_access'] = $this->session->userdata('access');
		
		$this->load->view('shared/header', $data);
		$this->load->view('index', $data);
		$this->load->view('shared/footer');
		
	}

	public function create(){
		
		$data = $this->page_view("MoU Baru", "create");
		$data['eksekutors'] = $this->m_moueksekutor->get_eksekutor();
		$data['moudonatur'] = $this->m_moueksekutor->get_moudonatur();
		$data['provins'] = $this->m_moueksekutor->get_provinsi();
		$data['proyeks'] = $this->m_moueksekutor->get_jenis_proyek();
		$this->load->view('shared/header', $data);
		$this->load->view('create', $data);
		$this->load->view('shared/footer');
	}
	
	public function edit(){
		
		$page_title = "Edit MoU";
		$id = $this->uri->segment('3');
		$this->master_edit($id, $page_title);
				
	}
	
	public function view(){
		
		$page_title = "View MoU";
		$id = $this->uri->segment('3');
		$this->master_view($id, $page_title);
				
	}
	
	public function view_m(){
		
		$page_title = "View MoU";
		$id = $this->uri->segment('3');
		$this->master_view($id, $page_title, null, "view_minus_biaya");
				
	}

	public function dokumen(){
		
		$this->master_dokumen("dokumen");
		
	}
	
	public function dokumenView(){
		
		$this->master_dokumen("dokumenView");
		
	}
	
	private function master_dokumen($dokumen_view){
		
		$page_title = "Dokumen MoU";
		$id = $this->uri->segment('3');
		$data = $this->page_view($page_title, "view");

		if(strlen($id) > 0){
			$id_mou_eksekutor_for_dokumen = array( 'id_mou_eksekutor_for_dokumen' => $id );
			$this->session->set_userdata($id_mou_eksekutor_for_dokumen);	
		}
		
		if(strlen($this->session->flashdata('message')) > 0){
			$data['message'] = $this->session->flashdata('message');	
		} else if(strlen($this->session->flashdata('messageOK')) > 0){
			$data['messageOK'] = $this->session->flashdata('messageOK');
		}
		
		$data['id_mou_eksekutor'] = $this->session->userdata("id_mou_eksekutor_for_dokumen");
		$data['dokumens'] = $this->m_moueksekutor->getDokumenByMoueksekutorId($data['id_mou_eksekutor']);
		$data['granted_access'] = $this->session->userdata('access'); 
		$this->load->view('shared/header', $data);
		$this->load->view($dokumen_view, $data);
		$this->load->view('shared/footer');
		
	}
	
	public function uploadDokumen(){
		
		$page_title = "Dokumen MoU";
		$id = $this->input->post('mou_eksekutor');
		$data = $this->page_view($page_title, "create", "dokumeneksekutor");
		
		$path = "./uploads/mou eksekutor/".$id."/";
		if(!is_dir($path)) {
	      mkdir($path,0755,TRUE);
	    } 
		$config['upload_path'] = $path;
		$config['allowed_types'] = '*';
		$this->load->library('upload', $config);
			
		if ( ! $this->upload->do_upload('file')) {
			
			$this->session->set_flashdata('message', "Upload gagal, silakan pilih file untuk upload...");
        
		} else {
        
			$upload_data = $this->upload->data(); 
			$nama_file = $upload_data['file_name'];
			$alamat_file = $config['upload_path'].$nama_file;
			
			$arr = array( 'id_mou_eksekutor' => $id,
						'nama_file' => $nama_file,
						'alamat_file' => $alamat_file
		 			);
		 			
			$result = $this->m_moueksekutor->input_data_dokumen($arr);
	
			if($result == 1){
				$this->session->set_flashdata('messageOK', "Proses upload berhasil...");
			} else {
				$this->session->set_flashdata('message', "Proses upload gagal, silakan coba kembali...");
			}
        }
		
        $this->session->set_flashdata('id_mou_eksekutor', $id);
		redirect(site_url().'/moueksekutor/dokumen');
		
	}
	
	public function download(){
		
		$this->load->helper('download');
		$id = $this->uri->segment('4');
		$doc = $this->m_moueksekutor->getDokumenById($id);
		if(count($doc) > 0){
			$data = file_get_contents($doc[0]['alamat_file']); // Read the file's contents
			$name = basename($doc[0]['nama_file']);
			force_download($name, $data);
		} 
		
	}
	
	public function deleteDokumen(){
		
		$id = $id = $this->uri->segment('4');
		$arr = array( 'id_dokumen_mou_eksekutor' => $id );
		$doc = $this->m_moueksekutor->getDokumenById($id);
		$result = $this->m_moueksekutor->delete_dokumen($arr);
		$file = substr($doc[0]['alamat_file'], 2);
		//hapus file
		if (file_exists($file)) {
	        unlink($file);
	    } 
		if($result == 1){
			$this->session->set_flashdata('messageOK', 'Dokumen berhasil dihapus...');
		} else {
			$this->session->set_flashdata('message', 'Dokumen gagal dihapus!');
		}
		redirect(site_url().'/moueksekutor/dokumen');
		
	}
	
	public function pembayaranView(){
		
		$this->master_pembayaran("pembayaranView");
		
	}
	
	public function pembayaran(){
		
		$this->master_pembayaran("pembayaran");
	
	}
	
	private function master_pembayaran($pembayaran_view){
		
		$page_title = "Pembayaran Eksekutor";
		$id = $this->uri->segment('3');
		$data = $this->page_view($page_title, "view");

		if(strlen($id) > 0){
			$id_mou_eksekutor_for_pembayaran = array( 'id_mou_eksekutor_for_pembayaran' => $id );
			$this->session->set_userdata($id_mou_eksekutor_for_pembayaran);	
		}
		
		if(strlen($this->session->flashdata('message')) > 0){
			$data['message'] = $this->session->flashdata('message');	
		} else if(strlen($this->session->flashdata('messageOK')) > 0){
			$data['messageOK'] = $this->session->flashdata('messageOK');
		}
		
		$data['id_mou_eksekutor'] = $this->session->userdata("id_mou_eksekutor_for_pembayaran");
		$data['pembayaran'] = $this->m_moueksekutor->getPembayaranByMouEksekutorId($data['id_mou_eksekutor']);
		$data['granted_access'] = $this->session->userdata('access'); 
		$this->load->view('shared/header', $data);
		$this->load->view($pembayaran_view, $data);
		$this->load->view('shared/footer');
		
	}
	
	public function createPembayaran(){
		
		$mou_eksekutor = $this->input->post('mou_eksekutor');
		$nominal_pembayaran = str_replace(".", "", $this->input->post('nominal_pembayaran'));
		$persen_pembayaran = $this->input->post('persen_pembayaran');
		$pembayaran_ke = $this->input->post('pembayaran_ke');
		$tgl_pembayaran = getMysqlFormatDate($this->input->post('tgl_pembayaran')); 
		$tgl_deadline_pembayaran = getMysqlFormatDate($this->input->post('tgl_deadline_pembayaran')); 
		
		$arr = array( 'id_mou_eksekutor' => $mou_eksekutor,
						'nominal_pembayaran' => $nominal_pembayaran,
						'persen_pembayaran' => $persen_pembayaran,
						'pembayaran_ke' => $pembayaran_ke,
						'tanggal_pembayaran' => $tgl_pembayaran,
						'tanggal_deadline_pembayaran' => $tgl_deadline_pembayaran
		 			);
		 			
		$result = $this->m_moueksekutor->input_data_pembayaran($arr);

		if($result == 1){
			$this->session->set_flashdata('messageOK', "Pembayaran Eksekutor berhasil disimpan");
		} else {
			$this->session->set_flashdata('message', "Pembayaran Eksekutor gagal disimpan");
		}
		
        $this->session->set_flashdata('id_mou_eksekutor', $id);
		redirect(site_url().'/moueksekutor/pembayaran');
		
	}
	
	public function deletePembayaran(){
		
		$id = $id = $this->uri->segment('4');
		$arr = array( 'id_pembayaran_eksekutor' => $id );
		$result = $this->m_moueksekutor->delete_pembayaran($arr);
		if($result == 1){
			$this->session->set_flashdata('messageOK', 'Pembayaran berhasil dihapus...');
		} else {
			$this->session->set_flashdata('message', 'Pembayaran gagal dihapus!');
		}
		redirect(site_url().'/moueksekutor/pembayaran');
		
	}
	
	public function editPembayaran(){
		
		$page_title = "Pembayaran Eksekutor";
		$id = $this->uri->segment('4');
		$data = $this->page_view($page_title, "edit");
		
		$dok = $this->m_moueksekutor->getPembayaranById($id);
		$data['dok'] = $dok[0];
		$data['id_mou_eksekutor'] = $this->session->userdata("id_mou_eksekutor_for_pembayaran");
		$data['pembayaran'] = $this->m_moueksekutor->getPembayaranByMouEksekutorId($data['id_mou_eksekutor']);
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
		 			
		$result = $this->m_moueksekutor->update_data_pembayaran($arr, $id_pembayaran_eksekutor);

		if($result == 1){
			$this->session->set_flashdata('messageOK', "Pembayaran Eksekutor berhasil di-update");
		} else {
			$this->session->set_flashdata('message', "Pembayaran Eksekutor gagal di-update");
		}
		
        $this->session->set_flashdata('id_mou_eksekutor', $id);
		redirect(site_url().'/moueksekutor/pembayaran');
		
	}
	
	public function delete(){
		
		$data = $this->page_view("List Role", "delete");
		$id = $this->input->post('id');
		$arr = array( 'id_mou_eksekutor' => $id );
		$result = $this->m_moueksekutor->delete_data($arr);
		if($result == 1){
			$this->session->set_flashdata('message', 'MoU Eksekutor berhasil dihapus...');
		} else {
			$this->session->set_flashdata('message_failed', 'MoU Eksekutor gagal dihapus!');
		}
  		redirect(site_url().'/moueksekutor');
		
	}

	public function prosesCreate(){
		
		$data = $this->page_view("List MoU Eksekutor", "create");
		
		$id_eksekutor = $this->input->post('id_eksekutor');
		$id_mou_donatur = $this->input->post('id_mou_donatur');
		$tanggal_mou = getMysqlFormatDate($this->input->post('tanggal_mou')); 
		$tanggal_mou_hijriah = $this->input->post('tanggal_mou_hijriah'); 
		$tanggal_pengerjaan = getMysqlFormatDate($this->input->post('tanggal_pengerjaan')); 
		$nama_eksekutor = $this->input->post('nama_eksekutor');
		$alamat_eksekutor = $this->input->post('alamat_eksekutor');
		$jabatan_eksekutor = $this->input->post('jabatan_eksekutor');
		$kontak_eksekutor = $this->input->post('kontak_eksekutor');
		$nama_proyek = $this->input->post('nama_proyek');
		$id_jenis_proyek = $this->input->post('id_jenis_proyek');
		$deskripsi_proyek = $this->input->post('deskripsi_proyek');
		$ukuran = $this->input->post('ukuran');
		$provinsi = $this->input->post('provinsi');
		$kota = $this->input->post('kota');
		$kecamatan = $this->input->post('kecamatan');
		$alamat_lokasi = $this->input->post('alamat_lokasi');
		$koordinat_lokasi = $this->input->post('koordinat_lokasi');
		$nilai_proyek = str_replace(".", "", $this->input->post('nilai_proyek'));
		$is_banner = $this->input->post('is_banner');
		$is_prasasti = $this->input->post('is_prasasti');
		$pic_lokasi = $this->input->post('pic_lokasi');
		$kontak_pic_lokasi = $this->input->post('kontak_pic_lokasi');
		$alamat_pic_lokasi = $this->input->post('alamat_pic_lokasi');
		$nama_bangunan_di_lokasi = $this->input->post('nama_bangunan_di_lokasi');
		$tanggal_selesai = getMysqlFormatDate($this->input->post('tanggal_selesai')); 
		
		
		$arr = array( 'id_eksekutor' => $id_eksekutor,
						'id_mou_donatur' => $id_mou_donatur,
						'tanggal_mou' => $tanggal_mou, 
						'tanggal_mou_hijriah' => $tanggal_mou_hijriah, 
						'tanggal_pengerjaan' => $tanggal_pengerjaan, 
						'nama_eksekutor' => $nama_eksekutor,
						'alamat_eksekutor' => $alamat_eksekutor,
						'jabatan_eksekutor' => $jabatan_eksekutor,
						'kontak_eksekutor' => $kontak_eksekutor,
						'nama_proyek' => $nama_proyek,
						'id_jenis_proyek' => $id_jenis_proyek,
						'deskripsi_proyek' => $deskripsi_proyek,
						'ukuran' => $ukuran,
						'id_provinsi' => $provinsi,
						'id_kota_kab' => $kota,
						'id_kecamatan' => $kecamatan,
						'alamat_lokasi' => $alamat_lokasi,
						'koordinat_lokasi' => $koordinat_lokasi,
						'nilai_proyek' => $nilai_proyek,
						'is_banner' => $is_banner,
						'is_prasasti' => $is_prasasti,
						'pic_lokasi' => $pic_lokasi,
						'kontak_pic_lokasi' => $kontak_pic_lokasi,
						'alamat_pic_lokasi' => $alamat_pic_lokasi,
						'nama_bangunan_di_lokasi' => $nama_bangunan_di_lokasi,
						'tanggal_selesai' => $tanggal_selesai
		 			);
		 			
		$result = $this->m_moueksekutor->input_data($arr);

		if($result == 1){
			$this->session->set_flashdata('message', 'MoU baru berhasil ditambahkan...');
	  		redirect(site_url().'/moueksekutor');
		} else {
			$data = $this->page_view("Tambah MoU Eksekutor", "create");
			$data['message'] = "MoU baru gagal ditambahkan, silakan input kembali...";
			$data['eksekutors'] = $this->m_moueksekutor->get_eksekutor();
			$data['moudonatur'] = $this->m_moueksekutor->get_moudonatur();
			$data['provins'] = $this->m_moueksekutor->get_provinsi();
			$data['proyeks'] = $this->m_moueksekutor->get_jenis_proyek();		
			$this->load->view('shared/header', $data);
			$this->load->view('create', $data);
			$this->load->view('shared/footer');
		}
		
	}
	
	public function prosesUpdate(){
		
		$data = $this->page_view("List MoU Eksekutor", "edit");
		$id_mou_eksekutor = $this->input->post('id_mou_eksekutor');
		$id_eksekutor = $this->input->post('id_eksekutor');
		$id_mou_donatur = $this->input->post('id_mou_donatur');
		$tanggal_mou = getMysqlFormatDate($this->input->post('tanggal_mou')); 
		$tanggal_mou_hijriah = $this->input->post('tanggal_mou_hijriah'); 
		$tanggal_pengerjaan = getMysqlFormatDate($this->input->post('tanggal_pengerjaan')); 
		$nama_eksekutor = $this->input->post('nama_eksekutor');
		$alamat_eksekutor = $this->input->post('alamat_eksekutor');
		$jabatan_eksekutor = $this->input->post('jabatan_eksekutor');
		$kontak_eksekutor = $this->input->post('kontak_eksekutor');
		$nama_proyek = $this->input->post('nama_proyek');
		$id_jenis_proyek = $this->input->post('id_jenis_proyek');
		$deskripsi_proyek = $this->input->post('deskripsi_proyek');
		$ukuran = $this->input->post('ukuran');
		$provinsi = $this->input->post('provinsi');
		$kota = $this->input->post('kota');
		$kecamatan = $this->input->post('kecamatan');
		$alamat_lokasi = $this->input->post('alamat_lokasi');
		$koordinat_lokasi = $this->input->post('koordinat_lokasi');
		$nilai_proyek = str_replace(".", "", $this->input->post('nilai_proyek'));
		$is_banner = $this->input->post('is_banner');
		$is_prasasti = $this->input->post('is_prasasti');
		$pic_lokasi = $this->input->post('pic_lokasi');
		$kontak_pic_lokasi = $this->input->post('kontak_pic_lokasi');
		$alamat_pic_lokasi = $this->input->post('alamat_pic_lokasi');
		$nama_bangunan_di_lokasi = $this->input->post('nama_bangunan_di_lokasi');
		$tanggal_selesai = getMysqlFormatDate($this->input->post('tanggal_selesai')); 
		$progress_proyek = $this->input->post('progress_proyek');
		
		
		$arr = array( 'id_eksekutor' => $id_eksekutor,
						'id_mou_donatur' => $id_mou_donatur,
						'tanggal_mou' => $tanggal_mou, 
						'tanggal_mou_hijriah' => $tanggal_mou_hijriah, 
						'tanggal_pengerjaan' => $tanggal_pengerjaan, 
						'nama_eksekutor' => $nama_eksekutor,
						'alamat_eksekutor' => $alamat_eksekutor,
						'jabatan_eksekutor' => $jabatan_eksekutor,
						'kontak_eksekutor' => $kontak_eksekutor,
						'nama_proyek' => $nama_proyek,
						'id_jenis_proyek' => $id_jenis_proyek,
						'deskripsi_proyek' => $deskripsi_proyek,
						'ukuran' => $ukuran,
						'id_provinsi' => $provinsi,
						'id_kota_kab' => $kota,
						'id_kecamatan' => $kecamatan,
						'alamat_lokasi' => $alamat_lokasi,
						'koordinat_lokasi' => $koordinat_lokasi,
						'nilai_proyek' => $nilai_proyek,
						'is_banner' => $is_banner,
						'is_prasasti' => $is_prasasti,
						'pic_lokasi' => $pic_lokasi,
						'kontak_pic_lokasi' => $kontak_pic_lokasi,
						'alamat_pic_lokasi' => $alamat_pic_lokasi,
						'nama_bangunan_di_lokasi' => $nama_bangunan_di_lokasi,
						'tanggal_selesai' => $tanggal_selesai,
						'progress_proyek' => $progress_proyek
		 			);
		
		$result = $this->m_moueksekutor->update_data($arr, $id_mou_eksekutor);

		if($result == 1){
			$this->session->set_flashdata('message', 'MoU berhasil diperbarui...');
	  		redirect(site_url().'/moueksekutor');
		} else {
			$page_title = "Edit MoU Eksekutor";
			$message = "MoU gagal diperbarui, silakan input kembali...";
			$this->master_edit($id_role, $page_title, $message);
		}
		
	}
	
	private function master_edit($id, $page_title, $message=null){
		
		$data = $this->page_view($page_title, "edit");
		$data['eksekutors'] = $this->m_moueksekutor->get_eksekutor();
		$data['moudonatur'] = $this->m_moueksekutor->get_moudonatur();
		$data['provins'] = $this->m_moueksekutor->get_provinsi();
		$data['proyeks'] = $this->m_moueksekutor->get_jenis_proyek();
		$data['message'] = $message;
		$data['id'] = $id;
		$moueksekutors = $this->m_moueksekutor->getMoueksekutorById($id);
		$data['kotas'] = $this->m_moueksekutor->get_kotakab_by_prov($moueksekutors[0]['id_provinsi']);
		$data['kecamatan'] = $this->m_moudonatur->get_kecamatan_by_kota($moueksekutors[0]['id_kota_kab']);
		if($moueksekutors == null){
			//jika ID bernilai null, besar kemungkinan user melakukan direct hit url ke server
			redirect(site_url().'/login');
		} else {
			if($moueksekutors){
				foreach($moueksekutors as $m){
					$data['moueksekutor'] = $m;
				}
			} else {
				$data['moueksekutor'] = null;
			}
		}
		$data['moueksekutor']['tanggal_mou'] = $data['moueksekutor']['tanggal_mou']=="0000-00-00" ? "" : getUserFormatDate($data['moueksekutor']['tanggal_mou']); 
		$data['moueksekutor']['tanggal_pengerjaan'] = $data['moueksekutor']['tanggal_pengerjaan']=="0000-00-00" ? "" : getUserFormatDate($data['moueksekutor']['tanggal_pengerjaan']);
		$data['moueksekutor']['tanggal_selesai'] = $data['moueksekutor']['tanggal_selesai']=="0000-00-00" ? "" : getUserFormatDate($data['moueksekutor']['tanggal_selesai']);
		$data['granted_access'] = $this->session->userdata('access'); 
		$this->load->view('shared/header', $data);
		$this->load->view('edit', $data);
		$this->load->view('shared/footer');
		
	}

	public function report(){
		$id = $this->uri->segment(3);
		$this->load->helper('download');
		$data['eksekutors'] = $this->m_moueksekutor->get_eksekutor();
		$data['moudonatur'] = $this->m_moueksekutor->get_moudonatur();
		$data['provins'] = $this->m_moueksekutor->get_provinsi();
		$data['proyeks'] = $this->m_moueksekutor->get_jenis_proyek();
		$data['message'] = $message;
		$data['id'] = $id;
		$moueksekutors = $this->m_moueksekutor->getMoueksekutorById($id);
		$data['kotas'] = $this->m_moueksekutor->get_kotakab_by_prov($moueksekutors[0]['id_provinsi']);
		$data['kecamatan'] = $this->m_moudonatur->get_kecamatan_by_kota($moueksekutors[0]['id_kota_kab']);
		if($moueksekutors == null){
			//jika ID bernilai null, besar kemungkinan user melakukan direct hit url ke server
			redirect(site_url().'/login');
		} else {
			if($moueksekutors){
				foreach($moueksekutors as $m){
					$data['moueksekutor'] = $m;
				}
			} else {
				$data['moueksekutor'] = null;
			}
		}
		$data['moueksekutor']['tanggal_mou'] = $data['moueksekutor']['tanggal_mou']=="0000-00-00" ? "" : getUserFormatDate($data['moueksekutor']['tanggal_mou']); 
		$data['moueksekutor']['tanggal_pengerjaan'] = $data['moueksekutor']['tanggal_pengerjaan']=="0000-00-00" ? "" : getUserFormatDate($data['moueksekutor']['tanggal_pengerjaan']);
		$data['moueksekutor']['tanggal_selesai'] = $data['moueksekutor']['tanggal_selesai']=="0000-00-00" ? "" : getUserFormatDate($data['moueksekutor']['tanggal_selesai']);
		$text = $this->load->view('reportProjek', $data, true);
		$name = 'report_mou_eksekutor_'.$data['moueksekutor']['moudonatur_nomor_proyek'].'.html';
		force_download($name, $text);
	}
	
	private function master_view($id, $page_title, $message=null, $view=null){
		
		$data = $this->page_view($page_title, "view");
		$data['eksekutors'] = $this->m_moueksekutor->get_eksekutor();
		$data['moudonatur'] = $this->m_moueksekutor->get_moudonatur();
		$data['provins'] = $this->m_moueksekutor->get_provinsi();
		$data['proyeks'] = $this->m_moueksekutor->get_jenis_proyek();
		$data['message'] = $message;
		$data['id'] = $id;
		$moueksekutors = $this->m_moueksekutor->getMoueksekutorById($id);
		$data['kotas'] = $this->m_moueksekutor->get_kotakab_by_prov($moueksekutors[0]['id_provinsi']);
		$data['kecamatan'] = $this->m_moudonatur->get_kecamatan_by_kota($moueksekutors[0]['id_kota_kab']);
		if($moueksekutors == null){
			//jika ID bernilai null, besar kemungkinan user melakukan direct hit url ke server
			redirect(site_url().'/login');
		} else {
			if($moueksekutors){
				foreach($moueksekutors as $m){
					$data['moueksekutor'] = $m;
				}
			} else {
				$data['moueksekutor'] = null;
			}
		}
		$data['moueksekutor']['tanggal_mou'] = getUserFormatDate($data['moueksekutor']['tanggal_mou']); 
		$data['moueksekutor']['tanggal_pembangunan'] = getUserFormatDate($data['moueksekutor']['tanggal_pengerjaan']); 
		$data['granted_access'] = $this->session->userdata('access');
		$this->load->view('shared/header', $data);
		if($view == "view_minus_biaya"){
			$this->load->view('view_m', $data);
		} else {
			$this->load->view('view', $data);
		}
		$this->load->view('shared/footer');
		
	}
	
	private function page_view($page, $access_level, $module="moueksekutor"){
		
		//no user session, redirect to login page
		if($this->session->userdata('userlogin')==""){
			redirect(site_url().'/login');
		}
		
		//manage access
		if($module=="dokumeneksekutor"){
			$access_moueksekutor = "dokumeneksekutor";	
		} else {
			$access_moueksekutor = "moueksekutor";
		}
		
		$granted_access = $this->session->userdata('access');
		if(isset($granted_access[$access_moueksekutor])){
			if(strpos($granted_access[$access_moueksekutor], $access_level) === false){
				//jika tidak ada akses ke function ini maka arahkan ke dashboard
				redirect(site_url().'/dashboard');
			}
		} else {
			//jika tidak ada akses ke halaman ini maka arahkan ke dashboard
			redirect(site_url().'/dashboard');
		}
		
		$data['page'] = $page;
		$data['menuaktif'] = $access_moueksekutor;
		$data['menu'] = $this->session->userdata('access');
		return $data;
	
	}
	
	public function selectkotakab(){
		
		$id = $this->uri->segment('3');
		$data['kotas'] = $this->m_moueksekutor->get_kotakab_by_prov($id);
		$this->load->view('selectkotakab', $data);
		
	}
	
}
?>