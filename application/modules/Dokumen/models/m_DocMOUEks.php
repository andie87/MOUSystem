<?php
/**
* Author : Andi Mulya Indrianto
* Email : andie.mulya.i@gmail.com
* Created Date: 4 Aug 2016
* Desc : model query pada dokumen mou eksekutor
*/
class m_DocMOUEks extends CI_Model{

	var $table = 'dokumen_mou_eksekutor';
	public function __constract(){
		parent:: __constract();
	}

	//get all data dokumen mou eksekutor
	public function getAll(){
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->join('mou_eksekutor', 'mou_eksekutor.id_mou_eksekutor = dokumen_mou_eksekutor.id_mou_eksekutor');
		return $this->db->get();
	}

	public function getAllByIdMOU($id){
		$this->db->where('dokumen_mou_eksekutor.id_mou_eksekutor', $id);
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->join('mou_eksekutor', 'mou_eksekutor.id_mou_eksekutor = dokumen_mou_eksekutor.id_mou_eksekutor');
		return $this->db->get();
	}

	public function getAllMOU(){
		return $this->db->get('mou_eksekutor');
	}

	public function input_data($data){
		if ( ! $this->db->insert($this->table, $data)) {
        	return $this->db->error();
		}
		return 1;
	}

	public function get_dokumen_byID($id){
		$this->db->where('id_dokumen_mou_eksekutor', $id);
		$query = $this->db->get($this->table);
		if($query->num_rows() > 0){
			return $query->result_array();
		}
		return null;
	}

	public function update_data($data, $id){
		$this->db->where('id_dokumen_mou_eksekutor', $id);
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