<?php
/**
* Author : Andi Mulya Indrianto
* Email : andie.mulya.i@gmail.com
* Created Date: 26 Jul 2016
* Desc : model query pada kota
*/
class M_kota extends CI_Model{

	var $table = 'kota_kab';
	public function __constract(){
		parent:: __constract();
	}

	//get all data kota
	public function getAll(){
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->join('provinsi', 'provinsi.id_provinsi = kota_kab.id_provinsi');
		return $this->db->get();
	}
	public function getAllByProvinsi($id){
		$this->db->where('kota_kab.id_provinsi', $id);
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->join('provinsi', 'provinsi.id_provinsi = kota_kab.id_provinsi');
		return $this->db->get();
	}

	public function input_data($data){
		if ( ! $this->db->insert($this->table, $data)) {
        	return $this->db->error();
		}
		return 1;
	}

	public function getkotabyID($id){
		$this->db->where('id_kota_kab', $id);
		$query = $this->db->get($this->table);
		if($query->num_rows() > 0){
			return $query->result_array();
		}
		return null;
	}

	public function update_data($data, $id){
		$this->db->where('id_kota_kab', $id);
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