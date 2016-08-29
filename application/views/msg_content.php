
  <a class="mail-compose-btn btn-floating btn-extra waves-effect waves-light red tooltipped" href="<?php echo base_url('Msg/msgNew');?>" data-tooltip="写新信息" data-position="left">
    <i class="mdi-content-add"></i>
  </a>

  <!-- Main Content -->
  <section class="content-wrap mail-compose">


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
                  <a href='javascript:;'>回复信息</a>
              </li>
          </ul>
        </div>
        <div class="col s12 m3 l2 right-align">
          <!-- <a href="javascript:;" class="btn grey lighten-3 grey-text z-depth-0 chat-toggle"><i class="fa fa-comments"></i></a> -->
        </div>
      </div>

    </div>
    <!-- /Breadcrumb -->

    <div class="row">
      
      <div class="col s12 ">
        <div class="card-panel">
          <form >
            <!-- To -->
            <div class="input-field">
              <input id="input_to" type="email" class="validate" value="john.doe@inbox.my" name="to" disabled>
              <label for="input_to"> 收件人</label>
            </div>
            <!-- /To -->

            <!-- Subject -->
            <div class="input-field">
              <input id="input_subject" type="text" class="validate" name="subject">
              <label for="input_subject">主题</label>
            </div>
            <!-- /Subject -->

            <!-- Message -->
            <textarea name="message" id="ckeditor-msg">
              <p>
                Donec lacinia dignissim elementum. <strong>Aenean sit</strong> amet justo ornare, pharetra nisl eu, ultricies justo. Praesent imperdiet vel augue in posuere. <a href="javascript:;">Pellentesque</a> a consequat risus. Vestibulum cursus nisl aliquet leo
                viverra, ac placerat felis tempor. Sed in felis sed odio fermentum venenatis vitae ac nulla. Nam quis mollis leo. Etiam in lacus ligula.
              </p>

              <p>
                <a href="javascript:;">Vestibulum</a> enim nunc, rhoncus vitae velit sed, <strong>tempus vulputate</strong> libero. Fusce at sapien elit. Donec maximus et lectus ac convallis. Mauris maximus pretium metus in tempus. Aliquam erat volutpat. Integer et
                ante eget sapien pulvinar vulputate. Nullam vel enim sed odio fringilla congue. Aliquam pellentesque feugiat purus sed laoreet.
              </p>
            </textarea>
            <!-- /Message -->
            <hr>
            <a href="<?php echo base_url('Msg/msgSend');?>" onclick="return false;" class="btn text-darken-2"><i class="mdi-content-send left"></i> 发送</a> &nbsp; 
            <a href="<?php echo base_url('Msg/msgSave');?>" onclick="return false;" class="btn green text-darken-2"><i class="mdi-content-save left"></i> 保存</a> &nbsp; 
            <a href="javascript:window.history.back();" class="btn white grey-text text-darken-2"><i class="mdi-content-undo left"></i> 取消返回</a>
          </form>
        </div>
      </div>
    </div>

  </section>
  <!-- /Main Content -->

  <!-- CKEditor -->
  <script src="<?php echo STATIC_FILE_DIR;?>assets/ckeditor/ckeditor.js" type="text/javascript"></script>
  <script>
    CKEDITOR.replace( 'ckeditor-msg' );
  </script>
  <!-- /CKEditor -->