<style type="text/css">
  .table-hover img {cursor: pointer;}
  .btn-small { padding: 0 1rem; }
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
                        <a href='javascript:;'>权限管理</a> <i class='fa fa-angle-right'></i>
                    </li>
                    <li>
                        <a href='javascript:;'>权限列表</a>
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
        <h5>权限列表</h5>
      </div>
      <div class="content">
        <table class="table table-hover" id="news_list">
          <thead>
            <tr>
              <th>编号</th>
              <th>权限名称</th>
              <th>所属控制器</th>
              <th>所属方法</th>
              <th>状态</th>
              <th>操作</th>
            </tr>
          </thead>
          <tbody>
<?php
if (empty($privileges)) {
  echo '<tr><td colspan="7" style="text-align:center; padding:20px; color:#e53935;">暂无数据</td></tr>';
}else{
  foreach ($privileges as $k=>$privilege) {
    echo '<tr id="NL_'.$privilege['pid'].'">
              <td>'.($k+1).'</td>
              <td>
                  <strong class="grey-text text-darken-2">'.$privilege['pname'].'</strong>
              </td>
              <td>'.$privilege['pctl'].'</td>
              <td>'.$privilege['pmethod'].'</td>';
    switch($privilege['status']){
      case '1':
        echo '<td class="green-text">使用中</td><td>-</td></tr>';
        break;
      case '2':
        echo '<td class="red-text">已删除</td><td>-</td></tr>';
        break;
      case '0':
      default:
        echo '<td class="gray-text">未使用</td><td>-</td></tr>';
        break;
      }
  }
}
?>
            
          </tbody>
        </table>
      </div>
    </div>
    <!-- /Products -->
  </section>
  <!-- /Main Content -->