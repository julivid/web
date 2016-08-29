<style type="text/css">
    .dropdown-content{ max-height: 180px;}
    #blinds_list .btn { padding: 0 10px;}
    .dropdown-content li.disabled>span { color: rgba(0,0,0,.3); }
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
                        <a href='javascript:;'>盲注表信息</a>
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
    <div class="card-panel">
        <h4>盲注表基本信息</h4>

        <div class="row">
            <div class="col s12">
                <div class="input-field">
                    <select id="match_id">
                        <option selected disabled>请选择赛事名称</option>
                    <?php
                    if (!empty( $matchList )) {
                        foreach ($matchList as $match) {
                            if(!in_array($match['mid'], $hasTimerMatch)){
                                echo '<option value="'.$match['mid'].'">[MID:'.$match['mid'].'] '.$match['type_name'].' '.$match['name'].'</option>';
                            }
                        }
                    }
                    ?>
                    </select>
                </div>
            </div>

            <!--<div class="col s12 m6">
                <div class="input-field">
                    <input id="timer_players" type="text">
                    <label for="timer_players">参赛人数</label>
                </div>
            </div>-->

            <!--<div class="col s12 m6">
                <label for="timer_date">比赛日期</label>
                <input id="timer_date" class="pikaday" type="text" value="<?php echo date('Y-m-d');?>">
            </div>-->

            <div class="col s12 m6">
                <div class="input-field">
                    <input id="timer_player_chips" type="text" value="20000">
                    <label for="timer_player_chips">起始记分牌</label>
                </div>
            </div>

            <div class="col s12 m6">
                <div class="input-field">
                    <input id="timer_blinds_raise_time" type="text" value="60">
                    <label for="timer_blinds_raise_time">涨盲时间(m)</label>
                </div>
            </div>
        </div>
    </div>

    <div class="card-panel">
        <h4>盲注级别列表</h4>

        <div id="blinds_list">
            <div class="row blinds-line">
                <div class="col s12 m1 center">
                    <a href="javascript:;" onclick="delBlindsLine(this);" class="btn red"><i class="mdi-navigation-cancel"></i>删除</a>
                </div>
                <div class="col s12 m2">
                    <select name="blinds_level[]" onchange="ShowTime(this)">
                        <option value="0" disabled selected>请选择盲注级别</option>
                        <option value="-1">休息</option>
                        <?php
                        for ($i=1; $i < 51; $i++) { 
                            echo '<option value="'.$i.'">Level '.$i.'</option>';
                        }
                        ?>
                    </select>
                </div>

                <div class="col s12 m3">
                    <input name="blinds_num[]" type="text" placeholder="盲注(示例:100/200)">
                </div>

                <div class="col s12 m3">
                    <input name="blinds_ante[]" type="text" placeholder="前注(示例:50)">
                </div>

                <div class="col s12 m3">
                    <input name="break_time[]" type="text" placeholder="休息时间(单位:分钟)" disabled="disabled">
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col l12 s12">
                <p class="left-align">
                    <a href="javascript:;" class="btn green" onclick="addBlindsLine();"><i class="mdi-content-add-circle-outline"></i> 增加盲注级别</a>
                    <a href="javascript:;" class="btn" onclick="submit()">保存</a>
                    <a href="<?php echo base_url('Timer');?>" class="btn" >取消</a>
                </p>
            </div>
        </div>
    </div>
</form>
</section>
<!-- /Main Content -->


<script type="text/javascript">
$(document).ready(function(){


});
var BlindsLineStr = $('#blinds_list').html();
function addBlindsLine(){
    $('#blinds_list').append(BlindsLineStr);
    $('select:last').material_select();
}
function delBlindsLine (obj) {
    $(obj).parents('.blinds-line').remove();
}
function ShowTime (obj) {
    if (obj.value==-1) {
        $(obj).parents('.blinds-line').find('input[name="break_time[]"]').attr('disabled', false);
        $(obj).parents('.blinds-line').find('input[name="blinds_num[]"]').attr('disabled', true);
        $(obj).parents('.blinds-line').find('input[name="blinds_ante[]"]').attr('disabled', true);
    }else{
        $(obj).parents('.blinds-line').find('input[name="break_time[]"]').attr('disabled', true);
        $(obj).parents('.blinds-line').find('input[name="blinds_num[]"]').attr('disabled', false);
        $(obj).parents('.blinds-line').find('input[name="blinds_ante[]"]').attr('disabled', false);
    }
}
function submit(){
    var hasErr = false,
        blinds_level=[],
        blinds_ante =[],
        blinds_num  =[],
        break_time  = [];
    var mid = $.trim($('#match_id').val()),
        chips = $.trim($('#timer_player_chips').val()),
        blinds_raise_time = $.trim($('#timer_blinds_raise_time').val());
    if (!mid) { Materialize.toast('请选择赛事', 3000, 'danger'); return;};
    if (!chips) { Materialize.toast('请填写初始记分牌', 3000, 'danger'); return;};
    if (!blinds_raise_time) { Materialize.toast('请填写涨盲时间', 3000, 'danger'); return;};
    if( $('.blinds-line').length == 0 ){
        Materialize.toast('请添加盲注级别', 3000, 'danger'); return;
    }

    $('.blinds-line').each(function(i,o){
        blinds_level[i] = Number( $(o).find('select').val() );
        blinds_num[i]   = $(o).find('input[name="blinds_num[]"]').val();
        blinds_ante[i]  = Number( $(o).find('input[name="blinds_ante[]"]').val());
        break_time[i]   = Number( $(o).find('input[name="break_time[]"]').val() );

        if (!blinds_level[i] || blinds_level[i]==0) { 
            hasErr = true; Materialize.toast('请选择第 '+(i+1)+' 条记录的盲注级别', 3000, 'danger'); return false;
        }else if(blinds_level[i] == -1 && break_time[i]==0 ){
            hasErr = true; Materialize.toast('请填写第 '+(i+1)+' 条记录的休息时间', 3000, 'danger'); return false;
        }else if(blinds_level[i] != -1 && !blinds_num[i] ){
            hasErr = true; Materialize.toast('请填写第 '+(i+1)+' 条记录的盲注', 3000, 'danger'); return false;
        }
    });
    if (hasErr==true) { return; };

    $.ajax({
        url: '<?php echo base_url("Timer/addTimer");?>',
        data:{ mid:mid, initial_chips:chips, blinds_raise_time:blinds_raise_time, blinds_level:blinds_level, blinds_num:blinds_num, blinds_ante:blinds_ante, break_time:break_time, a:Math.random()},
        type: "POST",
        dataType: "json",
        success: function(d){  //console.log(d);return;
            if(d.status==1){
                Materialize.toast(d.msg, 1000, 'success', function(){
                    window.location.href='<?php echo base_url("Match");?>';
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
</script>

