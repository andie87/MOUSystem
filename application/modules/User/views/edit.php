<div class="content-wrapper">
    <section class="content-header">
      <h1 style="padding-bottom: 15px;">
        Edit User 
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">User</a></li>
        <li class="active"><a href="#">Edit User</a></li>
      </ol>
    </section>
	
	<div class="padding-md">
	<div class="panel ">
		
		<?php if(isset($message)){ ?> 
	    	<div class="alert alert-danger">
	    		<label><strong><?php echo $message; ?></strong></label>
	    	</div>
    	<?php } ?>
		
		<div class="panel-heading">
		</div>
		<div class="panel-body">
			<?php echo form_open('user/prosesUpdate', array('class'=>'form-horizontal','method'=>'post', 'enctype'=>'multipart/form-data'));?>
				<div class="form-group">
					<label class="col-sm-2 control-label">Nama User</label>
					<div class="col-lg-5">
						<input type="text" name="nama_user" class="form-control input-sm" value="<?php echo $user['nama_user']; ?>" >
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">User Login</label>
					<div class="col-lg-5">
						<input type="text" name="user_login" class="form-control input-sm" value="<?php echo $user['user_login']; ?>">
						<input type="hidden" name="id_user" value="<?php echo $user['id_user']; ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Password</label>
					<div class="col-lg-5">
						<input type="text" name="password" class="form-control input-sm" placeholder="diisi jika ingin mengubah password">
					</div>
				</div>
				<div class="form-group">
					<label  class="col-md-2 control-label">Nomor Kontak</label>
					<div class="col-lg-5">
						<input type="text" name="no_kontak" class="form-control input-sm" value="<?php echo $user['no_kontak']; ?>">
					</div>
				</div>
				<div class="form-group">
					<label  class="col-md-2 control-label">Email</label>
					<div class="col-lg-5">
						<input type="email" name="email" class="form-control input-sm" value="<?php echo $user['email']; ?>">
					</div>
				</div>
				<div class="form-group" >
					<label class="col-md-2 control-label">Role</label>
					<div class="col-lg-5" id="div_role">
						<select id="select_role" class="form-control select2" name="id_role" style="width: 100%;">
							<option value="">Please select</option>
							<?php 
							foreach ($roles->result() as $p) {
								if($user['id_role'] == $p->id_role )
									echo "<option selected value=".$p->id_role.">".$p->nama_role."</option>";
								else
									echo "<option value=".$p->id_role.">".$p->nama_role."</option>";
							}
						?>
		                </select>
					</div>
				</div>
				<div class="form-group">
					<label  class="col-md-2 control-label">Foto</label>
					<div class="col-lg-5">
						<input type="file" name="foto" class="form-control input-sm" placeholder="Foto">
					</div>
				</div>
				<div class="form-group">
					<div class="col-lg-offset-2 col-lg-5">
						<button type="submit" class="btn btn-success btn-sm">Ubah</button>
					</div>
				</div>
		</div>
	</div>
	</div>
	
</div>