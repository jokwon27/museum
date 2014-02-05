<title><?= $artikel->judul ?></title>
<div class="row">
	  <div class="col-lg-8">
	    <h1><?= anchor('artikel/detail/'.$artikel->url,$artikel->judul) ?></h1>
	    <hr>
	    <p><span class="glyphicon glyphicon-user"></span> Penulis  <?= $artikel->username ?></p>
	    <p><span class="glyphicon glyphicon-time"></span> Diposting tanggal  <?= indo_tgl($artikel->waktu) ?></p>
	    <p><span class="fa fa-building-o"></span> Tentang  <?= anchor('nav/museum/'.$artikel->url_museum, $artikel->museum)?></p>
	    <hr>
	    <p>
	        <?= $artikel->isi ?>
	    </p>
	  </div>
  
  	<div class="col-lg-4">
	    <div class="well">
	      <h4>Panel</h4>
	      
	    </div><!-- /well -->
	</div>
</div>