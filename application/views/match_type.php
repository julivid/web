<!-- Drop Zone -->
<link rel="stylesheet" type="text/css" href="<?php echo STATIC_FILE_DIR.'assets/dropzone/dropzone.min.css';?>" />
<style type="text/css">
    .table .btn { padding: 0 10px;}
    table tr.match-detele:not(.btn) { color: #999; text-decoration:line-through; }

    table img { width: 40px; height: auto; }

    .MS_disabled, .MS_default, .MS_info, .MS_warning, .MS_danger { font-weight: 600; padding: 5px 8px; border-radius: 5px;}
    .MS_disabled { color: #fff; background: #ccc; }
    .MS_default { color: #fff; background: #81C784; }
    .MS_info { color: #fff; background: #29b6f6; }
    .MS_warning { color: #fff; background: #E69600; }
    .MS_danger { color: #fff; background: #E60400; }

    .table-bordered, .table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th { border-color: #989898;}

    .modal-close.btn { background: #fff!important; color: #212121; margin-left:10px !important; margin-right:10px !important;}
    #toast-container { z-index: 2000; }
    .setting-title { font-size: 14px; }
    .setting-title span { font-size: 12px; color: red; display: block;}



/* Mimic table appearance */
    div.table {
      display: table;
    }
    div.table .file-row {
      display: table-row;
    }
    div.table .file-row > div {
      display: table-cell;
      vertical-align: top;
      padding: 8px;
    }
    div.table .file-row:nth-child(odd) {
      background: #f9f9f9;
    }
    /* The total progress gets shown by event listeners */
    #total-progress {
      opacity: 0;
      transition: opacity 0.3s linear;
    }
    /* Hide the progress bar when finished */
    #previews .file-row.dz-success .progress {
      opacity: 0;
      transition: opacity 0.3s linear;
    }
    /* Hide the delete button initially */
    #previews .file-row .delete {
      display: none;
    }
    /* Hide the start and cancel buttons and show the delete button */
    #previews .file-row.dz-success .start,
    #previews .file-row.dz-success .cancel {
      display: none;
    }
    #previews .file-row.dz-success .delete {
      display: block;
    }
    /*重定义上传文件样式*/
    .photos { position: relative; height: 135px; overflow: hidden;}
    #previews { position: absolute; top: 0;}
    #photo-thumb { width: 140px;}
    #photo-thumb img { width: 100%; height: auto;}
    #file-op-btn .btn { margin-top: 15px;}
    #match_type_table td span { display: inline-block; width: 100%; cursor: pointer; }
</style>
<a class="mail-compose-btn btn-floating btn-extra waves-effect waves-light red tooltipped modal-trigger" href="#matchTypeInfo" data-tooltip="添加赛事系列" data-position="left"><i class="mdi-content-add"></i></a>

<section class="content-wrap">
    <div class="page-title">

        <div class="row">
            <div class="col s12 m9 l10">
                <ul>
                    <li>
                        <a href="<?php echo base_url();?>"><i class="fa fa-home"></i> 首页</a>  <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href='javascript:;'>CPG赛事</a> <i class='fa fa-angle-right'></i>
                    </li>
                    <li>
                        <a href='javascript:;'>赛事系列列表</a>
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
            
                <!--<div class="center-align">
                    <a href="#matchTypeInfo" class="btn green lighten-2 modal-trigger" >添加赛事系列</a>
                </div>
                <br>-->
                <div class="table-responsive">
                    <table class="table table-bordered" id="match_type_table">
                        <thead>
                            <tr>
                                <th>TID</th>
                                <th>赛事系列名称</th>
                                <th>比赛时间段</th>
                                <th>赛事图标</th>
                                <th>系统状态</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                    <?php
                    if (empty($matchType)) {
                        echo '<tr><td colspan="6"><h5 class="center red-text">暂无赛事系列信息</h5></td></tr>';
                    }else{
                        $MTCfg = $this->config->item('match_type_cfg');
                        foreach ($matchType as $k=>$type) {
                            echo '<tr class="'.($type['status']==2?'':'type-detele').' " id="MT_'.$type['tid'].'">
                                <td>'.$type['tid'].'</td>
                                <td><span onclick="changeInfo('.$type['tid'].')">'.$type['name'].'</span></td>
                                <td><span onclick="changeInfo('.$type['tid'].')">'.$type['date'].'</span></td>
                                <td><img src="'.$type['logo'].'"></td>
                                <td><label class="MS_'.$MTCfg[$type['status']]['style'].'">'.$MTCfg[$type['status']]['desc'].'</label></td>
                                <td>'.($type['status']==2?'<a class="btn btn-small green" href="javascript:;"  onclick="updateMatchType('.$type['tid'].', 1)">恢复</a>':'<!--<a class="btn btn-small " href="javascript:;">修改</a>--><a class="btn btn-small red" onclick="updateMatchType('.$type['tid'].', 2)" href="javascript:;">删除</a>').'</td>
                            </tr>';
                        }
                    }
                    ?>
                        </tbody>
                    </table>
                </div>

                <!--<div class="center-align">
                    <a href="#matchTypeInfo" class="btn green lighten-2 modal-trigger" >添加赛事系列</a>
                </div>-->
            </div>
        </div>
    </div>

</section>
<!-- /Main Content -->
<div id="matchTypeInfo" class="modal">
    <div class="modal-content">
        <h4>赛事系列详细信息</h4>
        <div class="row">
            <div class="col s12 l2 center">
                <label for="" class="setting-title">赛事系列图标<span>(用于App显示)<br>推荐像素186*186</span></label>
            </div>
            <div class="col s12 l10">
                <div class="photos">
                    <div id="actions" class="row">
                        <div class="col s12">
                            <span class="btn green fileinput-button">
                                <i class="mdi-content-add-circle-outline"></i>
                                <span>添加图片</span>
                            </span>
                            <button type="submit" class="btn start">
                                <i class="mdi-file-cloud-upload"></i>
                                <span>上传</span>
                            </button>
                            <button type="reset" class="btn orange cancel">
                                <i class="mdi-content-block"></i>
                                <span>取消</span>
                            </button>
                        </div>

                        <div class="col s12">
                            <span class="fileupload-process">
                                <div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                    <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                                </div>
                            </span>
                        </div>

                    </div>

                    <div class="table table-striped" class="files" id="previews">

                        <div id="fileupload" class="file-row">
                            <div id="photo-thumb">
                                <span class="preview"><img data-dz-thumbnail /></span>
                            </div>
                            <div>
                                <p class="name" data-dz-name></p>
                                <strong class="error text-danger" data-dz-errormessage></strong>
                            </div>
                            <!--<div>
                                <p class="size" data-dz-size></p>
                                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                    <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                                </div>
                            </div>-->
                            <div id="file-op-btn">
                                <button class="btn start">
                                    <i class="mdi-file-cloud-upload"></i>
                                    <span>开始上传</span>
                                </button>
                                <button data-dz-remove class="btn orange cancel">
                                    <i class="mdi-content-block"></i>
                                    <span> 取消 </span>
                                </button>
                                <button data-dz-remove class="btn red delete">
                                    <i class="mdi-navigation-cancel"></i>
                                    <span>删除</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col s12">
                <div class="input-field">
                    <input id="match_type_name" type="text">
                    <label for="match_type_name">赛事系列名称</label>
                </div>
            </div>
            <div class="col s12">
                <div class="input-field">
                    <input id="match_type_date" type="text">
                    <label for="match_type_date">赛事时间段</label>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <a href="javascript:;" class="modal-action modal-close btn waves-effect waves-blue ">关闭</a>
        <a href="javascript:;" class="waves-effect btn green waves-effect" onclick="addMatchType()">提交</a>
    </div>
</div>

<!-- Drop Zone -->
<script type="text/javascript" src="<?php echo STATIC_FILE_DIR.'assets/dropzone/dropzone.min.js';?>"></script>


<script>

    localStorage.clear();//刷新时清除本地图片缓存
    Dropzone.autoDiscover = false;

    var previewNode = document.querySelector("#fileupload");
    previewNode.id = "";
    var previewTemplate = previewNode.parentNode.innerHTML;
    previewNode.parentNode.removeChild(previewNode);

    var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
        url: "<?php echo base_url('Gallery/fileUpload?type=1');?>", // Set the url
        paramName: "file",
        maxFilesize: 2, // MB
        acceptedFiles: "image/*",
        thumbnailWidth: 80,
        thumbnailHeight: 80,
        parallelUploads: 20,
        previewTemplate: previewTemplate,
        dictFileTooBig: "文件超出上传限制（最大{{maxFilesize}}M）",
        dictInvalidFileType: "文件类型错误",
        autoQueue: false, //自动上传
        previewsContainer: "#previews", // 预览框
        clickable: ".fileinput-button" // 绑定添加文件点击事件
    });

    myDropzone.on("addedfile", function(file) {
        //文件添加后绑定上传按钮事件：将文件添加到上传列队开始上传
        file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file); };
    });

    //显示上传进度
    myDropzone.on("totaluploadprogress", function(progress) {
        document.querySelector("#total-progress .progress-bar").style.width = progress + "%";
    });

    myDropzone.on("sending", function(file) {
        //上传过程中显示进度条
        document.querySelector("#total-progress").style.opacity = "1";
        //取消上传按钮的可点击状态
        file.previewElement.querySelector(".start").setAttribute("disabled", "disabled");
    });

    //上传结束后隐藏进度条
    myDropzone.on("queuecomplete", function(progress) {
        document.querySelector("#total-progress").style.opacity = "0";
    });

    //上传结束事件：处理返回数据
    myDropzone.on("complete", function(file) {
        var data = $.parseJSON( file.xhr.response );
        if(file.status=='success' && data.status==1){
            //返回数据存储到本地
            localGalleryStore( data.msg.url );
        }else{
            alert(data.msg);
            myDropzone.removeFile(file);
        }
    });

    //删除文件事件
    myDropzone.on("removedfile", function(file) {
        if(file.status=='success'){
            var data = $.parseJSON( file.xhr.response );
            if(data.status==1){
                //将本地数据删除
                localGalleryDel( data.msg.url );
                //删除服务器物理文件
                $.get("<?php echo base_url('Gallery/deleteImage');?>", { path: data.msg.path, fname: data.msg.name } );
            }
        }
    });


    //上传和取消所有文件事件，添加事件已在option中clickable定义
    document.querySelector("#actions .start").onclick = function() {
        myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED));
    };
    document.querySelector("#actions .cancel").onclick = function() {
        myDropzone.removeAllFiles(true);
    };

    function localGalleryStore(name){
        var str = localStorage.mtGallery; 
        if ( typeof(str) !== 'undefined' && str.length != 0 ) {
            str += ','+ name;
        }else{
            str = name;
        }
        localStorage.mtGallery = str;
    }
    
    function localGalleryDel(name){
        var str = localStorage.mtGallery, arr = [];
        if ( typeof(str) !=='undefined' ) {
            var tmp = str.split(','); 
            for (var i = 0; i < tmp.length; i++) {
                if(tmp[i] != name){
                    arr[i] = tmp[i];
                }
            }
        }
        arr = $.grep(arr, function () { return this != ''; });
        localStorage.mtGallery = arr.join(',');
    }

    function formDataInit(data) {
        $('#match_type_name').val('');
        $('#match_type_date').val('');
        $('#previews').html('');
        localGalleryDel(data.logo);
    }


var dataApiUrl = '<?php echo base_url("Match/addMatchTypeAJAX");?>';

function addMatchType(){
    //图片
    var nGallery = localStorage.mtGallery;
    if (!nGallery) { Materialize.toast('请上传信息图片', 3000, 'danger');return; }
    var match_type_name = $('#match_type_name').val(),
        match_type_date = $('#match_type_date').val();
    if (!match_type_name) { Materialize.toast('请填写赛事系列名称', 3000, 'danger');return; }
    if (!match_type_date) { Materialize.toast('请填写赛事时间段', 3000, 'danger');return; }
    $.ajax({
        url:  dataApiUrl,
        data: { name: match_type_name, date: match_type_date, logo: nGallery, a:Math.random() },
        type: "POST",
        dataType: "json",
        success: function(d){ console.log(d);
            if(d.status==1){
                $('#match_type_table').append('<tr id="MT_'+d.data.tid+'"><td>'+d.data.tid+'</td><td><span onclick="changeInfo('+d.data.tid+')">'+d.data.name+'</span></td><td><span onclick="changeInfo('+d.data.tid+')">'+d.data.date+'</span></td><td><img src="'+d.data.logo+'"></td><td><label class="MS_info">正常</label></td><td><!--<a class="btn btn-small " href="javascript:;">修改</a> --><a class="btn btn-small red" onclick="updateMatchType('+d.data.tid+', 2)" href="javascript:;">删除</a></td></tr>');
                formDataInit(d.data);
                Materialize.toast(d.msg, 1000, 'success', function(){
                    $('#matchTypeInfo').closeModal();
                });
            }else{
                Materialize.toast(d.msg, 3000, 'danger', function() {
                    $('#matchTypeInfo').closeModal();
                });
            }
        },
        error: function(){
            Materialize.toast('通信失败，请稍后再试', 3000, 'danger', function() {
                $('#matchTypeInfo').closeModal();
            });
        }
    });
}

function updateMatchType(id, s) {
    if (s==2 && !confirm('确认删除？')) {
        return ;
    }
    if (s==1 && !confirm('确认恢复？')) {
        return ;
    }
    $.ajax({
        url:  '<?php echo base_url("Match/updateMatchTypeAJAX");?>',
        data: { s:s, tid:id, a:Math.random()},
        type: "POST",
        dataType: "json",
        success: function(d){  //alert(d);return;
            if(d.status==1){
                Materialize.toast(d.msg, 1000, 'success', function(){
                    window.location.reload();
                });
            }else{
                Materialize.toast(d.msg, 3000, 'danger');
            }
        },
        error: function(){
            Materialize.toast('通信失败，请稍后再试', 3000, 'danger');
        }
    });
}

function changeInfo(id) {
    var name = $('#MT_'+id+' td').eq(1).text(), date = $('#MT_'+id+' td').eq(2).text(), s = $('#MT_'+id+' td .btn').hasClass('red');
    $('#MT_'+id+' td').eq(1).html('<input type="text" name="mt_name" value="'+name+'">');
    $('#MT_'+id+' td').eq(2).html('<input type="text" name="mt_date" value="'+date+'">');
    $('#MT_'+id+' td').eq(5).html('<a href="javascript:;" class="waves-effect btn btn-small red waves-effect" onclick="editMT('+id+', this)">保存</a> <a href="javascript:;" class="waves-effect btn btn-small waves-effect" onclick="MTDataInit('+id+', \''+name+'\', \''+date+'\', '+s+')">取消</a>');
}

function MTDataInit(id, n, d, s) {
    $('#MT_'+id+' td').eq(1).html('<span onclick="changeInfo('+id+')" >'+n+'</span>');
    $('#MT_'+id+' td').eq(2).html('<span onclick="changeInfo('+id+')" >'+d+'</span>');
    $('#MT_'+id+' td').eq(5).html(s==true?'<a class="btn btn-small red" onclick="updateMatchType('+id+', 2)" href="javascript:;">删除</a>':'<a class="btn btn-small green" href="javascript:;"  onclick="updateMatchType('+id+', 1)">恢复</a>');
}

function editMT(id) {
    var n = $('#MT_'+id+' td').find('input[name="mt_name"]').val(),
        d = $('#MT_'+id+' td').find('input[name="mt_date"]').val();

    $.ajax({
        url:  '<?php echo base_url("Match/editMatchTypeAJAX");?>',
        data: { tid:id, name:n, date:d, a:Math.random()},
        type: "POST",
        dataType: "json",
        success: function(d){  //alert(d);return;
            if(d.status==1){
                Materialize.toast(d.msg, 1000, 'success', function(){
                    window.location.reload();
                });
            }else{
                Materialize.toast(d.msg, 3000, 'danger');
            }
        },
        error: function(){
            Materialize.toast('通信失败，请稍后再试', 3000, 'danger');
        }
    });
}
</script>



