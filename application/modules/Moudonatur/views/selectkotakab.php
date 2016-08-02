
<?php 
	if(count($kotas->result()) < 1){
		echo "<option>Please select</option>";
	} else {
		foreach ($kotas->result() as $k) {
			echo "<option value=".$k->id_kota_kab.">".$k->nama_kota_kab."</option>";
		}
	}
?>