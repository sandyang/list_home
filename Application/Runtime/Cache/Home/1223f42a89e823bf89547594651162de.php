<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>清单首页</title>
    <!-- Bootstrap -->
    <link href="Public/css/bootstrap.min.css" rel="stylesheet">
    <link href="Public/css/base.css" rel="stylesheet">



</head>
<body>
<div class="container _m_container">
    <div class="row _search" >
        <div class="col-lg-6">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="输入清单名称进行搜搜">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="button"> <span class="glyphicon glyphicon-search"></span></button>
                </span>
            </div><!-- /input-group -->
        </div><!-- /.col-lg-6 -->
    </div>

    <div class="_list_contai">
        <div class="_list_top">
            <div class="row">
                <div class="col-xs-4">清单名称: <?php echo ($listinfo["name"]); ?></div>
                <div class="col-xs-4">清单时间: <?php echo (date('Y-m-d H:i',$listinfo["create_time"])); ?></div>
                <div class="col-xs-4">作者: <?php echo ($userinfo["username"]); ?></div>
            </div>
        </div>

        <div class="_list_box">

            <?php if(is_array($list_item)): $i = 0; $__LIST__ = $list_item;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if(empty($vo["content"])): ?><div class="_list_row">
                        <div class="row">
                            <div class="col-sm-12">
                                <h5><?php echo ($vo['itemdesc']); ?></h5>
                            </div>
                        </div>
                    </div>
                    <?php else: ?>
                    <div class="_list_row">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox">
                                        <?php if(!empty($vo["url"])): ?><a target="_blank" href="<?php echo ($vo["url"]); ?>"><?php echo ($vo["content"]); ?></a>
                                            <?php else: ?>
                                            <?php echo ($vo["content"]); endif; ?>
                                        <?php if(is_array($vo["img_url"])): $k = 0; $__LIST__ = $vo["img_url"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo2): $mod = ($k % 2 );++$k;?><a target="_blank" style="margin-left: 10px;" href="<?php echo ($vo2); ?>">[图片<?php echo ($k); ?>]</a><?php endforeach; endif; else: echo "" ;endif; ?>



                                    </label>
                                </div>
                            </div>
                        </div>
                    </div><?php endif; endforeach; endif; else: echo "" ;endif; ?>



            <div class="_list_row">
                <div class="row">
                    <div class="col-sm-12">
                        <p class="mgb10">备注: <?php echo ($listinfo["desc"]); ?></p>

                    </div>
                </div>
            </div>


            <div class="_list_row">
                <div class="row">
                    <div class="col-sm-12">
                        <p class="mgb10">


                            标签:
                            <?php if(is_array($listinfo["tags"])): $i = 0; $__LIST__ = $listinfo["tags"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo2): $mod = ($i % 2 );++$i;?><span style="margin-left: 10px;" class="label label-info"><?php echo ($vo2); ?></span><?php endforeach; endif; else: echo "" ;endif; ?>

                        </p>

                    </div>
                </div>
            </div>

            <div class="_list_row _btn_box">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="btn-group btn-group-justified" role="group" aria-label="...">

                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span>编辑清单</button>
                            </div>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-copy"></span>复制清单</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>





        </div>



    </div>


    <div class="_link_box">
        <div class="_ck_list">
            <div class="row">
                <div class="col-xs-4">
                    <a href=""><h5>清单1</h5></a>
                </div>
                <div class="col-xs-4">
                    <a href=""><h5>清单1</h5></a>
                </div>
                <div class="col-xs-4">
                    <a href=""><h5>清单1</h5></a>
                </div>
            </div>
        </div>
        <div class="_ck_list">
            <div class="row">
                <div class="col-xs-4">
                    <a href=""><h5>清单1</h5></a>
                </div>
                <div class="col-xs-4">
                    <a href=""><h5>清单1</h5></a>
                </div>
                <div class="col-xs-4">
                    <a href=""><h5>清单1</h5></a>
                </div>
            </div>
        </div>
        <div class="_ck_list">
            <div class="row">
                <div class="col-xs-4">
                    <a href=""><h5>清单1</h5></a>
                </div>
                <div class="col-xs-4">
                    <a href=""><h5>清单1</h5></a>
                </div>
                <div class="col-xs-4">
                    <a href=""><h5>清单1</h5></a>
                </div>
            </div>
        </div>

    </div>











</div>
<nav class="navbar navbar-default navbar-fixed-bottom">
    <div class="btn-group btn-group-justified" role="group" aria-label="...">
        <a href="" class="btn line_right"><span class="glyphicon glyphicon-home">首页</span> </a>
        <a href="" class="btn line_right"> <span class="glyphicon glyphicon-plus">增加清单</span> </a>
        <a href="" class="btn"><span class="glyphicon glyphicon-user ">我的清单</span> </a>
    </div>
</nav>

<!-- jQuery (Bootstrap 的所有 JavaScript 插件都依赖 jQuery，所以必须放在前边) -->
<script src="Public/js/jquery.js"></script>
<!-- 加载 Bootstrap 的所有 JavaScript 插件。你也可以根据需要只加载单个插件。 -->
<script src="Public/js/bootstrap.min.js"></script>
</body>
</html>