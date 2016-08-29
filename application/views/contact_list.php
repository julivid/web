<!-- Main Content -->
<section class="content-wrap ecommerce-orders">
    <!-- Breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col s12 m9 l10">
                <ul>
                    <li>
                        <a href="<?php echo base_url();?>"><i class="fa fa-home"></i> 首页</a>  <i class="fa fa-angle-right"></i>
                    </li>

                    <li>
                        <a href='javascript:;'>客户留言</a> <i class='fa fa-angle-right'></i>
                    </li>
                    <li>
                        <a href='javascript:;'>信息列表</a>
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
            <h5>信息列表</h5>
        </div>
        <div class="content">
        <?php
        if (empty( $contactList )) {
            echo '<div class="alert">暂无客户留言</div>';
        }else{
        ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th> <th>客户</th> <th>日期</th> <th>联系方式</th> <th>内容</th> <!--<th>状态</th> <th>操作</th> -->
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($contactList as $k => $contact) 
                    {
                        echo '
                        <tr >
                            <td>'.($k+1).'</td>
                            <td>'.$contact['name'].'</td>
                            <td>'.date('Y-m-d', $contact['add_time']).'</td>
                            <td>'.$contact['tel'].'</td>
                            <td>'.$contact['content'].'</td>
                            <!--<td>';
                        /*switch ($contact['status']) 
                        {
                            case '0':
                                echo '<span class="label label-info">未读</span>';
                                break;
                            case '1':
                                echo '<span class="label label-success">已读</span>';
                                break;
                            case '2':
                                echo '<span class="label label-danger">已删</span>';
                                break;
                            default:
                                echo '<span class="label label-default">未知</span>';
                                break;
                        }*/
                        echo '</td>
                            <td>－</td>-->
                        </tr>';
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        <?php } ?>
        </div>
    </div>
</section>
