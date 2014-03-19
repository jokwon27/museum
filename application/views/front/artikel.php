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
  <div class="well" style="min-height:550px;">
    <h4>Arsip</h4>
    <table id="table_archive" class="table">
      <?php foreach ($archive as $key => $value): ?>
      <tr data-tt-id="<?= $key ?>">
        <td><b><?= $value->tahun ?> (<?= $value->jumlah ?>)</b></td>
      </tr>
      <?php $num = 0; foreach ($value->list_bulan as $key2 => $val): ?>
        <tr data-tt-id="<?= $key."bulan".$num ?>" data-tt-parent-id="<?= $key ?>">
          <td><b><?= $val->nama_bulan ?> (<?= $val->jumlah ?>)</b></td>
        </tr>
          <?php $num2 = 0; foreach ($val->list_artikel as $key2 => $v): ?>
          <tr data-tt-id="<?= $key."artikel".$num2 ?>" data-tt-parent-id="<?= $key."bulan".$num ?>">
            <td><?= anchor('artikel/detail/'.$v->url,$v->judul) ?></td>
          </tr>
          <?php $num2++; endforeach; ?>
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