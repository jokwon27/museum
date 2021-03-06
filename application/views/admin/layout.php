<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv='cache-control' content='no-cache'>
    <meta http-equiv='cache-control' content='no-store'>
    <meta http-equiv='expires' content='0'>
    <meta http-equiv='pragma' content='no-cache'>

    <title>Dashboard - Admin</title>

       <!-- Bootstrap core CSS -->
    <link href="<?= base_url('assets/bootstrap/css/bootstrap.css')?>" rel="stylesheet">
    <link href="<?= base_url('assets/bootstrap/css/bootstrap-dialog.css')?>" rel="stylesheet">
    <!-- Add custom CSS here -->
    <link href="<?= base_url('assets/css/sb-admin.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/jquery.autocomplete.css') ?>" rel="stylesheet">
    <!-- JavaScript -->
    <script type="text/javascript" src="<?= base_url('assets/js/jquery-1.8.3.js') ?>"></script>
    
    <script type="text/javascript" src="<?= base_url('assets/js/jquery.autocomplete.js') ?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/js/library.js') ?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/bootstrap/js/bootstrap-dialog.js') ?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/js/ajaxfileupload.js') ?>"></script>
    <link rel="stylesheet" href="<?= base_url('assets/font-awesome/css/font-awesome.min.css')?>">
    
    <script type="text/javascript" src="<?= base_url('assets/pnotify/jquery.pnotify.min.js') ?>"></script>

    <link href="<?= base_url('assets/pnotify/jquery.pnotify.default.css') ?>" media="all" rel="stylesheet" type="text/css" />
  
    <script type="text/javascript">
      $(function(){
        $('.myinput').keyup(function(){
            if($(this).val() !== ''){
                dc_validation_remove(this);
            }
        });

        $('.myinput').change(function(){
            if($(this).val() !== ''){
                dc_validation_remove(this);
            }            
        });

      });
    </script>
  </head>

  <body>

    <div id="wrapper">

      <!-- Sidebar -->
      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?= base_url('admin')?>">Admin</a>
        </div>
        <?php $icon = ''; $active = ''; ?>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav side-nav">
            <?php if($page === 'home') $active = 'class="active"' ?>
             <li <?= $active ?> ><a href="<?= base_url('admin')?>"><i class="fa fa-home"></i> Home</a></li>
            <?php foreach ($menu as $key => $val): ?>
            <?php 
              $active = '';
              
              if(strpos($val->url, $page) !== false){
                $active = 'class="active"';
                
              }else if($val->nama == $title ){
                $active = 'class="active"';
                $icon = $val->icon;
              }
            ?>
            <li <?= $active ?> ><a href="<?= base_url($val->url)?>"><i class="fa <?= $val->icon ?>"></i> <?= $val->nama ?></a></li>
            <?php endforeach; ?>      
            
          </ul>

          <ul class="nav navbar-nav navbar-right navbar-user">     
            <li class="dropdown user-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?= $this->session->userdata('user') ?> <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href=" <?= base_url() ?> " target="_blank"><i class="fa fa-check-square"></i> Lihat Situs</a></li>
                <li><a href=" <?= base_url('admin/ganti_password') ?> "><i class="fa fa-user"></i> Edit Password</a></li>
                <li class="divider"></li>
                <li><a href="<?= base_url('admin/logout') ?>"><i class="fa fa-power-off"></i> Log Out</a></li>
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </nav>

      <div id="page-wrapper">

        <div class="row">
         <div class="col-lg-12">
            <h2><?= $title ?></h2>
            <ol class="breadcrumb">
              <li><a href="<?= base_url('admin')?>"><i class="fa fa-home"></i> Home</a></li>
              <?php if($icon !== ''): ?>
                <li><i class="fa <?= $icon ?>"></i> <?= $title ?></li>
              <?php endif; ?>
            </ol>
          </div>
        </div><!-- /.row -->
        <?php $this->load->view('admin/'.$page) ?>

      </div><!-- /#page-wrapper -->

    </div><!-- /#wrapper -->

  </body>
</html>