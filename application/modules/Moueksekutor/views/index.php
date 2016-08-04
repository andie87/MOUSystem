<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        List MoU Eksekutor
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="#">mou eksekutor</a></li>
      </ol>
    </section>
    
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
        
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
		    
          <div class="box box-danger">
    
            <div class="box-header">
              <a class="btn btn-sm btn-primary" href="<?php echo site_url('moueksekutor/create'); ?>"><i class="fa fa-plus fa-lg"></i> Tambah MoU Eksekutor</a>
              <span class="label label-info pull-right"><?php echo $moueksekutors->num_rows();?>  MoU</span>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover font13">
                <thead>
                	<tr>
                        <th class="width5 center-col">No</th>
                        <th>No Proyek</th>
                        <th>Nama Eksekutor</th>
                        <th>Jenis Proyek</th>
                        <th class="width10 center">Tanggal MoU</th>
                        <th class="width10 center">Tanggal Pengerjaan</th>
                        <th class="center-col width20">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                     $i = 1;   
                     foreach ($moueksekutors->result() as $md) {
                    ?>
                    <tr>
                        <td class="width5 center-col"><?php echo $i; ?></td>
                        <td><?php echo $md->nomor_proyek;?></td>
                        <td><?php echo $arr_eksekutor[$md->id_eksekutor]; ?></td>
                        <td><?php echo $arr_proyek[$md->id_jenis_proyek]; ?></td>
                        <td class="center"><?php echo getUserFormatDate($md->tanggal_mou); ?></td>
                        <td class="center"><?php echo getUserFormatDate($md->tanggal_pengerjaan); ?></td>
                        <td class="center-col">
                        	<a href="<?php echo site_url('moueksekutor/edit'); ?>/<?php echo $md->id_mou_eksekutor; ?>">
                        		<i class="fa fa-pencil fa-lg"></i>edit
                        	</a>
                        	&nbsp; 
                        	<a href="<?php echo site_url('moueksekutor/view'); ?>/<?php echo $md->id_mou_eksekutor; ?>">
                        		<i class="fa fa-edit fa-lg"></i>view
                        	</a>
                        	&nbsp;
                        	<a href="#" data-toggle="modal" data-nama="<?php echo $md->nama_proyek;?>" 
                        	data-hapus="<?php echo $md->id_mou_eksekutor;?>" data-target="#deleteModal">
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
        <?php echo form_open('moueksekutor/delete', array('method'=>'post'));?>
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