
CREATE TABLE IF NOT EXISTS `dokumen_mou_donatur` (
  `id_dokumen_mou_donatur` int(11) NOT NULL AUTO_INCREMENT,
  `id_mou_donatur` int(11) NOT NULL,
  `nama_file` varchar(200) DEFAULT NULL,
  `alamat_file` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id_dokumen_mou_donatur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `dokumen_mou_eksekutor` (
  `id_dokumen_mou_eksekutor` int(11) NOT NULL AUTO_INCREMENT,
  `id_mou_eksekutor` int(11) NOT NULL,
  `nama_file` varchar(100) DEFAULT NULL,
  `alamat_file` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id_dokumen_mou_eksekutor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `dokumen_mou_eksekutor`
--


-- --------------------------------------------------------

--
-- Table structure for table `donatur`
--

CREATE TABLE IF NOT EXISTS `donatur` (
  `id_donatur` int(11) NOT NULL AUTO_INCREMENT,
  `nama_donatur` varchar(100) NOT NULL,
  `asal_negara` varchar(50) DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `no_kontak` varchar(20) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `nama_pic` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_donatur`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `donatur`
--

INSERT INTO `donatur` (`id_donatur`, `nama_donatur`, `asal_negara`, `alamat`, `no_kontak`, `email`, `nama_pic`) VALUES
(1, 'SCI', 'UEA', 'nn', '11111', 'info@sci.com', 'abdullah');

-- --------------------------------------------------------

--
-- Table structure for table `eksekutor`
--

CREATE TABLE IF NOT EXISTS `eksekutor` (
  `id_eksekutor` int(11) NOT NULL AUTO_INCREMENT,
  `nama_eksekutor` varchar(100) NOT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `no_kontak` varchar(20) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `nama_pic` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_eksekutor`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `eksekutor`
--

INSERT INTO `eksekutor` (`id_eksekutor`, `nama_eksekutor`, `alamat`, `no_kontak`, `email`, `nama_pic`) VALUES
(1, 'PT. XYZ', 'ciputat', '08111111111', 'info@xyz.com', 'bang jali'),
(2, 'PT ABC', 'Pondok Aren', '1234567', 'info@abc.com', 'Bang Fajar');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_proyek`
--

CREATE TABLE IF NOT EXISTS `jenis_proyek` (
  `id_jenis_proyek` int(11) NOT NULL AUTO_INCREMENT,
  `nama_proyek` varchar(200) NOT NULL,
  PRIMARY KEY (`id_jenis_proyek`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `jenis_proyek`
--

INSERT INTO `jenis_proyek` (`id_jenis_proyek`, `nama_proyek`) VALUES
(1, 'Pembangunan Masjid'),
(2, 'Pembuatan Sumur'),
(3, 'Pembangunan Kelas Sekolah'),
(4, 'Pemberian Sembako'),
(5, 'Pemberian Modal Usaha'),
(6, 'Bantuan Korban Bencana Alam');

-- --------------------------------------------------------

--
-- Table structure for table `kota_kab`
--

CREATE TABLE IF NOT EXISTS `kota_kab` (
  `id_kota_kab` int(11) NOT NULL AUTO_INCREMENT,
  `id_provinsi` int(11) DEFAULT NULL,
  `nama_kota_kab` varchar(45) NOT NULL,
  PRIMARY KEY (`id_kota_kab`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `kota_kab`
--


-- --------------------------------------------------------

--
-- Table structure for table `kunjungan`
--

CREATE TABLE IF NOT EXISTS `kunjungan` (
  `id_kunjungan` int(11) NOT NULL AUTO_INCREMENT,
  `id_mou_eksekutor` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `supervisor` varchar(100) DEFAULT NULL,
  `catatan` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id_kunjungan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `kunjungan`
--


-- --------------------------------------------------------

--
-- Table structure for table `kurs_eksekutor`
--

CREATE TABLE IF NOT EXISTS `kurs_eksekutor` (
  `kurs` int(11) NOT NULL,
  PRIMARY KEY (`kurs`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kurs_eksekutor`
--

INSERT INTO `kurs_eksekutor` (`kurs`) VALUES
(2300);

-- --------------------------------------------------------

--
-- Table structure for table `mou_donatur`
--

CREATE TABLE IF NOT EXISTS `mou_donatur` (
  `id_mou_donatur` int(11) NOT NULL AUTO_INCREMENT,
  `id_donatur` int(11) NOT NULL,
  `tanggal_mou` date DEFAULT NULL,
  `nomor_proyek` varchar(45) DEFAULT NULL,
  `nama_proyek` varchar(100) DEFAULT NULL,
  `alamat_proyek` varchar(200) DEFAULT NULL,
  `id_provinsi` int(11) DEFAULT NULL,
  `id_kota_kab` int(11) DEFAULT NULL,
  `id_jenis_proyek` int(11) DEFAULT NULL,
  `deskripsi_proyek` varchar(200) DEFAULT NULL,
  `harga_dirham` decimal(10,0) DEFAULT NULL,
  `harga_rupiah` decimal(10,0) DEFAULT NULL,
  `tanggal_pembangunan` date DEFAULT NULL,
  `progress` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_mou_donatur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `mou_donatur`
--


-- --------------------------------------------------------

--
-- Table structure for table `mou_eksekutor`
--

CREATE TABLE IF NOT EXISTS `mou_eksekutor` (
  `id_mou_eksekutor` int(11) NOT NULL AUTO_INCREMENT,
  `id_eksekutor` int(11) NOT NULL,
  `id_mou_donatur` int(11) NOT NULL,
  `nomor_proyek` varchar(45) DEFAULT NULL,
  `tanggal_mou` date DEFAULT NULL,
  `tanggal_mou_hijriah` varchar(45) DEFAULT NULL,
  `tanggal_pengerjaan` date DEFAULT NULL,
  `nama_eksekutor` varchar(100) DEFAULT NULL,
  `alamat_eksekutor` varchar(200) DEFAULT NULL,
  `jabatan_eksekutor` varchar(45) DEFAULT NULL,
  `kontak_eksekutor` varchar(20) DEFAULT NULL,
  `nama_proyek` varchar(100) DEFAULT NULL,
  `id_jenis_proyek` int(11) DEFAULT NULL,
  `deskripsi_proyek` varchar(200) DEFAULT NULL,
  `ukuran` varchar(45) DEFAULT NULL,
  `id_provinsi` int(11) DEFAULT NULL,
  `id_kota_kab` int(11) DEFAULT NULL,
  `alamat_lokasi` varchar(200) DEFAULT NULL,
  `koordinat_lokasi` varchar(500) DEFAULT NULL,
  `nilai_proyek` decimal(10,0) DEFAULT NULL,
  `progress_proyek` int(11) DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `is_banner` tinyint(4) DEFAULT NULL,
  `is_prasasti` tinyint(4) DEFAULT NULL,
  `pic_lokasi` varchar(100) DEFAULT NULL,
  `kontak_pic_lokasi` varchar(20) DEFAULT NULL,
  `alamat_pic_lokasi` varchar(200) DEFAULT NULL,
  `nama_bangunan_di_lokasi` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_mou_eksekutor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `mou_eksekutor`
--


-- --------------------------------------------------------

--
-- Table structure for table `pembayaran_donatur`
--

CREATE TABLE IF NOT EXISTS `pembayaran_donatur` (
  `id_pembayaran_donatur` int(11) NOT NULL AUTO_INCREMENT,
  `id_mou_donatur` varchar(45) NOT NULL,
  `nominal_pembayaran` decimal(10,0) DEFAULT NULL,
  `persen_pembayaran` int(11) DEFAULT NULL,
  `pembayaran_ke` int(11) DEFAULT NULL,
  `tanggal_pembayaran` date DEFAULT NULL,
  `tanggal_deadline_pembayaran` date DEFAULT NULL,
  PRIMARY KEY (`id_pembayaran_donatur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `pembayaran_donatur`
--


-- --------------------------------------------------------

--
-- Table structure for table `pembayaran_eksekutor`
--

CREATE TABLE IF NOT EXISTS `pembayaran_eksekutor` (
  `id_pembayaran_eksekutor` int(11) NOT NULL AUTO_INCREMENT,
  `id_mou_eksekutor` int(11) DEFAULT NULL,
  `nominal_pembayaran` decimal(10,0) DEFAULT NULL,
  `persen_pembayaran` decimal(10,0) DEFAULT NULL,
  `pembayaran_ke` int(11) DEFAULT NULL,
  `tanggal_pembayaran` date DEFAULT NULL,
  `tanggal_deadline_pembayaran` date DEFAULT NULL,
  PRIMARY KEY (`id_pembayaran_eksekutor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `pembayaran_eksekutor`
--


-- --------------------------------------------------------

--
-- Table structure for table `provinsi`
--

CREATE TABLE IF NOT EXISTS `provinsi` (
  `id_provinsi` int(11) NOT NULL AUTO_INCREMENT,
  `nama_provinsi` varchar(100) NOT NULL,
  PRIMARY KEY (`id_provinsi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `provinsi`
--


-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `id_role` int(11) NOT NULL AUTO_INCREMENT,
  `nama_role` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_role`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id_role`, `nama_role`) VALUES
(1, 'admin'),
(2, 'bendahara'),
(3, 'sekretaris');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nama_user` varchar(100) NOT NULL,
  `user_login` varchar(50) NOT NULL,
  `password` varchar(260) NOT NULL,
  `no_kontak` varchar(20) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama_user`, `user_login`, `password`, `no_kontak`, `email`) VALUES
(1, 'Masturi Istamar Suhadi', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', '087782074686', 'masturi.istamar@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE IF NOT EXISTS `user_role` (
  `id_user_role` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  PRIMARY KEY (`id_user_role`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

