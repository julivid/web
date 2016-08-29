<style type="text/css">
    .file-list .btn { padding: 0 5px;}
    .disabled { cursor: not-allowed;}
    .file-brief { padding: 5px 8px; background: #eee; border: 1px dotted #ccc; margin-bottom: 10px; line-height: 1.2;}
</style>
<section class="content-wrap ecommerce-customers">
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
                        <a href='javascript:;'>资料列表</a>
                    </li>
                </ul>
            </div>
            <div class="col s12 m3 l2 right-align">
                <!-- <a href="javascript:;" class="btn grey lighten-3 grey-text z-depth-0 chat-toggle"><i class="fa fa-comments"></i></a> -->
            </div>
        </div>
    </div>

    <div class="row">
        <a class="btn-floating btn-extra waves-effect waves-light red tooltipped" href="<?php echo base_url('File/add');?>" data-tooltip="添加资料" data-position="left" style="position: fixed; bottom: 25px; right: 25px;">
            <i class="mdi-content-add"></i>
        </a>
        <div id="fileList">
        <?php
        if (empty( $fileList )) {
            echo '<div class="alert"> 暂无资料信息... </div>';
        }else{
            foreach ($fileList as $file) {
        ?>
        <div class="col s6 m3">
            <div class="card image-card">
                <div class="content file-list">
                    <h5><a href="<?php echo UPLOAD_FILE_URL.$file['folder'].'/'.$file['fname'];?>" target="_blank"><?php echo $file['name'].'.'.$file['type'];?></a></h5>
                    <div class="file-brief"><?php echo $this->auth->getContentBrief($file['brief'], 25);?></div>
                    <div id="file_<?php echo $file['fid'];?>">
                    <?php
                    switch ($file['status']) {
                        case 0:
                            echo '<a href="javascript:;" class="btn btn-small green" onclick="fileStatus('.$file['fid'].',1)">发布</a> <a href="javascript:;" class="btn btn-small red" onclick="fileStatus('.$file['fid'].',-1)">删除</a>';
                            break;
                        case 1:
                            echo '<a href="javascript:;" class="btn btn-small orange" onclick="fileStatus('.$file['fid'].',0)">取消下载</a>';
                            break;
                        case -1:
                            echo '<a href="javascript:;" class="btn btn-small" onclick="fileStatus('.$file['fid'].',0)">恢复</a>';
                            break;
                        default:
                            echo '<a href="javascript:;" class="btn btn-small disabled">未知</a> <a href="javascript:;" class="btn btn-small red" onclick="fileStatus('.$file['fid'].',-1)">删除</a>';
                            break;
                    }
                    ?>
                    </div>
                </div>
            </div>
        </div>
        <?php 
            }
            echo '</div><div class="col s12 center-align "><a href="javascript:;" class="btn-flat waves-effect waves-light-blue grey-text text-darken-1" onclick="loadData(this, formatFileInfo);">加载更多</a></div>';
        }
        ?>
    </div>
</section>

<script type="text/javascript">
    var dataPage = 1, dataApiUrl = '<?php echo base_url("File/getFileListAJAX");?>';

    function fileStatus (fid, s) {
        if (!fid) { Materialize.toast('信息出错，请刷新后重试', 3000, 'danger');return; }
        $.ajax({
            url: '<?php echo base_url("File/fileStatus");?>',
            data:{ fid:fid, status: s, a:Math.random()},
            type: "POST",
            dataType: "json",
            success: function(d){  //alert(d);return;
                if(d.status==1){
                    Materialize.toast(d.msg, 1000, 'success', function(){
                        _changeFileStatus(fid, s);
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

    function _changeFileStatus (fid, s) {
        switch(s){
            case -1 : $('#file_'+fid).html('<a href="javascript:;" class="btn btn-small" onclick="fileStatus('+ fid +',0)">恢复</a>'); break;
            case 0 : $('#file_'+fid).html('<a href="javascript:;" class="btn btn-small green" onclick="fileStatus('+ fid +',1)">发布</a> <a href="javascript:;" class="btn btn-small red" onclick="fileStatus('+ fid +',-1)">删除</a>'); break;
            case 1 : $('#file_'+fid).html('<a href="javascript:;" class="btn btn-small orange" onclick="fileStatus('+ fid +',0)">取消下载</a>'); break;
        }
    }

    function formatFileInfo(data){
        if (data.length == 0) {
            dataPage = 'all';
            Materialize.toast('全部资料已加载～', 1500, 'danger');return;
        }
        var htmlStr = '';
        $.each(data, function(i,o){
            htmlStr += '<div class="col s6 m3"><div class="card image-card"><div class="content file-list"><h5><a href="<?php echo UPLOAD_FILE_URL;?>'+ o.folder + '/' + o.fname +'" target="_blank">' + o.name + '.' + o.type +'</a></h5><div class="file-brief">' + getBrief(o.brief, 25) + '</div><div id="file_'+o.fid+'">';

            switch (o.status){
                case '0' : 
                    htmlStr += '<a href="javascript:;" class="btn btn-small green" onclick="fileStatus('+o.fid+',1)">发布</a> <a href="javascript:;" class="btn btn-small red" onclick="fileStatus('+o.fid+',-1)">删除</a>'; 
                    break;
                case '1' : 
                    htmlStr += '<a href="javascript:;" class="btn btn-small orange" onclick="fileStatus('+o.fid+',0)">取消下载</a>';
                    break;
                case '-1' : 
                    htmlStr += '<a href="javascript:;" class="btn btn-small" onclick="fileStatus('+o.fid+',0)">恢复</a>';
                    break;
                default: 
                    htmlStr += '<a href="javascript:;" class="btn btn-small disabled">未知</a> <a href="javascript:;" class="btn btn-small red" onclick="fileStatus('+o.fid+',-1)">删除</a>';
                    break;
            }
            htmlStr += '</div></div></div></div>';
        });
        $('#fileList').append(htmlStr);
    }
</script>
<script type="text/javascript" src="<?php echo STATIC_FILE_DIR;?>hnpoker/js/hpa-admin.js"></script>


