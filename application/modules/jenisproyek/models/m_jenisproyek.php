<?php
/**
* Author : Andi Mulya Indrianto
* Email : andie.mulya.i@gmail.com
* Created Date: 30 Jul 2016
* Desc : model query pada proyek
*/
class M_jenisproyek extends CI_Model{

	var $table = 'jenis_proyek';
	public function __constract(){
		parent:: __constract();
	}

	//get all data proyek
	public function getAll(){
		$this->db->select('*');
		$this->db->from($this->table);
		return $this->db->get();
	}
	
	public function input_data($data){
		if ( ! $this->db->insert($this->table, $data)) {
        	return $this->db->error();
		}
		return 1;
	}

	public function getproyekbyID($id){
		$this->db->where('id_jenis_proyek', $id);
		$query = $this->db->get($this->table);
		if($query->num_rows() > 0){
			return $query->result_array();
		}
		return null;
	}

	public function update_data($data, $id){
		$this->db->where('id_jenis_proyek', $id);
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