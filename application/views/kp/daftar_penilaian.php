<div class="col-md-12">
	<div class="box box-primary">
		<div class="box-header with-border">
		    <h3 class="box-title">Daftar Sidang Kerja Praktek</h3>
		    <div class="box-tools pull-right">
		      	
		    </div>	  
		</div>
			<form action="<?=base_url()?>kerja_praktek/penilaian_kp/simpan" class="form-horizontal" method="POST" enctype="multipart/form-data">
			<div class="box-body">
				<input type="text" class="hidden" name="sks" id="sks" value="<?=$sks?>">
					<input type="text" class="hidden" name="kp_id" id="kp_id" value="<?=$data_pengajuan->id?>">
					<input type="text" class="hidden" name="id" id="id" value="<?=$skp_id?>">
				<input type="text" class="hidden" name="base_url" id="base_url" value="<?=base_url()?>kerja_praktek/daftar_sidang_kp/">
				<div class="alert alert-warning alert-sks" style="display:none;">Anda tidak dapat melakukan pengajuan skripsi dikarenakan jumlah SKS anda belum sesuai syarat.</div>
				<div class="form-group">
					<div class="col-md-12">
						<label class="col-md-3 control-label">Penguji</label>
					</div>
					<div class="col-md-12">
						<label class="col-md-3 control-label">Nama : </label>
						<label class="control-label"><?=$dosen->nama?></label>
					</div>
					<div class="col-md-12">
						<label class="col-md-3 control-label">Jabatan : </label>
						<label class="control-label"><?=$dosen->jabatan?></label>
					</div>
				</div>
				&nbsp;
				&nbsp;
				&nbsp;
				<div class="form-group">
					<label class="col-md-3 control-label">Penyaji : </label>
					<div class="col-md-7">
						<table class="table table-striped table-bordered table-hover table-condensed text-center" id="table_pengajuan">
							<thead>
								<tr>
									<th>No</th>
									<th>NIM</th>
									<th>Nama</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>1</td>
									<td><?=$mahasiswa->nim?></td>
									<td><?=$mahasiswa->nama?></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				&nbsp;
				&nbsp;
				&nbsp;
				<div class="form-group">
					<label class="col-md-3 control-label">Penilaian : </label>
					<div class="col-md-7">
						<table class="table table-striped table-bordered table-hover table-condensed text-center" id="table_pengajuan">
							<thead>
								<tr>
									<th>No</th>
									<th>Butiran Nilai</th>
									<th>Nilai</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$i=1;
                            		foreach ($data_penilaian as $data) {
								?>
								<tr>
									<td><?=$i?></td>
									<td><?=$data->description?></td>
									<td><input id="id_<?=$i?>" name="id_<?=$i?>" type="hidden" value="<?=$data->id?>"><input id="nilai_<?=$i?>" name="nilai_<?=$i?>" type="number" min="0" max="100"></td>
								</tr>
								<?php $i++;} ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="box-footer text-right">
		      	<a href="javascript:history.go(-1);" class="btn btn-default btn-md">
					<i class="fa fa-reply"></i> Kembali
				</a>
				<a href="#" class="btn btn-primary btn-md btn-simpan"> 
		      		<i class="fa fa-save"></i>
		      		Simpan
		      	</a>
		      	<button id="save" class="hidden">save</button>
			</div>
		</form>
	</div>
</div>

<script type="text/javascript">
	var base_url = $('#base_url').val();

	if ($('#sks').val() < 100) {
		$('.alert-sks').show();
		// $('.btn-simpan').hide();
		// $('input, textarea, .fileinput-button ').attr('disabled', true);
	}

	$('.btn-simpan').click(function(){
		bootbox.confirm('Apakah anda yakin akan mendaftar sidang kerja praktek?', function(result) {
			if (result == true) {
				$('#save').click();
			}
		});
	});

	$('.btn-save').click(function(){
		// bootbox.confirm('Apakah anda yakin akan menyetujui pengajuan ini?', function(result) {
		// 	if (result == true) {
			$.ajax({
	            method   : 'POST',
	            url      : base_url + 'save_penilaian',
	            data     : {kp_id : $('#kp_id').val(), id : $('#id').val(), dosen_1_id : $("#dosen_1 option:selected").val(), dosen_2_id : $("#dosen_2 option:selected").val()},
	            success : function(){
	            	$('.btn-close').click();
	            	window.location.replace(base_url);
	            }
	        });
		// 	}
		// });
	});
</script>