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
		
		<div style="padding-top: 15px; padding-left: 15px;">
	    	<a href="<?php echo site_url('moueksekutor/index'); ?>" >
				<button type="button" class="btn btn-warning btn-sm width15" ><strong>Back</strong></button>
			</a>
		</div>
    	
		<div class="panel-body">
			
			<?php echo form_open('moueksekutor/prosesCreate', array('class'=>'form-horizontal','method'=>'post'));?>
			<div class="form-group" style="padding-top: 20px;">
				<label class="col-sm-3 control-label">Eksekutor</label>
				<div class="col-lg-5">
					<select disabled class="form-control select2" name="id_eksekutor" style="width: 100%;">
					<?php 
						foreach ($eksekutors->result() as $d) {
							if($moueksekutor['id_eksekutor'] == $d->id_eksekutor){
								echo "<option selected value=".$d->id_eksekutor.">".$d->nama_eksekutor."</option>";
							}
							else{
								echo "<option value=".$d->id_eksekutor.">".$d->nama_eksekutor."</option>";	
							}
						}
					?>
	                </select>
				</div>
				
				<?php if(strpos($granted_access['dokumeneksekutor'], 'edit') !== false){ ?>
				<a href="<?php echo site_url('moueksekutor/dokumen'); ?>/<?php echo $id; ?>" >
					<button type="button" class="btn btn-primary btn-sm width30" >LIST DOKUMEN TERKAIT MOU</button>
				</a>
				<?php } else { ?>
				<a href="<?php echo site_url('moueksekutor/dokumenView'); ?>/<?php echo $id; ?>" >
					<button type="button" class="btn btn-primary btn-sm width30" >LIST DOKUMEN TERKAIT MOU</button>
				</a>
				<?php } ?>
					
			</div>
			<div class="form-group" >
				<label class="col-sm-3 control-label">Nomor Proyek MoU Donatur</label>
				<div class="col-lg-5">
					<select disabled class="form-control select2" name="id_mou_donatur" style="width: 100%;">
					<?php 
						foreach ($moudonatur->result() as $d) {
							if($moueksekutor['moudonatur_nomor_proyek'] == $d->nomor_proyek){
								echo "<option selected value=".$d->id_mou_donatur.">".$d->nomor_proyek."</option>";
							}
							else{
								echo "<option value=".$d->id_mou_donatur.">".$d->nomor_proyek."</option>";
							}
						}
					?>
	                </select>
				</div>
			</div>
			<div class="form-group" >
				<label class="col-sm-3 control-label">Tanggal MoU</label>
				<div class="col-lg-5 input-group" style="padding-left: 15px; padding-right: 15px;">
                <div class="input-group-addon "><i class="fa fa-calendar"></i></div>
                 <input type="text" disabled name="tanggal_mou" value="<?php echo $moueksekutor['tanggal_mou'];?>" class="form-control pull-right" id="datepickerMOU">
                </div>
            </div>
			<div class="form-group" >
				<label class="col-sm-3 control-label">Tanggal Hijriah</label>
				<div class="col-lg-5">
					<input type="text" disabled name="tanggal_mou_hijriah" value="<?php echo $moueksekutor['tanggal_mou_hijriah'];?>" class="form-control input-sm" >
				</div>
			</div>
			<div class="form-group" >
				<label class="col-sm-3 control-label">Tanggal Pengerjaan</label>
				<div class="col-lg-5 input-group" style="padding-left: 15px; padding-right: 15px;">
                <div class="input-group-addon "><i class="fa fa-calendar"></i></div>
                 <input type="text" disabled name="tanggal_pengerjaan" value="<?php echo $moueksekutor['tanggal_pengerjaan'];?>" class="form-control pull-right" id="datepickerPengerjaan">
                </div>
            </div>
			<div class="form-group" >
				<label class="col-sm-3 control-label">Nama Eksekutor</label>
				<div class="col-lg-5">
					<input type="text" disabled name="nama_eksekutor" value="<?php echo $moueksekutor['nama_eksekutor'];?>" class="form-control input-sm" >
				</div>
			</div>
			<div class="form-group" >
				<label class="col-sm-3 control-label">Alamat Eksekutor</label>
				<div class="col-lg-5">
					<textarea class="form-control" name="alamat_eksekutor" disabled rows="3" placeholder=""><?php echo $moueksekutor['alamat_eksekutor'];?></textarea>
				</div>
			</div>
			<div class="form-group" >
				<label class="col-sm-3 control-label">Jabatan Eksekutor</label>
				<div class="col-lg-5">
					<input type="text" name="jabatan_eksekutor" disabled value="<?php echo $moueksekutor['jabatan_eksekutor'];?>" class="form-control input-sm" >
				</div>
			</div>
			<div class="form-group" >
				<label class="col-sm-3 control-label">No HP Eksekutor</label>
				<div class="col-lg-5">
					<input type="text" name="kontak_eksekutor" disabled value="<?php echo $moueksekutor['kontak_eksekutor'];?>" class="form-control input-sm" >
				</div>
			</div>
			<div class="form-group" >
				<label class="col-sm-3 control-label">Nama Proyek</label>
				<div class="col-lg-5">
					<input type="text" name="nama_proyek" disabled value="<?php echo $moueksekutor['nama_proyek'];?>" class="form-control input-sm" >
				</div>
			</div>
			<div class="form-group" >
				<label class="col-sm-3 control-label">Jenis Proyek</label>
				<div class="col-lg-5">
					<select class="form-control select2" disabled name="id_jenis_proyek" style="width: 100%;">
					<?php 
						foreach ($proyeks->result() as $p) {
							if($moueksekutor['id_jenis_proyek'] == $d->id_jenis_proyek){
								echo "<option selected value=".$p->id_jenis_proyek.">".$p->nama_proyek."</option>";	
							}
							else{
								echo "<option value=".$p->id_jenis_proyek.">".$p->nama_proyek."</option>";
							}
						}
					?>
	                </select>
				</div>
			</div>
			<div class="form-group" >
				<label class="col-sm-3 control-label">Deskripsi Proyek</label>
				<div class="col-lg-5">
					<textarea class="form-control" rows="3" disabled name="deskripsi_proyek" ><?php echo $moueksekutor['deskripsi_proyek'];?></textarea>
				</div>
			</div>
			<div class="form-group" >
				<label class="col-sm-3 control-label">Ukuran</label>
				<div class="col-lg-5">
					<input type="text" id="ukuran" disabled style="font-size: 13pt;" name="ukuran" value="<?php echo $moueksekutor['ukuran'];?>" class="form-control input-sm" onkeypress="return isNumberKey(event)">
				</div>
			</div>
			<div class="form-group" >
				<label class="col-sm-3 control-label">Provinsi</label>
				<div class="col-lg-5">
					<select id="select_provinsi" disabled class="form-control select2" name="provinsi" style="width: 100%;" onChange="changeKotaKab(this.val);">
					<option>Please select</option>
					<?php 
						foreach ($provins->result() as $p) {
							if($moueksekutor['id_provinsi'] == $p->id_provinsi){
								echo "<option selected value=".$p->id_provinsi.">".$p->nama_provinsi."</option>";
							}
							else{
								echo "<option value=".$p->id_provinsi.">".$p->nama_provinsi."</option>";
							}
						}
					?>
	                </select>
				</div>
			</div>
			<div class="form-group" >
				<label class="col-sm-3 control-label">Kota/Kabupaten</label>
				<div class="col-lg-5" id="div_kota_kab">
					<select id="select_kotakab" disabled class="form-control select2" name="kota" style="width: 100%;">
						<option>Please select</option>
						<?php 
							foreach ($kotas->result() as $k) {
								if($moueksekutor['id_kota_kab'] == $k->id_kota_kab){
									echo "<option selected value=".$k->id_kota_kab.">".$k->nama_kota_kab."</option>";
								} else {
									echo "<option value=".$k->id_kota_kab.">".$k->nama_kota_kab."</option>";
								}
							}
						?>
	                </select>
				</div>
			</div>

			<div class="form-group" >
					<label class="col-sm-3 control-label">Kecamatan</label>
					<div class="col-lg-5" id="div_kecamatan">
						<select disabled id="select_kecamatan" class="form-control select2 font-black" name="kecamatan" style="width: 100%;">
							<option>Please select</option>
							<?php 
								foreach ($kecamatan->result() as $k) {
									if($moueksekutor['id_kecamatan'] == $k->id_kecamatan){
										echo "<option selected value=".$k->id_kecamatan.">".$k->nama_kecamatan."</option>";
									} else {
										echo "<option value=".$k->id_kecamatan.">".$k->nama_kecamatan."</option>";
									}
								}
							?>
		                </select>
					</div>
				</div>
				
			<div class="form-group" >
				<label class="col-sm-3 control-label">Alamat Lokasi</label>
				<div class="col-lg-5">
					<textarea class="form-control" disabled name="alamat_lokasi" rows="3" placeholder=""><?php echo $moueksekutor['alamat_lokasi'];?></textarea>
				</div>
			</div>
			<div class="form-group" >
				<label class="col-sm-3 control-label">Koordinat Lokasi</label>
				<div class="col-lg-5">
					<input type="text" disabled id="koordinat_lokasi" style="font-size: 13pt;" name="koordinat_lokasi" value="<?php echo $moueksekutor['koordinat_lokasi'];?>" class="form-control input-sm" >
				</div>
			</div>
			<div class="form-group" >
				<label class="col-sm-3 control-label">Nilai Proyek</label>
				<div class="col-lg-5">
					<input type="text" disabled id="nilai_rupiah" style="font-size: 13pt;" name="nilai_proyek" value="<?php echo $moueksekutor['nilai_proyek'];?>" class="form-control input-sm" onkeypress="return isNumberKey(event)">
				</div>
			</div>
			<div class="form-group" >
				<label class="col-sm-3 control-label">Tanggal Selesai</label>
				<div class="col-lg-5 input-group" style="padding-left: 15px; padding-right: 15px;">
                <div class="input-group-addon "><i class="fa fa-calendar"></i></div>
                 <input type="text" disabled name="tanggal_selesai" value="<?php echo $moueksekutor['tanggal_selesai'];?>" class="form-control pull-right" id="datepickerSelesai">
                 </div>
            </div>
            <div class="form-group" >
				<label class="col-sm-3 control-label">Pakai Banner</label>
				<div class="col-lg-5">
					<select disabled name="is_banner" class="form-control select2">
						<option <?php if($moueksekutor['is_banner'] == "1") {?> selected <?php }?> value="1">Ya</option>
						<option <?php if($moueksekutor['is_banner'] == "0") {?> selected <?php }?>value="0">Tidak</option>
					</select>
				</div>
			</div>
			<div class="form-group" >
				<label class="col-sm-3 control-label">Pakai Prasasti</label>
				<div class="col-lg-5">
					<select disabled name="is_prasasti" class="form-control select2">
						<option <?php if($moueksekutor['is_prasasti'] == "1") {?> selected <?php }?> value="1">Ya</option>
						<option <?php if($moueksekutor['is_prasasti'] == "0") {?> selected <?php }?>value="0">Tidak</option>
					</select>
				</div>
			</div>
			<div class="form-group" >
				<label class="col-sm-3 control-label">PIC Lokasi</label>
				<div class="col-lg-5">
					<input disabled type="text" style="font-size: 13pt;" name="pic_lokasi" value="<?php echo $moueksekutor['pic_lokasi'];?>" class="form-control input-sm" >
				</div>
			</div>
			<div class="form-group" >
				<label class="col-sm-3 control-label">No HP PIC Lokasi</label>
				<div class="col-lg-5">
					<input disabled type="text" style="font-size: 13pt;" name="kontak_pic_lokasi" value="<?php echo $moueksekutor['kontak_pic_lokasi'];?>" class="form-control input-sm" >
				</div>
			</div>
			<div class="form-group" >
				<label class="col-sm-3 control-label">Alamat PIC Lokasi</label>
				<div class="col-lg-5">
					<textarea disabled class="form-control" name="alamat_pic_lokasi" rows="3" placeholder=""><?php echo $moueksekutor['alamat_pic_lokasi'];?></textarea>
				</div>
			</div>
			<div class="form-group" >
				<label class="col-sm-3 control-label">Nama Bangunan di Lokasi</label>
				<div class="col-lg-5">
					<input disabled type="text" id="nama_bangunan_di_lokasi" value="<?php echo $moueksekutor['nama_bangunan_di_lokasi'];?>" style="font-size: 13pt;" name="nama_bangunan_di_lokasi" class="form-control input-sm" >
				</div>
			</div>
			
		</div>
	</div>
	</div>
</div>