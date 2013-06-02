<?php
/**
 * 购物车模型
 */
class CartModel extends Model {
	private $user_cart;
	private $num = 1;
	public function __construct() {
		$this -> user_cart = new Model();
		if ($_SESSION['cart']) {
			if ($_SESSION['uid']) {
				$_SESSION['cart']['total_num'] = 0;
				$_SESSION['cart']['total_price'] = 0.00;
				$goodlist = $this -> user_cart -> query("select * from shop_cart where uid=" . $_SESSION['uid']);
				foreach ($goodlist as $value) {
					$_SESSION['cart']['goods_list'][$value['item_id']] = array(//
					'item_id' => $value['item_id'], //购物车id
					'uid' => $value['uid'], //用户id
					'item_name' => $value['item_name'], //商品名称
					'price' => $value['price'], //单件价格
					'num' => $value['volume'], //商品数量
					'market_price' => $value['market_price'], //市场价
					$_SESSION['cart']['total_num'] = $_SESSION['cart']['total_num'] + 1,
					//数量
					$_SESSION['cart']['total_price'] = $_SESSION['cart']['total_price'] + $value['price'],
					//总价
					);
				}
			}
		} else {
			$_SESSION['cart'] = array();
			$_SESSION['cart']['goods_list'] = array();
			$_SESSION['cart']['total_num'] = 0;
			$_SESSION['cart']['total_price'] = 0.00;
			if ($_SESSION['uid']) {
				$goodlist = $this -> user_cart -> query("select * from shop_cart where uid=" . $_SESSION['uid']);
				foreach ($goodlist as $value) {
					$_SESSION['cart']['goods_list'][$value['item_id']] = array(//
					'item_id' => $value['item_id'], //商品id
					'uid' => $value['uid'], //用户id
					'item_name' => $value['item_name'], //商品名称
					'price' => $value['price'], //商品价格
					'num' => $value['num'], //商品数量
					'market_price' => $value['market_price'], //
					$_SESSION['cart']['total_num'] = $_SESSION['cart']['total_num'] + 1,
					//数量
					$_SESSION['cart']['total_price'] = $_SESSION['cart']['total_price'] + $value['price'],
					//总价
					);
				}
			}
		}
	}

	//添加商品到购物车，先判断购物车内是否已有此商品，如有+1；没有就增加新记录
	//如果用户在登录状态下，添加用户账户商品信息到数据库 (默认商品数量为1)
	public function addGoods($good_id, $num = 1) {

		//如果商品存在
		if ($good_id) {
			if ($this -> user_cart -> where('item_id=' . $good_id) -> find()) {

			} else {
				return json_encode(array('state_code' => 3, 'state_message' => "Don't find item!"));
			}
		} else {
			return json_encode(array('state_code' => 2, 'state_message' => 'item_id is null'));
		}

	}

	//更新加购物车，将购物车内的商品数量更新
	//如果用户在登录状态下，更新用户账户相关商品信息
	public function upGood() {

	}

	//从购物车内删除商品，如有-1
	//如果用户在登录状态下，从数据库中删除
	public function delGood() {

	}

	//清空购物车,如在用户登录状态下，清空与用户账户有关的商品信息
	public function allEmpty() {
		unset($_SESSION['cart']);
		if ($_SESSION['uid']) {
			$this -> user_cart -> execute("delete from shop_cart where uid=" . $_SESSION['uid']);
		}
		$this -> user_cart -> getLastsql();
		return json_encode(array("state_code" => 1, "state_message" => "购物车清空成功"));

	}

	public function getGoodinfo() {
		return $_SESSION['cart'];
	}

}
?>