<script>
function changeKotaKab(){
	var select_provinsi = $("#select_provinsi").val();
	$.ajax({
		url: "<?php echo base_url('index.php/moudonatur/selectkotakab' ); ?>/" + select_provinsi, 
		success: function(result) {
			$("#select_kotakab").html(result);					
		}
	});
}
function changeKecamatan(){
	
	var select_kotakab = $("#select_kotakab").val();
	$.ajax({
		url: "<?php echo base_url('index.php/moudonatur/selectkecamatan' ); ?>/" + select_kotakab, 
		success: function(result) {
			$("#select_kecamatan").html(result);					
		}
	});
}
</script>

<div class="content-wrapper">
    <section class="content-header">
      <h1 style="padding-bottom: 15px;">
        Form MoU Eksekutor
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">MoU Eksekutor</a></li>
        <li class="active"><a href="#">Tambah MoU</a></li>
      </ol>
    </section>

		<div class="padding-md">
		<div class="panel panel-default">
		
		<?php if(isset($message)){ ?> 
	    	<div class="alert alert-danger">
	    		<label><strong><?php echo $message; ?></strong></label>
	    	</div>
    	<?php } ?>
    	
		<div class="panel-body">
			<?php echo form_open('moueksekutor/prosesCreate', array('class'=>'form-horizontal','method'=>'post'));?>
				<div class="form-group" style="padding-top: 20px;">
					<label class="col-sm-3 control-label">Eksekutor</label>
					<div class="col-lg-5">
						<select class="form-control select2" name="id_eksekutor" style="width: 100%;">
						<?php 
							foreach ($eksekutors->result() as $d) {
								echo "<option value=".$d->id_eksekutor.">".$d->nama_eksekutor."</option>";
							}
						?>
		                </select>
					</div>
				</div>
				<div class="form-group" >
					<label class="col-sm-3 control-label">Nomor Proyek MoU Donatur</label>
					<div class="col-lg-5">
						<select class="form-control select2" name="id_mou_donatur" style="width: 100%;">
						<?php 
							foreach ($moudonatur->result() as $d) {
								echo "<option value=".$d->id_mou_donatur.">".$d->nomor_proyek."</option>";
							}
						?>
		                </select>
					</div>
				</div>
				<div class="form-group" >
					<label class="col-sm-3 control-label">Tanggal MoU</label>
					<div class="col-lg-5 input-group" style="padding-left: 15px; padding-right: 15px;">
	                <div class="input-group-addon "><i class="fa fa-calendar"></i></div>
	                 <input type="text" name="tanggal_mou" class="form-control pull-right" id="datepickerMOU">
	                </div>
                </div>
				<div class="form-group" >
					<label class="col-sm-3 control-label">Tanggal Hijriah</label>
					<div class="col-lg-5">
						<input type="text" name="tanggal_mou_hijriah" class="form-control input-sm" >
					</div>
				</div>
				<div class="form-group" >
					<label class="col-sm-3 control-label">Tanggal Pengerjaan</label>
					<div class="col-lg-5 input-group" style="padding-left: 15px; padding-right: 15px;">
	                <div class="input-group-addon "><i class="fa fa-calendar"></i></div>
	                 <input type="text" name="tanggal_pengerjaan" class="form-control pull-right" id="datepickerPembangunan">
	                </div>
                </div>
				<div class="form-group" >
					<label class="col-sm-3 control-label">Nama Eksekutor</label>
					<div class="col-lg-5">
						<input type="text" name="nama_eksekutor" class="form-control input-sm" >
					</div>
				</div>
				<div class="form-group" >
					<label class="col-sm-3 control-label">Alamat Eksekutor</label>
					<div class="col-lg-5">
						<textarea class="form-control" name="alamat_eksekutor" rows="3" placeholder=""></textarea>
					</div>
				</div>
				<div class="form-group" >
					<label class="col-sm-3 control-label">Jabatan Eksekutor</label>
					<div class="col-lg-5">
						<input type="text" name="jabatan_eksekutor" class="form-control input-sm" >
					</div>
				</div>
				<div class="form-group" >
					<label class="col-sm-3 control-label">No HP Eksekutor</label>
					<div class="col-lg-5">
						<input type="text" name="kontak_eksekutor" class="form-control input-sm" >
					</div>
				</div>
				<div class="form-group" >
					<label class="col-sm-3 control-label">Nama Proyek</label>
					<div class="col-lg-5">
						<input type="text" name="nama_proyek" class="form-control input-sm" >
					</div>
				</div>
				<div class="form-group" >
					<label class="col-sm-3 control-label">Jenis Proyek</label>
					<div class="col-lg-5">
						<select class="form-control select2" name="id_jenis_proyek" style="width: 100%;">
						<?php 
							foreach ($proyeks->result() as $p) {
								echo "<option value=".$p->id_jenis_proyek.">".$p->nama_proyek."</option>";
							}
						?>
		                </select>
					</div>
				</div>
				<div class="form-group" >
					<label class="col-sm-3 control-label">Deskripsi Proyek</label>
					<div class="col-lg-5">
						<textarea class="form-control" rows="3" name="deskripsi_proyek"></textarea>
					</div>
				</div>
				<div class="form-group" >
					<label class="col-sm-3 control-label">Ukuran</label>
					<div class="col-lg-5">
						<input type="text" id="ukuran" style="font-size: 13pt;" name="ukuran" class="form-control input-sm" onkeypress="return isNumberKey(event)">
					</div>
				</div>
				<div class="form-group" >
					<label class="col-sm-3 control-label">Provinsi</label>
					<div class="col-lg-5">
						<select id="select_provinsi" class="form-control select2" name="provinsi" style="width: 100%;" onChange="changeKotaKab(this.val);">
						<option>Please select</option>
						<?php 
							foreach ($provins->result() as $p) {
								echo "<option value=".$p->id_provinsi.">".$p->nama_provinsi."</option>";
							}
						?>
		                </select>
					</div>
				</div>
				<div class="form-group" >
					<label class="col-sm-3 control-label">Kota/Kabupaten</label>
					<div class="col-lg-5" id="div_kota_kab">
						<select id="select_kotakab" class="form-control select2" name="kota" style="width: 100%;" onChange="changeKecamatan(this.val);">
							<option>Please select</option>
		                </select>
					</div>
				</div>
				<div class="form-group" >
					<label class="col-sm-3 control-label">Kecamatan</label>
					<div class="col-lg-5" id="div_kecamatan">
						<select id="select_kecamatan" class="form-control select2" name="kecamatan" style="width: 100%;">
							<option>Please select</option>
		                </select>
					</div>
				</div>
				<div class="form-group" >
					<label class="col-sm-3 control-label">Alamat Lokasi</label>
					<div class="col-lg-5">
						<textarea class="form-control" name="alamat_lokasi" rows="3" placeholder=""></textarea>
					</div>
				</div>
				<div class="form-group" >
					<label class="col-sm-3 control-label">Koordinat Lokasi</label>
					<div class="col-lg-5">
						<input type="text" id="koordinat_lokasi" style="font-size: 13pt;" name="koordinat_lokasi" class="form-control input-sm" >
					</div>
				</div>
				<div class="form-group" >
					<label class="col-sm-3 control-label">Nilai Proyek</label>
					<div class="col-lg-5">
						<input type="text" id="nilai_rupiah" style="font-size: 13pt;" name="nilai_proyek" class="form-control input-sm" onkeypress="return isNumberKey(event)">
					</div>
				</div>
				<div class="form-group" >
					<label class="col-sm-3 control-label">Tanggal Selesai</label>
					<div class="col-lg-5 input-group" style="padding-left: 15px; padding-right: 15px;">
	                <div class="input-group-addon "><i class="fa fa-calendar"></i></div>
	                 <input type="text" name="tanggal_selesai" class="form-control pull-right" id="datepickerSelesai">
	                 </div>
                </div>
                <div class="form-group" >
					<label class="col-sm-3 control-label">Sudah dipasang Banner</label>
					<div class="col-lg-5">
						<select name="is_banner" class="form-control select2">
							<option value="1">Ya</option>
							<option value="0">Tidak</option>
						</select>
					</div>
				</div>
				<div class="form-group" >
					<label class="col-sm-3 control-label">Sudah dipasang Prasasti</label>
					<div class="col-lg-5">
						<select name="is_prasasti" class="form-control select2">
							<option value="1">Ya</option>
							<option value="0">Tidak</option>
						</select>
					</div>
				</div>
				<div class="form-group" >
					<label class="col-sm-3 control-label">PIC Lokasi</label>
					<div class="col-lg-5">
						<input type="text" style="font-size: 13pt;" name="pic_lokasi" class="form-control input-sm" >
					</div>
				</div>
				<div class="form-group" >
					<label class="col-sm-3 control-label">No HP PIC Lokasi</label>
					<div class="col-lg-5">
						<input type="text" style="font-size: 13pt;" name="kontak_pic_lokasi" class="form-control input-sm" >
					</div>
				</div>
				<div class="form-group" >
					<label class="col-sm-3 control-label">Alamat PIC Lokasi</label>
					<div class="col-lg-5">
						<textarea class="form-control" name="alamat_pic_lokasi" rows="3" placeholder=""></textarea>
					</div>
				</div>
				<div class="form-group" >
					<label class="col-sm-3 control-label">Nama Bangunan di Lokasi</label>
					<div class="col-lg-5">
						<input type="text" id="nama_bangunan_di_lokasi" style="font-size: 13pt;" name="nama_bangunan_di_lokasi" class="form-control input-sm" >
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label"></label>
					<div class="col-lg-5">
						<button type="submit" class="btn btn-success btn-sm width30" >Tambah</button>
					</div>
				</div>
		</div>
	</div>
	</div>
</div>