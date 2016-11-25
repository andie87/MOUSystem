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
	public function getAll($param=null){
		//return $this->db->get($this->table);
		$this->db->select('mou_eksekutor.*, mou_donatur.nomor_proyek as moudonatur_nomor_proyek');
		$this->db->from($this->table);
		$this->db->join('mou_donatur', 'mou_donatur.id_mou_donatur = mou_eksekutor.id_mou_donatur');

		if($param != null){
			
			$where = "1=1";
			if($param['jenis_proyek'] != null){
				$where .= " AND mou_eksekutor.id_jenis_proyek = ".$param['jenis_proyek'];
			}
			if($param['no_proyek'] != null){
				$where .= " AND mou_donatur.nomor_proyek = ".$param['no_proyek'];
			}
			if($param['nama_proyek'] != null){
				$where .= " AND lower(nama_proyek) like '%".strtolower($param['nama_proyek'])."%'";
			}
			if($param['alamat_proyek'] != null){
				$where .= " AND lower(alamat_proyek) like '%".strtolower($param['alamat_proyek'])."%'";
			}
			if($param['progress'] != null){
				$where .= " AND progress = ".$param['progress'];
			}
			if($param['from_mou'] != null && $param['to_mou'] != null){
				$where .= " AND mou_eksekutor.tanggal_mou between '".getMysqlFormatDate($param['from_mou'])."' AND '".getMysqlFormatDate($param['to_mou'])."'";
			}
			if($param['from_pengerjaan'] != null && $param['to_pengerjaan'] != null){
				$where .= " AND mou_eksekutor.tanggal_pengerjaan between '".getMysqlFormatDate($param['from_pengerjaan'])."' AND '".getMysqlFormatDate($param['to_pengerjaan'])."'";
			}
			
			$this->db->where($where);
		}
		$this->db->order_by('id_mou_eksekutor', 'desc');
		return $this->db->get();
	}

	public function getMouDonaturByNoProyek($id){
		$this->db->where("id_mou_donatur", $id);
		return $this->db->get("mou_donatur")->result_array();
	}

	public function getAllinArray($param=null){
		//return $this->db->get($this->table);
		$this->db->select('mou_eksekutor.*, mou_donatur.nomor_proyek as moudonatur_nomor_proyek');
		$this->db->from($this->table);
		$this->db->join('mou_donatur', 'mou_donatur.id_mou_donatur = mou_eksekutor.id_mou_donatur');

		if($param != null){
			
			$where = "1=1";
			if($param['jenis_proyek'] != null){
				$where .= " AND mou_eksekutor.id_jenis_proyek = ".$param['jenis_proyek'];
			}
			if($param['no_proyek'] != null){
				$where .= " AND mou_donatur.nomor_proyek = ".$param['no_proyek'];
			}
			if($param['nama_proyek'] != null){
				$where .= " AND lower(nama_proyek) like '%".strtolower($param['nama_proyek'])."%'";
			}
			if($param['alamat_proyek'] != null){
				$where .= " AND lower(alamat_proyek) like '%".strtolower($param['alamat_proyek'])."%'";
			}
			if($param['progress'] != null){
				$where .= " AND progress = ".$param['progress'];
			}
			if($param['from_mou'] != null && $param['to_mou'] != null){
				$where .= " AND tanggal_mou between '".getMysqlFormatDate($param['from_mou'])."' AND '".getMysqlFormatDate($param['to_mou'])."'";
			}
			if($param['from_pengerjaan'] != null && $param['to_pengerjaan'] != null){
				$where .= " AND tanggal_pengerjaan between '".getMysqlFormatDate($param['from_pengerjaan'])."' AND '".getMysqlFormatDate($param['to_pengerjaan'])."'";
			}
			
			$this->db->where($where);
		}

		$query = $this->db->get();
		return $query->result_array();
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

	public function getEksekutorById($id){
		$this->db->where('id_eksekutor', $id);
		$query = $this->db->get("eksekutor");
		return $query->result_array();	
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

	public function input_data_dokumen($data){
		
		if ( ! $this->db->insert("dokumen_mou_eksekutor", $data)) {
        	return $this->db->error();
		}
		return 1;
	}

	public function delete_dokumen($data){
		
		if ( ! $this->db->delete("dokumen_mou_eksekutor", $data)) {
        	return $this->db->error();
		}
		return 1;
	}

	public function input_data_pembayaran($data){
		
		if ( ! $this->db->insert("pembayaran_eksekutor", $data)) {
        	return $this->db->error();
		}
		return 1;
	}

	public function delete_pembayaran($data){
		
		if ( ! $this->db->delete("pembayaran_eksekutor", $data)) {
        	return $this->db->error();
		}
		return 1;
	}
	
	public function getPembayaranByNomorProyek($no_proyek){
		$this->db->where('nomor_proyek', $no_proyek);
		return $this->db->get("pembayaran_eksekutor");
	}
	
}
?>