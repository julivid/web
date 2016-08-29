<style type="text/css">
    .table .btn { padding: 0 10px;}
    table tr.match-detele:not(.btn) { color: #999; text-decoration:line-through; }
    
    .MS_disabled, .MS_default, .MS_info, .MS_warning, .MS_danger { font-weight: 600; padding: 5px 8px; border-radius: 5px;}
    .MS_disabled { color: #fff; background: #ccc; }
    .MS_default { color: #fff; background: #81C784; }
    .MS_info { color: #fff; background: #29b6f6; }
    .MS_warning { color: #fff; background: #E69600; }
    .MS_danger { color: #fff; background: #E60400; }

    .table-bordered, .table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th { border-color: #989898;}
    .tab-res label { margin-right: 5px; background: #29b6f6; color: #fff; display: inline-block; padding: 2px 5px; border-radius: 2px; }
    .table-res { padding: 20px; border: 1px solid #29b6f6;}

    .card .title h5{ font-size: 20px; }
    .user-info { border: 1px dotted #ccc; margin-top: 0px;}
    .LTitle, .RContent { display: inline-block; padding: 10px 10px; }
    .LTitle { color: #565656; font-size: 18px; width: 80px; text-align: center;}
    .RContent { color: #212121; font-size: 26px; font-weight: 600;}
    #user_code { font-size: 16px; }
    #user_chips { font-size: 22px; }
    .btn-small.orange { margin-top: 20px; }
</style>

<section class="content-wrap">
    <div class="page-title">

        <div class="row">
            <div class="col s12 m9 l10">
                <ul>
                    <li>
                        <a href="<?php echo base_url();?>"><i class="fa fa-home"></i> 首页</a>  <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href='javascript:;'>CPG赛事</a> <i class='fa fa-angle-right'></i>
                    </li>
                    <li>
                        <a href='javascript:;'>晋级赛列表</a>
                    </li>
                </ul>
            </div>
            <div class="col s12 m3 l2 right-align">
                <!--<a href="javascript:;" class="btn grey lighten-3 grey-text z-depth-0 chat-toggle"><i class="fa fa-comments"></i></a>-->
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col s12 ">
            <div class="card">
                <div class="title">
                    <h5>
            <?php 
                echo empty( $matchType[$matchInfo[0]['tid']] ) ? '未知赛事 ' : $matchType[$matchInfo[0]['tid']]; 
                echo empty( $matchInfo[0]['name'] ) ? '' : $matchInfo[0]['name'];
                echo empty( $matchInfo[0]['date'] ) ? '' : ' (时间:'.$matchInfo[0]['date'].' '.$matchInfo[0]['time'].')';
            ?>
                    </h5>
                    <a class="minimize" href="#"><i class="mdi-navigation-expand-less"></i></a>
                </div>
                <div class="content">
                <?php
                if ($matchInfo[0]['status']==9) {
                    echo '<div class="alert"><h3>赛事已删除</h3></div>';
                }else{
                ?>
                    <form>
                        <div class="row">
                            <div class="col s12 m6 ">
                                <div class="col s12">
                                    <ul class="user-info">
                                        <li><span class="LTitle">姓 名</span><span id="userNameShow" class="RContent">&nbsp;</span></li>
                                        <li><span class="LTitle">身份证</span><span id="userCardShow" class="RContent">&nbsp;</span></li>
                                    </ul>
                                    <input type="hidden" id="matchId" value="<?php echo empty( $matchInfo[0]['mid'] ) ? '' : $matchInfo[0]['mid'];?>">
                                </div>
                                <div class="col s12">
                                    <div class="col s12 m8">
                                        <div class="input-field">
                                            <input id="user_card" type="text" value="">
                                            <label for="user_card">身份证号</label>
                                        </div>
                                    </div>
                                    <div class="col s12 m4">
                                        <a href="javascript:;" onclick="getUserInfo(2)" class="btn btn-small orange">身份证查询</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col s12 m6">
                                <div class="col s12">
                                    <div class="input-field">
                                        <input id="user_code" type="text" value="" placeholder="请扫描/录入赛事二维码">
                                        <!--<label for="user_code">二维码</label>-->
                                    </div>
                                </div>
                                <div class="col s12">
                                    <div class="input-field">
                                        <input id="user_chips" type="text" value="" placeholder="请输入玩家筹码量">
                                        <!--<label for="user_chips">筹码</label>-->
                                    </div>
                                </div>
                                <div class="col s12">
                                    <a href="javascript:;" onclick="getUserInfo(1)" class="btn green">查询</a> 
                                    <a href="javascript:;" onclick="addPromotionPlayer()" class="btn red disabled" >添加</a> 
                                    <a href="javascript:;" onclick="window.history.back();" class="btn">返回</a>
                                </div>
                            </div>
                        </div>
                    </form>
                <?php } ?>
                </div>
            </div>
        </div>
        <div class="col s12 ">
            <div class="card-panel">
                <div class="col s3 m2">
                    <input class="with-gap" name="tab_type" type="radio" id="tab_type_9" data-tabtype="9" />
                    <label for="tab_type_9">9人桌</label>
                </div>
                <div class="col s3 m2">
                    <input class="with-gap" name="tab_type" type="radio" id="tab_type_10" data-tabtype="10" checked />
                    <label for="tab_type_10">10人桌</label>
                </div>
                <div class="col s3 m4">
                    <div class="input-field">
                        <input id="tab_start_num" type="text" value="1">
                        <label for="tab_start_num">起始牌桌</label>
                    </div>
                </div>
                <div class="col s6 m4">
                    <a href="javascript:;" onclick="randomTable()" class="btn <?php echo $matchInfo[0]['status']==9 ? 'disabled':'';?>">分桌</a>
                </div>
            </div>
            <div class="card-panel">
                <div style="margin-bottom: 20px;">
                    <a href="<?php echo base_url('Promotion/downloads?id='.$matchInfo[0]['mid']);?>" class="btn ">下载运动员名单</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="match_table">
                        <thead>
                            <tr>
                                <th>UID</th>
                                <th>姓名</th>
                                <th>筹码</th>
                                <th>身份证</th>
                                <th>座位</th>
                                <th>小票状态</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                    <?php
                    if (empty($playerList)) {
                        echo '<tr class="no-data-tr"><td colspan="7"><h5 class="center red-text">暂无参赛选手信息</h5></td></tr>';
                    }else{
                        $MSCfg = $this->config->item('match_status_cfg');
                        foreach ($playerList as $player) {
                            echo '<tr id="PROP_'.$player['id'].'">
                                <th>'.$player['uid'].'</th>
                                <td>'.$player['user_name'].'</td>
                                <td>'.$player['chips'].'</td>
                                <td>'.$player['user_card'].'</td>
                                <td>'.$this->func->matchSeatFormat($player['match_seat']).'</td>
                                <td>'.$player['print_status'].'次打印</td>
                                <td><a href="javascript:;" class="btn red" onclick="delProPlayer('.$player['id'].')">删除</a></td>
                            </tr>';
                        }
                    }
                    ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</section>
<!-- /Main Content -->

<script type="text/javascript">
    function getUserInfo(type) {
        var code = $('#user_code').val(), card = $('#user_card').val();
        if (type ==1 && (!code || code.length!=40) ) { //alert(code.length);
            Materialize.toast('二维码格式错误', 2000, 'danger');
            return;
        }
        if (type ==2 && (!card) ) {
            Materialize.toast('身份证格式错误', 2000, 'danger');
            return;
        }
        $.ajax({
            url: '<?php echo base_url("Promotion/getUserInfoAJAX");?>',
            data:{ t:type, code:code, card:card, a:Math.random()},
            type: "POST",
            dataType: "json",
            success: function(d){  //console.log(d);return;
                if(d.status==1){
                    $('#userNameShow').html(d.data.user_name);
                    $('#userCardShow').html(d.data.user_card);
                    $('#user_code').val(d.data.qr_code);
                    //console.log(d);
                    Materialize.toast(d.msg, 1000, 'success', function(){
                        $('.btn.red').removeClass('disabled');
                    });
                }else{
                    Materialize.toast(d.msg, 2000, 'danger');
                }
            },
            error: function(){
                Materialize.toast('通信失败，请稍后再试', 2000, 'danger');
            }
        });
    }

    function addPromotionPlayer() {
        if ($('.btn.red').hasClass('disabled')) {
            return ;
        }
        var code = $('#user_code').val(), chips = Number( $('#user_chips').val() );
        if (!code || code.length!=40) {
            Materialize.toast('二维码输入错误', 2000, 'danger');
            return;
        }
        if (chips < 1) {
            Materialize.toast('筹码数量错误', 2000, 'danger');
            return;
        }
        var mid = $('#matchId').val();
        if (!mid) {
            Materialize.toast('赛事信息错误', 2000, 'danger');
            return;
        }
        $.ajax({
            url: '<?php echo base_url("Promotion/addPlayerAJAX");?>',
            data:{ code:code, mid:mid, chips:chips, a:Math.random()},
            type: "POST",
            dataType: "json",
            success: function(d){ //console.log(d);return;
                if(d.status==1){
                    _matchDataAddition(d.data);
                    Materialize.toast(d.msg, 1000, 'success', function(){
                        _clearFormData();
                    });
                }else{
                    Materialize.toast(d.msg, 2000, 'danger');
                }
            },
            error: function(){
                Materialize.toast('通信失败，请稍后再试', 2000, 'danger');
            }
        });
    }

    function delProPlayer(id) {
        if (!id) {
            Materialize.toast('运动员信息错误，请刷新后再试一次', 2000, 'danger');
        }
        if (!confirm("确认删除该运动员信息吗？")) {
            return ;
        }
        $.ajax({
            url: '<?php echo base_url("Promotion/delPlayerAJAX");?>',
            data:{ id:id, a:Math.random()},
            type: "POST",
            dataType: "json",
            success: function(d){ //console.log(d);return;
                if(d.status==1){
                    $('#PROP_'+id).remove();
                    Materialize.toast(d.msg, 1000, 'success');
                }else{
                    Materialize.toast(d.msg, 2000, 'danger');
                }
            },
            error: function(){
                Materialize.toast('通信失败，请稍后再试', 2000, 'danger');
            }
        });
    }

    function randomTable() {
        var mid = $('#matchId').val(), 
            tab_type=$('input[name="tab_type"]:checked').data('tabtype'),
            tab_start_num=$('#tab_start_num').val();
        if (!mid) {
            Materialize.toast('赛事信息错误', 2000, 'danger');
            return;
        }
        if (!tab_start_num) {
            Materialize.toast('起始牌桌不能为空', 2000, 'danger');
            return;
        }
        $.ajax({
            url: '<?php echo base_url("Promotion/randomTableAJAX");?>',
            data:{ mid:mid, tab_type:tab_type, tab_start:tab_start_num, a:Math.random()},
            type: "POST",
            dataType: "json",
            success: function(d){ //console.log(d);return;
                if(d.status==1){
                    Materialize.toast(d.msg, 1000, 'success', function(){
                        window.location.reload();
                    });
                }else{
                    Materialize.toast(d.msg, 2000, 'danger');
                }
            },
            error: function(){
                Materialize.toast('通信失败，请稍后再试', 2000, 'danger');
            }
        });
    }


    function _matchDataAddition(data) {
        //console.log(data);
        $('.no-data-tr').remove();
        var html_str = '<tr><th>'+data.uid+'</th><td>'+data.user_name+'</td><td>'+data.chips+'</td><td>'+data.user_card+'</td><td>未分桌</td><td>0次打印</td><td><a href="javascript:;" class="btn red" onclick="delProPlayer('+data.id+')">删除</a></td></tr>';
        $('#match_table tbody').append(html_str);
    }

    function _clearFormData() {
        $('#userNameShow').html('');
        $('#userCardShow').html('');
        $('#user_code').val('');
        $('#user_chips').val('');
        $('#user_card').val('');
        $('form .btn.red').addClass('disabled');
    }

</script>
