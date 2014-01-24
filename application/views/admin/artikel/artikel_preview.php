<div class="col-lg-8">

    <h1><?= $artikel->judul ?></h1>
    <p class="lead">Penulis <b><?= $artikel->username?></b>
    </p>
    <hr>
    <p><span class="glyphicon glyphicon-time"></span> Diposting tanggal  <?= indo_tgl($artikel->waktu) ?></p>
    <p><span class="fa fa-building-o"></span> Tentang  <?= $artikel->museum ?></p>
    <hr>
    <p>
        <?= $artikel->isi ?>
    </p>


</div>