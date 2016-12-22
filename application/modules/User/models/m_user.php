<?php

/**
* Author : Ahmad Shodiqi
* Email : diki2786@gmail.com
* Desc : model query pada user
*/

class M_user extends CI_Model{

	var $table = 'user';
	
	public function __constract(){
		parent:: __constract();
	}

	//get all data donatur
	public function getAll(){

		$this->db->select('user.*, user_role.id_role');
		$this->db->from($this->table);
		$this->db->join('user_role', 'user.id_user = user_role.id_user');
		return $this->db->get();
	}

	public function insert_foto($data){
		if ( ! $this->db->insert('foto_profil', $data)) {
        	return $this->db->error();
		}
		return 1;
	}

	public function insert_pesan($data){
		if ( ! $this->db->insert('pesan', $data)) {
        	return $this->db->error();
		}
		return 1;
	}

	public function getAllPesan($id_penerima){
		$this->db->where('penerima', $id_penerima);
		return $this->db->get('pesan');
	}

	public function getUnreadPesan($id_penerima){
		$this->db->where('penerima', $id_penerima);
		$this->db->where('isread', false);
		return $this->db->get('pesan');
	}

	public function getPesanById($id){
		$this->db->where('id_pesan', $id);
		$query = $this->db->get('pesan');
		if($query->num_rows() > 0){
			return $query->result_array();
		}
		return null;
	}

	public function updatePesanterbaca($id){
		$this->db->where('id_pesan', $id);
		
		if ( ! $this->db->update('pesan', array('isread'=>true))) {
        	return $this->db->error();
		}
		return 1;
	}

	public function update_foto($data, $id_user){
		
		$this->db->where('id_user', $id_user);
		
		if ( ! $this->db->update('foto_profil', $data)) {
        	return $this->db->error();
		}
		return 1;
	}

	public function get_role_array(){
		$query = $this->db->get("role");	
		return $query->result_array();
	}

	public function get_iduser($nama_user, $user_login){
		$this->db->select('id_user');
		$this->db->from($this->table);
		$this->db->where('nama_user',$nama_user);
		$this->db->where('user_login',$user_login);
		return $this->db->get()->row()->id_user;
	}

	public function input_role($data){
		
		if ( ! $this->db->insert('user_role', $data)) {
        	return $this->db->error();
		}
		return 1;
	}
	
	public function getUserById($id){
		
		$this->db->select('user.*, user_role.id_role');
		$this->db->from($this->table);
		$this->db->join('user_role', 'user.id_user = user_role.id_user');
		$this->db->where('user.id_user', $id);
		$query = $this->db->get();
		
		if($query->num_rows() > 0){
			return $query->result_array();
		}
		return null;
	}

	public function input_data($data){
		
		if ( ! $this->db->insert($this->table, $data)) {
        	return $this->db->error();
		}
		return 1;
	}
	
	public function update_data($data, $id_user){
		
		$this->db->where('id_user', $id_user);
		
		if ( ! $this->db->update($this->table, $data)) {
        	return $this->db->error();
		}
		return 1;
	}
	
	public function update_role($data, $id_user){
		
		$this->db->where('id_user', $id_user);
		
		if ( ! $this->db->update('user_role', $data)) {
        	return $this->db->error();
		}
		return 1;
	}
	
	public function delete_data($data){
		
		if ( ! $this->db->delete($this->table, $data)) {
        	return $this->db->error();
		}
		return 1;
	}

	public function delete_pesan($data){
		
		if ( ! $this->db->delete('pesan', $data)) {
        	return $this->db->error();
		}
		return 1;
	}
	
}
?>