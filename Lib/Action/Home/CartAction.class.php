<?php
import("@.MyClass.Cart");
class CartAction extends Action {
	public function index() {
		$cart = new Cart();	
		$this -> assign("goods", $cart -> goods);	
		$this -> assign("coupon_no", $cart -> coupon_no);
		$this -> assign("total_number", $cart -> total_number);
		$this -> assign("coupon_price", $cart -> coupon_price);
		$this -> assign("total_price", $cart -> total_price);
		$this -> assign('Grand_Total', $Grand_Total);
		$this -> display();
	}

	public function show() {
		$cart = new Cart();
		$data = $cart -> restCart();
		if ($data) {
			$this -> ajaxReturn($data, "", 1);
		} else {
			$this -> error("购物车内无产品");
		}
	}

	public function validCoupon() {
		$cart = new Cart();
		if ($cart -> goods == null) {
			$this -> error("请先前往商品页面选择商品,再使用优惠券");
		}
		$coupon = D("Coupon");
		if ($this -> _post("No") == '') {
			$this -> error("请输入优惠码");
		}
		if ($cart -> isCoupon) {
			$this -> error("已使用过优惠码");
		} else {
			$field = "id,No,Price";
			$map['No'] = array('like', $this -> _post("No"));
			$list = $coupon -> field($field) -> where($map) -> find();
			if ($list) {
				$cart -> coupon_no = $list['No'];
				$cart -> coupon_price = $list['Price'];
				$cart -> isCoupon = TRUE;
				$data = $cart -> restCart();
				$this -> ajaxReturn($data, '优惠', 1);
			} else {
				$cart -> coupon_no = null;
				$cart -> coupon_price = 0.00;
				$cart -> isCoupon = false;
				$cart -> restCart();
				$this -> error('优惠券无效');
			}

		}

	}

	//添加商品到购物车
	public function addCart() {
		$cart = new Cart();
		$cart -> addToCart($this -> _post());
		$data = $cart -> restCart();
		if ($data) {
			$this -> ajaxReturn($data['total_number'], "添加到购物车", 1);
		} else {
			$this -> error("添加失败");
		}
	}

	//删除某一种商品(递减)
	public function delgood() {
		$cart = new Cart();
		$cart -> delGood($this -> _post('key'), $this -> _post('number'));
		$data = $cart -> restCart();
		if ($data) {
			$this -> ajaxReturn($data, '', 1);
		} else {
			$this -> erro("无商品");
		}
	}

	//添加某一种商品(递增)
	public function addgood() {
		$cart = new Cart();
		$cart -> addGood($this -> _post('key'), $this -> _post('number'));
		$data = $cart -> restCart();
		if ($data) {
			$this -> ajaxReturn($data, '', 1);
		} else {
			$this -> erro("无商品");
		}
	}

	//从购物车内彻底移除某件商品
	public function remove() {
		$cart = new Cart();
		$cart -> removeGood($this -> _post('key'));
		$data = $cart -> restCart();
		if ($data) {
			$this -> ajaxReturn($data, "商品从购物车中移除成功", 1);
		} else {
			$this -> error("商品从购物车中移除失败");
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

	public function clearCart() {
		$cart = new Cart();
		if ($cart -> emptyCart()) {
			$this -> success("购物车清空成功");
		} else {
			$this -> error("购物车暂无产品");
		}
	}

}
