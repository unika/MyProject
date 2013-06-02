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
        //增加活动
        $("#add").click(function() {
            var mydialog = $.dialog({
                initialize : function() {
                    $("#end_time").datepicker({
                        dateFormat : "yy-mm-dd"
                    });
                    $(".hidden").attr("style", "display:none");
                },
                title : "添加优惠券",
                content : coupon,
                lock : true,
                button : [{
                    disabled : true,
                    value : "上传优惠券图片",
                    callback : function() {
                        var second = $.dialog({
                            id : "upload",
                            title : "选择上传文件",
                            content : '',
                            okValue : "上传",
                            ok : function() {
                                $("#iframe").contents().find("#upload").submit();
                                return false;
                            },
                        })
                        return false;
                    }
                }, {
                    focus : true,
                    value : "生成",
                    callback : function() {
                        $.post("__URL__/addCoupon", $("#coupon").serialize(), function(data) {
                            $.alert(data.info);
                            return false;
                        }, 'json');

                    }
                }, {
                    value : "取消",
                    callback : function() {
                        this.content()
                    }
                }]
            });
        })
        $(".del").click(function() {
            var obj = $(this);
            $.post("__URL__/delCoupon", {
                "id" : $(this).attr("aid")
            }, function(data) {
                $.alert(data.info);
            }, 'json')
            $(this).parents("tr").remove();
        });
        //增加产品

    })
</script>

<body>
	<a id="add" href="javascript:void(0)">添加优惠券</a>
	<table>
		<tr>
			<td>优惠券编号</td>
			<td>名称</td>
			<td>金额</td>
			<td>失效时间</td>
			<td>状态</td>
			<td>操作</td>
		</tr>
		<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
				<td><?php echo ($vo["Id"]); ?></td>
				<td><?php echo ($vo["No"]); ?></td>
				<td><?php echo ($vo["Price"]); ?></td>
				<td><?php echo ($vo["ExpireTime"]); ?></td>
				<td>
				<?php switch($vo["Status"]): case "0": ?><span class="warring">已失效</span><?php break;?>
					<?php case "1": ?><span class="green">未使用</span><?php break;?>
					<?php case "2": ?><span class="pass">已过期</span><?php break;?>
					<?php default: ?>
					未使用<?php endswitch;?></td>
				<td><a href="javascript:void(0)" class="del" aid="<?php echo ($vo["Id"]); ?>">删除</a></td>
			</tr><?php endforeach; endif; else: echo "" ;endif; ?>
	</table>
	<div class="page">
		<?php echo ($page); ?>
	</div>
</body>
</html>