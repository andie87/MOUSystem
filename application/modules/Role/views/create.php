<div class="content-wrapper">
    <section class="content-header">
      <h1>
        Tambah Role Baru
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Role</a></li>
        <li class="active"><a href="#">Tambah Role</a></li>
      </ol>
    </section>

		<div class="padding-md">
		<div class="panel panel-default">
		
		<?php if(isset($message)){ ?> 
	    	<div class="alert alert-danger">
	    		<label><strong><?php echo $message; ?></strong></label>
	    	</div>
    	<?php } ?>
    	
		<div class="box box-success">            
            <div class="box-body">
            	<?php echo form_open('role/prosesCreate', array('class'=>'form-horizontal','method'=>'post'));?>
				<div class="form-group" style="padding-top: 20px;">
					<label class="col-sm-2 control-label">Nama Role</label>
					<div class="col-lg-5">
						<input type="text" name="nama" class="form-control input-sm" >
					</div>
				</div>
					<div class="col-lg-offset-2 col-lg-5">
						<button type="submit" class="btn btn-success btn-sm">Tambah</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
</div>