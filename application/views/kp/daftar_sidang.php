<div class="col-md-12">
	<div class="box box-primary">
		<div class="box-header with-border">
		    <h3 class="box-title">Daftar Sidang Kerja Praktek</h3>
		    <div class="box-tools pull-right">
		      	
		    </div>	  
		</div>
		<?php if ($this->session->userdata('user_level') == 7): ?>
			<form action="<?=base_url()?>kerja_praktek/bimbingan_kp/simpan_sidang" class="form-horizontal" method="POST" enctype="multipart/form-data">
		<?php elseif ($this->session->userdata('user_level') == 2 || $this->session->userdata('user_level') == 5): ?>
			<form action="<?=base_url()?>kerja_praktek/daftar_sidang_kp/simpan_sidang" class="form-horizontal" method="POST" enctype="multipart/form-data">
		<?php endif ?>
			<div class="box-body">
				<input type="text" class="hidden" name="sks" id="sks" value="<?=$sks?>">
					<input type="text" class="hidden" name="kp_id" id="kp_id" value="<?=$data_pengajuan->id?>">
				<?php if (!empty($data_daftar)): ?>
					<input type="text" class="hidden" name="id" id="id" value="<?=$data_daftar->id?>">
				<?php endif ?>
				<input type="text" class="hidden" name="base_url" id="base_url" value="<?=base_url()?>kerja_praktek/daftar_sidang_kp/">
				<div class="alert alert-warning alert-sks" style="display:none;">Anda tidak dapat melakukan pengajuan skripsi dikarenakan jumlah SKS anda belum sesuai syarat.</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Program Studi : </label>
					<label class="control-label"><?=$prodi->description?></label>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Judul : </label>
					<label class="control-label"><?=$data_pengajuan->judul?></label>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Tempat : </label>
					<label class="control-label"><?=$data_pengajuan->nama_tempat?></label>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Peserta : </label>
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
				<div class="form-group">
					<label class="col-md-3 control-label">Pembimbing : </label>
					<label class="control-label"><?=$dosen->nama?></label>
				</div>
				<?php if (!empty($data_daftar)): ?>
					<div class="form-group">
						<label class="col-md-3 control-label">Catatan Pembimbing : </label>
						<div class="col-md-4">
							<textarea class="form-control" name="notes" id="notes" rows="4" readonly="readonly"><?=$data_daftar->notes?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Catatan Lain : </label>
						<div class="col-md-4">
							<textarea class="form-control" name="another_notes" id="another_notes" rows="4" readonly="readonly"><?=$data_daftar->another_notes?></textarea>
						</div>
					</div>
				<?php endif ?>
			</div>
			<div class="modal fade" id="setuju" tabindex="-1" role="basic" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <h4 class="modal-title">Tentukan Dosen Penguji</h4>
                        </div>
                        <div class="modal-body"> 
                        	<div class="form-group">
                        		<div class="col-md-12">
                        			<label class="col-md-4 control-label">Dosen Penguji I :</label>
                        			<div class="col-md-6">
                            			<select class="form-control" id="dosen_1">
                            				<?php
                            				$dosen = $this->dosen_m->get();
                            				foreach ($dosen as $data) {
                            					?><option value="<?=$data->id?>"><?=$data->nama?></option><?php
                            				}
                            				?>
                            			</select>
                            		</div>
                        		</div>
                        	</div>
                        	<div class="form-group">
                        		<div class="col-md-12">
                        			<label class="col-md-4 control-label">Dosen Penguji II :</label>
                        			<div class="col-md-6">
                            			<select class="form-control" id="dosen_2">
                            				<?php
                            				$dosen = $this->dosen_m->get();
                            				foreach ($dosen as $data) {
                            					?><option value="<?=$data->id?>"><?=$data->nama?></option><?php
                            				}
                            				?>
                            			</select>
                            		</div>
                        		</div>
                        	</div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-grey btn-close" data-dismiss="modal">Close</button>
                            <a href="#" class="btn btn-primary btn-save">Save changes</a>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
			<div class="box-footer text-right">
		      	<a href="javascript:history.go(-1);" class="btn btn-default btn-md">
					<i class="fa fa-reply"></i> Kembali
				</a>
				<?php if ($this->session->userdata('user_level') == 7 || $this->session->userdata('user_level') == 5): ?>
					<a href="#" class="btn btn-primary btn-md btn-simpan"> 
			      		<i class="fa fa-save"></i>

					<?php if ($this->session->userdata('user_level') == 7): ?>
						Daftar Sidang
					<?php elseif ($this->session->userdata('user_level') == 5): ?>
						Setujui
					<?php endif ?>
			      		
			      	</a>
			      	<button id="save" class="hidden">save</button>
			    <?php elseif ($this->session->userdata('user_level') == 2): ?>
					<a class="btn btn-primary btn-md btn-proses" data-toggle="modal" href="#setuju"> 
		      		<i class="fa fa-save"></i>
			      		Setujui
			      	</a>
				<?php endif ?>
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