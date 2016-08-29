<style type="text/css">
    .table-reservation .btn { padding: 0 10px;}
    .table-type .btn, .table-reservation .btn { background: #d9edf7; color: #039be5; margin-right: 5px; margin-bottom: 10px;}
    .table-type .btn.active, .table-reservation .btn.active { background: #29b6f6; color: #fff;}
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
                        <a href='javascript:;'>修改赛事信息</a>
                    </li>
                </ul>
            </div>
            <div class="col s12 m3 l2 right-align">
                <!--<a href="javascript:;" class="btn grey lighten-3 grey-text z-depth-0 chat-toggle"><i class="fa fa-comments"></i></a>-->
            </div>
        </div>

    </div>
    <?php
    if (empty( $matchInfo )) {
        echo '<div class="alert red lighten-2 white-text ">暂无赛事信息</div>';
    }else{
    ?>
    <div class="card-panel">
        <h4>赛事信息</h4>

        <div class="row">
            <div class="col s12 m4">
                <select id="match_type">
                    <option selected disabled>请选择赛事类型</option>
                <?php
                if (!empty( $matchType )) {
                    foreach ($matchType as $type) {
                        echo '<option '.($matchInfo['tid']==$type['tid']?'selected="selected"':'').' value="'.$type['tid'].'">'.$type['name'].'</option>';
                    }
                }
                ?>
                </select>
            </div>
            <div class="col s12 m4">
                <select id="match_mapid">
                    <option selected disabled>请选择比赛场地/地图</option>
                 <?php
                if (!empty( $matchMaps )) {
                    foreach ($matchMaps as $map) {
                        echo '<option '.($matchInfo['mapid']==$map['mapid']?'selected="selected"':'').' value="'.$map['mapid'].'">'.$map['name'].'</option>';
                    }
                }
                ?>
                </select>
            </div>
            <div class="col s12 m4">
                <select id="match_area">
                    <option selected disabled>选择所在区域</option>
                    <option <?php echo $matchInfo['area']=='A区' ? 'selected="selected"' : '';?> value="A区">A区</option>
                    <option <?php echo $matchInfo['area']=='B区' ? 'selected="selected"' : '';?> value="B区">B区</option>
                    <option <?php echo $matchInfo['area']=='C区' ? 'selected="selected"' : '';?> value="C区">C区</option>
                    <option <?php echo $matchInfo['area']=='D区' ? 'selected="selected"' : '';?> value="D区">D区</option>
                    <option <?php echo $matchInfo['area']=='E区' ? 'selected="selected"' : '';?> value="E区">E区</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col s12">
                <div class="input-field">
                    <input id="match_name" type="text" value="<?php echo $matchInfo['name'];?>">
                    <label for="match_name">赛事名称</label>
                    <input id="match_id" type="hidden" value="<?php echo $matchInfo['mid'];?>">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col s12 m6">
                <div class="input-field">
                    <input id="match_date" class="pikaday" type="text" value="<?php echo $matchInfo['date'];?>">
                    <label for="match_date">比赛日期</label>
                </div>
            </div>
            <div class="col s12 m6">
                <div class="input-field">
                    <input id="match_time" type="text" value="<?php echo $matchInfo['time'];?>">
                    <label for="match_time">比赛时间(格式: 08:30)</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col s12 m4">
                <select id="match_ec">
                    <option selected disabled>参赛条件</option>
                <?php
                $MTCfg = $this->config->item('match_ticket_cfg');
                foreach ($MTCfg as $k => $v) {
                    echo '<option '.($matchInfo['entry_ticket']==$k?'selected="selected"':'').' value="'.$k.'">'.$v['desc'].'</option>';
                }
                ?>
                </select>
            </div>
            <div class="col s12 m4">
                <select id="match_sc">
                    <option selected disabled>开赛条件</option>
                    <option <?php echo $matchInfo['start_condition']=='到时即开' ? 'selected="selected"' : '';?> value="到时即开">到时即开</option>
                    <option <?php echo $matchInfo['start_condition']=='坐满即开' ? 'selected="selected"' : '';?> value="坐满即开">坐满即开</option>
                </select>
            </div>
            <div class="col s12 m4">
                <select id="match_de">
                    <option selected disabled>延迟报名级别数</option>
                    <option <?php echo $matchInfo['delayed_enroll']=='0' ? 'selected="selected"' : '';?> value="0">0个级别</option>
                    <option <?php echo $matchInfo['delayed_enroll']=='1' ? 'selected="selected"' : '';?> value="1">1个级别</option>
                    <option <?php echo $matchInfo['delayed_enroll']=='2' ? 'selected="selected"' : '';?> value="2">2个级别</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col s12 m4">
                <select id="match_gt">
                    <option selected disabled>游戏类型</option>
                    <option <?php echo $matchInfo['game_type']=='无限注-德州扑克' ? 'selected="selected"' : '';?> value="无限注-德州扑克">无限注-德州扑克</option>
                    <option <?php echo $matchInfo['game_type']=='底池限注-奥马哈扑克' ? 'selected="selected"' : '';?> value="底池限注-奥马哈扑克">底池限注-奥马哈扑克</option>
                    <option <?php echo $matchInfo['game_type']=='大菠萝扑克' ? 'selected="selected"' : '';?> value="大菠萝扑克">大菠萝扑克</option>
                    <option <?php echo $matchInfo['game_type']=='德州奥马哈混合' ? 'selected="selected"' : '';?> value="德州奥马哈混合">德州奥马哈混合</option>
                </select>
            </div>
            <div class="col s12 m4">
                <select id="match_prize">
                    <option selected disabled>奖励设置</option>
                    <option <?php echo $matchInfo['prize']=='奖金' ? 'selected="selected"' : '';?> value="奖金">奖金</option>
                    <option <?php echo $matchInfo['prize']=='资格' ? 'selected="selected"' : '';?> value="资格">资格</option>
                    <option <?php echo $matchInfo['prize']=='资格，奖金' ? 'selected="selected"' : '';?> value="资格，奖金">资格，奖金</option>
                </select>
            </div>
            <div class="col s12 m4">
                <select id="group_flag" onchange="tableRule()">
                    <option <?php echo $matchInfo['group_flag']=='0' ? 'selected="selected"' : '';?> value="0">不分组－单场赛事</option>
                    <option <?php echo $matchInfo['group_flag']=='main' ? 'selected="selected"' : '';?> value="main">分组－主赛标记</option>
                    <option <?php echo $matchInfo['group_flag']=='side1' ? 'selected="selected"' : '';?> value="side1">分组－边赛标记1</option>
                    <option <?php echo $matchInfo['group_flag']=='side2' ? 'selected="selected"' : '';?> value="side2">分组－边赛标记2</option>
                    <option <?php echo $matchInfo['group_flag']=='side3' ? 'selected="selected"' : '';?> value="side3">分组－边赛标记3</option>
                    <option <?php echo $matchInfo['group_flag']=='side4' ? 'selected="selected"' : '';?> value="side4">分组－边赛标记4</option>
                </select>
                <!--<p class="switch">
                    <label>
                        <input id="is_main_match" type="checkbox" onchange="tableRule()" checked="" />
                        <span class="lever"></span>
                        是否分桌
                    </label>
                </p>-->
            </div>
        </div>
    </div>

    <div class="card-panel" id="table_rule_box">
        <h4>分桌规则</h4>
        <div class="row">
            <div class="col s12 m4">
                <div class="input-field">
                    <input id="table_num" type="text" value="<?php echo $matchInfo['tab_num'];?>">
                    <label for="table_num">初始开桌数</label>
                </div>
            </div>
            <div class="col s12 m4">
                <div class="input-field">
                    <input id="min_seats" type="text" value="<?php echo $matchInfo['tab_min_seat'];?>">
                    <label for="min_seats">新开桌时剩余最少座位数</label>
                </div>
            </div>
            <div class="col s12 m4">
                <div class="input-field">
                    <input id="new_table_num" type="text" value="<?php echo $matchInfo['tab_new_tabs'];?>">
                    <label for="new_table_num">新开桌的数量</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col s12 m3 table-type">
                <p>开桌类型</p>
                <a class="btn tabType9 <?php echo $matchInfo['tab_type']=='8' ? 'active' : '';?>" data-tabtype="8" href="javascript:;" >9人桌</a>
                <a class="btn tabType10 <?php echo $matchInfo['tab_type']=='9' ? 'active' : '';?>" data-tabtype="9" href="javascript:;" >10人桌</a>
            </div>
            <div class="col s12 m9 table-reservation">
                <p>预留座位</p>
            <?php
            
            if (empty( $matchInfo['tab_reservation'] )) {
                for ($i=0; $i < 10; $i++) { 
                    echo '<a class="btn res'.$i.'" data-tabreservation="'.$i.'" href="javascript:;" >'.($i+1).'号</a>';
                }
            }else{
                $tabReservation = explode(',', $matchInfo['tab_reservation']);
                for ($i=0; $i < 10; $i++) { 
                    echo '<a class="btn res'.$i.' '.(in_array($i, $tabReservation)?'active':'').'" data-tabreservation="'.$i.'" href="javascript:;" >'.($i+1).'号</a>';
                }
            }
            
            ?>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col s12">
            <button class="btn" type="button" onclick="editMatch()">确认更新</button>
            <a class="btn" href="<?php echo base_url('Match');?>">返回</a>
        </div>
    </div>
    <?php } ?>
</section>
<!-- /Main Content -->

<div id="matchResultModal" class="modal">
    <div class="modal-content">
        <div class="row">
            <div class="col s12">
                <h1 class="center materialize-red-text">修改赛事信息成功</h1>
                <br>
            </div>
        </div>
        <div class="row">
            <div class="col s6" style="text-align: right;">
                <a href="javascript:window.location.reload();" class="btn btn-large waves-effect waves-green green">继续添加</a>
            </div>
            <div class="col s6">
                <a href="<?php echo base_url('Match');?>" class="btn btn-large waves-effect waves-green blue">返回列表</a>
            </div>
        </div>
    </div>
</div>


<!-- Tags Input -->
<script type="text/javascript" src="<?php echo STATIC_FILE_DIR.'js/jquery.tagsinput.js';?>"></script>

<!-- Pikaday -->
<script type="text/javascript" src="<?php echo STATIC_FILE_DIR.'js/moment.min.js';?>"></script>
<script type="text/javascript" src="<?php echo STATIC_FILE_DIR.'js/pikaday.js';?>"></script>
<script type="text/javascript" src="<?php echo STATIC_FILE_DIR.'js/pikaday.jquery.js';?>"></script>

<script type="text/javascript">
$(document).ready(function(){
    var picker = new Pikaday(
    {
        field: $('.pikaday'),
        firstDay: 1,
        minDate: new Date('2000-01-01'),
        maxDate: new Date('2020-12-31'),
        yearRange: [2000,2020],
        format: 'yyyy-mm-dd'
    });

    $('.tabType9').click(function(){
        $('.tabType10').removeClass('active');
        $(this).addClass('active');
        $('.res9').fadeOut();
        $('.table-reservation .btn').removeClass('active');
    });
    $('.tabType10').click(function(){
        $('.tabType9').removeClass('active');
        $(this).addClass('active');
        $('.table-reservation .btn').removeClass('active');
        $('.res9').show();
    });
    $('.table-reservation .btn').click(function(){
        $(this).toggleClass('active');
        ( $('.tabType9').hasClass('active') && $('.table-reservation .active').length==9 ) || $('.table-reservation .active').length==10 ? $(this).toggleClass('active') : ''; 
    });

    //禁止点击modal外部关闭
    
});


function tableRule () {
    if ( $('#group_flag').val()==0 ) {
        $('#table_rule_box').slideUp();
    }else{
        $('#table_rule_box').slideDown();
    }
    console.log($('#group_flag').val());
}

function editMatch () {
    var mid  = $.trim( $('#match_id').val() ),
        name = $.trim( $('#match_name').val() ),
        date = $.trim( $('#match_date').val() ),
        time = $.trim( $('#match_time').val() ),
        mt   = $.trim( $('#match_type').val() ),
        mec  = $.trim( $('#match_ec').val() ),
        msc  = $.trim( $('#match_sc').val() ),
        mde  = $.trim( $('#match_de').val() ),
        mgt  = $.trim( $('#match_gt').val() ),
        map  = $.trim( $('#match_mapid').val() ),
        marea   = $.trim( $('#match_area').val() ),
        mprize  = $.trim( $('#match_prize').val() ),
        tab_num = min_seat = new_tab = tab_type = '', tab_res = [];
    //console.log(tab_res);return;
    if (!mid)   { Materialize.toast('赛事ID错误', 3000, 'danger');return; };
    if (!mt)    { Materialize.toast('请选择赛事类型', 3000, 'danger');return; };
    if (!map)   { Materialize.toast('请选择比赛地点', 3000, 'danger');return; };
    if (!marea) { Materialize.toast('请选择赛场区域', 3000, 'danger');return; };
    if (!name)  { Materialize.toast('请填写赛事名称', 3000, 'danger');return; };
    if (!date)  { Materialize.toast('请填写比赛开始日期', 3000, 'danger');return; };
    if (!time)  { Materialize.toast('请填写比赛开始时间', 3000, 'danger');return; };
    if (!mec)   { Materialize.toast('请选择参赛条件', 3000, 'danger');return; };
    if (!msc)   { Materialize.toast('请选择开赛条件', 3000, 'danger');return; };
    if (mde==''){ Materialize.toast('请选择延迟报名级别', 3000, 'danger');return; };
    if (!mgt)   { Materialize.toast('请选择游戏类型', 3000, 'danger');return; };
    if (!mprize){ Materialize.toast('请选择奖励设置', 3000, 'danger');return; };

    //分桌配置
    var group_flag = $('#group_flag').val();
    if ( group_flag == 'main' ) {
        tab_num  = $('#table_num').val(),
        min_seat = $('#min_seats').val(),
        new_tab  = $('#new_table_num').val(),
        tab_type = $('.table-type .active').data('tabtype');
        $('.table-reservation .active').each(function(i,o){
            tab_res[i] = $(o).data('tabreservation');
        });

        if (!tab_num)  { Materialize.toast('请填写初始开桌数量', 3000, 'danger');return; };
        if (!min_seat) { Materialize.toast('请填写最少座位限制', 3000, 'danger');return; };
        if (!new_tab)  { Materialize.toast('请填写新开桌数量', 3000, 'danger');return; };
        if (tab_type!=8 && tab_type!=9) { Materialize.toast('开桌类型错误', 3000, 'danger');return; };
        if (tab_res.length > 8 ) { Materialize.toast('预留座位错误', 3000, 'danger');return; };
    }

    $.ajax({
        url: '<?php echo base_url("Match/editMatchAJAX");?>',
        data:{ mid:mid, name:name, date:date, time:time, map:map, mt:mt, mec:mec, msc:msc, mde:mde, mgt:mgt, marea:marea, mprize:mprize, group_flag:group_flag, tab_num:tab_num, tab_type:tab_type, tab_reservation:tab_res, tab_min_seat:min_seat, tab_new_tabs:new_tab, a:Math.random()},
        type: "POST",
        dataType: "json",
        success: function(d){  //alert(d);return;
            if(d.status==1){
                Materialize.toast(d.msg, 3000, 'success');
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

