<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
	<head>

		<title>index</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link href="__PUBLIC__/images/skin.css" rel="stylesheet" type="text/css" />
		<link href="__PUBLIC__/Css/admin.css" type="text/css" rel="stylesheet" />

	</head>

	<body>
		<form action="__URL__/insert" method="post">
			<table  width="98%" border="1" bordercolor="#003366" cellpadding="1" cellspacing="2" class="">
				<tr>
					<td width="20%" style="text-align: center;"> 网站名称: </td>
					<td>
					<input class="input1"   name="siteTitle" type="text" value="<?php echo ($param["siteTitle"]); ?>" />
					</td>
				</tr>
				<tr>
					<td width="20%" style="text-align: center;"> 域名: </td>
					<td>
					<input class="input1"  name="siteUrl" type="text" value="<?php echo ($param["siteUrl"]); ?>" />
					</td>
				</tr>
				<tr>
					<td width="20%" style="text-align: center;">SMTP</td>
					<td>
					<input class="input1"  name="smtpHost" type="text" value="<?php echo ($param["smtpHost"]); ?>" />
					</td>
				</tr>
				<tr>
					<td width="20%" style="text-align: center;">SMTP端口 </td>
					<td>
					<input class="input1"  name="smtpPort"	type="text" value="<?php echo ($param["smtpPort"]); ?>" />
					</td>
				</tr>
				<tr>
					<td width="20%" style="text-align: center;"> 邮箱 </td>
					<td>
					<input class="input1"  name="smtpUser" type="text" value="<?php echo ($param["smtpUser"]); ?>" />
					</td>
				</tr>
				<tr>
					<td width="20%" style="text-align: center;"> 密码 </td>
					<td>
					<input class="input1"  name="smtpPwd" type="text" value="<?php echo ($param["smtpPwd"]); ?>" />
					</td>
				</tr>

				<!-- <tr>
				<td> 网站名称: </td>
				<td>
				<input name="siteTile" type="text" />
				</td>
				</tr>
				<tr>
				<td> 网站名称: </td>
				<td>
				<input name="siteTile" type="text" />
				</td>
				</tr>
				<tr>
				<td> 网站名称: </td>
				<td>
				<input name="siteTile" type="text" />
				</td>
				</tr>
				<tr>
				<td> 网站名称: </td>
				<td>
				<input name="siteTile" type="text" />
				</td>
				</tr> -->
				<tr>
					<td> &nbsp; </td>
					<td>
					<input type="submit" value="保存" />
					</td>
				</tr>

			</table>
		</form>

	</body>
</html>