<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dokumen MOU Eksekutor
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="#">Dokumen MOU Eksekutor</a></li>
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
              <a class="btn btn-sm btn-success" href="<?php echo site_url('dokumen/DocMOUEks/create'); ?>"><i class="fa fa-plus fa-lg"></i> Tambah Dokumen MOU Eksekutor</a>
              <span class="label label-info pull-right"><?php echo $Docs->num_rows();?>  Dokumen MOU Eksekutor</span>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                        <th>No</th>
                        <th>No Proyek</th>
                        <th>Nama File</th>
                        <th>Download</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                     $i = 1;   
                     foreach ($Docs->result() as $doc) {
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $doc->nomor_proyek; ?></td>
                        <td><?php echo $doc->nama_file; ?></td>
                        <td>
                          <a href="<?php echo site_url('dokumen/DocMOUEks/download/'.$doc->id_dokumen_mou_eksekutor);?>"><i class="fa fa-download fa-lg"></i>Download</a>
                        </td>
                        <td class="width20 center-col">
                          <a href="<?php echo site_url('dokumen/DocMOUEks/edit/'.$doc->id_dokumen_mou_eksekutor);?>"><i class="fa fa-pencil fa-lg"></i>edit</a>
                          &nbsp;&nbsp;&nbsp;&nbsp; 
                          <a href="<?php echo site_url('dokumen/DocMOUEks/manage/'.$doc->id_dokumen_mou_eksekutor);?>"><i class="fa fa-edit fa-lg"></i>manage</a>
                          &nbsp;&nbsp;&nbsp;&nbsp;
                          <a href="#" data-toggle="modal" data-nama="<?php echo $doc->nama_file;?>" data-hapus="<?php echo $doc->id_dokumen_mou_eksekutor;?>" data-target="#deleteModal"><i class="fa fa-trash-o fa-lg"></i>Delete</a>  
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
        <?php echo form_open('dokumen/DocMOUEks/delete', array('method'=>'post'));?>
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
