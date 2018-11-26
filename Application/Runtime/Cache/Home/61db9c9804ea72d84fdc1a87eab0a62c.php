<?php if (!defined('THINK_PATH')) exit(); if(is_array($group_list)): $i = 0; $__LIST__ = $group_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo2): $mod = ($i % 2 );++$i;?><div class="col-xs-4 group_list  <?php if($vo2["is_more"] == 1): ?>show_more_list<?php endif; ?>  " data-list="<?php echo ($vo2["id"]); ?>" >
        <?php if($vo2["is_more"] == 1): ?><a href="javascript:;" class="show_more" data-tags="<?php echo ($tags); ?>" data-uid="<?php echo ($select_uid); ?>"><h5><?php echo ($vo2["name"]); ?></h5></a>
            <?php else: ?>
            <a href=""><h5><?php echo ($vo2["name"]); ?></h5></a><?php endif; ?>
    </div><?php endforeach; endif; else: echo "" ;endif; ?>