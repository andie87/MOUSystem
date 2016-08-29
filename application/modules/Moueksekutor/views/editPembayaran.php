
<div class="content-wrapper">
    <section class="content-header">
      <h1 style="padding-bottom: 15px;">
        List Pembayaran Eksekutor
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="<?php echo site_url('moueksekutor'); ?>">mou eksekutor</a></li>
        <li class="active"><a href="">dokumen</a></li>
      </ol>
    </section>

		<div class="padding-md">
		<div class="panel panel-default">
		
		<?php if(isset($message)){ ?> 
	    	<div class="alert alert-danger">
	    		<label><strong><?php echo $message; ?></strong></label>
	    	</div>
    	<?php } ?>
    	
    	<?php if(isset($messageOK)){ ?> 
	    	<div class="callout callout-success">
	    		<label><strong><?php echo $messageOK; ?></strong></label>
	    	</div>
    	<?php } ?>
    	
		<div class="panel-body" style="padding-top: 30px;">
			<?php echo form_open('moueksekutor/updatePembayaran', array('class'=>'form-horizontal','method'=>'post'));?>
				<div class="form-group" >
					<label class="col-sm-3 control-label">Nominal Pembayaran</label>
					<div class="col-lg-5">
						<input type="text" id="nominal" name="nominal_pembayaran" value="<?php echo $dok['nominal_pembayaran']; ?>"
							onkeypress="return isNumberKey(event)" class="form-control input-sm" >
						<input type="hidden" name="pembayaran_eksekutor" value="<?php echo $dok['id_pembayaran_eksekutor']; ?>" />
					</div>
				</div>
				<div class="form-group" >
					<label class="col-sm-3 control-label">Persen Pembayaran</label>
					<div class="col-lg-5">
						<input type="text" name="persen_pembayaran" value="<?php echo $dok['persen_pembayaran']; ?>" 
							class="form-control input-sm" onkeypress="return isNumberKey(event)">
					</div>
				</div>
				<div class="form-group" >
					<label class="col-sm-3 control-label">Pembayaran Ke</label>
					<div class="col-lg-5">
						<input type="text" name="pembayaran_ke" value="<?php echo $dok['pembayaran_ke']; ?>" 
							class="form-control input-sm" onkeypress="return isNumberKey(event)">
					</div>
				</div>
				<div class="form-group" >
					<label class="col-sm-3 control-label">Tanggal Pembayaran</label>
					<div class="col-lg-5 input-group" style="padding-left: 15px; padding-right: 15px;">
	                <div class="input-group-addon "><i class="fa fa-calendar"></i></div>
	                 <input type="text" name="tgl_pembayaran" class="form-control pull-right" id="datepickerMOU"
	                 	value="<?php echo $dok['tanggal_pembayaran'] == "0000-00-00" ? "" : getUserFormatDate($dok['tanggal_pembayaran']) ; ?>" >
	                </div>
				</div>
				<div class="form-group" >
					<label class="col-sm-3 control-label">Tanggal Deadline Pembayaran</label>
					<div class="col-lg-5 input-group" style="padding-left: 15px; padding-right: 15px;">
	                <div class="input-group-addon "><i class="fa fa-calendar"></i></div>
	                 <input type="text" name="tgl_deadline_pembayaran" class="form-control pull-right" id="datepickerPembangunan"
	                 	value="<?php echo $dok['tanggal_deadline_pembayaran'] == "0000-00-00" ? "" : getUserFormatDate($dok['tanggal_deadline_pembayaran']); ?>" >
	                </div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label"></label>
					<div class="col-lg-5">
						<button type="submit" class="btn btn-success btn-sm " >Update Pembayaran</button>
						&nbsp;&nbsp;&nbsp;
						<a href="<?php echo site_url('moueksekutor/pembayaran'); ?>" >
							<button type="button" class="btn btn-success btn-sm width30" >Pembayaran Baru</button>
						</a>
					</div>
				</div>
		</div>
		
		<section class="content">
      <div class="row">
        <div class="col-xs-12">
		
		<div class="box box-warning">
    
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover font13">
                <thead>
                	<tr>
                        <th class="width5 center-col">No</th>
                        <th class="width15">Nominal Pembayaran</th>
                        <th class="width15">Persen Pembayaran</th>
                        <th class="width15">Pembayaran Ke</th>
                        <th class="center-col width15">Tanggal Pembayaran</th>
                        <th class="center-col width15">Tanggal Deadline Pembayaran</th>
                        <th class="center-col width15">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                     $i = 1;   
                     foreach ($pembayaran->result() as $p) {
                    ?>
                    <tr>
                        <td class="width5 center-col"><?php echo $i; ?></td>
                        <td>Rp. <?php echo number_format($p->nominal_pembayaran, 0, ',', '.');  ?></td>
                        <td><?php echo $p->persen_pembayaran; ?>%</td>
                        <td><?php echo $p->pembayaran_ke; ?></td>
                        <td class="center-col"><?php echo $p->tanggal_pembayaran=='0000-00-00' ? "" : getUserFormatDate($p->tanggal_pembayaran); ?></td>
                        <td class="center-col"><?php echo $p->tanggal_deadline_pembayaran=='0000-00-00' ? "" : getUserFormatDate($p->tanggal_deadline_pembayaran); ?></td>
                        <td class="center-col">
                        	<a href="<?php echo site_url('moueksekutor/moueksekutor/editPembayaran/'.$p->id_pembayaran_eksekutor);?>">
                        		<i class="fa fa-pencil fa-lg"></i>&nbsp;Edit</a>  
							&nbsp;
                        	<a href="<?php echo site_url('moueksekutor/moueksekutor/deletePembayaran/'.$p->id_pembayaran_eksekutor);?>" 
                        		onclick="return confirm('Apakah anda yakin akan menghapus?');"><i class="fa fa-trash-o fa-lg"></i>&nbsp;Delete</a>  
                        </td>
                    </tr>
                    <?php $i++; } ?>
                </tbody>
              </table>
            </div>
          </div>
          
          </div>
      </div>
    </section>
          
	</div>
	</div>
</div>
