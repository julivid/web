<style type="text/css">
    .table .btn { padding: 0 10px;}

    .table-bordered, .table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th { border-color: #989898;}
    .tab-res label { margin-right: 5px; background: #29b6f6; color: #fff; display: inline-block; padding: 2px 5px; border-radius: 2px; }
    .table-res { padding: 20px; border: 1px solid #29b6f6;}

    .card .title h5{ font-size: 20px; }
    .user-info { border: 1px dotted #ccc; margin-top: 10px;}
    .LTitle, .RContent { display: inline-block; padding: 20px 10px; }
    .LTitle { color: #565656; font-size: 18px; width: 80px; text-align: center;}
    .RContent { color: #212121; font-size: 26px; font-weight: 600;}
    #user_code { font-size: 16px; }
    #user_chips { font-size: 22px; }
</style>

<section class="content-wrap">
    <div class="page-title">

        <div class="row">
            <div class="col s12 m9 l10">
                <ul>
                    <li>
                        <a href="<?php echo base_url();?>"><i class="fa fa-home"></i> 首页</a>  <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href='javascript:;'>财务管理</a> <i class='fa fa-angle-right'></i>
                    </li>
                    <li>
                        <a href='javascript:;'>发行卡管理</a>
                    </li>
                </ul>
            </div>
            <div class="col s12 m3 l2 right-align">
                <!--<a href="javascript:;" class="btn grey lighten-3 grey-text z-depth-0 chat-toggle"><i class="fa fa-comments"></i></a>-->
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col s12 ">
            <div class="card-panel">
                <h3>发行卡 &bull; 信息</h3>
                <div class="row">
                    <div class="col s4">
                        <div class="input-field">
                            <select id="c_Type" onchange="selectType()">
                                <option selected disabled>请选择卡类型</option>
                                <option value="1">注册卡</option>
                                <option value="2">资格卡</option>
                            </select>
                        </div>
                    </div>
                    <div class="col s8">
                        <div class="input-field">
                            <select id="t_Type" class="browser-default" onchange="checkAgent()">
                                <option selected disabled>请选择发行卡种类</option>
                            <?php
                            //foreach ($ticketType as $t) {
                            //    echo '<option value="'.$t['type_code'].'">'.$t['type_name'].'</option>';
                            //}
                            ?>
                            </select>
                        </div>
                    </div>
                    <div class="col s12">
                        <div class="input-field">
                            <select id="t_Agent" class="browser-default" disabled="disabled" >
                                <option value="0" selected disabled>请选择代理商</option>
                                <option value="CPG">CPG自营</option>
                            <?php
                            foreach ($agentList as $a) {
                                echo '<option value="'.$a['number'].'">'.$a['name'].'</option>';
                            }
                            ?>
                            </select>
                        </div>
                    </div>

                    <div class="col s12">
                        <div class="input-field">
                            <input id="t_count" type="text" value="">
                            <label for="t_count">发行量</label>
                        </div>
                    </div>

                    <div class="col s12">
                        <a href="javascript:;" onclick="createTickets()" class="btn green" id="reslaseBtn">发行</a> &nbsp; 
                        <a href="javascript:;" onclick="window.history.back();" class="btn">返回</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
<!-- /Main Content -->
 
<script type="text/javascript">

function selectType() {
    var t = $('#c_Type').val();
    if (!t) {
        Materialize.toast('发行卡类型错误', 2000, 'danger');
        $('#t_Type').html('<option selected disabled>请选择发行卡种类</option>');
        return;
    }
    $.ajax({
        url: '<?php echo base_url("Tickets/getTicketTypeAJAX");?>',
        data:{ t:t, a:Math.random()},
        type: "POST",
        dataType: "json",
        success: function(d){ //console.log(d);return;
            if(d.status==1){
                _formatTicketType(d.data);
            }else{
                Materialize.toast(d.msg, 2000, 'danger');
            }
        },
        error: function(){
            Materialize.toast('通信失败，请稍后再试', 2000, 'danger');
        }
    });
}

function _formatTicketType(data) {
    //$('#t_Type').material_select('destroy');
    var htmlStr = '<option selected disabled>请选择发行卡种类</option>';
    $.each(data, function(i, o) {
        htmlStr += '<option value="'+o.type_code+'">'+o.type_name+'</option>';
    });
    $('#t_Type').html(htmlStr);
    //$('#t_Type').material_select();
    $('#t_Agent').find("option[value='0']").attr("selected",true);
    $('#t_Agent').attr('disabled', 'disabled');
}

function checkAgent() {
    var type = $('#t_Type').val();
    
    if (type=='zck_st') {
        //$('#t_Agent').material_select('destroy');
        $('#t_Agent').attr('disabled', false);
        //$('#t_Agent').material_select();
        //console.log( $('#t_Agent').attr('disabled') );
    }else{
        $('#t_Agent').find("option[value='CPG']").attr("selected",true);
        $('#t_Agent').attr('disabled', 'disabled');//console.log( $('#t_Agent').attr('disabled') );
    }
}

function createTickets() {
    if ($('#reslaseBtn').hasClass('disabled')) { return; }
    var cardType    = $('#c_Type').val(),
        ticketType  = $('#t_Type').val(),
        ticketAgent = 'CPG',
        ticketCount = $('#t_count').val();
    if (!cardType) {
        Materialize.toast('发行卡类型错误', 2000, 'danger');
        $('#t_Type').html('<option selected disabled>请选择发行卡种类</option>');
        return;
    }
    if (!ticketType) {
        Materialize.toast('发行卡种类错误', 2000, 'danger');
        return;
    }
    if (!ticketCount) {
        Materialize.toast('发行卡数量错误', 2000, 'danger');
        return;
    }
    if (ticketType=='zck_st') {
        ticketAgent = $('#t_Agent').val();
    }
    $('#reslaseBtn').addClass('disabled');
    $.ajax({
        url: '<?php echo base_url("Tickets/ticketsRelease");?>',
        data:{ ct:cardType, tt:ticketType, ta:ticketAgent, tn:ticketCount, a:Math.random()},
        type: "POST",
        dataType: "json",
        success: function(d){ //console.log(d);return;
            if(d.status==1){
                Materialize.toast(d.msg, 3000, 'success', function() {
                    $('#reslaseBtn').removeClass('disabled');
                    window.location.href="<?php echo base_url("Tickets");?>";
                });
                console.log(d.data);
            }else{
                Materialize.toast(d.msg, 2000, 'danger', function() {
                    $('#reslaseBtn').removeClass('disabled');
                });
            }
        },
        error: function(){
            Materialize.toast('通信失败，请稍后再试', 2000, 'danger', function() {
                $('#reslaseBtn').removeClass('disabled');
            });
        }
    });
}

function releaseDataFormat(data) {
    // body...
}
</script>
