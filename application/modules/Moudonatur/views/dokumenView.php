
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
    	
		<section class="content">
      	
      	<a href="<?php echo site_url('moudonatur/view'); ?>/<?php echo $id_mou_donatur; ?>" >
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
                        <th>Nama File</th>
                        <th class="center-col width20">Download</th>
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
