
<div class="content-wrapper">
    <section class="content-header">
      <h1 style="padding-bottom: 15px;">
        List Pembayaran Donatur
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="<?php echo site_url('moudonatur'); ?>">pembayaran donatur</a></li>
        <li class="active"><a href="">edit</a></li>
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
			
			<?php echo form_open('pembayarandonatur/search_noproyek', array('class'=>'form-horizontal','method'=>'post'));?>
			<div class="form-group" style="margin-bottom: 50px;">
				<label class="col-sm-3 control-label">Nomor Proyek</label>
				<div class="col-lg-4">
					<select class="form-control select2" name="nomor_proyek" style="width: 100%;">
						<option>silakan pilih nomor proyek</option>
					<?php 
						foreach ($moudonatur->result() as $d) {
							if($nomor_proyek == $d->nomor_proyek){
								$selected = "selected";
							} else {
								$selected = "";
							}
							echo "<option ".$selected." value=".$d->nomor_proyek.">".$d->nomor_proyek."</option>";
						}
					?>
	                </select>
				</div>
				<div class="col-lg-3"  style="padding-left: 0px;">
					<button type="submit" class="btn btn-success btn-sm width30" >Pilih</button>
				</div>
			</div>
			</form>
			
			<?php echo form_open_multipart('pembayarandonatur/updatePembayaran', array('class'=>'form-horizontal','method'=>'post'));?>
				<div class="form-group" >
					<label class="col-sm-3 control-label">Nominal Pembayaran</label>
					<div class="col-lg-5">
						<input type="text" id="nominal" name="nominal_pembayaran" value="<?php echo $dok['nominal_pembayaran']; ?>"
							onkeypress="return isNumberKey(event)" class="form-control input-sm" >
						<input type="hidden" name="pembayaran_donatur" value="<?php echo $dok['id_pembayaran_donatur']; ?>" />
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
				<div class="form-group" >
					<label class="col-sm-3 control-label">Dokumen Pembayaran</label>
					<div class="col-lg-5">
						<input type="file" name="file" style="font-size: 15px;">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label"></label>
					<div class="col-lg-5">
						<button type="submit" class="btn btn-success btn-sm " >Update Pembayaran</button>
						&nbsp;&nbsp;&nbsp;
						<a href="<?php echo site_url('pembayarandonatur'); ?>" >
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
                        <th class="">Nominal Pembayaran</th>
                        <th class="">Persen Pembayaran</th>
                        <th class="">Pembayaran Ke</th>
                        <th class="center-col ">Tanggal Pembayaran</th>
                        <th class="center-col ">Tanggal Deadline Pembayaran</th>
                        <th class="center-col">Download</th>
                        <th class="center-col" style="width: 12%">Action</th>
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
                          <a href="<?php echo site_url('pembayarandonatur/download/'.$p->id_pembayaran_donatur);?>">
                          <i class="fa fa-download fa-lg"></i>&nbsp;Download</a>
                        </td>
                        <td class="center-col">
                        	<a href="<?php echo site_url('pembayarandonatur/editPembayaran/'.$p->id_pembayaran_donatur);?>">
                        		<i class="fa fa-pencil fa-lg"></i>Edit</a>  
							&nbsp;
                        	<a href="<?php echo site_url('pembayarandonatur/deletePembayaran/'.$p->id_pembayaran_donatur);?>" 
                        		onclick="return confirm('Apakah anda yakin akan menghapus?');"><i class="fa fa-trash-o fa-lg"></i>Delete</a>  
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
