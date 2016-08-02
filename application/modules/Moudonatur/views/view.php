
<div class="content-wrapper">
    <section class="content-header">
      <h1 style="padding-bottom: 15px;">
        Form View MoU Donatur
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">MoU Donatur</a></li>
        <li class="active"><a href="#">View MoU</a></li>
      </ol>
    </section>

		<div class="padding-md">
		<div class="panel panel-default">

		<div class="panel-body">
			<?php echo form_open('moudonatur/index', array('class'=>'form-horizontal','method'=>'post'));?>
				<div class="form-group" style="padding-top: 20px;">
					<label class="col-sm-3 control-label">Donatur</label>
					<div class="col-lg-5">
						<select disabled class="form-control select2 font-black" name="donatur" style="width: 100%;">
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
					</div>
				</div>
				<div class="form-group" >
					<label class="col-sm-3 control-label">Tanggal MoU</label>
					<div class="col-lg-5 input-group" style="padding-left: 15px; padding-right: 15px;">
	                <div style="background-color: #eee;" class="input-group-addon "><i class="fa fa-calendar"></i></div>
	                 <input type="text" name="tgl_mou" value="<?php echo $moudonatur['tanggal_mou']; ?>" disabled
	                 		class="form-control pull-right font-black" id="datepickerMOU">
	                </div>
                </div>
				<div class="form-group" >
					<label class="col-sm-3 control-label">Nomor Proyek</label>
					<div class="col-lg-5">
						<input disabled type="text" name="no_proyek" value="<?php echo $moudonatur['nomor_proyek']; ?>" class="form-control pull-right font-black" >
					</div>
				</div>
				<div class="form-group" >
					<label class="col-sm-3 control-label">Nama Proyek</label>
					<div class="col-lg-5">
						<input disabled type="text" name="nama_proyek" value="<?php echo $moudonatur['nama_proyek']; ?>" class="form-control pull-right font-black" >
					</div>
				</div>
				<div class="form-group" >
					<label class="col-sm-3 control-label">Alamat Proyek</label>
					<div class="col-lg-5">
						<textarea disabled class="form-control font-black" name="alamat_proyek" rows="3" ><?php echo $moudonatur['alamat_proyek']; ?></textarea>
					</div>
				</div>
				<div class="form-group" >
					<label class="col-sm-3 control-label">Provinsi</label>
					<div class="col-lg-5">
						<select disabled id="select_provinsi" class="form-control select2 font-black" name="provinsi" style="width: 100%;" >
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
						<select disabled id="select_kotakab" class="form-control select2 font-black" name="kota" style="width: 100%;">
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
						<select disabled class="form-control select2 font-black" name="jenis_proyek" style="width: 100%;">
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
						<textarea disabled class="form-control font-black" rows="3" name="desc_proyek"><?php echo $moudonatur['deskripsi_proyek']; ?></textarea>
					</div>
				</div>
				<div class="form-group" >
					<label class="col-sm-3 control-label">Nilai dalam Dirham</label>
					<div class="col-lg-5">
						<input disabled type="text" id="nilai_dirham" style="font-size: 13pt;" name="dirham" class="form-control pull-right font-black" 
						 value="<?php echo $moudonatur['harga_dirham']; ?>" onkeypress="return isNumberKey(event)">
					</div>
				</div>
				<div class="form-group" >
					<label class="col-sm-3 control-label">Nilai dalam Rupiah</label>
					<div class="col-lg-5">
						<input disabled type="text" id="nilai_rupiah" style="font-size: 13pt;" name="rupiah" class="form-control pull-right font-black" 
						 value="<?php echo $moudonatur['harga_rupiah']; ?>" onkeypress="return isNumberKey(event)">
					</div>
				</div>
				<div class="form-group" >
					<label class="col-sm-3 control-label">Tanggal Pembangunan</label>
					<div class="col-lg-5 input-group" style="padding-left: 15px; padding-right: 15px;">
	                <div style="background-color: #eee;" class="input-group-addon "><i class="fa fa-calendar"></i></div>
	                 <input disabled type="text" name="tgl_pembangunan" class="form-control pull-right font-black" 
	                  value="<?php echo $moudonatur['tanggal_pembangunan']; ?>" id="datepickerPembangunan">
	                 </div>
                </div>
                <div class="form-group" >
					<label class="col-sm-3 control-label">Progress (dalam persen)</label>
					<div class="col-lg-5">
						<input disabled type="text" id="progress" style="font-size: 13pt;" name="progress" class="form-control pull-right font-black" 
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
						<button type="submit" class="btn btn-success btn-sm width30" >Back</button>
					</div>
				</div>
		</div>
	</div>
	</div>
</div>