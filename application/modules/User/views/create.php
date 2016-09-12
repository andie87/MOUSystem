<div class="content-wrapper">
    <section class="content-header">
      <h1>
        Tambah User Baru
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">User</a></li>
        <li class="active"><a href="#">Tambah User</a></li>
      </ol>
    </section>

	<div class="padding-md">
	<div class="panel panel-default">
		<div class="panel-heading">
		</div>
		<?php if(isset($message)){ ?> 
	    	<div class="alert alert-danger">
	    		<label><strong><?php echo $message; ?></strong></label>
	    	</div>
    	<?php } ?>
		<div class="panel-body">
			<?php echo form_open('user/prosesCreate', array('class'=>'form-horizontal','method'=>'post'));?>
				<div class="form-group">
					<label class="col-sm-2 control-label">Nama User</label>
					<div class="col-lg-5">
						<input type="text" name="nama_user" class="form-control input-sm" placeholder="Nama User">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">User Login</label>
					<div class="col-lg-5">
						<input type="text" name="user_login" class="form-control input-sm" placeholder="User Login">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Password</label>
					<div class="col-lg-5">
						<input type="text" name="password" class="form-control input-sm" placeholder="Password">
					</div>
				</div>
				<div class="form-group">
					<label  class="col-md-2 control-label">Nomor Kontak</label>
					<div class="col-lg-5">
						<input type="text" name="nomor_kontak" class="form-control input-sm" placeholder="Nomor Kontak">
					</div>
				</div>
				<div class="form-group">
					<label  class="col-md-2 control-label">Email</label>
					<div class="col-lg-5">
						<input type="email" name="email" class="form-control input-sm" placeholder="Email">
					</div>
				</div>
				<div class="form-group" >
					<label class="col-md-2 control-label">Role</label>
					<div class="col-lg-5" id="div_role">
						<select id="select_role" class="form-control select2" name="id_role" style="width: 100%;">
							<option value="">Please select</option>
							<?php 
							foreach ($roles->result() as $p) {
								echo "<option value=".$p->id_role.">".$p->nama_role."</option>";
							}
						?>
		                </select>
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