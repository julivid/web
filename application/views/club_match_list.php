
  <a class="mail-compose-btn btn-floating btn-extra waves-effect waves-light red tooltipped" href="<?php echo base_url('Match/matchAdd');?>" data-tooltip="添加赛事" data-position="left">
    <i class="mdi-content-add"></i>
  </a>

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
                  <a href='javascript:;'>CPG Live</a> <i class='fa fa-angle-right'></i>
              </li>
              <li>
                  <a href='javascript:;'>赛事列表</a>
              </li>
          </ul>
        </div>
        <div class="col s12 m3 l2 right-align">
          <!--<a href="javascript:;" class="btn grey lighten-3 grey-text z-depth-0 chat-toggle"><i class="fa fa-comments"></i></a>-->
        </div>
      </div>

    </div>
    <!-- /Breadcrumb -->

    <div class="card-panel">
      <form>
        <div class="input-field mail-search">
          <i class="mdi-action-search prefix"></i>
          <input id="match_search" type="text" name="match_search" placeholder="请输入查找关键字">
          <!--<label for="match_search">查找</label>-->
          <a class="btn">开始查找</a>
        </div>
      </form>
    </div>

    <div class="row">
      <div class="col s12 ">
        <div class="card-panel">
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>#</th>
                  <th>赛事名称</th>
                  <th>比赛时间</th>
                  <th>参赛人数／人数上限</th>
                  <th>参赛券</th>
                  <th>赛事状态</th>
                  <th>操作</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th>1</th>
                  <td>主赛-第四轮（决赛桌）</td>
                  <td>2015－08－27 12:00（星期四） </td>
                  <td>276／300</td>
                  <td>6</td>
                  <td>进行中</td>
                  <td><a class="btn btn-small " href="<?php echo base_url('Match/playerAdd?mid=1');?>">报名参赛</a></td>
                </tr>
                <tr>
                  <th>2</th>
                  <td>主赛-第四轮（决赛桌）</td>
                  <td>2015－08－27 12:00（星期四） </td>
                  <td>276／300</td>
                  <td>6</td>
                  <td>进行中</td>
                  <td><a class="btn btn-small " href="<?php echo base_url('Match/playerAdd?mid=1');?>">报名参赛</a></td>
                </tr><tr>
                  <th>3</th>
                  <td>主赛-第四轮（决赛桌）</td>
                  <td>2015－08－27 12:00（星期四） </td>
                  <td>276／300</td>
                  <td>6</td>
                  <td>进行中</td>
                  <td><a class="btn btn-small " href="<?php echo base_url('Match/playerAdd?mid=1');?>">报名参赛</a></td>
                </tr><tr>
                  <th>4</th>
                  <td>主赛-第四轮（决赛桌）</td>
                  <td>2015－08－27 12:00（星期四） </td>
                  <td>276／300</td>
                  <td>6</td>
                  <td>进行中</td>
                  <td><a class="btn btn-small " href="<?php echo base_url('Match/playerAdd?mid=1');?>">报名参赛</a></td>
                </tr><tr>
                  <th>5</th>
                  <td>主赛-第四轮（决赛桌）</td>
                  <td>2015－08－27 12:00（星期四） </td>
                  <td>276／300</td>
                  <td>6</td>
                  <td>进行中</td>
                  <td><a class="btn btn-small " href="<?php echo base_url('Match/playerAdd?mid=1');?>">报名参赛</a></td>
                </tr><tr>
                  <th>6</th>
                  <td>主赛-第四轮（决赛桌）</td>
                  <td>2015－08－27 12:00（星期四） </td>
                  <td>276／300</td>
                  <td>6</td>
                  <td>进行中</td>
                  <td><a class="btn btn-small " href="<?php echo base_url('Match/playerAdd?mid=1');?>">报名参赛</a></td>
                </tr><tr>
                  <th>7</th>
                  <td>主赛-第四轮（决赛桌）</td>
                  <td>2015－08－27 12:00（星期四） </td>
                  <td>276／300</td>
                  <td>6</td>
                  <td>进行中</td>
                  <td><a class="btn btn-small " href="<?php echo base_url('Match/playerAdd?mid=1');?>">报名参赛</a></td>
                </tr><tr>
                  <th>8</th>
                  <td>主赛-第四轮（决赛桌）</td>
                  <td>2015－08－27 12:00（星期四） </td>
                  <td>276／300</td>
                  <td>6</td>
                  <td>进行中</td>
                  <td><a class="btn btn-small " href="<?php echo base_url('Match/playerAdd?mid=1');?>">报名参赛</a></td>
                </tr>
              </tbody>
            </table>
          </div>

          <div class="center-align">
            <a href="javascript:;" class="btn-flat waves-effect grey-text text-darken-1">加载更多</a>
          </div>
        </div>
      </div>
    </div>

  </section>
  <!-- /Main Content -->
