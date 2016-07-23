<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Eksekutor Management
        <small>edit eksekutor</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Eksekutor</a></li>
        <li class="active"><a href="#">Edit Eksekutor</a></li>
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

			<div class="panel-body">
				
				<?php	
					foreach ($eksekutor as $data) {
						$id = $data->id_eksekutor;
						$nama = $data->nama_eksekutor;
						$alamat = $data->alamat;
						$kontak = $data->no_kontak;
						$email = $data->email;
						$pic = $data->nama_pic;
					echo form_open('eksekutor/prosesEdit/'.$id, array('class'=>'form-horizontal','method'=>'post'));
				?>
					<div class="form-group">
						<label class="col-sm-2 control-label">Nama Eksekutor</label>
						<div class="col-lg-5">
							<input type="text" name="nama" class="form-control input-sm" value="<?php echo $nama;?>" placeholder="Nama Eksekutor">
						</div><!-- /.col -->
					</div><!-- /form-group -->
					<div class="form-group">
						<label  class="col-md-2 control-label">Alamat</label>
						<div class="col-lg-5">
							<textarea class="form-control" name="alamat" rows="3"><?php echo $alamat;?></textarea>
						</div><!-- /.col -->
					</div><!-- /form-group -->
					<div class="form-group">
						<label  class="col-md-2 control-label">No Kontak</label>
						<div class="col-lg-5">
							<input type="text" name="kontak" class="form-control input-sm" value="<?php echo $kontak;?>" placeholder="Kontak">
						</div><!-- /.col -->
					</div><!-- /form-group -->
					<div class="form-group">
						<label  class="col-md-2 control-label">Email</label>
						<div class="col-lg-5">
							<input type="email" name="email" class="form-control input-sm" value="<?php echo $email;?>" placeholder="Email">
						</div><!-- /.col -->
					</div><!-- /form-group -->
					<div class="form-group">
						<label class="col-md-2 control-label">Nama PIC</label>
						<div class="col-lg-5">
							<input type="text" name="pic" class="form-control input-sm" value="<?php echo $pic;?>" placeholder="Nama PIC">
						</div><!-- /.col -->
					</div><!-- /form-group -->
					<div class="form-group">
						<div class="col-lg-offset-2 col-lg-5">
							<button type="submit" class="btn btn-success btn-sm">Simpan</button>
						</div><!-- /.col -->
					</div><!-- /form-group -->	
				<?php } ?>		
			</div>
		</div>
	</div>
</div>