<?php
import("ORG.Util.Cart");
class IndexAction extends Action {
	public function index() {
		//import("ORG.Util.Page");
		// $prorduct = D("Product");
		// $count = $prorduct -> count();
		// $page = new Page($count, 25);
		// $list = $prorduct -> limit($page -> firstRow . ',' . $page -> listRows) -> select();
		// $this -> assign('list', $list);
		$this -> display();
	}

	public function show() {
		if ($this -> _get("id") == 1) {
			$array = array("id" => 99220, "price" => 10.00, "marke_price" => 20.00, "discount" => 2, "name" => "Nick Shoes", "attr" => array("color" => array("red", "black", "blue"), "size" => array("41", "42", "43")));
		} else if ($this -> _get("id") == 2) {
			$array = array("id" => 99520, "price" => 12.00, "marke_price" => 18.00, "discount" => 1, "name" => "add Shoes", "attr" => array("color" => array("red", "blue"), "size" => array("41", "43")));
		}
		$this -> assign($array);
		$this -> display();
	}

	public function addCart() {
		$cart = new Cart();
		if ($cart -> addGoods($_POST)) {
			$this -> success("添加到购物车");
		} else {
			$this -> error("添加失败");
		}
	}

	//删除某一种商品(递减)
	public function delgood() {
		$cart = new Cart();
		$data = $cart -> delGood($_POST['key'], $_POST['number']);
		if ($data) {
			$this -> ajaxReturn($data, '', 1);
		} else {
			$this -> erro("无商品");
		}

	}

	//添加某一种商品(递增)
	public function addgood() {
		$cart = new Cart();
		$data = $cart -> addGood($_POST['key'], $_POST['number']);
		if ($data) {
			$this -> ajaxReturn($data, '', 1);
		} else {
			$this -> erro("无商品");
		}
	}

	//从购物车内彻底移除某件商品
	public function removegood() {
		$cart = new Cart();
		$data = $cart -> removeGood($_POST['key']);
		if ($data) {
			$this -> ajaxReturn($data, "商品从购物车中移除成功", 1);
		} else {
			$this -> error("商品从购物车中移除失败");
		}
	}

	public function checkCoupon() {
		//功能改进检查是否已经使用过优惠券
		$cart = new Cart();
		//$cart -> isCoupon = TRUE;
		if ($cart -> checkCoupon()) {
			$this -> error("一次只能使用一次优惠券");
		}
		$data = array("coupon" => "201305261718", "coupon_price" => 5.00);
		if ($_POST['coupon'] == $data["coupon"]) {
			$data = $cart -> setCoupon($data);
			$this -> ajaxReturn($data, "优惠券有效", 1);
		} else {
			$this -> error("优惠券无效");
		}

	}

	public function mycart() {
		$cart = new Cart();
		$total_number = $cart -> total_Num();
		$total_price = $cart -> total_Pri();
		$goods = $cart -> goods_list();
		$this -> assign("total_number", $total_number);
		$this -> assign("total_price", $total_price);
		$this -> assign("goods", $goods);
		$this -> display();
	}

	public function diff_array() {
		$array1 = array('0' => 'color:blae', '1' => 'size:43', "attr" => array("abc", "bcd"));
		$array2 = array('0' => array('0' => 'color:blae', '1' => 'size:43', "attr" => array("abc", "bcd")), '1' => array('0' => 'color:blae', '1' => 'size:43', "attr" => array("abc", "bcd")), '2' => 'size:43', );
		$key = array_search($array1, $array2, TRUE);
		if ($key !== FALSE) {
			echo $key;
		} else {
			echo "FALSE";
		}

	}

	public function clearCart() {
		$cart = new Cart();
		if ($cart -> emptyCart()) {
			$this -> success("购物车清空成功");
		} else {
			$this -> error("购物车暂无产品");
		}
	}

}
