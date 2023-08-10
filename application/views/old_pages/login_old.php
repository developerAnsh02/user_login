<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php //echo base_url(); exit;
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> Admin Panel &#8211; Assignment In Need</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() . "assets/"; ?>dist/css/adminlte.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url() . "assets/"; ?>plugins/iCheck/square/blue.css">


  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <style type="text/css">
    .login-page {
      color: #747474 !important;
    }

    body {
      background: -webkit-linear-gradient(to right, #4373cb, #ffffff, #4072cc);
      background: #6b5b95b8;
      top: 0;
      left: 0;
      z-index: -1;
      width: 100%;
      height: 100%;
      content: '';
      font-family: 'Poppins', sans-serif !important;
    }
  </style>
</head>

<body>
  <div class="login-box" style="width:450px;">
    <div class="login-logo">
      <img src="<?php echo base_url(); ?>uploads/assignment_logo.png" style="width:30%;">
    </div>
    <!-- /.login-logo -->
    <div class="card" style="background-color: #e4e1e1;">
      <div class="card-body login-card-body">
        <p class="login-box-msg" style="font-weight: 600;">Sign in to start your session</p>
        <div class="">
          <?php echo validation_errors(); ?>

          <?php if ($this->session->flashdata('success')) : ?>
            <div class="alert alert-success alert-dismissible">
              <button type="button" class="btn-close" data-bs-dismiss="alert" class="btn-close" aria-label="Close">
                <span aria-hidden="true"></span>
              </button>
              <h3 class="text-success">
                <i class="fa fa-check-circle"></i> Success
              </h3>
              <?php echo $this->session->flashdata('success'); ?>
            </div>
          <?php endif; ?>

          <?php if ($this->session->flashdata('failed')) : ?>
            <div class="alert alert-warning alert-dismissible">
              <button type="button" class="btn-close" data-bs-dismiss="alert" class="btn-close" aria-label="Close">
                <span aria-hidden="true"></span>
              </button>
              <h3 class="text-warning">
                <i class="fa fa-exclamation-triangle"></i> Warning
              </h3>
              <?php echo $this->session->flashdata('failed'); ?>
            </div>
          <?php endif; ?>

        </div>

        <form action="<?php echo base_url(); ?>index.php/User_authentication/user_login_process" method="post">
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fa fa-envelope"></i></span>
            </div>
            <input type="text" class="form-control" placeholder="Email" name="username" autocomplete="off">
          </div>

          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fa fa-lock"></i></span>
            </div>
            <input type="password" class="form-control" placeholder="Password" name="password" autocomplete="off">
          </div>

          <div class="row mb-3">
            <!-- <div class="col-8">
            <div class="checkbox icheck">
              <label>
                <input type="checkbox"> Remember Me
              </label>
            </div>
          </div> -->
            <!-- /.col -->
            <div class="col-8">
              <input type="checkbox" name="chech" value="1"> &nbsp; <span> Remember Me</span>
            </div>
            <div class="col-4">
              <button type="submit" class="btn  btn-block btn-flat" style="background-color: #4373cb;color:#fff;">Sign In</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
        <hr>
        <!-- /.social-auth-links -->
        <div class="row">
          <div class="col-4">
            <p class="mb-1">
              <?php echo anchor('User_authentication/ForgotPassword', 'forgot password', 'title=" forgot my password" style="color:#4373cb;font-weight:500;"'); ?>
            </p>
          </div>
          <div class="col-4">
            <p class="mb-1">
              <?php echo anchor('User_authentication/user_registration_show', 'New Register', 'title=" forgot my password" style="color:#4373cb;font-weight:500;"'); ?>
            </p>
          </div>
          <div class="col-4">
            <p class="mb-1">
              <?php echo anchor('https://assignnmentinneed.com/', 'Back To Home', 'title=" Go To Home" style="color:#4373cb;font-weight:500;"'); ?>
            </p>
          </div>
        </div>
        <!-- /.login-card-body -->
      </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="<?php echo base_url() . "assets/"; ?>plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo base_url() . "assets/"; ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url() . "assets/"; ?>plugins/iCheck/icheck.min.js"></script>

    <script>
      $(function() {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        })
      })

      $('#close').on('click', function(e) {
        $(this).parent('.error_mesg').remove();
      });
      /*
          $(function() {
          setTimeout(function() {
              $(".error_mesg").hide('blind', {}, 500)
          }, 3000);
        });*/
    </script>
</body>

</html>