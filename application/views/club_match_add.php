
<!-- Clockpicker 
<link rel="stylesheet" type="text/css" href="<?php echo STATIC_FILE_DIR.'css/jquery-clockpicker.min.css';?>" />-->
<link rel="stylesheet" type="text/css" href="<?php echo STATIC_FILE_DIR.'css/picker-classic.css';?>" />
<link rel="stylesheet" type="text/css" href="<?php echo STATIC_FILE_DIR.'css/picker-classic.time.css';?>" />
<!-- Pikaday -->
<link rel="stylesheet" type="text/css" href="<?php echo STATIC_FILE_DIR.'css/pikaday.css';?>" />

<!-- Main Style-->
<link rel="stylesheet" type="text/css" href="<?php echo STATIC_FILE_DIR.'css/theme/light-blue.min.css';?>" /> 



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
                        <a href='javascript:;'>添加赛事</a>
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
      <h4>赛事信息</h4>

      <div class="row">
        <div class="col l12 s12">
          <div class="input-field">
            <input id="match_name" type="text">
            <label for="match_name">赛事名称</label>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col l12 s12">
          <input id="match_date" class="pikaday" type="text" value="<?php echo date('Y-m-d');?>">
          <label for="match_date">比赛日期</label>
        </div>
      </div>
      <div class="row">
        <div class="col l12 s12">
          <input id="match_time" class="timepicker" type="text" value="12:00" data-donetext="确认">
          <label for="match_time">比赛时间</label>
        </div>
      </div>
      <div class="row">
        <div class="col l12 s12">
          <div class="input-field">
            <input id="match_players" type="text">
            <label for="match_players">参赛人数上限</label>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col l12 s12">
          <div class="input-field">
            <input id="match_pay" type="text">
            <label for="match_pay">报名使用参赛券张数</label>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col l12 s12">
          <p class="left-align">
            <button class="btn" type="button">保存</button>
            <a class="btn" href="<?php echo base_url('Match');?>">取消</a>
          </p>
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

  <!-- Clockpicker 
  <script type="text/javascript" src="<?php echo STATIC_FILE_DIR.'js/jquery-clockpicker.min.js';?>"></script>-->
  <script type="text/javascript" src="<?php echo STATIC_FILE_DIR.'js/picker.js';?>"></script>
  <script type="text/javascript" src="<?php echo STATIC_FILE_DIR.'js/picker.time.js';?>"></script>

  <!-- Pikaday -->
  <script type="text/javascript" src="<?php echo STATIC_FILE_DIR.'js/moment.min.js';?>"></script>
  <script type="text/javascript" src="<?php echo STATIC_FILE_DIR.'js/pikaday.js';?>"></script>
  <script type="text/javascript" src="<?php echo STATIC_FILE_DIR.'js/pikaday.jquery.js';?>"></script>

  <!-- Spectrum : Color picker-->
  <script type="text/javascript" src="<?php echo STATIC_FILE_DIR.'js/spectrum.js';?>"></script>

  <!-- Input Mask :货币、日期固定格式-->
  <script type="text/javascript" src="<?php echo STATIC_FILE_DIR.'js/jquery.inputmask.bundle.min.js';?>"></script>

  <!-- Parsley (validation) -->
  <script type="text/javascript" src="<?php echo STATIC_FILE_DIR.'js/parsley.min.js';?>"></script>

<script type="text/javascript">
  $(document).ready(function(){
    

/*    var picker = new Pikaday({
        field: document.getElementById('match_date'),
        format: 'YYYY MM DD'
    });

    var datepicker = new Pikaday({ 
        field:    $('#match_date')[0],
        onSelect:   function() {
          var date = document.createTextNode(this.getMoment().format('yyyy-mm-dd')); //生成的时间格式化成 2013-09-25
          $('#match_date').appendChild(date);
        }
      });
*/
    var picker = new Pikaday(
    {
        field: $('.pikaday'),
        firstDay: 1,
        minDate: new Date('2000-01-01'),
        maxDate: new Date('2020-12-31'),
        yearRange: [2000,2020],
        format: 'yyyy-mm-dd'
    });

    $('.timepicker').pickatime();

  });
</script>

