<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Proyek Management
        <small>data proyek</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="#">Proyek</a></li>
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
              <a class="btn btn-sm btn-success" href="<?php echo site_url('jenisproyek/create'); ?>"><i class="fa fa-plus fa-lg"></i> Tambah Proyek</a>
              <span class="label label-info pull-right"><?php echo $proyeks->num_rows();?>  Proyek</span>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                        <th style="text-align: center">No</th>
                        <th>Nama Jenis Proyek</th>
                        <th style="text-align: center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                     $i = 1;   
                     foreach ($proyeks->result() as $proyek) {
                    ?>
                    <tr>
                        <td class="width10 center-col"><?php echo $i; ?></td>
                        <td><?php echo $proyek->nama_proyek; ?></td>
                        <td class="width20 center-col">
                          <a href="<?php echo site_url('jenisproyek/edit/'.$proyek->id_jenis_proyek);?>"><i class="fa fa-pencil fa-lg"></i>edit</a>
                          &nbsp;&nbsp;&nbsp;&nbsp;
                          <a href="#" data-toggle="modal" data-nama="<?php echo $proyek->nama_proyek;?>" data-hapus="<?php echo $proyek->id_jenis_proyek;?>" data-target="#deleteModal"><i class="fa fa-trash-o fa-lg"></i>Delete</a>  
                        </td>
                    </tr>
                    <?php $i++; }?>
                </tbody>                
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
          </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
  <!-- /.content-wrapper -->

<div class="modal fade modal-warning" id="deleteModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Perhatian!</h4>
      </div>
      <div class="modal-body">
        <?php echo form_open('jenisproyek/delete', array('method'=>'post'));?>
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
