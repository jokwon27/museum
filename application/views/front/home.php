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
      <img src="<?= base_url('assets/img/slide/'.$value->gambar)?>" alt="<?= $value->alt ?>" width="900" height="332">
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
    <h3>Sistem Informasi Geografi</h3>
    <h4>Museum Yogyakarta</h4>
    <br/>
    <p align="justify">"Daerah Istimewa setingkat provinsi di Indonesia yang merupakan peleburan Negara Kesultanan Yogyakarta dan Negara Kadipaten Paku Alaman. Daerah dengan kultur budaya lengkap dengan sejarah menjadikan museum sebagai destinasi wisata yang sangat cocok di sini. Terdapat banyak museum yang dapat dikunungi dan kami menghadirkan sistem informasi geografis museum sebagai sarana pendukung untuk pencarian lokasi museum sebagai tempat tujuan anda"</p>
   
  </div>
</div>

<hr>



<div class="row">
<div class="col-lg-8">
  <?php foreach ($artikel as $key => $val):?>
  <div class="special_div">
  <div class="row" style="margin-bottom:10px;">    
      <h2><?= anchor('artikel/detail/'.$val->url,$val->judul) ?></h2>
      <p>
      <img style="margin:5px;" src="<?= base_url('image_upload/tumbnail_artikel/').'/'.$val->image ?>" width="128" height="100" align="left">
      <?= substr($val->isi, 0, 800).".........." ?></p>      
  </div>
  <div class="row">  
    <a class="btn btn-default btn-xs" href="<?= base_url('artikel/detail').'/'.$val->url?>">Baca Lebih Lanjut &raquo;</a>    
  </div>
  </div>
  <?php endforeach; ?>
</div>

<div class="col-lg-4">
  <div class="well">
            <h4>Artikel Populer</h4>
              <div class="row">
                <div class="col-lg-12">
                  <ul class="list-unstyled">
                    <?php foreach ($artikel_populer as $key => $value): ?>
                      <li><a href="<?= base_url('artikel/detail').'/'.$value->url ?>"><?= $value->judul ?></a></li>
                    <?php endforeach; ?>
                    
                 
                  </ul>
                </div>
              </div>
          </div>
</div>

</div>
