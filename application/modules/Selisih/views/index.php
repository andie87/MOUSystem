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
                        <div class="form-group row">
                          <div class="col-md-2">
                            <button name="search" type="submit" class="btn btn-primary">Cari</button> &nbsp; 
                          </div>                          
                        </div>                          
                      </div>                        
                    </div>
                  </div>
                </div>
              </div>
                
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover font13">
                <thead>
                  <tr>
                        <th rowspan="2" class="width5 center-col">No</th>
                        <th rowspan="2">Nama Donatur</th>
                        <th rowspan="2">Nama Penyumbang</th>
                        <th rowspan="2">No Proyek</th>
                        <th rowspan="2">Nama Proyek</th>
                        <th rowspan="2" class="width10 center">Tanggal MoU</th>                        
                        <th colspan="2">Nilai Proyek</th>
                        <th rowspan="2">Progress Pembayaran Donatur</th>
                        <th rowspan="2">Nama Eksekutor</th>
                        <th rowspan="2">Nilai Proyek Eksekutor</th>
                        <th rowspan="2">Selisih</th>
                        <th rowspan="2">Progress Eksekutor</th>
                        <th rowspan="2" class="center-col width20">Action</th>
                    </tr>
                    <tr>
                        <th>Dirham</th>
                        <th>Rupiah</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                     $i = 1;   
                     foreach ($data_selisih->result() as $dt) {
                    ?>
                    <tr>
                        <td class="width5 center-col"><?php echo $i; ?></td>
                        <td><?php echo $dt->nama_donatur;?></td>
                        <td><?php echo $dt->nama_penyumbang; ?></td>
                        <td><?php echo $dt->nomor_proyek; ?></td>
                        <td><?php echo $dt->nama_proyek; ?></td>
                        <td><?php echo getUserFormatDate($dt->tanggal_mou); ?></td>
                        <td><?php echo $dt->harga_dirham; ?></td>
                        <td><?php echo $dt->harga_rupiah; ?></td>
                        <td><?php echo $dt->persen_pembayaran; ?></td>
                        <td><?php echo $dt->nama_eksekutor; ?></td>
                        <td><?php echo $dt->selisih; ?></td>
                        <td><?php echo $dt->nilai_proyek; ?></td>
                        <td><?php echo $dt->progress_proyek; ?>%</td>
                        <td class="center-col">
                          <?php //if($this->session->userdata['access']['MoU']['MoU Donatur']['edit']){
                              if(strpos($granted_access['moudonatur'], 'edit')){
                            ?>
                          <a href="<?php echo site_url('moudonatur/edit'); ?>/<?php echo $dt->id_mou_donatur; ?>">
                            <i class="fa fa-pencil fa-lg"></i>Donatur
                          </a>
                          <?php }?>
                          &nbsp; 
                          <?php //if($this->session->userdata['access']['MoU']['MoU Eksekutor']['edit']){
                            if(strpos($granted_access['moueksekutor'], 'edit')){?>
                          <a href="<?php echo site_url('moueksekutor/edit'); ?>/<?php echo $dt->id_mou_eksekutor; ?>">
                            <i class="fa fa-edit fa-lg"></i>Eksekutor
                          </a>
                          <?php }?>
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
  