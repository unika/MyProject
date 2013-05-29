<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title>mycart</title>
		<link rel="stylesheet" type="text/css" href="__PUBLIC__/Css/basic.css" />
		<script type="text/javascript" src="http://code.jquery.com/jquery.js"></script>
	</head>
	<script>
		$(document).ready(function() {
			$("#empty").click(function() {
				$.post("__URL__/clearCart", {}, function(data) {
					if (data.status == 1) {
						$(".goods").remove();
						$(".total_number").text(0);
						$(".total_price").text(parseFloat(0.00));
					} else {
						alert(data.info);
					}
				}, "json")
			})

			$("#validate").click(function() {
				var obj = $(this);
				$.post("__URL__/checkCoupon", {
					"coupon" : $("#coupon").val(),
				}, function(data) {
					if (data.status == 1) {
						obj.attr("disabled", "disabled");
						$("#empty").after("<span style='color:red;'>优惠金额:" + data.data.coupon_price + "<span>");
					} else {
						obj.removeAttr("disabled");
						alert(data.info);
					}
				}, "json")
			})
			var number;
			var key;

			$(".add").click(function() {
				var obj = $(this).parent().find("input[name='number']");
				key = obj.parents().find("label:first span").text();
				number = parseInt(obj.val()) + 1;
				obj.val(number);
				$.post("__URL__/addgood", {
					"key" : key,
					"number" : number,
				}, function(data) {
					if (data.status == 1) {
						$(".total_number").text(data.data.total_number);
						$(".total_price").text(data.data.total_price);
					} else {
						alert(data.info);
					}

				}, 'json')

			})

			$(".del").click(function() {
				var obj = $(this).parent().find("input[name='number']");
				key = obj.parents().find("label:first span").text();
				if (parseInt(obj.val()) == 1) {
					if (confirm("确认删除商品?")) {
						$.post("__URL__/removeGood", {
							'key' : key,
							'number' : number
						}, function(data) {
							if (data.status == 1) {
								$(".total_number").text(data.data.total_number);
								$(".total_price").text(data.data.total_price);

								obj.parents(".goods").remove();
							} else {
								alert(data.info);
							}

						}, 'json')
					} else {
						return false;
					}

				} else {
					number = parseInt(obj.val()) - 1;
					obj.val(number);
					$.post("__URL__/delgood", {
						"key" : key,
						"number" : number,
					}, function(data) {
						if (data.status == 1) {
							$(".total_number").text(data.data.total_number);
							$(".total_price").text(data.data.total_price);

						} else {
							alert(data.info);
						}

					}, 'json')
				}

			})
			$("#order").click(function() {
				window.location.href = "__APP__/Order";
			})
		})
	</script>
	<body>
		<h3>我的购物车</h3>
		<form onsubmit="return false;" id="form1">
			<div id="cart">
				<div class="cart_head">
					<label>产品编号</label>
					<label>产品图片</label>
					<label>产品名称</label>
					<label>产品属性</label>
					<label>是否参与活动</label>
					<label>产品价格</label>
				</div>
				<?php if(is_array($goods)): foreach($goods as $key=>$vo): ?><div class="goods">
						<label><span><?php echo ($key); ?></span> </label>
						<label><span><?php echo ($vo["id"]); ?></span></label>
						<label><span><?php echo ($vo["image"]); ?></span></label>
						<label><span><?php echo ($vo["name"]); ?></span></label>
						<?php if(is_array($vo["attr"])): foreach($vo["attr"] as $subkey=>$subvo): ?><label><span><?php echo ($subvo); ?></span></label><?php endforeach; endif; ?>
						<input type="image" alt="++++" class="add" />
						<input type="text" name="number" value="<?php echo ($vo["number"]); ?>" />
						<input type="image" alt="----" class="del" />
						<label><span><?php echo ($vo["discount"]); ?></span></label>
						<label><span><?php echo ($vo["price"]); ?></span></label>
					</div><?php endforeach; endif; ?>
				<div class="info">
					<span>
						<input type="text" name="coupon" id="coupon" value="201305261718" />
					</span>
					<button id="validate">
						提交
					</button>

					<button id="empty">
						清空购物车
					</button>
					<label>总价</label><span class="total_price"> <?php echo ($total_price); ?> </span>
					<label>总数</label><span class="total_number"> <?php echo ($total_number); ?> </span>
				</div>
				<div style="text-align: right;">
					<button id="order">
						提交订单
					</button>
				</div>
				<div class="clear"></div>
			</div>
		</form>
	</body>
</html>