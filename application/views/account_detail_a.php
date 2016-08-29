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
                        <a href='javascript:;'>统计</a>
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
                <h3>会员卡统计信息</h3>
                <div class="row">
                    <div class="col s12">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="match_table">
                                <thead>
                                    <tr>
                                        <th>类型</th>
                                        <th>代理</th>
                                        <th>卡号</th>
                                        <th>状态</th>
                                        <th>发行时间</th>
                                        <th>操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                if (empty($ticketList)) {
                                    echo '<tr><td colspan="6"><h5 class="center red-text">暂无详细信息</h5></td></tr>';
                                }else{
                                    $tStatus = array(
                                        -1=> '<label class="cardError">已锁定</label>', 
                                        0 => '<label class="cardDefault">未使用</label>', 
                                        1 => '<label class="cardSuccess">已使用</label>');
                                    foreach ($ticketList as $ticket) {
                                        echo '<tr class="">
                                            <td>'.$ticketType[$ticket['type']].'['.$ticket['type'].']</td>
                                            <td>'.$agentList[$ticket['agent']].'</td>
                                            <td>'.$ticket['number'].'</td>
                                            <td>'.$tStatus[$ticket['ticket_status']].'</td>
                                            <td>'.date('Y-m-d H:i', $ticket['pub_time']).'</td>
                                            <td>'.($ticket['ticket_status']==1?'<a href="javascript:;" onclick="getDetailInfo('.$ticket['tid'].')" class="btn btn-small">详细</a>':'-').'</td>
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

<!-- /Main Content -->
<div id="detailInfo" class="modal">
    <div class="modal-content">
        <h4>详细信息 </h4> <hr>
        <div class="row">
            <div class="col s4 m2">用户名</div>
            <div class="col s8 m4" id="detailUsername"></div>
            <div class="col s4 m2">姓名</div>
            <div class="col s8 m4" id="detailName"></div>
        </div>
        <div class="row">
            <div class="col s4 m2">电子邮箱</div>
            <div class="col s8 m4" id="detailEmail"></div>
            <div class="col s4 m2">手机</div>
            <div class="col s8 m4" id="detailMobile"></div>
        </div>
        <div class="row">
            <div class="col s4 m2">地址</div>
            <div class="col s8 m10" id="detailAddr"></div>
        </div>
        <div class="row">
            <div class="col s4 m2">绑定微信</div>
            <div class="col s8 m4" id="bindWX">否</div>
            <div class="col s4 m2">绑定支付宝</div>
            <div class="col s8 m4" id="bindZFB">否</div>
        </div>
    </div>
    <div class="modal-footer">
        <a href="javascript:;" class="modal-action modal-close btn waves-effect waves-blue ">关闭</a>  
    </div>
</div>

<script>
function getDetailInfo(tid) {
    if (!tid) {
        Materialize.toast('发行卡ID错误', 2000, 'danger');
        return;
    }
    infoClear();
    $.ajax({
        url: '<?php echo base_url("Account/getRegDetailInfoAJAX");?>',
        data:{ id:tid, a:Math.random()},
        type: "POST",
        dataType: "json",
        success: function(d){ //console.log(d);return;
            if(d.status==1){
                _formatDetailInfo(d.data);
            }else{
                Materialize.toast('获取失败', 2000, 'danger');
            }
        },
        error: function(){
            Materialize.toast('通信失败，请稍后再试', 2000, 'danger');
        }
    });
}

function infoClear() {
    $('#detailUsername').text('');
    $('#detailName').text('');
    $('#detailEmail').text('');
    $('#detailMobile').text('');
    $('#detailAddr').text('');
    $('#bindWX').text('');
    $('#bindZFB').text('');
}

function _formatDetailInfo(data) {
    if ($.isEmptyObject(data)) {Materialize.toast('数据为空', 2000, 'danger'); return;}
    $('#detailUsername').text(data.username);
    $('#detailName').text(data.family_name+' '+data.given_name);
    $('#detailEmail').text(data.email);
    $('#detailMobile').text(data.mobile);
    $('#detailAddr').text(data.addr);
    $('#bindWX').text( data.wx_id?'是':'否' );
    $('#bindZFB').text( data.zfb_id?'是':'否' );
    $('#detailInfo').openModal();
}
</script>



