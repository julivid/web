<style type="text/css">
  .table-hover img {cursor: pointer;}
  .btn-small { padding: 0 1rem; }
  #product_list img { width: auto; height: 50px;}
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
                        <a href='javascript:;'>电子商务</a> <i class='fa fa-angle-right'></i>
                    </li>
                    <li>
                        <a href='javascript:;'>产品列表</a>
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
        <h5>产品列表</h5>
      </div>
      <div class="content">
        <a class="btn-floating btn-extra waves-effect waves-light red tooltipped" href="<?php echo base_url('Product/add');?>" data-tooltip="添加新产品" data-position="left" style="position: fixed; bottom: 25px; right: 25px;">
          <i class="mdi-content-add"></i>
        </a>
        <table class="table table-hover" id="product_list">
          <thead>
            <tr>
              <th>品类编号</th>
              <th>图片</th>
              <th>产品简介</th>
              <th>库存</th>
              <th>单价</th>
              <th>状态</th>
              <th>操作</th>
            </tr>
          </thead>
          <tbody>
<?php
if (empty($productList)) {
  echo '<tr><td colspan="7" style="text-align:center; padding:20px; color:#e53935;">暂无数据</td></tr>';
}else{
  foreach ($productList as $product) {
    echo '<tr id="PL_'.$product['pid'].'">
              <th>'.$product['product_no'].'</th>
              <td>
                <img src="'.UPLOAD_FILE_DIR.date('Ym', $product['imgTime']).'/thumb/'.$product['main_photo'].'" alt="'.$product['tag'].'">
              </td>
              <td>
                <a href="'.base_url('Product/show?id='.$product['pid']).'">
                  <strong class="grey-text text-darken-2">'.$product['name'].'</strong>
                  <br>
                  <span class="grey-text">'.$product['brief'].'</span>
                </a>
              </td>
              <td>'.$product['store'].'</td>
              <td>¥'.$product['price'].'</td>';
    if($product['status']==0){
      echo '<td class="gray-text">'.$productStatus[$product['status']].'</td>
            <td>
              <a href="javascript:;" onclick="productStatus('.$product['pid'].', 1);" class="btn btn-small green z-depth-0"><i class="fa fa-arrow-circle-up"></i> 上架</a>
              <a href="'.base_url('Product/info?id='.$product['pid']).'" class="btn btn-small z-depth-0"><i class="mdi mdi-editor-mode-edit"></i> 编辑</a>
              <a href="javascript:;" onclick="productStatus('.$product['pid'].', 2);" class="btn btn-small red z-depth-0"><i class="mdi mdi-action-delete"></i> 删除</a>
            </td>';
    }elseif ($product['status']==1) {
      echo '<td class="green-text">'.$productStatus[$product['status']].'</td>
            <td>
              <a href="javascript:;" onclick="productStatus('.$product['pid'].', 0);" class="btn btn-small orange z-depth-0"><i class="fa fa-arrow-circle-down"></i> 下架</a>
            </td>';
    }else{
      echo '<td class="red-text">'.$productStatus[$product['status']].'</td>
            <td>
              <a href="javascript:;" onclick="productStatus('.$product['pid'].', 0);" class="btn btn-small blue z-depth-0"><i class="fa fa-refresh"></i> 还原</a>
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
        <a href="javascript:;" class="btn-flat waves-effect waves-light-green grey-text text-darken-1" onclick="loadData();">加载更多</a>
      </div>
    </div>
    <!-- /Products -->
  </section>
  <!-- /Main Content -->
<script type="text/javascript">
function productStatus(pid, s){
    if (!pid) { Materialize.toast('产品信息出错，请刷新后重试', 3000, 'danger');return; }
    
    $.ajax({
        url: '<?php echo base_url("Product/productStatus");?>',
        data:{ pid:pid, status: s, a:Math.random()},
        type: "POST",
        dataType: "json",
        success: function(d){  //alert(d);return;
            if(d.status==1){
                Materialize.toast(d.msg, 1000, 'success', function(){
                    _changeStatus(pid, s);
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
function _changeStatus(pid, s){
  switch(s){
    case 0: 
      $('#PL_'+pid+' td').eq(4).html('已入库').removeClass('gray-text green-text red-text').addClass('gray-text');
      $('#PL_'+pid+' td').eq(5).html('<a href="javascript:;" onclick="productStatus('+pid+', 1);" class="btn btn-small green z-depth-0"><i class="fa fa-arrow-circle-up"></i> 上架</a> <a href="<?php echo base_url('Product/info');?>?id='+pid+'" class="btn btn-small z-depth-0"><i class="mdi mdi-editor-mode-edit"></i> 编辑</a> <a href="javascript:;" onclick="productStatus('+pid+', 2);" class="btn btn-small red z-depth-0"><i class="mdi mdi-action-delete"></i> 删除</a>');
      break;
    case 1:
      $('#PL_'+pid+' td').eq(4).html('已上架').removeClass('gray-text green-text red-text').addClass('green-text');
      $('#PL_'+pid+' td').eq(5).html('<a href="javascript:;" onclick="productStatus('+pid+', 0);" class="btn btn-small orange z-depth-0"><i class="fa fa-arrow-circle-down"></i> 下架</a>');
      break;
    case 2:
      $('#PL_'+pid+' td').eq(4).html('已删除').removeClass('gray-text green-text red-text').addClass('red-text');
      $('#PL_'+pid+' td').eq(5).html('<a href="javascript:;" onclick="productStatus('+pid+', 0);" class="btn btn-small blue z-depth-0"><i class="fa fa-refresh"></i> 还原</a>');
      break;
  }
}
var dataPage = 1;
function loadData(){
    if ( dataPage == 'all' ) {
        Materialize.toast('别点了，已经是全部信息了～', 1500, 'danger'); return;
    }
    $.ajax({
          url: '<?php echo base_url("Product/getProductListAJAX");?>',
          data:{ p:++dataPage, a:Math.random()},
          type: "POST",
          dataType: "json",
          success: function(d){  //alert(d);return;
              if(d.status==1){
                  Materialize.toast(d.msg, 1000, 'success', function(){
                    formatProductInfo(d.data);
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
function formatProductInfo(data){
  if (data.length == 0) {
      dataPage = 'all';
      Materialize.toast('全部信息已加载～', 1500, 'danger');return;
  }
  var htmlStr = '', proStatus = ['已入库', '已上架', '已删除'];
  $.each(data, function(i,o){
    htmlStr += '<tr id="PL_' + o.pid + '"><th>' + o.product_no + '</th><td><img src="<?php echo UPLOAD_FILE_DIR;?>' + formatDate(o.imgTime) + '/thumb/' + o.main_photo + '" alt="' + o.tag + '"></td><td><a href="<?php echo base_url('Product/show');?>?id=' + o.pid +'">  <strong class="grey-text text-darken-2">' + o.name + '</strong><br><span class="grey-text">' + o.brief + '</span></a></td><td>' + o.store + '</td><td>¥' + o.price + '</td>';

    if(o.status==0){
      htmlStr += '<td class="gray-text">' + proStatus[o.status] + '</td><td><a href="javascript:;" onclick="productStatus(' + o.pid + ', 1);" class="btn btn-small green z-depth-0"><i class="fa fa-arrow-circle-up"></i> 上架</a> <a href="<?php echo base_url('Product/info');?>?id=' + o.pid + '" class="btn btn-small z-depth-0"><i class="mdi mdi-editor-mode-edit"></i> 编辑</a> <a href="javascript:;" onclick="productStatus(' + o.pid + ', 2);" class="btn btn-small red z-depth-0"><i class="mdi mdi-action-delete"></i> 删除</a></td>';
    } else if(o.status==1){
      htmlStr += '<td class="green-text">'+ proStatus[o.status] +'</td><td><a href="javascript:;" onclick="productStatus(' + o.pid + ', 0);" class="btn btn-small orange z-depth-0"><i class="fa fa-arrow-circle-down"></i> 下架</a></td>';
    } else {
      htmlStr += '<td class="red-text">'+ proStatus[o.status] +'</td><td><a href="javascript:;" onclick="productStatus(' + o.pid + ', 0);" class="btn btn-small blue z-depth-0"><i class="fa fa-refresh"></i> 还原</a></td>';
    }
    htmlStr += '</tr>';
  });
  $('#product_list tbody').append(htmlStr);
}
function formatDate(dt){
  var date = new Date();
  date.setTime(dt * 1000);
  var y = date.getFullYear(), m = date.getMonth()+1;
  if (m<10) {
    m = '0'+m;
  };
  return y.toString() + m;
}
</script>