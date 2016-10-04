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

	public function logout(){
		$this->session->sess_destroy();
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
					$role = $datalogin['id_role'];
				}

				$commonModule = $this->M_login->getModule();
				$allModules = $this->M_login->getlAllModules();
				$roleRights = $this->M_login->getRoleRights($role);
				$roles = array();
				foreach($roleRights as $rr){
					$detail = "";
					if($rr['create'] == 1){ 
						$detail = "create"; 
					} 
					if($rr['edit'] == 1){ 
						$detail .= "-edit"; 
					} 
					if($rr['delete'] == 1){ 
						$detail .= "-delete"; 
					} 
					if($rr['view'] == 1){ 
						$detail .= "-view"; 
					}
					if($detail != ""){
						$roles[$rr['module_page']] = $detail;		
					}
				}
				$dlogin = array(
						'username' => $fullname,
						'userlogin' => $userlogin,
						'email' => $email,
						'logged_in' => TRUE,
						'access' => $roles
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

	function set_rights($allModules, $menuRights) {
	    $data = array();

	    for ($i = 0, $c = count($allModules); $i < $c; $i++) {


	        $row = array();
	        for ($j = 0, $c2 = count($menuRights); $j < $c2; $j++) {
	            if ($menuRights[$j]["id_module"] == $allModules[$i]["id_module"]) {
	                if ($menuRights[$j]["create"] || $menuRights[$j]["edit"] ||
	                        $menuRights[$j]["delete"] || $menuRights[$j]["view"]) {

	                    $row["menu"] = $allModules[$i]["module_group_name"];
	                	$row["menu_name"] = $allModules[$i]["module_name"];
	                    $row["page_name"] = $allModules[$i]["module_page"];
	                    $row["create"] = $menuRights[$j]["create"];
	                    $row["edit"] = $menuRights[$j]["edit"];
	                    $row["delete"] = $menuRights[$j]["delete"];
	                    $row["view"] = $menuRights[$j]["view"];
	                    $row['id'] = $menuRights[$j]["id_module"];

	                    $data[$allModules[$i]["module_group_name"]][$allModules[$j]["module_name"]] = $row;
	                    $data[$allModules[$i]["module_group_name"]]["top_menu_name"] = $allModules[$i]["module_group_name"];
	                }
	            }
	        }
	    }
	    
	    return $data;
	}

	function authorize($module) {
    return $module;
}
}