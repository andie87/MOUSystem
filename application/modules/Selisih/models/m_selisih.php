<?php

/**
* Author : Andi Mulya I
*/

class M_selisih extends CI_Model{

	public function __constract(){
		parent:: __constract();
	}

	//get all data role
	public function getAll($param=null){
		//return $this->db->get($this->table);
		/*$this->db->select('a.id_mou_donatur, c.nama_donatur, a.tanggal_mou, a.nama_penyumbang, a.nomor_proyek, a.nama_proyek, a.progress,
		a.harga_dirham, a.harga_rupiah, b.persen_pembayaran , d.nama_eksekutor, e.nilai_proyek, (a.harga_rupiah - e.nilai_proyek) selisih, e.progress_proyek ');
		$this->db->from('mou_donatur AS a');
		$this->db->join('SELECT id_mou_donatur, persen_pembayaran, max(tanggal_pembayaran) tanggal_pembayaran FROM pembayaran_donatur group by id_mou_donatur', 'a.id_mou_donatur = b.id_mou_donatur')
		$this->db->join('donatur AS c', 'a.id_donatur = c.id_donatur');
		$this->db->join('mou_eksekutor AS e', 'a.id_mou_donatur = e.id_mou_donatur');
		$this->db->join('eksekutor AS d','e.id_eksekutor = d.id_eksekutor');*/

		$sql = "SELECT a.id_mou_donatur, e.id_mou_eksekutor, c.nama_donatur, a.tanggal_mou, a.nama_penyumbang, a.nomor_proyek, a.nama_proyek, a.progress, a.harga_dirham, a.harga_rupiah, b.persen_pembayaran , d.nama_eksekutor, e.nilai_proyek, (a.harga_rupiah - e.nilai_proyek) selisih, e.progress_proyek FROM mou_donatur a INNER JOIN (SELECT nomor_proyek, persen_pembayaran, max(tanggal_pembayaran) tanggal_pembayaran FROM pembayaran_donatur group by nomor_proyek) b on a.nomor_proyek = b.nomor_proyek INNER JOIN donatur c on a.id_donatur = c.id_donatur INNER JOIN mou_eksekutor e on a.id_mou_donatur = e.id_mou_donatur INNER JOIN eksekutor d on e.id_eksekutor = d.id_eksekutor";
		$where = "";
		if($param != null){
			
			$where = " where 1=1";
			if(ISSET($param['id_mou_donatur'])){
				$where .= " AND a.id_mou_donatur = '".$param['id_mou_donatur']."'";
			}
			if(ISSET($param['id_mou_eksekutor'])){
				$where .= " AND e.id_mou_eksekutor = '".$param['id_mou_eksekutor']."'";
			}
			if(ISSET($param['no_proyek'])){
				$where .= " AND a.nomor_proyek = '".$param['no_proyek']."'";
			}
			if(ISSET($param['nama_proyek'] )){
				$where .= " AND lower(a.nama_proyek) like '%".strtolower($param['nama_proyek'])."%'";
			}
			if(ISSET($param['from_mou']) && ISSET($param['to_mou'])){
				$where .= " AND a.tanggal_mou between '".getMysqlFormatDate($param['from_mou'])."' AND '".getMysqlFormatDate($param['to_mou'])."'";
			}
			if(ISSET($param['nama_eksekutor'])){
				$where .= " AND lower(d.nama_eksekutor) like '%".strtolower($param['nama_eksekutor'])."%'";
			}
			if(ISSET($param['id_donatur'])){
				$where .= " AND c.id_donatur = '".$param['id_donatur']."'";
			}
			if(ISSET($param['tahun'])){
				$where .= " AND YEAR(a.tanggal_mou) = '".$param['tahun']."'";
			}
		}
		// 	$this->db->where($where);
		// }

		return $this->db->query($sql.$where);
	}

	public function getDonatur(){
		return $this->db->get("donatur");	
	}

	public function getListTahun(){
		$sql = "SELECT distinct year(a.tanggal_mou) tahun FROM mou_donatur a INNER JOIN (SELECT nomor_proyek, persen_pembayaran, max(tanggal_pembayaran) tanggal_pembayaran FROM pembayaran_donatur group by nomor_proyek) b on a.nomor_proyek = b.nomor_proyek INNER JOIN donatur c on a.id_donatur = c.id_donatur INNER JOIN mou_eksekutor e on a.id_mou_donatur = e.id_mou_donatur INNER JOIN eksekutor d on e.id_eksekutor = d.id_eksekutor";
		return $this->db->query($sql);
	}
}