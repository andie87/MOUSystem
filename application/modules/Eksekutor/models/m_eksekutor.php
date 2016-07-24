<?php
/**
* Author : Andi Mulya Indrianto
* Email : andie.mulya.i@gmail.com
* Created Date: 23 Jul 2016
* Desc : model query pada eksekutor
*/
class M_eksekutor extends CI_Model{

	var $table = 'eksekutor';
	public function __constract(){
		parent:: __constract();
	}

	//get all data eksekutor
	public function getAll(){
		return $this->db->get($this->table);
	}

	public function input_data($data){
		if ( ! $this->db->insert($this->table, $data)) {
        	return $this->db->error();
		}
		return 1;
	}

	public function get_eksekutor_byID($id){
		$this->db->where('id_eksekutor', $id);
		$query = $this->db->get($this->table);
		if($query->num_rows() > 0){
			return $query->result_array();
		}
		return null;
	}

	public function update_data($data, $id){
		$this->db->where('id_eksekutor', $id);
		if ( ! $this->db->update($this->table, $data)) {
        	return $this->db->error();
		}
		return 1;
	}

	public function hapus_data($data){
		if ( ! $this->db->delete($this->table, $data)) {
        	return $this->db->error();
		}
		return 1;
	}
}
?>