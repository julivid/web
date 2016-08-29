<style type="text/css">
    .table .btn { padding: 0 10px; font-weight: 600;}

    .table-bordered, .table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th { border-color: #989898;}
    .tab-res label { margin-right: 5px; background: #29b6f6; color: #fff; display: inline-block; padding: 2px 5px; border-radius: 2px; }
    .table-res { padding: 20px; border: 1px solid #29b6f6;}

    .delete-line { color: #999; text-decoration: line-through; }
    .top-btn { padding-bottom: 20px; }
    .modal { width: 65%; }
    #toast-container { z-index: 1005; }
    #agent_table tr td span { display: inline-block; width: 100%; cursor: pointer; }
    .TStatusUsed, .TStatusUN, .TStatusC { color: #fff; padding: 3px 5px; border-radius: 3px; font-weight: 600;}
    .TStatusC { background: #fb8c00; }
    .TStatusUsed { background: #e53935; }
    .TStatusUN { background: #43a047; }
</style>
<a class="mail-compose-btn btn-floating btn-extra waves-effect waves-light green tooltipped" href="<?php echo base_url('Tickets');?>" data-tooltip="返回列表" data-position="left"><i class="mdi-hardware-keyboard-backspace"></i></a>

<section class="content-wrap">
    <div class="page-title">

        <div class="row">
            <div class="col s12 m9 l10">
                <ul>
                    <li>
                        <a href="<?php echo base_url();?>"><i class="fa fa-home"></i> 首页</a>  <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href='javascript:;'>财务管理</a> <i class='fa fa-angle-right'></i>
                    </li>
                    <li>
                        <a href='javascript:;'>发卡详细</a>
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
            <div class="card-panel">

                <div class="table-responsive">
                    <h3>发卡详细</h3>
                    <table class="table table-bordered" id="match_table">
                        <thead>
                            <tr>
                                <th>类型</th>
                                <th>代理</th>
                                <th>卡号</th>
                                <th>密码</th>
                                <th>发行时间</th>
                                <th>状态</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                    <?php
                    if (empty($ticketsList)) {
                        echo '<tr><td colspan="7"><h5 class="center red-text">无信息，或信息出错</h5></td></tr>';
                    }else{
                        $tStatus = array(
                            '-1'=>'<label class="TStatusC">已锁定</label>', 
                            '0'=>'<label class="TStatusUN">未使用</label>', 
                            '1'=>'<label class="TStatusUsed">已使用</label>');
                        foreach ($ticketsList as $k=>$ticket) {
                            echo '<tr class="" id="ticket_'.$ticket['tid'].'">
                                <td>'.$ticketType[$ticket['type']].'</td>
                                <td>'.$ticket['agent'].'</td>
                                <td>'.$ticket['number'].'</td>
                                <td>'.$this->func->hidePwd($ticket['password']).'</td>
                                <td>'.date('Y-m-d H:i:s', $ticket['pub_time']).'</td>
                                <td>'.$tStatus[$ticket['ticket_status']].'</td>
                                <td>
                                    ';
                            if($ticket['ticket_status']==0){
                                echo '<a class="btn btn-small red" href="javascript:;" onclick="lockTicket('.$ticket['tid'].', -1)">锁定</a>';
                            }else if($ticket['ticket_status']==-1){
                                echo '<a class="btn btn-small green" href="javascript:;" onclick="lockTicket('.$ticket['tid'].', 0)">解锁</a>';
                            }else{
                                echo '-';
                            }
                            echo '</td>
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
<div id="agentList" class="modal">
    <div class="modal-content">
        <h4>代理商列表 </h4> <hr> 
        <a href="javascript:;" class="btn green" onclick="addAgentLine()">添加</a><br><br>
        <div id="agentDetail">
            <table class="table table-bordered" id="agent_table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>备注(点击修改)</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                if (!empty($agentList)) {
                    foreach ($agentList as $agent) {

                        echo '<tr id="Agent_'.$agent['aid'].'" class="agents-line">
                        <td>'.$agent['number'].'</td>
                        <td><span onclick="changeName('.$agent['aid'].')">'.$agent['name'].'</span></td>
                        <td>－</td></tr>';
                    }
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal-footer">
        <a href="javascript:;" class="modal-action modal-close btn waves-effect waves-blue ">关闭</a>  
    </div>
</div>
<script>
function addAgentLine() {
    var str = '<tr class="agents-line"><td><input type="text" name="agentNum" placeholder="代理商编号"></td><td><input type="text" name="agentName" placeholder="代理商姓名"></td><td><a href="javascript:;" class="waves-effect btn btn-small green waves-effect" onclick="addAgent(this)">添加</a> <a href="javascript:;" class="waves-effect btn btn-small red waves-effect" onclick="delAgentLine(this)">取消</a> </td></tr>';
    $('#agent_table tbody').append(str);
    //console.log(str);
}
function delAgentLine(obj) {
    $(obj).parents('.agents-line').remove();
}

function addAgent(obj) {
    var _aNum = $(obj).parents('.agents-line').find('input[name="agentNum"]').val(),
        _aName = $(obj).parents('.agents-line').find('input[name="agentName"]').val();
    $.ajax({
        url:  '<?php echo base_url("Tickets/addAgentAJAX");?>',
        data: { num:_aNum, name:_aName, a:Math.random()},
        type: "POST",
        dataType: "json",
        success: function(d){  //alert(d);return;
            if(d.status==1){
                Materialize.toast(d.msg, 1000, 'success', function(){
                    $(obj).parents('.agents-line').attr('id', 'Agent_'+d.data.aid).html('<td>'+_aNum+'</td><td><span onclick="changeName('+d.data.aid+')">'+_aName+'</span></td><td>-</td>');
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

function changeName(id) {
    var name = $('#Agent_'+id+' td').eq(1).text();
    $('#Agent_'+id+' td').eq(1).html('<input type="text" value="'+name+'">');
    $('#Agent_'+id+' td').eq(2).html('<a href="javascript:;" class="waves-effect btn btn-small red waves-effect" onclick="editAgent('+id+', this)">保存</a> <a href="javascript:;" class="waves-effect btn btn-small waves-effect" onclick="agentDataInit('+id+')">取消</a>');
}

function agentDataInit(id) {
    var name = $('#Agent_'+id+' input').val();
    $('#Agent_'+id+' td').eq(1).html('<span onclick="changeName('+id+')">'+name+'</span>');
    $('#Agent_'+id+' td').eq(2).html('-');
}

function editAgent(id, obj) {
    var name = $.trim( $('#Agent_'+id+' input').val() );
    if (name=='') {
        Materialize.toast('姓名不能为空', 3000, 'danger');
    }
    $.ajax({
        url:  '<?php echo base_url("Tickets/updateAgentAJAX");?>',
        data: { id:id, name:name, a:Math.random()},
        type: "POST",
        dataType: "json",
        success: function(d){  //alert(d);return;
            if(d.status==1){
                Materialize.toast(d.msg, 1000, 'success',function(){
                    agentDataInit(id);
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

function lockTicket(tid, s) {
    if (!tid) { Materialize.toast('卡号错误', 2000, 'danger');return;}
    if (!confirm('确定锁定/解锁该张卡吗？')) { return ;}
    $.ajax({
        url:  '<?php echo base_url("Tickets/updateTicketStatusAJAX");?>',
        data: { id:tid, s:s, a:Math.random()},
        type: "POST",
        dataType: "json",
        success: function(d){  //alert(d);return;
            if(d.status==1){
                Materialize.toast(d.msg, 1000, 'success',function(){
                    if (s==-1) {
                        $('#ticket_'+tid+' td').eq(5).html('<label class="TStatusC">已锁定</label>');
                        $('#ticket_'+tid+' td').eq(6).html('<a class="btn btn-small green" href="javascript:;" onclick="lockTicket('+tid+', 0)">解锁</a>');
                    }else{
                        $('#ticket_'+tid+' td').eq(5).html('<label class="TStatusUN">未使用</label>');
                        $('#ticket_'+tid+' td').eq(6).html('<a class="btn btn-small red" href="javascript:;" onclick="lockTicket('+tid+', -1)">锁定</a>');
                    }
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



