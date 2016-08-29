<style type="text/css">
    .table .btn { padding: 0 10px;}
    table tr.match-detele:not(.btn) { color: #999; text-decoration:line-through; }
    
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
                        <a href='javascript:;'>晋级赛列表</a>
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
                                <th>赛事系列</th>
                                <th>赛事名称</th>
                                <th>比赛时间</th>
                                <th>赛事状态</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                    <?php
                    if (empty($matchList)) {
                        echo '<tr><td colspan="6"><h5 class="center red-text">暂无赛事信息</h5></td></tr>';
                    }else{
                        $MSCfg = $this->config->item('match_status_cfg');
                        $MTCfg = $this->config->item('match_ticket_cfg');
                        foreach ($matchList as $k=>$match) {
                            echo '<tr class="'.($match['is_del']==0?'':'match-detele').'">
                                <th>'.$match['mid'].'</th>
                                <td>'.$match['type_name'].'</td>
                                <td>'.$match['name'].'</td>
                                <td>'.$match['date'].'</td>
                                <td><label class="MS_'.$MSCfg[$match['status']]['style'].'">'.$MSCfg[$match['status']]['desc'].'</label></td>
                                <td><a class="btn btn-small" href="'.base_url('Promotion/add_player?id='.$match['mid']).'">参赛选手列表</a> </td>
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


