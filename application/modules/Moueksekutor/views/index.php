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
            <?php if(strpos($granted_access['moueksekutor'], 'create') !== false){ ?>
              <a class="btn btn-sm btn-primary" href="<?php echo site_url('moueksekutor/create'); ?>"><i class="fa fa-plus fa-lg"></i> 
                <strong>MoU Eksekutor Baru</strong></a>
            <?php } ?>
              <span class="label label-info pull-right"><?php echo $moueksekutors->num_rows();?>  MoU</span>
            </div>

            <?php echo form_open('moueksekutor/index', array('class'=>'form-horizontal','method'=>'post'));?>
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
                  <div id="collapseOne" class="panel-collapse collapse <?php echo $search; ?> ">
                    <div class="box-body">
                      <div class="box-header" style="border: 1px solid #ddd; margin-left: 10px;margin-right: 10px;">
                        <div class="form-group row" >
                          <label class="col-md-2 col-form-label">Jenis Proyek :</label>
                          <div class="col-md-3">
                            <select name="jenis_proyek" class="form-control input-sm" >
                                <option value="All">All</option>
                                <?php 
                                  foreach ($proyeks->result() as $p) {
                                    if($jenis_proyek == $p->id_jenis_proyek){
                                      echo "<option selected value=".$p->id_jenis_proyek.">".$p->nama_proyek."</option>";
                                    } else {
                                      echo "<option value=".$p->id_jenis_proyek.">".$p->nama_proyek."</option>";
                                    }
                                  }
                                ?>
                            </select>
                          </div>
                          <label class="col-xs-2 col-form-label">Nama Proyek :</label>
                          <div class="col-sm-3">
                            <input type="hidden" name="key" value=1>
                            <input class="form-control input-sm" value="<?php echo isset($nama_proyek)? $nama_proyek : ""; ?>" type="text" name="nama_proyek" />  
                          </div>
                        </div>
                        <div class="form-group row" >
                          <label class="col-md-2 col-form-label">No Proyek :</label>
                          <div class="col-md-3">
                            <input class="form-control input-sm" value="<?php echo isset($no_proyek)? $no_proyek : ""; ?>" type="text" name="no_proyek" />  
                          </div>
                          <label class="col-xs-2 col-form-label">Alamat Proyek :</label>
                          <div class="col-sm-3">
                            <input class="form-control input-sm" value="<?php echo isset($alamat_proyek)? $alamat_proyek : ""; ?>" type="text" name="alamat_proyek" />
                          </div>
                        </div>
                        <div class="form-group row" >
                          <label class="col-md-2 col-form-label">Progress :</label>
                          <div class="col-md-3">
                            <div class="input-group">
                              <input class="form-control input-sm" value="<?php echo isset($progress)? $progress : ""; ?>" 
                                onkeypress="return isNumberKey(event)" type="text" name="progress" />
                                <span class="input-group-addon">%</span>
                            </div> 
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
                          <label class="col-md-2 col-form-label">Tanggal Pembangunan</label>
                          <div class="col-md-6">
                            <div class="input-group">
                              <input class="form-control input-sm" id="datepickerPembangunan1" value="<?php echo isset($from_pembangunan)? $from_pembangunan : ""; ?>" type="text" name="from_pembangunan" />
                                <span class="input-group-addon">s/d</span>
                              <input class="form-control input-sm" id="datepickerPembangunan2" value="<?php echo isset($to_pembangunan)? $to_pembangunan : ""; ?>" type="text" name="to_pembangunan" />
                            </div> 
                          </div>                          
                        </div>
                        <div class="form-group row">
                          <div class="col-md-2">
                          </div>
                          <div class="col-md-2">
                          	<button name="search" type="submit" class="btn btn-primary">Cari</button> &nbsp;&nbsp;&nbsp; 
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
              <table id="example2" class="table table-bordered table-hover font13">
                <thead>
                	<tr>
                        <th class="width5 center-col">No</th>
                        <th>No Proyek</th>
                        <th>Nama Eksekutor</th>
                        <th>Jenis Proyek</th>
                        <th class="width10 center">Tanggal MoU</th>
                        <th class="width10 center">Tanggal Pengerjaan</th>
                        <th class="width10 center">Tanggal Selesai</th>
                        <th class="center-col" style="width: 13%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                     $i = 1;   
                     foreach ($moueksekutors->result() as $md) {
                    ?>
                    <tr>
                        <td class="width5 center-col"><?php echo $i; ?></td>
                        <td><?php echo $md->moudonatur_nomor_proyek;?></td>
                        <td><?php echo $arr_eksekutor[$md->id_eksekutor]; ?></td>
                        <td><?php echo $arr_proyek[$md->id_jenis_proyek]; ?></td>
                        <td class="center"><?php echo getUserFormatDate($md->tanggal_mou); ?></td>
                        <td class="center"><?php echo getUserFormatDate($md->tanggal_pengerjaan); ?></td>
                        <td class="center"><?php echo getUserFormatDate($md->tanggal_selesai); ?></td>
                        <td class="center-col">
                        <?php if(strpos($granted_access['moueksekutor'], 'edit') !== false){ ?>	
                        	<a href="<?php echo site_url('moueksekutor/edit'); ?>/<?php echo $md->id_mou_eksekutor; ?>">
                        		<i class="fa fa-pencil fa-lg"></i>edit
                        	</a>
                        	&nbsp; 
                        <?php } else { if(strpos($granted_access['moueksekutor'], 'view_minus_biaya') !== false){ ?>
                        	<a href="<?php echo site_url('selisih/index/eksekutor'); ?>/<?php echo $md->id_mou_eksekutor; ?>">
                        		<i class="fa fa-calculator fa-lg"></i>view
                        	</a>
                        	&nbsp;
                        <?php } else {?>
                        	<a href="<?php echo site_url('moueksekutor/view'); ?>/<?php echo $md->id_mou_eksekutor; ?>">
                        		<i class="fa fa-edit fa-lg"></i>view
                        	</a>
                        	&nbsp;
                        <?php }} ?>
                        <?php if(strpos($granted_access['moueksekutor'], 'delete') !== false){ ?>
                        	<a href="#" data-toggle="modal" data-nama="<?php echo $md->nama_proyek;?>" 
                        	data-hapus="<?php echo $md->id_mou_eksekutor;?>" data-target="#deleteModal">
                        		<i class="fa fa-trash-o fa-lg"></i>delete
                        	</a>
                        <?php } ?>    
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
      <?php echo form_open('moueksekutor/delete', array('method'=>'post'));?>
      <div class="modal-body">
        <p class="data-pesan">Anda yakin ingin menghapus</p>
        <input type="hidden" name="id" class="data-id">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline" data-dismiss="modal">Tidak</button>
        <button type="submit" class="btn btn-danger">Yakin!</button>
      </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>