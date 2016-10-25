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
    <h2>Report MOU Donattur</h2>
    <h3>No Proyek : <?php echo $moudonatur['nomor_proyek'];?></h3>
    <hr/>
    <table>
      <tr>
        <td>Donatur</td>
        <td>:</td>
        <td>
          <?php 
            foreach ($donaturs->result() as $d) {
              if($moudonatur['id_donatur'] == $d->id_donatur){
                echo $d->nama_donatur;
              } 
            }
          ?>
        </td>
      </tr>
      <tr>
        <td>Nomor Proyek</td>
        <td>:</td>
        <td><?php echo $moudonatur['nomor_proyek']; ?></td>
      </tr>
      <tr>
        <td>Nama Penyumbang</td>
        <td>:</td>
        <td><?php echo $moudonatur['nama_penyumbang']; ?></td>
      </tr>
      <tr>
        <td>Tanggal MoU</td>
        <td>:</td>
        <td><?php echo $moudonatur['tanggal_mou']; ?></td>
      </tr>
      <tr>
        <td>Nama Proyek</td>
        <td>:</td>
        <td><?php echo $moudonatur['nama_proyek']; ?></td>
      </tr>
      <tr>
        <td>Alamat Proyek</td>
        <td>:</td>
        <td><?php echo $moudonatur['alamat_proyek']; ?></td>
      </tr>
      <tr>
        <td>Provinsi</td>
        <td>:</td>
        <td>
          <?php 
              foreach ($provins->result() as $p) {
                if($moudonatur['id_provinsi'] == $p->id_provinsi){
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
              if($moudonatur['id_kota_kab'] == $k->id_kota_kab){
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
              if($moudonatur['id_kecamatan'] == $k->id_kecamatan){
                echo $k->nama_kecamatan;
              } 
            }
          ?>
        </td>
      </tr>
      <tr>
        <td>Jenis Proyek</td>
        <td>:</td>
        <td>
          <?php 
              foreach ($proyeks->result() as $p) {
                if($moudonatur['id_jenis_proyek'] == $p->id_jenis_proyek){
                  echo $p->nama_proyek;
                } 
              }
            ?>
        </td>
      </tr>
      <tr>
        <td>Ukuran</td>
        <td>:</td>
        <td><?php echo $moudonatur['ukuran']; ?></td>
      </tr>
      <tr>
        <td>Deskripsi Proyek</td>
        <td>:</td>
        <td><?php echo $moudonatur['deskripsi_proyek']; ?></td>
      </tr>
      <tr>
        <td>Nilai dalam Dirham</td>
        <td>:</td>
        <td><?php echo $moudonatur['harga_dirham']; ?></td>
      </tr>
      <tr>
        <td>Nilai dalam Rupiah</td>
        <td>:</td>
        <td><?php echo $moudonatur['harga_rupiah']; ?></td>
      </tr>
      <tr>
        <td>Tanggal Pembangunan</td>
        <td>:</td>
        <td><?php echo $moudonatur['tanggal_pembangunan']; ?></td>
      </tr>
      <tr>
        <td>Progress (dalam persen)</td>
        <td>:</td>
        <td><?php echo $moudonatur['progress']; ?></td>
      </tr>
      <tr>
        <td>Status</td>
        <td>:</td>
        <td>
          <?php 
             echo $moudonatur['status'];
          ?>
        </td>
      </tr>
      <tr>
        <td>Status Note</td>
        <td>:</td>
        <td><?php echo $moudonatur['note']; ?></td>
      </tr>
    </table>
  </body>
</html>