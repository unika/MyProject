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
		var editor;
		var data = new Array("#username#", "#url#");
		$("body").on("change", "#Type", function() {
			editor.html(data[0] + data[1]);
			$("#Title").val($("#Type").find("option:selected").text());
		});
		$("#add").click(function() {
			$.dialog({
				initialize : function() {
					editor = KindEditor.create('#content');
					$("input[name='status']").each(function() {
						if ($(this).val = 1) {
							$(this).prop("checked", true);
						} else {
							$(this).prop("checked", false);
						}
					})
				},
				title : "添加邮件模板",
				content : mailtemp,
				lock : true,
				okValue : "添加",
				ok : function() {
					editor.sync("content");
					$.post("__URL__/insert", $("#mailtemp").serialize(), function(data) {
						$.alert(data.info);
					}, 'json')
				},
				cancelValue : "关闭",
				cancel : function() {

				}
			})
		});
		$(".delete").click(function() {
			var obj = $(this);
			$.post("__URL__/delTemplate", {
				"id" : $(this).attr("aid")
			}, function(data) {
				if (data.status == 1) {
					obj.parents("tr").remove();
				} else {
					$.alert(data.info);
				}
			}, 'json')

		});
		$(".edit").click(function() {
			$.post("__URL__/getTemplate", {
				"id" : $(this).attr("aid")
			}, function(data) {
				$.dialog({
					initialize : function() {
						editor = KindEditor.create('#content');
						$("#Title").val(data.data.Title);
						editor.html(data.data.Body);
						$("option").each(function() {
							if ($(this).val() == data.data.Type) {
								$(this).attr("selected", "selected");
							}
						})
						$("input[name='status']").each(function() {
							if ($(this).val() === data.data.status) {
								$(this).prop("checked", true);
							} else {
								$(this).prop("checked", false);
							}
						})
						$("#Title").after("<input type='hidden' name='id' value='" + data.data.Id + "' id='id'/>");
					},
					title : "编辑模板信息",
					content : mailtemp,
					lock : true,
					okValue : "更新",
					ok : function() {
						editor.sync("content");
						$.post("__URL__/upTemplate", $("#mailtemp").serialize(), function(data) {
							if (data.status == 1) {

							} else {
								$.alert(data.info);
							}

						}, 'json')

					},
					cancelValue : "关闭",
					cancel : function() {
						this.close();
					}
				});
			}, 'json');

		})
	})
</script>
<body>
	<h1><a href="javascript:void(0)" id="add">添加邮件模板</a></h1>
	<table>
		<tbody>
			<tr>
				<td>标题</td><td>类型</td><td>状态</td><td>操作</td>
			</tr>
		</tbody>
		<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
				<td><?php echo ($vo["Title"]); ?></td>
				<td><?php echo ($vo["Type"]); ?></td>
				<td>
				<?php if(($vo["status"]) == "0"): ?><span class="warring">禁用</span>
					<?php else: ?>
					<span class="pass">启用</span><?php endif; ?></td><td><a href="javascript:void(0)" class="edit" aid="<?php echo ($vo["Id"]); ?>">编辑</a><a href="javascript:void(0)" class="delete" aid="<?php echo ($vo["Id"]); ?>"> 删除</a></td>
			</tr><?php endforeach; endif; else: echo "" ;endif; ?>
	</table>
	<div class="page">
		<?php echo ($page); ?>
	</div>
</body>
</html>