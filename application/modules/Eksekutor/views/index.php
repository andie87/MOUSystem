<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Eksekutor Management
        <small>data eksekutor</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="#">Eksekutor</a></li>
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
              <a class="btn btn-sm btn-success" href="<?php echo site_url('eksekutor/create'); ?>"><i class="fa fa-plus fa-lg"></i> Tambah Eksekutor</a>
              <span class="label label-info pull-right"><?php echo $eksekutors->num_rows();?>  Eksekutor</span>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                        <th>No</th>
                        <th>Nama Eksekutor</th>
                        <th>Alamat</th>
                        <th>No Kontak</th>
                        <th>Email</th>
                        <th>Nama PIC</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                     $i = 1;   
                     foreach ($eksekutors->result() as $eksekutor) {
                    ?>
                    <tr>
                        <td class="width10 center-col"><?php echo $i; ?></td>
                        <td><?php echo $eksekutor->nama_eksekutor; ?></td>
                        <td><?php echo $eksekutor->alamat; ?></td>
                        <td><?php echo $eksekutor->no_kontak; ?></td>
                        <td><?php echo $eksekutor->email; ?></td>
                        <td><?php echo $eksekutor->nama_pic; ?></td>
                        <td class="width20 center-col">
                          <a href="<?php echo site_url('eksekutor/edit/'.$eksekutor->id_eksekutor);?>"><i class="fa fa-pencil fa-lg"></i>edit</a>
                          &nbsp;&nbsp;&nbsp;&nbsp; 
                          <a href="<?php echo site_url('eksekutor/manage/'.$eksekutor->id_eksekutor);?>"><i class="fa fa-edit fa-lg"></i>manage</a>
                          &nbsp;&nbsp;&nbsp;&nbsp;
                          <a href="#" data-toggle="modal" data-nama="<?php echo $eksekutor->nama_eksekutor;?>" data-hapus="<?php echo $eksekutor->id_eksekutor;?>" data-target="#deleteModal"><i class="fa fa-trash-o fa-lg"></i>Delete</a>  
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
        <?php echo form_open('eksekutor/delete', array('method'=>'post'));?>
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
