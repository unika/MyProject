<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
		<title>振天商城后台管理系统</title>
		<script>
			function logout() {
				if (confirm("您确定要退出系统吗？"))
					top.location = "__GROUP__/Public/logout";
				return false;
			}

			function showsubmenu(sid) {
				var whichEl = eval("submenu" + sid);
				var menuTitle = eval("menuTitle" + sid);
				if (whichEl.style.display == "none") {
					eval("submenu" + sid + ".style.display=\"\";");
				} else {
					eval("submenu" + sid + ".style.display=\"none\";");
				}
			}

			function showsubmenu(sid) {
				var whichEl = eval("submenu" + sid);
				var menuTitle = eval("menuTitle" + sid);
				if (whichEl.style.display == "none") {
					eval("submenu" + sid + ".style.display=\"\";");
				} else {
					eval("submenu" + sid + ".style.display=\"none\";");
				}
			}
		</script>
		<base target="main">
		<link href="__PUBLIC__/images/skin.css" rel="stylesheet" type="text/css" />
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
		<meta http-equiv="refresh" content="60">
	</head>
	<body style="margin-left:0; margin-top: 0">
		<table width="100%" height="64" border="0" cellpadding="0" cellspacing="0" class="admin_topbg">
			<tr>
				<td width="61%" height="64"><h1 style="padding: 0px; width: 262px; color: rgb(255, 255, 255); font-family: Arial,Helvetica,sans-serif; font-size: 16px; margin: 0px 0px 20px 10px;">振天商城后台管理系统</h1><!-- <img src="__PUBLIC__/images/logo.gif" width="262" height="64"> --></td>
				<td width="39%" valign="top">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td width="74%" height="38" class="admin_txt">管理员：<b>admin</b> 您好,感谢登陆使用！</td>
						<td width="22%"><a href="#" target="_self" onclick="logout();"><img src="__PUBLIC__/images/out.gif" alt="安全退出" width="46" height="20" border="0"></a></td>
						<td width="4%">&nbsp;</td>
					</tr>
					<tr>
						<td height="19" colspan="3">&nbsp;</td>
					</tr>
				</table></td>
			</tr>
		</table>
	</body>
</html>