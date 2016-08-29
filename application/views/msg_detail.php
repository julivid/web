
  <!-- Main Content -->
  <section class="content-wrap mail-view">


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
                  <a href='javascript:;'>信息详情</a>
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

          <!-- Subject -->
          <h3 class="mail-subject">Phasellus ac erat a nisi pharetra volutpat id ultrices tortor.</h3>
          <!-- /Subject -->

          <div class="row">
            <!-- From -->
            <div class="col s6">
              来自: <strong>john.doe@inbox.my</strong>
            </div>
            <!-- /From -->

            <!-- Date -->
            <div class="col s6 right-align">
              <span>06:32 PM 09 OCT 2015</span>
            </div>
            <!-- /Date -->
          </div>

          <hr>

          <!-- Message -->
          <div class="mail-text">
            Hi, John!

            <p>
              Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur laoreet imperdiet rutrum. Sed vitae eleifend velit. Nunc pharetra nisl egestas imperdiet laoreet. <strong>Aliquam lobortis</strong> ante porta urna ornare, ut convallis nulla
              vehicula. Praesent a dui posuere, convallis magna ut, bibendum velit. Duis viverra nisi nulla, sed condimentum purus bibendum eu. Sed a sem quis orci venenatis eleifend. Nam interdum mi sit amet metus pretium, sed viverra justo blandit.
              Curabitur quis lacus nunc.
            </p>

            <p>
              <strong>Vivamus ligula</strong> ante, feugiat nec justo sit amet, dictum viverra ex. Integer faucibus aliquam ligula. In cursus risus vel erat viverra accumsan. In hac habitasse platea dictumst. Praesent dolor nisi, <a href="javascript:;">luctus vulputate</a> ligula
              non, posuere convallis orci. Sed scelerisque, urna id viverra mollis, metus nisl pharetra dui, ac aliquet metus velit at nibh. Donec venenatis dignissim viverra. Sed magna metus, convallis eu nulla id, iaculis finibus tortor.
            </p>

            <p>
              In egestas suscipit nibh sit amet venenatis. <a href="javascript:;">Aenean elit</a> orci, rhoncus quis quam nec, ultricies pellentesque urna. Vivamus suscipit orci a ante tristique, a gravida libero porta. Etiam aliquet massa eget est ultrices blandit.
              Quisque quis mattis dolor. Pellentesque vel laoreet tortor. Duis eu gravida urna, vitae porttitor velit. Nunc ac eleifend metus. Sed vitae tincidunt neque.
            </p>

            Best regards, John.
          </div>
          <!-- /Message -->

          <hr>

          <a href="<?php echo base_url('Msg/msgContent');?>" class="btn white grey-text text-darken-2"><i class="mdi-content-send left"></i> 下一封</a>
          <a href="<?php echo base_url('Msg/msgContent');?>" class="btn white grey-text text-darken-2"><i class="mdi-content-reply left"></i> 回复</a>
          <a href="<?php echo base_url('Msg/msgContent');?>" class="btn white grey-text text-darken-2"><i class="mdi-action-delete left"></i> 删除</a>

        </div>

      </div>
    </div>

  </section>
  <!-- /Main Content -->
