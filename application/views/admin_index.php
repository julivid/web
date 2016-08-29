<style type="text/css">
  .table-hover img {cursor: pointer;}
  .btn-small { padding: 0 1rem; }
  .modal-content h4{
    border-bottom: 1px solid #ccc; padding-bottom: 10px;
  }
  #toast-container { z-index: 1004;}
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
                        <a href='javascript:;'>管理员列表</a>
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
        <h5>管理员列表</h5>
      </div>
      <div class="content">
        <a class="btn-floating btn-extra waves-effect waves-light red tooltipped modal-trigger" href="#managerInfo" data-tooltip="添加管理员" data-position="left" style="position: fixed; bottom: 25px; right: 25px;">
          <i class="mdi-content-add"></i>
        </a>
        <table class="table table-hover" id="manager_list">
          <thead>
            <tr>
              <th>姓名</th>
              <th>用户名</th>
              <th>所属群组（角色）</th>
              <th>状态</th>
              <th>操作</th>
            </tr>
          </thead>
          <tbody>
<?php
if (empty($managerList)) {
  echo '<tr><td colspan="7" style="text-align:center; padding:20px; color:#e53935;">暂无数据</td></tr>';
}else{
  foreach ($managerList as $manager) {
    echo '<tr id="Manager_'.$manager['mid'].'">
              <td>
                  <strong class="grey-text text-darken-2">'.$manager['name'].'</strong>
              </td>
              <td>'.$manager['username'].'</td>
              <td>'.(empty( $roleList[$manager['rid']] ) ? '<span class="red-text">无效群组</span>' : $roleList[$manager['rid']]).'</td>';
    switch($manager['status']){
      case '1':
        echo '<td class="green-text">使用中</td><td><a href="'.base_url('Admin/edit').'?id='.$manager['mid'].'" class="btn btn-small z-depth-0"><i class="mdi mdi-editor-mode-edit"></i> 编辑</a> <a href="javascript:;" onclick="delManager('.$manager['mid'].');" class="btn btn-small red z-depth-0"><i class="mdi-action-delete"></i> 删除</a></td></tr>';
        break;
      case '2':
        echo '<td class="red-text">已删除</td><td><a href="javascript:;" onclick="managerStatus('.$manager['mid'].', 0);" class="btn btn-small blue z-depth-0"><i class="fa fa-refresh"></i> 还原</a></td></tr>';
        break;
      case '0':
      default:
        echo '<td class="gray-text">未使用</td><td><a href="javascript:;" onclick="managerStatus('.$manager['mid'].', 1);" class="btn btn-small green z-depth-0"><i class="fa fa-arrow-circle-up"></i> 启用</a> <a href="'.base_url('Admin/edit').'?id='.$manager['mid'].'" class="btn btn-small z-depth-0"><i class="mdi mdi-editor-mode-edit"></i> 编辑</a>  <a href="javascript:;" onclick="delManager('.$manager['mid'].', 2);" class="btn btn-small red z-depth-0"><i class="mdi mdi-action-delete"></i> 删除</a></td></tr>';
        break;
    }
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


<div id="managerInfo" class="modal">
  <div class="modal-content">
    <h4>管理员信息</h4>
    <div class="row">
      <div class="col s12">
        <div class="input-field">
          <input id="manager_name" type="text" class="validate" value="">
          <label for="manager_name">管理员姓名</label>
        </div>
      </div>
      <div class="col s12">
        <div class="input-field">
          <select id="manager_role">
            <option value="" disabled selected>选择管理员群组（角色）</option>
<?php
$roleStr = "'',";
foreach ($roleList as $key => $value) {
  echo '<option value="'.$key.'">'.$value.'</option>';
  $roleStr .= "'".$value."',";
}
$roleStr = rtrim($roleStr, ',');
?>

          </select>
        </div>
      </div>
      <div class="col s12">
        <div class="input-field">
          <input id="manager_username" type="text" class="validate" value="" length="32">
          <label for="manager_username">登录用户名</label>
        </div>
      </div>
      <div class="col s12">
        <div class="input-field">
          <input id="manager_pwd" type="text" class="validate" value="" length="32">
          <label for="manager_pwd">登录密码</label>
        </div>
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <a href="javascript:;" class="modal-action modal-close waves-effect waves-red btn-flat ">取消</a>
    <a href="javascript:;" onclick="addManager()" class="modal-action waves-effect waves-green btn-flat ">确认添加</a>
  </div>
</div>


<script type="text/javascript">
function delManager(mid){
    if (!mid) { Materialize.toast('管理员信息出错，请刷新后重试', 3000, 'danger');return; }
    if(mid==1){ Materialize.toast('该用户不可以操作', 3000, 'danger');return; }
    $.ajax({
        url: '<?php echo base_url("Admin/delManager");?>',
        data:{ mid:mid, a:Math.random()},
        type: "POST",
        dataType: "json",
        success: function(d){  //alert(d);return;
            if(d.status==1){
                Materialize.toast(d.msg, 1000, 'success', function(){
                    //_changeStatus(mid, s);
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
function managerStatus(mid, s){
    if (!mid) { Materialize.toast('管理员信息出错，请刷新后重试', 3000, 'danger');return; }
    if(mid==1){ Materialize.toast('该用户不可以操作', 3000, 'danger');return; }
    $.ajax({
        url: '<?php echo base_url("Admin/managerStatus");?>',
        data:{ mid:mid, status: s, a:Math.random()},
        type: "POST",
        dataType: "json",
        success: function(d){  //alert(d);return;
            if(d.status==1){
                Materialize.toast(d.msg, 1000, 'success', function(){
                    //_changeStatus(mid, s);
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
function _changeStatus(mid, s){
  switch(s){
    case 0: 
      $('#Manager_'+mid+' td').eq(3).html('未使用').removeClass('gray-text green-text red-text').addClass('gray-text');
      $('#Manager_'+mid+' td').eq(4).html('<a href="javascript:;" onclick="managerStatus('+mid+', 1);" class="btn btn-small green z-depth-0"><i class="fa fa-arrow-circle-up"></i> 启用</a> <a href="<?php echo base_url('Admin/edit');?>?id='+mid+'" class="btn btn-small z-depth-0"><i class="mdi mdi-editor-mode-edit"></i> 编辑</a>  <a href="javascript:;" onclick="delManager('+mid+');" class="btn btn-small red z-depth-0"><i class="mdi mdi-action-delete"></i> 删除</a>');
      break;
    case 1:
      $('#Manager_'+mid+' td').eq(3).html('使用中').removeClass('gray-text green-text red-text').addClass('green-text');
      $('#Manager_'+mid+' td').eq(4).html('<a href="<?php echo base_url('Admin/edit');?>?id='+mid+'" class="btn btn-small z-depth-0"><i class="mdi mdi-editor-mode-edit"></i> 编辑</a> <a href="javascript:;" onclick="delManager('+mid+');" class="btn btn-small red z-depth-0"><i class="mdi-action-delete"></i> 删除</a>');
      break;
    case 2:
      $('#Manager_'+mid+' td').eq(3).html('已删除').removeClass('gray-text green-text red-text').addClass('red-text');
      $('#Manager_'+mid+' td').eq(4).html('<a href="javascript:;" onclick="managerStatus('+mid+', 0);" class="btn btn-small blue z-depth-0"><i class="fa fa-refresh"></i> 还原</a>');
      break;
  }
}
var dataPage = 1;
function loadData(){
    if ( dataPage == 'all' ) {
        Materialize.toast('别点了，已经是全部信息了～', 1500, 'danger'); return;
    }
    $.ajax({
          url: '<?php echo base_url("Admin/getManagerListAJAX");?>',
          data:{ p:++dataPage, a:Math.random()},
          type: "POST",
          dataType: "json",
          success: function(d){  //alert(d);return;
              if(d.status==1){
                  Materialize.toast(d.msg, 1000, 'success', function(){
                    formatManagerInfo(d.data);
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
function formatManagerInfo(data){
  if (data.length == 0) {
      dataPage = 'all';
      Materialize.toast('全部信息已加载～', 1500, 'danger');return;
  }
  var htmlStr = '', managerStatus = ['未使用', '使用中', '已删除'], roleList=[<?php echo $roleStr?>];
  $.each(data, function(i,o){
    htmlStr += '<tr id="Manager_' + o.mid + '"><td><strong class="grey-text text-darken-2">' + o.name + '</strong></td><td>' + o.username + '</td><td>' + roleList[o.rid] + '</td>';

    if(o.status==0){
      htmlStr += '<td class="gray-text">' + managerStatus[o.status] + '</td><td><a href="javascript:;" onclick="managerStatus(' + o.mid + ', 1);" class="btn btn-small green z-depth-0"><i class="fa fa-arrow-circle-up"></i> 启用</a> <a href="<?php echo base_url('Admin/edit');?>?id='+o.mid+'" class="btn btn-small z-depth-0"><i class="mdi mdi-editor-mode-edit"></i> 编辑</a>  <a href="javascript:;" onclick="delManager(' + o.mid + ');" class="btn btn-small red z-depth-0"><i class="mdi mdi-action-delete"></i> 删除</a></td>';
    } else if(o.status==1){
      htmlStr += '<td class="green-text">'+ managerStatus[o.status] +'</td><td><a href="<?php echo base_url('Admin/edit');?>?id='+o.mid+'" class="btn btn-small z-depth-0"><i class="mdi mdi-editor-mode-edit"></i> 编辑</a> <a href="javascript:;" onclick="delManager(' + o.mid + ');" class="btn btn-small red z-depth-0"><i class="mdi-action-delete"></i> 删除</a></td>';
    } else {
      htmlStr += '<td class="red-text">'+ managerStatus[o.status] +'</td><td><a href="javascript:;" onclick="managerStatus(' + o.mid + ', 0);" class="btn btn-small blue z-depth-0"><i class="fa fa-refresh"></i> 还原</a></td>';
    }
    htmlStr += '</tr>';
  });
  $('#manager_list tbody').append(htmlStr);
}

function addManager () {
  var name = $('#manager_name').val(), 
      role = $('#manager_role').val(), 
      username = $('#manager_username').val(), 
      pwd = $('#manager_pwd').val();
  if (!name) { Materialize.toast('请填写管理员姓名', 3000, 'danger');return; }
  if (!role) { Materialize.toast('请选择管理员群组（角色）', 3000, 'danger');return; }
  if (!username) { Materialize.toast('请填写管理员登录用户名', 3000, 'danger');return; }
  if (username.length < 6 || username.length > 32) { Materialize.toast('登录用户名要求6～32字符', 3000, 'danger');return; }
  if (!pwd) { Materialize.toast('请填写管理员登录密码', 3000, 'danger');return; }
  if (pwd.length < 6 || pwd.length > 32) { Materialize.toast('登录密码要求6～32字符', 3000, 'danger');return; }

  $.ajax({
      url: '<?php echo base_url("Admin/addManager");?>',
      data:{ name:name, role:role, username:username, pwd:pwd, a:Math.random()},
      type: "POST",
      dataType: "json",
      success: function(d){  //alert(d);return;
          if(d.status==1){
              Materialize.toast(d.msg, 1000, 'success', function(){
                  formatManagerInfo(d.data);
                  $('#managerInfo').closeModal();
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

</script>