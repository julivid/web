<style type="text/css">
  .card .content { overflow: visible;}
</style>

  <!-- Main Content -->
  <section class="content-wrap">


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
                  <a href='javascript:;'>管理员信息</a>
              </li>
            </ul>
        </div>
        <div class="col s12 m3 l2 right-align">
          <!-- <a href="javascript:;" class="btn grey lighten-3 grey-text z-depth-0 chat-toggle"><i class="fa fa-comments"></i></a> -->
        </div>
      </div>

    </div>
    <!-- /Breadcrumb -->
<?php
if(empty($managerInfo)){
  echo '<div class="alert orange lighten-2 white-text">
        <strong>无效信息。</strong> 如有疑问，请联系超级管理员...
    </div>';
}else{
?>
    <div class="card-panel">
      <table class="profile-info">
        <tbody>
          <tr>
            <td class="photo">
              <img src="<?php echo STATIC_FILE_DIR;?>live/img/logo.png" alt="Jogh Doe">
            </td>
            <td>
              <!-- Name -->
              <h3 id="manager_name_show"><?php echo $managerInfo[0]['name'];?></h3>
              <!-- /Name -->

              <!-- Status Message -->
              <span>我们走得太快，灵魂都跟不上了...</span>
              <!-- /Status Message -->

              <!-- Contact Buttons -->
              <div class="contacts">
                <a href="javascript:;" class="blue darken-3 white-text waves-effect">
                  <i class="fa fa-facebook"></i>
                </a>
                <a href="javascript:;" class="blue lighten-2 white-text waves-effect">
                  <i class="fa fa-twitter"></i>
                </a>
                <a href="javascript:;" class="red white-text waves-effect">
                  <i class="fa fa-google-plus"></i>
                </a>
                <a href="javascript:;" class="blue lighten-1 white-text waves-effect">
                  <i class="fa fa-skype"></i>
                </a>
                <a href="javascript:;" class="pink lighten-2 white-text waves-effect">
                  <i class="fa fa-dribbble"></i>
                </a>
                <a href="javascript:;" class="grey darken-3 white-text waves-effect">
                  <i class="fa fa-github"></i>
                </a>
              </div>
              <!-- /Contact Buttons -->
            </td>
          </tr>
        </tbody>
      </table>
    </div>
   
    <div class="card">
      <div class="title">
        <h5><i class="fa fa-user"></i> 基本信息</h5>
      </div>
      <div class="content">
        <div class="row">
          <div class="col s6">
            <div class="input-field">
              <input id="manager_username" type="text" value="<?php echo $managerInfo[0]['username'];?>" disabled>
              <label for="manager_username">登录用户名</label>
            </div>
          </div>
          <div class="col s6">
            <div class="input-field">
              <select id="manager_role">
                <option value="">选择管理员群组（角色）</option>
              <?php
              /*if ( intval( $managerInfo[0]['mid'] ) === 1 ) {
                echo '<option selected="selected" value="1" disabled>超级管理员</option>';
              }else{
                foreach ($roleList as $key => $value) {
                  echo '<option value="'.$key.'" '.($key==$managerInfo[0]['rid'] ? 'selected="selected"' : '').'>'.$value.'</option>';
                }
              }*/
              foreach ($roleList as $key => $value) {
                echo '<option value="'.$key.'" '.($key==$managerInfo[0]['rid'] ? 'selected="selected"' : '').'>'.$value.'</option>';
              }
              
              ?>

              </select>
            </div>
          </div>
          <div class="col s6">
            <div class="input-field">
              <input id="manager_name" type="text" value="<?php echo $managerInfo[0]['name'];?>">
              <label for="manager_name">管理员姓名</label>
            </div>
          </div>
          <div class="col s6">
            <div class="input-field">
              <input id="manager_pwd" type="text" value="" length="32">
              <label for="manager_pwd">登录密码</label>
            </div>
            <p class="red-text">* 不修改密码不需要填写，填写后将修改为新密码</p>
          </div>
          <input type="hidden" id="manager_id" value="<?php echo $managerInfo[0]['mid'];?>">
        </div>
      </div>
    </div>

    <p class="right-align">
      <button class="btn" type="button" onclick="editManager()">保存</button>
      <a class="btn" href="javascript:window.history.back();">返回</a>
    </p>
      

<?php } ?>
  </section>
  <!-- /Main Content -->
<script type="text/javascript">
function editManager () {
  var name = $('#manager_name').val(),
      role = $('#manager_role').val(),
      mid  = $('#manager_id').val(),
      pwd  = $('#manager_pwd').val();
  if (!mid)  { Materialize.toast('上传参数出错，请刷新后重试', 3000, 'danger');return; }
  if (!name) { Materialize.toast('请填写管理员姓名', 3000, 'danger');return; }
  if (!role) { Materialize.toast('请选择管理员群组（角色）', 3000, 'danger');return; }

  if ( pwd && (pwd.length < 6 || pwd.length > 32) ){ Materialize.toast('登录密码要求6～32字符', 3000, 'danger');return; }

  $.ajax({
      url: '<?php echo base_url("Admin/editManager");?>',
      data:{ mid:mid, name:name, role:role, pwd:pwd, a:Math.random()},
      type: "POST",
      dataType: "json",
      success: function(d){  //alert(d);return;
          if(d.status==1){
              Materialize.toast(d.msg, 1000, 'success', function(){
                  $('#manager_name_show').text(name);
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