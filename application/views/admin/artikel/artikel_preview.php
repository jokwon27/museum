<div class="col-lg-8">
    <h1><?= anchor('artikel/detail/'.$artikel->url,$artikel->judul) ?></h1>
    <hr>
    <p><span class="glyphicon glyphicon-user"></span> Penulis  <?= $artikel->username ?></p>
    <p><span class="glyphicon glyphicon-time"></span> Diposting tanggal  <?= indo_tgl($artikel->waktu) ?></p>
    <p><span class="fa fa-building-o"></span> Tentang  <?= anchor('museum/detail/'.$artikel->url_museum, $artikel->museum)?></p>
    <hr>
    <p>
    	<img style="margin:5px;" src="<?= base_url('image_upload/tumbnail_artikel/').'/'.$artikel->image ?>" width="128" height="100" align="left">
        <?= $artikel->isi ?>
    </p>
</div>