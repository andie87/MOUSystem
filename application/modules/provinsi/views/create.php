<div class="content-wrapper">
    <section class="content-header">
      <h1>
        Tambah Provinsi Baru
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Wilayah</a></li>
        <li class="active"><a href="#">Tambah Provinsi</a></li>
      </ol>
    </section>

	<div class="padding-md">
	<div class="panel panel-default">
		<div class="panel-heading">
		</div>
		<div class="panel-body">
			<?php echo form_open('provinsi/prosesCreate', array('class'=>'form-horizontal','method'=>'post'));?>
				<div class="form-group">
					<label class="col-sm-2 control-label">Nama Provinsi</label>
					<div class="col-lg-5">
						<input type="text" name="nama_provinsi" class="form-control input-sm" placeholder="Nama Provinsi">
					</div>
				</div>
				<div class="form-group">
					<div class="col-lg-offset-2 col-lg-5">
						<button type="submit" class="btn btn-success btn-sm">Tambah</button>
					</div>
				</div>
		</div>
	</div>
	</div>
</div>