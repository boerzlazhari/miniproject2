<div class="col-md-12">
	<div class="box box-primary">
		<div class="box-header with-border">
		    <h3 class="box-title">Tambah Pengajuan Skripsi</h3>
		    <div class="box-tools pull-right">
		      	
		    </div>	  
		</div>
		<form action="<?=base_url()?>skripsi/pengajuan_sk/simpan" class="form-horizontal" enctype="multipart/form-data">
			<div class="box-body">
					<div class="form-group">
						<label class="col-md-3 control-label">Tanggal Pengajuan : </label>
						<div class="col-md-3">
							<div class="input-group date">
				                <div class="input-group-addon">
				                	<i class="fa fa-calendar"></i>
				                </div>
				                <input type="text" value="<?=date('d F Y')?>" class="form-control pull-right" id="datepicker">
			                </div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Judul : </label>
						<div class="col-md-4">
							<textarea class="form-control" name="" id="" rows="5"></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Upload Transkrip Nilai : </label>
						<div class="col-md-4">
							<input id="input-1" type="file" class="file">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Upload Bukti Transfer : </label>
						<div class="col-md-4">
							<input id="input-1" type="file" class="file">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Upload Proposal : </label>
						<div class="col-md-4">
							<input id="input-1" type="file" class="file">
						</div>
					</div>
			</div>
			<div class="box-footer text-right">
		      	<a href="javascript:history.go(-1);" class="btn btn-default btn-md">
					<i class="fa fa-reply"></i> Kembali
				</a>
				<a href="" class="btn btn-primary btn-md">
		      		<i class="fa fa-save"></i>
		      		Simpan Pengajuan
		      	</a>
		      	<button id="save" class="hidden">save</button>
			</div>
		</form>
	</div>
</div>

<script type="text/javascript">
	$('#datepicker').datepicker({
    	autoclose: true,
        format: "dd MM yyyy",                         
    });
</script>