<!-- Tags Input -->
<link rel="stylesheet" type="text/css" href="<?php echo STATIC_FILE_DIR.'css/jquery.tagsinput.css';?>" />
<!-- Main -->
<link rel="stylesheet" type="text/css" href="<?php echo STATIC_FILE_DIR.'css/admin.min.css';?>" /> 


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
                        <a href='javascript:;'>系统配置</a> <i class='fa fa-angle-right'></i>
                    </li>
                    <li>
                        <a href='javascript:;'>基础配置</a>
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
      系统基础信息配置，用于SEO优化。后台系统建议使用浏览器：Firefox，Chrome，Safari，IE10及以上版本...
    </div>
    <br>

    <form>

      <div class="card-panel">
        <h4>网站基本信息</h4>

        <div class="row">
          <div class="col l6 s12">
            <div class="input-field">
              <input id="web_domain" type="text" class="validate" value="www.zhuliwei.cn">
              <label for="web_domain">网站域名</label>
            </div>
          </div>
          <div class="col l6 s12">
            <div class="input-field">
              <input id="web_name" type="text" class="validate" value="">
              <label for="web_name">网站名称</label>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col l12 s12">
            <div class="input-field">
              <input class="input-tag" type="text" name="web_key" id="web_key" value="PHP,JavaScript,CSS" />
              <label for="web_key">网站关键字（输入后回车）</label>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col l12 s12">
            <div class="input-field">
              <textarea id="web_desc" class="materialize-textarea"></textarea>
              <label for="web_desc">网站描述</label>
            </div>
          </div>
        </div>


      </div>

      <div class="card-panel">
        <h4>公司(组织)信息</h4>

        <div class="row">
          <div class="col l12 s12">
            <div class="input-field">
              <i class="mdi-social-location-city prefix"></i>
              <input id="Co_name" type="text" class="validate" value="">
              <label for="Co_name">公司(组织)名称</label>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col l12 s12">
            <div class="input-field">
              <i class="mdi-action-home prefix"></i>
              <input id="Co_addr" type="text" class="validate" value="">
              <label for="Co_addr">公司(组织)地址</label>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col l6 s12">
            <div class="input-field">
              <i class="mdi-content-mail prefix"></i>
              <input id="Co_email" type="email" class="validate">
              <label for="Co_email">Email</label>
            </div>
          </div>
          <div class="col l6 s12">
            <div class="input-field">
              <i class="mdi-communication-phone prefix"></i>
              <input id="Co_tel" type="text" class="validate" value="">
              <label for="Co_tel">联系电话(手机)</label>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col l6 s12">
            <div class="input-field">
              <i class="mdi-communication-ring-volume prefix"></i>
              <input id="Co_phone" type="text" class="validate">
              <label for="Co_phone">座机</label>
            </div>
          </div>
          <div class="col l6 s12">
            <div class="input-field">
              <i class="mdi-maps-local-print-shop prefix"></i>
              <input id="Co_fax" type="text" class="validate" value="">
              <label for="Co_fax">业务传真</label>
            </div>
          </div>
        </div>



      </div>


      <div class="card-panel">
        <h4>下拉列表</h4>

        <label>Materialize风格下拉列表</label>
        <div class="row">
          <div class="col l6 s12">
            <select>
              <option value="" disabled selected>请选择...</option>
              <option value="1">选项 1</option>
              <option value="2">选项 2</option>
              <option value="3">选项 3</option>
            </select>
          </div>
          <div class="col l6 s12">
            <select disabled>
              <option value="" selected>无法选择</option>
              <option value="1">Option 1</option>
              <option value="2">Option 2</option>
              <option value="3">Option 3</option>
            </select>
          </div>
        </div>
          
      </div>


      <div class="card-panel">

        <h4>单选按钮</h4>
        <div class="row">
          <div class="col l6 s12">
            <p>
              <input name="radios1" type="radio" id="radios1-1" checked />
              <label for="radios1-1">One</label>
            </p>
            <p>
              <input name="radios1" type="radio" id="radios1-2" />
              <label for="radios1-2">Two</label>
            </p>
            <p>
              <input name="radios1" type="radio" id="radios1-3" disabled />
              <label for="radios1-3">Three</label>
            </p>
          </div>
          <div class="col l6 s12">
            <p>
              <input class="with-gap" name="radios2" type="radio" id="radios2-1" checked />
              <label for="radios2-1">One</label>
            </p>
            <p>
              <input class="with-gap" name="radios2" type="radio" id="radios2-2" />
              <label for="radios2-2">Two</label>
            </p>
            <p>
              <input class="with-gap" name="radios2" type="radio" id="radios2-3" disabled />
              <label for="radios2-3">Three</label>
            </p>
          </div>
        </div>

      </div>

      <div class="card-panel">

        <h4>复选框 & Switches</h4>
        <div class="row">
          <div class="col l6 s12">
            <p>
              <input type="checkbox" id="checkbox1" />
              <label for="checkbox1">One</label>
            </p>
            <p>
              <input type="checkbox" id="checkbox2" checked="checked" />
              <label for="checkbox2">Two</label>
            </p>
            <p>
              <input type="checkbox" class="filled-in" id="checkbox3" checked="checked" />
              <label for="checkbox3">Filled In</label>
            </p>
            <p>
              <input type="checkbox" id="checkbox4" checked="checked" disabled="disabled" />
              <label for="checkbox4">Three</label>
            </p>
            <p>
              <input type="checkbox" id="checkbox5" disabled="disabled" disabled/>
              <label for="checkbox5">Four</label>
            </p>
          </div>

          <div class="col l6 s12">
            <p class="switch">
              <label>
                <input type="checkbox" />
                <span class="lever"></span>
                One
              </label>
            </p>
            <p class="switch">
              <label>
                <input type="checkbox" checked />
                <span class="lever"></span>
                Two
              </label>
            </p>
            <p class="switch">
              <label>
                <input type="checkbox" />
                <span class="lever"></span>
                Three
              </label>
            </p>
          </div>
        </div>

      </div>


      <div class="card-panel">
        <h4>评价等级</h4>
        <div class="row">
          <div class="col l12 s12">

            <div class="rating">
              <input type="radio" id="rating-star-5" name="rating-star" value="5">
              <label for="rating-star-5"><i class="ion-star"></i>
              </label>
              <input type="radio" id="rating-star-4" name="rating-star" value="4">
              <label for="rating-star-4"><i class="ion-star"></i>
              </label>
              <input type="radio" id="rating-star-3" name="rating-star" value="3" checked>
              <label for="rating-star-3"><i class="ion-star"></i>
              </label>
              <input type="radio" id="rating-star-2" name="rating-star" value="2">
              <label for="rating-star-2"><i class="ion-star"></i>
              </label>
              <input type="radio" id="rating-star-1" name="rating-star" value="1">
              <label for="rating-star-1"><i class="ion-star"></i>
              </label>
            </div>

            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            
            <div class="rating">
              <input type="radio" id="rating-5" name="rating" value="5">
              <label for="rating-5"><i class="wi wi-day-sunny"></i>
              </label>
              <input type="radio" id="rating-4" name="rating" value="4">
              <label for="rating-4"><i class="wi wi-day-sunny"></i>
              </label>
              <input type="radio" id="rating-3" name="rating" value="3">
              <label for="rating-3"><i class="wi wi-day-sunny"></i>
              </label>
              <input type="radio" id="rating-2" name="rating" value="2">
              <label for="rating-2"><i class="wi wi-day-sunny"></i>
              </label>
              <input type="radio" id="rating-1" name="rating" value="1" checked>
              <label for="rating-1"><i class="wi wi-day-sunny"></i>
              </label>
            </div>


          </div>

        </div>


      </div>


      <div class="card-panel">

        <h4>文件上传</h4>
        <div class="row">
          <div class="col l12 s12">
            <div class="file-field input-field">
              <div class="btn">
                <span>请选择文件</span>
                <input type="file">
              </div>
              <div class="file-path-wrapper">
                <input class="file-path validate" type="text">
              </div>
            </div>
          </div>

        </div>
        <!-- /File Input -->
      </div>

    </form>

  </section>
  <!-- /Main Content -->

  <!-- Tags Input -->
  <script type="text/javascript" src="<?php echo STATIC_FILE_DIR.'js/jquery.tagsinput.js';?>"></script>