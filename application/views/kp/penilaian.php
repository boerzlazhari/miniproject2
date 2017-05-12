<div class="col-md-12">

	<?php if ($this->session->userdata('insert_success')): ?>
	<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Data berhasil disimpan</div>
	<?php endif ?>		

	<div class="box box-primary">
		<div class="box-header with-border">
		    <h3 class="box-title">Daftar Penilaian Sidang Kerja Praktek</h3>  
		</div>
		<div class="box-body">
			<table class="table table-striped table-bordered table-hover table-condensed text-center" id="table_penilaian">
				<thead>
					<tr>
						<th width="4%" class="text-center">No</th>
						<th class="text-center">Mahasiswa</th>
						<th width="40%" class="text-center">Judul</th>
						<th width="10%" class="text-center">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php if (!empty($data_penilaian)): ?>
					<?php $i = 1?>
						
						<?php foreach ($data_penilaian as $data): ?>
							<tr>
								<td class="text-center"><?=$i?></td>
								<td><?=$data->nama?></td>
								<td><?=$data->judul?></td>
								<td class="text-center"><a href="penilaian_kp/daftar_penilaian/<?=$data->kp_id?>/<?=$data->id?>/<?=$data->dosen_id?>" class="btn btn-success btn-xs btn-simpan"><i class="fa fa-edit"></i></a></td>
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
	 $("#table_penilaian").DataTable();
</script>