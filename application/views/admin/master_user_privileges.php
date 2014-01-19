<table class="table table-striped table-hover" width="100%">
    <thead>
    <tr>
        <th width="5%">No</th>
        <th width="40%">Nama</th>
        <th width="40%">URL</th>
        <th width="5%">Aksi</th>
    </tr>
    </thead>
    <tbody>
    <?php 
    foreach ($privileges as $key => $rows) : ?>
        <tr class="<?= ($key % 2 == 1) ? 'even' : 'odd' ?>">
            <td align="center"><?= (++$key) ?></td>
            <td><?= $rows->nama ?></td>
            <td><?= $rows->url ?></td>
            <td class="aksi">
                <?php
                $check = false;
                $check = in_array($rows->id, $user_priv);
                echo form_checkbox('data[]', $rows->id, $check,'class=check');
                ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

</div>
<?= form_close() ?>