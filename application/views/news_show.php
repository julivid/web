<!-- PhotoSwipe -->
<link rel="stylesheet" type="text/css" href="<?php echo STATIC_FILE_DIR;?>assets/PhotoSwipe/photoswipe.css" />
<link rel="stylesheet" type="text/css" href="<?php echo STATIC_FILE_DIR;?>assets/PhotoSwipe/default-skin.css" />
<style type="text/css">
.post-meta {
    margin: -5px 0 20px;
    font: 12px/20px 'OpenSansItalic';
    color: #c9c9c9;
}
.newsPhotoView img {
    width: 100%; height: auto;
}
.newsTag .tag { display: inline-block; padding: 3px 10px; margin-right: 5px; background-color: #29b6f6; color: #fff; cursor: pointer;}
.newsBrief {
    background: #f3f1f2; color: #555; padding: 20px; width: 100%;
}
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
                        <a href='javascript:;'>新闻管理</a> <i class='fa fa-angle-right'></i>
                    </li>
                    <li>
                        <a href='javascript:;'>新闻预览</a>
                    </li>
                </ul>
            </div>
            <div class="col s12 m3 l2 right-align">
                <!-- <a href="javascript:;" class="btn grey lighten-3 grey-text z-depth-0 chat-toggle"><i class="fa fa-comments"></i></a> -->
            </div>
        </div>

    </div>
    <!-- /Breadcrumb -->
    <?php if( empty( $newsInfo ) ) { ?>
    <div class="alert orange lighten-2 white-text">
        <strong>该新闻已删除，或信息已过期。</strong>
    </div>
    <a class="btn" href="<?php echo base_url('News/lists');?>">返回列表</a>
    <?php }else{ ?>


    <div class="card-panel">
        <div class="row">
            <div class="col s12">
                <h2><?php echo $newsInfo[0]['title'];?></h2>
                <div class="post-meta">
                    由 管理员 于 <?php echo date('Y-m-d', $newsInfo[0]['add_time']);?> 发布
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col s12 ">
                <div class="newsPhotoView"><img src="<?php echo UPLOAD_IMG_URL.date('Ym', $newsInfo[0]['imgTime']).'/'.$newsInfo[0]['main_photo'];?>" ></div>
            </div>
        </div>
        <!--<div class="row">
            <div class="col s12">
                <div class="newsBrief"><?php echo $newsInfo[0]['brief'];?></div>
            </div>
        </div>-->
        <div class="row">
            <div class="col s12">
                <div class="newsContent"><?php echo $newsInfo[0]['content'];?></div>
            </div>
        </div>
        <div class="row">
            <div class="col s12">
                <div class="newsTag"><?php echo $this->auth->productTag($newsInfo[0]['tag']);?></div>
            </div>
        </div>
    </div>


    <p class="right-align">
        <a class="btn" href="javascript:window.history.back();">返回列表</a>
    </p>

    <?php }?>
</section>


<!-- PhotoSwipe -->
<script type="text/javascript" src="<?php echo STATIC_FILE_DIR;?>assets/PhotoSwipe/photoswipe.min.js"></script>
<script type="text/javascript" src="<?php echo STATIC_FILE_DIR;?>assets/PhotoSwipe/photoswipe-ui-default.min.js"></script>
