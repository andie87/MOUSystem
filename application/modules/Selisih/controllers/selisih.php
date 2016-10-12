<!--
* Author : Andi Mulya I
-->
<?php

class Selisih extends CI_Controller{

	function __constract(){
		parent::__constract();
	}

	public function index(){
		$data = $this->page_view("Selisih Nilai MoU Donatur dengan Eksekutor");
		if(strlen($this->session->flashdata('message')) > 0){
			$data['message'] = $this->session->flashdata('message');
		}
		if(strlen($this->session->flashdata('message_failed')) > 0){
			$data['message_failed'] = $this->session->flashdata('message_failed');
		}

		if( $this->input->post('key') != null ){
			$data['no_proyek'] = $this->input->post('no_proyek') == null ? null : $this->input->post('no_proyek');
			$data['nama_proyek'] = $this->input->post('nama_proyek') == null ? null : $this->input->post('nama_proyek');
			$data['from_mou'] = $this->input->post('from_mou') == null ? null : $this->input->post('from_mou');
			$data['to_mou'] = $this->input->post('to_mou') == null ? null : $this->input->post('to_mou');
			$data['nama_eksekutor'] = $this->input->post('nama_eksekutor') == null ? null : $this->input->post('from_pengerjaan');
			$data['data_selisih'] = $this->m_selisih->getAll($data);
		} else {
			$data['data_selisih'] = $this->m_selisih->getAll();
		}

		$this->load->view('shared/header', $data);
		$this->load->view('index', $data);
		$this->load->view('shared/footer');
	}

	private function page_view($page){
		
		//no user session, redirect to login page
		if($this->session->userdata('userlogin')==""){
			redirect(site_url().'/login');
		}
		
		$data['page'] = $page;
		$data['menuaktif'] = "selisih";
		return $data;
	
	}
}