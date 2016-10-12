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
				<hr/>
				<?php foreach($modules->result() as $module){
					foreach($access->result() as $k){
						if($module->id_module == $k->id_module){?>
	      				<div class="form-group">
							<label class="col-sm-3 control-label"> <?php echo $module->module_name ?> </label>
							<!-- VALUE DARI CHECKBOX ADALAH ID_ROLE_RIGHTS-->
			                <div class="col-sm-1">
				                  <input type="checkbox" class="minimal" name="view[]" value="<?php echo $k->id_role_rights; ?>" <?php if($k->view){?> Checked <?php } ?>> View
				            </div>
			                <div class="col-sm-1">
				                  <input type="checkbox" class="minimal" name="create[]" value="<?php echo $k->id_role_rights; ?>" <?php if($k->create){?> Checked <?php } ?>> Create
				            </div>
			                <div class="col-sm-1">
				                  <input type="checkbox" class="minimal" name="edit[]" value="<?php echo $k->id_role_rights; ?>" <?php if($k->edit){?> Checked <?php } ?>> Update
				            </div>
				            <div class="col-sm-1">
				                  <input type="checkbox" class="minimal" name="delete[]" value="<?php echo $k->id_role_rights; ?>" <?php if($k->delete){?> Checked <?php } ?>> Delete
				            </div>
				            <?php if($module->module_page == 'moudonatur' OR $module->module_page == 'moueksekutor'){ ?>
				            <div class="col-sm-2">
				                  <input type="checkbox" class="minimal" name="view_minus_biaya[]" 
				                  value="<?php echo $k->id_role_rights; ?>" <?php if($k->view_minus_biaya){?> Checked <?php } ?>> View Minus Biaya
				            </div>
				            <?php } ?>
				        </div>
				<?php   
						}
					}
				}
				?>
				<div class="form-group" style="padding-top: 20px;">
					<label class="col-sm-3"></label>
					<div class="col-sm-1">
						<button type="submit" class="btn btn-success btn-sm" style="width: 100px;">Update</button>
					</div>
				</div>
		</div>
	</div>
	</div>
</div>