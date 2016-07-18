<?php
/**
* Author : Andi Mulya Indrianto
* Email : andie.mulya.i@gmail.com
* Created Date: 12 Jul 2016
* Desc : model query pada login
*/
class M_login extends CI_Model{

	var $table = 'user';
	public function __constract(){
		parent:: __constract();
	}

	//check login credential
	public function loginCheck($username, $password){
		$this->db->where('user_login', $username);
		$this->db->where('password', $password);
		$query = $this->db->get($this->table);

		if($query->num_rows() > 0){
			return $query->result_array();
		}
	}
}
?>