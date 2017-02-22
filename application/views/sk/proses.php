<div class="col-md-12">
	<div class="box box-primary">
		<div class="box-header with-border">
		    <h3 class="box-title">Persetujuan Pengajuan Skripsi</h3>
		    <div class="box-tools pull-right">
		      	
		    </div>	  
		</div>
		<form action="<?=base_url()?>skripsi/daftar_pengajuan_sk/simpan" class="form-horizontal" method="POST" enctype="multipart/form-data">
			<div class="box-body">
				<input type="text" class="hidden" name="pk" id="pk" value="<?=$pk?>">
				<div class="form-group hidden ">
					<label class="col-md-3 control-label">ID : </label>
					<div class="col-md-2">
						<input type="text" class="form-control" name="pk" id="pk" value="<?=$pk?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">NIM : </label>
					<div class="col-md-3">
						<label class="control-label"><?=$data_mhs->nim?></label>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Nama Mahasiswa : </label>
					<div class="col-md-3">
						<label class="control-label"><?=$data_mhs->nama?></label>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Total SKS : </label>
					<div class="col-md-3">
						<label class="control-label"><?=$this->session->userdata('sks')?></label>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Transkrip Nilai : </label>
					<div class="col-md-4">
						<div class="input-group">
							<div class="input-group-addon">
			                	<i class="fa fa-search"></i>
			                </div>
							<a href="<?=base_url()?>upload/<?=$data_mhs->nim.'_'.$data_mhs->nama.'/'.$data_mhs->transkrip_nilai?>" target="_blank" class="btn btn-default btn-sm transkrip_nilai"><?=$data_mhs->transkrip_nilai?></a>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Bukti Transfer : </label>
					<div class="col-md-4">
						<div class="input-group">
							<div class="input-group-addon">
			                	<i class="fa fa-search"></i>
			                </div>
							<a href="<?=base_url()?>upload/<?=$data_mhs->nim.'_'.$data_mhs->nama.'/'.$data_mhs->bukti_bayar?>" target="_blank" class="btn btn-default btn-sm bukti_bayar"><?=$data_mhs->bukti_bayar?></a>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Proposal : </label>
					<div class="col-md-4">
						<div class="input-group">
							<div class="input-group-addon">
			                	<i class="fa fa-search"></i>
			                </div>
							<a href="<?=base_url()?>upload/<?=$data_mhs->nim.'_'.$data_mhs->nama.'/'.$data_mhs->proposal?>" target="_blank" class="btn btn-default btn-sm proposal"><?=$data_mhs->proposal?></a>
						</div>
					</div>
				</div>

				<?php if ($this->session->userdata('user_level') == 2): ?>
				<div class="form-group">
					<label class="col-md-3 control-label">Tanggal Wawancara : </label>
					<div class="col-md-3">
						<div class="input-group date">
			                <div class="input-group-addon">
			                	<i class="fa fa-calendar"></i>
			                </div>
			                <input name="tgl_pengajuan" type="text" value="<?=date('d F Y')?>" class="form-control pull-right" id="datepicker">
		                </div>
					</div>
				</div>
				<?php endif ?>
			</div>
			<div class="box-footer text-right">
		      	<a href="javascript:history.go(-1);" class="btn btn-default btn-md">
					<i class="fa fa-reply"></i> Kembali
				</a>
				<a href="#" class="btn btn-danger btn-md btn-tolak"> 
		      		<i class="fa fa-times"></i>
		      		Ditolak
		      	</a>
				<a href="#" class="btn btn-success btn-md btn-setuju"> 
		      		<i class="fa fa-check"></i>
		      		Disetujui
		      	</a>
		      	<input type="text" class="hidden" id="setuju" name="setuju">
		      	<button id="save" class="hidden">save</button>
			</div>
		</form>
	</div>
</div>

<script type="text/javascript">

	// bootbox.alert('<img class="img-thumbnail" src="<?=base_url()?>upload/<?=$data_mhs->nim.'_'.$data_mhs->nama.'/'.$data_mhs->transkrip_nilai?>" alt="">');
	
	$('.btn-setuju').click(function(){
		bootbox.confirm('Apakah anda yakin akan menyetujui pengajuan ini?', function(result) {
			if (result == true) {
				$('#setuju').val(1);
				$('#save').click();
			}
		});
	});

	$('.btn-tolak').click(function(){
		bootbox.confirm('Apakah anda yakin akan menolak pengajuan ini?', function(result) {
			if (result == true) {
				$('#setuju').val(0);
				$('#save').click();
			}
		});
	});
	
	$('#datepicker').datepicker({
    	autoclose: true,
        format: "dd MM yyyy",                         
    });


</script>