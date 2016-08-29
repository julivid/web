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
<?php
if (empty( $userDetail[0] )) {
    echo '<div class="alert"> 用户信息出错 ... </div><p class="left-align"> <a class="btn" href="javascript:;" onclick="window.history.back()">返回</a> </p>';
}else{
?>
    <div class="card-panel">
        <div class="row">
            <div class="col s12 m4">
                <img src="<?php echo UPLOAD_IMG_URL.date('Ym', $userDetail[0]['create_time']).'/'.$userDetail[0]['photo'];?>" alt="用户姓名">
            </div>
            <div class="col s12 m8">
                <p><input type="text" id="user_name" style="font-size:22px;" value="<?php echo $userDetail[0]['name'];?>" placeholder="请输入姓名"></p>
                <h4>性别： </h4>
                <p>
                    <select id="user_gender">
                        <option disabled="disabled">请选择性别</option>
                        <option <?php echo $userDetail[0]['gender']=='男' ? 'selected="selected"' : '';?> value="男">男</option>
                        <option <?php echo $userDetail[0]['gender']=='女' ? 'selected="selected"' : '';?> value="女">女</option>
                        <option <?php echo $userDetail[0]['gender']=='保密' ? 'selected="selected"' : '';?> value="保密">保密</option>
                    </select>
                </p>
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
                    <textarea class="materialize-textarea" id="user_record"><?php echo $userDetail[0]['record'];?></textarea>
                    <p class="red-text">* 注意，请使用“&lt;p&gt;”与“&lt;/p&gt;”将独立一行的内容隔开，回车并不保证显示时换行。</p>
                </div>
            </div>
        </div>
    </div>
    <p class="left-align">
        <a class="btn green" href="javascript:;" onclick="userEdit();"> 提交 </a>
        <a class="btn" href="javascript:;" onclick="window.history.back()">返回</a>
    </p>
<?php } ?>
</section>
<script type="text/javascript">
    function userEdit () {
        var uid    = '<?php echo $userDetail[0]['uid']; ?>',
            name   = $('#user_name').val(),
            gender = $('#user_gender').val(),
            record = $('#user_record').val();
        if (!uid)    { Materialize.toast('参数错误，请刷新后重试～', 3000, 'danger');return; }
        if (!name)   { Materialize.toast('请填写人员姓名', 3000, 'danger');return; }
        if (!gender) { Materialize.toast('请选择人员性别', 3000, 'danger');return; }
        if (!record) { Materialize.toast('请填写人员履历', 3000, 'danger');return; }

        $.ajax({
            url: '<?php echo base_url("User/userEdit");?>',
            data:{ uid:uid, name:name, gender:gender, record:record, a:Math.random()},
            type: "POST",
            dataType: "json",
            success: function(d){  //alert(d);return;
                if(d.status==1){
                    Materialize.toast(d.msg, 2000, 'success');
                }else{
                    Materialize.toast(d.msg, 3000, 'danger');
                }
            },
            error: function(){
                Materialize.toast('通信失败，请稍后再试', 3000, 'danger');
            }
        });
    }
</script>