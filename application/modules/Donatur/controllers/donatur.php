<!--
* Author : Andi Mulya Indrianto
* Email : andie.mulya.i@gmail.com
* Created Date: 16 Jul 2016
-->
<?php

class Donatur extends CI_Controller{

	function __constract(){
		parent::__constract();
	}

	public function index(){
		if($this->session->userdata('username')==""){
			redirect(site_url().'/login');
		}

		$data['page'] = "Donatur";
		$data['menuaktif'] = "donatur";

		$data['donaturs'] = $this->m_donatur->getAll();
		$this->load->view('shared/header', $data);
		$this->load->view('index', $data);
		$this->load->view('shared/footer');
	}

	public function create(){
		if($this->session->userdata('username')==""){
			redirect(site_url().'/login');
		}

		$data['page'] = "Tambah Donatur";
		$data['menuaktif'] = "donatur";

		$data['donaturs'] = $this->m_donatur->getAll();
		$this->load->view('shared/header', $data);
		$this->load->view('create', $data);
		$this->load->view('shared/footer');
	}

	public function prosesCreate(){
		if($this->session->userdata('username')==""){
			redirect(site_url().'/login');
		}

		$nama = $this->input->post('nama');
		$negara = $this->input->post('negara');
		$alamat = $this->input->post('alamat');
		$kontak = $this->input->post('kontak');
		$email = $this->input->post('email');
		$pic = $this->input->post('pic');

		$this->form_validation->set_rules('nama','Nama Donatur','required',
			array('required'=>'%s harus di isi.'));
		$this->form_validation->set_rules('negara','Negara Asal','required',
			array('required'=>'%s harus di isi.'));
		$this->form_validation->set_rules('email','Email','required',
			array('required'=>'%s harus di isi.'));
		$this->form_validation->set_rules('pic','Nama PIC','required',
			array('required'=>'%s harus di isi.'));

		if ($this->form_validation->run() == FALSE){
			$data['donatur'] = $this->m_donatur->get_donatur_byID($id);

			$data['page'] = "Tambah Donatur";
			$data['menuaktif'] = "donatur";
			$this->load->view('shared/header', $data);
			$this->load->view('create', $data);
			$this->load->view('shared/footer');
        }
        else{ 
			$data = array(
				'nama_donatur' => $nama,
				'asal_negara' => $negara,
				'alamat' => $alamat,
				'no_kontak' => $kontak,
				'email' => $email,
				'nama_pic' => $pic
				);

			$this->m_donatur->input_data($data);
			redirect('donatur/index');
		}
	}

	public function edit($id){
		if($this->session->userdata('username')==""){
			redirect(site_url().'/login');
		}

		$data['donatur'] = $this->m_donatur->get_donatur_byID($id);

		$data['page'] = "Update Donatur";
		$data['menuaktif'] = "donatur";
		$this->load->view('shared/header', $data);
		$this->load->view('edit', $data);
		$this->load->view('shared/footer');
	}

	public function prosesEdit($id){ 
		if($this->session->userdata('username')==""){
			redirect(site_url().'/login');
		}

		$nama = $this->input->post('nama');
		$negara = $this->input->post('negara');
		$alamat = $this->input->post('alamat');
		$kontak = $this->input->post('kontak');
		$email = $this->input->post('email');
		$pic = $this->input->post('pic');

		$this->form_validation->set_rules('nama','Nama Donatur','required',
			array('required'=>'%s harus di isi.'));
		$this->form_validation->set_rules('negara','Negara Asal','required',
			array('required'=>'%s harus di isi.'));
		$this->form_validation->set_rules('email','Email','required',
			array('required'=>'%s harus di isi.'));
		$this->form_validation->set_rules('pic','Nama PIC','required',
			array('required'=>'%s harus di isi.'));

		if ($this->form_validation->run() == FALSE){
			$data['donatur'] = $this->m_donatur->get_donatur_byID($id);

			$data['page'] = "Update Donatur";
			$data['menuaktif'] = "donatur";
			$this->load->view('shared/header', $data);
			$this->load->view('edit', $data);
			$this->load->view('shared/footer');
        }
        else{ 
			$data = array(
				'nama_donatur' => $nama,
				'asal_negara' => $negara,
				'alamat' => $alamat,
				'no_kontak' => $kontak,
				'email' => $email,
				'nama_pic' => $pic
				);

			$this->m_donatur->update_data($data, $id);
			redirect('donatur/index');
		}
	}

	public function prosesDelete(){
		if($this->session->userdata('username')==""){
			redirect(site_url().'/login');
		}

		$id = $this->input->post('id');
		$this->m_donatur->hapus_data($id);
		redirect('donatur/index');
	}
}
?>