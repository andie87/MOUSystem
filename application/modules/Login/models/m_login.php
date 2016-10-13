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
		$this->db->select('user.*,user_role.id_role');
		$this->db->from($this->table);
		$this->db->join('user_role', 'user_role.id_user = user.id_user');
		$this->db->where('user_login', $username);
		$this->db->where('password', $password);
		$query = $this->db->get();

		if($query->num_rows() > 0){
			return $query->result_array();
		}
	}

	public function getModule(){
		$sql = "SELECT `module_group_code` FROM module WHERE 1 GROUP BY `module_group_code` ORDER BY `module_group_code` ASC";
		$query = $this->db->query($sql);
		return $query->result();	
	}

	public function getlAllModules(){
		$sql = "SELECT id_module, module_group_code, module_group_name, module_page,  module_name FROM module WHERE 1 ORDER BY `module_group_order` ASC, `module_order` ASC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getRoleRights($role){
		$sql = "SELECT b.id_module, b.module_page, `create`,`edit`, `delete`, `view`, `view_minus_biaya` FROM role_rights a inner join module b on a.id_module = b.id_module ".
				" WHERE a.id_role = ".$role." ORDER BY a.`id_module` ASC ";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
}
?>