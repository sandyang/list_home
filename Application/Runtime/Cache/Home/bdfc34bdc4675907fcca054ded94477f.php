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
        $(function(){
//         add imgurl
            $(document).on("click",".addimgurl",function(){
                var hl = '';
                hl += '<div class="input-group">';
                hl +=  '<input type="url" class="form-control  imgurl" data-name="img_url"  placeholder="imgurl">';
                hl +=  '<span class="input-group-btn _remove_imgurl">';
                hl +=  '<button class="btn btn-default " type="button">';
                hl +=  '<span class="glyphicon glyphicon-remove"></span>';
                hl +=  '</button>';
                hl +=  '</span>';
                hl +=  '</div>';
                $(this).siblings('.imgurl_group').append(hl);
            });
            //remove imgurl
            $(document).on("click","._remove_imgurl",function(){

                if($(this).siblings('.imgurl').val() == ''){
                    $(this).parents('.input-group').remove();
                }else{
                    alert('请先清空链接,然后删除');
                }
            });
//add itme

            $(document).on("click",".additem",function() {
                _this = $(this);
                var list_id = $('#list_id').val();
                $.post('?c=index&a=additem',{list_id:list_id},function(data){
                    _this.siblings('._list_box').append(data);
                },'html');
            });

//        remove item
            $(document).on("click",".removeitem",function() {
                _this = $(this);
                if (confirm("确认删除这个清单item吗?")) {
                    var item_id = _this.parents('._list_row').data('id');
                    $.post('?c=index&a=delitem',{item_id:item_id},function(data){
                        if(data ==1){
                            _this.parents('._list_row').remove();
                        }

                    },'html');







                }
            });

//        click is_public
            $(document).on("click",".is_public",function(){
                var list_id = $('#list_id').val();
                var is_public = $(this).data('value');
                var data = {is_public:is_public,list_id:list_id};
                var url = '?c=index&a=editHandle';
                _this = $(this);
                $.post(url,data,function(res){
                    $('.is_public').removeClass('active');
                    _this.addClass('active');
                });



            });



            // blur update 普通按钮提交
        $(document).on("blur",".blur_input",function() {

            var url = '?c=index&a=editHandle';
            var type = $(this).data('name');
            var val = $(this).val();
            var item_id = $(this).parents('._list_row').data('id');
            var list_id = $('#list_id').val();
            var data = {type:type,val:val,list_id:list_id,item_id:item_id};
            $.post(url,data);

        });

            $(document).on("blur",".imgurl",function() {
                imgurl = new Object();
                var list_id = $('#list_id').val();
                var item_id = $(this).parents('._list_row').data('id');
                $(this).parents('.imgurl_group ').find('.input-group').each(function(index){
                    imgurl[index] = $(this).find(("[data-name='img_url']")).val();
                });
                imgurl = JSON.stringify(imgurl);
                var url = '?c=index&a=editHandle';
                var data = {img_url:imgurl,list_id:list_id,item_id:item_id};
                $.post(url,data);


            });

            /*$(document).on("click","#save",function() {
                var name = $("[data-name='name']").val();
                var desc = $("[data-name='desc']").val();
                var tags = $("[data-name='tags']").val();
                var is_public = $('.is_public.active').data('value');
                var items = new Object();
                $('._list_box ._list_row').each(function(index){
                    items[index] = new Object();
                    items[index]['content'] = $(this).find(("[data-name='content']")).val();
                    items[index]['itemdesc'] = $(this).find(("[data-name='itemdesc']")).val();
                    items[index]['url'] = $(this).find(("[data-name='url']")).val();
                    indexf  = index;
                    items[indexf]['img_url'] = new Object();
                    $(this).find('.imgurl_group .input-group').each(function(index2){
                        items[indexf]['img_url'][index2] = $(this).find(("[data-name='img_url']")).val();
                    });
                });
                items = JSON.stringify(items);
                var url = '?c=index&a=addHandle';
                var data = {
                    name:name,
                    desc:desc,
                    tags:tags,
                    is_public:is_public,
                    items:items
                };

                $.post(url,data,function(res){

                    alert(res.data);
                    if(res.status ==200){
                        window.location.href = '?c=index';
                    }

                });
            });*/
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
        <div class="_list_top">
            <form class="form-horizontal">
                <div class="form-group">
                    <label  class="col-xs-3 control-label">listname: </label>
                    <div class="col-xs-9">
                        <input type="text" class="form-control blur_input" data-name="name" value="<?php echo ($listinfo["name"]); ?>"  placeholder="list name">
                    </div>
                </div>
            </form>
        </div>

            <div class="_list_box">
                <?php if(is_array($list_item)): $i = 0; $__LIST__ = $list_item;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="_list_row " <?php if(empty($vo["content"])): ?>style="background: #bcd9fb;"<?php endif; ?>  data-id="<?php echo ($vo["id"]); ?>">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label  class="col-xs-3 control-label">content: </label>
                            <div class="col-xs-9">
                                <input type="text" class="form-control blur_input " value="<?php echo ($vo["content"]); ?>"  data-name="content" placeholder="content">
                            </div>
                        </div>
                        <div class="form-group">
                            <label  class="col-xs-3 control-label">description: </label>
                            <div class="col-xs-9">
                                <input type="text" class="form-control blur_input "  value="<?php echo ($vo["itemdesc"]); ?>"  data-name="itemdesc"  placeholder="description">
                            </div>
                        </div>
                        <div class="form-group">
                            <label  class="col-xs-3 control-label">url: </label>
                            <div class="col-xs-9">
                                <input type="url" class="form-control blur_input" value="<?php echo ($vo["url"]); ?>"  data-name="url"  placeholder="url">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label">imgurl: </label>
                            <div class="col-xs-9 ">
                                <div class="imgurl_group">
                                    <?php if(is_array($vo["img_url"])): $i = 0; $__LIST__ = $vo["img_url"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo2): $mod = ($i % 2 );++$i;?><div class="input-group">
                                        <input type="url" class="form-control imgurl" value="<?php echo ($vo2); ?>" data-name="img_url"  placeholder="imgurl">
                                            <span class="input-group-btn _remove_imgurl">
                                                <button class="btn btn-default " type="button">
                                                    <span class="glyphicon glyphicon-remove"></span>
                                                </button>
                                            </span>
                                        </div><?php endforeach; endif; else: echo "" ;endif; ?>
                                    </div>



                                <button type="button" class="btn btn-default addimgurl"><span class="glyphicon glyphicon-plus">imgurl</span></button>
                            </div>
                        </div>
                    </form>
                    <button type="button" class="btn btn-link removeitem">remove item</button>
                </div><?php endforeach; endif; else: echo "" ;endif; ?>
            </div>



        <button type="button" class="btn btn-primary btn-lg btn-block additem">add item</button>
        <div class="_list_row _list_desc">
            <form class="form-horizontal">
                <div class="form-group">
                    <label  class="col-xs-3 control-label">备注: </label>
                    <div class="col-xs-9">
                        <input type="text" class="form-control blur_input" data-name="desc" value="<?php echo ($listinfo["desc"]); ?>" placeholder="备注">
                    </div>
                </div>
            </form>
        </div>
        <div class="_list_row _list_tags">
            <form class="form-horizontal">
                <div class="form-group">
                    <label  class="col-xs-3 control-label">标签: </label>
                    <div class="col-xs-9">
                        <input type="text" class="form-control blur_input" data-name="tags" value="<?php echo ($listinfo["tags"]); ?>"  placeholder="多个以逗号或空格分割">
                    </div>
                </div>
            </form>
        </div>
        <div class="_list_row _btn_box">
            <div class="row">
                <div class="col-sm-12 isPublic_box">
                    <div class="btn-group btn-group-justified" role="group" aria-label="...">
                        <div class="btn-group" role="group">

                            <button type="button" class="btn btn btn-default is_public <?php if($listinfo["is_public"] == 1): ?>active<?php endif; ?>"  data-value="1" >私有</button>
                        </div>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn btn-default is_public  <?php if($listinfo["is_public"] == 2): ?>active<?php endif; ?> " data-value="2" >公开</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--hidden 数据-->
    <input type="hidden" id="list_id" value="<?php echo ($listinfo["id"]); ?>">

    
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