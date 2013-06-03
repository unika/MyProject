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
			ad += "<tr><td><label>开始日期</label></td><td><input type='text' name='start_time' value='date()' />";
			ad += "<tr><td><label>结束图片</label></td><td><input type='text' name='end_time' value='date()' /></td></tr>";
			ad += "</table></form>";
			$(document).ready(function() {
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
									if (data.status == 1) {
										alert(data.info);
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
	</body>
</html>