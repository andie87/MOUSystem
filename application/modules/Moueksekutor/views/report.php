<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<style>
	table {
		font-family: calibri;
		width: 1200px;
	}
	.td-header{
		text-align: center;
		border: 1px solid #ddd; 
		padding-left: 5px;
		padding-right: 5px; 
		background: purple;
		color: white;
	}
	.td{
		border: 1px solid grey; 
		padding-left: 3px;
		padding-right: 3px; 
	}
	.td-grey{
		border: 1px solid grey; 
		padding-left: 3px;
		padding-right: 3px; 
		background: #efefef;
	}
	.center{
		text-align: center;
	}
	.right{
		text-align: right;
	}
</style>

<html>
	<table style="border: 1px solid blue; border-collapse: collapse;">
		<tr>
			<td class="td-header">No</td>
			<td class="td-header">Nama Eksekutor</td>
			<td class="td-header">No Proyek</td>
			<td class="td-header">Tanggal MoU</td>
			<td class="td-header">Nama Proyek</td>
			<td class="td-header">Alamat Proyek</td>
			<td class="td-header">Provinsi</td>
			<td class="td-header">Kota/Kab</td>
			<td class="td-header">Kecamatan</td>
			<td class="td-header">Jenis Proyek</td>
			<td class="td-header">Nilai Proyek</td>
			<td class="td-header">Tgl Pengerjaan</td>
		</tr>
		<?php
           	$i = 1;   
          	foreach ($moueksekutors as $md) {
          		if($i%2==0){
          			$class = "td-grey";
          		} else {
          			$class = "td";
          		}
        ?>
		<tr>
			<td class="<?php echo $class; ?> center"><?php echo $i; ?></td>
			<td class="<?php echo $class; ?>"><?php echo $md['nama_eksekutor']; ?></td>
			<td class="<?php echo $class; ?>"><?php echo $md['moudonatur_nomor_proyek']; ?></td>
			<td class="<?php echo $class; ?> center"><?php echo $md['tanggal_mou']=='0000-00-00' ? "" : getUserFormatDate($md['tanggal_mou']); ?></td>
			<td class="<?php echo $class; ?>"><?php echo $md['nama_proyek']; ?></td>
			<td class="<?php echo $class; ?>"><?php echo $md['alamat_lokasi']; ?></td>
			<td class="<?php echo $class; ?>"><?php echo $md['nama_provinsi']; ?></td>
			<td class="<?php echo $class; ?>"><?php echo $md['nama_kota']; ?></td>
			<td class="<?php echo $class; ?>"><?php echo $md['nama_kecamatan']; ?></td>
			<td class="<?php echo $class; ?>"><?php echo $md['jenis_proyek']; ?></td>
			<td class="<?php echo $class; ?> right"><?php echo $md['nilai_proyek']; ?></td>
			<td class="<?php echo $class; ?> center"><?php echo $md['tanggal_pengerjaan']=='0000-00-00' ? "" : getUserFormatDate($md['tanggal_pengerjaan']); ?></td>
		</tr>
		<?php $i++; }?>
	</table>
</html>