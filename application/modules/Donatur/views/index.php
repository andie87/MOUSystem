<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Donatur Management
        <small>data donatur</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="#">Donatur</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <a class="btn btn-sm btn-success" href="<?php echo site_url('donatur/create'); ?>"><i class="fa fa-plus fa-lg"></i> Tambah Donatur</a>
              <span class="label label-info pull-right"><?php echo $donaturs->num_rows();?>  Donatur</span>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                        <th>No</th>
                        <th>Nama Donatur</th>
                        <th>Negara Asal</th>
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
                     foreach ($donaturs->result() as $donatur) {
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $donatur->nama_donatur; ?></td>
                        <td><?php echo $donatur->asal_negara; ?></td>
                        <td><?php echo $donatur->alamat; ?></td>
                        <td><?php echo $donatur->no_kontak; ?></td>
                        <td><?php echo $donatur->email; ?></td>
                        <td><?php echo $donatur->nama_pic; ?></td>
                        <td>
                            <a href="<?php echo site_url('donatur/edit/'.$donatur->id_donatur);?>"><i class="fa fa-edit fa-lg"></i></a>
                            <a href="#" data-toggle="modal" data-nama="<?php echo $donatur->nama_donatur;?>" data-hapus="<?php echo $donatur->id_donatur;?>" data-target="#deleteModal"><i class="fa fa-trash-o fa-lg"></i></a>    
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
        <?php echo form_open('donatur/prosesDelete', array('method'=>'post'));?>
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
