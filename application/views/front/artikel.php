<link href="<?= base_url('assets/css/jquery.treetable.css') ?>" rel="stylesheet">
<link href="<?= base_url('assets/css/jquery.treetable.theme.default.css') ?>" rel="stylesheet">
<script type="text/javascript" src="<?= base_url('assets/js/jquery.treetable.js') ?>"></script>

<title><?= $title ?></title>
<div class="row">
<div class="col-lg-8 special_div">
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
    <h4>Arsip</h4>
    <table id="table_archive" class="table">
      <?php foreach ($archive as $key => $value): ?>
      <tr data-tt-id="<?= $key ?>">
        <td><b><?= $value->nama_bulan ?> (<?= $value->jumlah ?>)</b></td>
      </tr>
      <?php $num = 0; foreach ($value->list_artikel as $key2 => $val): ?>
        <tr data-tt-id="<?= $key."leaf".$num ?>" data-tt-parent-id="<?= $key ?>">
          <td><?= anchor('artikel/detail/'.$val->url,$val->judul) ?></td>
        </tr>
      <?php $num++; endforeach; ?>
    <?php endforeach; ?>
      
    </table>
    
  </div>
</div>

</div>

<script type="text/javascript">
  $(function(){
    $("#table_archive").treetable({expandable:true}); 
  });
</script>