<!-- Main Content -->
<section class="content-wrap ecommerce-product-single">
    <div class="page-title">

        <div class="row">
            <div class="col s12 m9 l10">
                <ul>
                    <li>
                        <a href="<?php echo base_url();?>"><i class="fa fa-home"></i> 首页</a>  <i class="fa fa-angle-right"></i>
                    </li>

                    <li>
                        <a href='javascript:;'>资料管理</a> <i class='fa fa-angle-right'></i>
                    </li>
                    <li>
                        <a href='javascript:;'>添加资料</a>
                    </li>
                </ul>
            </div>
            <div class="col s12 m3 l2 right-align">
                <!-- <a href="javascript:;" class="btn grey lighten-3 grey-text z-depth-0 chat-toggle"><i class="fa fa-comments"></i></a> -->
            </div>
        </div>
    </div>

    <div class="card">
        <div class="title">
            <h5>详细信息</h5>
            <a class="minimize" href="#"><i class="mdi-navigation-expand-less"></i></a>
        </div>
        <div class="content">
            <form id="fileForm" action="<?php echo base_url('File/fileAdd');?>" method="post" enctype="multipart/form-data" >
                <div class="row no-margin-top">
                    <div class="col s12 l2">
                        <label for="file_name" class="setting-title">显示名称</label>
                    </div>
                    <div class="col s12 l10">
                        <div class="input-field no-margin-top">
                            <input id="file_name" type="text" placeholder="显示名称" value="" name="file_name">
                        </div>
                    </div>
                </div>



                <div class="row no-margin-top">
                    <div class="col s12 l2">
                        <label for="file_orig" class="setting-title">文件</label>
                    </div>
                    <div class="col s12 l10">
                        <div class="file-field input-field">
                            <div class="btn">
                                <span>选择文件</span>
                                <input type="file" id="file_orig" name="file_orig">
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path" type="text">
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row no-margin-top">
                    <div class="col s12 l2">
                        <label class="setting-title">简介</label>
                    </div>
                    <div class="col s12 l10">
                        <textarea class="materialize-textarea" id="file_brief" name="file_brief" placeholder="请输入文件简介"></textarea>
                    </div>
                </div>
                <div class="row">
                    <p class="red-text">注：上传文件大小不超过5M，支持格式：pdf, doc, docx, xls, xlsx, ppt, pptx, rar, zip, csv, jpg, jpeg, png, gif, txt</p>
                </div>
            </form>
        </div>
    </div>

    <p class="right-align">
        <button class="btn" type="button" onclick="addFile()">保存</button>
        <a class="btn" href="<?php echo base_url('File');?>">返回</a>
    </p>
</section>

<script type="text/javascript">
    function addFile () {
        var name  = $('#file_name').val(),
            file  = $('#file_orig').val(),
            brief = $('#file_brief').val();
        if (!name) { Materialize.toast('请填写文件显示名称', 3000, 'danger');return; }
        if (!file)  { Materialize.toast('请上传文件', 3000, 'danger');return; }
        if (!brief) { Materialize.toast('请填写文件简介', 3000, 'danger');return; }
        $('#fileForm').submit();
    }
</script>
