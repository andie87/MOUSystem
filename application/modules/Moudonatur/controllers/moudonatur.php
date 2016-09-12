<!--
* Author : Ahmad Shodiqi
-->
<?php

class Moudonatur extends CI_Controller{

	function __constract(){
		parent::__constract();
	}

	public function index(){
		
		$this->master_index("");	
		
	}
	
	public function index_view(){
		
		$this->master_index("index_view");	
		
	}
	
	public function master_index($page){
		
		$data = $this->page_view("List MoU dengan Donatur");
		
		if(strlen($this->session->flashdata('message')) > 0){
			$data['message'] = $this->session->flashdata('message');
		}
		
		if(strlen($this->session->flashdata('message_failed')) > 0){
			$data['message_failed'] = $this->session->flashdata('message_failed');
		}
		
		if( $this->input->post('key') != null ){
			$data['nama_proyek'] = $this->input->post('nama_proyek') == null ? null : $this->input->post('nama_proyek');
			$data['nomor_proyek'] = $this->input->post('nomor_proyek') == null ? null : $this->input->post('nomor_proyek');
			$data['alamat_proyek'] = $this->input->post('alamat_proyek') == null ? null : $this->input->post('alamat_proyek');
			$data['progress'] = $this->input->post('progress') == null ? null : $this->input->post('progress');
			$data['from_mou'] = $this->input->post('from_mou') == null ? null : $this->input->post('from_mou');
			$data['to_mou'] = $this->input->post('to_mou') == null ? null : $this->input->post('to_mou');
			$data['from_pembangunan'] = $this->input->post('from_pembangunan') == null ? null : $this->input->post('from_pembangunan');
			$data['to_pembangunan'] = $this->input->post('to_pembangunan') == null ? null : $this->input->post('to_pembangunan');
			$data['jenis_proyek'] = $this->input->post('jenis_proyek') == "All" ? null : $this->input->post('jenis_proyek');
			$data['moudonaturs'] = $this->m_moudonatur->getAll($data);
		} else {
			$data['moudonaturs'] = $this->m_moudonatur->getAll();
		}
		
		//jika mengklik tombol report
		if($this->input->post('report') > 0){
			$this->load->helper('download');
			$data['moudonaturs'] = $this->m_moudonatur->getAllinArray($data);
			for($i=0; $i<count($data['moudonaturs']); $i++) {
				//mengambil nama donatur
				$donatur = $this->m_moudonatur->getDonaturById($data['moudonaturs'][$i]['id_donatur']);
				$data['moudonaturs'][$i]['nama_donatur'] = $donatur[0]['nama_donatur'];
				//mengambil nama provinsi
				$provinsi = $this->m_moudonatur->getProvinsiById($data['moudonaturs'][$i]['id_provinsi']);
				if(count($provinsi) > 0){
					$data['moudonaturs'][$i]['nama_provinsi'] = $provinsi[0]['nama_provinsi'];
				} else {
					$data['moudonaturs'][$i]['nama_provinsi'] = "";
				}
				//mengambil nama kota
				$kota = $this->m_moudonatur->getKotaKabById($data['moudonaturs'][$i]['id_kota_kab']);
				if(count($kota) > 0){
					$data['moudonaturs'][$i]['nama_kota'] = $kota[0]['nama_kota_kab'];
				} else {
					$data['moudonaturs'][$i]['nama_kota'] = "";
				}
				//mengambil nama kecamatan
				$kecamatan = $this->m_moudonatur->getKecamatanById($data['moudonaturs'][$i]['id_kecamatan']);
				if(count($kecamatan) > 0){
					$data['moudonaturs'][$i]['nama_kecamatan'] = $kecamatan[0]['nama_kecamatan'];	
				} else {
					$data['moudonaturs'][$i]['nama_kecamatan'] = "وَمِنْ آيَاتِهِ";
				}
				
				
				$jenis_proyek = $this->m_moudonatur->getJenisProyekById($data['moudonaturs'][$i]['id_jenis_proyek']);
				$data['moudonaturs'][$i]['jenis_proyek'] = $jenis_proyek[0]['nama_proyek'];
			}
			$text = $this->load->view('report', $data, true);
			$name = 'report_mou_donatur.html';
			force_download($name, $text);
			
		}
		
		$data['proyeks'] = $this->m_moudonatur->get_jenis_proyek();
		$data['jenis_proyek_array'] = $this->m_moudonatur->get_jenis_proyek_array();
		$arr_proyek = array();
		foreach($data['jenis_proyek_array'] as $r){
			$arr_proyek[$r['id_jenis_proyek']] = $r['nama_proyek'];
		}
		$data['arr_proyek'] = $arr_proyek;
		$this->load->view('shared/header', $data);
		if($page == "index_view"){
			$this->load->view('index_view', $data);
		} else {
			$this->load->view('index', $data);	
		}
		$this->load->view('shared/footer');
		
	}

	public function create(){
		
		$data = $this->page_view("MoU Baru");
		$data['donaturs'] = $this->m_moudonatur->get_donatur();
		$data['provins'] = $this->m_moudonatur->get_provinsi();
		$data['proyeks'] = $this->m_moudonatur->get_jenis_proyek();
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
	
	public function dokumen(){
		
		$this->master_dokumen("dokumen");
		
	}
	
	public function dokumenView(){
		
		$this->master_dokumen("dokumenView");
		
	}
	
	private function master_dokumen($dokumen_view){
		
		$page_title = "Dokumen MoU";
		$id = $this->uri->segment('3');
		$data = $this->page_view($page_title);

		if(strlen($id) > 0){
			$id_mou_donatur_for_dokumen = array( 'id_mou_donatur_for_dokumen' => $id );
			$this->session->set_userdata($id_mou_donatur_for_dokumen);	
		}
		
		if(strlen($this->session->flashdata('message')) > 0){
			$data['message'] = $this->session->flashdata('message');	
		} else if(strlen($this->session->flashdata('messageOK')) > 0){
			$data['messageOK'] = $this->session->flashdata('messageOK');
		}
		
		$data['id_mou_donatur'] = $this->session->userdata("id_mou_donatur_for_dokumen");
		$data['dokumens'] = $this->m_moudonatur->getDokumenByMouDonaturId($data['id_mou_donatur']);
		$this->load->view('shared/header', $data);
		$this->load->view($dokumen_view, $data);
		$this->load->view('shared/footer');
		
	}
	
	public function uploadDokumen(){
		
		$page_title = "Dokumen MoU";
		$id = $this->input->post('mou_donatur');;
		$data = $this->page_view($page_title);
		
		$path = "./uploads/mou donatur/".$id."/";
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
			
			$arr = array( 'id_mou_donatur' => $id,
						'nama_file' => $nama_file,
						'alamat_file' => $alamat_file
		 			);
		 			
			$result = $this->m_moudonatur->input_data_dokumen($arr);
	
			if($result == 1){
				$this->session->set_flashdata('messageOK', "Proses upload berhasil...");
			} else {
				$this->session->set_flashdata('message', "Proses upload gagal, silakan coba kembali...");
			}
        }
		
        $this->session->set_flashdata('id_mou_donatur', $id);
		redirect(site_url().'/moudonatur/dokumen');
		
	}
	
	public function download(){
		
		$this->load->helper('download');
		$id = $this->uri->segment('4');
		$doc = $this->m_moudonatur->getDokumenById($id);
		if(count($doc) > 0){
			$data = file_get_contents($doc[0]['alamat_file']); // Read the file's contents
			$name = basename($doc[0]['nama_file']);
			force_download($name, $data);
		} 
		
	}
	
	public function deleteDokumen(){
		
		$id = $id = $this->uri->segment('4');
		$arr = array( 'id_dokumen_mou_donatur' => $id );
		$doc = $this->m_moudonatur->getDokumenById($id);
		$result = $this->m_moudonatur->delete_dokumen($arr);
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
		redirect(site_url().'/moudonatur/dokumen');
		
	}
	
	public function pembayaranView(){
		
		$this->master_pembayaran("pembayaranView");
		
	}
	
	public function pembayaran(){
		
		$this->master_pembayaran("pembayaran");
	
	}
	
	private function master_pembayaran($pembayaran_view){
		
		$page_title = "Pembayaran Donatur";
		$id = $this->uri->segment('3');
		$data = $this->page_view($page_title);

		if(strlen($id) > 0){
			$id_mou_donatur_for_pembayaran = array( 'id_mou_donatur_for_pembayaran' => $id );
			$this->session->set_userdata($id_mou_donatur_for_pembayaran);	
		}
		
		if(strlen($this->session->flashdata('message')) > 0){
			$data['message'] = $this->session->flashdata('message');	
		} else if(strlen($this->session->flashdata('messageOK')) > 0){
			$data['messageOK'] = $this->session->flashdata('messageOK');
		}
		
		$data['id_mou_donatur'] = $this->session->userdata("id_mou_donatur_for_pembayaran");
		$data['pembayaran'] = $this->m_moudonatur->getPembayaranByMouDonaturId($data['id_mou_donatur']);
		$this->load->view('shared/header', $data);
		$this->load->view($pembayaran_view, $data);
		$this->load->view('shared/footer');
		
	}
	
	public function createPembayaran(){
		
		$mou_donatur = $this->input->post('mou_donatur');
		$nominal_pembayaran = str_replace(".", "", $this->input->post('nominal_pembayaran'));
		$persen_pembayaran = $this->input->post('persen_pembayaran');
		$pembayaran_ke = $this->input->post('pembayaran_ke');
		$tgl_pembayaran = getMysqlFormatDate($this->input->post('tgl_pembayaran')); 
		$tgl_deadline_pembayaran = getMysqlFormatDate($this->input->post('tgl_deadline_pembayaran')); 
		
		$arr = array( 'id_mou_donatur' => $mou_donatur,
						'nominal_pembayaran' => $nominal_pembayaran,
						'persen_pembayaran' => $persen_pembayaran,
						'pembayaran_ke' => $pembayaran_ke,
						'tanggal_pembayaran' => $tgl_pembayaran,
						'tanggal_deadline_pembayaran' => $tgl_deadline_pembayaran
		 			);
		 			
		$result = $this->m_moudonatur->input_data_pembayaran($arr);

		if($result == 1){
			$this->session->set_flashdata('messageOK', "Pembayaran Donatur berhasil disimpan");
		} else {
			$this->session->set_flashdata('message', "Pembayaran Donatur gagal disimpan");
		}
		
        $this->session->set_flashdata('id_mou_donatur', $id);
		redirect(site_url().'/moudonatur/pembayaran');
		
	}
	
	public function deletePembayaran(){
		
		$id = $id = $this->uri->segment('4');
		$arr = array( 'id_pembayaran_donatur' => $id );
		$result = $this->m_moudonatur->delete_pembayaran($arr);
		if($result == 1){
			$this->session->set_flashdata('messageOK', 'Pembayaran berhasil dihapus...');
		} else {
			$this->session->set_flashdata('message', 'Pembayaran gagal dihapus!');
		}
		redirect(site_url().'/moudonatur/pembayaran');
		
	}
	
	public function editPembayaran(){
		
		$page_title = "Pembayaran Donatur";
		$id = $this->uri->segment('4');
		$data = $this->page_view($page_title);
		
		$dok = $this->m_moudonatur->getPembayaranById($id);
		$data['dok'] = $dok[0];
		$data['id_mou_donatur'] = $this->session->userdata("id_mou_donatur_for_pembayaran");
		$data['pembayaran'] = $this->m_moudonatur->getPembayaranByMouDonaturId($data['id_mou_donatur']);
		$this->load->view('shared/header', $data);
		$this->load->view('editPembayaran', $data);
		$this->load->view('shared/footer');
		
	}
	
	public function updatePembayaran(){
		
		$id_pembayaran_donatur = $this->input->post('pembayaran_donatur');
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
		 			
		$result = $this->m_moudonatur->update_data_pembayaran($arr, $id_pembayaran_donatur);

		if($result == 1){
			$this->session->set_flashdata('messageOK', "Pembayaran Donatur berhasil di-update");
		} else {
			$this->session->set_flashdata('message', "Pembayaran Donatur gagal di-update");
		}
		
        $this->session->set_flashdata('id_mou_donatur', $id);
		redirect(site_url().'/moudonatur/pembayaran');
		
	}
	
	
	public function delete(){
		
		$data = $this->page_view("List Role");
		$id = $this->input->post('id');
		$arr = array( 'id_mou_donatur' => $id );
		$result = $this->m_moudonatur->delete_data($arr);
		if($result == 1){
			$this->session->set_flashdata('message', 'MoU Donatur berhasil dihapus...');
		} else {
			$this->session->set_flashdata('message_failed', 'MoU Donatur gagal dihapus!');
		}
  		redirect(site_url().'/moudonatur');
		
	}

	public function prosesCreate(){
		
		$data = $this->page_view("List MoU Donatur");
		
		$donatur = $this->input->post('donatur');
		$nama_penyumbang = $this->input->post('nama_penyumbang');
		$no_proyek = $this->input->post('no_proyek');
		$nama_proyek = $this->input->post('nama_proyek');
		$alamat_proyek = $this->input->post('alamat_proyek');
		$provinsi = $this->input->post('provinsi');
		$kota = $this->input->post('kota');
		$kecamatan = $this->input->post('kecamatan');
		$jenis_proyek = $this->input->post('jenis_proyek');
		$ukuran = $this->input->post('ukuran');
		$desc_proyek = $this->input->post('desc_proyek');
		$dirham = str_replace(".", "", $this->input->post('dirham'));
		$rupiah = str_replace(".", "", $this->input->post('rupiah'));
		$tgl_pembangunan = getMysqlFormatDate($this->input->post('tgl_pembangunan')); 
		$tgl_mou = getMysqlFormatDate($this->input->post('tgl_mou')); 
		
		$arr = array( 'id_donatur' => $donatur,
						'nama_penyumbang' => $nama_penyumbang,
						'tanggal_mou' => $tgl_mou,
						'nomor_proyek' => $no_proyek,
						'nama_proyek' => $nama_proyek,
						'alamat_proyek' => $alamat_proyek,
						'id_provinsi' => $provinsi,
						'id_kota_kab' => $kota,
						'id_kecamatan' => $kecamatan,
						'id_jenis_proyek' => $jenis_proyek,
						'ukuran' => $ukuran,
						'deskripsi_proyek' => $desc_proyek,
						'harga_dirham' => $dirham,
						'harga_rupiah' => $rupiah,
						'tanggal_pembangunan' => $tgl_pembangunan,
						'progress' => 0
		 			);
		 			
		$result = $this->m_moudonatur->input_data($arr);

		if($result == 1){
			$this->session->set_flashdata('message', 'MoU baru berhasil ditambahkan...');
	  		redirect(site_url().'/moudonatur');
		} else {
			$data = $this->page_view("Tambah MoU Donatur");
			$data['message'] = "MoU baru gagal ditambahkan, silakan input kembali...";
			$this->load->view('shared/header', $data);
			$this->load->view('create', $data);
			$this->load->view('shared/footer');
		}
		
	}
	
	public function prosesUpdate(){
		
		$data = $this->page_view("List MoU Donatur");
		
		$donatur = $this->input->post('donatur');
		$no_proyek = $this->input->post('no_proyek');
		$nama_proyek = $this->input->post('nama_proyek');
		$alamat_proyek = $this->input->post('alamat_proyek');
		$provinsi = $this->input->post('provinsi');
		$kota = $this->input->post('kota');
		$jenis_proyek = $this->input->post('jenis_proyek');
		$desc_proyek = $this->input->post('desc_proyek');
		$dirham = str_replace(".", "", $this->input->post('dirham'));
		$rupiah = str_replace(".", "", $this->input->post('rupiah'));
		$tgl_pembangunan = getMysqlFormatDate($this->input->post('tgl_pembangunan')); 
		$tgl_mou = getMysqlFormatDate($this->input->post('tgl_mou')); 
		$progress = $this->input->post('progress');
		$status = $this->input->post('status');
		$note = $this->input->post('note');
		$id_mou_donatur = $this->input->post('mou_donatur');
		
		$arr = array( 'id_donatur' => $donatur,
						'tanggal_mou' => $tgl_mou,
						'nomor_proyek' => $no_proyek,
						'nama_proyek' => $nama_proyek,
						'alamat_proyek' => $alamat_proyek,
						'id_provinsi' => $provinsi,
						'id_kota_kab' => $kota,
						'id_jenis_proyek' => $jenis_proyek,
						'deskripsi_proyek' => $desc_proyek,
						'harga_dirham' => $dirham,
						'harga_rupiah' => $rupiah,
						'tanggal_pembangunan' => $tgl_pembangunan,
						'progress' => $progress,
						'status' => $status,
						'note' => $note
		 			);
		
		$result = $this->m_moudonatur->update_data($arr, $id_mou_donatur);

		if($result == 1){
			$this->session->set_flashdata('message', 'MoU berhasil diperbarui...');
	  		redirect(site_url().'/moudonatur');
		} else {
			$page_title = "Edit MoU Donatur";
			$message = "MoU gagal diperbarui, silakan input kembali...";
			$this->master_edit($id_role, $page_title, $message);
		}
		
	}
	
	private function master_edit($id, $page_title, $message=null){
		
		$data = $this->page_view($page_title);
		$data['donaturs'] = $this->m_moudonatur->get_donatur();
		$data['provins'] = $this->m_moudonatur->get_provinsi();
		$data['proyeks'] = $this->m_moudonatur->get_jenis_proyek();
		$data['message'] = $message;
		$data['id'] = $id;
		$moudonaturs = $this->m_moudonatur->getMoudonaturById($id);
		$data['kotas'] = $this->m_moudonatur->get_kotakab_by_prov($moudonaturs[0]['id_provinsi']);
		$data['kecamatan'] = $this->m_moudonatur->get_kecamatan_by_kota($moudonaturs[0]['id_kota_kab']);
		if($moudonaturs == null){
			//jika ID bernilai null, besar kemungkinan user melakukan direct hit url ke server
			redirect(site_url().'/login');
		} else {
			if($moudonaturs){
				foreach($moudonaturs as $m){
					$data['moudonatur'] = $m;
				}
			} else {
				$data['moudonatur'] = null;
			}
		}
		$data['moudonatur']['tanggal_mou'] = $data['moudonatur']['tanggal_mou']=="0000-00-00" ? "" : getUserFormatDate($data['moudonatur']['tanggal_mou']); 
		$data['moudonatur']['tanggal_pembangunan'] = $data['moudonatur']['tanggal_pembangunan']=="0000-00-00" ? "" : getUserFormatDate($data['moudonatur']['tanggal_pembangunan']); 
		$this->load->view('shared/header', $data);
		$this->load->view('edit', $data);
		$this->load->view('shared/footer');
		
	}
	
	private function master_view($id, $page_title, $message=null){
		
		$data = $this->page_view($page_title);
		$data['donaturs'] = $this->m_moudonatur->get_donatur();
		$data['provins'] = $this->m_moudonatur->get_provinsi();
		$data['proyeks'] = $this->m_moudonatur->get_jenis_proyek();
		$data['message'] = $message;
		$data['id'] = $id;
		$moudonaturs = $this->m_moudonatur->getMoudonaturById($id);
		$data['kotas'] = $this->m_moudonatur->get_kotakab_by_prov($moudonaturs[0]['id_provinsi']);
		$data['kecamatan'] = $this->m_moudonatur->get_kecamatan_by_kota($moudonaturs[0]['id_kota_kab']);
		if($moudonaturs == null){
			//jika ID bernilai null, besar kemungkinan user melakukan direct hit url ke server
			redirect(site_url().'/login');
		} else {
			if($moudonaturs){
				foreach($moudonaturs as $m){
					$data['moudonatur'] = $m;
				}
			} else {
				$data['moudonatur'] = null;
			}
		}
		$data['moudonatur']['tanggal_mou'] = getUserFormatDate($data['moudonatur']['tanggal_mou']); 
		$data['moudonatur']['tanggal_pembangunan'] = getUserFormatDate($data['moudonatur']['tanggal_pembangunan']); 
		$this->load->view('shared/header', $data);
		$this->load->view('view', $data);
		$this->load->view('shared/footer');
		
	}
	
	private function page_view($page){
		
		//no user session, redirect to login page
		if($this->session->userdata('userlogin')==""){
			redirect(site_url().'/login');
		}
		
		$data['page'] = $page;
		$data['menuaktif'] = "moudonatur";
		return $data;
	
	}
	
	public function selectkotakab(){
		
		$id = $this->uri->segment('3');
		$data['kotas'] = $this->m_moudonatur->get_kotakab_by_prov($id);
		$this->load->view('selectkotakab', $data);
		
	}
	
	public function selectkecamatan(){
		
		$id = $this->uri->segment('3');
		$data['kecamatan'] = $this->m_moudonatur->get_kecamatan_by_kota($id);
		$this->load->view('selectkecamatan', $data);
		
	}
	
}
?>