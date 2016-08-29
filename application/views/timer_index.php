<style type="text/css">
    .table-hover img {cursor: pointer;}
    .btn-small { padding: 0 1rem; }
    #timer_list img { width: auto; height: 50px;}
    #timer_list label { display: inline-block; padding: 2px 5px; font-size: 12px; color: #fff; border-radius: 3px;}
    #timer_list label.blue { background: #29b6f6}
    #timer_list label.green { background: #4CAF50 }
    #timer_list label.orange { background: #fb8c00 }
    #timer_list label.red { background: #e53935 }
</style>

<section class="content-wrap ecommerce-products">

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
                        <a href='javascript:;'>计时器列表</a>
                    </li>
                </ul>
            </div>
            <div class="col s12 m3 l2 right-align">
                <!--<a href="javascript:;" class="btn grey lighten-3 grey-text z-depth-0 chat-toggle"><i class="fa fa-comments"></i></a>-->
            </div>
        </div>

    </div>

    <div class="card">
        <div class="title">
            <h5>计时器列表</h5>
        </div>
        <div class="content">
            <a class="btn-floating btn-extra waves-effect waves-light red tooltipped" href="<?php echo base_url('Timer/add');?>" data-tooltip="添加新计时器" data-position="left" style="position: fixed; bottom: 25px; right: 25px;">
              <i class="mdi-content-add"></i>
            </a>
            <table class="table table-hover" id="timer_list">
                <thead>
                    <tr>
                        <th>MID</th>
                        <th>赛事名称</th>
                        <th>参赛人员</th>
                        <th>剩余人员</th>
                        <th>初始记分牌</th>
                        <th>涨盲时间</th>
                        <th>计时器状态</th>
                        <th>盲注表</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
        <?php
        if (empty($timerList)) {
            echo '<tr><td colspan="7" style="text-align:center; padding:20px; color:#e53935;">暂无数据</td></tr>';
        }else{
            $TimerStatus = array(
                0=>'<label class="blue">未开始</label>', 
                1=>'<label class="green">进行中</label>', 
                2=>'<label class="orange">暂停中</label>',
                3=>'<label class="red">已结束</label>'
            );
            foreach ($timerList as $k=>$timer) {
                $type_name = '<span class="materialize-red-text">未知大赛</span>';
                if (!empty( $matchType[$timer['match_type']] )) {
                    $type_name = $matchType[$timer['match_type']];
                }
                echo '
                <tr id="timer_'.$timer['tid'].'">
                    <td>'.$timer['mid'].'</td>
                    <td>'.$type_name.' '.$timer['name'].'</td>
                    <td>'.$timer['total_player'].'</td>
                    <td>'.$timer['left_player'].'</td>
                    <td>'.$timer['initial_chips'].'</td>
                    <td>'.$timer['blinds_raise_time'].'</td>
                    <td>'.$TimerStatus[$timer['timer_status']].'</td>
                    <td>
                        <a href="javascript:;" onclick="showTimerBlinds('.$timer['tid'].');" class="btn btn-small z-depth-0"><i class="mdi-social-poll"></i></a>
                    </td>
                    <td>
                        <a href="'.base_url('Timer/control/?id='.$timer['tid']).'" class="btn btn-small green z-depth-0"><i class="mdi-hardware-keyboard"></i> 控制</a> 
                        <a href="'.base_url('Timer/monitor/?id='.$timer['tid']).'" class="btn btn-small z-depth-0" target="_blank"><i class="mdi-hardware-cast-connected"></i> 显示</a> 
                        <!--<a href="javascript:;" onclick="delTimer('.$timer['tid'].');" class="btn btn-small red z-depth-0"><i class="mdi-action-delete"></i> 删除</a>-->
                    </td>
                </tr>';
            }
        }
        ?>
                
                </tbody>
            </table>
        </div>
        <!--<div class="center-align" style="padding-bottom:10px;">
            <a href="javascript:;" class="btn-flat waves-effect waves-light-green grey-text text-darken-1" onclick="loadData();">加载更多</a>
        </div>-->
    </div>
</section>


<div class="modal">
    <div class="modal-content">
        <table class="table table-hover" id="blinds_info">
            <thead>
                <tr>
                    <th>#</th>
                    <th>盲注级别</th>
                    <th>盲注</th>
                    <th>前注</th>
                    <th>休息时间</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
    <div class="modal-footer">
        <a href="javascript:;" class="modal-action modal-close waves-effect btn-flat ">关闭</a>
    </div>
</div>



<script type="text/javascript">
function delTimer (id) {
    if (!id) {
        alert('id参数错误');
        return ;
    }
    $.ajax({
        url: '<?php echo base_url("Timer/getTimerBlinds");?>',
        data:{ tid:tid, a:Math.random()},
        type: "POST",
        dataType: "json",
        success: function(d){  //console.log(d);return;
            if(d.status==1){
                formatBlindsData(d.data);
            }else{
                Materialize.toast(d.msg, 3000, 'danger');
            }
        },
        error: function(){
            Materialize.toast('通信失败，请稍后再试', 3000, 'danger');
        }
    });
    console.log(id);
}
function showTimerBlinds (tid) {
    if (tid) {
        $.ajax({
            url: '<?php echo base_url("Timer/getTimerBlinds");?>',
            data:{ tid:tid, a:Math.random()},
            type: "POST",
            dataType: "json",
            success: function(d){  //console.log(d);return;
                if(d.status==1){
                    formatBlindsData(d.data);
                }else{
                    Materialize.toast(d.msg, 3000, 'danger');
                }
            },
            error: function(){
                Materialize.toast('通信失败，请稍后再试', 3000, 'danger');
            }
        });
    }else{
        Materialize.toast('参数错误，请刷新后再试', 3000, 'danger');
    }
}
function formatBlindsData (data) {
    var dataStr = '';
    $.each(data, function (i, o) {
        if (o.blinds_level==-1) {
            dataStr += '<tr><td>'+(i+1)+'</td><td>休息</td><td>－</td><td>－</td><td>'+o.break_time+'m</td></tr>';
        }else{
            dataStr += '<tr><td>'+(i+1)+'</td><td>Level '+o.blinds_level+'</td><td>'+o.blinds_num+'</td><td>'+o.blinds_ante+'</td><td>-</td></tr>';
        }
    });
    $('#blinds_info tbody').html(dataStr);
    $('.modal').openModal();
}
</script>