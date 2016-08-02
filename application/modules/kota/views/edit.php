<div class="content-wrapper">
    <section class="content-header">
      <h1 style="padding-bottom: 15px;">
        Edit Kota / Kabupaten 
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Wilayah</a></li>
        <li class="active"><a href="#">Edit Kota / Kabupaten</a></li>
      </ol>
    </section>
	
	<div class="padding-md">
	<div class="panel ">
		
		<?php if(isset($message)){ ?> 
	    	<div class="alert alert-danger">
	    		<label><strong><?php echo $message; ?></strong></label>
	    	</div>
    	<?php } ?>
		
		<div class="panel-heading">
		</div>
		<div class="panel-body">
			<?php echo form_open('kota/prosesUpdate', array('class'=>'form-horizontal','method'=>'post'));?>
				<div class="form-group">
					<label class="col-sm-2 control-label">Nama Provinsi</label>
					<div class="col-lg-5">
						<select class="form-control input-sm" name="id_provinsi">
		                    <option value="0">-- Pilih Provinsi --</option>
		                    <?php foreach ($provinces->result() as $row) { ?>
		                    	<option value="<?php echo $row->id_provinsi;?>" <?php if($row->id_provinsi == $kota['id_provinsi']){?> selected="selected"<?php } ?>><?php echo $row->nama_provinsi?></option>
		                    <?php }?>
		                </select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Nama Kota / Kabupaten</label>
					<div class="col-lg-5">
						<input type="hidden" name="id_kota_kab" value="<?php echo $kota['id_kota_kab']; ?>">
						<input type="text" name="nama_kota_kab" class="form-control input-sm" value="<?php echo $kota['nama_kota_kab']; ?>" >
					</div>
				</div>
				<div class="form-group">
					<div class="col-lg-offset-2 col-lg-5">
						<button type="submit" class="btn btn-success btn-sm">Simpan</button>
					</div>
				</div>
		</div>
	</div>
	</div>
	
</div>