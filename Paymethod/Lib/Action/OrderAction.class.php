<?php
/**
 * 订单模块
 */
class OrderAction extends Action {
	public function index() {
		$customer = array(//
		"C_FirstName" => 'qiu', //
		"C_SecondName" => "yinle", //
		"C_Address" => "fuzhougulou", //
		"C_City" => "fuzhou", //
		"C_Country" => "CHINA", //
		"C_State" => "fujian", //
		"C_PostCode" => "350203", //
		"C_Tel" => "13950354253", //
		"C_Email" => "qiuyinle520@163.com");
		$this -> assign("customer", $customer);
		$this -> display();

	}

	public function index1() {
		$info = $this -> _post();
		$paymethod = array( array("id" => "0527", "name" => "vista"), array("id" => 05272013, "name" => 'master'));
		$delivery = array( array("id" => "20130527", "name" => "顺丰", "price" => 20.00), array("id" => 05201327, "name" => '申通', "price" => 10.00));
		$this -> assign('info', $info);
		$this -> assign('paymethod', $paymethod);
		$this -> assign('delivery', $delivery);
		$this -> display();

	}

	public function index2() {
		$cart = $_SESSION['cart'];
		$merchantid = "100107";
		$cart['shippingfee'] = 5.00;
		$shippingfee = $cart['shippingfee'];
		$orderamount = $cart['total_price'];
		$payamount = $cart['total_price'];
		$orderhash = "Nez7jW5rJxl3yrGqQSZu15mSg2sT8epgJbIGRmBRb5DEXjXjLdVEZeTR1P0qDmsEhftxRaIDris4BR35fjh4rUpFr0ObvknYN7wSZAALDsmRVXpjV4luewmvYXfZvHih";
		$url = "www.bestsunglasseslove.com";
		$info = $this -> paymethod($merchantid, $shippingfee, $orderamount, $payamount, $orderhash, $url);
		$this -> assign('info', $info);
		$this -> assign('total_price', $cart['total_price']);
		$this -> assign('total_number', $cart['total_number']);
		$this -> assign('goods', $cart['goods']);
		$this -> assign('coupon', $cart['coupon']);
		$this -> assign('coupon_price', $cart['coupon_price']);
		$this -> display();
	}

	public function paymethod($merchantid, $shippingfee, $orderamount, $payamount, $orderhash, $url) {
		$i = 1;
		//循环读取session购物车内的数组
		foreach ($_SESSION['cart']['goods'] as $key => $value) {
			$product['productname' . $i] = $value['name'];
			//产品货号
			$product['productsn' . $i] = $value['id'];
			//产品数量
			$product['quantity' . $i] = $value['number'];
			//产品单价
			$product['unit' . $i] = $value['price'];
			$i++;
		}
		$remark = array(
		//商户备注1
		'remark1' => 'remark1',
		//商户备注2
		'remark2' => 'remark2',
		//商户备注3
		'remark3' => 'remark3',
		//
		);
		$data = array(
		//商户证书
		'orderhash' => $orderhash,
		//接口版本
		'version' => "PHP V1.0.0",
		//字符编码集
		'encoding' => "utf-8",
		//界面语言格式
		'language' => "English",
		//商户号
		'merchantid' => $merchantid,
		//商户订单号
		'orderid' => date('YmdHis', time() . mt_rand(10000, 99999)),
		//商户订单日期
		'orderdate' => date('YmdHis', time()),
		//商户订单交易币种
		'currency' => "USD",
		//商户订单交易金额
		'orderamount' => $orderamount,
		//商户订单实际交易金额
		'payamount' => $payamount,
		//交易类型
		'transtype' => "IC",
		//服务器返回地址
		'callbackurl' => "http://" . $url . "/Order/ReturnS2S",
		//浏览器返回地址
		'browserbackurl' => "http://" . $url . "/Order/Payment",
		//交易地址
		'accessurl' => $url,
		//商户备注
		'remark' => $remark, //
		//下面是购物车信息
		//产品数组前端循环
		'product' => $product,
		//运费
		'shippingfee' => $shippingfee,
		//下面是账单信息
		//账单地址
		'billaddress' => $_POST['B_Address'],
		//账单国家
		'billcountry' => $_POST['B_Country'],
		//账单地区
		'billprovince' => $_POST['B_State'],
		//账单城市
		'billcity' => $_POST['B_City'],
		//账单EMAIL
		'billemail' => $_POST['B_Email'],
		//账单电话
		'billphone' => $_POST['B_Tel'],
		//账单邮编
		'billpost' => $_POST['B_PostCode'],
		//收货姓名
		'deliveryname' => $_POST['C_FirstName'] . $_POST['C_SencodName'],
		//收货地址
		'deliveryaddress' => $_POST['C_Address'],
		//收货国家
		'deliverycountry' => $_POST['C_Country'],
		//收货地区
		'deliveryprovince' => $_POST['C_State'],
		//收货城市
		'deliverycity' => $_POST['C_City'],
		//收货人联系EMAIL
		'deliveryemail' => $_POST['C_Email'],
		//收货人联系电话
		'deliveryphone' => $_POST['C_Tel'],
		//收货人邮编
		'deliverypost' => $_POST['C_PostCode'], //
		);
		//全字段订单字符串拼接
		foreach ($data as $key => $value) {
			if (is_array($value)) {
				foreach ($value as $subkey => $sub) {
					$orderstr .= $sub;
				}
			} else {
				$orderstr .= $value;
			}
		}
		$signature = md5($this -> filter_code($orderstr));
		$data['orderstr'] = $orderstr;
		$data['signature'] = $signature;
		return $data;

	}

	///////////////////支付接口使用
	function utf8_htmldecode($str) {
		$str = str_replace("&", "&amp;", trim($str));
		$str = str_replace("\"", "&quot;", trim($str));
		$str = str_replace("<", "&lt;", trim($str));
		$str = str_replace(">", "&gt;", trim($str));
		$str = str_replace("'", "&#39;", trim($str));
		return $str;
	}

	//过滤ASCII码32-127位之外的订单字符串
	function filter_code($str) {
		if ($str == null || $str == "") {
			return "";
		} else {
			$str = str_split($str);
			for ($ii = 0; $ii < count($str); $ii++) {
				if (ord($str[$ii]) < 32 || ord($str[$ii]) > 127) {
					$str[$ii] = '';
				}
			}
		}
		$str = implode('', $str);
		return $str;
	}

}
?>