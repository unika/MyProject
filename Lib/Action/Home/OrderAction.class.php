<?php
/**
 * 文件：订单处理类
 * 功能：订单提交，确认，生成
 * 日期:2013-03-25
 * 作者:邱银乐
 */
class OrderAction extends CommonAction {
	public function index() {
		$this -> display();

	}

	public function step1() {
		if ($cart -> goods == null) {
			$this -> redirect("Index", "请先前往商品页面选择商品,再使用优惠券");
		}
		$user = D("User");
		$field = "username,firstName,secondName,postCode,email,address,tel,country,state,city";
		$userInfo = $user -> field($field) -> where("id=" . $_SESSION['uid']) -> find();
		$this -> assign($userInfo);
		$this -> display();
	}

	public function step2() {
		$delivery = D("Delivery");
		$payment = D("Payment");
		$dlist = $delivery -> where("status=1") -> select();
		$plist = $payment -> where("status=1") -> select();
		$this -> assign('dlist', $dlist);
		$this -> assign('plist', $plist);
		$this -> display();
	}

	public function step3() {
		$delivery = D("Delivery");
		$payment = D("Payment");
		$DeliveryId = $this -> _post("DeliveryId");
		$PaymentId = $this -> _post("PaymentId");
		$dlist = $delivery -> where("id=" . $DeliveryId) -> find();
		$plist = $payment -> where("id=" . $PaymentId) -> find();
		$shippingfee = $dlist['Price'];

		$goods_list = $_SESSION['cart']['goods_list'];
		$coupon = array(
		//优惠券号
		'No' => $_SESSION['cart']['coupon']['No'],
		//优惠金额度
		'Price' => $_SESSION['cart']['coupon']['Price']);
		$total_num = $_SESSION['cart']['total_num'];
		$total_price = number_format($_SESSION['cart']['total_price'], '2', '.', '');
		$sub_total = number_format($_SESSION['cart']['total_price'] - $_SESSION['cart']['coupon']['Price'] + $shippingfee, '2', '.', '');
		$data = $this -> getPayinfo($shippingfee, $total_price, $sub_total);
		$this -> assign($data);
		$this -> assign('goods', $goods_list);
		$this -> assign('total_num', $total_num);
		$this -> assign('total_price', $total_price);
		$this -> assign('sub_total', $sub_total);
		$this -> assign('Coupon', $coupon);
		$this -> display();
	}

	public function validCoupon() {
		$coupon = D("Coupon");
		$map['No'] = $this -> _post("Coupon");
		$result = $coupon -> where($map) -> find();
		return $result;
	}

	public function getPayinfo($shippingfee, $total_price, $sub_total) {
		$i = 1;
		//循环读取session购物车内的数组
		foreach ($_SESSION['cart']['goods_list'] as $key => $value) {
			$product['productname' . $i] = trim($value['item_name']);
			//产品货号
			$product['productsn' . $i] = trim($value['item_id']);
			//产品数量
			$product['quantity' . $i] = trim($value['item_num']);
			//产品单价
			$product['unit' . $i] = trim($value['item_price']);
			$i++;
		}
		$remark = array(
		//商户备注1
		'remark1' => trim('remark1'),
		//商户备注2
		'remark2' => trim('remark2'),
		//商户备注3
		'remark3' => trim('remark3'), );
		$data = array(
		//商户证书
		'orderhash' => trim(C("orderhash")),
		//接口版本
		'version' => trim("PHP V1.0.0"),
		//字符编码集
		'encoding' => trim("utf-8"),
		//界面语言格式
		'language' => trim("English"),
		//商户号
		'merchantid' => trim(C("merchantid")),
		//商户订单号
		'orderid' => trim(date('YmdHis', time()) . mt_rand(10000, 99999)),
		//商户订单日期
		'orderdate' => trim(date('YmdHis', time())),
		//商户订单交易币种
		'currency' => trim("USD"),
		//商户订单交易金额
		'orderamount' => trim($total_price),
		//商户订单实际交易金额
		'payamount' => trim($sub_total),
		//交易类型
		'transtype' => trim("IC"),
		//服务器返回地址
		'callbackurl' => trim("http://www.bestsunglasseslove.com/Payment/MB/OrderReturnS2S.php"),
		//浏览器返回地址
		'browserbackurl' => trim("http://www.bestsunglasseslove.com/Payment/MB/OrderReturn.php"),
		//交易地址
		'accessurl' => trim("www.bestsunglasseslove.com"),
		//商户备注
		'remark' => $remark, //
		//下面是购物车信息
		//产品数组前端循环
		'product' => $product,
		//运费
		'shippingfee' => $shippingfee,
		//下面是账单信息
		//账单地址
		'billaddress' => trim($_POST['B_Address']),
		//账单国家
		'billcountry' => trim($_POST['B_Country']),
		//账单地区
		'billprovince' => trim($_POST['B_State']),
		//账单城市
		'billcity' => trim($_POST['B_City']),
		//账单EMAIL
		'billemail' => trim($_POST['B_Email']),
		//账单电话
		'billphone' => trim($_POST['B_Tel']),
		//账单邮编
		'billpost' => trim($_POST['B_PostCode']),
		//收货姓名
		'deliveryname' => trim($_POST['C_FirstName'] . $_POST['C_SencodName']),
		//收货地址
		'deliveryaddress' => trim($_POST['C_Address']),
		//收货国家
		'deliverycountry' => trim($_POST['C_Country']),
		//收货地区
		'deliveryprovince' => trim($_POST['C_State']),
		//收货城市
		'deliverycity' => trim($_POST['C_City']),
		//收货人联系EMAIL
		'deliveryemail' => trim($_POST['C_Email']),
		//收货人联系电话
		'deliveryphone' => trim($_POST['C_Tel']),
		//收货人邮编
		'deliverypost' => trim($_POST['C_PostCode']), //
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
		$signature = md5(filter_code($orderstr));
		$data['orderstr'] = $orderstr;
		$data['signature'] = $signature;
		return $data;

	}

	public function orderPay() {
		print_r($_REQUEST);
		$order = D("Orderinfo");
		$order -> C_FristName = $_REQUEST['deliveryname'];
		$order -> C_SecondName = $_REQUEST['deliveryname'];
		$order -> C_Address = $_REQUEST['deliveryaddress'];
		$order -> C_City = $_REQUEST['deliverycity'];
		$order -> C_Country = $_REQUEST['deliverycountry'];
		$order -> C_State = $_REQUEST['deliveryprovince'];
		$order -> C_PostCode = $_REQUEST['deliverypost'];
		$order -> C_Tel = $_REQUEST['deliveryphone'];
		$order -> C_Email = $_REQUEST['deliveryemail'];
		$order -> B_Address = $_REQUEST['billaddress'];
		$order -> B_City = $_REQUEST['billcity'];
		$order -> B_Country = $_REQUEST['billcountry'];
		$order -> B_State = $_REQUEST['billprovince'];
		$order -> B_PostCode = $_REQUEST['billpost'];
		$order -> B_Tel = $_REQUEST['billphone'];
		$order -> B_Email = $_REQUEST['billemail'];
		$order -> OrderId = $_REQUEST['orderid'];
		$order -> OrderTime = $_REQUEST['orderdate'];
		$order -> Currency = $_REQUEST['currency'];
		$order -> OrderPrice = $_REQUEST['orderamount'];
		$order -> Encoding = $_REQUEST['encoding'];
		$order -> Transtype = $_REQUEST['transtype'];
		$order -> Language = $_REQUEST['language'];
		$order -> Payamount = $_REQUEST['payamount'];
		// [productname1] => 121 [productsn1] => [quantity1] => 1 [unit1] => 121.00
		$order -> Shippingfee = $_REQUEST['shippingfee'];
		$order -> Version = $_REQUEST['version'];
		$order -> Callbackurl = $_REQUEST['callbackurl'];
		$order -> Browserbackurl = $_REQUEST['browserbackurl'];
		$order -> SiteId = $_REQUEST['accessurl'];
		$order -> Paymemt_Id = 1;
		//[remark1] => remark1 [remark2] => remark2 [remark3] => remark3 )
		if ($id = $order -> add()) {
			$this -> success("payed success", U("/User"));
		} else {
			$this -> success("payed failer");
		}
	}

}
?>