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
                        <td><?php echo $i; ?></td>
                        <td><?php echo $eksekutor->nama_eksekutor; ?></td>
                        <td><?php echo $eksekutor->alamat; ?></td>
                        <td><?php echo $eksekutor->no_kontak; ?></td>
                        <td><?php echo $eksekutor->email; ?></td>
                        <td><?php echo $eksekutor->nama_pic; ?></td>
                        <td>
                            <a href="<?php echo site_url('eksekutor/edit/'.$eksekutor->id_eksekutor);?>"><i class="fa fa-edit fa-lg"></i></a>
                            <a href="#" data-toggle="modal" data-nama="<?php echo $eksekutor->nama_eksekutor;?>" data-hapus="<?php echo $eksekutor->id_eksekutor;?>" data-target="#deleteModal"><i class="fa fa-trash-o fa-lg"></i></a>    
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
        <?php echo form_open('eksekutor/prosesDelete', array('method'=>'post'));?>
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
