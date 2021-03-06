<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">    

    <!-- Bootstrap core CSS -->
    <link href="<?= base_url('assets/bootstrap/css/bootstrap.css')?>" rel="stylesheet">

    <!-- Add custom CSS here -->
    <link href="<?= base_url('assets/css/small-business.css') ?>" rel="stylesheet">
    <!-- JavaScript -->
    
    <script type="text/javascript" src="<?= base_url('assets/js/jquery-1.8.3.js') ?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>
    <link rel="stylesheet" href="<?= base_url('assets/font-awesome/css/font-awesome.min.css')?>">
    
    <script type="text/javascript" src="<?= base_url('assets/pnotify/jquery.pnotify.min.js') ?>"></script>

    <link href="<?= base_url('assets/pnotify/jquery.pnotify.default.css') ?>" media="all" rel="stylesheet" type="text/css" />
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <!-- You'll want to use a responsive image option so this logo looks good on devices - I recommend using something like retina.js (do a quick Google search for it and you'll find it) -->
          <a class="navbar-brand logo-nav" href="<?= base_url()?>"><img src="<?= base_url('assets/img/maps-icon.png')?>" width="64" height="64"> <b style="font-size:25px;">SIG Museum Yogyakarta</b></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav navbar-right">
            <li <?= ($page == 'home')?'class="active"':''?> ><?= anchor('/','Home')?></li>
            <li <?= ($page == 'museum')?'class="active"':''?> ><?= anchor('/museum','Museum')?></li>
            <li <?= ($page == 'artikel')?'class="active"':''?> ><?= anchor('/artikel','Artikel')?></li>
            <li <?= ($page == 'trans_jogja')?'class="active"':''?> ><?= anchor('/trans_jogja','Trans Jogja')?></li>
            <li <?= ($page == 'peta')?'class="active"':''?> ><?= anchor('/peta','Peta')?></li>
          </ul>
        </div><!-- /.navbar-collapse -->

      </div><!-- /.container -->
    </nav>

    <div class="container" style="min-height:900px;">

      <?php         
            $this->load->view('front/'.$page);
      ?>
      
      
      <footer style="background:#ffff;">
        <hr>
        <div class="row">
          <div class="col-lg-12">
            <p>Copyright &copy;2014</p>
          </div>
        </div>
      </footer>

    </div><!-- /.container -->

    

  </body>
</html>