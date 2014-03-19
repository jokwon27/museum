<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login | SIG Museum Yogyakarta</title>

    <!-- Core CSS - Include with every page -->
    <link href="<?= base_url() ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- SB Admin CSS - Include with every page -->
    <link href="<?= base_url() ?>assets/css/sb-admin-login.css" rel="stylesheet">
    <script src="<?= base_url() ?>assets/js/jquery-1.8.3.js"></script>
    <script src="<?= base_url() ?>assets/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript">
    $(function(){
      $('#formsign').submit(function(){
        $.ajax({
              url: '<?= base_url("admin/login") ?>',
              type: 'POST',
              dataType: 'json',
              data: $('#formsign').serialize(),
              cache: false,
              success: function(data) {
                  location.href = "admin";
              }
          });

        return false;
      });

      $('#panel_login').hide();
      $('#panel_login').show('slow');
    });
  </script>
</head>

<body>

    <div class="container">
    
        <div class="row" style="margin-top:15%;" id="panel_login">
            <div  class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Login SIG Museum</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" id="formsign">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Username" name="username" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                </div>
                             
                                <!-- Change this to a button or input when using this as a form -->
                                <button type="submit" href="index.html" class="btn btn-lg btn-success btn-block">Login</button>
                            </fieldset>
                        </form>
                        <br/>
                        
                    </div>
                    <p>&nbsp;Copyright &copy;2014</p>
                </div>
            </div>

        </div>
    </div>

    <!-- Core Scripts - Include with every page -->

</body>

</html>
