<div class="content-wrapper">
    <section class="content-header">
      <h1>
        Tambah Kota Baru
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Kota</a></li>
        <li class="active"><a href="#">Tambah Kota</a></li>
      </ol>
    </section>

	<div class="padding-md">
	<div class="panel panel-default">
		<div class="panel-heading">
		</div>
		<div class="panel-body">
			<?php echo form_open('kota/prosesCreate', array('class'=>'form-horizontal','method'=>'post'));?>
				<div class="form-group">
					<label class="col-sm-2 control-label">Nama Provinsi</label>
					<div class="col-lg-5">
						<select class="form-control input-sm" name="id_provinsi">
		                    <option value="0">-- Pilih Provinsi --</option>
		                    <?php foreach ($provinces->result() as $row) { ?>
		                    	<option value="<?php echo $row->id_provinsi;?>"><?php echo $row->nama_provinsi;?></option>
		                    <?php }?>
		                </select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Nama Kota / Kabupaten</label>
					<div class="col-lg-5">
						<input type="text" name="nama_kota" class="form-control input-sm" placeholder="Nama Kota / Kabupaten">
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