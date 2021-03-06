<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Selisih Nilai Proyek
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="#">Selisih Nilai Proyek</a></li>
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
              <span class="label label-info pull-right"><?php echo $data_selisih->num_rows();?>  Data</span>              
            </div>

            <?php echo form_open('selisih/index', array('class'=>'form-horizontal','method'=>'post'));?>
            <div class="box-group" id="accordion">
                <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                <div class="panel box box-primary">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                        Search
                      </a>
                    </h4>
                  </div>
                  <div id="collapseOne" class="panel-collapse collapse">
                    <div class="box-body">
                      <div class="box-header" style="border: 1px solid #ddd; margin-left: 10px;margin-right: 10px;">
                        <div class="form-group row" >
                          <label class="col-md-2 col-form-label">No Proyek :</label>
                          <div class="col-md-3">
                            <input class="form-control input-sm" value="<?php echo isset($no_proyek)? $no_proyek : ""; ?>" type="text" name="no_proyek" />  
                          </div>
                          <label class="col-xs-2 col-form-label">Nama Proyek :</label>
                          <div class="col-sm-3">
                            <input type="hidden" name="key" value=1>
                            <input class="form-control input-sm" value="<?php echo isset($nama_proyek)? $nama_proyek : ""; ?>" type="text" name="nama_proyek" />  
                          </div>
                        </div>
                        <div class="form-group row" >
                          <label class="col-md-2 col-form-label">Tanggal MOU :</label>
                          <div class="col-md-6">
                            <div class="input-group">
                              <input class="form-control input-sm" id="datepickerMOU1" value="<?php echo isset($from_mou)? $from_mou : ""; ?>" type="text" name="from_mou" />
                                <span class="input-group-addon">s/d</span>
                              <input class="form-control input-sm" id="datepickerMOU2" value="<?php echo isset($to_mou)? $to_mou : ""; ?>" type="text" name="to_mou" />
                            </div> 
                          </div>                          
                        </div>
                        <div class="form-group row" >
                          <label class="col-md-2 col-form-label">Eksekutor</label>
                          <div class="col-md-6">
                            <input class="form-control input-sm" value="<?php echo isset($nama_eksekutor)? $nama_eksekutor : ""; ?>" type="text" name="nama_eksekutor" />  
                            </div> 
                          </div>                          
                        </div>
                         <div class="form-group row">
                          <div class="col-md-2">
                            <button name="search" type="submit" class="btn btn-primary">Cari</button> &nbsp; 
                          </div>
                          <div class="col-md-2">
                            <button name="report" value=1 type="submit" class="btn btn-secondary">Report</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
    
            <!-- /.box-header -->
            <div class="box-body">
              
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