<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      	Edit Jenis Proyek
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Jenis Proyek</a></li>
        <li class="active"><a href="#">Edit Jenis Proyek</a></li>
      </ol>
    </section>

	<div class="padding-md">
		<div class="panel panel-default">
			<?php 
				if(validation_errors()!=null){
			?>
			<div class="panel-heading">				
				<div class="alert alert-warning" role="alert">
		          <button type="button" class="close" data-dismiss="alert">x</button>
		          <h4>Peringatan</h4>
		          <?php echo validation_errors();?>
		        </div>
			</div>
			<?php } ?>

			<?php if(isset($message)){ ?> 
		    	<div class="alert alert-danger">
		    		<label><strong><?php echo $message; ?></strong></label>
		    	</div>
	    	<?php } ?>

			<div class="panel-body">
				
				<?php	
					echo form_open('jenisproyek/prosesEdit/', array('class'=>'form-horizontal','method'=>'post'));
				?>
					<div class="form-group">
						<label class="col-sm-2 control-label">Nama Proyek</label>
						<div class="col-lg-5">
							<input type="hidden" name="id_jenis_proyek" value="<?php echo $proyek['id_jenis_proyek']; ?>">
							<input type="text" name="nama_proyek" class="form-control input-sm" value="<?php echo $proyek['nama_proyek']; ?>" placeholder="Nama Jenis Proyek">
						</div><!-- /.col -->
					</div><!-- /form-group -->
					<div class="form-group">
						<div class="col-lg-offset-2 col-lg-5">
							<button type="submit" class="btn btn-success btn-sm">Simpan</button>
						</div><!-- /.col -->
					</div><!-- /form-group -->	
			</div>
		</div>
	</div>
</div>