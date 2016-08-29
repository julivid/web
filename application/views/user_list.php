<style type="text/css">
    .user-list .btn { padding: 0 5px;}
    .disabled { cursor: not-allowed;}
</style>
<section class="content-wrap ecommerce-customers">
    <div class="page-title">
        <div class="row">
            <div class="col s12 m9 l10">
                <ul>
                    <li>
                        <a href="<?php echo base_url();?>"><i class="fa fa-home"></i> 首页</a>  <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href='javascript:;'>用户中心</a> <i class='fa fa-angle-right'></i>
                    </li>
                    <li>
                        <a href='javascript:;'>人员列表</a>
                    </li>
                </ul>
            </div>
            <div class="col s12 m3 l2 right-align">
                <!-- <a href="javascript:;" class="btn grey lighten-3 grey-text z-depth-0 chat-toggle"><i class="fa fa-comments"></i></a> -->
            </div>
        </div>
    </div>

    <div class="row">
        <a class="btn-floating btn-extra waves-effect waves-light red tooltipped" href="<?php echo base_url('User/add');?>" data-tooltip="添加人员" data-position="left" style="position: fixed; bottom: 25px; right: 25px;">
            <i class="mdi-content-add"></i>
        </a>
        <div id="userList">
        <?php
        if (empty( $userInfo )) {
            echo '<div class="alert"> 暂无人员信息... </div>';
        }else{
            foreach ($userInfo as $user) {
        ?>
        <div class="col s6 m3 l2">
            <div class="card image-card">
                <div class="image">
                    <img src="<?php echo UPLOAD_IMG_URL.date('Ym', $user['create_time']).'/'.$user['photo'];?>" alt="">
                    <a href="<?php echo base_url('User/info?id='.$user['uid']);?>" class="link"></a>
                </div>
                <div class="content user-list">
                    <h5><?php echo $user['name'];?></h5>
                    <div id="user_<?php echo $user['uid'];?>">
                    <?php
                    switch ($user['status']) {
                        case 0:
                            echo '<a href="javascript:;" class="btn btn-small green" onclick="userStatus('.$user['uid'].',1)">发布</a> <a href="'.base_url("User/edit?id=").$user['uid'].'" class="btn btn-small blue">编辑</a> <a href="javascript:;" class="btn btn-small red" onclick="userStatus('.$user['uid'].',-1)">删除</a>';
                            break;
                        case 1:
                            echo '<a href="javascript:;" class="btn btn-small orange" onclick="userStatus('.$user['uid'].',0)">撤下</a>';
                            break;
                        case -1:
                            echo '<a href="javascript:;" class="btn btn-small" onclick="userStatus('.$user['uid'].',0)">恢复</a>';
                            break;
                        default:
                            echo '<a href="javascript:;" class="btn btn-small disabled">未知</a> <a href="javascript:;" class="btn btn-small red" onclick="userStatus('.$user['uid'].',-1)">删除</a>';
                            break;
                    }
                    ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
            }
            echo '</div><div class="col s12 center-align "><a href="javascript:;" class="btn-flat waves-effect waves-light-blue grey-text text-darken-1" onclick="loadData(this, formatUserInfo);">加载更多</a></div>';
        }
        ?>
    </div>
</section>

<script type="text/javascript">
    var _getDataPara = '<?php echo $actNavBar;?>';
    var dataPage = 1, dataApiUrl = '<?php echo base_url("User/getUserListAJAX");?>';

    function userStatus (uid, s) {
        if (!uid) { Materialize.toast('信息出错，请刷新后重试', 3000, 'danger');return; }
        $.ajax({
            url: '<?php echo base_url("User/userStatus");?>',
            data:{ uid:uid, status: s, a:Math.random()},
            type: "POST",
            dataType: "json",
            success: function(d){  //alert(d);return;
                if(d.status==1){
                    Materialize.toast(d.msg, 1000, 'success', function(){
                        _changeUserStatus(uid, s);
                    });
                }else{
                    Materialize.toast(d.msg, 3000, 'danger');
                }
            },
            error: function(){
                Materialize.toast('通信失败，请稍后再试', 3000, 'danger');
            }
        });
    }

    function _changeUserStatus (uid, s) {
        switch(s){
            case -1 : $('#user_'+uid).html('<a href="javascript:;" class="btn btn-small" onclick="userStatus('+ uid +',0)">恢复</a>'); break;
            case 0 : $('#user_'+uid).html('<a href="javascript:;" class="btn btn-small green" onclick="userStatus('+ uid +',1)">发布</a> <a href="<?php echo base_url("User/edit?id=");?>'+uid+'" class="btn btn-small blue">编辑</a> <a href="javascript:;" class="btn btn-small red" onclick="userStatus('+ uid +',-1)">删除</a>'); break;
            case 1 : $('#user_'+uid).html('<a href="javascript:;" class="btn btn-small orange" onclick="userStatus('+ uid +',0)">撤下</a>'); break;
        }
    }

    function formatUserInfo(data){
        if (data.length == 0) {
            dataPage = 'all';
            Materialize.toast('全部用户已加载～', 1500, 'danger');return;
        }
        var htmlStr = '';
        $.each(data, function(i,o){
            htmlStr += '<div class="col s6 m3 l2"><div class="card image-card"><div class="image"><img src="<?php echo UPLOAD_IMG_URL;?>' + formatDate(o.create_time) + '/' + o.photo + '" alt=""><a href="<?php echo base_url('User/info');?>?id=' + o.uid +'" class="link"></a></div><div class="content user-list"><h5>'+o.name+'</h5><div id="user_'+o.uid+'">';

            switch (o.status){
                case '0' : 
                    htmlStr += '<a href="javascript:;" class="btn btn-small green" onclick="userStatus('+o.uid+',1)">发布</a> <a href="<?php echo base_url("User/edit?id=");?>'+o.uid+'" class="btn btn-small blue">编辑</a> <a href="javascript:;" class="btn btn-small red" onclick="userStatus('+o.uid+',-1)">删除</a>'; 
                    break;
                case '1' : 
                    htmlStr += '<a href="javascript:;" class="btn btn-small orange" onclick="userStatus('+o.uid+',0)">撤下</a>';
                    break;
                case '-1' : 
                    htmlStr += '<a href="javascript:;" class="btn btn-small" onclick="userStatus('+o.uid+',0)">恢复</a>';
                    break;
                default: 
                    htmlStr += '<a href="javascript:;" class="btn btn-small disabled">未知</a> <a href="javascript:;" class="btn btn-small red" onclick="userStatus('+o.uid+',-1)">删除</a>';
                    break;
            }
            htmlStr += '</div></div></div></div>';
        });
        $('#userList').append(htmlStr);
    }
</script>
<script type="text/javascript" src="<?php echo STATIC_FILE_DIR;?>hnpoker/js/hpa-admin.js"></script>



