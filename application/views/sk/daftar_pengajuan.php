<div class="col-md-12">

	<div class="box box-primary">
		<div class="box-header with-border">
		    <h3 class="box-title">Daftar Pengajuan Skripsi</h3>
		    <div class="box-tools pull-right">

		    </div>	  
		</div>
		<div class="box-body">
			<table class="table table-striped table-bordered table-hover table-condensed" id="table_pengajuan">
				<thead>
					<tr>
						<th width="4%" class="text-center">#</th>
						<th width="12%" class="text-center">NIM</th>
						<th width="12%" class="text-center">Nama</th>
						<th width="50%" class="text-center">Judul Skripsi</th>
						<th width="10%" class="text-center">Action</th>
					</tr>
				</thead>
				<tbody>

					<?php if (!empty($data_pengajuan)): ?>
						
						<?php foreach ($data_pengajuan as $data): ?>
							<tr>
								<td class="text-center"><?=$data->id?></td>
								<td class="text-center"><?=$data->nim?></td>
								<td class="text-left"><?=$data->nama?></td>
								<td><?=$data->judul?></td>
								<td class="text-center">
									<a href="<?=base_url()?>skripsi/daftar_pengajuan_sk/proses/<?=$data->id?>" title="Proses" class="btn btn-xs btn-success"><i class="fa fa-gears"></i></a>

								</td>
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