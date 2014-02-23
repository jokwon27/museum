<h4>
    Halaman <?= $page ?> dari <?= (ceil($jumlah / $limit) == 0) ? 1 : ceil($jumlah / $limit) ?> (Total <?= $jumlah ?> data )
</h4>
<table class="table table-striped table-hover" width="100%">
	<tr>
		<th width="5%">No.</th>
		<th width="30%">Shelter Awal</th>
		<th width="30%">Shelter Tujuan</th>
		<th width="10%"></th>
		<th width="25%"></th>
	</tr>
	<?php foreach ($data as $key => $value):?>
	<tr>
		<td><?= (++$key + (($page - 1) * $limit)) ?></td>
		<td><?= $value->shelter_awal ?></td>
		<td><?= $value->shelter_tujuan ?></td>
		<td><?= ''?></td>
		<td align="right">
			<button type="button" class="btn btn-default btn-xs" onclick="edit_relasi_shelter('<?= $value->id ?>')">
				<span class="fa fa-pencil"></span> Edit Relasi Shelter
			</button>
			<button type="button" class="btn btn-default btn-xs" onclick="delete_relasi_shelter('<?= $value->id ?>')">
				<span class="fa fa-trash-o"></span> Hapus
			</button>
		</td>
	</tr>
	<?php endforeach; ?>
</table>
<?= $pagination ?>