<style type="text/css">
    .collapsible-header { font-weight: 600; font-size: 15px; }
    .table .btn { padding: 0 10px; font-weight: 600;}

    .table-bordered, .table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th { border-color: #989898;}
    .tab-res label { margin-right: 5px; background: #29b6f6; color: #fff; display: inline-block; padding: 2px 5px; border-radius: 2px; }
    .table-res { padding: 20px; border: 1px solid #29b6f6;}

    .delete-line { color: #999; text-decoration: line-through; }
    .top-btn { padding-bottom: 20px; }
    .modal { width: 65%; }
    #toast-container { z-index: 1005; }
    #agent_table tr td span { display: inline-block; width: 100%; cursor: pointer; }
    .cardError, .cardSuccess, .cardDefault { color: #fff; padding: 3px 5px; border-radius: 3px; font-weight: 600;}
    .cardError { background: #e53935; }
    .cardSuccess { background: #43a047; }
    .cardDefault { background: #1e88e5; }
    textarea.materialize-textarea { padding: 0; }
</style>
<!--<a class="mail-compose-btn btn-floating btn-extra waves-effect waves-light green tooltipped" href="javascript:;" onclick="window.history.back();" data-tooltip="返回" data-position="left"><i class="mdi-hardware-keyboard-backspace"></i></a>-->

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
                        <a href='javascript:;'>赛果统计</a>
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
                <h3>线上游戏赛果详细</h3>
                <div class="row">
                    <div class="col s12">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="match_table">
                                <thead>
                                    <tr>
                                        <th>游戏名称</th>
                                        <th>比赛时间</th>
                                        <th>排名</th>
                                        <th>奖励内容</th>
                                        <th>玩家信息</th>
                                        <th>获奖时间</th>
                                        <th>备注</th>
                                        <!--<th>操作</th>-->
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                if (empty($prizeList)) {
                                    echo '<tr><td colspan="6"><h5 class="center red-text">暂无赛果信息</h5></td></tr>';
                                }else{
                                    //u.uid,u.,u.,u.,u.email,u.,u.id_card,u.addr,u.country,u.province,u.city,p.,p.,p.,p.memo,p.time
                                    foreach ($prizeList as $prize) {
                                        echo '<tr class="">
                                            <td>'.$prize['table_name'].'</td>
                                            <td>'.date('Y-m-d H:i', $prize['game_time']).'</td>
                                            <td>'.$prize['rank'].'</td>
                                            <td>'.$prize['prize'].'</td>
                                            <td>'.$prize['username'].'<br>'.$prize['family_name'].$prize['given_name'].' '.$prize['mobile'].'<br>'.$prize['id_card'].'<br>'.$prize['country'].' '.$prize['province'].','.$prize['city'].','.$prize['addr'].'</td>
                                            <td>'.date('Y-m-d H:i', $prize['time']).'</td>
                                            <td><textarea id="prize_memo_'.$prize['pid'].'" class="materialize-textarea" placeholder="请输入备注信息">'.$prize['memo'].'</textarea><br><a href="javascript:;" class="btn btn-small" onclick="addPrizeMemo('.$prize['pid'].')">提交</a></td>
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
        </div>
    </div>

</section>

<script>
function addPrizeMemo(pid) {
    if (!pid) {
        Materialize.toast('奖励ID错误，请联系管理员', 2000, 'danger');
        return;
    }
    var memo = $.trim($('#prize_memo_'+pid).val());
    if (!memo) {
        Materialize.toast('请填写备注', 2000, 'danger');
        return;
    }
    if (!confirm('确定操作？')) { return ;}
    //alert(memo);return;
    $.ajax({
        url: '<?php echo base_url("Account/addPrizeMemoAJAX");?>',
        data:{ id:pid, memo:memo, a:Math.random()},
        type: "POST",
        dataType: "json",
        success: function(d){ //console.log(d);return;
            if(d.status==1){
                //$('#prize_memo_'+pid).parent('td').html(memo);
                Materialize.toast(d.msg, 2000, 'success');
            }else{
                Materialize.toast(d.msg, 2000, 'danger');
            }
        },
        error: function(){
            Materialize.toast('通信失败，请稍后再试', 2000, 'danger');
        }
    });
}

</script>



