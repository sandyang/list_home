<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
        <title><?php echo ($tkd["title"]); ?></title>
        <?php if(!empty($tkd["keyword"])): ?><meta name="keywords" content="<?php echo ($tkd["keyword"]); ?>"/><?php endif; ?>
        <?php if(!empty($tkd["description"])): ?><meta name="description" content="<?php echo ($tkd["description"]); ?>"/><?php endif; ?>
    
    
    
        <link href="Public/css/bootstrap.min.css" rel="stylesheet">
        <link href="Public/css/base.css?1.1" rel="stylesheet">
    
    

    
        <script src="Public/js/jquery.js"></script>
        <!-- 加载 Bootstrap 的所有 JavaScript 插件。你也可以根据需要只加载单个插件。 -->
        <script src="Public/js/bootstrap.min.js"></script>

    
    
    <script>
        $(document).on("click",".show_more",function() {
            var tags = $(this).data('tags');
            var select_uid = $(this).data('uid');
            var list_id = '';
            $(this).parents('.group_list_row').find('.group_list').each(function(index){
                list_id += $(this).data('list') + ',';
            });
            _this = $(this).parents('.group_list_row');
            var url = '?c=index&a=more_list';
            var data = {'tags':tags,'select_uid':select_uid,'list_id':list_id};
            $.post(url,data,function(res){
                if(res){
                    _this.find('.show_more_list').remove();
                    _this.append(res);
                }
            },'html');
        });
        $(document).on("click",".show_more_user",function() {
            var page = $(this).data('page');
            _this = $(this).parents('.user_list_row');
            var url = '?c=index&a=more_list_user';
            $.post(url,{page:page},function(res){
                if(res){
                    _this.find('.show_more_list').remove();
                    _this.append(res);
                }
            },'html');
        });
    </script>

    <script>
        $(document).on("click",".loading",function(){

            $(this).text('加载中....');
            p =  $(this).attr('data-page');

            _this = $(this);
            $.post('?c=index&a=loading',{p:p},function(res){
                if(res){

                    _this.parents('.list_load_box').append(res);
                    _this.remove();

                }


            },'html');





        })
    </script>






    <style>
        .imgurl_group .input-group{
            margin-bottom: 5px;
        }
        .additem{
            margin: 5px auto;
        }
        .active{
            color: #fff !important;
            background-color: #5cb85c !important;
            border-color: #4cae4c !important;
        }
    </style>

</head>

<body>

<div class="container _m_container" id="_m_container">
    
        <div class="row _search" >
            <div class="col-lg-6">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="search for listname">
                    <span class="input-group-btn">
                    <button class="btn btn-default" type="button"> <span class="glyphicon glyphicon-search"></span></button>
                </span>
                </div>
            </div>
        </div>
    
    
    <div class="_list_contai">
        <?php if(is_array($list_group)): $i = 0; $__LIST__ = $list_group;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="_list_cron">
                <div class="row">
                    <div class="col-sm-12 ">
                        <div class="_list_title">
                            <h4><?php echo ($vo["group_title"]); ?>清单</h4>
                        </div>
                    </div>
                </div>
                <div class="row group_list_row" >
                    <?php if(is_array($vo["group_list"])): $i = 0; $__LIST__ = $vo["group_list"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo2): $mod = ($i % 2 );++$i;?><div class="col-xs-4 group_list  <?php if($vo2["is_more"] == 1): ?>show_more_list<?php endif; ?>" data-list="<?php echo ($vo2["id"]); ?>" >
                            <?php if($vo2["is_more"] == 1): ?><a href="javascript:;" class="show_more" data-tags="<?php echo ($vo["group_title"]); ?>" data-uid="<?php echo ($select_uid); ?>"><h5><?php echo ($vo2["name"]); ?></h5></a>
                                <?php else: ?>
                                <a href=""><h5><?php echo ($vo2["name"]); ?></h5></a><?php endif; ?>
                        </div><?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
            </div><?php endforeach; endif; else: echo "" ;endif; ?>

        <div class="_list_cron">
            <div class="row">
                <div class="col-sm-12 ">
                    <div class="_list_title">
                        <h4>看看别人的清单</h4>
                    </div>
                </div>
            </div>
            <div class="row user_list_row" >
                <?php if(is_array($user_list)): $i = 0; $__LIST__ = $user_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="col-xs-4 group_list  <?php if($vo["is_more"] >= 1): ?>show_more_list<?php endif; ?>" data-list="<?php echo ($vo["id"]); ?>" >
                        <?php if($vo["is_more"] >= 1): ?><a href="javascript:;" class="show_more_user" data-page="<?php echo ($vo["is_more"]); ?>"><h5><?php echo ($vo["username"]); ?></h5></a>
                            <?php else: ?>
                            <a href=""><h5><?php echo ($vo["username"]); ?></h5></a><?php endif; ?>
                    </div><?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
        </div>
    </div>


    <div class="row ">
        <div class="list_load_box">
            <?php if(is_array($all_list)): $i = 0; $__LIST__ = $all_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo2): $mod = ($i % 2 );++$i;?><div class="col-xs-4 all_list_">
            <a href=""><h5><?php echo ($vo2["name"]); ?></h5></a>
            </div><?php endforeach; endif; else: echo "" ;endif; ?>
            <button type="button" class="btn btn-default center-block loading" data-page="1">加载更多>></button>
        </div>
    </div>




    
        <nav class="navbar navbar-default navbar-fixed-bottom">
            <div class="btn-group btn-group-justified" role="group" aria-label="...">
                <a href="" class="btn line_right"><span class="glyphicon glyphicon-home">首页</span> </a>
                <a href="" class="btn line_right"> <span class=" glyphicon glyphicon-plus">增加清单</span> </a>
                <a href="" class="btn"><span class="glyphicon glyphicon-user ">我的清单</span> </a>
            </div>
        </nav>
    

</div>


</body>


</html>