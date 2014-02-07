<script type="text/javascript">
  $(function(){
    $('.carousel').carousel({
      interval: 3000
    });
  });
</script>
<title><?= $title ?></title>
<div class="row">
  <div class="col-lg-8">
   <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
     <?php foreach($slide as $key => $value):?>
      <li data-target="#carousel-example-generic" data-slide-to="<?= $key ?>" class=" <?= ($key == 0)?'active':'' ?>"></li>
     <?php endforeach;?>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    <?php foreach($slide as $key => $value):?>
    <div class="item <?= ($key == 0)?'active':'' ?>">
      <img src="<?= base_url('assets/img/slide/'.$value->gambar)?>" alt="<?= $value->alt ?>">
      <div class="carousel-caption">
       <h3><?= $value->judul ?></h3>
       <p><?= $value->deskripsi ?></p>
      </div>
    </div>
    <?php endforeach;?>

</div>



<!-- Controls -->
<a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
  <span class="glyphicon glyphicon-chevron-left"></span>
</a>
<a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
  <span class="glyphicon glyphicon-chevron-right"></span>
</a>
</div>
  </div>
  <div class="col-lg-4">
    <h2>Sistem Informasi Museum</h2>
    <h4>Daerah Istimewa Yogyakarta</h4>
    <br/>
    <p>Deskripsi...... bla bla bla</p>
   
  </div>
</div>

<hr>

<div class="row">
  <div class="col-lg-12">
    <div class="well text-center">
      <marquee>Welcome!!!</marquee>
    </div>
  </div>
</div>

<div class="row">
<div class="col-lg-8">
  <?php foreach ($artikel as $key => $val):?>
  <div class="row">    
      <h2><?= anchor('artikel/detail/'.$val->url,$val->judul) ?></h2>
      <p>
      <img style="display:block-inline;" src="<?= base_url('image_upload/tumbnail_artikel/').'/'.$val->image ?>" width="128" height="100" align="left">
      <?= substr($val->isi, 0) ?></p>
      <a class="btn btn-default btn-xs" href="<?= base_url('artikel/detail').'/'.$val->url?>">Baca Lebih Lanjut &raquo;</a>    
  </div>
  <?php endforeach; ?>
</div>

<div class="col-lg-4">
  <div class="well">
    <h4>Panel</h4>
    
  </div>
</div>

</div>
