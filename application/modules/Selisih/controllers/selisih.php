<!--
* Author : Andi Mulya I
-->
<?php

class Selisih extends CI_Controller{

	function __constract(){
		parent::__constract();
	}

	public function index(){
		$data = $this->page_view("Selisih Nilai MoU Donatur dengan Eksekutor", "view");
		if(strlen($this->session->flashdata('message')) > 0){
			$data['message'] = $this->session->flashdata('message');
		}
		if(strlen($this->session->flashdata('message_failed')) > 0){
			$data['message_failed'] = $this->session->flashdata('message_failed');
		}

		$mou = $this->uri->segment('3');
		if($mou != ""){
			if($mou == "donatur"){
				$data["id_mou_donatur"] = $this->uri->segment('4');
				// $data["id_mou_eksekutor"] = "";
				// $data['no_proyek'] = "";
				// $data['nama_proyek'] = "";
				// $data['from_mou'] = "";
				// $data['to_mou'] = "";
				// $data['nama_eksekutor'] = "";
				$data['data_selisih'] = $this->m_selisih->getAll($data);
			}elseif($mou == "eksekutor"){
				$data["id_mou_eksekutor"] = $this->uri->segment('4');
				$data['data_selisih'] = $this->m_selisih->getAll($data);
			}
		}else{
			if( $this->input->post('key') != null ){
				$data['no_proyek'] = $this->input->post('no_proyek') == null ? null : $this->input->post('no_proyek');
				$data['nama_proyek'] = $this->input->post('nama_proyek') == null ? null : $this->input->post('nama_proyek');
				$data['from_mou'] = $this->input->post('from_mou') == null ? null : $this->input->post('from_mou');
				$data['to_mou'] = $this->input->post('to_mou') == null ? null : $this->input->post('to_mou');
				$data['nama_eksekutor'] = $this->input->post('nama_eksekutor') == null ? null : $this->input->post('nama_eksekutor');
				$data['data_selisih'] = $this->m_selisih->getAll($data);
			} else {
				$data['data_selisih'] = $this->m_selisih->getAll();
			}
		}

		$data['granted_access'] = $this->session->userdata('access');

		$this->load->view('shared/header', $data);
		$this->load->view('index', $data);
		$this->load->view('shared/footer');
	}

	private function page_view($page, $access_level, $module="selisih"){
		
		//no user session, redirect to login page
		if($this->session->userdata('userlogin')==""){
			redirect(site_url().'/login');
		}

		//manage access
		if($module=="selisih")
			$access_selisih = "selisih";	
		
		
		$granted_access = $this->session->userdata('access');
		if(isset($granted_access[$access_selisih])){
			if(strpos($granted_access[$access_selisih], $access_level) == false){
				//jika tidak ada akses ke function ini maka arahkan ke dashboard
				redirect(site_url().'/dashboard');
			}
		} else {
			//jika tidak ada akses ke halaman ini maka arahkan ke dashboard
			redirect(site_url().'/dashboard');
		}
		
		$data['page'] = $page;
		$data['menuaktif'] = "selisih";
		$data['menu'] = $this->session->userdata('access');
		return $data;
	
	}
}