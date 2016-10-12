<?php
/**
* Author : Ahmad Shodiqi
*/
class M_kecamatan extends CI_Model{

	var $table = 'kecamatan';
	public function __constract(){
		parent:: __constract();
	}

	public function getAll(){
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->join('kota_kab', 'kota_kab.id_kota_kab = kecamatan.id_kota_kab');
		$this->db->join('provinsi', 'provinsi.id_provinsi = kota_kab.id_provinsi');
		return $this->db->get();
	}
	
	public function get_provinsi(){
		return $this->db->get("provinsi");	
	}
	
	public function get_kota(){
		return $this->db->get("kota_kab");	
	}
	
	public function get_kotakab_by_prov($id){
		$this->db->where('id_provinsi', $id);
		return $this->db->get("kota_kab");
	}
	
	public function input_data($data){
		if ( ! $this->db->insert($this->table, $data)) {
        	return $this->db->error();
		}
		return 1;
	}

	public function getKecamatanByID($id){
		$this->db->where('id_kecamatan', $id);
		$query = $this->db->get($this->table);
		if($query->num_rows() > 0){
			return $query->result_array();
		}
		return null;
	}
	
	public function getKotaByKecamatan($id){
		$this->db->where('id_kota_kab', $id);
		$query = $this->db->get("kota_kab");
		if($query->num_rows() > 0){
			return $query->result_array();
		}
		return null;
	}
	
	public function getKotaByProvinsi($id){
		$this->db->where('id_provinsi', $id);
		$query = $this->db->get("kota_kab");
		if($query->num_rows() > 0){
			return $query->result_array();
		}
		return null;
	}

	public function update_data($data, $id){
		$this->db->where('id_kecamatan', $id);
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