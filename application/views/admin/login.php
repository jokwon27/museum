
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../docs-assets/ico/favicon.png">

    <title>Signin Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="<?= base_url('assets/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?= base_url('assets/css/signin.css') ?>" rel="stylesheet">
    <script type="text/javascript" src="<?= base_url('assets/js/jquery-1.10.2.js') ?>"></script>

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
                    location.href ="admin";
                }
            });

          return false;
        });
      });
    </script>
  </head>

  <body>

    <div class="container">

      <form class="form-signin" role="form" id="formsign">
        <h2 class="form-signin-heading">Please sign in</h2>
        <input type="text" class="form-control" placeholder="Username" required autofocus name="username">
        <input type="password" class="form-control" placeholder="Password" required name="password">
        <label class="checkbox">
          <input type="checkbox" value="remember-me"> Remember me
        </label>
        <button class="btn btn-lg btn-primary btn-block" type="submit" id="signin">Sign in</button>
      </form>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>
