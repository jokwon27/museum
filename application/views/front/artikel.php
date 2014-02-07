<title><?= $title ?></title>
<div class="row">
<div class="col-lg-8">
  <?php foreach ($artikel as $key => $val):?>
  <div class="row" style="margin-bottom:10px;">    
      <h2><?= anchor('artikel/detail/'.$val->url,$val->judul) ?></h2>
      <p>
      <img style="margin:5px;" src="<?= base_url('image_upload/tumbnail_artikel/').'/'.$val->image ?>" width="128" height="100" align="left">
      <?= substr($val->isi, 0, 800).".........." ?></p>      
  </div>
  <div class="row">  
    <a class="btn btn-default btn-xs" href="<?= base_url('artikel/detail').'/'.$val->url?>">Baca Lebih Lanjut &raquo;</a>    
  </div>
<?php endforeach; ?>
<?= $pagination ?>
</div>

<div class="col-lg-4">
  <div class="well">
    <h4>Panel</h4>
    
  </div>
</div>

</div>