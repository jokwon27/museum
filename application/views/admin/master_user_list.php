<table class="table table-striped" width="50%">
	<tr>
		<th width="10%">No.</th>
		<th>Username</th>
	</tr>
	<?php foreach ($data as $key => $value):?>
	<tr>
		<td><?= (++$key + (($page - 1) * $limit)) ?></td>
		<td><?= $value->username?></td>
	</tr>
	<?php endforeach; ?>
</table>