<?php
/**
 * 文件:购物车模块
 * 功能：商品增删改
 * 日期：2013-03-16
 * 作者：邱银乐
 * 修正bug:不同属性的同种商品应该为不同的记录
 * */
class CartAction extends Action {
	public function index() {//购物车
		if (empty($_SESSION['cart'])) {
			$this -> redirect('/', '', 5, '您的购物车内还没有商品,请先到商品页面选择商品,5秒后跳转到首页.....');
		}	
		$goods_list = $_SESSION['cart']['goods_list'];
		$total_num = $_SESSION['cart']['total_num'];
		$total_price = number_format($_SESSION['cart']['total_price'], '2', '.', '');		
		$this -> assign('goods', $goods_list);
		$this -> assign('total_num', $total_num);
		$this -> assign('total_price', $total_price);
		$this -> display();
	}   
	public function addCart() {
		if ($_SESSION['cart']) {
			if (array_key_exists($_POST['id'], $_SESSION['cart']['goods_list'])) {
				$_SESSION['cart']['goods_list'][$_POST['id']] = array(//
				"item_id" => $_POST['id'], //产品id
				"item_image" => $_POST['image'], //产品图片
				"item_attrValue" =>json_encode(($_POST['attrvalue'])), //产品属性
				"item_num" => $_SESSION['cart']['goods_list'][$_POST['id']]['item_num'] + $_POST['num'] * 1, //产品数量
				"item_name" => $_POST['product_name'], //产品名称
				"item_price" => number_format($_POST['price'], '.', '2', ''), //产品价格
				"item_attrvalue" => $_POST['num'] . "item:" . $_POST['attrvalue'], //产品属性
				);
				//如果已有数据,就将总价=总价+添加的数量*单品价格
				$_SESSION['cart']['total_price'] = $_SESSION['cart']['total_price'] + $_POST['price'] * $_POST['num'];
				$_SESSION['cart']['total_num'] = $_SESSION['cart']['total_num'] + $_POST['num'];
				$data = array(//
				"state_code" => "1", //处理代码
				"message" => array(//附加信息
				"total_num" => $_SESSION['cart']['total_num'], //
				"total_price" => number_format($_SESSION['cart']['total_price'], '2', '.', '')//
				));
				$this -> ajaxReturn($data, '商品已添加到购物车', 1);
			} else {
				$_SESSION['cart']['goods_list'][$_POST['id']] = array(//
				"item_id" => $_POST['id'], //商品编号
				"item_image" => $_POST['image'], //产品图片
				"item_attrValue" => $_POST['attrvalue'], //产品属性
				"item_num" => $_POST['num'] * 1, //商品数量
				"item_name" => $_POST['product_name'], //产品名称
				"item_price" => number_format($_POST['price'], '.', '2', ''), //产品价格
				"item_attrvalue" => $_POST['num'] . "item:" . $_POST['attrvalue'], //产品属性
				);
				//如果已有数据,就将总价=总价+单品价格
				$_SESSION['cart']['total_price'] = number_format($_SESSION['cart']['total_price'] + $_POST['price'] * $_POST['num'], '2', '.', '');
				$_SESSION['cart']['total_num'] = $_SESSION['cart']['total_num'] + $_POST['num'];
				$data = array(//
				"state_code" => "2", //处理代码
				"message" => array(//附加信息
				"total_num" => $_SESSION['cart']['total_num'], //
				"total_price" => $_SESSION['cart']['total_price'] //
				));
				$this -> ajaxReturn($data, '商品已添加到购物车', 1);
			}
		} else {
			$_SESSION['cart']['goods_list'][$_POST['id']] = array(//
			"item_id" => $_POST['id'], //商品编号
			"item_image" => $_POST['image'], //产品图片
			"item_attrValue" => $_POST['attrvalue'], //产品属性
			"item_num" => $_POST['num'] * 1, //数量
			"item_name" => $_POST['product_name'], //产品名称
			"item_price" => number_format($_POST['price'], '2', '.', ''), //产品价格
			"item_attrvalue" => $_POST['num'] . "item:" . $_POST['attrvalue'], //产品属性
			//产品价格
			);
			$_SESSION['cart']['total_price'] = number_format($_POST['price'] * $_POST['num'], '2', '.', '');
			$_SESSION['cart']['total_num'] = $_POST['num'];
			$data = array(//
			"state_code" => "3", //处理代码
			"message" => array(//附加信息
			"total_num" => $_SESSION['cart']['total_num'], //
			"total_price" => $_SESSION['cart']['total_price']//
			));
			$this -> ajaxReturn($data, "商品已添加到购物车", 1);
		}
	}

	public function delGoods() {
		if (array_key_exists($_POST['id'], $_SESSION['cart']['goods_list'])) {
			$price = $_SESSION['cart']['goods_list'][$_POST['id']]['item_price'];
			$num = $_SESSION['cart']['goods_list'][$_POST['id']]['item_num'] - $_POST['num'];
			$_SESSION['cart']['goods_list'][$_POST['id']]['item_num'] = $_POST['num'];
			$_SESSION['cart']['total_price'] = number_format($_SESSION['cart']['total_price'] - $price * $num, '2', '.', '');
			$_SESSION['cart']['total_num'] = $_SESSION['cart']['total_num'] - $num;
			$data = array(//
			"state_code" => "4", //处理代码
			"message" => array(//附加信息
			"total_num" => $_SESSION['cart']['total_num'], //
			"total_price" => $_SESSION['cart']['total_price'] //
			));
			$this -> ajaxReturn($data, '商品删除成功', 1);
		} else {
			$this -> ajaxReturn(null, "无此商品", 0);
		}
	}

	public function addGoods() {
		if (array_key_exists($_POST['id'], $_SESSION['cart']['goods_list'])) {
			$price = $_SESSION['cart']['goods_list'][$_POST['id']]['item_price'];
			$num = $_POST['num'] - $_SESSION['cart']['goods_list'][$_POST['id']]['item_num'];
			$_SESSION['cart']['goods_list'][$_POST['id']]['item_num'] = $_POST['num'];
			$_SESSION['cart']['total_price'] = number_format($_SESSION['cart']['total_price'] + $price * $num, '2', '.', '');
			$_SESSION['cart']['total_num'] = $_SESSION['cart']['total_num'] + $num;
			$data = array(//
			"state_code" => "5", //处理代码
			"message" => array(//附加信息
			"total_num" => $_SESSION['cart']['total_num'], //
			"total_price" => number_format($_SESSION['cart']['total_price'], '2', '.', '')//
			));
			$this -> ajaxReturn($data, '商品添加成功', 1);
		} else {
			$this -> error('商品没有找到');
		}
	}

	public function delCart() {
		//如果已有数据,就将总价=总价+添加的数量*单品价格
		if (array_key_exists($_GET['id'], $_SESSION['cart']['goods_list'])) {
			$price = $_SESSION['cart']['goods_list'][$_GET['id']]['item_price'];
			$num = $_SESSION['cart']['goods_list'][$_GET['id']]['item_num'];
			unset($_SESSION['cart']['goods_list'][$_GET['id']]);
			$_SESSION['cart']['total_price'] = number_format($_SESSION['cart']['total_price'] - $price * $num, '2', '.', '');
			$_SESSION['cart']['total_num'] = $_SESSION['cart']['total_num'] - $num;
			$data = array(//
			"state_code" => "6", //处理代码
			"message" => array(//附加信息
			"total_num" => $_SESSION['cart']['total_num'], //
			"total_price" => number_format($_SESSION['cart']['total_price'], '2', '.', '')//
			));
			$this -> ajaxReturn($data, "商品已从购物车中删除", 1);
		} else {
			$this -> error('商品没有找到');
		}
	}

	public function getTotalPrice() {
		$data = array(//
		"state_code" => "7", //处理代码
		"message" => array(//附加信息
		"total_num" => $_SESSION['cart']['total_num'], //
		"total_price" => number_format($_SESSION['cart']['total_price'], '2', '.', '')//
		));
		$this -> ajaxReturn($data, '商品已添加到购物车', 1);
	}

	public function emptyCart() {
		unset($_SESSION['cart']);
		$data = array(//
		'state_code' => "8", //
		"message" => array(//附加信息
		"total_num" => 0, //
		"total_price" => 0.00, //
		));
		if (empty($_SERVER['cart'])) {
			$this -> ajaxReturn($data, '购物车已清空', 1);
		}
	}

	public function validCoupon() {
		$coupon = D("Coupon");
		$map['No'] = $this -> _post("No");
		$list = $coupon -> where($map) -> find();
	
		if ($list) {
			$_SESSION['cart']['coupon']['No']=$list['No'];
			$_SESSION['cart']['coupon']['Price']=$list['Price'];			
			$this -> ajaxReturn($list, '订单将优惠' . $list['Price'], 1);
		} else {
			$this -> ajaxReturn($list, '优惠券无效', 0);
		}
	}

}
?>