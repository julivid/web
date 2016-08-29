<!DOCTYPE html>
<!--[if lt IE 7]>  <html class="lt-ie7"> <![endif]-->
<!--[if IE 7]>     <html class="lt-ie8"> <![endif]-->
<!--[if IE 8]>     <html class="lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html>
<!--<![endif]-->

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo WEBSITE_TITLE;?></title>
  <meta name="description" content="<?php echo WEBSITE_DESC;?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" href="<?php echo STATIC_FILE_DIR.'img/icon.png';?>">
  
  <!-- FontAwesome -->
  <link rel="stylesheet" type="text/css" href="<?php echo STATIC_FILE_DIR.'fonts/font-awesome/css/font-awesome.min.css';?>" />
  <!-- Main -->
  <link rel="stylesheet" type="text/css" href="<?php echo STATIC_FILE_DIR.'css/admin.min.css';?>" />
  <!--[if lt IE 9]>
    <script src="<?php echo STATIC_FILE_DIR.'js/html5shiv.min.js';?>"></script>
  <![endif]-->
  <!-- jQuery -->
  <script type="text/javascript" src="<?php echo STATIC_FILE_DIR.'js/jquery.min.js';?>"></script>
</head>

<body>

  <section id="sign-up">

    <!-- Background Bubbles -->
    <canvas id="bubble-canvas"></canvas>
    <!-- /Background Bubbles -->

    <!-- Sign Up Form -->
    <form>
      <div class="row links">
        <div class="col s6 logo">
          <img src="<?php echo STATIC_FILE_DIR;?>img/logo-white.png" alt="">
        </div>
        <div class="col s6 right-align"><a href="<?php echo base_url('Login');?>">登陆</a> / <strong>注册</strong>
        </div>
      </div>

      <div class="card-panel clearfix">

        <!-- Social Sign Up 
        <div class="row socials">
          <div class="col s4">
            <a class="btn blue darken-2 z-depth-0 z-depth-1-hover" href="#"><i class="fa fa-2x fa-facebook"></i></a>
          </div>
          <div class="col s4">
            <a class="btn blue lighten-2 z-depth-0 z-depth-1-hover" href="#"><i class="fa fa-2x fa-twitter"></i></a>
          </div>
          <div class="col s4">
            <a class="btn red z-depth-0 z-depth-1-hover" href="#"><i class="fa fa-2x fa-google-plus"></i></a>
          </div>
        </div>

        <div class="row">
          <div class="col m6 s12">
            <div class="input-field">
              <i class="fa fa-user prefix"></i>
              <input id="input_fname" type="text">
              <label for="input_fname">First Name</label>
            </div>
          </div>

          <div class="col m6 s12">
            <div class="input-field">
              <i class="fa fa-user prefix"></i>
              <input id="input_lname" type="text">
              <label for="input_lname">Last Name</label>
            </div>
          </div>
        </div>-->

        <!-- Email -->
        <div class="input-field">
          <i class="fa fa-envelope prefix"></i>
          <input id="email" type="email">
          <label for="email">Email</label>
        </div>
        <!-- /Email -->

        <!-- Username -->
        <div class="input-field">
          <i class="fa fa-user prefix"></i>
          <input id="username" type="text">
          <label for="username">用户名</label>
        </div>
        <!-- /Username -->

        <!-- Password -->
        <div class="input-field">
          <i class="fa fa-unlock-alt prefix"></i>
          <input id="password" type="password">
          <label for="password">密码</label>
        </div>
        <!-- /Password -->

        <p>
          <input type="checkbox" id="userProtocal" />
          <label for="userProtocal">阅读并同意 <a href="#">《用户协议》</a>.</label>
        </p>

        <button type="button" class="waves-effect waves-light btn-large z-depth-0 z-depth-1-hover" onclick="register()">提交注册</button>
      </div>

    </form>
    <!-- /Sign Up Form -->

  </section>

  <!-- Materialize -->
  <script type="text/javascript" src="<?php echo STATIC_FILE_DIR.'js/materialize.min.js';?>"></script>
  <!-- Main -->
  <script type="text/javascript" src="<?php echo STATIC_FILE_DIR.'js/main.min.js';?>"></script>
  <script type="text/javascript">
  function register(){
    return;
  }
  </script>
</body>
</html>