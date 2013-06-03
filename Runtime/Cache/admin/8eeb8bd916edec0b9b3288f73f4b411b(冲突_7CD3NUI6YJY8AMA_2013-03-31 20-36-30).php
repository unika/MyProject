<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title>index</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<script src="__PUBLIC__/Js/jquery.js" type="text/javascript"></script>
		<script src="__PUBLIC__/Js/fancybox/fancybox.js" type="text/javascript"></script>
		<script src="__PUBLIC__/Js/my.js?v=time()" type="text/javascript"></script>
		<script src="__PUBLIC__/Js/fancybox/jquery.mousewheel-3.0.6.pack.js" type="text/javascript"></script>
		<link href="__PUBLIC__/Js/fancybox/fancybox.css" type="text/css" rel="stylesheet" />
		<link href="__PUBLIC__/Css/admin.css" type="text/css" rel="stylesheet" />
		<script src="__PUBLIC__/Js/artDialog/jquery.artDialog.min.js" type="text/javascript"></script>
		<script src="__PUBLIC__/Js/artDialog/artDialog.plugins.min.js" type="text/javascript"></script>
		<link href="__PUBLIC__/Js/artDialog/skins/default.css" type="text/css" rel="stylesheet" />
		<script src="__PUBLIC__/Js/editor/kindeditor.js" type="text/javascript"></script>
		<style>
			span {
				cursor: pointer;
			}
		</style>
		<script>
			$(document).ready(function() {
				var editor;
				KindEditor.ready(function(K) {
					editor = K.create('#content');
				});
				copy_data();
				add_img();
				del_data();
				edit_data();
				$(".status").click(function() {
					if (confirm("确认" + $(this).text() + "?") === false) {
						return false;
					}
					if ($(this).text() === "上架" && $(this).attr("action", "up")) {
						change_status($(this).attr("aid"), $(this).attr("action"));
						$(this).text("下架");
						$(this).attr("aciton", "down");

					} else if ($(this).text() === "下架" && $(this).attr("action", "down")) {
						change_status($(this).attr("aid"), $(this).attr("action"));
						$(this).text("上架");
						$(this).attr("aciton", "up");
					}
					if ($(this).text() === "上架") {
						$(this).parent().parent().find(".status2").empty().append("已下架");
					} else {
						$(this).parent().parent().find(".status2").empty().append("正常");
					}

				})

				$(".comment").click(function() {
					$.post("__GROUP__/Comment/showComment", {
						"id" : $(this).attr("aid")
					}, function(data) {
						if (data) {
							$.dialog({
								title : "商品评论",
								content : "html",
							})
						}

					}, 'json');

				})
			})
			//更改商品状态status字段
			function change_status(id, action) {
				$.post("__URL__/changeStatus", {
					"id" : id,
					"action" : action
				}, function(data) {
					if (data.status === 0) {
						return false;
					}
				}, 'json');
			}

			function copy_data() {
				$(".copy").click(function() {
					$.post("__URL__/copyProduct", {
						"id" : $(this).attr("aid")
					}, function(data) {
						if (data.status === 0) {
							return false;
						} else {
							alert("ok");
						}
					}, 'json');
				})
			}

			function del_data() {
				$(".del").click(function() {
					if (confirm("确认删除?") === false) {
						return false;
					}
					$.post("__URL__/del", {
						'id' : $(this).attr('aid')
					}, function(data) {
						if (data.info == 0) {
							return false;
						}
					}, 'json');
					//动态删除这行
					$(this).parent().parent().remove();
				})
			}

			function add_img() {
				$(".addimg").click(function() {
					$.fancybox.open({
						href : '__URL__/viewImg.html?ProductId=' + $(this).attr("aid"),
						type : 'iframe',
						padding : 5,
					});
				})
			}

			function edit_data() {
				$(".edit").click(function() {
					$.getJSON("__URL__/getlist", {
						"id" : $(this).attr("aid")
					}, function(data) {
						var html = data.data.result;
						var abc = product_edit;

						$.alert($("#p_edit").find("id").val());
						$.dialog({
							title : "产品编辑",
							content : product_edit,
							okValue : "更新",
							ok : function() {
								$.post("__URL__/update", $("#p_edit").serilaer(), function(data) {
									$.alert(data.info.message);
								}, 'json')
							},
						});
					}, 'json');

					// $.fancybox.open({
					// href : '__URL__/edit.html?id=' + $(this).attr("aid"),
					// type : 'iframe',
					// padding : 5,
					// });
				})
			}
		</script>
	</head>
	<body>
		<h3>产品列表</h3>
		<table>
			<tbody>
				<tr>
					<td>
					<form>
						产品名称：
						<input type="text" value="" name="ProductName" style="width: 120px;" id="Text1">
						<input type="submit" value="搜索" id="Submit1">

					</form></td>
					<td style="text-align: right; padding-right: 10px;"><a class="add" href="__URL__/add"> 新增产品</a></td>
				</tr>
			</tbody>
		</table>
		<table cellspacing="1" cellpadding="3" id="dataAdminList" style="width: 100%;">
			<tbody>

				<tr class="tableHeader">
					<td> 编号 </td>
					<td> 产品名称 </td>
					<td> 产品价格 </td>
					<td> 产品图片 </td>
					<td> 产品类型 </td>
					<td> 库存 </td>
					<td> 产品上架时间 </td>
					<td> 产品状态 </td>
					<td> 操作 </td>
				</tr>
				<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="tableItems">
						<td> <?php echo ($vo["id"]); ?> </td>
						<td> <?php echo ($vo["product_name"]); ?> </td>
						<td> <?php echo ($vo["Price"]); ?> </td>
						<td><img width="100px" height="100px" src="/Upload/Product/<?php echo ($vo["Img"]); ?>"></td>
						<td> <?php echo ($vo["Type_name"]); ?> </td>
						<!-- 显示状态 -->
						<td>
						<?php if(($vo["DbNum"]) == "1"): ?>有货
							<?php else: ?>
							无货<?php endif; ?></td>
						<td> <?php echo ($vo["AddTime"]); ?> </td>
						<td class="status2">
						<?php if(($vo["Status"]) == "1"): ?>正常
							<?php else: ?>
							已下架<?php endif; ?></td>
						<td><span class="view">查看属性</span>｜ <span class="edit" aid="<?php echo ($vo["id"]); ?>">编辑</span>｜ <span class="copy" aid="<?php echo ($vo["id"]); ?>">复制</span>｜ <span class="del" aid="<?php echo ($vo["id"]); ?>">删除</span>｜ <span class="addimg" aid="<?php echo ($vo["id"]); ?>">图片</span>｜
						<?php if(($vo["Status"]) == "1"): ?><span class="status" action="down" aid=<?php echo ($vo["id"]); ?> >下架</span>
							<?php else: ?>
							<span class="status" action="up" aid=<?php echo ($vo["id"]); ?>>上架</span><?php endif; ?> ｜<span class="comment" action="up" aid=<?php echo ($vo["id"]); ?>>产品评论</span></td>
					</tr><?php endforeach; endif; else: echo "" ;endif; ?>
			</tbody>
		</table>

		<!-- 分页 -->
		<div>
			<div class="turnpage">
				<?php echo ($page); ?>
			</div>
		</div>
	</body>
</html>