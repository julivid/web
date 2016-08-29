<!-- PhotoSwipe -->
<link rel="stylesheet" type="text/css" href="<?php echo STATIC_FILE_DIR;?>assets/PhotoSwipe/photoswipe.css" />
<link rel="stylesheet" type="text/css" href="<?php echo STATIC_FILE_DIR;?>assets/PhotoSwipe/default-skin.css" />
<style type="text/css">
.table-hover img {cursor: pointer;}
.btn-small { padding: 0 1rem; }
#news_list img { width: auto; height: 50px;}
.index-show { color: #00ccff; border: 1px dashed #00ccff;}
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
                        <a href='javascript:;'>系统管理</a> <i class='fa fa-angle-right'></i>
                    </li>
                    <li>
                        <a href='javascript:;'>信息列表</a>
                    </li>
                </ul>
            </div>
            <div class="col s12 m3 l2 right-align">
                <!-- <a href="javascript:;" class="btn grey lighten-3 grey-text z-depth-0 chat-toggle"><i class="fa fa-comments"></i></a> -->
            </div>
        </div>

    </div>

    <div class="card">
        <div class="title">
            <h5>信息列表</h5>
        </div>
        <div class="content">
            <a class="btn-floating btn-extra waves-effect waves-light red tooltipped" href="<?php echo base_url('Sys/add');?>" data-tooltip="添加信息" data-position="left" style="position: fixed; bottom: 25px; right: 25px;">
                <i class="mdi-content-add"></i>
            </a>
            <table class="table table-hover" id="news_list">
                <thead>
                    <tr>
                        <th>类型</th>
                        <th>名称</th>
                        <th>图片</th>
                        <th>链接</th>
                        <th>状态</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
<?php
if (empty($confData)) { 
    echo '<tr><td colspan="7" style="text-align:center; padding:20px; color:#e53935;">暂无数据</td></tr>';
}else{
    foreach ($confData as $data) 
    {
        
        echo '<tr id="AD_'.$data['sid'].'">
                <td>
                    <strong class="red-text text-darken-2">'.$data['type'].'</strong>
                </td>
                <td>
                    <strong class="grey-text text-darken-2">'.$this->auth->getContentBrief($data['name'], 12).'</strong>
                </td>
                <td>
                    <div class="photoswipe-gallery isotope mt-0">
                        <a href="'.UPLOAD_IMG_URL.date('Ym', $data['add_time']).'/'.$data['gallery'].'" data-size="2880x1800" data-med="'.UPLOAD_IMG_URL.date('Ym', $data['add_time']).'/'.$data['gallery'].'" data-med-size="1440x900">
                            <img src="'.UPLOAD_IMG_URL.date('Ym', $data['add_time']).'/thumb/'.$data['gallery'].'" alt="'.$data['name'].'">
                            <figure>'.$data['name'].'</figure>
                        </a>
                    </div>
                </td>
                <td>'.(empty($data['link'])? '<i>空</i>' : '<a href="'.$data['link'].'" target="_blank">'.$data['link'].'</a>').'</td>';
        if($data['status']==0){
            echo '<td class="gray-text">'.$dataStatus[$data['status']].'</td>
                <td>
                    <a href="javascript:;" onclick="confStatus('.$data['sid'].', 1);" class="btn btn-small green z-depth-0"><i class="fa fa-arrow-circle-up"></i> 发布</a>
                    <a href="javascript:;" onclick="confStatus('.$data['sid'].', -1);" class="btn btn-small red z-depth-0"><i class="mdi mdi-action-delete"></i> 删除</a>
                </td>';
        }elseif ($data['status']==1) {
            echo '<td class="green-text">'.$dataStatus[$data['status']].'</td>
                <td>
                    <a href="javascript:;" onclick="confStatus('.$data['sid'].', 0);" class="btn btn-small orange z-depth-0"><i class="fa fa-arrow-circle-down"></i> 撤销</a>
                </td>';
        }else{
          echo '<td class="red-text">'.$dataStatus[$data['status']].'</td>
                <td>
                    <a href="javascript:;" onclick="confStatus('.$data['sid'].', 0);" class="btn btn-small blue z-depth-0"><i class="fa fa-refresh"></i> 还原</a>
                </td>';
        }
                
        echo '</tr>';
    }
}
?>
            
                </tbody>
            </table>
        </div>
    </div>
</section>

<script type="text/javascript">
function confStatus(sid, s){
    if (!sid) { Materialize.toast('信息出错，请刷新后重试', 3000, 'danger');return; }
    if( $('#AD_'+sid).hasClass('index-show') ) { Materialize.toast('请先更换其它内容到［首页］再进行操作', 3000, 'danger'); return; }
    $.ajax({
        url: '<?php echo base_url("Sys/confStatus");?>',
        data:{ sid:sid, status: s, a:Math.random()},
        type: "POST",
        dataType: "json",
        success: function(d){  //alert(d);return;
            if(d.status==1){
                Materialize.toast(d.msg, 1000, 'success', function(){
                    _changeconfStatus(sid, s);
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
function _changeconfStatus(sid, s){
    switch(s){
    case 0: 
        $('#AD_'+sid+' td').eq(4).html('已录入').removeClass('gray-text green-text red-text').addClass('gray-text');
        $('#AD_'+sid+' td').eq(5).html('<a href="javascript:;" onclick="confStatus('+sid+', 1);" class="btn btn-small green z-depth-0"><i class="fa fa-arrow-circle-up"></i> 发布</a> <a href="javascript:;" onclick="confStatus('+sid+', -1);" class="btn btn-small red z-depth-0"><i class="mdi mdi-action-delete"></i> 删除</a>');
        break;
    case 1:
        $('#AD_'+sid+' td').eq(4).html('已发布').removeClass('gray-text green-text red-text').addClass('green-text');
        $('#AD_'+sid+' td').eq(5).html('<a href="javascript:;" onclick="confStatus('+sid+', 0);" class="btn btn-small orange z-depth-0"><i class="fa fa-arrow-circle-down"></i> 撤销</a>');
        break;
    case -1:
        $('#AD_'+sid+' td').eq(4).html('已删除').removeClass('gray-text green-text red-text').addClass('red-text');
        $('#AD_'+sid+' td').eq(5).html('<a href="javascript:;" onclick="confStatus('+sid+', 0);" class="btn btn-small blue z-depth-0"><i class="fa fa-refresh"></i> 还原</a>');
        break;
    }
}
</script>
<script type="text/javascript" src="<?php echo STATIC_FILE_DIR;?>hnpoker/js/hpa-admin.js"></script>

<!-- PhotoSwipe -->
<script type="text/javascript" src="<?php echo STATIC_FILE_DIR;?>assets/PhotoSwipe/photoswipe.min.js"></script>
<script type="text/javascript" src="<?php echo STATIC_FILE_DIR;?>assets/PhotoSwipe/photoswipe-ui-default.min.js"></script>