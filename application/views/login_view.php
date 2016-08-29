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
  <link rel="shortcut icon" href="<?php echo STATIC_FILE_DIR;?>live/cpg.ico">
  
  <link rel="stylesheet" type="text/css" href="<?php echo STATIC_FILE_DIR.'css/animate.css';?>" />
  <!-- FontAwesome -->
  <link rel="stylesheet" type="text/css" href="<?php echo STATIC_FILE_DIR.'fonts/font-awesome/css/font-awesome.min.css';?>" />
  <!-- Main -->
  <link rel="stylesheet" type="text/css" href="<?php echo STATIC_FILE_DIR.'css/admin.min.css';?>" />
  <!--[if lt IE 9]>
    <script src="<?php echo STATIC_FILE_DIR.'js/html5shiv.min.js';?>"></script>
  <![endif]-->
  <!-- jQuery -->
  <script type="text/javascript" src="<?php echo STATIC_FILE_DIR.'js/jquery.min.js';?>"></script>
  <style type="text/css">
  .sk-circle { top:17%;left:45%; }
  .sk-circle .sk-child:before { background-color: #c2185b }
  </style>
</head>

<body>

  <section id="sign-in">

    <!-- Background Bubbles -->
    <canvas id="bubble-canvas"></canvas>
    <!-- /Background Bubbles -->

    <!-- Sign In Form -->
    <form>
      <div class="row links">
        <div class="col s9 logo">
          <h3>CPG LIVE MANAGER</h3>
        </div>
        <div class="col s3 right-align">
          <strong>登录</strong>
        </div>
      </div>

      <div class="card-panel clearfix">
        <!-- loading -->
        <div class="sk-circle">
            <div class="sk-circle1 sk-child"></div>
            <div class="sk-circle2 sk-child"></div>
            <div class="sk-circle3 sk-child"></div>
            <div class="sk-circle4 sk-child"></div>
            <div class="sk-circle5 sk-child"></div>
            <div class="sk-circle6 sk-child"></div>
            <div class="sk-circle7 sk-child"></div>
            <div class="sk-circle8 sk-child"></div>
            <div class="sk-circle9 sk-child"></div>
            <div class="sk-circle10 sk-child"></div>
            <div class="sk-circle11 sk-child"></div>
            <div class="sk-circle12 sk-child"></div>
        </div>
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
        </div>-->

        <div class="alert alert-border-left pink lighten-4 pink-text text-darken-2" style="margin-top:0; margin-bottom:20px;">
          请输入账号和密码
        </div>

        <!-- Username -->
        <div class="input-field">
          <i class="fa fa-user prefix"></i>
          <input id="username" type="text" class="validate">
          <label for="username">账号</label>
        </div>
        <!-- /Username -->

        <!-- Password -->
        <div class="input-field">
          <i class="fa fa-unlock-alt prefix"></i>
          <input id="password" type="password" class="validate">
          <label for="password">密码</label>
        </div>
        <!-- /Password -->

        <div class="switch">
          <label>
            <input type="checkbox" id="remember" checked />
            <span class="lever"></span>
            记住登录状态
          </label>
        </div>

        <button type="button" class="waves-effect waves-light btn-large z-depth-0 z-depth-1-hover" onclick="login()">登录</button>
      </div>

      <div class="links right-align">
        <a href="javascript:;">忘记密码?</a>
      </div>

    </form>
    <!-- /Sign In Form -->

  </section>

  <!-- Materialize -->
  <script type="text/javascript" src="<?php echo STATIC_FILE_DIR.'js/materialize.min.js';?>"></script>
  <!-- Main -->
  <script type="text/javascript" src="<?php echo STATIC_FILE_DIR.'js/main.min.js';?>"></script>
  <script type="text/javascript">
  function login(){
    var username = $('#username').val(),
        password = $('#password').val(),
        remember = $('#remember').val();
    if(!username || username.length < 5){
      $('#username').removeClass('valid').addClass('invalid');
      $('.alert').text('账号输入错误～');return;
    }
    if(!password || password.length < 5){
      $('#password').removeClass('valid').addClass('invalid');
      $('.alert').text('密码输入错误～');return;
    }
    $('.sk-circle').show();
    $.ajax({
        url: "<?php echo base_url('Login/opLogin');?>",
        data:{username:username, password:password, a:Math.random()},
        type: "POST",
        dataType: "json",
        success: function(d){
          if(d.status > 0){
              window.setTimeout(function() {
                  $('.sk-circle').hide();
                  //window.location.href="<?php echo base_url();?>"+formatUrl(getUrlParam('redirect'));
                  window.location.href="<?php echo base_url();?>";
              }, 1e3);
          }else{
              //$('#error-info').text();
              window.setTimeout(function() {
                $('.sk-circle').hide();
                $('.alert').text(d.msg);
                if( d.status == -1 ){
                  $('#password').removeClass('valid').addClass('invalid');
                }else if( d.status == -2 ){
                  $('#username').removeClass('valid').addClass('invalid');
                }
              }, 1e3);
          }
        },
        error: function(){
            //$('.alert').text('数据传输失败，请联系网络管理员');
            window.setTimeout(function() {
                $('.sk-circle').hide();
                $('.alert').text('数据传输失败，请联系网络管理员');
            }, 2e3);
        }
    });
  }
  function getUrlParam(name) {
    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
    var r = window.location.search.substr(1).match(reg);
    if (r != null) return unescape(r[2]); return null;
  }
  function formatUrl(url){
    var tmp = decodeURIComponent(url);
    if(tmp.indexOf('index.php/')>0){
      tmp = tmp.substr( tmp.indexOf('index.php')+10 );
    }
    return tmp ? tmp : '';
  }
  </script>
</body>
</html>