<!-- Drop Zone -->
<link rel="stylesheet" type="text/css" href="<?php echo STATIC_FILE_DIR.'assets/dropzone/dropzone.min.css';?>" />

<!-- Main -->
<link rel="stylesheet" type="text/css" href="<?php echo STATIC_FILE_DIR.'css/admin.min.css';?>" /> 
<style type="text/css">
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
      border-top: 1px solid #ddd;
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
    .photos { position: relative; height: 180px; overflow: hidden;}
    #previews { position: absolute; top: 0;}
    #photo-thumb { width: 140px;}
    #photo-thumb img { width: 100%; height: auto;}
    #file-op-btn .btn { margin-top: 15px;}
</style>
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
                        <a href='javascript:;'>用户中心</a> <i class='fa fa-angle-right'></i>
                    </li>
                    <li>
                        <a href='javascript:;'>添加用户</a>
                    </li>
                </ul>
            </div>
            <div class="col s12 m3 l2 right-align">
                <!-- <a href="javascript:;" class="btn grey lighten-3 grey-text z-depth-0 chat-toggle"><i class="fa fa-comments"></i></a> -->
            </div>
        </div>

    </div>
    <!-- /Breadcrumb -->

    <!-- General -->
    <div class="card">
        <div class="title">
            <h5>详细信息</h5>
            <a class="minimize" href="#"><i class="mdi-navigation-expand-less"></i></a>
        </div>
        <div class="content">
            <div class="row no-margin-top">
                <div class="col s12 l2">
                    <label for="user_type" class="setting-title">分组</label>
                </div>
                <div class="col s12 l10">
                    <div class="input-field no-margin-top">
                        <select id="user_type">
                            <option value="">请选择用户分组</option>
                            <option value="player">运动员</option>
                            <option value="trainer">教练员</option>
                            <option value="referee">裁判员</option>
                            <option value="asreferee">助理裁判员</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row no-margin-top">
                <div class="col s12 l2">
                    <label for="user_name" class="setting-title">姓名</label>
                </div>
                <div class="col s12 l10">
                    <div class="input-field no-margin-top">
                        <input id="user_name" type="text" placeholder="姓名" value="" name="user_name">
                    </div>
                </div>
            </div>

            <div class="row no-margin-top">
                <div class="col s12 l2">
                    <label for="user_gender" class="setting-title">性别</label>
                </div>
                <div class="col s12 l10">
                    <div class="input-field no-margin-top">
                        <select id="user_gender">
                            <option value="">请选择性别</option>
                            <option value="男">男</option>
                            <option value="女">女</option>
                            <option value="保密">保密</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col s12 l2">
                    <label for="" class="setting-title">图片</label>
                </div>
                <div class="col s12 l10">
                    <div class="photos">
                        <div id="actions" class="row">
                            <div class="col s12 m7">
                                <span class="btn green fileinput-button">
                                    <i class="mdi-content-add-circle-outline"></i>
                                    <span>添加图片</span>
                                </span>
                                <button type="submit" class="btn start">
                                    <i class="mdi-file-cloud-upload"></i>
                                    <span>上传全部</span>
                                </button>
                                <button type="reset" class="btn orange cancel">
                                    <i class="mdi-content-block"></i>
                                    <span>取消全部</span>
                                </button>
                            </div>

                            <div class="col s12 m5">
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
                                        <span>上传</span>
                                    </button>
                                    <button data-dz-remove class="btn orange cancel">
                                        <i class="mdi-content-block"></i>
                                        <span>取消</span>
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

            <div class="row no-margin-top">
                <div class="col s12 l2">
                    <label class="setting-title">履历</label>
                </div>
                <div class="col s12 l10">
                    <textarea id="user_record" name="user_record"></textarea>
                </div>
            </div>
        </div>
    </div>

    <p class="right-align">
        <button class="btn" type="button" onclick="addUser()">保存</button>
        <a class="btn" href="<?php echo base_url('User');?>">取消</a>
    </p>
</section>


<!-- CKEditor -->
<script src="<?php echo STATIC_FILE_DIR;?>assets/ckeditor/ckeditor.js" type="text/javascript"></script>
<script type="text/javascript">
CKEDITOR.replace( 'user_record' );
</script>

<!-- Drop Zone -->
<script type="text/javascript" src="<?php echo STATIC_FILE_DIR.'assets/dropzone/dropzone.min.js';?>"></script>
<script type="text/javascript">
    localStorage.clear();//刷新时清除本地图片缓存
    Dropzone.autoDiscover = false;

    var previewNode = document.querySelector("#fileupload");
    previewNode.id = "";
    var previewTemplate = previewNode.parentNode.innerHTML;
    previewNode.parentNode.removeChild(previewNode);

    var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
        url: "<?php echo base_url('Gallery/fileUpload?type=2');?>", // Set the url
        paramName: "file",
        maxFilesize: 2, // MB
        acceptedFiles: "image/*",
        thumbnailWidth: 120,
        thumbnailHeight: 160,
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
        $('#actions').hide();
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
            localGalleryStore( data.msg.name );
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
                localGalleryDel( data.msg.name );
                //删除服务器物理文件
                $.get("<?php echo base_url('Gallery/deleteImage');?>", { path: data.msg.path, fname: data.msg.name } );
            }
        }
        $('#actions').show();
    });


    //上传和取消所有文件事件，添加事件已在option中clickable定义
    document.querySelector("#actions .start").onclick = function() {
        myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED));
    };
    document.querySelector("#actions .cancel").onclick = function() {
        myDropzone.removeAllFiles(true);
        $('#actions').show();
    };

    function localGalleryStore(name){
        var str = localStorage.userGallery; 
        if ( typeof(str) !== 'undefined' && str.length != 0 ) {
            str += ','+ name;
        }else{
            str = name;
        }
        localStorage.userGallery = str;
    }
    function localGalleryDel(name){
        var str = localStorage.userGallery, arr = [];
        if ( typeof(str) !=='undefined' ) {
            var tmp = str.split(','); 
            for (var i = 0; i < tmp.length; i++) {
                if(tmp[i] != name){
                    arr[i] = tmp[i];
                }
            }
        }
        arr = $.grep(arr, function () { return this != ''; });
        localStorage.userGallery = arr.join(',');
    }

    function addUser () {
        var type   = $('#user_type').val(),
            name   = $('#user_name').val(),
            gender = $('#user_gender').val(),
            record = CKEDITOR.instances.user_record.getData();
        if (!type) { Materialize.toast('请选择人员类型', 3000, 'danger');return; }
        if (!name) { Materialize.toast('请填写人员姓名', 3000, 'danger');return; }
        if (!gender)  { Materialize.toast('给人员选一下性别吧，照片不可信哦～', 3000, 'danger');return; }
        if (!record) { Materialize.toast('请填写人员履历', 3000, 'danger');return; }

        //图片
        var uGallery = localStorage.userGallery;
        if (!uGallery) { Materialize.toast('请上传人员图片', 3000, 'danger');return; }
        //console.log(record);
        $.ajax({
            url: '<?php echo base_url("User/userAdd");?>',
            data:{ type:type, name:name, gender:gender, record:record, gallery:uGallery, a:Math.random()},
            type: "POST",
            dataType: "json",
            success: function(d){  //alert(d);return;
                if(d.status==1){
                    Materialize.toast(d.msg, 1000, 'success', function(){
                        window.location.href = "<?php echo base_url('User/?t=');?>"+type;
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
