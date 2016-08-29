<!-- Select2 -->
<link rel="stylesheet" type="text/css" href="<?php echo STATIC_FILE_DIR.'css/select2.min.css';?>" />
<!-- Main -->
<link rel="stylesheet" type="text/css" href="<?php echo STATIC_FILE_DIR.'css/admin.min.css';?>" /> 
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
                  <a href='javascript:;'>写新信息</a>
              </li>
          </ul>
        </div>
        <div class="col s12 m3 l2 right-align">
          <!-- <a href="javascript:;" class="btn grey lighten-3 grey-text z-depth-0 chat-toggle"><i class="fa fa-comments"></i></a> -->
        </div>
      </div>

    </div>
    <!-- /Breadcrumb -->
    <div class="card-panel">
      <div class="row">
        <form >
          <div class="col s12 ">
            <!-- To -->
              <!--<input id="input_to" type="email" class="validate" value="" name="to">-->
              <label for="input_to"> 收件人</label>
              <select id="input_to" class="select2 validate" multiple="multiple">
                <optgroup label="群组1">
                  <option value="AK">Alaska(Alaska@mail.com)</option>
                  <option value="HI">Hawaii(Hawaii@mail.com)</option>
                </optgroup>
                <optgroup label="群组2">
                  <option value="CA">California(California@mail.com)</option>
                  <option value="NV">Nevada(Nevada@mail.com)</option>
                  <option value="OR">Oregon(Oregon@mail.com)</option>
                  <option value="WA">Washington(Washington@mail.com)</option>
                </optgroup>
                <optgroup label="群组3">
                  <option value="AZ">Arizona(Arizona@mail.com)</option>
                  <option value="CO">Colorado(Colorado@mail.com)</option>
                  <option value="ID">Idaho(Idaho@mail.com)</option>
                  <option value="MT">Montana(Montana@mail.com)</option>
                </optgroup>
                <optgroup label="群组4">
                  <option value="AL">Alabama(Alabama@mail.com)</option>
                  <option value="AR">Arkansas(Arkansas@mail.com)</option>
                  <option value="IL">Illinois(Illinois@mail.com)</option>
                </optgroup>
                <optgroup label="群组5">
                  <option value="CT">Connecticut(Connecticut@mail.com)</option>
                  <option value="DE">Delaware(Delaware@mail.com)</option>
                  <option value="FL">Florida(Florida@mail.com)</option>
                </optgroup>
              </select>
            </div>
            <!-- /To -->
            <div class="col s12 ">
              <!-- Subject -->
              <div class="input-field">
                <input id="input_subject" type="text" class="validate" name="subject">
                <label for="input_subject">主题</label>
              </div>
            </div>
            <!-- /Subject -->
            <div class="col s12 ">
              <!-- Message -->
              <textarea name="message" id="ckeditor-msg"></textarea>
              <!-- /Message -->
            </div>
            <!-- /Subject -->

            <div class="col s12 ">
              <a href="<?php echo base_url('Msg/msgSend');?>" onclick="return false;" class="btn text-darken-2"><i class="mdi-content-send left"></i> 发送</a> &nbsp; 
              <a href="<?php echo base_url('Msg/msgSave');?>" onclick="return false;" class="btn green text-darken-2"><i class="mdi-content-save left"></i> 保存</a> &nbsp; 
              <a href="javascript:window.history.back();" class="btn white grey-text text-darken-2"><i class="mdi-content-undo left"></i> 取消返回</a>
            </div>
          
          </div>
        </form>
      </div>
    </div>

  </section>
  <!-- /Main Content -->

  <!-- Select2 -->
  <script type="text/javascript" src="<?php echo STATIC_FILE_DIR.'js/select2.full.min.js';?>"></script>
  <!-- CKEditor -->
  <script src="<?php echo STATIC_FILE_DIR;?>assets/ckeditor/ckeditor.js" type="text/javascript"></script>
  <script>
    CKEDITOR.replace( 'ckeditor-msg' );
  </script>
  <!-- /CKEditor -->