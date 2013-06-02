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
        $(".delAttr").bind("click", function() {
            var obj = $(this);
            $.confirm("确认删除?", function() {
                $.post("__URL__/del", {
                    'id' : obj.attr('aid'),
                }, function(data) {
                    if (data.status == 1) {
                        obj.parents("tr").remove();
                    } else {
                        $.alert(data.info);
                    }
                }, 'json');
            }, function() {
                return true;
            });
        })
    })
</script>

<body>
	<h3>属性列表</h3>
	<table>
		<tr>
			<td>编号</td>
			<td>类型编号</td>
			<td>属性名</td>
			<td>购买属性</td>
			<td>参数类型</td>
			<td>参数值</td>
			<td>默认值</td>
			<td>是否搜索</td>
			<td>排序</td>
			<td>显示</td>
			<td>长度</td>
			<td>操作</td>
		</tr>
		<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
				<td> <?php echo ($vo["Id"]); ?> </td>
				<td> <?php echo ($vo["ProductTypeId"]); ?> </td>
				<td> <?php echo ($vo["Name"]); ?> </td>
				<td>
				<?php if(($$vo["IsBuyType"]) == "0"): ?>是
					<?php else: ?>
					否<?php endif; ?></td>

				<td>
				<?php if(($$vo["ParamType"]) == "0"): ?>输入
					<?php else: ?>
					多选<?php endif; ?></td>

				<td>
				<?php if(is_array($vo["ParamValue"])): $i = 0; $__LIST__ = $vo["ParamValue"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$subvo): $mod = ($i % 2 );++$i; echo ($subvo); ?>;<?php endforeach; endif; else: echo "" ;endif; ?></td>
				<td> <?php echo ($vo["DefaultValue"]); ?> </td>
				<td>
				<?php if(($$vo["IsSearchAttr"]) == "0"): ?>否
					<?php else: ?>
					是<?php endif; ?></td>
				<td> <?php echo ($vo["AttrOrder"]); ?> </td>
				<td> <?php echo ($vo["BuySelStyle"]); ?> </td>
				<td> <?php echo ($vo["MaxLength"]); ?> </td>
				<td><a href='javascript:void(0)' class="delAttr" aid="<?php echo ($vo["id"]); ?>">删除</a></td>
			</tr><?php endforeach; endif; else: echo "" ;endif; ?>
	</table>
	<div class="page">
		<?php echo ($page); ?>
	</div>
</body>
</html>