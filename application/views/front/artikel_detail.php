<title><?= $artikel->judul ?></title>
<div class="row">
	  <div class="col-lg-8">
	    <h1><?= anchor('artikel/detail/'.$artikel->url,$artikel->judul) ?></h1>
	    <hr>
	    <p><span class="glyphicon glyphicon-user"></span> Penulis  <?= $artikel->username ?></p>
	    <p><span class="glyphicon glyphicon-time"></span> Diposting tanggal  <?= indo_tgl($artikel->waktu) ?></p>
	    
	    <hr>
	    <p>
	    	<img style="margin:5px;" src="<?= base_url('image_upload/tumbnail_artikel/').'/'.$artikel->image ?>" width="128" height="100" align="left">
	        <?= $artikel->isi ?>
	    </p>
	  </div>
  
  	<div class="col-lg-4">
	    <div class="well">
	      <h4>Panel</h4>
	      
	    </div><!-- /well -->
	</div>
</div>