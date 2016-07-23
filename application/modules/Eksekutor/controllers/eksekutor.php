<!--
* Author : Andi Mulya Indrianto
* Email : andie.mulya.i@gmail.com
* Created Date: 23 Jul 2016
-->
<?php

class Eksekutor extends CI_Controller{

	function __constract(){
		parent::__constract();
	}

	public function index(){
		if($this->session->userdata('username')==""){
			redirect(site_url().'/login');
		}

		$data['page'] = "Eksekutor";
		$data['menuaktif'] = "eksekutor";

		$data['eksekutors'] = $this->m_eksekutor->getAll();
		$this->load->view('shared/header', $data);
		$this->load->view('index', $data);
		$this->load->view('shared/footer');
	}

	public function create(){
		if($this->session->userdata('username')==""){
			redirect(site_url().'/login');
		}

		$data['page'] = "Tambah Eksekutor";
		$data['menuaktif'] = "eksekutor";

		$this->load->view('shared/header', $data);
		$this->load->view('create', $data);
		$this->load->view('shared/footer');
	}

	public function prosesCreate(){
		if($this->session->userdata('username')==""){
			redirect(site_url().'/login');
		}

		$nama = $this->input->post('nama');
		$alamat = $this->input->post('alamat');
		$kontak = $this->input->post('kontak');
		$email = $this->input->post('email');
		$pic = $this->input->post('pic');

		$this->form_validation->set_rules('nama','Nama Eksekutor','required',
			array('required'=>'%s harus di isi.'));
		$this->form_validation->set_rules('kontak','No Kontak','required',
			array('required'=>'%s harus di isi.'));
		$this->form_validation->set_rules('email','Email','required',
			array('required'=>'%s harus di isi.'));
		$this->form_validation->set_rules('pic','Nama PIC','required',
			array('required'=>'%s harus di isi.'));

		if ($this->form_validation->run() == FALSE){
			$data['page'] = "Tambah Eksekutor";
			$data['menuaktif'] = "eksekutor";
			$this->load->view('shared/header', $data);
			$this->load->view('create', $data);
			$this->load->view('shared/footer');
        }
        else{ 
			$data = array(
				'nama_eksekutor' => $nama,
				'alamat' => $alamat,
				'no_kontak' => $kontak,
				'email' => $email,
				'nama_pic' => $pic
				);

			$this->m_eksekutor->input_data($data);
			redirect('eksekutor/index');
		}
	}

	public function edit($id){
		if($this->session->userdata('username')==""){
			redirect(site_url().'/login');
		}

		$data['eksekutor'] = $this->m_eksekutor->get_eksekutor_byID($id);

		$data['page'] = "Update Eksekutor";
		$data['menuaktif'] = "eksekutor";
		$this->load->view('shared/header', $data);
		$this->load->view('edit', $data);
		$this->load->view('shared/footer');
	}

	public function prosesEdit($id){ 
		if($this->session->userdata('username')==""){
			redirect(site_url().'/login');
		}

		$nama = $this->input->post('nama');
		$alamat = $this->input->post('alamat');
		$kontak = $this->input->post('kontak');
		$email = $this->input->post('email');
		$pic = $this->input->post('pic');

		$this->form_validation->set_rules('nama','Nama Eksekutor','required',
			array('required'=>'%s harus di isi.'));
		$this->form_validation->set_rules('kontak','No Kontak','required',
			array('required'=>'%s harus di isi.'));
		$this->form_validation->set_rules('email','Email','required',
			array('required'=>'%s harus di isi.'));
		$this->form_validation->set_rules('pic','Nama PIC','required',
			array('required'=>'%s harus di isi.'));

		if ($this->form_validation->run() == FALSE){
			$data['eksekutor'] = $this->m_eksekutor->get_eksekutor_byID($id);

			$data['page'] = "Update Eksekutor";
			$data['menuaktif'] = "eksekutor";
			$this->load->view('shared/header', $data);
			$this->load->view('edit', $data);
			$this->load->view('shared/footer');
        }
        else{ 
			$data = array(
				'nama_eksekutor' => $nama,
				'alamat' => $alamat,
				'no_kontak' => $kontak,
				'email' => $email,
				'nama_pic' => $pic
				);

			$this->m_eksekutor->update_data($data, $id);
			redirect('eksekutor/index');
		}
	}

	public function prosesDelete(){
		if($this->session->userdata('username')==""){
			redirect(site_url().'/login');
		}

		$id = $this->input->post('id');
		$this->m_eksekutor->hapus_data($id);
		redirect('eksekutor/index');
	}
}
?>