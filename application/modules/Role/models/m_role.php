<?php

/**
* Author : Ahmad Shodiqi
* Email : diki2786@gmail.com
* Desc : model query pada role
*/

class M_role extends CI_Model{

	var $table = 'role';
	
	public function __constract(){
		parent:: __constract();
	}

	//get all data role
	public function getAll(){
		return $this->db->get($this->table);
	}
	
	public function getRoleById($id){
		
		$this->db->where('id_role', $id);
		$query = $this->db->get($this->table);
		
		if($query->num_rows() > 0){
			return $query->result_array();
		}
		return null;
	}

	public function getRoleByName($name){
		
		$this->db->where('nama_role', $name);
		$query = $this->db->get($this->table);
		
		if($query->num_rows() > 0){
			return $query->result();
		}
		return null;
	}

	public function input_data($data){
		
		if ( ! $this->db->insert($this->table, $data)) {
        	return $this->db->error();
		}
		return 1;
	}
	
	public function input_access($data){
		
		if ( ! $this->db->insert("role_rights", $data)) {
        	return $this->db->error();
		}
		return 1;
	}



	public function update_data($data){
		
		if ( ! $this->db->replace($this->table, $data)) {
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

	public function getAllModule(){
		return $this->db->get("module");
	}

	public function getAccess($id_role){
		$this->db->where("id_role", $id_role);
		return $this->db->get("role_rights");
	}
	
	public function update_access($data, $kolom, $id_role_rights){
		$sql = "update role_rights set ".$kolom." = ".$data." where id_role_rights = ".$id_role_rights;
		$query = $this->db->query($sql);
	}
	public function reset_access($id_role){
		$sql = "update role_rights SET role_rights.edit = 0, role_rights.delete = 0, role_rights.create = 0, role_rights.view = 0 WHERE id_role =".$id_role;
		$query = $this->db->query($sql);
	}
}
?>