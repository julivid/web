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
<!--<a class="mail-compose-btn btn-floating btn-extra waves-effect waves-light red tooltipped" href="<?php echo base_url('Match/add');?>" data-tooltip="添加赛事" data-position="left"><i class="mdi-content-add"></i></a>-->

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
                <h3>财务统计</h3>
                <div class="row">
                    <div class="col s12">
                        <ul class="tabs">
                            <li class="tab col s3"><a href="#agentStats">会员卡统计</a></li>
                            <li class="tab col s3"><a href="#ticketStats">资格卡统计</a></li>
                        </ul>
                    </div>
                    <div id="agentStats" class="col s12">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="match_table">
                                <thead>
                                    <tr>
                                        <th>代理</th>
                                        <th>发行量</th>
                                        <th>已锁定</th>
                                        <th>未使用</th>
                                        <th>已使用</th>
                                        <th>绑定微信</th>
                                        <th>绑定支付宝</th>
                                        <th>完成首冲</th>
                                        <th>操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                if (empty($stats)) {
                                    echo '<tr><td colspan="9"><h5 class="center red-text">暂无代理统计信息</h5></td></tr>';
                                }else{
                                    foreach ($stats as $agent=>$s) {
                                        echo '<tr class="">
                                            <td>'.$agentList[$agent].'</td>
                                            <td>'.$s['all'].'</td>
                                            <td>'.(empty($s['ticketStatus'][-1])? 0 : $s['ticketStatus'][-1]).'</td>
                                            <td>'.(empty($s['ticketStatus'][0]) ? 0 : $s['ticketStatus'][0]).'</td>
                                            <td>'.(empty($s['ticketStatus'][1]) ? 0 : $s['ticketStatus'][1]).'</td>
                                            <td>'.$s['wx_num'].'</td>
                                            <td>'.$s['zfb_num'].'</td>
                                            <td>'.$s['first_num'].'</td>
                                            <td><a class="btn btn-small " target="_blank" href="'.base_url('Account/detail?a=').$agent.'">详细</a></td>
                                        </tr>';
                                    }
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div id="ticketStats" class="col s12">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="match_table">
                                <thead>
                                    <tr>
                                        <th>类型</th>
                                        <th>发行量</th>
                                        <th>已锁定</th>
                                        <th>未使用</th>
                                        <th>已使用</th>
                                        <th>操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                if (empty($ticketStats)) {
                                    echo '<tr><td colspan="6"><h5 class="center red-text">暂无统计信息</h5></td></tr>';
                                }else{
                                    foreach ($ticketStats as $type=>$s) {
                                        echo '<tr class="">
                                            <td>'.$ticketType[$type].'['.$type.']</td>
                                            <td>'.$s['all'].'</td>
                                            <td>'.(empty($s['stats'][-1])? 0 : $s['stats'][-1]).'</td>
                                            <td>'.(empty($s['stats'][0]) ? 0 : $s['stats'][0]).'</td>
                                            <td>'.(empty($s['stats'][1]) ? 0 : $s['stats'][1]).'</td>';
                                        echo '<td><a class="btn btn-small " target="_blank" href="'.base_url('Account/detail?t=').$type.'">详细</a></td>
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

</script>



