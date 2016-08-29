<!-- Tags Input -->
<link rel="stylesheet" type="text/css" href="<?php echo STATIC_FILE_DIR.'css/jquery.tagsinput.css';?>" />
<!-- Main -->
<link rel="stylesheet" type="text/css" href="<?php echo STATIC_FILE_DIR.'css/admin.min.css';?>" /> 

  <!-- Main Content -->
  <section class="content-wrap ecommerce-product-single">

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
                        <a href='javascript:;'>产品详情</a>
                    </li>
                </ul>
            </div>
            <div class="col s12 m3 l2 right-align">
                <!-- <a href="javascript:;" class="btn grey lighten-3 grey-text z-depth-0 chat-toggle"><i class="fa fa-comments"></i></a> -->
            </div>
        </div>

    </div>
    <!-- /Breadcrumb -->


    <form action="" method="post" >
      <!-- Save and Cancel buttons -->
      <p class="right-align">
        <button class="btn" type="submit">保存</button>
        <a class="btn" href="<?php echo base_url('Product/lists');?>">返回</a>
      </p>
      <!-- /Save and Cancel buttons -->

      <!-- General -->
      <div class="card">
        <div class="title">
          <h5>产品详情</h5>
          <a class="minimize" href="#">
            <i class="mdi-navigation-expand-less"></i>
          </a>
        </div>
        <div class="content">
          <!-- Product Name -->
          <div class="row no-margin-top">
            <div class="col s12 l2">
              <label for="ecommerce-product-name" class="setting-title">
                产品名称
              </label>
            </div>
            <div class="col s12 l10">
              <div class="input-field no-margin-top">
                <input id="ecommerce-product-name" type="text" placeholder="产品名称" value="Apple iPhone 6" name="product-name">
              </div>
            </div>
          </div>
          <!-- /Product Name -->

          <!-- Product SKU, Price, Stock -->
          <div class="row no-margin-top">
            <div class="col s12 l2">
            </div>
            <div class="col s12 l3">
              <div class="input-field">
                <input id="ecommerce-product-sku" type="text" value="00782" name="product-sku">
                <label for="ecommerce-product-sku">品类编号</label>
              </div>
            </div>
            <div class="col s12 l3">
              <div class="input-field">
                <input id="ecommerce-product-price" type="text" value="699" name="product-price">
                <label for="ecommerce-product-price">单价（人民币/元）</label>
              </div>
            </div>
            <div class="col s12 l3">
              <div class="input-field">
                <input id="ecommerce-product-stock" type="text" value="765" name="product-stock">
                <label for="ecommerce-product-stock">库存</label>
              </div>
            </div>
          </div>
          <!-- /Product SKU, Price, Stock -->

          <!-- Product Tags -->
          <div class="row no-margin-top">
            <div class="col s12 l2">
              <label class="setting-title">
                标签（输入后回车）
              </label>
            </div>
            <div class="col s12 l10">
              <div class="input-field no-margin-top">
                <input class="input-tag" type="text" name="product-tags" id="product-tags" value="Apple,苹果"/>
              </div>

            </div>
          </div>

          <!-- Product Photos -->
          <div class="row product-photos">
            <div class="col s12 l2">
              <label for="ecommerce-product-photos" class="setting-title">
                产品相册
              </label>
            </div>
            <div class="col s12 l10">
              <div class="file-field input-field">
                <div class="btn">
                  <span>选择图片</span>
                  <input id="ecommerce-product-photos" type="file" name="product-photos" />
                </div>
                <div class="file-path-wrapper">
                  <input class="file-path" type="text" />
                </div>
              </div>
              <div class="photos">
                <div class="main-photo">
                  <img class="materialboxed" width="150" src="<?php echo STATIC_FILE_DIR;?>img/ecommerce-apple-iphone-1.jpg">
                </div>
                <div class="small-photo">
                  <img class="materialboxed" width="50" src="<?php echo STATIC_FILE_DIR;?>img/ecommerce-apple-iphone-2.jpg">
                  <img class="materialboxed" width="50" src="<?php echo STATIC_FILE_DIR;?>img/ecommerce-apple-iphone-3.jpg">
                  <img class="materialboxed" width="50" src="<?php echo STATIC_FILE_DIR;?>img/ecommerce-apple-iphone-4.jpg">
                  <img class="materialboxed" width="50" src="<?php echo STATIC_FILE_DIR;?>img/ecommerce-apple-iphone-5.jpg">
                  <img class="materialboxed" width="50" src="<?php echo STATIC_FILE_DIR;?>img/ecommerce-apple-iphone-6.jpg">
                  <img class="materialboxed" width="50" src="<?php echo STATIC_FILE_DIR;?>img/ecommerce-apple-iphone-7.jpg">
                </div>
              </div>
            </div>
          </div>
          <!-- /Product Photos -->

          <!-- Product Description -->
          <div class="row no-margin-top">
            <div class="col s12 l2">
              <label class="setting-title">
                产品描述
              </label>
            </div>
            <div class="col s12 l10">

              <textarea id="ckeditor1" name="product-description">
                <u>Small Description</u>
                <p><i>The Good</i>
                  <br>The iPhone 6 delivers a spacious, crisp 4.7-inch screen, improved wireless speeds, better camera autofocus, and bumped-up storage capacities to 128GB at the top end. iOS remains a top-notch mobile operating system with an excellent app
                  selection, and Apple Pay is a smooth, secure payment system.
                </p>
                <p><i>The Bad</i>
                  <br>Battery life isn't much better than last year's iPhone 5S. An even larger screen could have been squeezed into the same housing.
                </p>
                <p><i>The Bottom Line</i>
                  <br>The iPhone 6 is an exceptional phone in nearly every way except its average battery life: it's thin and fast with a spacious screen and the smoothest payment system we've seen. It's the best overall phone of 2014.
                </p>

                <u>Specifications</u>
                <ul>
                  <li><strong>Network</strong>: GSM / CDMA / HSPA / EVDO / LTE</li>
                  <li><strong>Dimensions</strong>: 138.1 x 67 x 6.9 mm (5.44 x 2.64 x 0.27 in)</li>
                  <li><strong>Weight</strong>: 129 g (4.55 oz)</li>
                  <li><strong>Display</strong>: 4.7 inches LED-backlit IPS LCD, capacitive touchscreen, 750 x 1334 pixels (~326 ppi pixel density)</li>
                  <li><strong>OS</strong>: iOS 8, upgradable to iOS 8.2</li>
                  <li><strong>Chipset</strong>: Apple A8</li>
                  <li><strong>CPU</strong>: Dual-core 1.4 GHz Cyclone (ARM v8-based)</li>
                  <li><strong>GPU</strong>: PowerVR GX6450 (quad-core graphics)</li>
                  <li><strong>RAM</strong>: 1 GB</li>
                  <li><strong>ROM</strong>: 16/64/128 GB</li>
                  <li><strong>Camera</strong>: 8 MP, 3264 x 2448 pixels, phase detection autofocus, dual-LED (dual tone) flash</li>
                  <li><strong>Wi-Fi</strong>: 802.11 a/b/g/n/ac, dual-band, hotspot</li>
                  <li><strong>Bluetooth</strong>: v4.0, A2DP, LE</li>
                  <li><strong>GPS</strong>: with A-GPS, GLONASS</li>
                  <li><strong>Battery</strong>: Non-removable Li-Po 1810 mAh battery (6.9 Wh)</li>
                </ul>
              </textarea>

            </div>
          </div>
          <!-- /Product Description -->
        </div>
      </div>
      <!-- /General -->

      <!-- Meta -->
      <div class="card">
        <div class="title">
          <h5>SEO优化</h5>
          <a class="minimize" href="#">
            <i class="mdi-navigation-expand-less"></i>
          </a>
        </div>
        <div class="content">

          <!-- Keywords -->
          <div class="row no-margin-top">
            <div class="col s12 l2">
              <label for="ecommerce-product-keywords" class="setting-title">
                关键词
              </label>
            </div>
            <div class="col s12 l10">
              <div class="input-field no-margin-top">
                <input id="ecommerce-product-keywords" type="text" placeholder="产品关键词" value="Apple, iPhone, Device, Apple iPhone 6" name="product-meta-keywords">
              </div>
            </div>
          </div>
          <!-- /Keywords -->

          <!-- Description -->
          <div class="row no-margin-top">
            <div class="col s12 l2">
              <label for="ecommerce-product-keywords" class="setting-title">
                关键词描述
              </label>
            </div>
            <div class="col s12 l10">
              <div class="input-field no-margin-top">
                <textarea name="product-keywords" id="ecommerce-product-keywords" placeholder="关键词描述" class="materialize-textarea"></textarea>
              </div>
            </div>
          </div>
          <!-- /Description -->

        </div>
      </div>
      <!-- /Meta -->

      <!-- Save and Cancel buttons -->
      <p class="right-align">
        <button class="btn" type="submit">保存</button>
        <a class="btn" href="<?php echo base_url('Product/lists');?>">返回</a>
      </p>
      <!-- /Save and Cancel buttons -->
    </form>

  </section>
  <!-- /Main Content -->


  <!-- CKEditor -->
  <script src="<?php echo STATIC_FILE_DIR;?>assets/ckeditor/ckeditor.js" type="text/javascript"></script>

  <!-- Init CKEditor -->
  <script src="<?php echo STATIC_FILE_DIR;?>assets/ckeditor/ckeditor.js"></script>
  <script>
    CKEDITOR.replace( 'ckeditor1' );
  </script>
  <!-- /Init CKEditor -->
  <!-- Tags Input -->
  <script type="text/javascript" src="<?php echo STATIC_FILE_DIR.'js/jquery.tagsinput.js';?>"></script>