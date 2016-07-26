<?php
/**
* Author : Andi Mulya Indrianto
* Email : andie.mulya.i@gmail.com
* Created Date: 26 Jul 2016
* Desc : model query pada provinsi
*/
class M_provinsi extends CI_Model{

	var $table = 'provinsi';
	public function __constract(){
		parent:: __constract();
	}

	//get all data provinsi
	public function getAll(){
		return $this->db->get($this->table);
	}

	public function input_data($data){
		if ( ! $this->db->insert($this->table, $data)) {
        	return $this->db->error();
		}
		return 1;
	}

	public function getprovinsiById($id){
		$this->db->where('id_provinsi', $id);
		$query = $this->db->get($this->table);
		if($query->num_rows() > 0){
			return $query->result_array();
		}
		return null;
	}

	public function update_data($data, $id){
		$this->db->where('id_provinsi', $id);
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