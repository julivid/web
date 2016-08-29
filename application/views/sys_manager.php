

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
                  <a href='javascript:;'>个人资料</a>
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
      <table class="profile-info">
        <tbody>
          <tr>
            <td class="photo">
              <img src="<?php echo STATIC_FILE_DIR;?>img/user.jpg" alt="Jogh Doe">
            </td>
            <td>
              <!-- Name -->
              <h3>Administrator</h3>
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

    <div class="row">

      <div class="col s12 l6">

        <!-- About -->
        <div class="card">
          <div class="title">
            <h5><i class="fa fa-user"></i> 个人简介</h5>
            <!--<a class="close" href="#">
              <i class="mdi-content-clear"></i>
            </a>-->
            <a class="minimize" href="#">
              <i class="mdi-navigation-expand-less"></i>
            </a>
          </div>
          <div class="content">
            有些事情，现在不去做，以后很有可能永远也做不了。不是没时间，就是因为有时间，你才会一拖再拖，放心让它们搁在那里，任凭风吹雨打，铺上厚厚的灰尘。而你终将遗忘曾经想要做的事、想要说的话、想要抓住的人。
          </div>
        </div>
        <!-- /About -->

        <div class="row">
          <div class="col m6 s12">
            <!-- Statistics -->
            <div class="card profile-skills">
              <div class="title">
                <h5><i class="fa fa-bar-chart"></i> 统计</h5>
                <!--<a class="close" href="#">
                  <i class="mdi-content-clear"></i>
                </a>-->
                <a class="minimize" href="#">
                  <i class="mdi-navigation-expand-less"></i>
                </a>
              </div>
              <div class="content">
                <div class="row center-align" style="margin-top: 0">
                  <div class="col m6 s12">
                    <strong>87</strong>
                    <h5>关注</h5>
                  </div>
                  <div class="col m6 s12">
                    <strong>12</strong>
                    <h5>粉丝</h5>
                  </div>
                </div>
              </div>
            </div>
            <!-- /Statistics -->
          </div>

          <div class="col m6 s12">

            <!-- Skills -->
            <div class="card profile-skills">
              <div class="title">
                <h5><i class="fa fa-trophy"></i> 技能</h5>
                <!--<a class="close" href="#">
                  <i class="mdi-content-clear"></i>
                </a>-->
                <a class="minimize" href="#">
                  <i class="mdi-navigation-expand-less"></i>
                </a>
              </div>
              <div class="content">
                <a href="javascript:;" class="skill">CSS3</a>
                <a href="javascript:;" class="skill">HTML5</a>
                <a href="javascript:;" class="skill">jQuery</a>
                <a href="javascript:;" class="skill">Bootstrap</a>
                <a href="javascript:;" class="skill">PHP</a>
                <a href="javascript:;" class="skill">MySQL</a>
              </div>
            </div>
            <!-- /Skills -->
          </div>
        </div>
      </div>


      <div class="col s12 l6">

        <!-- Send Message -->
        <div class="card">
          <div class="title">
            <h5><i class="fa fa-envelope"></i> 站内消息</h5>
            <!--<a class="close" href="#">
              <i class="mdi-content-clear"></i>
            </a>-->
            <a class="minimize" href="#">
              <i class="mdi-navigation-expand-less"></i>
            </a>
          </div>
          <div class="content">
            <form >
              <div class="input-field">
                <textarea id="textarea1" class="materialize-textarea" name="message"></textarea>
                <label for="textarea1">消息内容</label>
              </div>
              <button class="btn">发送</button>
            </form>
          </div>
        </div>
        <!-- /Send Message -->

      </div>

    </div>

  </section>
  <!-- /Main Content -->
