<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<script src="http://code.jquery.com/jquery.js"></script>
		<title>show</title>
		<style>
			span {
				border: 1px solid #CCCCCC;
				display: block;
				float: left;
				margin: 2px;
				text-align: center;
				width: 40px;
				cursor: pointer;
			}
			label {
				display: block;
				float: left;
				font-weight: 600;
				width: 100px;
			}
			.selected {
				background: #008000;
			}
			div {
				clear: both;
			}
			input {
				text-align: center;
				width: 20px;
			}

		</style>
	</head>
	<script>
		$(document).ready(function() {
			$("div span").click(function() {
				if ($(this).hasClass("selected")) {
					$(this).removeClass("selected");
				} else {
					$(this).addClass("selected");
					$(this).parent().find("span").not(this).removeClass("selected");

				}
			})
			$("#add").click(function() {
				var attr = new Array();
				$("#attr span").each(function() {
					if ($(this).hasClass("selected")) {
						attr.push($(this).attr("name") + ":" + $(this).attr("value"));
					}
				})
				$.post("__URL__/addCart", {
					"id" : $("#id").text(),
					"name" : $("#title").text(),
					"attr" : attr,
					"number" : $("input[name='number']").val(),
					"price" : parseInt($("#price").text()),
					"marke_price" : parseInt($("#marke_price").text()),
					"discount" : $("#discount").text(),

				}, function(data) {
					if (data.status == 1) {
						alert(data.info);
					} else {
						alert(data.info);
					}
				}, 'json');
			})
			$("#clear").click(function() {
				$.post("__URL__/clearCart", {}, function(data) {
					if (data.status == 1) {
						alert(data.info);
					} else {
						alert(data.info);
					}

				}, "json")
			})
		})
	</script>
	<body>
		<form onsubmit="return false;" id="goods">
			<h3>名称:<label id="title"><?php echo ($name); ?></label>-------------<?php echo ($id); ?></h3>
			<h4>产品编号:<label id="id"><?php echo ($id); ?></label></h4>
			<?php if(is_array($attr)): foreach($attr as $keys=>$vo): ?><foreach name="attr" key="keys" item="vo">
					<div id="attr">
						<label><?php echo ($keys); ?></label>
						<?php if(is_array($vo)): $i = 0; $__LIST__ = $vo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$subvo): $mod = ($i % 2 );++$i;?><span name="<?php echo ($keys); ?>" value="<?php echo ($subvo); ?>"><?php echo ($subvo); ?></span><?php endforeach; endif; else: echo "" ;endif; ?>
					</div><?php endforeach; endif; ?>
				<div>
					<label>数量:</label>
					<input type="text" name="number" value="1" />
				</div>
				<div>
					<label>价格:</label>
					<p id="price">
						<?php echo ($price); ?>
					</p>
				</div>
				<div>
					<label>市场价</label>
					<p id="marke_price">
						<?php echo ($marke_price); ?>
					</p>
				</div>
				<div>
					<label>所属活动:</label>
					<p id="discount">
						<?php echo ($discount); ?>
					</p>

				</div>
				<button id="add">
					加入购物车
				</button>
				<a href="__URL__/mycart" target="_blank">查看购物车</a>
		</form>

	</body>
</html>