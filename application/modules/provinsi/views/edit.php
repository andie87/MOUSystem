<div class="content-wrapper">
    <section class="content-header">
      <h1 style="padding-bottom: 15px;">
        Edit Provinsi 
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Wilayah</a></li>
        <li class="active"><a href="#">Edit Provinsi</a></li>
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
			<?php echo form_open('provinsi/prosesUpdate', array('class'=>'form-horizontal','method'=>'post'));?>
				<div class="form-group">
					<label class="col-sm-2 control-label">Nama Provinsi</label>
					<div class="col-lg-5">
						<input type="hidden" name="id_provinsi" value="<?php echo $provinsi['id_provinsi']; ?>">
						<input type="text" name="nama_provinsi" class="form-control input-sm" value="<?php echo $provinsi['nama_provinsi']; ?>" >
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