<style type="text/css">
  .table-hover img {cursor: pointer;}
  .btn-small { padding: 0 1rem; }
  #news_list img { width: auto; height: 50px;}
  .index-show { color: #00ccff; border: 1px dashed #00ccff;}
</style>

  <!-- Main Content -->
  <section class="content-wrap ecommerce-products">

    <!-- Breadcrumb -->
    <div class="page-title">

        <div class="row">
            <div class="col s12 m9 l10">
                <ul>
                    <li>
                        <a href="<?php echo base_url();?>"><i class="fa fa-home"></i> 首页</a>  <i class="fa fa-angle-right"></i>
                    </li>

                    <li>
                        <a href='javascript:;'>信息管理</a> <i class='fa fa-angle-right'></i>
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
    <!-- /Breadcrumb -->

    <!-- Products -->
    <div class="card">
      <div class="title">
        <h5>信息列表</h5>
      </div>
      <div class="content">
        <a class="btn-floating btn-extra waves-effect waves-light red tooltipped" href="<?php echo base_url('News/add');?>" data-tooltip="添加信息" data-position="left" style="position: fixed; bottom: 25px; right: 25px;">
          <i class="mdi-content-add"></i>
        </a>
        <table class="table table-hover" id="news_list">
          <thead>
            <tr>
              <th>标题</th>
              <th>插图</th>
              <th>简介</th>
              <th>标签</th>
              <th>状态</th>
              <th>操作</th>
            </tr>
          </thead>
          <tbody>
<?php
if (empty($newsList)) {
  echo '<tr><td colspan="7" style="text-align:center; padding:20px; color:#e53935;">暂无数据</td></tr>';
}else{
  foreach ($newsList as $news) {
    echo '<tr id="NL_'.$news['nid'].'" class="'.($news['index_show']==1?'index-show':'').'">
              <td>
                <a href="'.base_url('News/show?id='.$news['nid']).'">
                  <strong class="grey-text text-darken-2">'.$this->auth->getContentBrief($news['title'], 12).'</strong>
                </a>
              </td>
              <td>
                <img src="'.UPLOAD_IMG_URL.date('Ym', $news['imgTime']).'/thumb/'.$news['main_photo'].'" alt="'.$news['tag'].'">
              </td>
              <td>'.$this->auth->getContentBrief($news['brief']).'</td>
              <td>'.$this->auth->getContentBrief($news['tag'], 5).'</td>';
    if($news['status']==0){
        echo '<td class="gray-text">'.$newsStatus[$news['status']].'</td>
            <td>
              <a href="javascript:;" onclick="newsStatus('.$news['nid'].', 1);" class="btn btn-small green z-depth-0"><i class="fa fa-arrow-circle-up"></i> 发布</a>
              <a href="'.base_url('News/info?id='.$news['nid']).'" class="btn btn-small z-depth-0"><i class="mdi mdi-editor-mode-edit"></i> 编辑</a>
              <a href="javascript:;" onclick="newsStatus('.$news['nid'].', -1);" class="btn btn-small red z-depth-0"><i class="mdi mdi-action-delete"></i> 删除</a>
            </td>';
    }elseif ($news['status']==1) {
        echo '<td class="green-text">'.$newsStatus[$news['status']].'</td>
            <td>
              <a href="javascript:;" onclick="newsStatus('.$news['nid'].', 0);" class="btn btn-small orange z-depth-0"><i class="fa fa-arrow-circle-down"></i> 撤销</a> ';
        if ($news['index_show']!=1) {
            echo '<a href="javascript:;" onclick="send2Index('.$news['nid'].', this);" class="btn btn-small red z-depth-0"><i class="mdi-toggle-radio-button-on"></i> 首页</a>';
        }
        echo '</td>';
    }else{
      echo '<td class="red-text">'.$newsStatus[$news['status']].'</td>
            <td>
              <a href="javascript:;" onclick="newsStatus('.$news['nid'].', 0);" class="btn btn-small blue z-depth-0"><i class="fa fa-refresh"></i> 还原</a>
            </td>';
    }
            
    echo '</tr>';
  }
}
?>
            
          </tbody>
        </table>
      </div>
      <div class="center-align" style="padding-bottom:10px;">
        <a href="javascript:;" class="btn-flat waves-effect waves-light-blue grey-text text-darken-1" onclick="loadData(this, formatNewsInfo);">加载更多</a>
      </div>
    </div>
    <!-- /Products -->
  </section>
  <!-- /Main Content -->

<script type="text/javascript">
var _getDataPara = '<?php echo $actNavBar;?>';
var dataPage = 1, dataApiUrl = '<?php echo base_url("News/getNewsListAJAX");?>';

function newsStatus(nid, s){
    if (!nid) { Materialize.toast('信息出错，请刷新后重试', 3000, 'danger');return; }
    if( $('#NL_'+nid).hasClass('index-show') ) { Materialize.toast('请先更换其它内容到［首页］再进行操作', 3000, 'danger'); return; }
    $.ajax({
        url: '<?php echo base_url("News/newsStatus");?>',
        data:{ nid:nid, status: s, a:Math.random()},
        type: "POST",
        dataType: "json",
        success: function(d){  //alert(d);return;
            if(d.status==1){
                Materialize.toast(d.msg, 1000, 'success', function(){
                    _changeNewsStatus(nid, s);
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
function send2Index (nid, obj) {
    if (!nid) { Materialize.toast('信息出错，请刷新后重试', 3000, 'danger');return; }
    
    $.ajax({
        url: '<?php echo base_url("News/indexShow");?>',
        data:{ nid:nid, channel:_getDataPara, a:Math.random()},
        type: "POST",
        dataType: "json",
        success: function(d){  //alert(d);return;
            if(d.status==1){
                Materialize.toast(d.msg, 1000, 'success', function(){
                    window.location.reload();
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
function _changeNewsStatus(nid, s){
    switch(s){
    case 0: 
        $('#NL_'+nid+' td').eq(4).html('已录入').removeClass('gray-text green-text red-text').addClass('gray-text');
        $('#NL_'+nid+' td').eq(5).html('<a href="javascript:;" onclick="newsStatus('+nid+', 1);" class="btn btn-small green z-depth-0"><i class="fa fa-arrow-circle-up"></i> 发布</a> <a href="<?php echo base_url('News/info');?>?id='+nid+'" class="btn btn-small z-depth-0"><i class="mdi mdi-editor-mode-edit"></i> 编辑</a> <a href="javascript:;" onclick="newsStatus('+nid+', -1);" class="btn btn-small red z-depth-0"><i class="mdi mdi-action-delete"></i> 删除</a>');
        break;
    case 1:
        $('#NL_'+nid+' td').eq(4).html('已发布').removeClass('gray-text green-text red-text').addClass('green-text');
        $('#NL_'+nid+' td').eq(5).html('<a href="javascript:;" onclick="newsStatus('+nid+', 0);" class="btn btn-small orange z-depth-0"><i class="fa fa-arrow-circle-down"></i> 撤销</a> <a href="javascript:;" onclick="send2Index('+nid+', this);" class="btn btn-small red z-depth-0"><i class="mdi-toggle-radio-button-on"></i> 首页</a>');
        break;
    case -1:
        $('#NL_'+nid+' td').eq(4).html('已删除').removeClass('gray-text green-text red-text').addClass('red-text');
        $('#NL_'+nid+' td').eq(5).html('<a href="javascript:;" onclick="newsStatus('+nid+', 0);" class="btn btn-small blue z-depth-0"><i class="fa fa-refresh"></i> 还原</a>');
        break;
    }
}
function formatNewsInfo(data){
    if (data.length == 0) {
        dataPage = 'all';
        Materialize.toast('全部信息已加载～', 1500, 'danger');return;
    }
    var htmlStr = '', newsStatus = ['已录入', '已发布', '已删除'];
    $.each(data, function(i,o){
        htmlStr += '<tr id="NL_' + o.nid + '" class="';
        if (o.index_show==1) {
            htmlStr += 'index-show';
        }
        htmlStr += '"><td><a href="<?php echo base_url('News/show');?>?id=' + o.nid +'">  <strong class="grey-text text-darken-2">' + o.title + '</strong></a></td><td><img src="<?php echo UPLOAD_IMG_URL;?>' + formatDate(o.imgTime) + '/thumb/' + o.main_photo + '" alt="' + o.tag + '"></td><td>' + getBrief(o.brief, 20) + '</td><td>' + o.tag + '</td>';

        if(o.status==0){
            htmlStr += '<td class="gray-text">已录入</td><td><a href="javascript:;" onclick="newsStatus(' + o.nid + ', 1);" class="btn btn-small green z-depth-0"><i class="fa fa-arrow-circle-up"></i> 发布</a> <a href="<?php echo base_url('News/info');?>?id=' + o.nid + '" class="btn btn-small z-depth-0"><i class="mdi mdi-editor-mode-edit"></i> 编辑</a> <a href="javascript:;" onclick="newsStatus(' + o.nid + ', 2);" class="btn btn-small red z-depth-0"><i class="mdi mdi-action-delete"></i> 删除</a></td>';
        } else if(o.status==1){
            htmlStr += '<td class="green-text">已发布</td><td><a href="javascript:;" onclick="newsStatus(' + o.nid + ', 0);" class="btn btn-small orange z-depth-0"><i class="fa fa-arrow-circle-down"></i> 撤销</a> ';
            if (o.index_show!=1) {
                htmlStr += '<a href="javascript:;" onclick="send2Index('+o.nid+', this);" class="btn btn-small red z-depth-0"><i class="mdi-toggle-radio-button-on"></i> 首页</a>';
            }
            htmlStr += '</td>';
        } else {
            htmlStr += '<td class="red-text">已删除</td><td><a href="javascript:;" onclick="newsStatus(' + o.nid + ', 0);" class="btn btn-small blue z-depth-0"><i class="fa fa-refresh"></i> 还原</a></td>';
        }
        htmlStr += '</tr>';
    });
    $('#news_list tbody').append(htmlStr);
}
</script>
<script type="text/javascript" src="<?php echo STATIC_FILE_DIR;?>hnpoker/js/hpa-admin.js"></script>