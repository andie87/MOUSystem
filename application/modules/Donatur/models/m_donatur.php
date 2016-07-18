<?php
/**
* Author : Andi Mulya Indrianto
* Email : andie.mulya.i@gmail.com
* Created Date: 16 Jul 2016
* Desc : model query pada donatur
*/
class M_donatur extends CI_Model{

	var $table = 'donatur';
	public function __constract(){
		parent:: __constract();
	}

	//get all data donatur
	public function getAll(){
		return $this->db->get($this->table);
	}

	public function input_data($data){
		$this->db->insert($this->table,$data);
	}

	public function get_donatur_byID($id){
		$this->db->where('id_donatur', $id);
		$query = $this->db->get($this->table);
		return $query->result();
	}
}
?>