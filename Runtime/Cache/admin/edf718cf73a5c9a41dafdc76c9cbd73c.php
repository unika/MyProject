<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<script src="__PUBLIC__/Js/jquery.js" type="text/javascript"></script>
		<script src="__PUBLIC__/Js/fancybox/fancybox.js" type="text/javascript"></script>
		<script src="__PUBLIC__/Js/my.js" type="text/javascript"></script>
		<script src="__PUBLIC__/Js/fancybox/jquery.mousewheel-3.0.6.pack.js" type="text/javascript"></script>
		<link href="__PUBLIC__/Js/fancybox/fancybox.css" type="text/css" rel="stylesheet" />
		<link href="__PUBLIC__/Css/admin.css" type="text/css" rel="stylesheet" />
		<script src="__PUBLIC__/Js/editor/kindeditor.js" type="text/javascript"></script>

		<title>add</title>
		<script>
			var editor;
			KindEditor.ready(function(K) {
				editor = K.create('#content');
			});

			$(document).ready(function(data) {
				$("#ProductTypeId").change(function() {
					$(".attr tbody").empty();
					$.post("__GROUP__/ProductTypeAttr/getTypeAttr", {
						'ProductTypeId' : $(this).val(),
					}, function(data) {
						if (data.status == 1) {
							var html = new String();
							$.each(data.data, function(index, item) {
								html += '<tr>';
								html += '<td>' + item.Name + '</td>';
								html += '<td><input type="text" name="AttrValue[' + item.Name + ']" value=""></td>';
								html += '</tr>';
							});
							$(".attr tbody").append(html);
						}

					}, 'json');

				})
			})
		</script>
	</head>
	<body>

		<div class="formPanel">
			<form action="__URL__/insert" method="post">
				<table>
					<tbody>
						<tr>
							<td>选择商品类型</td>
							<td>
							<select name="ProductTypeId" id="ProductTypeId">
								<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
							</select></td>
						</tr>
						<tr>
							<td> 产品属性： </td>
							<td>
							<table class="attr">
								<tbody >

								</tbody>
							</table></td>
						</tr>

						<tr>
							<td> 产品名称： </td>
							<td>
							<input type="text" style="width: 450px;" class="tipInput inputTip" name="Name">
							<span mode="border" class="valid"></span></td>
						</tr>
						<tr>
							<td> 页面标题： </td>
							<td>
							<input type="text" style="width: 500px;" class="tipInput inputTip" name="Page_Title">
							</td>
						</tr>
						<tr>
							<td> 页面关键字： </td>
							<td>
							<input type="text" style="width: 500px;" class="tipInput inputTip" name="Page_Keyword">
							</td>
						</tr>
						<tr>
							<td> 页面描述： </td>
							<td>
							<input type="text" style="width: 500px;" class="tipInput inputTip" name="Page_Description">
							</td>
						</tr>
						<tr>
							<td> URL： </td>
							<td>
							<input type="text" style="width: 500px;" class="tipInput inputTip" name="Page_Url">
							</td>
						</tr>
						<tr>
							<td> 产品关联标识： </td>
							<td>
							<input type="text" style="width: 500px;" class="tipInput inputTip" name="SerialIden">
							</td>
						</tr>

						<tr>
							<td> 价钱： </td>
							<td>
							<input type="text" id="ppr" style="width: 100px;" class="tipInput inputTip" name="Price">
							<span rule="money" mode="border" class="valid"></span>美元 </td>
						</tr>
						<tr>
							<td> 市场价钱： </td>
							<td>
							<input type="text" id="pmpr" style="width: 100px;" class="tipInput inputTip" name="MarketPrice">
							<span rule="money" mode="border" class="valid"></span>美元 </td>
						</tr>
						<tr>
							<td> 库存： </td>
							<td>
							<select name="DbNum" id="ddlDbNum">
								<option value="1">有货</option>
								<option value="0">无货</option>
							</select></td>
						</tr>
						<tr>
							<td> 状态： </td>
							<td>
							<select name="Status" id="Select1">
								<option value="1">正常</option>
								<option value="0">已下架</option>
							</select></td>
						</tr>
						<tr>
							<td> 产品描述： </td>
							<td>							<textarea id="content" name="Des" rows="10" cols="80"></textarea></td>
						</tr>
						<tr>

							<td colspan="2">
							<input type="submit" value="添加" id="Submit1">
							</td>
						</tr>
					</tbody>
				</table>
			</form>
		</div>
	</body>
</html>