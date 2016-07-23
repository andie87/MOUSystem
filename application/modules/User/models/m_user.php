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
		return $this->db->get($this->table);
	}
	
	public function getUserById($id){
		
		$this->db->where('id_user', $id);
		$query = $this->db->get($this->table);
		
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
	
	public function delete_data($data){
		
		if ( ! $this->db->delete($this->table, $data)) {
        	return $this->db->error();
		}
		return 1;
	}
	
}
?>