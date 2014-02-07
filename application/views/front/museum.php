<title><?= $title ?></title>
<div class="row">
	<div class="col-lg-8">
		 <?php foreach ($museum as $key => $val):?>
		  <div class="row">    
		      <h2><?= anchor('museum/detail/'.$val->url,$val->nama) ?></h2>
		      <img style="display:block-inline;" src="<?= base_url('image_upload/tumbnail_museum/').'/'.$val->image ?>" width="128" height="100">
		      <p><?= substr($val->keterangan, 0, 800).".........." ?></p>
		      <a class="btn btn-default btn-xs" href="<?= base_url('museum/detail').'/'.$val->url?>">Baca Lebih Lanjut &raquo;</a>    
		  </div>
		  <?php endforeach; ?>
		  <?= $pagination ?>
	</div>

	<div class="col-lg-4">
	<div class="well">
	  <h4>Panel</h4>
	  
	</div><!-- /well -->

	</div>

</div>