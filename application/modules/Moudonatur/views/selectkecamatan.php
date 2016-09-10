
<?php 
	if(count($kecamatan->result()) < 1){
		echo "<option>Please select</option>";
	} else {
		foreach ($kecamatan->result() as $k) {
			echo "<option value=".$k->id_kecamatan.">".$k->nama_kecamatan."</option>";
		}
	}
?>