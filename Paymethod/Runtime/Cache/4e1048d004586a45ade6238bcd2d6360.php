<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title>index</title>

		<script src="http://code.jquery.com/jquery.js"></script>
		<style>
			body {
				margin: auto;
				text-align: center;
				width: 1002px;
			}
			a {
				text-decoration: none;
				color: #000000;
			}
			ul {
				padding: 0px;
				margin: 0px;
			}
			li {
				list-style: none;
				margin: 5px;
				float: left;
				width: 200px;
			}
		</style>
	</head>
	<body>

<body>
	<form id="form1" action="https://payment.payitrust.com/Payment/PayPage.aspx">
		<?php if(is_array($goods)): $i = 0; $__LIST__ = $goods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="goods">
				<label> <?php echo ($vo["id"]); ?></label>

				<label><?php echo ($vo["name"]); ?>
					<?php if(is_array($vo["attr"])): foreach($vo["attr"] as $key=>$sub): ?><span><?php echo ($sub); ?></span><?php endforeach; endif; ?> </label>
				<label><?php echo ($vo["price"]); ?></label>
				<label><?php echo ($vo["number"]); ?></label>
				<label><?php echo ($vo["discount"]); ?></label>

			</div><?php endforeach; endif; else: echo "" ;endif; ?>
		<div>
			总数:<span class="total_number"><?php echo ($total_number); ?></span>
			总价:<span class="total_price"><?php echo ($total_price); ?></span>
			优惠:<span class="coupon_price"><?php echo ($coupon_price); ?></span>
			优惠券:<span class="coupon"><?php echo ($coupon); ?></span>
		</div>
		<?php if(is_array($info)): foreach($info as $key=>$vo): switch($key): case "remark": if(is_array($vo)): foreach($vo as $subkey=>$subvo): ?><input type="hidden" name="<?php echo ($subkey); ?>" value="<?php echo ($subvo); ?>" /><?php endforeach; endif; break;?>
				<?php case "product": if(is_array($vo)): foreach($vo as $subkey=>$subvo): ?><input type="hidden" name="<?php echo ($subkey); ?>" value="<?php echo ($subvo); ?>" /><?php endforeach; endif; break;?>
				<?php default: ?>
				<input type="hidden" name="<?php echo ($key); ?>" value="<?php echo ($vo); ?>" /><?php endswitch; endforeach; endif; ?>

		<div>
			<button>
				确认支付
			</button>
		</div>
	</form>
</body>
</html>