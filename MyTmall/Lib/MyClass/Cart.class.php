<?php
/*
 * 文件名:购物车类
 * 功能: 实现购物车的增删改
 * 扩展: 优惠券,活动
 *
 */

Class Cart {
	//商品列表
	public $goods;
	//单品总数
	public $number = 0;
	//商品单价
	public $price = 0.00;
	//商品市场价
	public $marke_price;
	//商品优惠券
	public $coupon_no = null;
	//商品优惠价
	public $coupon_price = 0.00;
	//商品总数
	public $total_number = 0;
	//商品总价
	public $total_price = 0.00;
	//商品所属活动
	public $discount = null;
	//是否参与了活动
	public $isCoupon = false;
	public $grand_price;
	//购物车构造函数
	public function __construct() {
		$this -> goods = $_SESSION['cart']['goods'];
		//$this -> number = $_SESSION['cart']['number'];
		$this -> discount = $_SESSION['cart']['discount'];
		$this -> coupon_no = $_SESSION['cart']['coupon_no'];
		$this -> coupon_price = $_SESSION['cart']['coupon_price'];
		$this -> isCoupon = $_SESSION['cart']['isCoupon'];
		$this -> total_number = $_SESSION['cart']['total_number'];
		$this -> total_price = $_SESSION['cart']['total_price'];
	}

	//添加商品到购物车
	public function addToCart($array) {
		if ($this -> goods == null) {
			$this -> goods[] = $array;
		} else {
			$result = $this -> check($array);
			$key = $result['key'];
			$boolean = $result['boolean'];
			if ($boolean) {
				//id和属性同时相同情况
				$this -> goods[$key]['number'] += $array['number'];
			} else {
				//id和属性只要有一个不相同情况
				$this -> goods[$key] = $array;
			}
		}
		$this -> total_number += $array['number'];
		$this -> total_price += number_format($array['price'] * $array['number'], 2);
	}

	//返回产品总数
	public function total_Num() {
		return $this -> total_number;
	}

	//返回产品总价
	public function total_Pri() {
		return $this -> total_price;
	}

	//返回产品列表
	public function goods_List() {
		return $this -> goods;
	}

	//实现功能
	//是 否已经使用过
	//值初始化为false，未使用过,true已经使用
	public function checkCoupon() {
		return $this -> isCoupon;
	}

	//如果输入优惠券
	public function setCoupon($data) {
		$this -> total_price -= $data['coupon_price'];
		$this -> coupon_price = $data['coupon_price'];

	}

	//递减指定的商品数量
	public function delGood($key, $number) {
		$num = $this -> goods[$key]['number'] - $number;
		$this -> goods[$key]['number'] = $number;
		$this -> total_number -= $num;
		$this -> total_price -= $num * $this -> goods[$key]['price'];

	}

	//递增指定商品数量
	public function addGood($key, $number) {
		$num = $number - $this -> goods[$key]['number'];
		$this -> goods[$key]['number'] = $number;
		$this -> total_number += $num;
		$this -> total_price += $num * $this -> goods[$key]['price'];
	}

	public function restCart() {
		$_SESSION['cart']['goods'] = $this -> goods;
		$_SESSION['cart']['total_number'] = $this -> total_number;
		$_SESSION['cart']['coupon_no'] = $this -> coupon_no;
		$_SESSION['cart']['isCoupon'] = $this -> isCoupon;
		$_SESSION['cart']['total_price'] = number_format($this -> total_price, 2);
		$_SESSION['cart']['coupon_price'] = number_format($this -> coupon_price, 2);
		return $_SESSION['cart'];
	}

	public function removeGood($key) {
		$this -> total_number -= $this -> goods[$key]['number'];
		$this -> total_price -= $this -> goods[$key]['number'] * $this -> goods[$key]['price'];
		unset($this -> goods[$key]);
	}

	//清空购物车,先检测是否有购物车，有则置空，无就发出警告
	public function emptyCart() {
		if (isset($_SESSION['cart'])) {
			unset($_SESSION['cart']);
			return true;
		} else {
			return false;
		}
	}

	//检查商品是否已存在,不存在返回商品的$key+1;
	//存在再检查商品属性是否相同,相同就返回$key;
	//不相同返回$key+1,所有增删改都基于此返回值;
	public function check($array) {
		foreach ($this->goods as $key => $value) {
			if (($array['id'] == $value['id']) && (array_diff($array['attrvalue'], $this -> goods[$key]['attrvalue']) == NULL)) {
				$result = TRUE;
				$keys = $key;
			} else {
				$result = FALSE;
			}
		}
		$index = $result ? $keys : count($this -> goods);
		return array("boolean" => $result, "key" => $index);
	}

}
?>