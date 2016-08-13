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
        Form Edit MoU Donatur
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">MoU Donatur</a></li>
        <li class="active"><a href="#">Edit MoU</a></li>
      </ol>
    </section>

		<div class="padding-md">
		<div class="panel panel-default">
		
		<?php if(isset($message)){ ?> 
	    	<div class="alert alert-danger">
	    		<label><strong><?php echo $message; ?></strong></label>
	    	</div>
    	<?php } ?>
    	
    	<div style="padding-top: 15px; padding-left: 15px;">
	    	<a href="<?php echo site_url('moudonatur/index'); ?>" >
				<button type="button" class="btn btn-warning btn-sm width15" ><strong>Back</strong></button>
			</a>
		</div>
    	
		<div class="panel-body" >
			<?php echo form_open('moudonatur/prosesUpdate', array('class'=>'form-horizontal','method'=>'post'));?>
				<div class="form-group" style="padding-top: 20px;">
					<label class="col-sm-3 control-label">Donatur</label>
					<div class="col-lg-5">
						<select class="form-control select2" name="donatur" style="width: 100%;">
						<?php 
							foreach ($donaturs->result() as $d) {
								if($moudonatur['id_donatur'] == $d->id_donatur){
									echo "<option selected value=".$d->id_donatur.">".$d->nama_donatur."</option>";
								} else {
									echo "<option value=".$d->id_donatur.">".$d->nama_donatur."</option>";	
								}
							}
						?>
		                </select>
							
		                <input type="hidden" name="mou_donatur" value="<?php echo $moudonatur['id_mou_donatur']; ?>" />
					</div>
					
					<a href="<?php echo site_url('moudonatur/dokumen'); ?>/<?php echo $id; ?>" >
						<button type="button" class="btn btn-primary btn-sm width30" >LIST DOKUMEN TERKAIT MOU</button>
					</a>
				
				</div>
				<div class="form-group" >
					<label class="col-sm-3 control-label">Nomor Proyek</label>
					<div class="col-lg-5">
						<input type="text" name="no_proyek" value="<?php echo $moudonatur['nomor_proyek']; ?>" class="form-control pull-right" >
					</div>
					
					<a href="<?php echo site_url('moudonatur/pembayaran'); ?>/<?php echo $id; ?>" >
						<button type="button" class="btn btn-primary btn-sm width30" >LIST PEMBAYARAN DONATUR</button>
					</a>
					
				</div>
				<div class="form-group" >
					<label class="col-sm-3 control-label">Tanggal MoU</label>
					<div class="col-lg-5 input-group" style="padding-left: 15px; padding-right: 15px;">
	                <div class="input-group-addon "><i class="fa fa-calendar"></i></div>
	                 <input type="text" name="tgl_mou" value="<?php echo $moudonatur['tanggal_mou']; ?>" 
	                 		class="form-control pull-right" id="datepickerMOU">
	                </div>
                </div>
				<div class="form-group" >
					<label class="col-sm-3 control-label">Nama Proyek</label>
					<div class="col-lg-5">
						<input type="text" name="nama_proyek" value="<?php echo $moudonatur['nama_proyek']; ?>" class="form-control pull-right" >
					</div>
				</div>
				<div class="form-group" >
					<label class="col-sm-3 control-label">Alamat Proyek</label>
					<div class="col-lg-5">
						<textarea class="form-control" name="alamat_proyek" rows="3" ><?php echo $moudonatur['alamat_proyek']; ?></textarea>
					</div>
				</div>
				<div class="form-group" >
					<label class="col-sm-3 control-label">Provinsi</label>
					<div class="col-lg-5">
						<select id="select_provinsi" class="form-control select2" name="provinsi" style="width: 100%;" onChange="changeKotaKab(this.val);">
						<option>Please select</option>
						<?php 
							foreach ($provins->result() as $p) {
								if($moudonatur['id_provinsi'] == $p->id_provinsi){
									echo "<option selected value=".$p->id_provinsi.">".$p->nama_provinsi."</option>";
								} else {
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
						<select id="select_kotakab" class="form-control select2" name="kota" style="width: 100%;">
							<option>Please select</option>
							<?php 
								foreach ($kotas->result() as $k) {
									if($moudonatur['id_kota_kab'] == $k->id_kota_kab){
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
					<label class="col-sm-3 control-label">Jenis Proyek</label>
					<div class="col-lg-5">
						<select class="form-control select2" name="jenis_proyek" style="width: 100%;">
						<?php 
							foreach ($proyeks->result() as $p) {
								if($moudonatur['id_jenis_proyek'] == $p->id_jenis_proyek){
									echo "<option selected value=".$p->id_jenis_proyek.">".$p->nama_proyek."</option>";
								} else {
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
						<textarea class="form-control" rows="3" name="desc_proyek"><?php echo $moudonatur['deskripsi_proyek']; ?></textarea>
					</div>
				</div>
				<div class="form-group" >
					<label class="col-sm-3 control-label">Nilai dalam Dirham</label>
					<div class="col-lg-5">
						<input type="text" id="nilai_dirham" style="font-size: 13pt;" name="dirham" class="form-control pull-right" 
						 value="<?php echo $moudonatur['harga_dirham']; ?>" onkeypress="return isNumberKey(event)">
					</div>
				</div>
				<div class="form-group" >
					<label class="col-sm-3 control-label">Nilai dalam Rupiah</label>
					<div class="col-lg-5">
						<input type="text" id="nilai_rupiah" style="font-size: 13pt;" name="rupiah" class="form-control pull-right" 
						 value="<?php echo $moudonatur['harga_rupiah']; ?>" onkeypress="return isNumberKey(event)">
					</div>
				</div>
				<div class="form-group" >
					<label class="col-sm-3 control-label">Tanggal Pembangunan</label>
					<div class="col-lg-5 input-group" style="padding-left: 15px; padding-right: 15px;">
	                <div class="input-group-addon "><i class="fa fa-calendar"></i></div>
	                 <input type="text" name="tgl_pembangunan" class="form-control pull-right" 
	                  value="<?php echo $moudonatur['tanggal_pembangunan']; ?>" id="datepickerPembangunan">
	                 </div>
                </div>
                <div class="form-group" >
					<label class="col-sm-3 control-label">Progress (dalam persen)</label>
					<div class="col-lg-5">
						<input type="text" id="progress" style="font-size: 13pt;" name="progress" class="form-control pull-right" 
						 value="<?php echo $moudonatur['progress']; ?>" onkeypress="return isNumberKey(event)"><br />
					</div>
				</div>
				
				<div class="form-group" >
					<label class="col-sm-3 control-label" style="margin-right: 15px;"></label>
					<div class="progress active" style="width: 39%; border: 1px solid #aaa">
                		<div class="progress-bar progress-bar-success progress-bar-striped" 
                			role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $moudonatur['progress']; ?>%">
                		</div>
              		</div>    
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label"></label>
					<div class="col-lg-5">
						<button type="submit" class="btn btn-success btn-sm width30" >Update</button>
					</div>
				</div>
		</div>
	</div>
	</div>
</div>