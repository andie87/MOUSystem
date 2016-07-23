<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Role Management
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="#">Role</a></li>
      </ol>
    </section>
    
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
          
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
    
            <div class="box-header">
              <a class="btn btn-sm btn-success" href="<?php echo site_url('role/create'); ?>"><i class="fa fa-plus fa-lg"></i> Tambah Role</a>
              <span class="label label-info pull-right"><?php echo $roles->num_rows();?>  Role</span>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover width70">
                <thead>
                	<tr>
                        <th class="width10 center-col">No</th>
                        <th>Nama Role</th>
                        <th class="width40 center-col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                     $i = 1;   
                     foreach ($roles->result() as $role) {
                    ?>
                    <tr>
                        <td class="width10 center-col"><?php echo $i; ?></td>
                        <td><?php echo $role->nama_role; ?></td>
                        <td class="width40 center-col">
                        	<a href="<?php echo site_url('role/edit'); ?>/<?php echo $role->id_role; ?>"><i class="fa fa-pencil fa-lg"></i>edit</a>
                        	&nbsp;&nbsp;&nbsp;&nbsp; 
                        	<a href="<?php echo site_url('role/manage'); ?>/<?php echo $role->id_role; ?>"><i class="fa fa-edit fa-lg"></i>manage</a>
                        	&nbsp;&nbsp;&nbsp;&nbsp;
                        	<a href="#" data-toggle="modal" data-nama="<?php echo $role->nama_role;?>" 
                        	data-hapus="<?php echo $role->id_role;?>" data-target="#deleteModal">
                        		<i class="fa fa-trash-o fa-lg"></i>delete
                        	</a>    
                        </td>
                    </tr>
                    <?php $i++; }?>
                </tbody>
              </table>
            </div>
          </div>
          </div>
      </div>
    </section>
  </div>
  
<div class="modal fade modal-warning" id="deleteModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Perhatian!</h4>
      </div>
      <div class="modal-body">
        <?php echo form_open('role/delete', array('method'=>'post'));?>
        <p class="data-pesan">Anda yakin ingin menghapus</p>
        <input type="hidden" name="id" class="data-id">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline" data-dismiss="modal">Tidak</button>
        <button type="submit" class="btn btn-danger">Yakin!</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>