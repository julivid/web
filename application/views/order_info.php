

  <!-- Main Content -->
  <section class="content-wrap ecommerce-order-single">

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
                        <a href='javascript:;'>订单详情</a>
                    </li>
                </ul>
            </div>
            <div class="col s12 m3 l2 right-align">
                <!-- <a href="javascript:;" class="btn grey lighten-3 grey-text z-depth-0 chat-toggle"><i class="fa fa-comments"></i></a> -->
            </div>
        </div>

    </div>
    <!-- /Breadcrumb -->


    <form action="" method="post">
      <!-- Save and Cancel buttons -->
      <p class="right-align">
        <a class="btn teal" href="<?php echo base_url('Order/orderInvoice');?>">发票</a>
        <button class="btn" type="submit">保存</button>
        <a class="btn light-green" href="<?php echo base_url('Order');?>">返回列表</a>
      </p>
      <!-- /Save and Cancel buttons -->


      <div class="row">
        <!-- General -->
        <div class="col s12">
          <div class="card-panel">
            <div class="row no-margin-top">
              <div class="col s12 l4">
                <h4>#0004322</h4>
              </div>
              <div class="col s12 l4">
                <h4>2015-06-12</h4>
              </div>
              <div class="col s12 l4">
                <select name="order-status">
                  <option value="" disabled>订单状态</option>
                  <option value="pending">待付款</option>
                  <option value="sending">待发货</option>
                  <option value="completed" selected>已完成</option>
                  <option value="canceled">已取消</option>
                </select>
              </div>
            </div>
          </div>
        </div>
        <!-- /General -->
      </div>


      <div class="row">
        <!-- Customer -->
        <div class="col s12 l6">
          <div class="card">
            <div class="title">
              <h5>客户信息</h5>
              <a class="minimize" href="#">
                <i class="mdi-navigation-expand-less"></i>
              </a>
            </div>
            <div class="content">

              <div class="row no-margin-top">
                <div class="col s12 l3">
                  <img width="100" src="<?php echo STATIC_FILE_DIR;?>img/user4.jpg" alt="Patsy Griffin" class="circle photo">
                </div>
                <div class="col s12 l9">
                  <h4>Patsy Griffin</h4>
                  6008 Cotton Nook, Arminto,
                  <br>Montana, 59114-7319, US,
                  <br><i class="mdi-communication-phone"></i> (406) 500-7506
                </div>
              </div>

            </div>
          </div>
        </div>
        <!-- /Customer -->

        <!-- Payment -->
        <div class="col s12 l6">
          <div class="card">
            <div class="title">
              <h5>支付信息</h5>
              <a class="minimize" href="#">
                <i class="mdi-navigation-expand-less"></i>
              </a>
            </div>
            <div class="content">

              <!-- Status -->
              <div class="row no-margin-top">
                <div class="col s3">
                  <label class="setting-title">
                    支付状态
                  </label>
                </div>
                <div class="col s9">
                  <label class="green-text">已付款</label>
                </div>
              </div>
              <!-- /Status -->

              <!-- Payment Type -->
              <div class="row no-margin-top">
                <div class="col s3">
                  <label class="setting-title">
                    支付方式
                  </label>
                </div>
                <div class="col s9">
                  <label>
                    <img src="<?php echo STATIC_FILE_DIR;?>img/paypal.png" alt="PayPal">
                  </label>
                </div>
              </div>
              <!-- /Payment Type -->

            </div>
          </div>
        </div>
        <!-- /Payment -->
      </div>


      <!-- Products -->
      <div class="row">
        <div class="col s12">
          <div class="card">
            <div class="title">
              <h5>Products</h5>
              <a class="minimize" href="#">
                <i class="mdi-navigation-expand-less"></i>
              </a>
            </div>
            <div class="content">

              <div class="table-responsive">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>品类编号</th>
                      <th>图片</th>
                      <th>产品简介</th>
                      <th>数量</th>
                      <th>单价</th>
                      <th>总价</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th>#00782</th>
                      <td>
                        <img src="<?php echo STATIC_FILE_DIR;?>img/ecommerce-apple-iphone-70x70.jpg" alt="Apple iPhone 6">
                      </td>
                      <td>
                        <a href="<?php echo base_url('Product/productInfo?id=1');?>" target="_blank">
                          <strong class="grey-text text-darken-2">Apple iPhone 6</strong>
                          <br>
                          <span class="grey-text">2x1400 MHz, 64 Gb, 1024 Mb, 4.7", IPS, 1334x750, Cam 8 MP, 3G, 4G, BT, Wi-Fi, GPS, 1810 mAh</span>
                        </a>
                      </td>
                      <td>2</td>
                      <td>¥699.00</td>
                      <td>¥1,398.00</td>
                    </tr>

                    <tr>
                      <th>#00653</th>
                      <td>
                        <img src="<?php echo STATIC_FILE_DIR;?>img/ecommerce-apple-macbook-70x70.jpg" alt="Apple Macbook Air Mid 14">
                      </td>
                      <td>
                        <a href="<?php echo base_url('Product/productInfo?id=1');?>" target="_blank">
                          <strong class="grey-text text-darken-2">Apple Macbook Air Mid 14</strong>
                          <br>
                          <span class="grey-text">WXGA+, 1440x900, TN+film, Intel Core i5 4260U, 2x1400 MHz, RAM 4 Gb, SSD 512 Gb, Intel HD 5000, Wi-Fi, BT, Mac OS X</span>
                        </a>
                      </td>
                      <td>1</td>
                      <td>¥1,299.00</td>
                      <td>¥1,299.00</td>
                    </tr>

                    <tr>
                      <th>#00619</th>
                      <td>
                        <img src="<?php echo STATIC_FILE_DIR;?>img/ecommerce-apple-watch-70x70.jpg" alt="Apple Watch">
                      </td>
                      <td>
                        <a href="<?php echo base_url('Product/productInfo?id=1');?>" target="_blank">
                          <strong class="grey-text text-darken-2">Apple Watch</strong>
                          <br>
                          <span class="grey-text">No Description</span>
                        </a>
                      </td>
                      <td>5</td>
                      <td>¥449.00</td>
                      <td>¥2,245.00</td>
                    </tr>

                    <tr>
                      <td colspan="3" rowspan="4">
                      </td>
                      <td class="right-align"><strong>Subtotal</strong>
                      </td>
                      <td class="right-align" colspan="2">¥4,942.00</td>
                    </tr>

                    <tr>
                      <td class="right-align"><strong>Shipping</strong>
                      </td>
                      <td class="right-align" colspan="2">¥10.00</td>
                    </tr>

                    <tr>
                      <td class="right-align"><strong>VAT</strong>
                      </td>
                      <td class="right-align" colspan="2">¥0.00</td>
                    </tr>

                    <tr>
                      <td class="right-align"><strong>Total</strong>
                      </td>
                      <td class="right-align" colspan="2">
                        <strong class="h2">¥4,952.00</strong>
                      </td>
                    </tr>

                  </tbody>
                </table>
              </div>

            </div>
          </div>
        </div>
      </div>
      <!-- /Products -->


      <!-- Save and Cancel buttons -->
      <p class="right-align">
        <a class="btn teal" href="<?php echo base_url('Order/orderInvoice');?>">发票</a>
        <button class="btn" type="submit">保存</button>
        <a class="btn light-green" href="<?php echo base_url('Order');?>">返回列表</a>
      </p>
      <!-- /Save and Cancel buttons -->
    </form>

  </section>
  <!-- /Main Content -->
