
  <!-- Main Content -->
  <section class="content-wrap ecommerce-orders">

    <!-- Breadcrumb -->
    <div class="page-title">

        <div class="row">
            <div class="col s12 m9 l10">
                <ul>
                    <li>
                        <a href="<?php echo base_url();?>"><i class="fa fa-home"></i> 首页</a>  <i class="fa fa-angle-right"></i>
                    </li>

                    <li>
                        <a href='javascript:;'>电子商务</a> <i class='fa fa-angle-right'></i>
                    </li>
                    <li>
                        <a href='javascript:;'>订单列表</a>
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
        <h5>订单列表</h5>
        <!--<div class="btn-group right">
          <a href="<?php echo base_url('Order/orderInfo?id=1');?>" class="btn btn-small z-depth-0"><i class="mdi mdi-editor-mode-edit"></i></a>
          <a href="javascript:;" class="btn btn-small red lighten-1 z-depth-0"><i class="mdi mdi-action-delete"></i></a>
        </div>-->
      </div>
      <div class="content">
        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>选择</th>
                <th>日期</th>
                <th>订单ID</th>
                <th>客户</th>
                <th>总价</th>
                <th>订单状态</th>
                <th>操作</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th>
                  <input type="checkbox" id="checkbox1" />
                  <label for="checkbox1"></label>
                </th>
                <td>今天</td>
                <td>#0004325</td>
                <td>
                  <img src="<?php echo STATIC_FILE_DIR;?>img/user-30x30.jpg" alt="John Doe" class="circle photo">John Doe</td>
                <td>¥1,489.00</td>
                <td class="orange-text">待付款</td>
                <td><a href="<?php echo base_url('Order/orderInfo?id=1');?>" class="btn btn-small z-depth-0"><i class="mdi mdi-editor-mode-edit"></i></a>
                </td>
              </tr>

              <tr>
                <th>
                  <input type="checkbox" id="checkbox2" />
                  <label for="checkbox2"></label>
                </th>
                <td>昨天</td>
                <td>#0004324</td>
                <td>
                  <img src="<?php echo STATIC_FILE_DIR;?>img/user2-30x30.jpg" alt="Felecia Castro" class="circle photo">Felicia Castro</td>
                <td>¥2,100.00</td>
                <td class="blue-text">待发货</td>
                <td><a href="<?php echo base_url('Order/orderInfo?id=1');?>" class="btn btn-small z-depth-0"><i class="mdi mdi-editor-mode-edit"></i></a>
                </td>
              </tr>

              <tr>
                <th>
                  <input type="checkbox" id="checkbox3" />
                  <label for="checkbox3"></label>
                </th>
                <td>2015-06-26</td>
                <td>#0004323</td>
                <td>
                  <img src="<?php echo STATIC_FILE_DIR;?>img/user3-30x30.jpg" alt="Max Brooks" class="circle photo">Max Brooks</td>
                <td>¥499.00</td>
                <td class="blue-text">待发货</td>
                <td><a href="<?php echo base_url('Order/orderInfo?id=1');?>" class="btn btn-small z-depth-0"><i class="mdi mdi-editor-mode-edit"></i></a>
                </td>
              </tr>

              <tr>
                <th>
                  <input type="checkbox" id="checkbox4" />
                  <label for="checkbox4"></label>
                </th>
                <td>2015-05-15</td>
                <td>#0004322</td>
                <td>
                  <img src="<?php echo STATIC_FILE_DIR;?>img/user4-30x30.jpg" alt="Patsy Griffin" class="circle photo">Patsy Griffin</td>
                <td>¥4,952.00</td>
                <td class="green-text">已完成</td>
                <td><a href="<?php echo base_url('Order/orderInfo?id=1');?>" class="btn btn-small z-depth-0"><i class="mdi mdi-editor-mode-edit"></i></a>
                </td>
              </tr>

              <tr>
                <th>
                  <input type="checkbox" id="checkbox5" />
                  <label for="checkbox5"></label>
                </th>
                <td>2015-05-11</td>
                <td>#0004321</td>
                <td>
                  <img src="<?php echo STATIC_FILE_DIR;?>img/user5-30x30.jpg" alt="Chloe Morgan" class="circle photo">Chloe Morgan</td>
                <td>¥999.00</td>
                <td class="green-text">已完成</td>
                <td><a href="<?php echo base_url('Order/orderInfo?id=1');?>" class="btn btn-small z-depth-0"><i class="mdi mdi-editor-mode-edit"></i></a>
                </td>
              </tr>

              <tr>
                <th>
                  <input type="checkbox" id="checkbox6" />
                  <label for="checkbox6"></label>
                </th>
                <td>2015-05-02</td>
                <td>#0004320</td>
                <td>
                  <img src="<?php echo STATIC_FILE_DIR;?>img/user6-30x30.jpg" alt="Vernon Garrett" class="circle photo">Vernon Garrett</td>
                <td>¥48.00</td>
                <td class="green-text">已完成</td>
                <td><a href="<?php echo base_url('Order/orderInfo?id=1');?>" class="btn btn-small z-depth-0"><i class="mdi mdi-editor-mode-edit"></i></a>
                </td>
              </tr>

              <tr>
                <th>
                  <input type="checkbox" id="checkbox7" />
                  <label for="checkbox7"></label>
                </th>
                <td>2015-04-25</td>
                <td>#0004319</td>
                <td>
                  <img src="<?php echo STATIC_FILE_DIR;?>img/user7-30x30.jpg" alt="Greg Mcdonalid" class="circle photo">Greg Mcdonalid</td>
                <td>¥749.00</td>
                <td class="green-text">已完成</td>
                <td><a href="<?php echo base_url('Order/orderInfo?id=1');?>" class="btn btn-small z-depth-0"><i class="mdi mdi-editor-mode-edit"></i></a>
                </td>
              </tr>

              <tr>
                <th>
                  <input type="checkbox" id="checkbox8" />
                  <label for="checkbox8"></label>
                </th>
                <td>2015-04-02</td>
                <td>#0004318</td>
                <td>
                  <img src="<?php echo STATIC_FILE_DIR;?>img/user8-30x30.jpg" alt="Christian Jackson" class="circle photo">Christian Jackson</td>
                <td>¥1,200.00</td>
                <td class="red-text">已取消</td>
                <td><a href="<?php echo base_url('Order/orderInfo?id=1');?>" class="btn btn-small z-depth-0"><i class="mdi mdi-editor-mode-edit"></i></a>
                </td>
              </tr>

              <tr>
                <th>
                  <input type="checkbox" id="checkbox9" />
                  <label for="checkbox9"></label>
                </th>
                <td>2015-03-22</td>
                <td>#0004317</td>
                <td>
                  <img src="<?php echo STATIC_FILE_DIR;?>img/user9-30x30.jpg" alt="Willie Kelly" class="circle photo">Willie Kelly</td>
                <td>¥1,730.00</td>
                <td class="red-text">已取消</td>
                <td><a href="<?php echo base_url('Order/orderInfo?id=1');?>" class="btn btn-small z-depth-0"><i class="mdi mdi-editor-mode-edit"></i></a>
                </td>
              </tr>

              <tr>
                <th>
                  <input type="checkbox" id="checkbox10" />
                  <label for="checkbox10"></label>
                </th>
                <td>2015-03-12</td>
                <td>#0004316</td>
                <td>
                  <img src="<?php echo STATIC_FILE_DIR;?>img/user10-30x30.jpg" alt="Jenny Phillips" class="circle photo">Jenny Phillips</td>
                <td>¥4,199.00</td>
                <td class="green-text">已完成</td>
                <td><a href="<?php echo base_url('Order/orderInfo?id=1');?>" class="btn btn-small z-depth-0"><i class="mdi mdi-editor-mode-edit"></i></a>
                </td>
              </tr>

              <tr>
                <th>
                  <input type="checkbox" id="checkbox11" />
                  <label for="checkbox11"></label>
                </th>
                <td>2015-03-05</td>
                <td>#0004315</td>
                <td>
                  <img src="<?php echo STATIC_FILE_DIR;?>img/user11-30x30.jpg" alt="Darren Cunningham" class="circle photo">Darren Cunningham</td>
                <td>¥900.00</td>
                <td class="green-text">已完成</td>
                <td><a href="<?php echo base_url('Order/orderInfo?id=1');?>" class="btn btn-small z-depth-0"><i class="mdi mdi-editor-mode-edit"></i></a>
                </td>
              </tr>

              <tr>
                <th>
                  <input type="checkbox" id="checkbox12" />
                  <label for="checkbox12"></label>
                </th>
                <td>2015-03-05</td>
                <td>#0004314</td>
                <td>
                  <img src="<?php echo STATIC_FILE_DIR;?>img/user12-30x30.jpg" alt="Sandra Cole" class="circle photo">Sandra Cole</td>
                <td>¥100.00</td>
                <td class="green-text">已完成</td>
                <td><a href="<?php echo base_url('Order/orderInfo?id=1');?>" class="btn btn-small z-depth-0"><i class="mdi mdi-editor-mode-edit"></i></a>
                </td>
              </tr>

            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- /Products -->


  </section>
  <!-- /Main Content -->
