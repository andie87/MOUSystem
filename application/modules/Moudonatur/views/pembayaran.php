
<div class="content-wrapper">
    <section class="content-header">
      <h1 style="padding-bottom: 15px;">
        List Pembayaran Donatur
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="<?php echo site_url('moudonatur'); ?>">mou donatur</a></li>
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
		
			<?php echo form_open('moudonatur/createPembayaran', array('class'=>'form-horizontal','method'=>'post'));?>
				<div class="form-group" >
					<label class="col-sm-3 control-label">Nominal Pembayaran</label>
					<div class="col-lg-5">
						<input type="text" id="nominal" name="nominal_pembayaran" onkeypress="return isNumberKey(event)" class="form-control input-sm" >
						<input type="hidden" name="mou_donatur" value="<?php echo $id_mou_donatur; ?>" />
					</div>
				</div>
				<div class="form-group" >
					<label class="col-sm-3 control-label">Persen Pembayaran</label>
					<div class="col-lg-5">
						<input type="text" name="persen_pembayaran" class="form-control input-sm" onkeypress="return isNumberKey(event)">
					</div>
				</div>
				<div class="form-group" >
					<label class="col-sm-3 control-label">Pembayaran Ke</label>
					<div class="col-lg-5">
						<input type="text" name="pembayaran_ke" class="form-control input-sm" onkeypress="return isNumberKey(event)">
					</div>
				</div>
				<div class="form-group" >
					<label class="col-sm-3 control-label">Tanggal Pembayaran</label>
					<div class="col-lg-5 input-group" style="padding-left: 15px; padding-right: 15px;">
	                <div class="input-group-addon "><i class="fa fa-calendar"></i></div>
	                 <input type="text" name="tgl_pembayaran" class="form-control pull-right" id="datepickerMOU">
	                </div>
				</div>
				<div class="form-group" >
					<label class="col-sm-3 control-label">Tanggal Deadline Pembayaran</label>
					<div class="col-lg-5 input-group" style="padding-left: 15px; padding-right: 15px;">
	                <div class="input-group-addon "><i class="fa fa-calendar"></i></div>
	                 <input type="text" name="tgl_deadline_pembayaran" class="form-control pull-right" id="datepickerPembangunan">
	                </div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label"></label>
					<div class="col-lg-5">
						<button type="submit" class="btn btn-success btn-sm width30" >Simpan</button>
					</div>
				</div>
		</div>
		
		<section class="content">
      	
      	<a href="<?php echo site_url('moudonatur/edit'); ?>/<?php echo $id_mou_donatur; ?>" >
			<button type="button" class="btn btn-warning btn-sm width15" ><strong>Back</strong></button>
		</a>
		<br /><br />
      	
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
                        	<a href="<?php echo site_url('moudonatur/moudonatur/editPembayaran/'.$p->id_pembayaran_donatur);?>">
                        		<i class="fa fa-pencil fa-lg"></i>&nbsp;Edit</a>  
							&nbsp;
                        	<a href="<?php echo site_url('moudonatur/moudonatur/deletePembayaran/'.$p->id_pembayaran_donatur);?>" 
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
