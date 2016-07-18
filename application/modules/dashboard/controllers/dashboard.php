<!--
* Author : Andi Mulya Indrianto
* Email : andie.mulya.i@gmail.com
* Created Date: 10 Jul 2016
-->
<?php

class Dashboard extends CI_Controller{

	function __constract(){
		parent::__constract();
	}

	public function index(){
		if($this->session->userdata('username')==""){
			redirect(site_url().'/login');
		}

		$data['page'] = "Dashboard";
		$data['menuaktif'] = "dashboard";
		$this->load->view('shared/header', $data);
		$this->load->view('index', $data);
		$this->load->view('shared/footer');
	}
}
?>