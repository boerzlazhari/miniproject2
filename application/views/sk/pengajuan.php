<div class="col-md-12">

	<?php if ($this->session->userdata('insert_success')): ?>
	<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Data berhasil disimpan</div>
	<?php endif ?>		

	<div class="box box-primary">
		<div class="box-header with-border">
		    <h3 class="box-title">Pengajuan Skripsi</h3>
		    <div class="box-tools pull-right">

		    	<?php if (empty($data_pengajuan)): ?>
		      	<a href="pengajuan_sk/tambah" class="btn btn-default btn-sm">
		      		<i class="fa fa-plus"></i>
		      		Tambah Pengajuan
		      	</a>
		    	<?php endif ?>

		    </div>	  
		</div>
		<div class="box-body">
			<table class="table table-striped table-bordered table-hover table-condensed" id="table_pengajuan">
				<thead>
					<tr>
						<th width="12%" class="text-center">Tanggal Pengajuan</th>
						<th width="50%" class="text-center">Judul Skripsi</th>
						<th width="10%" class="text-center">Status</th>
						<th width="15%" class="text-center">Tanggal Wawancara</th>
					</tr>
				</thead>
				<tbody>

					<?php if (!empty($data_pengajuan)): ?>
						
						<?php foreach ($data_pengajuan as $data): ?>
							<tr>
								<td class="text-center"><?=date('d F Y', strtotime($data['tanggal_pengajuan']))?></td>
								<td><?=$data['judul']?></td>
								<td class="text-center">

									<?php if ($data['status'] == 1): ?>
										<span class="badge bg-yellow">Persetujuan Dosen Wali</span>	
									<?php elseif($data['status'] == 2): ?>
										<span class="badge bg-yellow">Persetujuan BAAK</span>	
									<?php elseif($data['status'] == 3): ?>
										<span class="badge bg-yellow">Persetujuan Ketua Program Studi</span>	
									<?php elseif($data['status'] == 4): ?>
										<span class="badge bg-blue">Proses Wawancara</span>	
									<?php elseif($data['status'] == 5): ?>
										<span class="badge bg-green">Disetujui</span>	
									<?php elseif($data['status'] == 6): ?>
										<span class="badge bg-red">Ditolak</span>	
									<?php endif ?>

								</td>
								<td class="text-center"> <?=($data['tanggal_wawancara']) ? date('d F Y', strtotime($data['tanggal_wawancara'])) : '-'?> </td>
							</tr>
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