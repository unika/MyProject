<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>菜单</title>

		<script src="__PUBLIC__/js/prototype.lite.js" type="text/javascript"></script>
		<script src="__PUBLIC__/js/moo.fx.js" type="text/javascript"></script>
		<script src="__PUBLIC__/js/moo.fx.pack.js" type="text/javascript"></script>
		<style>
			body {
				font: 12px Arial, Helvetica, sans-serif;
				color: #000;
				background-color: #EEF2FB;
				margin: 0px;
			}
			#container {
				width: 182px;
			}
			H1 {
				font-size: 12px;
				margin: 0px;
				width: 182px;
				cursor: pointer;
				height: 30px;
				line-height: 20px;
			}
			H1 a {
				display: block;
				width: 182px;
				color: #000;
				height: 30px;
				text-decoration: none;
				moz-outline-style: none;
				background-image: url(__PUBLIC__/images/menu_bgS.gif);
				background-repeat: no-repeat;
				line-height: 30px;
				text-align: center;
				margin: 0px;
				padding: 0px;
			}
			.content {
				width: 182px;
				height: 26px;
			}
			.MM ul {
				list-style-type: none;
				margin: 0px;
				padding: 0px;
				display: block;
			}
			.MM li {
				font-family: Arial, Helvetica, sans-serif;
				font-size: 12px;
				line-height: 26px;
				color: #333333;
				list-style-type: none;
				display: block;
				text-decoration: none;
				height: 26px;
				width: 182px;
				padding-left: 0px;
			}
			.MM {
				width: 182px;
				margin: 0px;
				padding: 0px;
				left: 0px;
				top: 0px;
				right: 0px;
				bottom: 0px;
				clip: rect(0px,0px,0px,0px);
			}
			.MM a:link {
				font-family: Arial, Helvetica, sans-serif;
				font-size: 12px;
				line-height: 26px;
				color: #333333;
				background-image: url(__PUBLIC__/images/menu_bg1.gif);
				background-repeat: no-repeat;
				height: 26px;
				width: 182px;
				display: block;
				text-align: center;
				margin: 0px;
				padding: 0px;
				overflow: hidden;
				text-decoration: none;
			}
			.MM a:visited {
				font-family: Arial, Helvetica, sans-serif;
				font-size: 12px;
				line-height: 26px;
				color: #333333;
				background-image: url(__PUBLIC__/images/menu_bg1.gif);
				background-repeat: no-repeat;
				display: block;
				text-align: center;
				margin: 0px;
				padding: 0px;
				height: 26px;
				width: 182px;
				text-decoration: none;
			}
			.MM a:active {
				font-family: Arial, Helvetica, sans-serif;
				font-size: 12px;
				line-height: 26px;
				color: #333333;
				background-image: url(__PUBLIC__/images/menu_bg1.gif);
				background-repeat: no-repeat;
				height: 26px;
				width: 182px;
				display: block;
				text-align: center;
				margin: 0px;
				padding: 0px;
				overflow: hidden;
				text-decoration: none;
			}
			.MM a:hover {
				font-family: Arial, Helvetica, sans-serif;
				font-size: 12px;
				line-height: 26px;
				font-weight: bold;
				color: #006600;
				background-image: url(__PUBLIC__/images/menu_bg2.gif);
				background-repeat: no-repeat;
				text-align: center;
				display: block;
				margin: 0px;
				padding: 0px;
				height: 26px;
				width: 182px;
				text-decoration: none;
			}
		</style>
	</head>

	<body>
		<table width="100%" height="280" border="0" cellpadding="0" cellspacing="0" style="background-color:#EEF2FB;">
			<tr>
				<td width="182" valign="top">
				<div id="container">
					<h1 class="type"><a href="javascript:void(0)">网站常规设置</a></h1>
					<div class="content">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td><img src="__PUBLIC__/images/menu_topline.gif" width="182" height="5" /></td>
							</tr>
						</table>
						<ul class="MM">
							<li>
								<a href="__GROUP__/System/index" target="main">基本配置</a>
							</li>
							<li>
								<a href="__GROUP__/System/email" target="main">邮件配置</a>
							</li>
						</ul>
					</div>
					<h1 class="type"><a href="javascript:void(0)">会员管理</a></h1>
					<div class="content">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td><img src="__PUBLIC__/images/menu_topline.gif" width="182" height="5" /></td>
							</tr>
						</table>
						<ul class="MM">
							<li>
								<a href="__GROUP__/User/index" target="main">会员列表</a>
							</li>
							<li>
								<a href="__GROUP__/User/regUser" target="main">添加会员</a>
							</li>
						</ul>
					</div>
					<h1 class="type"><a href="javascript:void(0)">商品模块</a></h1>
					<div class="content">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td><img src="__PUBLIC__/images/menu_topline.gif" width="182" height="5" /></td>
							</tr>
						</table>
						<ul class="MM">
							<li>
								<a href="__GROUP__/Product/index" target="main">商品管理</a>
							</li>
							<li>
								<a href="__GROUP__/ProductType/index" target="main">类型管理</a>
							</li>
							<li>
								<a href="__GROUP__/ProductTypeAttr/index" target="main">属性管理</a>
							</li>
						</ul>
					</div>
					<h1 class="type"><a href="javascript:void(0)">订单管理</a></h1>
					<div class="content">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td><img src="__PUBLIC__/images/menu_topline.gif" width="182" height="5" /></td>
							</tr>
						</table>
						<ul class="MM">
							<li>
								<a href="__GROUP__/Order/index" target="main">订单列表</a>
							</li>
							<li>
								<a href="__GROUP__/Order/add" target="main">添加订单</a>
							</li>
						</ul>
					</div>
				</div><h1 class="type"><a href="javascript:void(0)"> 营销管理</a></h1>
				<div class="content">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td><img src="__PUBLIC__/images/menu_topline.gif" width="182" height="5" /></td>
						</tr>
					</table>
					<ul class="MM">
						<li>
							<a href="__GROUP__/Discount/index" target="main">活动列表</a>
						</li>
						<li>
							<a href="__GROUP__/Discount/add" target="main">添加活动</a>
						</li>
					</ul>
				</div><h1 class="type"><a href="javascript:void(0)">支付模块</a></h1>
				<div class="content">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td><img src="__PUBLIC__/images/menu_topline.gif" width="182" height="5" /></td>
						</tr>
					</table>
					<ul class="MM">
						<li>
							<a href="__GROUP__/Payment/index" target="main">支付管理</a>
						</li>

					</ul>
				</div><h1 class="type"><a href="javascript:void(0)">物流管理</a></h1>
				<div class="content">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td><img src="__PUBLIC__/images/menu_topline.gif" width="182" height="5" /></td>
						</tr>
					</table>
					<ul class="MM">
						<li>
							<a href="__GROUP__/Delivery/index" target="main">物流列表</a>
						</li>
						<li>
							<a href="__GROUP__/Delivery/add" target="main">添加物流</a>
						</li>
					</ul>
				</div><h1 class="type"><a href="javascript:void(0)">广告管理</a></h1>
				<div class="content">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td><img src="__PUBLIC__/images/menu_topline.gif" width="182" height="5" /></td>
						</tr>
					</table>
					<ul class="MM">
						<li>
							<a href="__GROUP__/Admanager/index" target="main">广告列表</a>
						</li>
						<li>
							<a href="__GROUP__/Admanager/add" target="main">添加广告</a>
						</li>
						<li>
							<a href="__GROUP__/Admanager/show" target="main">点击查看</a>
						</li>
					</ul>
				</div><!--	模板管理--><!--
				<h1 class="type"><a href="javascript:void(0)">模板管理</a></h1>
				<div class="content">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
				<td><img src="__PUBLIC__/images/menu_topline.gif" width="182" height="5" /></td>
				</tr>
				</table>
				<ul class="MM">
				<li>
				<a href="__GROUP__/Template/index" target="main">模板列表</a>
				</li>
				<li>
				<a href="__GROUP__/Template/upload" target="main">上传模板</a>
				</li>
				</ul>
				</div> -->
				<script type="text/javascript">
					var contents = document.getElementsByClassName('content');
					var toggles = document.getElementsByClassName('type');

					var myAccordion = new fx.Accordion(toggles, contents, {
						opacity : true,
						duration : 400
					});
					myAccordion.showThisHideOpen(contents[0]);
				</script></td>
			</tr>
		</table>
	</body>
</html>