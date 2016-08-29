
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
		
		<section class="content">
		
		<a href="<?php echo site_url('moueksekutor/view'); ?>/<?php echo $id_mou_eksekutor; ?>" >
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
