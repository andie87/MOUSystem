
<?php 
	if(count($kotas->result()) < 1){
		echo "<option>Silakan pilih</option>";
	} else {
		echo "<option>Silakan pilih Kota</option>";
		foreach ($kotas->result() as $k) {
			echo "<option value=".$k->id_kota_kab.">".$k->nama_kota_kab."</option>";
		}
	}
?>