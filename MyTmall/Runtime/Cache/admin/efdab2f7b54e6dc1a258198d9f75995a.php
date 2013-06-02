<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title>上传图片</title>
		<script src="__PUBLIC__/Js/jquery.js" type="text/javascript"></script>
		<link href="__PUBLIC__/Css/admin.css" type="text/css" rel="stylesheet" />
		<script>
			$(document).ready(function(data) {
				$(".del").click(function() {
					if (confirm("确定删除图片?") == false) {
						return false;
					}
					$.post("__URL__/delImg", {
						"id" : $(this).attr('aid')
					}, function(data) {
						if (data.status == 0) {
							return false;
						}
					}, 'json');
					$(this).parent().parent().remove();
				})
				$(".action").click(function() {
					/*
					 * 主图是一长还是多张
					 */
					$.post("__URL__/setImg", {
						"id" : $(this).attr('aid'),
						"action" : $(this).attr("action")

					}, function(data) {
						if (data.info === 0) {
							return false;
						}
						info = data.info;
					}, 'json');

					if (info === "1") {
						info = "是";
					} else if (info === "2") {
						info = "否";
					}
					$(this).parent().parent().find(".useType").empty().append(info);
				})
			})
		</script>

	</head>
	<body>
		<?php if(empty($list)): ?><!-- 图片变量空 -->
			还未上传过产品图片
			<?php else: ?>
			<!-- 图片变量不为空循环读取 -->

			<div class="adminMainPanel">
				<table cellspacing="1" cellpadding="3" id="dataAdminList" style="width: 100%;">
					<tbody>
						<tr class="tableHeader">
							<td>编号</td>
							<td>图片</td>
							<td>模特图</td>
							<td>操作</td>
						</tr>
						<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="tableItems">
								<td> <?php echo ($vo["id"]); ?></td>
								<td><img width="100px" height="100px" src="/Upload/Product/<?php echo ($vo["Img"]); ?>" /></td>
								<td class="useType"><!--通过UserType字段判断图片类型-->
								<?php if(($vo["UseType"]) == "2"): ?>是
									<?php else: ?>
									否<?php endif; ?></td>
								<td> <?php echo ($vo["UseType"]); ?>
								<input type="radio" class="main" <?php if(($vo["UseType"]) == "1"): ?>checked="checked"<?php endif; ?>  />
								主图<span class="action" aid="<?php echo ($vo["id"]); ?>" action="main">设置主图</span> ｜<span class="action" aid="<?php echo ($vo["id"]); ?>" action="model">设置模特图</span>｜<span class="del" aid="<?php echo ($vo["id"]); ?>">删除</span></td>

							</tr><?php endforeach; endif; else: echo "" ;endif; ?>
					</tbody>

				</table>
				<div>
					<!--ajax分页--->

				</div>
			</div><?php endif; ?>
		<!--可以修改成ajax上传--->
		<form action="__URL__/addImg" method="post" enctype="multipart/form-data" >
			<input type="file" name="image" />
			<input type="hidden" name="ProductId" value="<?php echo ($Pid); ?>" />
			<input type="submit" value="提交" />
		</form>
	</body>
</html>