
<div class="content-wrapper">
    <section class="content-header">
      <h1 style="padding-bottom: 15px;">
        List Pembayaran Donatur
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="<?php echo site_url('moudonatur'); ?>">pembayaran donatur</a></li>
        <li class="active"><a href="">view</a></li>
      </ol>
    </section>

		<div class="padding-md">
		<div class="panel panel-default">
		
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
		
		</div>
		
		<section class="content">
      	
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
                        <th class="">Nominal Pembayaran</th>
                        <th class="">Persen Pembayaran</th>
                        <th class="">Pembayaran Ke</th>
                        <th class="center-col ">Tanggal Pembayaran</th>
                        <th class="center-col ">Tanggal Deadline Pembayaran</th>
                        <th class="center-col">Download</th>
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
