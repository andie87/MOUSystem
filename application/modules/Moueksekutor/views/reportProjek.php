<html>
  <head>
    <style>
      table, th, td {
        border:none;
        margin:10px;
        padding:5px;
      }
    </style>
  </head>
  <body>
    <h2>Report MOU Eksekutor</h2>
    <h3>No Proyek : 
      <?php 
        echo $moueksekutor['moudonatur_nomor_proyek'];
      ?>
    </h3>
    <hr/>
    <table>
      <tr>
        <td>Eksekutor</td>
        <td>:</td>
        <td>
          <?php 
            foreach ($eksekutors->result() as $d) {
              if($moueksekutor['id_eksekutor'] == $d->id_eksekutor){
                echo $d->nama_eksekutor;
              }
            }
          ?>
        </td>
      </tr>
      <tr>
        <td>Nomor Proyek MoU Donatur</td>
        <td>:</td>
        <td>
           <?php 
            echo $moueksekutor['moudonatur_nomor_proyek'];
          ?>
        </td>
      </tr>
      <tr>
        <td>Tanggal MoU</td>
        <td>:</td>
        <td><?php echo $moueksekutor['tanggal_mou'];?></td>
      </tr>
      <tr>
        <td>Tanggal Hijriah</td>
        <td>:</td>
        <td><?php echo $moueksekutor['tanggal_mou_hijriah'];?></td>
      </tr>
      <tr>
        <td>Tanggal Pengerjaan</td>
        <td>:</td>
        <td><?php echo $moueksekutor['tanggal_pengerjaan'];?></td>
      </tr>
      <tr>
        <td>Nama Eksekutor</td>
        <td>:</td>
        <td><?php echo $moueksekutor['nama_eksekutor']; ?></td>
      </tr>
      <tr>
        <td>Alamat Eksekutor</td>
        <td>:</td>
        <td><?php echo $moueksekutor['alamat_eksekutor']; ?></td>
      </tr>
      <tr>
        <td>Jabatan Eksekutor</td>
        <td>:</td>
        <td><?php echo $moueksekutor['jabatan_eksekutor']; ?></td>
      </tr>
      <tr>
        <td>No HP Eksekutor</td>
        <td>:</td>
        <td><?php echo $moueksekutor['kontak_eksekutor']; ?></td>
      </tr>
      <tr>
        <td>Nama Proyek</td>
        <td>:</td>
        <td><?php echo $moueksekutor['nama_proyek']; ?></td>
      </tr>
      <tr>
        <td>Jenis Proyek</td>
        <td>:</td>
        <td>
          <?php 
              foreach ($proyeks->result() as $p) {
                if($moueksekutor['id_jenis_proyek'] == $p->id_jenis_proyek){
                  echo $p->nama_proyek;
                } 
              }
            ?>
        </td>
      </tr>
      <tr>
        <td>Deskripsi Proyek</td>
        <td>:</td>
        <td><?php echo $moueksekutor['deskripsi_proyek']; ?></td>
      </tr>
      <tr>
        <td>Ukuran</td>
        <td>:</td>
        <td><?php echo $moueksekutor['ukuran']; ?></td>
      </tr>      
      <tr>
        <td>Provinsi</td>
        <td>:</td>
        <td>
          <?php 
              foreach ($provins->result() as $p) {
                if($moueksekutor['id_provinsi'] == $p->id_provinsi){
                  echo $p->nama_provinsi;
                }
              }
            ?>
        </td>
      </tr>
      <tr>
        <td>Kota/Kabupaten</td>
        <td>:</td>
        <td>
          <?php 
            foreach ($kotas->result() as $k) {
              if($moueksekutor['id_kota_kab'] == $k->id_kota_kab){
                echo $k->nama_kota_kab;
              } 
            }
          ?>
        </td>
      </tr>
      <tr>
        <td>Kecamatan</td>
        <td>:</td>
        <td>
          <?php 
            foreach ($kecamatan->result() as $k) {
              if($moueksekutor['id_kecamatan'] == $k->id_kecamatan){
                echo $k->nama_kecamatan;
              } 
            }
          ?>
        </td>
      </tr>    
      
      <tr>
        <td>Alamat Lokasi</td>
        <td>:</td>
        <td><?php echo $moueksekutor['alamat_lokasi']; ?></td>
      </tr>
      <tr>
        <td>Koordinat Lokasi</td>
        <td>:</td>
        <td><?php echo $moueksekutor['koordinat_lokasi']; ?></td>
      </tr>
      <tr>
        <td>Nilai Proyek</td>
        <td>:</td>
        <td><?php echo $moueksekutor['nilai_proyek']; ?></td>
      </tr>
      <tr>
        <td>Tanggal Selesai</td>
        <td>:</td>
        <td><?php echo $moueksekutor['tanggal_selesai']; ?></td>
      </tr>
      <tr>
        <td>Pakai Banner</td>
        <td>:</td>
        <td>
          <?php 
             echo $moueksekutor['is_banner'] == "1" ? "YA" : "TIDAK";
          ?>
        </td>
      </tr>
      <tr>
        <td>Pakai Prasasti</td>
        <td>:</td>
        <td>
          <?php 
             echo $moueksekutor['is_prasasti'] == "1" ? "YA" : "TIDAK";
          ?>
        </td>
      </tr>
      <tr>
        <td>PIC Lokasi</td>
        <td>:</td>
        <td><?php echo $moueksekutor['pic_lokasi']; ?></td>
      </tr>
      <tr>
        <td>No HP PIC Lokasi</td>
        <td>:</td>
        <td><?php echo $moueksekutor['kontak_pic_lokasi']; ?></td>
      </tr>
      <tr>
        <td>Alamat PIC Lokasi</td>
        <td>:</td>
        <td><?php echo $moueksekutor['alamat_pic_lokasi']; ?></td>
      </tr>
      <tr>
        <td>Nama Bangunan di Lokasi</td>
        <td>:</td>
        <td><?php echo $moueksekutor['nama_bangunan_di_lokasi']; ?></td>
      </tr>
      <tr>
        <td>Progress (dalam persen)</td>
        <td>:</td>
        <td><?php echo $moueksekutor['progress_proyek']; ?></td>
      </tr>
    </table>
  </body>
</html>