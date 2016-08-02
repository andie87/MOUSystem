<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tambah Jenis Proyek Baru
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Jenis Proyek</a></li>
        <li class="active"><a href="#">Tambah proyek</a></li>
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
          <div class="callout callout-success">
            <label><strong><?php echo $message; ?></strong></label>
          </div>
        <?php } ?>
        
        <?php if(isset($message_failed)){ ?> 
          <div class="alert alert-danger">
            <label><strong><?php echo $message_failed; ?></strong></label>
          </div>
        <?php } ?>
		<div class="panel-body">
			<?php echo form_open('jenisproyek/prosesCreate', array('class'=>'form-horizontal','method'=>'post'));?>
				<div class="form-group">
					<label class="col-sm-2 control-label">Nama Proyek</label>
					<div class="col-lg-5">
						<input type="text" name="nama_proyek" class="form-control input-sm" placeholder="Nama Proyek">
					</div><!-- /.col -->
				</div><!-- /form-group -->
				<div class="form-group">
					<div class="col-lg-offset-2 col-lg-5">
						<button type="submit" class="btn btn-success btn-sm">Tambah</button>
					</div><!-- /.col -->
				</div><!-- /form-group -->			
		</div>
	</div>
	</div>
</div>