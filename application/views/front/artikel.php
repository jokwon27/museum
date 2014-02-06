<title><?= $title ?></title>
<div class="row">
<div class="col-lg-8">
  <?php foreach ($artikel as $key => $val):?>
  <div class="row">    
      <h2><?= anchor('artikel/detail/'.$val->url,$val->judul) ?></h2>
      <img style="display:block-inline;" src="<?= base_url('image_upload/tumbnail_artikel/').'/'.$val->image ?>" width="128" height="100">
      <p><?= substr($val->isi, 0) ?></p>
      <a class="btn btn-default" href="<?= base_url('artikel/detail').'/'.$val->url?>">Baca Lebih Lanjut &raquo;</a>    
  </div>
  <?php endforeach; ?>
</div>

<div class="col-lg-4">
  <div class="well">
    <h4>Panel</h4>
    
  </div>
</div>

</div>