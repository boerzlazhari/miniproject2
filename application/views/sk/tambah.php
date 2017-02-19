<div class="col-md-12">
	<div class="box box-primary">
		<div class="box-header with-border">
		    <h3 class="box-title">Tambah Pengajuan Skripsi</h3>
		    <div class="box-tools pull-right">
		      	
		    </div>	  
		</div>
		<form action="<?=base_url()?>skripsi/pengajuan_sk/simpan" class="form-horizontal" method="POST" enctype="multipart/form-data">
			<div class="box-body">
				<input type="text" class="hidden" name="sks" id="sks" value="<?=$sks?>">
				<div class="alert alert-warning alert-sks" style="display:none;">Anda tidak dapat melakukan pengajuan skripsi dikarenakan jumlah SKS anda belum sesuai syarat.</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Tanggal Pengajuan : </label>
					<div class="col-md-3">
						<div class="input-group date">
			                <div class="input-group-addon">
			                	<i class="fa fa-calendar"></i>
			                </div>
			                <input name="tgl_pengajuan" type="text" value="<?=date('d F Y')?>" class="form-control pull-right" id="datepicker">
		                </div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Judul : </label>
					<div class="col-md-4">
						<textarea class="form-control" name="judul" id="judul" rows="5"></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Upload Transkrip Nilai : </label>
					<div class="col-md-4">
						<div class="success-upload" style="display:none;">
							<div id="files" class="files"></div>
							<div id="progress" class="progress sm">
						        <div class="progress-bar progress-bar-success"></div>
						    </div>
						</div>
						<span class="btn btn-sm btn-default fileinput-button">
					        <span class="btn-upload">Choose File</span>
					        <input id="fileupload_nilai" type="file" name="fileupload_nilai">
					    </span>
				        <input id="fileupload_nilai_text" class="hidden" name="fileupload_nilai">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Upload Bukti Transfer : </label>
					<div class="col-md-4">
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
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Upload Proposal : </label>
					<div class="col-md-4">
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
					</div>
					<!-- <div id="files" class="files"></div> -->
				</div>
			</div>
			<div class="box-footer text-right">
		      	<a href="javascript:history.go(-1);" class="btn btn-default btn-md">
					<i class="fa fa-reply"></i> Kembali
				</a>
				<a href="#" class="btn btn-primary btn-md btn-simpan"> 
		      		<i class="fa fa-save"></i>
		      		Simpan Pengajuan
		      	</a>
		      	<button id="save" class="hidden">save</button>
			</div>
		</form>
	</div>
</div>

<script type="text/javascript">

	if ($('#sks').val() < 138) {
		$('.alert-sks').show();
		$('.btn-simpan').hide();
		$('input, textarea, .fileinput-button ').attr('disabled', true);
	}

	$('.btn-simpan').click(function(){
		bootbox.confirm('Apakah anda yakin akan menyimpan pengajuan ini?', function(result) {
			if (result == true) {
				$('#save').click();
			}
		});
	});
	
	$('#datepicker').datepicker({
    	autoclose: true,
        format: "dd MM yyyy",                         
    });

    $('#fileupload_nilai').fileupload({
        url: 'do_upload/1',
        dataType: 'json',
        done: function (e, data) {
            $('<p/>').text(data.result.upload_data.client_name).appendTo('#files');
            $('.btn-upload').text('Change File');
            $('#fileupload_nilai_text').val(data.result.upload_data.file_name);
        },
        progressall: function (e, data) {
        	$('.success-upload').show();
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progress .progress-bar').css(
                'width',
                progress + '%'
            );
        }
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