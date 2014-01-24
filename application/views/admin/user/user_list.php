<h4>
    Halaman <?= $page ?> dari <?= (ceil($jumlah / $limit) == 0) ? 1 : ceil($jumlah / $limit) ?> (Total <?= $jumlah ?> data )
</h4>
<table class="table table-striped table-hover" width="100%">
	<tr>
		<th width="10%">No.</th>
		<th>Username</th>
		<th width="40%"></th>
	</tr>
	<?php foreach ($data as $key => $value):?>
	<tr>
		<td><?= (++$key + (($page - 1) * $limit)) ?></td>
		<td><?= $value->username?></td>
		<td align="right">
			<button type="button" class="btn btn-default btn-xs" onclick="edit_privileges_user('<?= $value->id ?>')">
				<span class="fa fa-pencil"></span> Edit Privileges
			</button>
			<button type="button" class="btn btn-default btn-xs" onclick="edit_user('<?= $value->id ?>', '<?= $value->username ?>')">
				<span class="fa fa-pencil"></span> Edit Akun
			</button>
			<button type="button" class="btn btn-default btn-xs" onclick="delete_user('<?= $value->id ?>')">
				<span class="fa fa-trash-o"></span> Hapus
			</button>
		</td>
	</tr>
	<?php endforeach; ?>
</table>

<?= $pagination ?>