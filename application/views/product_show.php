<!-- PhotoSwipe -->
<link rel="stylesheet" type="text/css" href="<?php echo STATIC_FILE_DIR;?>assets/PhotoSwipe/photoswipe.css" />
<link rel="stylesheet" type="text/css" href="<?php echo STATIC_FILE_DIR;?>assets/PhotoSwipe/default-skin.css" />
<style type="text/css">
    .proBrief{ font-size: 18px;}
    .proTag .tag { display: inline-block; padding: 3px 10px; margin-right: 5px; background-color: #29b6f6; color: #fff; cursor: pointer;}
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
                        <a href='javascript:;'>电子商务</a> <i class='fa fa-angle-right'></i>
                    </li>
                    <li>
                        <a href='javascript:;'>产品预览</a>
                    </li>
                </ul>
            </div>
            <div class="col s12 m3 l2 right-align">
                <!-- <a href="javascript:;" class="btn grey lighten-3 grey-text z-depth-0 chat-toggle"><i class="fa fa-comments"></i></a> -->
            </div>
        </div>

    </div>
    <!-- /Breadcrumb -->
    <?php if( empty( $productInfo ) ) { ?>
    <div class="alert orange lighten-2 white-text">
        <strong>该产品已删除，或信息已过期。</strong>
    </div>
    <a class="btn" href="<?php echo base_url('Product/lists');?>">返回列表</a>
    <?php }else{ ?>


    <div class="card-panel">
        <div class="row">
            <div class="col s12 m8 photoswipe-gallery isotope mt-0">
                <?php
                $gallery = explode(',', $productInfo[0]['gallery']);
                foreach ($gallery as $k=>$img) {
                    echo '
                <a class="col s6 m4 tooltipped" href="'.UPLOAD_FILE_DIR.date('Ym', $productInfo[0]['imgTime']).'/'.$img.'" data-size="2880x1800" data-med="'.UPLOAD_FILE_DIR.date('Ym', $productInfo[0]['imgTime']).'/'.$img.'" data-med-size="1440x900" data-position="top" data-delay="0" data-tooltip="图片 - '.($k+1).'">
                    <img src="'.UPLOAD_FILE_DIR.date('Ym', $productInfo[0]['imgTime']).'/thumb/'.$img.'" alt="" />
                    <figure>'.$productInfo[0]['name'].'-'.($k+1).'</figure>
                </a>
                    ';
                }
                ?>
            </div>
            <div class="col s12 m4">
                <h2><?php echo $productInfo[0]['name'];?></h2>
                <p class="proBrief"><?php echo $productInfo[0]['brief'];?></p>
                <p>编号 ： <?php echo $productInfo[0]['product_no'];?></p>
                <p>单价 ： <?php echo $productInfo[0]['price'];?></p>
                <p>库存 ： <?php echo $productInfo[0]['store'];?></p>
                <div class="proTag"><?php echo $this->auth->productTag($productInfo[0]['tag']);?></div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="title">
            <h5><i class="mdi-action-description"></i> 产品简介</h5>
        </div>
        <div class="content"><?php echo $productInfo[0]['desc'];?></div>
    </div>


    <p class="right-align">
        <a class="btn" href="javascript:window.history.back();">返回列表</a>
    </p>

    <?php }?>
</section>


<!-- PhotoSwipe -->
<script type="text/javascript" src="<?php echo STATIC_FILE_DIR;?>assets/PhotoSwipe/photoswipe.min.js"></script>
<script type="text/javascript" src="<?php echo STATIC_FILE_DIR;?>assets/PhotoSwipe/photoswipe-ui-default.min.js"></script>

