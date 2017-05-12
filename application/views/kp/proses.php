<div class="col-md-12">
	<div class="box box-primary">
		<div class="box-header with-border">
		    <h3 class="box-title">Pengajuan Kerja Praktek</h3>
		    <div class="box-tools pull-right">
		      	
		    </div>	  
		</div>
		<form action="<?=base_url()?>kerja_praktek/pengajuan_kp/simpan" class="form-horizontal" method="POST" enctype="multipart/form-data">
			<div class="box-body">
				<input type="text" class="hidden" name="id" id="id" value="<?=$data_pengajuan->id?>">
				<input type="text" class="hidden" name="base_url" id="base_url" value="<?=base_url()?>kerja_praktek/pengajuan_kp/">
				<div class="alert alert-warning alert-sks" style="display:none;">Anda tidak dapat melakukan pengajuan skripsi dikarenakan jumlah SKS anda belum sesuai syarat.</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Tanggal Pengajuan : </label>
					<label class="control-label"><?=date('d F Y', strtotime($data_pengajuan->tanggal_pengajuan))?></label>
					<!-- <div class="col-md-3">
						<div class="input-group date">
			                <div class="input-group-addon">
			                	<i class="fa fa-calendar"></i>
			                </div>
			                <input name="tgl_pengajuan" type="text" value="<?=date('d F Y')?>" class="form-control pull-right" id="datepicker">
		                </div>
					</div> -->
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Tempat : </label>
					<label class="control-label"><?=$data_pengajuan->nama_tempat?></label>
					<!-- <div class="col-md-4">
						<textarea class="form-control" name="tempat" id="tempat" rows="4" readonly="readonly"></textarea>
					</div> -->
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Judul : </label>
					<label class="control-label"><?=$data_pengajuan->judul?></label>
					<!-- <div class="col-md-4">
						<textarea class="form-control" name="judul" id="judul" rows="4"></textarea>
					</div> -->
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Upload Bukti Transfer : </label>
					<?php if($data_pengajuan->bukti_tp != '') : ?>
						<label class="control-label">Terlampir</label>
					<?php endif ?>
					<!-- <div class="col-md-4">
						<div class="success-upload2" style="display:none;">
							<div id="files2" class="files"></div>
							<div id="progress2" class="progress sm">
						        <div class="progress-bar progress-bar-success"></div>
						    </div>
						</div>
						<span class="btn btn-sm btn-default fileinput-button">
					        <span class="btn-upload2">Choose File</span>
					        <input id="fileupload_transfer" type="file" name="fileupload_transfer">
					    </span>
				        <input id="fileupload_transfer_text" class="hidden" name="fileupload_transfer">
					</div> -->
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Upload Proposal : </label>
					<?php if($data_pengajuan->bukti_tp != '') : ?>
						<label class="control-label">Terlampir</label>
					<?php endif ?>
					<!-- <div class="col-md-4">
						<div class="success-upload3" style="display:none;">
							<div id="files3" class="files"></div>
							<div id="progress3" class="progress sm">
						        <div class="progress-bar progress-bar-success"></div>
						    </div>
						</div>
						<span class="btn btn-sm btn-default fileinput-button">
					        <span class="btn-upload3">Choose File</span>
					        <input id="fileupload_proposal" type="file" name="fileupload_proposal">
					    </span>
				        <input id="fileupload_proposal_text" class="hidden" name="fileupload_proposal">
					</div> -->
					<!-- <div id="files" class="files"></div> -->
				</div>

				<div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                <h4 class="modal-title">Alasan Penolakan</h4>
                            </div>
                            <div class="modal-body"> 
									<textarea class="form-control" name="reason" id="reason" rows="4"></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-grey btn-close" data-dismiss="modal">Close</button>
                                <a href="#" class="btn btn-primary btn-tolak">Save changes</a>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->

                <div class="modal fade" id="setuju" tabindex="-1" role="basic" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                <h4 class="modal-title">Tentukan Dosen Pembimbing</h4>
                            </div>
                            <div class="modal-body"> 
                            	<div class="form-group">
                            		<div class="col-md-12">
                            			<label class="col-md-4 control-label">Dosen Pembimbing :</label>
                            			<div class="col-md-6">
	                            			<select class="form-control" id="dosen">
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
                                <a href="#" class="btn btn-primary btn-simpan">Save changes</a>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
			</div>
			<div class="box-footer text-right">
		      	<a href="javascript:history.go(-1);" class="btn btn-default btn-md btn_back">
					<i class="fa fa-reply"></i> Kembali
				</a>
				<a class="btn btn-danger btn-md btn-reject" data-toggle="modal" href="#basic"> 
		      		<i class="fa fa-close"></i>
		      		Tolak Pengajuan
		      	</a>
				<a class="btn btn-primary btn-md btn-proses" data-toggle="modal" href="#setuju"> 
		      		<i class="fa fa-save"></i>
		      		Proses Pengajuan
		      	</a>
		      	<button id="save" class="hidden">save</button>
			</div>
		</form>
	</div>
</div>

<script type="text/javascript">
	var base_url = $('#base_url').val();

	$('.btn-simpan').click(function(){
		// bootbox.confirm('Apakah anda yakin akan menyetujui pengajuan ini?', function(result) {
		// 	if (result == true) {
				$.ajax({
		            method   : 'POST',
		            url      : base_url + 'approved',
		            data     : {id : $('#id').val(), dosen_id : $("#dosen option:selected").val()},
		            success : function(){
		            	$('.btn-close').click();
		            	window.location.replace(base_url);
		            }
		        });
		// 	}
		// });
	});

	$('.btn-tolak').click(function(){
		// alert($('#reason').val());
		$.ajax({
            method   : 'POST',
            url      : base_url + 'update_reason',
            data     : {id : $('#id').val(), reason : $('#reason').val()},
            success : function(){
            	$('.btn-close').click();
            	window.location.replace(base_url);
            }
        });
	});
	
	$('#datepicker').datepicker({
    	autoclose: true,
        format: "dd MM yyyy",                         
    });

    $('#fileupload_transfer').fileupload({
        url: 'do_upload/2',
        dataType: 'json',
        done: function (e, data) {
            $('<p/>').text(data.result.upload_data.client_name).appendTo('#files2');
            $('.btn-upload2').text('Change File');
            $('#fileupload_transfer_text').val(data.result.upload_data.file_name);
        },
        progressall: function (e, data) {
        	$('.success-upload2').show();
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progress2 .progress-bar').css(
                'width',
                progress + '%'
            );
        }
    });

    $('#fileupload_proposal').fileupload({
        url: 'do_upload/3',
        dataType: 'json',
        done: function (e, data) {
            $('<p/>').text(data.result.upload_data.client_name).appendTo('#files3');
            $('.btn-upload3').text('Change File');
            $('#fileupload_proposal_text').val(data.result.upload_data.file_name);
        },
        progressall: function (e, data) {
        	$('.success-upload3').show();
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progress3 .progress-bar').css(
                'width',
                progress + '%'
            );
        }
    });

</script>