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

		$sql = "SELECT a.id_mou_donatur, e.id_mou_eksekutor, c.nama_donatur, a.tanggal_mou, a.nama_penyumbang, a.nomor_proyek, a.nama_proyek, a.progress, a.harga_dirham, a.harga_rupiah, b.persen_pembayaran , d.nama_eksekutor, e.nilai_proyek, (a.harga_rupiah - e.nilai_proyek) selisih, e.progress_proyek FROM mou_donatur a INNER JOIN (SELECT id_mou_donatur, persen_pembayaran, max(tanggal_pembayaran) tanggal_pembayaran FROM pembayaran_donatur group by id_mou_donatur) b on a.id_mou_donatur = b.id_mou_donatur INNER JOIN donatur c on a.id_donatur = c.id_donatur INNER JOIN mou_eksekutor e on a.id_mou_donatur = e.id_mou_donatur INNER JOIN eksekutor d on e.id_eksekutor = d.id_eksekutor";
		$where = "";
		if($param != null){
			
			$where = " where 1=1";
			if($param['no_proyek'] != null){
				$where .= " AND a.nomor_proyek = '".$param['no_proyek']."'";
			}
			if($param['nama_proyek'] != null){
				$where .= " AND lower(a.nama_proyek) like '%".strtolower($param['nama_proyek'])."%'";
			}
			if($param['from_mou'] != null && $param['to_mou'] != null){
				$where .= " AND a.tanggal_mou between '".getMysqlFormatDate($param['from_mou'])."' AND '".getMysqlFormatDate($param['to_mou'])."'";
			}
			if($param['nama_eksekutor'] != null){
				$where .= " AND lower(d.nama_eksekutor) like '%".strtolower($param['nama_eksekutor'])."%'";
			}
		}
		// 	$this->db->where($where);
		// }

		return $this->db->query($sql.$where);
	}
}