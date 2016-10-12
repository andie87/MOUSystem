SELECT a.`id_mou_donatur`, c.`nama_donatur`, a.`tanggal_mou`, a.`nama_penyumbang`, a.`nomor_proyek`, a.`nama_proyek`, a.`progress`,
a.`harga_dirham`, a.`harga_rupiah`, b.`persen_pembayaran` , d.`nama_eksekutor`, e.`nilai_proyek`, (a.`harga_rupiah` - e.`nilai_proyek`) selisih, e.`progress_proyek` 
FROM `mou_donatur` a 
INNER JOIN (SELECT `id_mou_donatur`, `persen_pembayaran`, max(`tanggal_pembayaran`) tanggal_pembayaran FROM `pembayaran_donatur` group by `id_mou_donatur`) b on a.`id_mou_donatur` = b.`id_mou_donatur` 
INNER JOIN `donatur` c on a.`id_donatur` = c.`id_donatur`
INNER JOIN `mou_eksekutor` e on a.`id_mou_donatur` = e.`id_mou_donatur`
INNER JOIN `eksekutor` d on e.`id_eksekutor` = d.`id_eksekutor`