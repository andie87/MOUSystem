<!--
* Author : Andi Mulya Indrianto
* Email : andie.mulya.i@gmail.com
* Created Date: 10 Jul 2016
-->
<?php

class Login extends CI_Controller{

	function __constract(){
		parent::__constract();
	}

	public function index(){
		$this->loginForm();
	}

	public function loginForm(){
		$d['judulForm'] = "Login Form";
		$d['judul'] = "Login Form";
		$this->load->view('v_login', $d);
	}

	public function loginProcess(){
		//input dari form login
		$username = $this->input->post('username');
		$password = sha1($this->input->post('password'));
		
		//validasi
		$this->form_validation->set_rules('username','Username','required|trim');
		$this->form_validation->set_rules('password','Password','required|trim');

		if($this->form_validation->run()==FALSE){
			$this->session->set_flashdata('pesan1','username dan password masih kosong');
			redirect(site_url().'/login');
		}

		else{
			
			$cekuser = $this->M_login->loginCheck($username, $password);
			if($cekuser){
				foreach($cekuser as $datalogin){
					$fullname = $datalogin['nama_user'];
					$userlogin = $datalogin['user_login'];
					$email = $datalogin['email'];
				}
				$dlogin = array(
						'username' => $fullname,
						'userlogin' => $userlogin,
						'email' => $email,
						'logged_in' => TRUE
					);

				$this->session->set_userdata($dlogin);
				redirect(site_url().'/dashboard');
			}
			
			else {
				
				$dlogin = array(
						'username' => "",
						'userlogin' => "",
						'email' => "",
						'logged_in' => FALSE
					);

				$this->session->set_userdata($dlogin);
				
				$this->session->set_flashdata('pesan2','Maaf..., username dan password salah!');
				redirect(site_url().'/login');
				
			}
		}
	}
}