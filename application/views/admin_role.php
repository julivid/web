<style type="text/css">
  .btn { margin-bottom: 5px;}
  .table-hover img {cursor: pointer;}
  .btn-small { padding: 0 1rem; }
  .modal-content h4{
    border-bottom: 1px solid #ccc; padding-bottom: 10px;
  }
  #toast-container { z-index: 1004;}
  .role-item { border:1px solid #039be5; text-align: center; padding: 10px 20px; cursor: pointer; font-size: 14px;}
  .roleListItem { display: inline-block; padding: 5px 10px; margin-right: 10px; font-weight: 600; margin-bottom: 3px;}
  .role-item.selected, .roleListItem { background:#039be5; color: #fff;}
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
                        <a href='javascript:;'>角色列表</a>
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
        <h5>角色列表</h5>
      </div>
      <div class="content">
        <a class="btn-floating btn-extra waves-effect waves-light red tooltipped" href="javascript:addRole();" data-tooltip="添加新角色" data-position="left" style="position: fixed; bottom: 25px; right: 25px;">
          <i class="mdi-content-add"></i>
        </a>
        <table class="table table-hover" id="role_list">
          <thead>
            <tr>
              <th>角色名称</th>
              <th>权限列表</th>
              <th>操作</th>
            </tr>
          </thead>
          <tbody>
<?php
if (empty($rolePrivilege)) {
  echo '<tr><td colspan="7" style="text-align:center; padding:20px; color:#e53935;">暂无数据</td></tr>';
}else{
  foreach ($rolePrivilege as $rid=>$role) {
    echo '<tr id="role_'.$rid.'">
            <td>'.$role['rname'].'</td>
            <td>';
    foreach ($role['pList'] as $pid => $pname) {
      echo '<span class="roleListItem" data-pid="'.$pid.'">'.$pname.'</span> ';
    }
    echo '</td>
            <td>
                <a href="javascript:editRole('.$rid.');" class="btn btn-small z-depth-0"><i class="mdi mdi-editor-mode-edit"></i> 编辑</a> 
                <a href="javascript:delRole('.$rid.');" class="btn btn-small red z-depth-0"><i class="mdi mdi-action-delete"></i> 删除</a>
            </td>
        </tr>';
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

<?php
$roleStr4JS = $pStr = '';
foreach ($privileges as $k => $v) {
  $pStr .= '<div class="col s3"><div class="role-item" id="role_4_edit_'.$v['pid'].'" data-privilegeid="'.$v['pid'].'">'.$v['pname'].'</div></div>';
  $roleStr4JS .= 'roleList['.$v['pid'].']="'.$v['pname'].'";';
}
?>
<div id="roleInfo" class="modal">
  <div class="modal-content">
    <h4>角色信息</h4>
    <div class="row">
      <div class="col s12">
        <div class="input-field">
          <input id="role_name" type="text" class="validate" value="" placeholder="请输入角色名称">
          <label for="role_name">角色名称</label>
        </div>
      </div>
    </div>
    <div class="row">
    <?php echo $pStr;?>
    </div>
    <form><input type="hidden" id="role_edit_id" value="0"></form>
  </div>
  <div class="modal-footer">
    <a href="javascript:;" class="modal-action modal-close waves-effect waves-red btn-flat ">取消</a>
    <a href="javascript:;" onclick="roleCtl();" class="modal-action waves-effect waves-green btn-flat ">确认提交</a>
  </div>
</div>




<script type="text/javascript">
$(document).ready(function(){
    $('.role-item').click(function(){
        $(this).toggleClass('selected');
    })
});
var roleList=[];
<?php echo $roleStr4JS;?>


function formatroleInfo(rid, flag){
    if ( rid < 1 ) {
        window.location.reload();
    }
    var htmlStr = '';
    htmlStr += '<tr id="role_'+ rid +'"><td>'+ $('#role_name').val() +'</td><td>';

    $('.role-item.selected').each(function(i){
        htmlStr += '<span class="roleListItem" data-pid="'+$(this).data('privilegeid')+'">' + roleList[$(this).data('privilegeid')] + '</span> ';
    });
    
    htmlStr += '</td><td><a href="javascript:editRole('+ rid +');" class="btn btn-small z-depth-0"><i class="mdi mdi-editor-mode-edit"></i> 编辑</a> <a href="javascript:delRole('+ rid +');" class="btn btn-small red z-depth-0"><i class="mdi mdi-action-delete"></i> 删除</a></td></tr>';
    if( rid == flag ){
        $('#role_'+rid).remove();
    }
    $('#role_list tbody').append(htmlStr);
    formInit();
}

function roleCtl() {
    var name = $('#role_name').val(), roleArr = [], rid = $('#role_edit_id').val(), ctlUrl, ctlData;
    $('.role-item.selected').each(function(i){
        roleArr.push($(this).data('privilegeid'));
    });
    if (!name) { Materialize.toast('请填写角色名称', 3000, 'danger');return; }
    if (roleArr.length==0) { Materialize.toast('请选择角色权限', 3000, 'danger');return; }
    if(rid>0){
        ctlUrl = '<?php echo base_url("Admin/editRole");?>';
        ctlData = {name:name, role:roleArr, rid:rid, a:Math.random()};
    }else{
        ctlUrl = '<?php echo base_url("Admin/addRole");?>';
        ctlData = {name:name, role:roleArr, a:Math.random()};
    }
    console.log(ctlUrl+ctlData);
    //return;
    $.ajax({
        url: ctlUrl,
        data: ctlData,
        type: "POST",
        dataType: "json",
        success: function(d){  //alert(d);return;
            if(d.status==1){
                Materialize.toast(d.msg, 1000, 'success', function(){
                    formatroleInfo(d.data, rid);
                    $('#roleInfo').closeModal();
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
function addRole(){
    formInit();
    $('#roleInfo').openModal();
}
function editRole(rid){
    formInit();
    $('#role_edit_id').val(rid);
    $('#role_name').val($('#role_'+rid+' td').eq(0).text());
    $.each($('#role_'+rid+' td').eq(1).find('span'), function(i,o){
        $('#role_4_edit_'+$(o).data('pid') ).addClass('selected');
    });
    $('#roleInfo').openModal();
}
function delRole(rid){
    if (rid && confirm('确认删除该角色吗？删除后，该角色下所有管理员将被禁用')) {
        $.ajax({
            url: '<?php echo base_url("Admin/delRole");?>',
            data: {rid:rid, a:Math.random()},
            type: "POST",
            dataType: "json",
            success: function(d){  //alert(d);return;
                if(d.status==1){
                    Materialize.toast(d.msg, 1000, 'success', function(){
                        $('#role_'+rid).remove();
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
}
function formInit(){
    $('#role_edit_id').val('0');
    $('#role_name').val('');
    $('.role-item').removeClass('selected');
}
</script>