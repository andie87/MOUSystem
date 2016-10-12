
<div class="content-wrapper">
    <section class="content-header">
      <h1 style="padding-bottom: 15px;">
        List Dokumen MOU Donatur
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="<?php echo site_url('moudonatur'); ?>">mou donatur</a></li>
        <li class="active"><a href="£">dokumen</a></li>
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
			<?php echo form_open_multipart('moudonatur/uploadDokumen', array('class'=>'form-horizontal','method'=>'post'));?>
				<div class="form-group" >
					<label class="col-sm-3 control-label">Nama File</label>
					<div class="col-lg-5">
						<input type="file" name="file" style="font-size: 15px;">
						<input type="hidden" name="mou_donatur" value="<?php echo $id_mou_donatur; ?>" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label"></label>
					<div class="col-lg-5">
						<button type="submit" class="btn btn-success btn-sm width30" >Upload</button>
					</div>
				</div>
		</div>
		
		<section class="content">
      	
      	<?php if(strpos($granted_access['moudonatur'], 'edit') !== false){ ?>
      	<a href="<?php echo site_url('moudonatur/edit'); ?>/<?php echo $id_mou_donatur; ?>" >
			<button type="button" class="btn btn-warning btn-sm width15" ><strong>Back</strong></button>
		</a>
		<?php } else if(strpos($granted_access['moudonatur'], 'view_minus_biaya') !== false){ ?>
		<a href="<?php echo site_url('moudonatur/view_m'); ?>/<?php echo $id_mou_donatur; ?>" >
			<button type="button" class="btn btn-warning btn-sm width15" ><strong>Back</strong></button>
		</a>
		<?php } else {?>
		<a href="<?php echo site_url('moudonatur/view'); ?>/<?php echo $id_mou_donatur; ?>" >
			<button type="button" class="btn btn-warning btn-sm width15" ><strong>Back</strong></button>
		</a>
		<?php } ?>
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
                        <th>Nama File</th>
                        <th class="center-col width20">Download</th>
                        <th class="center-col width20">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                     $i = 1;   
                     foreach ($dokumens->result() as $d) {
                    ?>
                    <tr>
                        <td class="width5 center-col"><?php echo $i; ?></td>
                        <td><?php echo $d->nama_file; ?></td>
                        <td class="center-col">
                          <a href="<?php echo site_url('moudonatur/moudonatur/download/'.$d->id_dokumen_mou_donatur);?>">
                          <i class="fa fa-download fa-lg"></i>&nbsp;Download</a>
                        </td>
                        <td class="center-col">
                        	<a href="<?php echo site_url('moudonatur/moudonatur/deleteDokumen/'.$d->id_dokumen_mou_donatur);?>" 
                        		onclick="return confirm('Apakah anda yakin akan menghapus?');"><i class="fa fa-trash-o fa-lg"></i>&nbsp;Delete</a>  
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
	</div>
</div>
