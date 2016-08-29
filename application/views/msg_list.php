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
                  <a href='javascript:;'>信息管理</a> <i class='fa fa-angle-right'></i>
              </li>
              <li>
                  <a href='javascript:;'>收件箱</a>
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
      <form>
        <div class="input-field mail-search">
          <i class="mdi-action-search prefix"></i>
          <input id="mail_search" type="text" name="mail_search">
          <label for="mail_search">查找</label>
          <!--a class="btn">Search</a-->
        </div>
      </form>
    </div>

    <div class="row">
      <div class="col s12 ">
        <div class="card-panel">
          <div class="table-responsive">
            <table class="table table-bordered">
              <tbody>
                <tr class="read">
                  <th class="mail-check">
                    <input type="checkbox" id="checkbox1" />
                    <label for="checkbox1"></label>
                  </th>
                  <td class="mail-contact">
                    <a href="<?php echo base_url('Msg/msgDetail?id=1');?>">Isobel Murphy</a>
                  </td>
                  <td class="mail-subject">
                    <a href="<?php echo base_url('Msg/msgDetail?id=1');?>">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</a>
                  </td>
                  <td class="mail-date">3:12 PM</td>
                </tr>

                <tr class="unread">
                  <th class="mail-check">
                    <input type="checkbox" id="checkbox2" />
                    <label for="checkbox2"></label>
                  </th>
                  <td class="mail-contact">
                    <a href="<?php echo base_url('Msg/msgDetail?id=1');?>">Dianne Chambers</a>
                  </td>
                  <td class="mail-subject">
                    <a href="<?php echo base_url('Msg/msgDetail?id=1');?>">Ut feugiat tempus felis, sit amet mattis dolor accumsan quis. Aenean pharetra tempus justo, vitae euismod ipsum congue a.</a>
                  </td>
                  <td class="mail-date">9:02 AM</td>
                </tr>

                <tr class="unread">
                  <th class="mail-check">
                    <input type="checkbox" id="checkbox3" />
                    <label for="checkbox3"></label>
                  </th>
                  <td class="mail-contact">
                    <a href="<?php echo base_url('Msg/msgDetail?id=1');?>">Joanne Stephens</a>
                  </td>
                  <td class="mail-subject">
                    <a href="<?php echo base_url('Msg/msgDetail?id=1');?>">Proin suscipit lobortis porta. Interdum et malesuada fames ac ante ipsum primis in faucibus.</a>
                  </td>
                  <td class="mail-date">Dec 19</td>
                </tr>

                <tr class="read">
                  <th class="mail-check">
                    <input type="checkbox" id="checkbox4" checked />
                    <label for="checkbox4"></label>
                  </th>
                  <td class="mail-contact">
                    <a href="<?php echo base_url('Msg/msgDetail?id=1');?>">Ethan Baker</a>
                  </td>
                  <td class="mail-subject">
                    <a href="<?php echo base_url('Msg/msgDetail?id=1');?>">Pellentesque vitae vulputate dolor, vitae aliquet elit. Sed est felis, pretium ac lacus vitae, vestibulum lacinia ante.</a>
                  </td>
                  <td class="mail-date">Feb 3</td>
                </tr>

                <tr class="read">
                  <th class="mail-check">
                    <input type="checkbox" id="checkbox5" checked />
                    <label for="checkbox5"></label>
                  </th>
                  <td class="mail-contact">
                    <a href="<?php echo base_url('Msg/msgDetail?id=1');?>">Gilbert Hughes</a>
                  </td>
                  <td class="mail-subject">
                    <a href="<?php echo base_url('Msg/msgDetail?id=1');?>">Vivamus scelerisque egestas nisi nec posuere.</a>
                  </td>
                  <td class="mail-date">January 27</td>
                </tr>

                <tr class="read">
                  <th class="mail-check">
                    <input type="checkbox" id="checkbox6" />
                    <label for="checkbox6"></label>
                  </th>
                  <td class="mail-contact">
                    <a href="<?php echo base_url('Msg/msgDetail?id=1');?>">Liam Hudson</a>
                  </td>
                  <td class="mail-subject">
                    <a href="<?php echo base_url('Msg/msgDetail?id=1');?>">Donec quis semper ligula. Etiam vel ex mollis tellus posuere fringilla et id augue.</a>
                  </td>
                  <td class="mail-date">5:42 PM</td>
                </tr>

                <tr class="read">
                  <th class="mail-check">
                    <input type="checkbox" id="checkbox7" />
                    <label for="checkbox7"></label>
                  </th>
                  <td class="mail-contact">
                    <a href="<?php echo base_url('Msg/msgDetail?id=1');?>">Harold Mendoza</a>
                  </td>
                  <td class="mail-subject">
                    <a href="<?php echo base_url('Msg/msgDetail?id=1');?>">Donec mauris lorem, rhoncus sed mattis et, vestibulum vitae tellus.</a>
                  </td>
                  <td class="mail-date">Mar 17</td>
                </tr>

              </tbody>
            </table>
          </div>

          <div class="center-align">
            <a href="javascript:;" class="btn-flat waves-effect grey-text text-darken-1">加载更多</a>
          </div>

          <a class="mail-compose-btn btn-floating btn-extra waves-effect waves-light red tooltipped" href="<?php echo base_url('Msg/msgNew');?>" data-tooltip="写新信息" data-position="left">
            <i class="mdi-content-add"></i>
          </a>
        </div>
      </div>
    </div>

  </section>
  <!-- /Main Content -->
