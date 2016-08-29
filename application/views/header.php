<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$userInfo = $this->auth->getUserInfo();
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo WEBSITE_TITLE;?></title>
  <meta name="description" content="<?php echo WEBSITE_DESC;?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="<?php echo STATIC_FILE_DIR;?>live/cpg.ico">
  <!-- nanoScroller -->
  <link rel="stylesheet" type="text/css" href="<?php echo STATIC_FILE_DIR.'css/nanoscroller.css';?>" />
  <!-- FontAwesome -->
  <link rel="stylesheet" type="text/css" href="<?php echo STATIC_FILE_DIR.'fonts/font-awesome/css/font-awesome.min.css';?>" />
  <!-- Material Design Icons -->
  <link rel="stylesheet" type="text/css" href="<?php echo STATIC_FILE_DIR.'fonts/material-design-icons/css/material-design-icons.min.css';?>" />
  <!-- IonIcons -->
  <link rel="stylesheet" type="text/css" href="<?php echo STATIC_FILE_DIR.'fonts/ionicons/css/ionicons.min.css';?>" />
  <!-- WeatherIcons -->
  <link rel="stylesheet" type="text/css" href="<?php echo STATIC_FILE_DIR.'fonts/weatherIcons/css/weather-icons.min.css';?>" />
  <!-- Pikaday -->
  <link rel="stylesheet" type="text/css" href="<?php echo STATIC_FILE_DIR.'css/pikaday.css';?>" />
  <!-- Main -->
  <link rel="stylesheet" type="text/css" href="<?php echo STATIC_FILE_DIR.'css/admin.min.css';?>" />
  <!--[if lt IE 9]>
    <script src="<?php echo STATIC_FILE_DIR.'js/html5shiv.min.js';?>"></script>
  <![endif]-->
  <!-- jQuery -->
  <script type="text/javascript" src="<?php echo STATIC_FILE_DIR.'js/jquery-1.9.1.js';?>"></script>
</head>

<body class="">

    <nav class="navbar-top">
        <div class="nav-wrapper">
            <!-- Sidebar toggle -->
            <a href="javascript:;" class="yay-toggle">
                <div class="burg1"></div>
                <div class="burg2"></div>
                <div class="burg3"></div>
            </a>
            <!-- Sidebar toggle -->

            <!-- Logo -->
            <a href="javascript:;" class="brand-logo" style="color: #000;">
                <!--<img src="<?php echo STATIC_FILE_DIR.'img/logo.png';?>" alt="CPG LIVE MANAGER">-->
                CPG LIVE MANAGER
            </a>
            <!-- /Logo -->

            <!-- Menu -->
            <ul>
                <!--<li>
                    <a href="javascript:;" class="search-bar-toggle"><i class="mdi-action-search"></i></a>
                </li>-->
                <li class="user">
                    <a class="dropdown-button" href="javascript:;">
                        <img src="<?php echo STATIC_FILE_DIR.'live/img/logo.png';?>" alt="Admin" class="circle">
                        <?php echo $userInfo['name'];?>
                        <!--<i class="mdi-navigation-expand-more right"></i>-->
                    </a>

                    <!--<ul id="user-dropdown" class="dropdown-content">
                        <li>
                            <a href="javascript:;"><i class="fa fa-user"></i> 个人资料</a>
                        </li>
                        <li>
                            <a href="javascript:;"><i class="fa fa-envelope"></i> 信息 <span class="badge new">2</span></a>
                        </li>
                        <li>
                            <a href="javascript:;"><i class="fa fa-cogs"></i> 设置</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="<?php echo base_url('Login/logout');?>"><i class="fa fa-sign-out"></i> 退出登录</a>
                        </li>
                    </ul>-->
                </li>
            </ul>
            <!-- /Menu -->
        </div>
    </nav>
    <!-- /Top Navbar -->


    <aside class="yaybar yay-gestures yay-hide-to-small yay-shrink">

        <div class="top">
            <div>
                <!-- Sidebar toggle -->
                <a href="javascript:;" class="yay-toggle">
                    <div class="burg1"></div>
                    <div class="burg2"></div>
                    <div class="burg3"></div>
                </a>
                <!-- Sidebar toggle -->
                
            </div>
        </div>


        <div class="nano">
            <div class="nano-content">
                <ul>
                    <li class="label">功能列表</li>
                    <li class="<?php echo empty($actNavBar) || $actNavBar == 'index' ? 'active' : '';?>">
                        <a href="<?php echo base_url();?>" class="waves-effect waves-blue" title="管理后台"><i class="mid mdi-action-home"></i> 管理后台</a>
                    </li>
<?php
$Menu = $this->auth->getUserMenu();
//var_dump( $Menu );
if (empty( $Menu )) {
    //something...
}else{
    if (!empty( $Menu['Match'] )) {
?>

                    <li class="<?php echo !empty($actNavBar) && in_array($actNavBar, array('match', 'matchAdd', 'matchManager', 'matchType', 'matchMap', 'matchEdit', 'matchDel', 'matchHis')) ? 'open' : '';?>">
                        <a class="yay-sub-toggle waves-effect waves-blue" title="赛事发布"><i class="mdi-maps-local-attraction"></i> 赛事发布<span class="yay-collapse-icon mdi-navigation-expand-more"></span></a>
                        <ul>
                            <li class="<?php echo !empty($actNavBar) && in_array($actNavBar, array('match', 'matchManager')) ? 'active' : '';?>">
                                <a href="<?php echo base_url('Match/index');?>" class="waves-effect waves-blue"><i class="mdi-action-view-module"></i> 赛事列表</a>
                            </li>
                            <li class="<?php echo !empty($actNavBar) && in_array($actNavBar, array('matchType')) ? 'active' : '';?>">
                                <a href="<?php echo base_url('Match/type');?>" class="waves-effect waves-blue"><i class="mdi-action-dashboard"></i> 赛事系列</a>
                            </li>
                            <li class="<?php echo !empty($actNavBar) && in_array($actNavBar, array('matchMap')) ? 'active' : '';?>">
                                <a href="<?php echo base_url('Match/map');?>" class="waves-effect waves-blue"><i class="mdi-communication-location-on"></i> 赛场地图</a>
                            </li>
                            <li class="<?php echo !empty($actNavBar) && $actNavBar == 'matchAdd' ? 'active' : '';?>">
                                <a href="<?php echo base_url('Match/add');?>" class="waves-effect waves-blue"><i class="mdi-content-add-circle-outline"></i> 添加赛事</a>
                            </li>
                            <li class="<?php echo !empty($actNavBar) && $actNavBar == 'matchHis' ? 'active' : '';?>">
                                <a href="<?php echo base_url('Match/history');?>" class="waves-effect waves-blue"><i class="mdi-action-cached"></i> 历史赛事</a>
                            </li>
                            <li class="<?php echo !empty($actNavBar) && $actNavBar == 'matchDel' ? 'active' : '';?>">
                                <a href="<?php echo base_url('Match/dustbin');?>" class="waves-effect waves-blue"><i class="mdi-action-delete"></i> 赛事回收箱</a>
                            </li>
                        </ul>
                    </li>
<?php
    }
    if (!empty( $Menu['Manager'] )) {
?>

                    <li class="<?php echo !empty($actNavBar) && in_array($actNavBar, array('timer', 'timerAdd', 'promotion')) ? 'open' : '';?>">
                        <a class="yay-sub-toggle waves-effect waves-blue" title="赛事管理"><i class="mdi-device-access-alarm"></i> 赛事管理<span class="yay-collapse-icon mdi-navigation-expand-more"></span></a>
                        <ul>
                            <li class="<?php echo !empty($actNavBar) && in_array($actNavBar, array('promotion')) ? 'active' : '';?>">
                                <a href="<?php echo base_url('Promotion');?>" class="waves-effect waves-blue"><i class="mdi-action-list"></i> 晋级赛管理</a>
                            </li>
                            <li class="<?php echo !empty($actNavBar) && in_array($actNavBar, array('timer')) ? 'active' : '';?>">
                                <a href="<?php echo base_url('Timer');?>" class="waves-effect waves-blue"><i class="mdi-av-timer"></i> 计时器管理</a>
                            </li>
                            <li class="<?php echo !empty($actNavBar) && $actNavBar == 'timerAdd' ? 'active' : '';?>">
                                <a href="<?php echo base_url('Timer/add');?>" class="waves-effect waves-blue"><i class="mdi-device-add-alarm"></i> 添加计时器</a>
                            </li>
                            <li class="<?php echo !empty($actNavBar) && $actNavBar == 'dateMatch' ? 'active' : '';?>">
                                <a href="javascript:;" class="waves-effect waves-blue"><i class="mdi-social-poll"></i> 当日赛事显示</a>
                            </li>
                            <li class="<?php echo !empty($actNavBar) && $actNavBar == 'dealer' ? 'active' : '';?>">
                                <a href="javascript:;" class="waves-effect waves-blue"><i class="mdi-action-account-circle"></i> 发牌员管理[后期开发]</a>
                            </li>
                            <li class="<?php echo !empty($actNavBar) && $actNavBar == 'table' ? 'active' : '';?>">
                                <a href="javascript:;" class="waves-effect waves-blue"><i class="mdi-action-group-work"></i> 牌桌管理[新需求]</a>
                            </li>
                            <li class="<?php echo !empty($actNavBar) && $actNavBar == 'emptySeat' ? 'active' : '';?>">
                                <a href="javascript:;" class="waves-effect waves-blue"><i class="mdi-action-group-work"></i> 座位管理[新需求]</a>
                            </li>
                        </ul>
                    </li>
<?php
    }
    if (!empty( $Menu['User'] )) {
?>
                    <li class="<?php echo !empty($actNavBar) && in_array($actNavBar, array('customer', 'customerInfo', 'master', 'masterInfo')) ? 'open' : '';?>">
                        <a class="yay-sub-toggle waves-effect waves-blue" title="用户中心"><i class="mdi-social-people"></i> 用户管理<span class="yay-collapse-icon mdi-navigation-expand-more"></span></a>
                        <ul>
                            <li class="<?php echo !empty($actNavBar) && in_array($actNavBar, array('master', 'masterInfo')) ? 'active' : '';?>">
                                <a href="javascript:;" class="waves-effect waves-blue"><i class="mdi-action-account-box"></i> 用户列表[后期开发]</a>
                            </li>
                        </ul>
                    </li>
<?php
    }
    if (!empty( $Menu['Account'] )) {
?>
                    <li class="<?php echo !empty($actNavBar) && in_array($actNavBar, array('tickets', 'ticketAdd', 'account', 'gamePrize')) ? 'open' : '';?>">
                        <a class="yay-sub-toggle waves-effect waves-blue" title="财务管理"><i class="mdi-maps-local-atm"></i> 财务管理<span class="yay-collapse-icon mdi-navigation-expand-more"></span></a>
                        <ul>
                            <li class="<?php echo !empty($actNavBar) && in_array($actNavBar, array('tickets', 'ticketAdd')) ? 'active' : '';?>">
                                <a href="<?php echo base_url('Tickets');?>" class="waves-effect waves-blue"><i class="mdi-action-wallet-giftcard"></i> 发行卡</a>
                            </li>
                            <li class="<?php echo !empty($actNavBar) && $actNavBar == 'account' ? 'active' : '';?>">
                                <a href="<?php echo base_url('Account');?>" class="waves-effect waves-blue"><i class="mdi-editor-format-list-bulleted"></i> 财务统计</a>
                            </li>
                            <li class="<?php echo !empty($actNavBar) && $actNavBar == '' ? 'active' : '';?>">
                                <a href="javascript:;" class="waves-effect waves-blue"><i class="mdi-action-receipt"></i> 充值账单管理</a>
                            </li>
                            <li class="<?php echo !empty($actNavBar) && $actNavBar == 'gamePrize' ? 'active' : '';?>">
                                <a href="<?php echo base_url('Account/game_prize');?>" class="waves-effect waves-blue"><i class="mdi-notification-event-note"></i> 游戏赛果统计</a>
                            </li>
                        </ul>
                    </li>
<?php
    }
    if (!empty( $Menu['Admin'] )) {
?>
                    <li class="<?php echo !empty($actNavBar) && in_array($actNavBar, array('auth', 'role', 'authError', 'authPrivilege')) ? 'open' : '';?>">
                        <a class="yay-sub-toggle waves-effect waves-blue" title="权限管理"><i class="mdi-action-lock"></i> 权限管理<span class="yay-collapse-icon mdi-navigation-expand-more"></span></a>
                        <ul>
                            <li class="<?php echo !empty($actNavBar) && $actNavBar == 'auth' ? 'active' : '';?>">
                                <a href="<?php echo base_url('Admin/index');?>" class="waves-effect waves-blue"><i class="ion-ios-person-outline"></i> 管理员管理</a>
                            </li>
                            <li class="<?php echo !empty($actNavBar) && $actNavBar == 'role' ? 'active' : '';?>">
                                <a href="<?php echo base_url('Admin/role');?>" class="waves-effect waves-blue"><i class="ion-ios-people"></i> 角色管理</a>
                            </li>
                            <li class="<?php echo !empty($actNavBar) && $actNavBar == 'authPrivilege' ? 'active' : '';?>">
                                <a href="<?php echo base_url('Admin/privilege');?>" class="waves-effect waves-blue"><i class="mdi-communication-vpn-key"></i> 权限列表</a>
                            </li>
                        </ul>
                    </li>

<?php
    }
}
?>
         
                    <li>
                        <a href="<?php echo base_url('Login/logout');?>" class="waves-effect waves-blue"><i class="fa fa-sign-out"></i> 退出登录</a>
                    </li>

                </ul>

            </div>
        </div>
    </aside>
    <!-- /Yay Sidebar -->