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

<style>
	h3 {
		background: none repeat scroll 0 0 #CCCCCC;
		font-size: 16px;
		font-weight: normal;
		height: 26px;
		line-height: 26px;
		margin: 0;
		padding: 2px;
		text-align: left;
	}
	p {
		margin: 5px;
		text-align: left;
	}

</style>
<body>

	<form id="form2" method="post" action="__URL__/index2">
		<h3>请选择物流公司</h3>
		<?php if(is_array($delivery)): $i = 0; $__LIST__ = $delivery;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><p>
				<input type="radio" name="delivery" id="delivery" value="<?php echo ($vo["id"]); ?>" />
				<?php echo ($vo["name"]); ?>
				<?php echo ($vo["price"]); ?>RMB
			</p><?php endforeach; endif; else: echo "" ;endif; ?>
		<h3>付款方式</h3>
		<?php if(is_array($paymethod)): $i = 0; $__LIST__ = $paymethod;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><p>
				<input type="radio" name="paymethod" id="paymethod" value="<?php echo ($vo["id"]); ?>" />
				<?php echo ($vo["name"]); ?>
			</p><?php endforeach; endif; else: echo "" ;endif; ?>
		<?php if(is_array($info)): foreach($info as $key=>$vo): ?><input type="hidden" name="<?php echo ($key); ?>" value="<?php echo ($vo); ?>" /><?php endforeach; endif; ?>
		<input type="submit" value="下一步" />
	</form>

</body>
</html>