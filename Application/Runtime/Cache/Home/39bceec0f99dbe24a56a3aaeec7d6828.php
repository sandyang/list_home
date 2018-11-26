<?php if (!defined('THINK_PATH')) exit(); if(is_array($user_list)): $i = 0; $__LIST__ = $user_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="col-xs-4 group_list  <?php if($vo["is_more"] >= 1): ?>show_more_list<?php endif; ?>" data-list="<?php echo ($vo["id"]); ?>" >
        <?php if($vo["is_more"] >= 1): ?><a href="javascript:;" class="show_more_user" data-page="<?php echo ($vo["is_more"]); ?>"><h5><?php echo ($vo["username"]); ?></h5></a>
            <?php else: ?>
            <a href=""><h5><?php echo ($vo["username"]); ?></h5></a><?php endif; ?>
    </div><?php endforeach; endif; else: echo "" ;endif; ?>