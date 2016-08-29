    <section class="content-wrap">
        <div class="page-title">
            <div class="row">
                <div class="col s12 m9 l10">
                    <ul>
                        <li>
                            <a href="<?php echo base_url();?>"><i class="fa fa-home"></i> 首页</a>  <i class="fa fa-angle-right"></i>
                        </li>

                        <li>
                            <a href='javascript:;'>管理后台首页</a>
                        </li>
                    </ul>
                </div>
                <div class="col s12 m3 l2 right-align">
                    <!-- <a href="javascript:;" class="btn grey lighten-3 grey-text z-depth-0 chat-toggle"><i class="fa fa-comments"></i></a> -->
                </div>
            </div>

        </div>

        <div class="alert blue lighten-2 white-text index-welcome">
            <strong><?php echo $this->auth->getUserInfo()['name']; ?></strong>，欢迎回来。上次登陆时间：<?php echo date('Y-m-d H:i:s', $this->auth->getUserInfo()['last_time']);?> [登陆IP: <?php echo $this->auth->getUserInfo()['last_ip'];?>]
        </div>

    </section>


  
  
<script>
$(document).ready(function(){
    
    setTimeout(function() {
        Materialize.toast('欢迎访问<?php echo WEBSITE_TITLE;?>!', 2000, 'info');
    }, 1000);
    // setTimeout(function() {
    //   $(window).resize();
    // }, 1);

});
</script>

    