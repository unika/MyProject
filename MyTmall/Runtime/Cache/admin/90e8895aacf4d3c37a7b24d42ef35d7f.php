<?php if (!defined('THINK_PATH')) exit();?><?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<title>index</title>
		<script src="__PUBLIC__/Js/my.js" type="text/javascript"></script>
		<script src="__PUBLIC__/Js/jquery.js" type="text/javascript"></script>
		<script src="__PUBLIC__/Js/artDialog/jquery.artDialog.min.js" type="text/javascript"></script>
		<link href="__PUBLIC__/Js/artDialog/skins/default.css" type="text/css" rel="stylesheet" />
     	<link href="__PUBLIC__/Css/admin.css" type="text/css" rel="stylesheet" />
    
		<script>
			$(document).ready(function(data) {
				$("a").click(function() {
					$.dialog({
						okValue : "提交",
						content : delivery,
						ok : function() {

							this.content($("#form1").serialize());

							return false;
						},
						cancelValue : "取消",
						cancel : function() {
							this.content("取消");

						}
					});

				});

			});

		</script>
	</head>

	<body>
		<h1><a href="javascript:void(0)"> 添加物流信息 </a></h1>
	</body>
</html>