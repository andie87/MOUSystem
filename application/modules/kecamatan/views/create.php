
<script type="text/javascript">
function changeKotaKab(){
	var select_provinsi = $("#select_provinsi").val();
	$.ajax({
		url: "<?php echo base_url('index.php/kecamatan/selectkotakab' ); ?>/" + select_provinsi, 
		success: function(result) {
			$("#select_kota_kab").html(result);					
		}
	});
}
</script>

<div class="content-wrapper">
    <section class="content-header">
      <h1>
        Tambah Kecamatan Baru
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Kecamatan</a></li>
        <li class="active"><a href="#">Tambah Kecamatan</a></li>
      </ol>
    </section>

	<div class="padding-md">
	<div class="panel panel-default">
		<div class="panel-heading">
		</div>
		<div class="panel-body">
			<?php echo form_open('kecamatan/prosesCreate', array('class'=>'form-horizontal','method'=>'post'));?>
				<div class="form-group">
					<label class="col-sm-3 control-label">Nama Provinsi</label>
					<div class="col-lg-5">
						<select class="form-control input-sm" id="select_provinsi" onChange="changeKotaKab(this.val);">
		                    <option value="0">-- Pilih Provinsi --</option>
		                    <?php foreach ($provinces->result() as $row) { ?>
		                    	<option value="<?php echo $row->id_provinsi;?>"><?php echo $row->nama_provinsi;?></option>
		                    <?php }?>
		                </select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Nama Kota / Kabupaten</label>
					<div class="col-lg-5">
						<select class="form-control input-sm" name="id_kota_kab" id="select_kota_kab">
							<option></option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Nama Kecamatan</label>
					<div class="col-lg-5">
						<input type="text" name="nama_kecamatan" class="form-control input-sm" placeholder="Nama Kecamatan">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label"></label>
					<div class="col-lg-5">
						<button type="submit" class="btn btn-success btn-sm">Tambah</button>
					</div>
				</div>
		</div>
	</div>
	</div>
</div>