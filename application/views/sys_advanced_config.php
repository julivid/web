<!-- Select2 -->
<link rel="stylesheet" type="text/css" href="<?php echo STATIC_FILE_DIR.'css/select2.min.css';?>" />
<!-- Drop Zone -->
<link rel="stylesheet" type="text/css" href="<?php echo STATIC_FILE_DIR.'assets/dropzone/dropzone.min.css';?>" />
<!-- Tags Input -->
<link rel="stylesheet" type="text/css" href="<?php echo STATIC_FILE_DIR.'css/jquery.tagsinput.css';?>" />
<!-- Clockpicker -->
<link rel="stylesheet" type="text/css" href="<?php echo STATIC_FILE_DIR.'css/jquery-clockpicker.min.css';?>" />
<!-- Pikaday -->
<link rel="stylesheet" type="text/css" href="<?php echo STATIC_FILE_DIR.'css/pikaday.css';?>" />
<!-- Spectrum -->
<link rel="stylesheet" type="text/css" href="<?php echo STATIC_FILE_DIR.'css/spectrum.css';?>" />

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
                        <a href='javascript:;'>高级配置</a>
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
      关于系统高级配置信息....
    </div>
    <br>

    <div class="card-panel">
      <h4>Range</h4>

      <div class="row">
        <div class="col l12 s12">
          <p class="range-field">
            <input type="range" min="0" max="500" value="30" />
          </p>
        </div>
      </div>

      <div class="row">
        <div class="col l6 s12">
          <div class="input-field">
            <input id="input_text" type="text" length="10">
            <label for="input_text">限制长度10</label>
          </div>
        </div>

      </div>

      <div class="row">
        <div class="col l12 s12">
          <div class="input-field">
            <textarea id="textarea1" class="materialize-textarea" length="120"></textarea>
            <label for="textarea1">长度120</label>
          </div>
        </div>
      </div>

    </div>


    <div class="card-panel">
      <h4>Date Picker</h4>

      <div class="row">
        <div class="col l12 s12">
          <input class="datepicker" id="input_date" type="date">
          <label for="input_date">Date</label>
        </div>
      </div>

      <div class="row">
        <div class="col l12 s12">
          <input class="pikaday" type="text" value="12 Jan 2015">
        </div>
      </div>
    </div>


    <div class="card-panel">

      <h4>Clock Picker</h4>
      <div class="row">
        <div class="col l12 s12">
          <input class="clockpicker" type="text" value="18:10" data-donetext="OK">
        </div>
      </div>

    </div>

    <div class="card-panel">

      <h4>数据搜索</h4>
      <div class="row">
        <div class="col s12">
          Default Select2 state:
          <select class="select2">
            <optgroup label="Alaskan/Hawaiian Time Zone">
              <option value="AK">Alaska</option>
              <option value="HI">Hawaii</option>
            </optgroup>
            <optgroup label="Pacific Time Zone">
              <option value="CA">California</option>
              <option value="NV">Nevada</option>
              <option value="OR">Oregon</option>
              <option value="WA">Washington</option>
            </optgroup>
            <optgroup label="Mountain Time Zone">
              <option value="AZ">Arizona</option>
              <option value="CO">Colorado</option>
              <option value="ID">Idaho</option>
              <option value="MT">Montana</option>
              <option value="NE">Nebraska</option>
              <option value="NM">New Mexico</option>
              <option value="ND">North Dakota</option>
              <option value="UT">Utah</option>
              <option value="WY">Wyoming</option>
            </optgroup>
            <optgroup label="Central Time Zone">
              <option value="AL">Alabama</option>
              <option value="AR">Arkansas</option>
              <option value="IL">Illinois</option>
              <option value="IA">Iowa</option>
              <option value="KS">Kansas</option>
              <option value="KY">Kentucky</option>
              <option value="LA">Louisiana</option>
              <option value="MN">Minnesota</option>
              <option value="MS">Mississippi</option>
              <option value="MO">Missouri</option>
              <option value="OK">Oklahoma</option>
              <option value="SD">South Dakota</option>
              <option value="TX">Texas</option>
              <option value="TN">Tennessee</option>
              <option value="WI">Wisconsin</option>
            </optgroup>
            <optgroup label="Eastern Time Zone">
              <option value="CT">Connecticut</option>
              <option value="DE">Delaware</option>
              <option value="FL">Florida</option>
              <option value="GA">Georgia</option>
              <option value="IN">Indiana</option>
              <option value="ME">Maine</option>
              <option value="MD">Maryland</option>
              <option value="MA">Massachusetts</option>
              <option value="MI">Michigan</option>
              <option value="NH">New Hampshire</option>
              <option value="NJ">New Jersey</option>
              <option value="NY">New York</option>
              <option value="NC">North Carolina</option>
              <option value="OH">Ohio</option>
              <option value="PA">Pennsylvania</option>
              <option value="RI">Rhode Island</option>
              <option value="SC">South Carolina</option>
              <option value="VT">Vermont</option>
              <option value="VA">Virginia</option>
              <option value="WV">West Virginia</option>
            </optgroup>
          </select>
        </div>

        <div class="col s12">
          Multiple Select2 state:
          <select class="select2" multiple="multiple">
            <optgroup label="Alaskan/Hawaiian Time Zone">
              <option value="AK">Alaska</option>
              <option value="HI">Hawaii</option>
            </optgroup>
            <optgroup label="Pacific Time Zone">
              <option value="CA">California</option>
              <option value="NV">Nevada</option>
              <option value="OR">Oregon</option>
              <option value="WA">Washington</option>
            </optgroup>
            <optgroup label="Mountain Time Zone">
              <option value="AZ">Arizona</option>
              <option value="CO">Colorado</option>
              <option value="ID">Idaho</option>
              <option value="MT">Montana</option>
              <option value="NE">Nebraska</option>
              <option value="NM">New Mexico</option>
              <option value="ND">North Dakota</option>
              <option value="UT">Utah</option>
              <option value="WY">Wyoming</option>
            </optgroup>
            <optgroup label="Central Time Zone">
              <option value="AL">Alabama</option>
              <option value="AR">Arkansas</option>
              <option value="IL">Illinois</option>
              <option value="IA">Iowa</option>
              <option value="KS">Kansas</option>
              <option value="KY">Kentucky</option>
              <option value="LA">Louisiana</option>
              <option value="MN">Minnesota</option>
              <option value="MS">Mississippi</option>
              <option value="MO">Missouri</option>
              <option value="OK">Oklahoma</option>
              <option value="SD">South Dakota</option>
              <option value="TX">Texas</option>
              <option value="TN">Tennessee</option>
              <option value="WI">Wisconsin</option>
            </optgroup>
            <optgroup label="Eastern Time Zone">
              <option value="CT">Connecticut</option>
              <option value="DE">Delaware</option>
              <option value="FL">Florida</option>
              <option value="GA">Georgia</option>
              <option value="IN">Indiana</option>
              <option value="ME">Maine</option>
              <option value="MD">Maryland</option>
              <option value="MA">Massachusetts</option>
              <option value="MI">Michigan</option>
              <option value="NH">New Hampshire</option>
              <option value="NJ">New Jersey</option>
              <option value="NY">New York</option>
              <option value="NC">North Carolina</option>
              <option value="OH">Ohio</option>
              <option value="PA">Pennsylvania</option>
              <option value="RI">Rhode Island</option>
              <option value="SC">South Carolina</option>
              <option value="VT">Vermont</option>
              <option value="VA">Virginia</option>
              <option value="WV">West Virginia</option>
            </optgroup>
          </select>
        </div>
      </div>

    </div>


    <div class="card-panel">
      <h4>Tags</h4>
      <div class="row">
        <div class="col l12 s12">

          <input class="input-tag" type="text" name="tags" id="tags" value="PHP,JavaScript,CSS" />

        </div>

      </div>

    </div>


    <div class="card-panel">

      <h4>Drop Zone</h4>
      <div class="row">
        <div class="col l12 s12">
          <form action="dropzone.php" class="dropzone" id="my-dropzone"></form>
        </div>

      </div>

    </div>

    <div class="card-panel">
      <h4>Masked Inputs</h4>

      <div class="row">
        <div class="col l12 m12">

          <div class="input-field">
            <input id="masked-date" type="text" data-inputmask="'alias': 'date'">
            <label for="masked-date">Date</label>
          </div>
          <div class="input-field">
            <input id="masked-date-alt" type="text" data-inputmask="'mask': 'y/m/d'">
            <label for="masked-date-alt">Date Alt</label>
          </div>
          <div class="input-field">
            <input id="masked-time" type="text" data-inputmask="'mask': 'h:s'">
            <label for="masked-time">Time</label>
          </div>
          <div class="input-field">
            <input id="masked-phone" type="text" data-inputmask="'mask': '(999) 999-9999'">
            <label for="masked-phone">Phone</label>
          </div>
          <div class="input-field">
            <input id="masked-currency" type="text" data-inputmask="'numericInput': true, 'mask': '$ 999,999.99', 'rightAlignNumerics':false">
            <label for="masked-currency">Currency</label>
          </div>

        </div>
      </div>

    </div>

  </section>
  <!-- /Main Content -->


  <!-- Select2 -->
  <script type="text/javascript" src="<?php echo STATIC_FILE_DIR.'js/select2.full.min.js';?>"></script>

  <!-- Tags Input -->
  <script type="text/javascript" src="<?php echo STATIC_FILE_DIR.'js/jquery.tagsinput.js';?>"></script>

  <!-- Drop Zone -->
  <script type="text/javascript" src="<?php echo STATIC_FILE_DIR.'assets/dropzone/dropzone.min.js';?>"></script>

  <!-- Clockpicker -->
  <script type="text/javascript" src="<?php echo STATIC_FILE_DIR.'js/jquery-clockpicker.min.js';?>"></script>

  <!-- Pikaday -->
  <script type="text/javascript" src="<?php echo STATIC_FILE_DIR.'js/pikaday.js';?>?123213"></script>
  <script type="text/javascript" src="<?php echo STATIC_FILE_DIR.'js/pikaday.jquery.js';?>"></script>

  <!-- Spectrum : Color picker-->
  <script type="text/javascript" src="<?php echo STATIC_FILE_DIR.'js/spectrum.js';?>"></script>

  <!-- Input Mask :货币、日期固定格式-->
  <script type="text/javascript" src="<?php echo STATIC_FILE_DIR.'js/jquery.inputmask.bundle.min.js';?>"></script>

  <!-- Parsley (validation) -->
  <script type="text/javascript" src="<?php echo STATIC_FILE_DIR.'js/parsley.min.js';?>"></script>

<script type="text/javascript">
  $(document).ready(function(){

/*
    var picker = new Pikaday(
    {
        field: $('.pikaday'),
        firstDay: 1,
        minDate: new Date('2000-01-01'),
        maxDate: new Date('2020-12-31'),
        yearRange: [2000,2020]
    });
*/
  });
</script>

