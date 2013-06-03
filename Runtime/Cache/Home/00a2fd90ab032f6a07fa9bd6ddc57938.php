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

<script>
    $(document).ready(function() {
        $(".delgoods").click(function() {
            var obj = $(this);
            var num = parseInt($(this).parents("tr").find(".num").val());
            if (num > 1) {
                num--;
                $(this).parents("tr").find(".num").val(num);
                $.post("__URL__/delgood", {
                    'key' : $(this).attr("aid"),
                    'number' : num,
                }, function(data) {
                    if (data.status == 1) {
                        $("#item").text(data.data.total_number);
                        $("#Total_num").text(data.data.total_number);
                        $("#Total_price").text(data.data.total_price);
                        $("#sys_Subtotal").text(data.data.total_price);
                        $("#sys_GrandTotal").text(parseFloat($("#Total_price").text() - $("#sys_Coupon").text()).toFixed(2));
                    } else {
                        $.alert(data.info);
                    }
                }, 'json');
            } else {
                $.confirm("确定要删除吗", function() {
                    $.post("__URL__/remove", {
                        'key' : obj.attr("aid"),
                    }, function(data) {
                        if (data.status == 1) {
                            obj.parents("tr").remove();
                            $("#item").text(data.data.total_number);
                            $("#Total_num").text(data.data.total_number);
                            $("#Total_price").text(data.data.total_price);
                            $("#sys_Subtotal").text(data.data.total_price);
                            $("#sys_GrandTotal").text(parseFloat($("#Total_price").text() - $("#sys_Coupon").text()).toFixed(2));
                        } else {
                            $.alert(data.info);
                        }
                    }, 'json');

                }, function() {
                    this.close()
                })
            }
        })
        $(".remove").click(function() {
            $.post("__URL__/remove", {
                'key' : $(this).attr("aid"),
            }, function(data) {
                if (data.status == 1) {
                    $("#item").text(data.data.total_num);
                    $("#Total_num").text(data.data.total_num);
                    $("#Total_price").text(data.data.total_price);
                    $("#sys_Subtotal").text(data.data.total_price);
                    $("#sys_GrandTotal").text(data.data.total_price);
                } else {
                    $.alert(data.info);
                }

            }, 'json');
            $(this).parents("tr").remove();
        })
        $(".addgoods").click(function() {
            var num = $(this).parents("tr").find(".num").val();
            num = parseInt(num) + 1;
            $(this).parents("tr").find(".num").val(num);
            $.post("__URL__/addgood", {
                'key' : $(this).attr("aid"),
                'number' : num,
            }, function(data) {
                if (data.status == 1) {
                    $("#item").text(data.data.total_number);
                    $("#sys_Coupon").text(data.data.coupon_price);
                    $("#Total_num").text(data.data.total_number);
                    $("#Total_price").text(data.data.total_price);
                    $("#sys_Subtotal").text(data.data.total_price);
                    $("#sys_GrandTotal").text(parseFloat($("#Total_price").text() - $("#sys_Coupon").text()).toFixed(2));
                }
            }, 'json');
        })

        $("#empty").click(function() {
            $.post("__URL__/clearCart", {}, function(data) {
                if (data.status == 1) {
                    $("#item").text(0);
                    $("#Total_num").text(0);
                    $("#Total_price").text(parseFloat(0).toFixed(2));
                    $("#sys_Subtotal").text(parseFloat(0).toFixed(2));
                    $("#sys_GrandTotal").text(parseFloat(0).toFixed(2));
                } else {
                    $.alert(data.info);
                }
            }, "json")
        })
    })
    function gopay() {
        $("#cart_info").submit();
    }

</script>
<div id="main">
	<div id="main2">
		<div id="shop_l">
			<div class="cart_top">
				<div class="fixed_title"><img src="__MYSTYLE__Images/shoppingnag.jpg">
				</div>
				<div class="checkbotton">
					<img class="cart_checkout" alt="Proceed to Checkout" onclick="gopay();" src="__MYSTYLE__Images/securecheck.jpg">
					<img alt="continue" onclick='document.location.href="/"' class="cart_btn" src="__MYSTYLE__Images/continue.jpg">
				</div>
			</div>
			<!---购物车Widget开始-->
			<div id="cart_table">
				<form id="cart_info" action="/Order/step1" method="post">
					<table id="sys_num">
						<thead>
							<tr>
								<!-- <th style="text-indent: 0px; text-align: center" class="cart_table1_th1"> &nbsp;</th> -->
								<th class="cart_table1_th2"> Product Pic </th>
								<th class="cart_table1_th2"> Product Name </th>
								<th class="cart_table1_th4"> Product AttrValue </th>
								<th class="cart_table1_th4"> Unit Price </th>
								<th class="cart_table1_th5"> QTY </th>
								<th class="cart_table1_th8"> Subtotal </th>
							</tr>
						</thead>
						<tbody>
							<!--循环读取购物车内的商品开始-->						
							<?php if(is_array($goods)): foreach($goods as $key=>$vo): ?><tr>
									<!--购物车图片-->
									<td><a target="_top" href="/Product/show/Id/<?php echo ($vo["Id"]); ?>"> <img src="<?php echo ($vo["image"]); ?>" width="64"></a></td>
									<td><a target="_top" href="/Product/show/Id/<?php echo ($vo["Id"]); ?>"><?php echo ($vo["product_name"]); ?></a>
									<br>
									<br>
									<div style=" padding-top:6px; float:left;">
										<a style=" text-decoration:underline;" href="#" target="_top">Edit</a>&nbsp; <a target="_top"  class="remove" aid="<?php echo ($key); ?>" style="text-decoration:underline;" href="javascript:void(0);">Remove</a>
									</div></td>
									<td>
										<?php if(is_array($vo["attrvalue"])): foreach($vo["attrvalue"] as $keys=>$subvo): ?><p>
											<?php echo ($subvo); ?>
											</p><?php endforeach; endif; ?>
									
									
									</td>
									<td style="padding: 0;text-align: center;width: 100px;"> <?php echo ($vo["price"]); ?> </td>
									<td style="padding: 0;text-align: center;width: 100px;">
									<table style="display:inline;">
										<tbody>
											<tr id="num">
												<td>
												<input class="num" value="<?php echo ($vo["number"]); ?>" size="5" style="text-align: center" onkeyup="" class="line" id="sys_1_Num">
												</td>
												<td>
												<div style="padding-bottom: 2px">
													<a href="javascript:void(0);" class="addgoods" aid="<?php echo ($key); ?>" style="display: block;"> <img  src="__MYSTYLE__Images/good_detail_up.gif" style="cursor: pointer;" /></a>
													<a href="javascript:void(0);"  class="delgoods" aid="<?php echo ($key); ?>" style="display: block;"> <img  src="__MYSTYLE__Images/good_detail_down.gif" style="cursor: pointer;" /></a>
												</div></td>
											</tr>
										</tbody>
									</table></td>
									<td id="sys_1_Subtotal" style="padding: 0;text-align: center;width: 100px;"> <?php echo ($vo["price"]); ?> </td>
								</tr><?php endforeach; endif; ?>
							<!--循环读取购物车内的商品结束-->
						</tbody>
					</table>
					<div class="clear"></div>
			</div>
			<div class="cart_col5">
				<div class="cart_discount">
					<b>Discount Codes</b>
					<input id="Text1" class="input-text" name="Coupon" value="Enter your coupon code :" type="text">
					<button id="btnValidate" type="button" onclick="validCoupon('Text1')" class="cart_btn"><img src="__MYSTYLE__Images/apply.jpg" alt="">
					</button>
					<div class="clear"></div>
					<span class="valid" mode="border"></span>
				</div>
				<dl class="cart_total">

					<!--优惠券-->
					<dd>
						<b>Coupon</b><b>$<span id="sys_Coupon">
							<?php if(empty($coupon_price)): ?>0.00
								<?php else: ?>
								<?php echo ($coupon_price); endif; ?> </span></b>
					</dd>
					<!--优惠券-->

					<dd>
						<b>Total_num</b><b><span id="Total_num">
							<?php if(empty($total_number)): ?>0
								<?php else: ?>
								<?php echo ($total_number); endif; ?> </span></b>
					</dd>

					<dd>
						<b>Total_price</b><b>$<span id="Total_price" >
							<?php if(empty($total_price)): ?>0.00
								<?php else: ?>
								<?php echo ($total_price); endif; ?> </span></b>
					</dd>

					<dd>
						<b>Subtotal</b><b>$<span id="sys_Subtotal">
							<?php if(empty($total_price)): ?>0.00
								<?php else: ?>
								<?php echo ($total_price); endif; ?> </span></b>
					</dd>
					<!--应该减优惠券-->
					<dd class="cart_strong">
						<b>Grand Total:</b><b class="red2">$<span id="sys_GrandTotal">
							<?php if(empty($Grand_Total)): echo ($total_price); ?>
								<?php else: ?>
								<?php echo ($Grand_Total); endif; ?> </span></b>
					</dd>
					<!--应该减优惠券-->
					<dt><img alt="continue" onclick='document.location.href="/"' class="cart_btn" src="__MYSTYLE__Images/continue.jpg"><img class="cart_checkout" alt="Proceed to Checkout" onclick="gopay();" src="__MYSTYLE__Images/securecheck.jpg">
					</dt>
				</dl>
			</div>
			<div class="clear"></div>
			<!---购物车Widget结束-->
			</form>
			<button id="empty">
				清空购物车
			</button>
		</div>

		<div id="shop_r">
			<!--同类商品推荐Widget-->
			<p class="may2_t">
				MAY WE SUGGEST
			</p>
			<div class="may2">

				<div class="list">
					<a target="_top" class="may2_img" title="Oakley Frogskin Lifestyle Oversize Sunglasses" href="http://www.usefulsunglasses.com/Oakley-Frogskin-Lifestyle-Oversize-Sunglasses-p-5549.html"><img title="Oakley Frogskin Lifestyle Oversize Sunglasses" alt="Oakley Frogskin Lifestyle Oversize Sunglasses" src="__MYSTYLE__Images/SG0000000480_1.jpg"></a>
					<a target="_top" class="may2_name" title="Oakley Frogskin Lifestyle Oversize Sunglasses" href="http://www.usefulsunglasses.com/Oakley-Frogskin-Lifestyle-Oversize-Sunglasses-p-5549.html">Oakley Frogskin Lifestyle Oversize Sunglasses</a>

					<div class="may2_price">
						<span class="sys_cur">$</span><span class="sys_p">15.99</span>
					</div>

				</div>

				<div class="list">
					<a target="_top" class="may2_img" title="Oakley Plaintiff Lifestyle Oversize Sunglasses" href="http://www.usefulsunglasses.com/Oakley-Plaintiff-Lifestyle-Oversize-Sunglasses-p-5704.html"><img title="Oakley Plaintiff Lifestyle Oversize Sunglasses" alt="Oakley Plaintiff Lifestyle Oversize Sunglasses" src="__MYSTYLE__Images/SG0000000325_1.jpg"></a>
					<a target="_top" class="may2_name" title="Oakley Plaintiff Lifestyle Oversize Sunglasses" href="http://www.usefulsunglasses.com/Oakley-Plaintiff-Lifestyle-Oversize-Sunglasses-p-5704.html">Oakley Plaintiff Lifestyle Oversize Sunglasses</a>

					<div class="may2_price">
						<span class="sys_cur">$</span><span class="sys_p">15.99</span>
					</div>
				</div>
			</div>
			<!--同类商品推荐Widget-->
			<div class="may2_b"></div>
		</div>
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
				<a target="_top" href="#" rel="nofollow">About Us</a>
			</dd>
			<dd>
				|
			</dd>
			<dd>
				<a target="_top" href="#" rel="nofollow">Safe Shopping</a>
			</dd>
		</dl>

		<dl class="mk_dd1">
			<dt>
				Customer Service
			</dt>
			<dd>
				<a target="_top" href="#" rel="nofollow">Contact Us</a>
			</dd>
			<dd>
				|
			</dd>
			<dd>
				<a target="_top" href="#" rel="nofollow">Privacy Policy</a>
			</dd>
			<dd>
				|
			</dd>
			<dd>
				<a target="_top" href="#" rel="nofollow">FAQs</a>
			</dd>
		</dl>

		<dl class="mk_dd1">
			<dt>
				Payment and Shipping
			</dt>
			<dd>
				<a target="_top" href="#" rel="nofollow">Checkout</a>
			</dd>
			<dd>
				|
			</dd>
			<dd>
				<a target="_top" href="#" rel="nofollow">My Order</a>
			</dd>
		</dl>

		<dl class="mk_dd1">
			<dt>
				Company Policy
			</dt>
			<dd>
				<a target="_top" href="#l" rel="nofollow">Payment &amp; Returns</a>
			</dd>
			<dd>
				|
			</dd>
			<dd>
				<a target="_top" href="#" rel="nofollow">Shipping Charge</a>
			</dd>
		</dl>

	</div>

	<div class="clear"></div>
	<ul class="sys_links"></ul>
	<div id="bottom">
		<a target="_top" href="http://www.usefulsunglasses.com/sitemap.html">SiteMap</a><span class="common">Copyright © &nbsp;2012 <a target="_top" href="http://www.usefulsunglasses.com/">Cheap Oakley Sunglasses,Wholesale Oakley Sunglasses,Discount Oakley Sunglasses</a> Store Privacy Policy</span>
	</div>
</div>
<div style="display:none"></div>
<div class="clear"></div>
</div>
</body>
</html>