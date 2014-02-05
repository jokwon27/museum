<div class="col-lg-8">
    <h1><?= $artikel->judul ?></h1>
    <hr>
    <p><span class="glyphicon glyphicon-user"></span> Penulis  <?= $artikel->username ?></p>
    <p><span class="glyphicon glyphicon-time"></span> Diposting tanggal  <?= indo_tgl($artikel->waktu) ?></p>
    <p><span class="glyphicon glyphicon-home"></span> Tentang  <?= anchor('nav/museum/'.$artikel->url_museum, $artikel->museum)?></p>
    <hr>
    <p>
        <?= $artikel->isi ?>
    </p>
</div>