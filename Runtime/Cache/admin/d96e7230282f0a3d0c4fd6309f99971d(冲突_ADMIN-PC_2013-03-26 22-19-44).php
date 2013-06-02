<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

		<script src="__PUBLIC__/Js/jquery.js" type="text/javascript"></script>
		<script src="__PUBLIC__/Js/artDialog/jquery.artDialog.min.js" type="text/javascript"></script>
		<link href="__PUBLIC__/Js/artDialog/skins/default.css" type="text/css" rel="stylesheet" />
		<link href="__PUBLIC__/Css/admin.css" type="text/css" rel="stylesheet" />
		<title>index</title>
		<script>
			var ad = "<form id='ad' enctype='multipart/form-data'><table>";
			ad += "<tr><td><label>广告名称</label></td><td><input type='text' name='Name' /></td></tr>";
			ad += "<tr><td><label>上传图片</label></td><td><input type='file' name='file' /></td></tr>";
			ad += "<tr><td><label>链接地址</label></td><td><input type='text' name='Url' /></td></tr>";
			ad += "<tr><td><label>开始日期</label></td><td><input type='text' name='start_time' value='' />";
			ad += "<tr><td><label>结束图片</label></td><td><input type='text' name='end_time' value='' /></td></tr>";
			ad += "</table></form>";
			$(document).ready(function() {
				$(".del").click(function() {
					$.post("__URL__/del", {
						'id' : $(this).attr("aid")
					}, function(data) {
						if (data.status == 1) {
							$.dialog({
								title : data.info.title,
								content : data.info.message,

							});
						}

					}, 'json');
				})
				$(".add").click(function() {
					$.dialog({
						title : "添加广告",
						content : ad,
						button : [{
							id : "submit",
							value : "提交",
							callback : function() {
								this.button({
									id : "submit",
									value : "完成",
								})
								$.post("__URL__/insert", $("#ad").serialize(), function(data) {
									if (data.status === 1) {
										alert(data.info.message);
									}

								}, 'json');

								return false;
							}
						}],
					});
				})
			})
		</script>

	</head>

	<body>
		<a class="add" href="javascript:void(0)">添加广告</a>
		<table>
			<tr>
				<td>广告</td>
				<td>链接</td>
				<td>图片</td>
				<td>开始时间</td>
				<td>结束时间</td>
				<td>操作</td>

			</tr>
			<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
					<td><?php echo ($vo["Name"]); ?></td>
					<td><?php echo ($vo["Url"]); ?></td>
					<td><?php echo ($vo["start_time"]); ?></td>
					<td><?php echo ($vo["end_time"]); ?></td>
					<td><?php echo ($vo["image"]); ?></td>
					<td><a class="del" aid=<?php echo ($vo["id"]); ?> href="javascript:void(0)">删除</a></td>
				</tr><?php endforeach; endif; else: echo "" ;endif; ?>
		</table>
		<div id="page">
			<?php echo ($page); ?>
		</div>
	</body>
</html>