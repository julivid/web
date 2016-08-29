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
    <base href="<?php echo base_url();?>" />
    <link rel="icon" type="image/png" href="<?php echo STATIC_FILE_DIR;?>live/cpg.ico">
    <!-- Main -->
    <link rel="stylesheet" type="text/css" href="<?php echo STATIC_FILE_DIR;?>css/materialize.min.css" />
    <!--[if lt IE 9]>
    <script src="<?php echo STATIC_FILE_DIR;?>js/html5shiv.min.js"></script>
    <![endif]-->
    <!-- jQuery -->
    <script type="text/javascript" src="<?php echo STATIC_FILE_DIR;?>js/jquery.min.js"></script>
    <style type="text/css">
    body {  background: #ef5350; font-weight: 600; color: #fff; font-size: 26px; overflow: hidden;}
    .row { margin-right: 0;}
    .row .col { padding-right: 0; padding-bottom: 0;}
    em { font-style: normal; display: block; margin-top: -10px;}
    .left { text-align: left;}
    .right { text-align: right; line-height: 50px; padding-right: 20px;}
    .bottomNone { margin-bottom: 0;}

    .font32 { font-size: 32px;}
    .font40 { font-size: 40px;}
    .font60 { font-size: 60px;}

    .photoBox { width: 100%; position: absolute; top: 0; left: 0; display: none;}
    .photoBox img { width: 100%; height: auto;}

    .timerBox { width: 100%; }
    .timerBox p { margin: 0;}

    .cpgLogo img { width: 100%; margin-top: 50px; margin-left: 20px;}
    .timerArea { background-color: #d32f2f; padding: 0 20px; border-radius: 10px; font-size: 20px;}
    .timerTitle { font-size: 44px;}
    .timerTitle p { margin: 0; padding: 20px 0 0;}
    #timerMain { font-size: 308px; line-height: 288px;}
    #timerMain span { font-family: sans-serif;}
    .timerNow { padding-top: 25px;}
    </style>
</head>

<body>
    <div class="photoBox center">
        <img src="<?php echo STATIC_FILE_DIR;?>img/image-4.jpg">
    </div>
    <div class="timerBox center">
        <div class="row">
            <div class="col s2 cpgLogo">
                <img src="<?php echo STATIC_FILE_DIR;?>live/img/cpglogo.png">
            </div>
            <div class="col s8 timerTitle ">
                <p><?php echo $match_title;?></p>
                <p><span id="match_name"><?php echo $match_name;?></span></p>
            </div>
            <div class="col s2 ">
                <div class="timerNow">
                    <p>当前时间</p>
                    <p id="timerNow"><?php echo date('Y-m-d H:i:s');?></p>
                </div>
            </div>
        </div>
        <div class="row bottomNone">
            <div class="col s2">
                <div class="row">
                    当前级别<em>Current level</em><p class="font60" id="t_current_level"><?php echo $current_level;?></p>
                    <input type="hidden" id="t_current_level_index" value="<?php echo $current_level_index;?>">
                </div>
                <div class="row">
                    参数人数<em>Entrants</em><p class="font40" id="t_total_player"><?php echo $total_player;?></p>
                </div>
                <div class="row">
                    剩余人数<em>Player left</em><p class="font40" id="t_left_player"><?php echo $left_player;?></p>
                </div>
            </div>
            <div class="col s8">
                <div class="row timerArea">
                    <div id="timerMain"><?php echo $cur_level_time_text;?></div>
                    <div class="col s12">
                        <span class="left">当前盲注<em>Current blinds</em></span>
                        <span class="right" id="t_current_blinds"><?php echo $cur_level_blinds;?></span>
                    </div>
                    <div class="col s12">
                        <span class="left">前注<em>Ante</em></span>
                        <span class="right" id="t_current_ante"><?php echo $cur_level_ante;?></span>
                    </div>
                </div>
                <div class="row timerArea" style=" margin-top:10px;">
                    <div class="col s12">
                        <span class="left">下一级别<em>Next blinds</em></span>
                        <span class="right" id="t_next_blinds"><?php echo $next_level_blinds;?></span>
                    </div>
                </div>
            </div>
            <div class="col s2">
                <div class="row">
                    下次休息<em>Next break</em><p class="font60" id="t_next_break"><?php echo $next_break_min;?>m</p>
                </div>
                <div class="row">
                    平均记分牌<em>Avg chips</em><p class="font40" id="t_arg_chips"><?php echo $arg_chips;?></p>
                </div>
                <div class="row">
                    总记分牌<em>Total chips</em><p class="font32" id="t_total_chips"><?php echo $total_chips;?></p>
                </div>
            </div>
        </div>
    </div>
    <div style="display:none;"><audio id="timer_voice" src="<?php echo STATIC_FILE_DIR;?>live/audio/cpg_timer.wav" controls="controls">暂不支持声音。</audio></div>
    <!-- Materialize -->
    <script type="text/javascript" src="<?php echo STATIC_FILE_DIR;?>js/materialize.min.js"></script>

    <script type="text/javascript">

//计时器全局变量。计时器状态:1－开始倒计时，2－暂停，图片显示状态：1－显示图片，0-显示计时器
var matchInterval, dataInterval, 
    matchTime=<?php echo $cur_level_time_left;?>, 
    restTime=<?php echo $next_break_min;?>, 
    tid = <?php echo intval( $timer_id );?>, 
    get_data_frequence = 4*1000, //获取数据频率：4秒
    _TS=0, _SP=0, //_TS:timer status, _SP:show photo
    _CL = <?php echo intval($current_level_index);?>; //当前级别

clearInterval(dataInterval);

$(document).ready(function () {
    
    if(<?php echo $timer_status == 1 ? 1 : 0;?>){
        startMatch();
    }else if(<?php echo $timer_status == 2 ? 1 : 0;?>){
        pauseMatch();
    }else if(<?php echo $timer_status == 3 ? 1 : 0;?>){
        $('#timerMain').text('结束');
    }
    if (<?php echo $show_photo == 1 ? 1 : 0;?>) { pauseMatch(); mainPhotoStatus(1); }

    //showNowTime();
    dataInterval = setInterval(getTimerData, get_data_frequence);
});


//显示当前时间倒计时
function showNowTime () {
    var nowTime = new Date();//创建时间对象实例
    var month = nowTime.getMonth()+1;
    var day   = nowTime.getDate();
    var hours = nowTime.getHours();//获取当前小时数
    var minutes = nowTime.getMinutes();//获取当前分钟数
    var seconds = nowTime.getSeconds();//获取当前秒数
    var timer = nowTime.getFullYear() + "-" + (month>9?month:'0'+month) + "-" + (day>9?day:'0'+day) + " "+((hours>9)?hours:'0'+hours) + ":" + (minutes>9?minutes:'0'+minutes) + ":" + (seconds>9?seconds:'0'+seconds);
    $('#timerNow').html(timer);
    setTimeout("showNowTime()",1000);
}

//获取计时器数据
function getTimerData () {
    $.ajax({
        url: '<?php echo base_url("Timer/getTimerDataAJAX");?>',
        data:{ tid:tid, a:Math.random()},
        type: "POST",
        dataType: "json",
        success: function(d){  //console.log(d);return;
            if(d.status==1){
                matchDataInit(d.data);
            }else{
                showError('error:'+d.msg);
            }
        },
        error: function(){
            showError('通信失败，请稍后再试');
        }
    });
}

function getNextLevelData() {
    $.ajax({
        url: '<?php echo base_url("Timer/getNextLevelData");?>',
        data:{ tid:tid, cur_l:_CL, a:Math.random()},
        type: "POST",
        dataType: "json",
        success: function(d){  //console.log(d);
            if(d.status==1){
                window.location.reload();
            }else if(d.status==2){
                pauseMatch();
                $('#timerMain').text('结束');
            }else{
                showError('error:'+d.msg);
            }
        },
        error: function(){
            showError('通信失败，请稍后再试');
        }
    });
}

//数据初始化
function matchDataInit (data) {
    //结束
    if (data.timer_status==3) {
        $('#timerMain').text( '结束' );
        return;
    }

    if (_CL != data.current_level_index) {
        window.location.reload();
    }


    $('#t_current_level').text( data.current_level );
    $('#t_current_blinds').text( data.cur_level_blinds );
    $('#t_current_ante').text( data.cur_level_ante );
    $('#t_next_blinds').text( data.next_level_blinds );

    $('#t_total_player').text( data.total_player );
    $('#t_left_player').text( data.left_player );
    $('#t_arg_chips').text( data.arg_chips );
    $('#t_total_chips').text( data.total_chips );
    //$('#t_next_break').text( data.next_break_min+'m' );
    //$('#t_current_level_index').val( data.current_level_index );

    if (data.timer_status==1) {
        //$('#timerMain').text( data.cur_level_time_text );
        console.log('timer show:'+data.cur_level_time_text);
    }

    //状态未变，不进行操作
    if (_TS==data.timer_status && _SP==data.show_photo) {
        //console.log(' status no change...');
        return;
    }

    _TS = data.timer_status, _SP = data.show_photo, _CL = data.current_level_index;

    //显示图片
    mainPhotoStatus(_SP);

    matchTime = data.cur_level_time_left;
    restTime  = data.next_break_min;

    if (_TS==2) {
        pauseMatch ();
    }
    if (_TS==1) {
        startMatch();
    }
    //clearInterval(voiceInterval);
    //clearInterval(matchInterval);
}

function showError(msg) {
    console.log(msg);
}


//倒计时开始
function startMatch () {
    clearInterval(matchInterval);
    matchInterval = setInterval(function(){
        if(matchTime > 0){
            matchTime--;
            showMatchTime(matchTime);
            if (matchTime == 12) {
                startVoice();
            }
        }else{
            clearInterval(matchInterval);
            getNextLevelData();
        }
    }, 1000);
}

//倒计时暂停
function pauseMatch () {
    clearInterval(matchInterval);
    $('#timerMain').text('暂停');
}

//显示图片
function mainPhotoStatus (s) {
    if (s==1) {
        $('.photoBox').slideDown();
    }else{
        $('.photoBox').slideUp();
    }
}

//控制声音--倒计时最后10秒响铃
var voiceInterval, voiceTimes=0;
function startVoice () {
    var voice = $('#timer_voice')[0];
    voiceInterval = setInterval(function(){
        if(voiceTimes > 4){
            voiceTimes = 0;
            voice.pause();
            clearInterval(voiceInterval);
        }else{
            voiceTimes++;
            voice.play();
        }
    }, 2000);
}

//显示倒计时时间
function showMatchTime(t){
    $('#timerMain').text(matchTimeFormat(t));
}
//显示距下次休息时间
function showRestTime(){
    restTime--;
    $('#t_next_break').text(restTime+'m');
}
//比赛时间格式化
function matchTimeFormat(time){
    var minutes = Math.floor(time / 60),
        seconds = time % 60;
    if (seconds==0) {
        showRestTime();//每分钟结束后，距离休息时间－1
    }
    return ( minutes > 9 ? minutes : '0' + minutes ) + ":" + ( seconds > 9 ? seconds : '0' + seconds );
}

    </script>
</body>
</html>