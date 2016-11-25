<?php

/**
* Author : Ahmad Shodiqi
* Email : diki2786@gmail.com
* Desc : model query pada role
*/

class M_moudonatur extends CI_Model{

	var $table = 'mou_donatur';
	
	public function __constract(){
		parent:: __constract();
	}

	public function getAll($param=null){
		
		$where = "1=1";
		
		if($param != null){
			
			if($param['jenis_proyek'] != null){
				$where .= " AND id_jenis_proyek = ".$param['jenis_proyek'];
			}
			if($param['nama_proyek'] != null){
				$where .= " AND lower(nama_proyek) like '%".strtolower($param['nama_proyek'])."%'";
			}
			if($param['nomor_proyek'] != null){
				$where .= " AND lower(nomor_proyek) like '%".strtolower($param['nomor_proyek'])."%'";
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
			if($param['from_pembangunan'] != null && $param['to_pembangunan'] != null){
				$where .= " AND tanggal_pembangunan between '".getMysqlFormatDate($param['from_pembangunan'])."' AND '".getMysqlFormatDate($param['to_pembangunan'])."'";
			}
			
		}
		
		$this->db->from($this->table);
		$this->db->where($where);
		$this->db->order_by('id_mou_donatur', 'desc');
		
		return $this->db->get();
		
	}
	
	public function getAllinArray($param=null){
		
		if($param != null){
			
			$where = "1=1";
			if($param['jenis_proyek'] != null){
				$where .= " AND id_jenis_proyek = ".$param['jenis_proyek'];
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
			if($param['from_pembangunan'] != null && $param['to_pembangunan'] != null){
				$where .= " AND tanggal_pembangunan between '".getMysqlFormatDate($param['from_pembangunan'])."' AND '".getMysqlFormatDate($param['to_pembangunan'])."'";
			}
			
			$this->db->where($where);
		}
		
		$query = $this->db->get($this->table);
		return $query->result_array();
		
	}
	
	public function getMoudonaturById($id){
		
		$this->db->where('id_mou_donatur', $id);
		$query = $this->db->get($this->table);
		
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
	
	public function input_data_dokumen($data){
		
		if ( ! $this->db->insert("dokumen_mou_donatur", $data)) {
        	return $this->db->error();
		}
		return 1;
	}
	
	public function input_data_pembayaran($data){
		
		if ( ! $this->db->insert("pembayaran_donatur", $data)) {
        	return $this->db->error();
		}
		return 1;
	}
	
	public function update_data($data, $id_mou_donatur){
		
		$this->db->where('id_mou_donatur', $id_mou_donatur);
		
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
	
	public function delete_dokumen($data){
		
		if ( ! $this->db->delete("dokumen_mou_donatur", $data)) {
        	return $this->db->error();
		}
		return 1;
	}
	
	public function delete_pembayaran($data){
		
		if ( ! $this->db->delete("pembayaran_donatur", $data)) {
        	return $this->db->error();
		}
		return 1;
	}
	
	public function get_donatur(){
		return $this->db->get("donatur");	
	}
	
	public function get_provinsi(){
		return $this->db->get("provinsi");	
	}
	
	public function get_kotakab_by_prov($id){
		$this->db->where('id_provinsi', $id);
		return $this->db->get("kota_kab");
	}
	
	public function get_kecamatan_by_kota($id){
		$this->db->where('id_kota_kab', $id);
		return $this->db->get("kecamatan");
	}
	
	public function get_jenis_proyek(){
		return $this->db->get("jenis_proyek");	
	}
		
	public function get_jenis_proyek_array(){
		$query = $this->db->get("jenis_proyek");
		return $query->result_array();	
	}
	
	public function getDokumenByMouDonaturId($id){
		$this->db->where('id_mou_donatur', $id);
		return $this->db->get("dokumen_mou_donatur");
	}
	
	public function getPembayaranByMouDonaturId($id){
		$this->db->where('id_mou_donatur', $id);
		return $this->db->get("pembayaran_donatur");
	}
	
	public function getPembayaranByNomorProyek($no_proyek){
		$this->db->where('nomor_proyek', $no_proyek);
		return $this->db->get("pembayaran_donatur");
	}
	
	public function getDokumenById($id){
		$this->db->where('id_dokumen_mou_donatur', $id);
		$query = $this->db->get("dokumen_mou_donatur");
		return $query->result_array();	
	}
	
	public function getPembayaranById($id){
		$this->db->where('id_pembayaran_donatur', $id);
		$query = $this->db->get("pembayaran_donatur");
		return $query->result_array();	
	}
	
	public function update_data_pembayaran($data, $id_pembayaran){
		
		$this->db->where('id_pembayaran_donatur', $id_pembayaran);
		
		if ( ! $this->db->update("pembayaran_donatur", $data)) {
        	return $this->db->error();
		}
		return 1;
		
	}
	
	public function getDonaturById($id){
		$this->db->where('id_donatur', $id);
		$query = $this->db->get("donatur");
		return $query->result_array();	
	}
	
	public function getProvinsiById($id){
		$this->db->where('id_provinsi', $id);
		$query = $this->db->get("provinsi");
		return $query->result_array();	
	}
	
	public function getKotaKabById($id){
		$this->db->where('id_kota_kab', $id);
		$query = $this->db->get("kota_kab");
		return $query->result_array();	
	}

	public function getKecamatanById($id){
		$this->db->where('id_kecamatan', $id);
		$query = $this->db->get("kecamatan");
		return $query->result_array();	
	}
	
	public function getJenisProyekById($id){
		$this->db->where('id_jenis_proyek', $id);
		$query = $this->db->get("jenis_proyek");
		return $query->result_array();	
	}
	
	public function get_moudonatur(){
		return $this->db->get("mou_donatur");
	}
	
}
?>