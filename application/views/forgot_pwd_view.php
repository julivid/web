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

  <section id="forgot-password">

    <!-- Background Bubbles -->
    <canvas id="bubble-canvas"></canvas>
    <!-- /Background Bubbles -->

    <!-- Reset Form -->
    <form>
      <div class="row links">
        <div class="col s6 logo">
          <img src="<?php echo STATIC_FILE_DIR;?>img/logo-white.png" alt="">
        </div>
        <div class="col s6 right-align"><a href="<?php echo base_url('Login');?>">登陆</a> / <a href="<?php echo base_url('User/register');?>">注册</a>
        </div>
      </div>

      <div class="card-panel">
        <div class="alert blue lighten-5 blue-text text-darken-2">
          <strong><i class="fa fa-css3"></i></strong>&nbsp; 我们会将重置密码的链接发送至您注册时留下的邮箱，请注意查收。
        </div>

        <div class="row">
          <div class="col m9 s12">
            <div class="input-field">
              <i class="fa fa-envelope prefix"></i>
              <input id="email" type="email">
              <label for="email">Email</label>
            </div>
          </div>
          <div class="col m3 s12">
            <button type="button" class="waves-effect waves-light btn-large z-depth-0 z-depth-1-hover" onclick="sendEmail()">发送</button>
          </div>
        </div>

      </div>
    </form>
    <!-- /Reset Form -->

  </section>

<!-- Materialize -->
  <script type="text/javascript" src="<?php echo STATIC_FILE_DIR.'js/materialize.min.js';?>"></script>
  <!-- Main -->
  <script type="text/javascript" src="<?php echo STATIC_FILE_DIR.'js/main.min.js';?>"></script>
  <script type="text/javascript">
  function sendEmail(){
    return;
  }
  </script>
</body>
</html>