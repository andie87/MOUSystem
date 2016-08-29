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
		//return $this->db->get($this->table);
		$this->db->select('mou_eksekutor.*, mou_donatur.nomor_proyek as moudonatur_nomor_proyek');
		$this->db->from($this->table);
		$this->db->join('mou_donatur', 'mou_donatur.id_mou_donatur = mou_eksekutor.id_mou_donatur');
		return $this->db->get();
	}
	
	public function getMoueksekutorById($id){
		
		$this->db->where('id_mou_eksekutor', $id);
		$this->db->select('mou_eksekutor.*, mou_donatur.nomor_proyek as moudonatur_nomor_proyek');
		$this->db->from($this->table);
		$this->db->join('mou_donatur', 'mou_donatur.id_mou_donatur = mou_eksekutor.id_mou_donatur');
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

	public function get_moudonatur(){
		return $this->db->get("mou_donatur");
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

	public function getDokumenByMoueksekutorId($id){
		$this->db->where('id_mou_eksekutor', $id);
		return $this->db->get("dokumen_mou_eksekutor");
	}
	
	public function getPembayaranByMoueksekutorId($id){
		$this->db->where('id_mou_eksekutor', $id);
		return $this->db->get("pembayaran_eksekutor");
	}
	
	public function getDokumenById($id){
		$this->db->where('id_dokumen_mou_eksekutor', $id);
		$query = $this->db->get("dokumen_mou_eksekutor");
		return $query->result_array();	
	}
	
	public function getPembayaranById($id){
		$this->db->where('id_pembayaran_eksekutor', $id);
		$query = $this->db->get("pembayaran_eksekutor");
		return $query->result_array();	
	}
	
	public function update_data_pembayaran($data, $id_pembayaran){
		
		$this->db->where('id_pembayaran_eksekutor', $id_pembayaran);
		
		if ( ! $this->db->update("pembayaran_eksekutor", $data)) {
        	return $this->db->error();
		}
		return 1;
		
	}
	
}
?>