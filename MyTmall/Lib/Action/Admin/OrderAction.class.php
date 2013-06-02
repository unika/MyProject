<?php
/**
 * 订单管理模块
 */
class OrderAction extends Action {
	public function index() {
		import("ORG.Util.Page");
		$order = D("Orderinfo");
		$count = $order -> count();
		$page = new Page($count, 25);
		$list = $order -> limit($page -> firstRow . ',' . $page -> listRows) -> order("OrderTime desc") -> select();
		$this -> assign('page', $page -> show());
		$this -> assign('list', $list);
		$this -> display();
	}

	public function insert() {
		print_r($_POST);
		// $order = D("Orderinfo");
		// $order -> create();
		// //$order -> OrderId = date("YmdHis") . "2013";
		// $order -> C_Email = $_POST['email'];
		// if ($order -> add()) {
		// $this -> success("成功下单");
		// } else {
		// $this -> error($order -> getLastsql());
		// }
	}

	public function infoArray() {
		$payment = D("Payment");
		$delivery = D("Delivery");
		$producttype = D("Producttype");
		$list['payment'] = $payment -> field("id,Name") -> where('status=1') -> select();
		$list['delivery'] = $delivery -> field("id,Name") -> where('status=1') -> select();
		$list['producttype'] = $producttype -> field('id,Name') -> selectType();
		if ($list) {
			$this -> ajaxReturn($list, '', 1);
		} else {
			$this -> ajaxReturn(null, '', 0);
		}
	}

	//用于JQUERY自动完成用户列表
	public function userList() {
		$user = D("User");
		$map['username'] = array('like', "%" . trim($_GET['term'] . "%"));
		if (isset($_GET['term'])) {
			$list = $user -> field("username") -> where($map) -> select();
		} else {
			echo json_encode("['请输入用户名']");
			exit();
		}
		if ($list) {
			foreach ($list as $key => $value) {
				$data[] = $value['username'];
			}
			echo json_encode($data);
		} else {
			echo json_encode("['请输入用户名']");
		}
	}

	public function productList() {
		$product = D("Product");
		$map['Name'] = array('like', "%" . trim($_GET['term'] . "%"));
		if (isset($_GET['term'])) {
			$list = $product -> field("Name") -> where($map) -> select();
		} else {
			echo json_encode("['无此产品']");
			exit();
		}

		if ($list) {
			foreach ($list as $key => $value) {
				$data[] = $value['Name'];
			}
			echo json_encode($data);
		} else {
			echo json_encode("['无此产品']");
		}
	}

}
?>