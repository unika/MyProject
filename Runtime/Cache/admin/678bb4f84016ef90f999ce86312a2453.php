<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
	<head>

		<title>regUser</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<script src="__PUBLIC__/Js/jquery.js"></script>
		<link href="__PUBLIC__/Css/admin.css" type="text/css" rel="stylesheet" />
	</head>
	<body>

		<form action="__URL__/addUser" method="post">
			<table width="98%" border="1">
				<tr>
					<td width="20%"><label>用户名</label></td><td>
					<input class="input1" name="username" type="text" />
					</td>
				</tr>
				<tr>
					<td width="20%"><label>密码</label></td><td>
					<input class="input1" name="password" type="password" />
					</td>
				</tr>

				<tr>
					<td width="20%"><label>邮箱</label></td><td>
					<input class="input1" name="email" type="text" />
					</td>
				</tr>
				<tr>
					<td width="20%">&nbsp;</td><td>
					<input class="Submit" type="submit" value="添加" />
					</td>

				</tr>

			</table>

		</form>
	</body>
</html>