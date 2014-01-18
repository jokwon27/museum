<h4>
    Halaman <?= $page ?> dari <?= (ceil($jumlah / $limit) == 0) ? 1 : ceil($jumlah / $limit) ?> (Total <?= $jumlah ?> data )
</h4>
<table class="table table-striped" width="50%">
	<tr>
		<th width="10%">No.</th>
		<th>Username</th>
		<th width="30%"></th>
	</tr>
	<?php foreach ($data as $key => $value):?>
	<tr>
		<td><?= (++$key + (($page - 1) * $limit)) ?></td>
		<td><?= $value->username?></td>
		<td>
			<button type="button" class="btn btn-default btn-xs">
				<span class="fa fa-pencil"></span> Edit
			</button>
			<button type="button" class="btn btn-default btn-xs" onclick="delete_user('<?= $value->id ?>')">
				<span class="fa fa-trash-o"></span> Hapus
			</button>
		</td>
	</tr>
	<?php endforeach; ?>
</table>

<?= $pagination ?>