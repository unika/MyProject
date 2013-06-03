<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title>商城后台管理系统</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<script src="__PUBLIC__/Js/jquery.js" type="text/javascript"></script>
		<script src="__PUBLIC__/Js/my.js" type="text/javascript"></script>
		<script src="__PUBLIC__/Js/jquery-ui.js" type="text/javascript"></script>
		<script src="__PUBLIC__/Js/artDialog/jquery.artDialog.min.js" type="text/javascript"></script>
		<script src="__PUBLIC__/Js/artDialog/artDialog.plugins.min.js" type="text/javascript"></script>
		<script src="__PUBLIC__/Js/editor/kindeditor.js" type="text/javascript"></script>
		<link href="__PUBLIC__/Js/artDialog/skins/default.css" type="text/css" rel="stylesheet" />
		<link href="__PUBLIC__/Css/admin.css" type="text/css" rel="stylesheet" />
		<link href="__PUBLIC__/Js/jquery-ui.css" type="text/css" rel="stylesheet" />
		<script src="__PUBLIC__/Js/jquery-ui.js" type="text/javascript"></script>	
	</head>


<script>
	$("document").ready(function() {
		$("#submit").click(function() {
			$.post("__URL__/insert", $("#sys").serialize(), function(data) {
				$.alert(data.info);
			}, 'json');
		})
		$("#file").click(function() {
			$.dialog({
				title : "选择水印图片",
				content : uploadimage("__URL__/uploadfile"),
				okValue : "上传",
				ok : function() {
					$("#image").submit();
					return false;
				},
				cancelValue : "取消",
				cancel : function() {
					this.close()
				},
			})

		})
	})
</script>
<h1>基本信息</h1>
<body>
	<form id="sys" onsubmit="return false;" method="post">
		<table>
			<tr>
				<td width="20%" style="text-align: center;">网站名称</td>
				<td>
				<input class="input1"   name="siteTitle" type="text" value="<?php echo ($param["siteTitle"]); ?>" />
				</td>
			</tr>
			<tr>
				<td width="20%" style="text-align: center;">域名</td>
				<td>
				<input class="input1"  name="siteUrl" type="text" value="<?php echo ($param["siteUrl"]); ?>" />
				</td>
			</tr>
			<tr>
				<td width="20%" style="text-align: center;">SEO关键字</td>
				<td>
				<input class="input1"  name="keywords" type="text" value="<?php echo ($param["keywords"]); ?>" />
				</td>
			</tr>
			<tr>
				<td width="20%" style="text-align: center;">SEO描述</td>
				<td>				<textarea class="input1"  name="description"><?php echo ($param["description"]); ?></textarea></td>
			</tr>
			<tr>
				<td width="20%" style="text-align: center;">水印</td>
				<td>
				<?php if(($param["water"]) == "true"): ?><input name="water" type="checkbox" checked="checked" />
					<?php else: ?>
					<input name="water" type="checkbox" /><?php endif; ?><span class="tip">针对产品图有效</span></td>
			</tr>
			<tr>
				<td width="20%" style="text-align: center;">水印图片</td>
				<td><img style="width: 200px;height: 200px;" id="img" name="img" src="/Conf/<?php echo ($param["image"]); ?>" />
				<button id="file">
					上传
				</button><span class="tip">针对产品图有效(水印图片大小请在200*200以内) </span></td>
			</tr>
			<tr>

				<td width="20%" style="text-align: center;">商户号</td>
				<td>
				<input class="input1" type="text" id="merchantid" name="merchantid" value="<?php echo ($param["merchantid"]); ?>" />
				</td>

			</tr>
			<tr>

				<td width="20%" style="text-align: center;">证书号</td>
				<td>				<textarea class="input1" id="orderhash" name="orderhash" style="width: 582px; height: 115px;"><?php echo ($param["orderhash"]); ?></textarea></td>

			</tr>
			<tr>
				<td width="20%" style="text-align: center;">透明度</td>
				<td>
				<input  class="input1" style="width:30px;" type="text" name="alpha" id="alpha" value="<?php echo ($param["alpha"]); ?>"/>
				<span class="tip">水印图透明度 1-100%,值越低,越透明(默认为80%)</span></td>
			</tr>
			<tr>
				<td  width="20%" style="text-align: center;">缩略图</td>
				<td>
				<?php if(($param["thumb"]) == "true"): ?><input name="thumb" type="checkbox" checked="checked" />
					<?php else: ?>
					<input name="thumb" type="checkbox" /><?php endif; ?><span class="tip">针对产品图 </span></td>
			</tr>
			<tr>
				<td  width="20%" style="text-align: center;">缩略图宽</td>
				<td>
				<?php if(isset($param["thumbMaxWidth"])): ?><input  class="input1" name="thumbMaxWidth" type="text" value="<?php echo ($param["thumbMaxWidth"]); ?>" />
					<?php else: ?>
					<input  class="input1" name="thumbMaxWidth" type="text" value="" /><?php endif; ?><span class="tip">多张请用,分割如要生成两张缩略图,请填写:200,300</span></td>
			</tr>
			<tr>
				<td  width="20%" style="text-align: center;">缩略图高</td>
				<td>
				<?php if(isset($param["thumbMaxHeight"])): ?><input  class="input1" name="thumbMaxHeight" type="text" value="<?php echo ($param["thumbMaxHeight"]); ?>" />
					<?php else: ?>
					<input  class="input1" name="thumbMaxHeight" type="text" value="" /><?php endif; ?><span class="tip">多张请用,分割如要生成两张缩略图,请填写:200,300</span></td>
			</tr>
			<tr>
				<td  width="20%" style="text-align: center;">缩略图前缀</td>
				<td>
				<?php if(isset($param["thumbPrefix"])): ?><input  class="input1" name="thumbPrefix" type="text" value="<?php echo ($param["thumbPrefix"]); ?>" />
					<?php else: ?>
					<input  class="input1" name="thumbPrefix" type="text" value="" /><?php endif; ?><span class="tip">图片water.png如设置了:m_,s_将生成m_water.png,s_water.png</span></td>
			</tr>

			<tr>
				<td  width="20%" style="text-align: center;">页面统计代码</td>
				<td>				<textarea  class="input1" name="tongji" id="tongji"  style="width: 380px; height: 136px;"><?php echo ($param["tongji"]); ?></textarea><span class="tip">统计代码,请贴入代码</span></td>
			</tr>
			<tr>
				<td  width="20%" style="text-align: center;">在线客服代码</td>
				<td>				<textarea  class="input1" name="im" id="im"  style="width: 380px; height: 136px;"><?php echo ($param["im"]); ?></textarea><span class="tip">在线客服代码,请贴入代码</span></td>
			</tr>
			<tr>
				<td> &nbsp; </td>
				<td>
				<input id="submit" type="image" value="保存" />
				</td>
			</tr>

		</table>
	</form>

</body>
</html>