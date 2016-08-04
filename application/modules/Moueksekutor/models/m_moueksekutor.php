<?php

/**
* Author : Andi Mulya I
*/

class M_moueksekutor extends CI_Model{

	var $table = 'mou_eksekutor';
	
	public function __constract(){
		parent:: __constract();
	}

	//get all data role
	public function getAll(){
		return $this->db->get($this->table);
	}
	
	public function getMoueksekutorById($id){
		
		$this->db->where('id_mou_eksekutor', $id);
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
	
	public function update_data($data, $id_mou_eksekutor){
		
		$this->db->where('id_mou_eksekutor', $id_mou_eksekutor);
		
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
	
	public function get_eksekutor_array(){
		$query = $this->db->get("eksekutor");	
		return $query->result_array();
	}
	
	public function get_eksekutor(){
		return $this->db->get("eksekutor");	
	}

	public function get_provinsi(){
		return $this->db->get("provinsi");	
	}
	
	public function get_kotakab_by_prov($id){
		$this->db->where('id_provinsi', $id);
		return $this->db->get("kota_kab");
	}
	
	public function get_jenis_proyek(){
		return $this->db->get("jenis_proyek");	
	}
		
	public function get_jenis_proyek_array(){
		$query = $this->db->get("jenis_proyek");
		return $query->result_array();	
	}
	
}
?>