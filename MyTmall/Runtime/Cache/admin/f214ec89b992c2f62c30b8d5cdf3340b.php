<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title>商城后台管理系统</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<script src="__PUBLIC__/Js/jquery.js" type="text/javascript"></script>
		<script src="__PUBLIC__/Js/my.js" type="text/javascript"></script>
		<script src="__PUBLIC__/Js/jquery-ui.js" type="text/javascript"></script>
		<script src="__PUBLIC__/Js/artDialog/jquery.artDialog.min.js" type="text/javascript"></script>
		<script src="__PUBLIC__/Js/artDialog/artDialog.plugins.min.js" type="text/javascript"></script>
		<script src="__PUBLIC__/Js/editor/kindeditor.js" type="text/javascript"></script>
		<link href="__PUBLIC__/Js/artDialog/skins/default.css" type="text/css" rel="stylesheet" />
		<link href="__PUBLIC__/Css/admin.css" type="text/css" rel="stylesheet" />
		<link href="__PUBLIC__/Js/jquery-ui.css" type="text/css" rel="stylesheet" />
		<script src="__PUBLIC__/Js/jquery-ui.js" type="text/javascript"></script>	
	</head>


<script>
    $(document).ready(function() {
        $(".tp").click(function() {
            $.get("__URL__/update_tpl", {
                'tpname' : $(this).attr('name')
            }, function(data) {

            }, 'json');
        })
        $(".choose").click(function() {
            var obj = $(this);
            if ($(this).val()) {
                $.post("__URL__/update", {
                    'tpname' : $(this).attr('name')
                }, function(data) {
                    // obj.parent().find(".status").text("已启用");
                    // obj.parents().parent().removeClass().addClass("current");
                    // $(".choose").not(obj).attr("checked", false);
                    // $(".choose").not(obj).parent().parent().removeClass().addClass("local");
                    // $(".choose").not(obj).parent().find(".status").text("未启用");
                    // $.alert(data.info);
                    if (data.status == 1) {
                        obj.parent().find(".status").text("已启用");
                        obj.parents("div").removeClass().addClass("current");
                        $(".choose").not(obj).attr("checked", false);
                        $(".choose").not(obj).parents("div").removeClass().addClass("local");
                        $(".choose").not(obj).parent().find(".status").text("未启用");
                        $.alert(data.info);
                    } else {
                        $.alert(data.info);
                    }

                }, 'json');
            }
        })

        $("#add").click(function() {
            $.dialog({
                title : "选择模板",
                content : '<iframe id="iframe" src="__GROUP__/Template/upload" frameborder="0"></iframe>',
                okValue : "上传",
                ok : function() {
                    $("#iframe").contents().find("#upload").submit();
                    return false;
                },
                cancelValue : "取消",
                cancel : function() {
                    this.close()
                },
            })

        })
        $("img").click(function() {
            var img = $(this);
            $.dialog({
                title : "模板图片",
                content : "<img style='width:700px;'  src='" + img.attr("src") + "' />",
            })
        })
    })
</script>
<body>
	<h1><a href="javascript:void(0)" id="add">上传模板</a></h1>
	<h2 class="tip">当前模板</h2>
	<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if(($vo["tp_name"]) == $theme): ?><div class="currenttp">
				<img style="width:160px;height:160px;" src="/Tpl/Home/<?php echo ($vo["tp_name"]); ?>/<?php echo ($vo["image"]); ?>"/>
				<p>
					<span class="tip">模板名</span> <?php echo ($vo["tp_name"]); ?>
				</p>
				<p>
					<span class="tip">作者</span><?php echo ($vo["author"]); ?>
				</p>
				<p>
					<span class="tip">启用日期</span> <?php echo ($vo["date"]); ?>
				</p>
				<p>
					<span class="tip">版本号</span> <?php echo ($vo["version"]); ?>
				</p>
				<p>
					<span class="tip">状态</span>
					<input type="radio" class="choose" name="<?php echo ($vo["tp_name"]); ?>" checked="" >
					<span class="status">已启用</span>
				</p>
			</div><?php endif; endforeach; endif; else: echo "" ;endif; ?>

	<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if(($vo["tp_name"]) != $theme): ?><div class="local">
				<img style="width:160px;height:160px;" src="/Tpl/Home/<?php echo ($vo["tp_name"]); ?>/<?php echo ($vo["image"]); ?>"/>

				<p>
					<span class="tip">模板名</span> <?php echo ($vo["tp_name"]); ?>
				</p>
				<p>
					<span class="tip">作者</span><?php echo ($vo["author"]); ?>
				</p>
				<p>
					<span class="tip">启用日期</span> <?php echo ($vo["date"]); ?>
				</p>
				<p>
					<span class="tip">版本号</span> <?php echo ($vo["version"]); ?>
				</p>
				<p>
					<span class="tip">状态</span>
					<input type="radio" class="choose" name="<?php echo ($vo["tp_name"]); ?>">
					<span class="status">未启用</span>
				</p>
			</div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
</body>
</html>