<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<title><?php echo ($title); ?></title>
		<meta name="description" content="<?php echo ($description); ?>">
		<meta name="keywords" content="<?php echo ($keywords); ?>">
		<script src="__PUBLIC__/Js/jquery.js" type="text/javascript"></script>
		<script src="__PUBLIC__/Js/city.js" type="text/javascript"></script>
		<script src="__PUBLIC__/Js/common.js" type="text/javascript"></script>
		<script src="__PUBLIC__/Js/artDialog/jquery.artDialog.min.js" type="text/javascript"></script>
		<script src="__PUBLIC__/Js/artDialog/artDialog.plugins.min.js" type="text/javascript"></script>
		<script src="__PUBLIC__/Js/jquery-ui.js" type="text/javascript"></script>
		<link rel="stylesheet" href="__PUBLIC__/Js/jquery-ui.css" type="text/css" />
		<link rel="stylesheet" href="__PUBLIC__/Js/artDialog/skins/default.css" type="text/css" />
		<link rel="stylesheet" href="__MYSTYLE__Css/style.css" type="text/css" />
		<link rel="stylesheet" href="__MYSTYLE__Css/public.css" type="text/css" />
		<link rel="stylesheet" href="__MYSTYLE__Css/pay.css" type="text/css" />
	</head>
	<body>
		<div class="wrapper">
			<div id="head">
				<div class=" header">
					<h1><a target="_top" title="" href="/">
						 <img title="Cheap Oakley Sunglasses,Wholesale Oakley Sunglasses,Discount Oakley Sunglasses" alt="Cheap Oakley Sunglasses,Wholesale Oakley Sunglasses,Discount Oakley Sunglasses" src="__MYSTYLE__Images/logo.jpg" align="left"></a></h1>
					<div class="cur_search">
						<div class="cart">
							<?php if(empty($_SESSION['cart']['total_number'])): ?><a target="_top" href="/Cart" rel="nofollow" class="sys_cart">My Bag:( <span id="item">0</span> items)</a>
								<?php else: ?>
								<a target="_top" href="/Cart" rel="nofollow" class="sys_cart">My Bag:( <span id="item"><?php echo ($_SESSION['cart']['total_number']); ?></span> items)</a><?php endif; ?>
							<a target="_top" href="/Order/checkout" rel="nofollow" class="check">Checkout</a>
							<div id="showcart"></div>
						</div>
						<!--顶部登陆框Widget开始-->
						<ul>
							<?php if(empty($_SESSION['username'])): ?><li class="sys_Reg shu_clear">
									<a href="__ROOT__/Public/login">login</a>
									<a href="__ROOT__/Public/register">register</a>
								</li>
								<?php else: ?>
								<li class="sys_login">
									<span style="color: #000000;"> <a href="__ROOT__/User/index"><?php echo (session('username')); ?> </a> </span>
									<a href="__ROOT__/Public/logout">logout</a>
								</li><?php endif; ?>
						</ul>
						<!--顶部登陆框Widget结束-->
						<div class=" clear"></div>
						<div id="cur">
							<!-- <label>
							<input id="currencylist0" name="currencylist" value="USD" checked="checked" type="radio">
							USD</label><label>
							<input id="currencylist1" name="currencylist" value="GBP" type="radio">
							GBP</label><label>
							<input id="currencylist2" name="currencylist" value="CAD" type="radio">
							CAD</label><label>
							<input id="currencylist3" name="currencylist" value="CHF" type="radio">
							CHF</label><label>
							<input id="currencylist4" name="currencylist" value="EUR" type="radio">
							EUR</label> -->
						</div>
						<script>
                            $(document).ready(function() {
                                $('#Gstr').autocomplete({
                                    minLength : 0,
                                    max : 10,
                                    width : 10,
                                    autoFill : true,
                                    source : "/Public/productList",

                                });

                            })

						</script>
						<!--顶部搜索Widget开始-->
						<form method="post" name="mini-search" target="_blank" action="/Public/serach">
							<input id="go" value=""  alt="Search" src="__MYSTYLE__Images/go.jpg" type="image">
							<input value="" name="key" id="Gstr" type="text">
						</form>
						<!--顶部搜索Widget开始-->
					</div>
				</div>
				<div id="menu">
					<!--头部分类bar条Widget开始-->
					<a target="_top" class="home" href="__ROOT__/">home</a>
					<div class="curselt_div">
						<ul>
							<?php echo W("Category",array("count"=>10,"Display"=>"tree"));?>
						</ul>
						<!--头部分类bar条Widget开始-->
					</div>
				</div>
			</div>


<div id="main">
	<div class="fixed_big_from">
		<div class="fixed_from user_left">
			<div class="fixed_bottom">
				Account Manage
			</div>
			<ul class="fixed_content">
				<li>
					<a target="_top" href="__APP__/Cart/cart">My ShoppingCart</a>
				</li>
				<li>
					<a target="_top" href="__URL__/order">My Order</a>
				</li>
				<li>
					<a target="_top" href="__URL__/info"> My Informartion</a>
				</li>
				<li>
					<a target="_top" href="__URL__/pwd">Modify Password</a>
				</li>
				<li>
					<a target="_top" href="__APP__/Public/logout">Exit</a>
				</li>
			</ul>
		</div>
		<div class="fixed_from user_right">
			<!--密码修改widget开始-->
			<form name="UserForm" action="__URL__/updatePwd" method="post">
				<div class="fixed_content">
					<div class="fixed_title2">
						Modify Password
					</div>
					<div class="fixed_middle">
						<ol>
							<li>
								Initial Password:
							</li>
							<li>
								New Password:
							</li>
							<li>
								Confirm Password:
							</li>
						</ol>
						<ul>
							<li>
								<input class="fixed_text2" name="oldPwd" type="password">
							</li>
							<li>
								<input class="fixed_text2" name="password" maxlength="32" type="password">
								<span class="fixed_gray"> ( Use 4 to 32 characters )</span>
							</li>
							<li>
								<input class="fixed_text2" name="repassword" type="password">

							</li>
						</ul>
						<div class="clear"></div>
					</div>
				</div>
				<div class="fixed_bottom">
					<input name="submit" value="Update" class="fixed_btn" type="submit">
				</div>
			</form>
			<!--密码修改widget结束-->
		</div>
		<div class="clear"></div>
	</div>

</div>

<div class="clear"></div>

<div id="foot" class="pfoot">
	<img src="__MYSTYLE__Images/foot_top.jpg" usemap="#Map">
	<map name="Map" id="Map">
		<area rel="nofollow" target="_blank" shape="rect" coords="421,21,439,49" href="http://www.facebook.com/">
		<area rel="nofollow" target="_blank" shape="rect" coords="456,22,477,46" href="http://plus.google.com/">
		<area rel="nofollow" target="_blank" shape="rect" coords="489,23,508,46" href="http://www.pinterest.com/">
		<area rel="nofollow" target="_blank" shape="rect" coords="522,21,542,47" href="http://www.twitter.com/">
	</map>
	<div id="page">

		<dl>
			<dt>
				Corporation Information
			</dt>
			<dd>
				<a target="_top" href="http://www.usefulsunglasses.com/About-Us.html" rel="nofollow">About Us</a>
			</dd>
			<dd>
				|
			</dd>
			<dd>
				<a target="_top" href="http://www.usefulsunglasses.com/Safe-Shopping.html" rel="nofollow">Safe Shopping</a>
			</dd>
		</dl>

		<dl class="mk_dd1">
			<dt>
				Customer Service
			</dt>
			<dd>
				<a target="_top" href="javascript:dialog('/Contact_Add.html?ajax=true','674px','auto',null)" rel="nofollow">Contact Us</a>
			</dd>
			<dd>
				|
			</dd>
			<dd>
				<a target="_top" href="http://www.usefulsunglasses.com/Privacy-Policy.html" rel="nofollow">Privacy Policy</a>
			</dd>
			<dd>
				|
			</dd>
			<dd>
				<a target="_top" href="http://www.usefulsunglasses.com/FAQs.html" rel="nofollow">FAQs</a>
			</dd>
		</dl>

		<dl class="mk_dd1">
			<dt>
				Payment and Shipping
			</dt>
			<dd>
				<a target="_top" href="http://www.usefulsunglasses.com/OrderPay/CheckOut.aspx" rel="nofollow">Checkout</a>
			</dd>
			<dd>
				|
			</dd>
			<dd>
				<a target="_top" href="http://www.usefulsunglasses.com/UserCenter/Order/List.aspx" rel="nofollow">My Order</a>
			</dd>
		</dl>

		<dl class="mk_dd1">
			<dt>
				Company Policy
			</dt>
			<dd>
				<a target="_top" href="http://www.usefulsunglasses.com/Payment-Returns.html" rel="nofollow">Payment &amp; Returns</a>
			</dd>
			<dd>
				|
			</dd>
			<dd>
				<a target="_top" href="http://www.usefulsunglasses.com/Shipping-Charge.html" rel="nofollow">Shipping Charge</a>
			</dd>
		</dl>

	</div>

	<div class="clear"></div>
	<ul class="sys_links"></ul>
	<div id="bottom">
		<a target="_top" href="http://www.usefulsunglasses.com/sitemap.html">SiteMap</a><span class="common">Copyright © &nbsp;2012 <a target="_top" href="http://www.usefulsunglasses.com/">Cheap Oakley Sunglasses,Wholesale Oakley Sunglasses,Discount Oakley Sunglasses</a> Store Privacy Policy</span>
	</div>
</div>
<div style="display:none">
	<div class="clear"></div>
</div>
</body></html>