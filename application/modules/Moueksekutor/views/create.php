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
						<select class="form-control select2" name="eksekutor" style="width: 100%;">
						<?php 
							foreach ($eksekutors->result() as $d) {
								echo "<option value=".$d->id_eksekutor.">".$d->nama_eksekutor."</option>";
							}
						?>
		                </select>
					</div>
				</div>
				<div class="form-group" >
					<label class="col-sm-3 control-label">Tanggal MoU</label>
					<div class="col-lg-5 input-group" style="padding-left: 15px; padding-right: 15px;">
	                <div class="input-group-addon "><i class="fa fa-calendar"></i></div>
	                 <input type="text" name="tgl_mou" class="form-control pull-right" id="datepickerMOU">
	                </div>
                </div>
				<div class="form-group" >
					<label class="col-sm-3 control-label">Nomor Proyek</label>
					<div class="col-lg-5">
						<input type="text" name="no_proyek" class="form-control input-sm" >
					</div>
				</div>
				<div class="form-group" >
					<label class="col-sm-3 control-label">Nama Proyek</label>
					<div class="col-lg-5">
						<input type="text" name="nama_proyek" class="form-control input-sm" >
					</div>
				</div>
				<div class="form-group" >
					<label class="col-sm-3 control-label">Alamat Proyek</label>
					<div class="col-lg-5">
						<textarea class="form-control" name="alamat_proyek" rows="3" placeholder=""></textarea>
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
						<select id="select_kotakab" class="form-control select2" name="kota" style="width: 100%;">
							<option>Please select</option>
		                </select>
					</div>
				</div>
				<div class="form-group" >
					<label class="col-sm-3 control-label">Jenis Proyek</label>
					<div class="col-lg-5">
						<select class="form-control select2" name="jenis_proyek" style="width: 100%;">
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
						<textarea class="form-control" rows="3" name="desc_proyek"></textarea>
					</div>
				</div>
				<div class="form-group" >
					<label class="col-sm-3 control-label">Nilai dalam Dirham</label>
					<div class="col-lg-5">
						<input type="text" id="nilai_dirham" style="font-size: 13pt;" name="dirham" class="form-control input-sm" onkeypress="return isNumberKey(event)">
					</div>
				</div>
				<div class="form-group" >
					<label class="col-sm-3 control-label">Nilai dalam Rupiah</label>
					<div class="col-lg-5">
						<input type="text" id="nilai_rupiah" style="font-size: 13pt;" name="rupiah" class="form-control input-sm" onkeypress="return isNumberKey(event)">
					</div>
				</div>
				<div class="form-group" >
					<label class="col-sm-3 control-label">Tanggal Pembangunan</label>
					<div class="col-lg-5 input-group" style="padding-left: 15px; padding-right: 15px;">
	                <div class="input-group-addon "><i class="fa fa-calendar"></i></div>
	                 <input type="text" name="tgl_pembangunan" class="form-control pull-right" id="datepickerPembangunan">
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