<?php if (!defined('THINK_PATH')) exit(); if(is_array($all_list)): $i = 0; $__LIST__ = $all_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo2): $mod = ($i % 2 );++$i;?><div class="col-xs-4 all_list_">
        <a href=""><h5><?php echo ($vo2["name"]); ?></h5></a>
    </div><?php endforeach; endif; else: echo "" ;endif; ?>
<?php if(empty($is_not)): ?><button type="button" class="btn btn-default center-block loading" data-page="<?php echo ($p); ?>">加载更多>></button><?php endif; ?>