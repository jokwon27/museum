<h4>
    Halaman <?= $page ?> dari <?= (ceil($jumlah / $limit) == 0) ? 1 : ceil($jumlah / $limit) ?> (Total <?= $jumlah ?> data )
</h4>
<table class="table table-striped table-hover" width="100%">
	<tr>
		<th width="5%">No.</th>
		<th>Nama Rute</th>
		<th width="15%">Rute</th>
		<th width="30%"></th>
	</tr>
	<?php foreach ($data as $key => $value):?>
	<tr>
		<td><?= (++$key + (($page - 1) * $limit)) ?></td>
		<td><?= $value->nama ?></td>
		<td><?= $value->rute ?></td>
		<td align="right">
			<button type="button" class="btn btn-default btn-xs" onclick="detail_rute('<?= $value->id ?>')">
				<span class="fa fa-eye"></span> Detail Rute
			</button>
			<button type="button" class="btn btn-default btn-xs" onclick="edit_trans('<?= $value->id ?>')">
				<span class="fa fa-pencil"></span> Edit Rute
			</button>
			<button type="button" class="btn btn-default btn-xs" onclick="delete_trans('<?= $value->id ?>')">
				<span class="fa fa-trash-o"></span> Hapus
			</button>
		</td>
	</tr>
	<?php endforeach; ?>
</table>
<?= $pagination ?>