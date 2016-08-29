<style type="text/css">
    .table .btn { padding: 0 10px;}
    table tr.match-detele:not(.btn) { color: #999; text-decoration:line-through; }
    .MCFTAG { padding: 15px 0; }
    .MCFTAG span { display: inline-block; padding: 5px 20px; margin-right: 10px;}
    .MCF_main { color: #545454; font-weight: 600; background: rgba(244, 67, 54, 0.15); border: 1px solid rgba(244, 67, 54, 1);}
    .MCF_side1 { color: #545454; font-weight: 600; background: rgba(76, 175, 80, 0.15); border: 1px solid rgba(76, 175, 80, 1);}
    .MCF_side2 { color: #545454; font-weight: 600; background: rgba(177, 220, 251, 0.3); border: 1px solid rgba(177, 220, 251, 1);}
    .MCF_side3 { color: #545454; font-weight: 600; background: rgba(225, 225, 0, 0.25); border: 1px solid rgba(225, 225, 0, 1);}
    .MCF_side4 { color: #545454; font-weight: 600; background: rgba(41, 182, 246, 0.35); border: 1px solid rgba(41, 182, 246, 1);}
    
    .MS_disabled, .MS_default, .MS_info, .MS_warning, .MS_danger { font-weight: 600; padding: 5px 8px; border-radius: 5px;}
    .MS_disabled { color: #fff; background: #ccc; }
    .MS_default { color: #fff; background: #81C784; }
    .MS_info { color: #fff; background: #29b6f6; }
    .MS_warning { color: #fff; background: #E69600; }
    .MS_danger { color: #fff; background: #E60400; }

    .table-bordered, .table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th { border-color: #989898;}
    .tab-res label { margin-right: 5px; background: #29b6f6; color: #fff; display: inline-block; padding: 2px 5px; border-radius: 2px; }
    .table-res { padding: 20px; border: 1px solid #29b6f6;}
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
                        <a href='javascript:;'>赛事列表</a>
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
                    <table class="table table-bordered" id="match_table">
                        <thead>
                            <tr>
                                <th>MID</th>
                                <th>赛事类型</th>
                                <th>赛事名称</th>
                                <th>比赛时间</th>
                                <th>赛事状态</th>
                                <th>参赛用户</th>
                                <th>详细信息</th>
                            </tr>
                        </thead>
                        <tbody>
                    <?php
                    if (empty($matchList)) {
                        echo '<tr><td colspan="7"><h5 class="center red-text">暂无赛事信息</h5></td></tr>';
                    }else{
                        $MSCfg = $this->config->item('match_status_cfg');
                        $MTCfg = $this->config->item('match_ticket_cfg');
                        foreach ($matchList as $k=>$match) {
                            if ($match['is_del']==1) {
                                echo '';
                            }
                            echo '<tr class="'.($match['is_del']==0?'':'match-detele').'">
                                <th>'.$match['mid'].'</th>
                                <td class="MCF_'.$match['group_flag'].'">'.$match['type_name'].'</td>
                                <td>'.$match['name'].'</td>
                                <td>'.$match['date'].'</td>
                                <td><label class="MS_'.$MSCfg[$match['status']]['style'].'">'.$MSCfg[$match['status']]['desc'].'</label></td>
                                <td><a class="btn btn-small" href="javascript:;">下载名单</a></td>
                                <td id="MatchInfo_'.$match['mid'].'" data-gt="'.$match['game_type'].'" data-ec="'.$MTCfg[$match['entry_ticket']]['desc'].'" data-sc="'.$match['start_condition'].'" data-prize="'.$match['prize'].'" data-de="'.$match['delayed_enroll'].'" data-logo="'.$match['logo'].'" data-dt="'.$match['date'].' '.$match['time'].'" data-tabt="'.$match['tab_type'].'" data-tabn="'.$match['tab_num'].'" data-tabr="'.$match['tab_reservation'].'" data-tabms="'.$match['tab_min_seat'].'" data-tabnt="'.$match['tab_new_tabs'].'">
                                    <a class="btn btn-small " href="javascript:;" onclick="showDetail('.$match['mid'].')">配置</a> <a class="btn btn-small green" href="javascript:;">牌桌</a>
                                </td>
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
<div id="matchInfoShow" class="modal">
    <div class="modal-content">
        <h4>赛事详细信息</h4> <hr>
        <div id="matchDetail"></div>
    </div>
    <div class="modal-footer">
        <a href="javascript:;" class="modal-action modal-close waves-effect waves-blue btn-flat ">关闭</a>
    </div>
</div>
<script>
function showDetail(id){
    var obj = $('#MatchInfo_'+id),
        table_type = Number(obj.data('tabt')),
        table_r_str = $.trim(obj.data('tabr')),
        table_r = '';
    if (table_r_str != '') {
        var tmp = table_r_str.split(',');
        for (var i = 0; i < tmp.length; i++) {
            table_r += '<label>'+(Number(tmp[i])+1)+'号</label>';
        }
    }
    $('#matchDetail').html('<div class="row"><!--<div class="col s4">Logo</div><div class="col s8"><img src="'+obj.data('logo')+'"></div>--><div class="col s12 m6"><div class="row"><div class="col s4">赛事类型</div><div class="col s8">'+obj.data('gt')+'</div></div><div class="row"><div class="col s4">参赛条件</div><div class="col s8">'+obj.data('ec')+'</div></div><div class="row"><div class="col s4">开赛条件</div><div class="col s8">'+obj.data('sc')+'</div></div><div class="row"><div class="col s4">比赛时间</div><div class="col s8">'+obj.data('dt')+'</div></div><div class="row"><div class="col s4">奖励设置</div><div class="col s8">'+obj.data('prize')+'</div></div><div class="row"><div class="col s4">延迟报名</div><div class="col s8">'+obj.data('de')+'个级别</div></div></div><div class="col s12 m6"><div class="row"><div class="col s12"><b>分桌配置</b></div></div><div class="row"><div class="col s6">桌型</div><div class="col s6">'+(table_type==0?'无分桌':(table_type+1)+'人桌')+'</div></div><div class="row"><div class="col s6">开桌数量</div><div class="col s6">'+obj.data('tabn')+'</div></div><div class="row"><div class="col s6">预留位</div><div class="col s6 tab-res">'+table_r+'</div></div><div class="row"><div class="col s6">开新桌最少座位</div><div class="col s6">'+Number(obj.data('tabms'))+'</div></div><div class="row"><div class="col s6">开新桌数量</div><div class="col s6">'+Number(obj.data('tabnt'))+'</div></div></div></div>');
    $('#matchInfoShow').openModal();
}


</script>



