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
		$this->db->insert($this->table,$data);
	}

	public function get_eksekutor_byID($id){
		$this->db->where('id_eksekutor', $id);
		$query = $this->db->get($this->table);
		return $query->result();
	}

	public function update_data($data, $id){
		$this->db->where('id_eksekutor', $id);
		$this->db->update($this->table,$data);
	}

	public function hapus_data($id){
		$this->db->where('id_eksekutor', $id);
		$this->db->delete($this->table);
	}
}
?>