<div class="content-wrapper">
    <section class="content-header">
      <h1 style="padding-bottom: 15px;">
        Edit Role 
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Role</a></li>
        <li class="active"><a href="#">Edit Role</a></li>
      </ol>
    </section>

		<div class="padding-md">
		<div class="panel panel-default">
		
		<?php if(isset($message)){ ?> 
	    	<div class="alert alert-danger">
	    		<label><strong><?php echo $message; ?></strong></label>
	    	</div>
    	<?php } ?>
    	
		<div class="panel-body">
			<?php echo form_open('role/prosesUpdate', array('class'=>'form-horizontal','method'=>'post'));?>
				<div class="form-group" style="padding-top: 20px;">
					<label class="col-sm-2 control-label">Nama Role</label>
					<div class="col-lg-5">
						<input type="text" name="nama_role" value="<?php echo $role['nama_role']; ?>" class="form-control input-sm" >
						<input type="hidden" name="id_role" value="<?php echo $role['id_role']; ?>">
					</div>
				</div>
				<div class="form-group">
					<div class="col-lg-offset-2 col-lg-5">
						<button type="submit" class="btn btn-success btn-sm">Update</button>
					</div>
				</div>
		</div>
	</div>
	</div>
</div>