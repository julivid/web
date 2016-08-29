<style type="text/css">
.timer-ctl .btn, .timer-ctl .btn-small { padding: 0 1rem; }
.timer-ctl-title { font-size: 16px; font-weight: bold; padding-bottom: 10px;}
.timer-ctl-content { font-size: 22px; color: #ff6f00;}
.timer-ctl-content .btn { line-height: 30px;}
.timer-ctl-content .btn-small { line-height: 25px; font-size: 14px;}
.timer-ctl-content i { cursor: pointer;}
.timer-ctl-content .btn i { font-size: 22px;}

.row .col .timer-ctl-main, .row .col.timer-ctl-nopadding { padding-right: 0;}
.row .col .blinds-ctl-list { height: 320px; border: 1px solid #41bef7; padding: 0; overflow-y: auto; overflow-x: hidden;}
.blinds-ctl-list ul { margin: 0; padding: 0;}
.blinds-ctl-list ul li { margin:0; width: 100%; background: rgba(65, 190, 247, 0.3); padding: 5px 0; border-bottom: 1px solid #ccc; font-weight: 600;}
.blinds-ctl-list ul li.history { background: #eee; color: #999; font-weight: 200;}
.blinds-ctl-list ul li.active { background: #fff; line-height: 26px; border: 1px solid #41bef7; border-bottom-width: 2px; border-top-width: 2px; font-size: 22px; color: #ff6f00; }
.blinds-ctl-list ul li span.left { padding-left:8px;}
.blinds-ctl-list ul li span.right { padding-right:8px;}
.blinds-ctl-list ul li.active span { color: #555; font-size: 16px;}

.btn.red, .btn.green { padding: 0 2rem;}
.blinds-restart { width: 100%; display: inline-block; padding: 10px 0; cursor: pointer; border:1px dashed #29b6f6; font-weight: 600;}
.blinds-restart.history { background: #f3f1f2; border:1px dashed gray;}
.blinds-restart.current { border:1px solid #ff9800; color: #ef6c00;}
.blinds-restart.active { background: #29b6f6; border:1px solid #039be5; color: #fff;}

#blindsRaiseTimeEdit { font-size: 18px; }

    .dropdown-content{ max-height: 180px;}
    #blinds_list .btn { padding: 0 10px;}
    #toast-container { z-index: 1005; }
</style>

<!-- Main Content -->
<section class="content-wrap">
    <!-- Breadcrumb -->
    <div class="page-title">

        <div class="row">
            <div class="col s12 m9 l10">
                <ul>
                    <li>
                        <a href="<?php echo base_url();?>"><i class="fa fa-home"></i> 首页</a>  <i class="fa fa-angle-right"></i>
                    </li>

                    <li>
                        <a href='javascript:;'>计时器管理</a> <i class='fa fa-angle-right'></i>
                    </li>
                    <li>
                        <a href='javascript:;'>计时器监控</a>
                    </li>
                </ul>
            </div>
            <div class="col s12 m3 l2 right-align">
                <!--<a href="javascript:;" class="btn grey lighten-3 grey-text z-depth-0 chat-toggle"><i class="fa fa-comments"></i></a>-->
            </div>
        </div>

    </div>
    <!-- /Breadcrumb -->

<form>
    <div class="card-panel timer-ctl">
        <div class="row">
            <div class="col s12 l4 timer-ctl-nopadding">
                <?php
                if ($matchInfo[0]['status']==0) {
                    echo '<div class="col s12"><h3>赛事未发布</h3></div>';
                }else if($matchInfo[0]['status']==3){
                    echo '<div class="col s12"><h3>赛事已结束</h3></div>';
                }else if($matchInfo[0]['status']==9){
                    echo '<div class="col s12"><h3>赛事已删除</h3></div>';
                }else{
                ?>
                <div class="col s12">
                    <a href="<?php echo base_url('Timer/monitor/?id='.$timerInfo[0]['tid']);?>" target="_blank">查看计时器显示页面</a>
                </div>
                <div class="col s12">
                        <a href="javascript:;" onclick="startMatch(this)" class="btn startBtn <?php echo $timerInfo[0]['timer_status']==1 ? 'disabled' : '';?>"><i class="mdi-av-play-arrow"></i> 开始比赛</a> &nbsp; 
                        <a href="javascript:;" onclick="pauseMatch(this)" class="btn pauseBtn <?php echo $timerInfo[0]['timer_status'] != 1 ? 'disabled' : '';?>"><i class="mdi-av-pause"></i> 暂停比赛</a>
                </div>
                <div class="col s12">
                    <a href="javascript:;" onclick="showImg(this)" class="btn showImgBtn <?php echo $timerInfo[0]['timer_status'] == 3 ? 'disabled' : '';?>"><i class="mdi-image-photo"></i> 显示图片</a> &nbsp; 
                    <a href="javascript:;" onclick="showTimer(this)" class="btn showTimerBtn <?php echo $timerInfo[0]['timer_status'] !=3 ? 'disabled' : '';?>"><i class="mdi-social-poll"></i> 显示计时器</a>
                </div>
                <div class="col s12 timer-ctl-nopadding">
                    <a href="<?php echo base_url('Timer/blinds?id='.$timerInfo[0]['tid']);?>" class="btn"><i class="mdi-editor-format-list-numbered"></i> 修改盲注列表</a>
                    <a href="#timerBlindsReStart" class="btn modal-trigger"><i class="mdi-action-autorenew"></i> 启动盲注级别</a>
                </div>
                <div class="col s12">
                    <div class="timer-ctl-title left" style="width:80px; text-align:center;">总人数</div>
                    <div class="timer-ctl-content left">
                        <a href="javascript:;" onclick="playerChgNum('T+')" class="btn red"><i class="mdi-content-add-circle"></i></a>  &nbsp; 
                        <a href="javascript:;" onclick="playerChgNum('T-')" class="btn green"><i class="mdi-content-remove-circle"></i></a>
                    </div>
                </div>
                <div class="col s12">
                    <div class="timer-ctl-title left" style="width:80px; text-align:center;">剩余人数</div>
                    <div class="timer-ctl-content left">
                        <a href="javascript:;" onclick="playerChgNum('L+')" class="btn red"><i class="mdi-content-add-circle"></i></a>  &nbsp; 
                        <a href="javascript:;" onclick="playerChgNum('L-')" class="btn green"><i class="mdi-content-remove-circle"></i></a>
                    </div>
                </div>
                <div class="col s12">
                    <div class="timer-ctl-title left" style="width:80px; text-align:center;">奖励人数</div>
                    <div class="timer-ctl-content left">
                        <a href="javascript:;" onclick="playerChgNum('P+')" class="btn red"><i class="mdi-content-add-circle"></i></a>  &nbsp; 
                        <a href="javascript:;" onclick="playerChgNum('P-')" class="btn green"><i class="mdi-content-remove-circle"></i></a>
                    </div>
                </div>
                <div class="col s12 ">
                    <div style="padding-top: 30px; padding-left: 50px;">
                        <a href="javascript:;" onclick="matchOver()" class="btn btn-small red MOBtn">结束本场赛事</a>
                    </div>
                </div>
                <?php } ?>
            </div>

            <div class="col s12 l8 timer-ctl-nopadding">
                
                <div class="col s12 l6 timer-ctl-nopadding">
                    <div class="col s12">
                        <div class="timer-ctl-title">赛事名称</div>
                        <div class="timer-ctl-content"><span id="timer_match_name"><?php echo $timerInfo[0]['name'];?> </span></div>
                    </div>
                    <div class="col s12">
                        <div class="timer-ctl-title">剩余人数 / 奖励人数 / 总人数</div>
                        <div class="timer-ctl-content">
                            <span class="timer_left_player"><?php echo $timerInfo[0]['left_player'];?> </span> / 
                            <span class="timer_prize_player"><?php echo $timerInfo[0]['prize_player'];?> </span> / 
                            <span class="timer_total_player"><?php echo $timerInfo[0]['total_player'];?> </span>
                        </div>
                    </div>
                    <div class="col s12">
                        <div class="timer-ctl-title">涨盲时间</div>
                        <div class="timer-ctl-content">
                            <span id="timer_blinds_raise_time"><?php echo $timerInfo[0]['blinds_raise_time'];?></span> minutes
                            <a class="btn btn-small" href="javascript:;" onclick="editBlindsRaiseTime()">修改</a>
                        </div>
                    </div>
                    <div class="col s12">
                        <div class="timer-ctl-title">总记分牌 / 平均记分牌</div>
                        <div class="timer-ctl-content" id="timer_chips">
                            <!--<a href="javascript:;" onclick="changeTotalChips()" class="btn btn-small">更改</a> -->
                            <?php echo $timerInfo[0]['initial_chips'] * $timerInfo[0]['total_player'];?>/<?php echo $timerInfo[0]['left_player'] == 0 ? '0' : floor($timerInfo[0]['initial_chips'] * $timerInfo[0]['total_player'] / $timerInfo[0]['left_player']);?>
                        </div>
                    </div>
                </div>

                <div class="col s12 l6">
<?php
if (empty($blindsInfo)) {
    echo '<div class="alert">暂无盲注信息！</div>';
}else{ //var_dump($blindsInfo);
    echo '<div class="col s12 blinds-ctl-list center"><ul>';
    foreach ($blindsInfo as $key => $blinds) {
        echo '<li data-levelid="'.$blinds['index'].'" ';
        if ($blinds['blinds_level']==-1) { //休息
            if ($blinds['index']<$timerInfo[0]['current_level_index']) {
                echo 'class="history"';
            }elseif ($blinds['index']==$timerInfo[0]['current_level_index']) {
                echo 'class="active"';
            }
            echo '>休息 '.$blinds['break_time'].' 分钟</li>';
        }else{ //比赛级别
            if ($blinds['index']<$timerInfo[0]['current_level_index']) {
                echo 'class="history"';
            }elseif ($blinds['index']==$timerInfo[0]['current_level_index']) {
                echo 'class="active"';
            }
            echo '><span class="left">'.$blinds['blinds_ante'].'</span> Level '.$blinds['blinds_level'].' <span class="right">'.$blinds['blinds_num'].'</span></li>';
        }
    }
    //echo '<li class="active"><span class="left">9999999</span> Level 99 <span class="right">9999999/9999999</span></li>';
    echo '</ul></div>';
}
?>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="timer_id" value="<?php echo $timerInfo[0]['tid'];?>">
</form>
</section>
<!-- /Main Content -->


<div id="timerBlindsReStart" class="modal">
    <div class="modal-content">
        <div class="row">
            <div class="col s12"><h5>选取启动的盲注级别</h5></div>
<?php
if (empty($blindsInfo)) {
    echo '<div class="alert">暂无盲注信息！</div>';
}else{ //var_dump($blindsInfo);
    foreach ($blindsInfo as $key => $blinds) {
        echo '<div class="col s12 l2 center"><span data-restartindex="'.$blinds['index'].'" class="blinds-restart ';
        if ($blinds['index']<$timerInfo[0]['current_level_index']) {
            echo 'history';
        }elseif ($blinds['index']==$timerInfo[0]['current_level_index']) {
            echo 'current';
        }
        echo ' ">'
        .( $blinds['blinds_level']==-1?'休息'.$blinds['break_time'].'m' : 'Level '.$blinds['blinds_level'] )
        .'</span></div>';
    }
}
?>
        </div>
        <input type="hidden" id="restartLeveIndex" value="">
    </div>
    <div class="modal-footer">
        <a href="javascript:;" class="modal-action modal-close waves-effect waves-blue btn-flat ">取消</a>
        <a href="javascript:;" onclick="startNewLevel()" class="modal-action waves-effect waves-green btn-flat ">确认启动</a>
    </div>
</div>
<div id="blindsRaiseTime" class="modal">
    <div class="modal-content">
        <h5>修改涨盲时间</h5>
        <div class="row">
            <div class="input-field col s12">
                <i class="mdi-action-alarm prefix"></i>
                <input id="blindsRaiseTimeEdit" type="text" value="" placeholder="涨盲时间">
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <a href="javascript:;" class="modal-action modal-close waves-effect waves-blue btn-flat ">取消</a>
        <a href="javascript:;" onclick="editBlindsTime()" class="modal-action waves-effect waves-green btn-flat ">确认修改</a>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function(){
    $('#timerBlindsReStart .blinds-restart').on('click', function () {
        if ($(this).hasClass('active')) {
            $(this).removeClass('active');
            $('#restartLeveIndex').val('');
            //console.log($('#restartLeveIndex').val());
            return;
        }
        $('#timerBlindsReStart .blinds-restart').removeClass('active');
        $(this).addClass('active');
        $('#restartLeveIndex').val($(this).data('restartindex'));
        //console.log($('#restartLeveIndex').val());
    });

});

var tid = $('#timer_id').val();

function startMatch (obj) {
    if ( obj && $(obj).hasClass('disabled') ) { return; }
    if (!tid) {
        Materialize.toast('参数错误', 3000, 'danger'); return;
    }
    $('.startBtn').addClass('disabled');
    $.ajax({
        url: '<?php echo base_url("Timer/startMatch");?>',
        data:{ tid:tid, a:Math.random()},
        type: "POST",
        dataType: "json",
        success: function(d){  //console.log(d);return;
            if(d.status==1){
                $('.pauseBtn').removeClass('disabled');
                Materialize.toast(d.msg, 1000, 'success');
            }else{
                $('.startBtn').removeClass('disabled');
                Materialize.toast(d.msg, 3000, 'danger');
            }
        },
        error: function(){
            $('.startBtn').removeClass('disabled');
            Materialize.toast('通信失败，请稍后再试', 3000, 'danger');
        }
    });
}
function pauseMatch (obj) {
    if ( obj && $(obj).hasClass('disabled') ) { return; }
    if (!tid) {
        Materialize.toast('参数错误', 3000, 'danger'); return;
    }
    $('.pauseBtn').addClass('disabled');
    $.ajax({
        url: '<?php echo base_url("Timer/pauseMatch");?>',
        data:{ tid:tid, a:Math.random()},
        type: "POST",
        dataType: "json",
        success: function(d){  //console.log(d);return;
            if(d.status==1){
                $('.startBtn').removeClass('disabled');
                Materialize.toast(d.msg, 1000, 'success');
            }else{
                $('.pauseBtn').removeClass('disabled');
                Materialize.toast(d.msg, 3000, 'danger');
            }
        },
        error: function(){
            $('.pauseBtn').removeClass('disabled');
            Materialize.toast('通信失败，请稍后再试', 3000, 'danger');
        }
    });
}
function matchOver () {
    if ( !confirm('确定结束赛事吗？结束后将不可操作') ) { return; }
    if (!tid) {
        Materialize.toast('参数错误', 3000, 'danger'); return;
    }
    $('.MOBtn').addClass('disabled');
    
    $.ajax({
        url: '<?php echo base_url("Timer/matchOver");?>',
        data:{ tid:tid, a:Math.random()},
        type: "POST",
        dataType: "json",
        success: function(d){  //console.log(d);return;
            if(d.status==1){
                Materialize.toast(d.msg, 1000, 'success', function(){
                    window.location.reload();
                });
            }else{
                $('.MOBtn').removeClass('disabled');
                Materialize.toast(d.msg, 3000, 'danger');
            }
        },
        error: function(){
            $('.pauseBtn').removeClass('disabled');
            Materialize.toast('通信失败，请稍后再试', 3000, 'danger');
        }
    });
}

function showImg (obj) {
    if ( obj && $(obj).hasClass('disabled') ) { return; }
    if (!tid) {
        Materialize.toast('参数错误', 3000, 'danger'); return;
    }
    $('.showImgBtn').addClass('disabled');
    $.ajax({
        url: '<?php echo base_url("Timer/showMainPhoto");?>',
        data:{ tid:tid, a:Math.random()},
        type: "POST",
        dataType: "json",
        success: function(d){  //console.log(d);return;
            if(d.status==1){
                $('.pauseBtn').addClass('disabled');
                $('.startBtn').removeClass('disabled');
                $('.showTimerBtn').removeClass('disabled');
                Materialize.toast(d.msg, 1000, 'success');
            }else{
                $('.showImgBtn').removeClass('disabled');
                Materialize.toast(d.msg, 3000, 'danger');
            }
        },
        error: function(){
            $('.showImgBtn').removeClass('disabled');
            Materialize.toast('通信失败，请稍后再试', 3000, 'danger');
        }
    });
}

function showTimer (obj) {
    if ( obj && $(obj).hasClass('disabled') ) { return; }
    if (!tid) {
        Materialize.toast('参数错误', 3000, 'danger'); return;
    }
    $('.showTimerBtn').addClass('disabled');
    $.ajax({
        url: '<?php echo base_url("Timer/showMainTimer");?>',
        data:{ tid:tid, a:Math.random()},
        type: "POST",
        dataType: "json",
        success: function(d){  //console.log(d);return;
            if(d.status==1){
                $('.showImgBtn').removeClass('disabled');
                Materialize.toast(d.msg, 1000, 'success');
            }else{
                $('.showTimerBtn').removeClass('disabled');
                Materialize.toast(d.msg, 3000, 'danger');
            }
        },
        error: function(){
            $('.showTimerBtn').removeClass('disabled');
            Materialize.toast('通信失败，请稍后再试', 3000, 'danger');
        }
    });
}


function editBlindsRaiseTime() {
    var t = Number($('#timer_blinds_raise_time').text());
    $('#blindsRaiseTimeEdit').val(t);
    $('#blindsRaiseTime').openModal();
}
function editBlindsTime () {
    if (!tid) {
        Materialize.toast('参数错误', 3000, 'danger'); return;
    }
    var time = $('#blindsRaiseTimeEdit').val();
    if (time==0) {
        Materialize.toast('时间不能为0', 3000, 'danger'); return;
    }
    $.ajax({
        url: '<?php echo base_url("Timer/editBlindsRaiseTimeAJAX");?>',
        data:{ tid:tid, time:time, a:Math.random()},
        type: "POST",
        dataType: "json",
        success: function(d){  //console.log(d);return;
            if(d.status==1){
                $('#timer_blinds_raise_time').text(time);
                Materialize.toast(d.msg, 1000, 'success',function() {
                    $('#blindsRaiseTime').closeModal();
                });
            }else{
                Materialize.toast(d.msg, 3000, 'danger',function() {
                    $('#blindsRaiseTime').closeModal();
                });
            }
            
        },
        error: function(){
            Materialize.toast('通信失败，请稍后再试', 3000, 'danger',function() {
                $('#blindsRaiseTime').openModal();
            });
        }
    });
}

function playerChgNum (type) {
    if (!tid) {
        Materialize.toast('参数错误', 3000, 'danger'); return;
    }
    $.ajax({
        url: '<?php echo base_url("Timer/playerChangeNum");?>',
        data:{ tid:tid, type:type, a:Math.random()},
        type: "POST",
        dataType: "json",
        success: function(d){  //console.log(d);return;
            if(d.status==1){
                _chgPlayerNum(type);
                Materialize.toast(d.msg, 1000, 'success');
            }else{
                Materialize.toast(d.msg, 3000, 'danger');
            }
        },
        error: function(){
            Materialize.toast('通信失败，请稍后再试', 3000, 'danger');
        }
    });
}
function _chgPlayerNum(type) {
    switch(type){
        case 'L-' : $('.timer_left_player').text( (Number($('.timer_left_player').text()) - 1) ); break;
        case 'L+' : $('.timer_left_player').text( (Number($('.timer_left_player').text()) + 1) ); break;
        case 'T+' : $('.timer_total_player').text( (Number($('.timer_total_player').text()) + 1) ); break;
        case 'T-' : $('.timer_total_player').text( (Number($('.timer_total_player').text()) - 1) ); break;
        case 'P+' : $('.timer_prize_player').text( (Number($('.timer_prize_player').text()) + 1) ); break;
        case 'P-' : $('.timer_prize_player').text( (Number($('.timer_prize_player').text()) - 1) ); break;
    }
    chgChips();
}
function chgChips () {
    var initChips = <?php echo $timerInfo[0]['initial_chips'];?>;
    $('#timer_chips').text( (Number($('.timer_total_player').text()) * initChips) + '/' + Math.floor( Number($('.timer_total_player').text()) / Number($('.timer_left_player').text()) * initChips ) );
}


function startNewLevel () {
    var levelIndex = $('#restartLeveIndex').val();
    if (levelIndex=="" || !tid) {
        Materialize.toast('启动盲注级别参数错误', 3000, 'danger');
        return;
    }
    //_timerLevelMonitor(levelIndex);$('#timerBlindsReStart').closeModal();return; //DEBUG
    $.ajax({
        url: '<?php echo base_url("Timer/startNewLevel");?>',
        data:{ tid:tid, level_index:levelIndex, a:Math.random()},
        type: "POST",
        dataType: "json",
        success: function(d){  //console.log(d);return;
            if(d.status==1){
                _timerLevelMonitor(levelIndex);
                _timerLevelOption(levelIndex);
                $('#timerBlindsReStart').closeModal();
                Materialize.toast(d.msg, 1000, 'success', function () {
                    $('#restartLeveIndex').val('');
                    $('#timerBlindsReStart .blinds-restart').removeClass('active');
                    $('.startBtn').addClass('disabled');
                    $('.pauseBtn').removeClass('disabled');
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

function _timerLevelMonitor (levelIndex) {
    var obj = $('.blinds-ctl-list ul li');
    obj.removeClass('history active');
    obj.each(function (i,o) {
        if($(o).data('levelid') < levelIndex){
            $(o).addClass('history');
        }else if ($(o).data('levelid') == levelIndex){
            $(o).addClass('active');
        }
    });
}

function _timerLevelOption (levelIndex) {
    var obj = $('.blinds-restart');
    obj.removeClass('history current');
    obj.each(function (i,o) {
        if($(o).data('restartindex') < levelIndex){
            $(o).addClass('history');
        }else if ($(o).data('restartindex') == levelIndex){
            $(o).addClass('current');
        }
    });
}


</script>

