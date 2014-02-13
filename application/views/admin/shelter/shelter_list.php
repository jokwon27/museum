<h4>
    Halaman <?= $page ?> dari <?= (ceil($jumlah / $limit) == 0) ? 1 : ceil($jumlah / $limit) ?> (Total <?= $jumlah ?> data )
</h4>
<table class="table table-striped table-hover" width="100%">
	<tr>
		<th width="5%">No.</th>
		<th width="40%">Nama Shelter</th>
		<th width="15%">Longitude</th>
		<th width="15%">Latitude</th>
		<th width="25%"></th>
	</tr>
	<?php foreach ($data as $key => $value):?>
	<tr>
		<td><?= (++$key + (($page - 1) * $limit)) ?></td>
		<td><?= $value->nama ?></td>
		<td><?= $value->longitude ?></td>
		<td><?= $value->latitude ?></td>
		<td align="right">
			<button type="button" class="btn btn-default btn-xs" onclick="edit_shelter('<?= $value->id ?>')">
				<span class="fa fa-pencil"></span> Edit Shelter
			</button>
			<button type="button" class="btn btn-default btn-xs" onclick="delete_shelter('<?= $value->id ?>')">
				<span class="fa fa-trash-o"></span> Hapus
			</button>
		</td>
	</tr>
	<?php endforeach; ?>
</table>
<?= $pagination ?>