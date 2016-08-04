<div class="content-wrapper">
    <section class="content-header">
      <h1>
        Tambah Dokumen MOU Eksekutor Baru
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Dokumen</a></li>
        <li class="active"><a href="#">Tambah Dokumen MOU Eksekutor</a></li>
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
			<?php echo form_open_multipart('dokumen/DocMOUEks/prosesCreate', array('class'=>'form-horizontal','method'=>'post'));?>
				<div class="form-group">
					<label class="col-sm-2 control-label">No Proyek</label>
					<div class="col-lg-5">
						<select class="form-control input-sm" name="id_mou_eksekutor">
		                    <option>-- Pilih No Proyek --</option>
		                    <?php foreach ($mous->result() as $row) { ?>
		                    	<option value="<?php echo $row->id_mou_eksekutor;?>"><?php echo $row->nomor_proyek;?></option>
		                    <?php }?>
		                </select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Dokumen MOU Eksekutor</label>
					<div class="col-lg-5">
						<input type="file" name="file" class="form-control input-sm" placeholder="Dokumen MOU Eksekutor">
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