<div class="col-md-12">

	<?php if ($this->session->userdata('insert_success')): ?>
	<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Data berhasil disimpan</div>
	<?php endif ?>		

	<div class="box box-primary">
		<div class="box-header with-border">
		    <h3 class="box-title">Daftar Pengajuan Kerja Praktek</h3>
		    <div class="box-tools pull-right">

		    	<?php if (empty($data_pengajuan) && $count == 0 || !empty($data_pengajuan) && $count == 0): ?>
		      	<a href="pengajuan_kp/tambah" class="btn btn-default btn-sm">
		      		<i class="fa fa-plus"></i>
		      		Tambah Pengajuan
		      	</a>
		    	<?php endif ?>

		    </div>	  
		</div>
		<div class="box-body">
			<table class="table table-striped table-bordered table-hover table-condensed text-center" id="table_pengajuan">
				<thead>
					<tr>
						<th width="4%" class="text-center">#</th>
						<th class="text-center">Tanggal Pengajuan</th>
						<th width="20%" class="text-center">Tempat</th>
						<th width="40%" class="text-center">Judul</th>
						<th width="10%" class="text-center">Status</th>

						<?php if($user_level != 5): ?>
						<th width="10%" class="text-center">Action</th>
						<?php endif ?>

					</tr>
				</thead>
				<tbody>
					<?php if (!empty($data_pengajuan)): ?>
					<?php $i = 1?>
						
						<?php foreach ($data_pengajuan as $data): ?>
							<tr>
								<td class="text-center"><?=$i?></td>
								<td class="text-center"><?=date('d F Y', strtotime($data->tanggal_pengajuan))?></td>
								<td><?=$data->nama_tempat?></td>
								<td><?=$data->judul?></td>
								<td class="text-center">

									<?php if ($data->status == 1): ?>
										<span class="badge bg-yellow">Menunggu Persetujuan</span>	
									<?php elseif($data->status == 2): ?>
										<span class="badge bg-green">Disetujui</span>	
									<?php elseif($data->status == 3): ?>
										<span class="badge bg-red">Ditolak</span>	
									<?php endif ?>

								</td>

								<?php if($user_level != 5): ?>
								<td class="text-center"><a href="proses/<?=$data->id?>" class="btn btn-success btn-xs btn-simpan"><i class="fa fa-edit"></i></a></td>
								<?php endif ?>
							</tr>
							<?php $i++?>
						<?php endforeach ?>
					
					<?php endif ?>

				</tbody>
			</table>
		</div>
	</div>
</div>
<script type="text/javascript">
	 $("#table_pengajuan").DataTable();
</script>