<!-- Drop Zone -->
<link rel="stylesheet" type="text/css" href="<?php echo STATIC_FILE_DIR.'assets/dropzone/dropzone.min.css';?>" />
<!-- Tags Input -->
<link rel="stylesheet" type="text/css" href="<?php echo STATIC_FILE_DIR.'css/jquery.tagsinput.css';?>" />

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
    .toast.danger { background-color:#ffcdd2; color: #e53935;}
    .toast.success { background-color:#c8e6c9; color: #43a047;}
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
                        <a href='javascript:;'>信息管理</a> <i class='fa fa-angle-right'></i>
                    </li>
                    <li>
                        <a href='javascript:;'>添加信息</a>
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
            <h5>详细内容</h5>
            <a class="minimize" href="#"><i class="mdi-navigation-expand-less"></i></a>
        </div>
        <div class="content">
            <div class="row no-margin-top">
                <div class="col s12 l2">
                    <label for="news_channel" class="setting-title">频道</label>
                </div>
                <div class="col s12 l10">
                    <div class="input-field no-margin-top">
                        <select id="news_channel">
                            <option value="">请选择发布信息的频道</option>
                            <option value="introduction">协会介绍</option>
                            <option value="news">新闻公告</option>
                            <option value="match">赛事组织</option>
                            <option value="rule">竞赛规则</option>
                            <option value="dealer">裁判培训</option>
                            <option value="guide">从业指导</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row no-margin-top">
                <div class="col s12 l2">
                    <label for="news_title" class="setting-title">标题</label>
                </div>
                <div class="col s12 l10">
                    <div class="input-field no-margin-top">
                        <input id="news_title" type="text" placeholder="标题" value="" name="news_title">
                    </div>
                </div>
            </div>

            <div class="row no-margin-top">
                <div class="col s12 l2">
                    <label class="setting-title">标签（输入后回车）</label>
                </div>
                <div class="col s12 l10">
                    <div class="input-field no-margin-top">
                        <input class="input-tag" type="text" name="news_tags" id="news_tags" value=""/>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col s12 l2">
                    <label for="" class="setting-title">相册</label>
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
                                <div>
                                    <span class="preview"><img data-dz-thumbnail /></span>
                                </div>
                                <div>
                                    <p class="name" data-dz-name></p>
                                    <strong class="error text-danger" data-dz-errormessage></strong>
                                </div>
                                <div>
                                    <p class="size" data-dz-size></p>
                                    <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                        <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                                    </div>
                                </div>
                                <div>
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
                    <label for="news_brief" class="setting-title">简介</label>
                </div>
                <div class="col s12 l10">
                    <div class="input-field no-margin-top">
                        <textarea name="news_brief" id="news_brief" placeholder="简介" class="materialize-textarea" length="120"></textarea>
                    </div>
                </div>
            </div>

            <div class="row no-margin-top">
                <div class="col s12 l2">
                    <label class="setting-title">正文</label>
                </div>
                <div class="col s12 l10">
                    <textarea id="news_content" name="news_content"></textarea>
                </div>
            </div>
        </div>
    </div>

    <p class="right-align">
        <button class="btn" type="button" onclick="addNews()">保存</button>
        <a class="btn" href="<?php echo base_url('News/lists');?>">取消</a>
    </p>
</section>


<!-- CKEditor -->
<script src="<?php echo STATIC_FILE_DIR;?>assets/ckeditor/ckeditor.js" type="text/javascript"></script>
<script type="text/javascript">
CKEDITOR.replace( 'news_content' );
</script>

<!-- Drop Zone -->
<script type="text/javascript" src="<?php echo STATIC_FILE_DIR.'assets/dropzone/dropzone.min.js';?>"></script>
<!-- Tags Input -->
<script type="text/javascript" src="<?php echo STATIC_FILE_DIR.'js/jquery.tagsinput.js';?>"></script>
<script type="text/javascript">
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
    });


    //上传和取消所有文件事件，添加事件已在option中clickable定义
    document.querySelector("#actions .start").onclick = function() {
        myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED));
    };
    document.querySelector("#actions .cancel").onclick = function() {
        myDropzone.removeAllFiles(true);
    };

    function localGalleryStore(name){
        var str = localStorage.newsGallery; 
        if ( typeof(str) !== 'undefined' && str.length != 0 ) {
            str += ','+ name;
        }else{
            str = name;
        }
        localStorage.newsGallery = str;
    }
    function localGalleryDel(name){
        var str = localStorage.newsGallery, arr = [];
        if ( typeof(str) !=='undefined' ) {
            var tmp = str.split(','); 
            for (var i = 0; i < tmp.length; i++) {
                if(tmp[i] != name){
                    arr[i] = tmp[i];
                }
            }
        }
        arr = $.grep(arr, function () { return this != ''; });
        localStorage.newsGallery = arr.join(',');
    }

    function addNews () {
        var channel= $('#news_channel').val(),
            title  = $('#news_title').val(),
            tag    = $('#news_tags').val(),
            content= CKEDITOR.instances.news_content.getData(),
            brief  = $('#news_brief').val(),
            seoK   = $('#news_seo_key').val(),
            seoD   = $('#news_seo_desc').val();
        if (!channel) { Materialize.toast('请选择发布信息的频道', 3000, 'danger');return; }
        if (!title) { Materialize.toast('请填写信息标题', 3000, 'danger');return; }
        if (!tag)  { Materialize.toast('给信息添加一个标签吧', 3000, 'danger');return; }
        if (!brief){ Materialize.toast('请填写信息简介', 3000, 'danger');return; }
        if (brief.length > 120) { Materialize.toast('信息简介要精简一点嘛', 3000, 'danger');return; }
        if (!content) { Materialize.toast('请填写信息详细内容', 3000, 'danger');return; }

        //图片
        var nGallery = localStorage.newsGallery;
        if (!nGallery) { Materialize.toast('请上传信息图片', 3000, 'danger');return; }
        //console.log(content);
        $.ajax({
            url: '<?php echo base_url("News/newsAdd");?>',
            data:{ channel:channel, title:title, tag:tag, content:content, seo_key:seoK, seo_desc:seoD, gallery:nGallery, brief:brief, a:Math.random()},
            type: "POST",
            dataType: "json",
            success: function(d){  //alert(d);return;
                if(d.status==1){
                    Materialize.toast(d.msg, 1000, 'success', function(){
                        window.location.href = "<?php echo base_url('News/lists?c=');?>"+channel;
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
