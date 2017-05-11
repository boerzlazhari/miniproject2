<div class="col-md-12">
	<div class="box box-primary">
		<div class="box-header with-border">
		    <h3 class="box-title">Tambah Pendaftaran Pra Sidang	Skripsi</h3>
		    <div class="box-tools pull-right">
		      	
		    </div>	  
		</div>
		<form action="<?=base_url()?>skripsi/pengajuan_prasidang/simpan" class="form-horizontal" method="POST" enctype="multipart/form-data">
			<div class="box-body">
				<div class="form-group hidden ">
					<label class="col-md-3 control-label">ID : </label>
					<div class="col-md-3">
						<input type="text" name="skp_id" value="<?=$data_pengajuan->id?>" class="form-control">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">NIM : </label>
					<div class="col-md-3">
						<label class="control-label"><?=$data_pengajuan->nim?></label>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Nama : </label>
					<div class="col-md-3">
						<label class="control-label"><?=$data_pengajuan->nama?></label>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Judul Skripsi : </label>
					<div class="col-md-4">
						<label class="control-label" style="text-align:left;"><?=$data_pengajuan->judul?></label>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Pembimbing : </label>
					<div class="col-md-3">
						<label class="control-label"><?=$data_pengajuan->pembimbing?></label>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Catatan : </label>
					<div class="col-md-4">
						<textarea class="form-control" name="catatan" id="catatan" rows="5"></textarea>
					</div>
				</div>
				
			</div>
			<div class="box-footer text-right">
		      	<a href="javascript:history.go(-1);" class="btn btn-default btn-md">
					<i class="fa fa-reply"></i> Kembali
				</a>
				<a href="#" class="btn btn-primary btn-md btn-simpan"> 
		      		Daftar Pra Sidang
		      	</a>
		      	<button id="save" class="hidden">save</button>
			</div>
		</form>
	</div>
</div>

<script type="text/javascript">

	$('.btn-simpan').click(function(){
		bootbox.confirm('Apakah anda yakin akan daftar pra sidang?', function(result) {
			if (result == true) {
				$('#save').click();
			}
		});
	});
	
</script>