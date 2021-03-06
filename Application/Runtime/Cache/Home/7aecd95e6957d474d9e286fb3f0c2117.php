<?php if (!defined('THINK_PATH')) exit();?><div class="_list_row " data-id="<?php echo ($item_id); ?>">
    <form class="form-horizontal">
        <div class="form-group">
            <label  class="col-xs-3 control-label">content: </label>
            <div class="col-xs-9">
                <input type="text" class="form-control blur_input " data-name="content" placeholder="content">
            </div>
        </div>
        <div class="form-group">
            <label  class="col-xs-3 control-label">description: </label>
            <div class="col-xs-9">
                <input type="text" class="form-control blur_input " data-name="itemdesc"  placeholder="description">
            </div>
        </div>
        <div class="form-group">
            <label  class="col-xs-3 control-label">url: </label>
            <div class="col-xs-9">
                <input type="url" class="form-control blur_input" data-name="url"  placeholder="url">
            </div>
        </div>
        <div class="form-group">
            <label class="col-xs-3 control-label">imgurl: </label>
            <div class="col-xs-9 ">
                <div class="imgurl_group">
                    <div class="input-group">
                        <input type="url" class="form-control blur_input" data-name="img_url"  placeholder="imgurl">
                        <span class="input-group-btn _remove_imgurl">
                                        <button class="btn btn-default " type="button">
                                            <span class="glyphicon glyphicon-remove"></span>
                                        </button>
                                    </span>
                    </div>
                </div>
                <button type="button" class="btn btn-default addimgurl"><span class="glyphicon glyphicon-plus">imgurl</span></button>
            </div>
        </div>
    </form>
    <button type="button" class="btn btn-link removeitem">remove item</button>
</div>