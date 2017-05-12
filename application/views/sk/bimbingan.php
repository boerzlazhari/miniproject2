	<div class="col-md-12">

	<?php if ($this->session->userdata('insert_success')): ?>
	<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Data berhasil disimpan</div>
	<?php endif ?>		

	<div class="box box-primary">
		<div class="box-header with-border">
		    <h3 class="box-title">Form Bimbingan Kerja Praktek</h3>
		    <div class="box-tools pull-right">
		    	<?php if($user_level == 7): ?>
		      	<a class="btn btn-default btn-sm" data-toggle="modal" href="#tambah_bimbingan">
		      		<i class="fa fa-plus"></i>
		      		Tambah Bimbingan
		      	</a>
				<?php endif ?>
		    </div>	  
		</div>
		<div class="box-body">
			<input type="text" class="hidden" name="base_url" id="base_url" value="<?=base_url()?>skripsi/bimbingan_sk/">
			<?php if(!empty($data_sk)): ?>
				<input type="text" class="hidden" name="sk_pengajuan_id" id="sk_pengajuan_id" value="<?=$data_sk->id?>">
			<?php endif ?>
			<table class="table table-striped table-bordered table-hover table-condensed text-center" id="table_bimbingan">
				<thead>
					<tr>
						<th width="4%" class="text-center">No</th>
						<th class="text-center">Tanggal</th>
						<th width="60%" class="text-center">Catatan/Komentar Pembimbing</th>
						<th width="10%" class="text-center">Disetujui</th>
						<?php if($user_level != 7): ?>
						<th width="10%" class="text-center">Action</th>
						<?php endif ?>
					</tr>
				</thead>
				<tbody>
					<?php if (!empty($data_bimbingan)): ?>
					<?php $i = 1;?>
						
						<?php foreach ($data_bimbingan as $data): ?>
							<tr>
								<td class="text-center"><?=$i?></td>
								<td class="text-center"><?=date('d F Y', strtotime($data->tanggal))?></td>
								<td><?=$data->notes?></td>
								<td class="text-center">

									<?php if ($data->status == 1): ?>
										<span class="badge bg-yellow">Menunggu Persetujuan</span>	
									<?php elseif($data->status == 2): ?>
										<span class="badge bg-green">Disetujui</span>	
									<?php endif ?>

								</td>

								<?php if($user_level != 7): ?>
								<td class="text-center"><a href="#" data-id="<?=$data->id?>" class="btn btn-success btn-xs btn-approved"><i class="fa fa-edit"></i></a></td>
								<?php endif ?>
							</tr>
							<?php $i++?>
						<?php endforeach ?>
					
					<?php endif ?>

				</tbody>
			</table>
			<div class="modal fade" id="tambah_bimbingan" tabindex="-1" role="basic" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <h4 class="modal-title">Tambah Bimbingan</h4>
                        </div>
                        <div class="modal-body"> 
                        	<div class="row">
	                        	<div class="form-group">
                        			<label class="col-md-12"><?=date("d M Y")?></label>
	                        	</div>
	                        	<div class="form-group">
                        			<label class="col-md-12">Catatan : </label>
                        			<div class="col-md-12">
                        				<textarea class="form-control" name="catatan" id="catatan" rows="4"></textarea>
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
	</div>
</div>
<script type="text/javascript">
	$("#table_bimbingan").DataTable();
	var base_url = $('#base_url').val();

	$('.btn-simpan').click(function(){
		$.ajax({
            method   : 'POST',
            url      : base_url + 'simpan',
            data     : {sk_pengajuan_id : $('#sk_pengajuan_id').val(), catatan : $("#catatan").val()},
            success : function(){
            	$('.btn-close').click();
            	window.location.replace(base_url);
            }
        });
	});

	$('.btn-approved').click(function(){
		$.ajax({
            method   : 'POST',
            url      : base_url + 'approved',
            data     : {id : $(this).data('id')},
            success : function(){
            	// $('.btn-close').click();
            	window.location.replace(base_url);
            }
        });
	});
</script>