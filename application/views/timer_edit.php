<style type="text/css">
    .dropdown-content{ max-height: 180px;}
    #blinds_list .btn { padding: 0 10px;}
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
        <h4>盲注级别列表</h4>

        <div id="blinds_list">
            <?php
            if (empty( $blindsInfo )) {
                echo '<div class="alert">暂无盲注级别</div>';
            }else{
                foreach( $blindsInfo as $blinds ){
            ?>
            <div class="row blinds-line">
                <div class="col s12 m3 center">
                    <a href="javascript:;" onclick="addBlindsLine(this,'up');" class="btn blue"><i class="mdi-file-file-upload"></i>插入</a>
                    <a href="javascript:;" onclick="delBlindsLine(this);" class="btn red"><i class="mdi-navigation-cancel"></i>删除</a>
                    <a href="javascript:;" onclick="addBlindsLine(this,'down');" class="btn green">插入<i class="mdi-file-file-download"></i></a>
                </div>
                <div class="col s12 m2">
                    <select name="blinds_level[]" onchange="ShowTime(this)">
                        <option value="0" disabled selected>请选择盲注级别</option>
                        <?php
                        echo '<option value="-1" '.($blinds['blinds_level'] == -1 ? 'selected="selected"' : '').'>休息</option>';

                        for ($i=1; $i < 51; $i++) {
                            echo '<option value="'.$i.'" '.($i==$blinds['blinds_level']?'selected="selected"':'').'>Level '.$i.'</option>';
                        }
                        ?>
                    </select>
                </div>

                <div class="col s12 m3">
                    <input name="blinds_num[]" type="text" <?php echo (-1==$blinds['blinds_level']) ? 'disabled="disabled"' : 'value="'.$blinds['blinds_num'].'"';?> placeholder="盲注">
                </div>

                <div class="col s12 m2">
                    <input name="blinds_ante[]" type="text" <?php echo (-1==$blinds['blinds_level']) ? 'disabled="disabled"' : 'value="'.$blinds['blinds_ante'].'"';?> placeholder="前注">
                </div>

                <div class="col s12 m2">
                    <input name="break_time[]" type="text" <?php echo (-1==$blinds['blinds_level']) ? 'value="'.$blinds['break_time'].'"' : 'disabled="disabled"';?> placeholder="休息时间(单位:分钟)" >
                </div>
            </div>
            <?php
                }
            }
            ?>
        </div>


        <div class="row">
            <div class="col l12 s12">
                <p class="left-align">
                    <a href="javascript:;" class="btn green" onclick="addBlindsLine();"><i class="mdi-content-add-circle-outline"></i> 增加盲注级别</a>
                    <a href="javascript:;" class="btn" onclick="submit()">保存</a>
                    <a href="javascript:;" class="btn orange" onclick="window.history.back();" >取消</a>
                </p>
            </div>
        </div>
        <input type="hidden" id="edit_timer_id" value="<?php echo $timerId;?>">
    </div>
</form>
</section>
<!-- /Main Content -->


<script type="text/javascript">
$(document).ready(function(){


});
var BlindsLineStr = '<div class="row blinds-line addLine"><div class="col s12 m3 center"> <a href="javascript:;" onclick="addBlindsLine(this,\'up\');" class="btn blue"><i class="mdi-file-file-upload"></i>添加</a> <a href="javascript:;" onclick="delBlindsLine(this);" class="btn red"><i class="mdi-navigation-cancel"></i>删除</a> <a href="javascript:;" onclick="addBlindsLine(this,\'down\');" class="btn green">添加<i class="mdi-file-file-download"></i></a> </div> <div class="col s12 m2"> <select class="browser-default" name="blinds_level[]" onchange="ShowTime(this)"> <option value="0" disabled selected>请选择盲注级别</option><option value="-1">休息</option><?php for ($i=1; $i < 51; $i++) { echo '<option value="'.$i.'" >Level '.$i.'</option>'; } ?> </select> </div> <div class="col s12 m3"> <input name="blinds_num[]" type="text" placeholder="盲注"> </div> <div class="col s12 m2"> <input name="blinds_ante[]" type="text" placeholder="前注"> </div> <div class="col s12 m2"> <input name="break_time[]" type="text" disabled="disabled" placeholder="休息时间(单位:分钟)" > </div> </div>';
function addBlindsLine(obj, type){
    if (obj && type=='up') {
        $(obj).parents('.blinds-line').before(BlindsLineStr);
    }else if (obj && type=='down') {
        $(obj).parents('.blinds-line').after(BlindsLineStr);
    }else{
        $('#blinds_list').append(BlindsLineStr);
        //$('select:last').material_select();
    }
    
}
function delBlindsLine (obj) {
    $(obj).parents('.blinds-line').remove();
}
function ShowTime (obj) {
    if (obj.value==-1) {
        $(obj).parents('.blinds-line').find('input[name="break_time[]"]').attr('disabled', false);
        $(obj).parents('.blinds-line').find('input[name="blinds_num[]"]').attr('disabled', true).val('');
        $(obj).parents('.blinds-line').find('input[name="blinds_ante[]"]').attr('disabled', true).val('');
    }else{
        $(obj).parents('.blinds-line').find('input[name="break_time[]"]').attr('disabled', true).val('');
        $(obj).parents('.blinds-line').find('input[name="blinds_num[]"]').attr('disabled', false);
        $(obj).parents('.blinds-line').find('input[name="blinds_ante[]"]').attr('disabled', false);
    }
}
function submit(){
    var tid = $('#edit_timer_id').val();
    if(!tid){
        Materialize.toast('参数错误，请刷新后再试', 3000, 'danger'); return;
    }

    if( $('.blinds-line').length == 0 ){
        Materialize.toast('请添加盲注级别', 3000, 'danger'); return;
    }

    var hasErr = false,
        blinds_level=[],
        blinds_num  =[],
        blinds_ante =[],
        break_time  =[];
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
        url: '<?php echo base_url("Timer/editTimerBlinds");?>',
        data:{ tid:tid, blinds_level:blinds_level, blinds_num:blinds_num, blinds_ante:blinds_ante, break_time:break_time, a:Math.random()},
        type: "POST",
        dataType: "json",
        success: function(d){  //console.log(d);return;
            if(d.status==1){
                Materialize.toast(d.msg, 1000, 'success', function(){
                    window.location.href='<?php echo base_url("Timer/control/?id=");?>'+tid;
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

