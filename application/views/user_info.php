<section class="content-wrap">
    <div class="page-title">
        <div class="row">
            <div class="col s12 m9 l10">
                <ul>
                    <li>
                        <a href="<?php echo base_url();?>"><i class="fa fa-home"></i> 首页</a>  <i class="fa fa-angle-right"></i>
                    </li>

                    <li>
                        <a href='javascript:;'>用户管理</a> <i class='fa fa-angle-right'></i>
                    </li>
                    <li>
                        <a href='javascript:;'>用户信息</a>
                    </li>
                </ul>
            </div>
            <div class="col s12 m3 l2 right-align">
                <!-- <a href="javascript:;" class="btn grey lighten-3 grey-text z-depth-0 chat-toggle"><i class="fa fa-comments"></i></a> -->
            </div>
        </div>
    </div>

    <div class="card-panel">
        <div class="row">
            <div class="col s12 m4">
                <img src="<?php echo UPLOAD_IMG_URL.date('Ym', $userDetail[0]['create_time']).'/'.$userDetail[0]['photo'];?>" alt="用户姓名">
            </div>
            <div class="col s12 m8">
                <h3><?php echo $userDetail[0]['name'];?></h3>
                <h4>性别： <?php echo $userDetail[0]['gender'];?></h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="title">
                    <h5><i class="mdi-communication-contacts"></i> 履历 </h5>
                </div>
                <div class="content">
                    <?php echo $userDetail[0]['record'];?>
                </div>
            </div>
        </div>
    </div>
    <p class="left-align">
        <a class="btn" href="javascript:;" onclick="window.history.back()">返回</a>
    </p>

</section>
