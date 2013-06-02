<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<script src="__PUBLIC__/Js/jquery.js" type="text/javascript"></script>
		<link href="__PUBLIC__/Css/admin.css" type="text/css" rel="stylesheet" />
		<title>index</title>
		<style>
			body {
				margin: 0px;
				background-color: #EEF2FB;
			}
			.input1 {
				width: 60%;
				border: 1px solid #003366;
			}
			a {
				text-decoration: none;
				color: #000000;
			}
		</style>
		<script>
			$(document).ready(function() {
				$(".viewOrder").click(function() {
					alert($(this).attr("uid"));
				});
				$(".del").click(function() {
					$.post("__URL__/delUser", {
						"uid" : $(this).attr("uid")
					}, function(data) {
						if (data.status === 0) {
							alert("失败");
						}

					}, 'json');
					$(this).parent().parent().remove();
				})
			})
		</script>

	</head>

	<body>
		<h3><a href="__URL__/regUser">添加会员</a></h3>
		<table  width="98%" height="31" border="1" bordercolor="#003366" cellpadding="1" cellspacing="2" class="">
			<thead class="tableHeader">
				<tr>
					<td>编号</td>
					<td>姓名</td>
					<td>邮箱</td>
					<td>地址</td>
					<td>注册ip</td>
					<td>注册时间</td>
					<td>最后登陆ip</td>
					<td>最后登陆时间</td>
					<td>操作</td>
				</tr>
			</thead>
			<tbody>
				<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
						<td><?php echo ($vo["id"]); ?></td>
						<td><?php echo ($vo["username"]); ?></td>
						<td><?php echo ($vo["email"]); ?></td>
						<td><?php echo ($vo["address"]); ?></td>
						<td><?php echo ($vo["regIp"]); ?></td>
						<td><?php echo ($vo["regTime"]); ?></td>
						<td><?php echo ($vo["lastLoginIp"]); ?></td>
						<td><?php echo ($vo["lastLoginTime"]); ?></td>
						<td><span class="viewOrder" uid="<?php echo ($vo["id"]); ?>">查看订单</span><span class="" uid="<?php echo ($vo["id"]); ?>"><a href="__URL__/pwd/uid/<?php echo ($vo["id"]); ?>">修改密码</a></span> &nbsp;<span class="" uid="<?php echo ($vo["id"]); ?>"><a href="__URL__/email/uid/<?php echo ($vo["id"]); ?>">修改邮箱</a></span> &nbsp;<span class="del" uid="<?php echo ($vo["id"]); ?>">删除</span></td>
					</tr><?php endforeach; endif; else: echo "" ;endif; ?>
			</tbody>
		</table>
	</body>
</html>