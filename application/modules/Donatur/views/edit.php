<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Donatur Management
        <small>edit donatur</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Donatur</a></li>
        <li class="active"><a href="#">Edit Donatur</a></li>
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
				echo form_open('donatur/prosesEdit/', array('class'=>'form-horizontal','method'=>'post'));
			?>
				<div class="form-group">
					<label class="col-sm-2 control-label">Nama Donatur</label>
					<div class="col-lg-5">
						<input type="hidden" name="id_eksekutor" value="<?php echo $donatur['id_donatur']; ?>">
						<input type="text" name="nama" class="form-control input-sm" value="<?php echo $donatur['nama_donatur']; ?>" placeholder="Nama Donatur">
					</div><!-- /.col -->
				</div><!-- /form-group -->
				<div class="form-group">
					<label class="col-sm-2 control-label">Negara Asal</label>
					<div class="col-lg-5">
						<input type="text" name="negara" class="form-control input-sm" value="<?php echo $donatur['asal_negara']; ?>"placeholder="Negara Asal">
					</div><!-- /.col -->
				</div><!-- /form-group -->
				<div class="form-group">
					<label  class="col-md-2 control-label">Alamat</label>
					<div class="col-lg-5">
						<textarea class="form-control" name="alamat" rows="3"><?php echo $donatur['alamat']; ?></textarea>
					</div><!-- /.col -->
				</div><!-- /form-group -->
				<div class="form-group">
					<label  class="col-md-2 control-label">No Kontak</label>
					<div class="col-lg-5">
						<input type="text" name="kontak" class="form-control input-sm" value="<?php echo $donatur['no_kontak']; ?>" placeholder="Kontak">
					</div><!-- /.col -->
				</div><!-- /form-group -->
				<div class="form-group">
					<label  class="col-md-2 control-label">Email</label>
					<div class="col-lg-5">
						<input type="email" name="email" class="form-control input-sm" value="<?php echo $donatur['email']; ?>" placeholder="Email">
					</div><!-- /.col -->
				</div><!-- /form-group -->
				<div class="form-group">
					<label class="col-md-2 control-label">Nama PIC</label>
					<div class="col-lg-5">
						<input type="text" name="pic" class="form-control input-sm" value="<?php echo $donatur['nama_pic']; ?>" placeholder="Nama PIC">
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