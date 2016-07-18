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
			<div class="panel-heading">
				<!-- Form Edit Donatur -->
			</div>
			<div class="panel-body">
				<?php 
					foreach ($donatur as $data) {
						$id = $data->id_donatur;
						$nama = $data->nama_donatur;
						$negara = $data->asal_negara;
						$alamat = $data->alamat;
						$kontak = $data->no_kontak;
						$email = $data->email;
						$pic = $data->nama_pic;
					echo form_open('donatur/prosesEdit/'.$id, array('class'=>'form-horizontal','method'=>'post'));
				?>
					<div class="form-group">
						<label class="col-sm-2 control-label">Nama Donatur</label>
						<div class="col-lg-5">
							<input type="text" name="nama" class="form-control input-sm" value="<?php echo $nama;?>" placeholder="Nama Donatur">
						</div><!-- /.col -->
					</div><!-- /form-group -->
					<div class="form-group">
						<label class="col-sm-2 control-label">Negara Asal</label>
						<div class="col-lg-5">
							<input type="text" name="negara" class="form-control input-sm" value="<?php echo $negara;?>"placeholder="Negara Asal">
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