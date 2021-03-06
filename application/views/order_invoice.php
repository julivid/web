

  <!-- Main Content -->
  <section class="content-wrap ecommerce-invoice">

    <div class="card-panel">

      <!-- Logo -->
      <div class="row invoice-top">
        <div class="col s12 m6">
          <img src="<?php echo STATIC_FILE_DIR;?>img/logo.png" alt="Logo">
          <br>发票title
        </div>
        <div class="col s12 m6">
          <h3>发票</h3>
        </div>
      </div>
      <!-- /Logo -->
      <br>

      <div class="row">
        <!-- Invoice From -->
        <div class="col s12 l4">
          Invoice from:
          <h4>CON Incorporation</h4>
          <address>
          3072 Velvet Beacon Private, Burnt Woods,
          <br>Montana, 59606-9044, US,
          <br><i class="mdi-communication-phone"></i> (865) 743-1298
        </address>
        </div>
        <!-- /Invoice From -->

        <!-- Invoice To -->
        <div class="col s12 l4">
          Invoice to:
          <h4>Patsy Griffin</h4>
          <address>
          6008 Cotton Nook, Arminto,
          <br>Montana, 59114-7319, US,
          <br><i class="mdi-communication-phone"></i> (406) 500-7506
        </address>
        </div>
        <!-- /Invoice To -->

        <!-- Invoice Number and Date -->
        <div class="col s12 l4">
          <div class="invoice-num">
            <div class="num">Number: <span class="right"><strong>0010020443</strong></span>
            </div>
            </h4>
            <div class="date">Date: <span class="right">17 May 2014</span>
            </div>
            </h4>
          </div>
        </div>
        <!-- /Invoice Number and Date -->
      </div>
      <br>

      <!-- Table with products -->
      <div class="row">
        <div class="col s12">

          <div class="table-responsive">
            <table class="table table-responsive invoice-table">
              <thead>
                <tr>
                  <th>Thumbnail</th>
                  <th>Description</th>
                  <th class="center-align">Quantity</th>
                  <th class="center-align">Price</th>
                  <th class="right-align">Total</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <img src="<?php echo STATIC_FILE_DIR;?>img/ecommerce-apple-iphone-70x70.jpg" alt="Apple iPhone 6">
                  </td>
                  <td>
                    <strong>Apple iPhone 6</strong>
                    <div class="grey-text">2x1400 MHz, 64 Gb, 1024 Mb, 4.7", IPS, 1334x750, Cam 8 MP, 3G, 4G, BT, Wi-Fi, GPS, 1810 mAh</div>
                  </td>
                  <td class="center-align">2</td>
                  <td class="center-align">¥699.00</td>
                  <td class="right-align">¥1,398.00</td>
                </tr>
                <tr>
                  <td>
                    <img src="<?php echo STATIC_FILE_DIR;?>img/ecommerce-apple-macbook-70x70.jpg" alt="Apple Macbook Air Mid 14">
                  </td>
                  <td>
                    <strong>Apple Macbook Air Mid 14</strong>
                    <div class="grey-text">WXGA+, 1440x900, TN+film, Intel Core i5 4260U, 2x1400 MHz, RAM 4 Gb, SSD 512 Gb, Intel HD 5000, Wi-Fi, BT, Mac OS X</div>
                  </td>
                  <td class="center-align">1</td>
                  <td class="center-align">¥1,299.00</td>
                  <td class="right-align">¥1,299.00</td>
                </tr>
                <tr>
                  <td>
                    <img src="<?php echo STATIC_FILE_DIR;?>img/ecommerce-apple-watch-70x70.jpg" alt="Apple Watch">
                  </td>
                  <td>
                    <strong>Apple Watch</strong>
                    <div class="grey-text">No Description</div>
                  </td>
                  <td class="center-align">5</td>
                  <td class="center-align">¥449.00</td>
                  <td class="right-align">¥2,245.00</td>
                </tr>

                <tr>
                  <td colspan="2" rowspan="4">
                    <h4>Invoice notes</h4>
                    <p class="grey-text">Nam aliquet lorem dolor, et laoreet elit scelerisque ut. Etiam suscipit nibh vel turpis auctor porta. Phasellus laoreet fermentum velit eu tincidunt. Sed urna mauris, semper vel efficitur et, viverra non justo. Suspendisse porta turpis
                      felis, id porttitor est commodo vel. Pellentesque vestibulum a turpis vitae porta. Suspendisse neque libero, feugiat ac varius et, dictum eu nunc.</p>
                    <p><em>Excepteur sint occaecat est laborum.</em>
                    </p>
                  </td>
                  <td class="right-align"><strong>Subtotal</strong>
                  </td>
                  <td class="right-align" colspan="2">¥4,942.00</td>
                </tr>
                <tr>
                  <td class="right-align no-border"><strong>Shipping</strong>
                  </td>
                  <td class="right-align no-border" colspan="2">¥10.00</td>
                </tr>
                <tr>
                  <td class="right-align no-border"><strong>VAT</strong>
                  </td>
                  <td class="right-align no-border" colspan="2">¥0.00</td>
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
      <!-- /Table with products -->

    </div>

    <br>
    <div class="right-align invoice-print">
      <span class="btn light-green" onclick="javascript:window.history.back();">返回</span>
      <span class="btn" onclick="javascript:window.print();">打印发票</span>
    </div>

  </section>
  <!-- /Main Content -->
