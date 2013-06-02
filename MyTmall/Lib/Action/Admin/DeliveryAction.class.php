<?php
/**
 * 文件:物流信息控制器
 * 日期:2013-03-25
 * 作者:邱银乐
 */
import("ORG.Util.Page");
class DeliveryAction extends Action {
	public function index() {
		$delivery = D("Delivery");
		$count = $delivery -> count();
		$page = new Page($count, 20);
		$show = $page -> show();
		$list = $delivery -> limit($page -> firstRow . ',' . $page -> listRows) -> select();
		$this -> assign('page', $show);
		$this -> assign('list', $list);
		$this -> display();

	}

	public function insert() {
		$delivery = D("Delivery");
		$delivery -> create();
		if ($delivery -> add()) {
			$info = array("title" => "系统提示", "message" => "信息添加成功");
			$this -> ajaxReturn(null, $info, 1);
		} else {
			$info = array("title" => "系统提示", "message" => "信息添加失败");
			$this -> ajaxReturn(null, $info, 0);
		}
	}

	public function del() {
		$id = $_POST['id'];
		$delivery = D("Delivery");
		if ($delivery -> delete($id)) {
			$info = array('title' => '提示信息', 'message' => '删除成功');
			$this -> ajaxReturn(null, $info, 1);
		} else {
			$info = array('title' => '提示信息', 'message' => '删除失败' . $delivery -> getLastsql());
			$this -> ajaxReturn(null, $info, 0);
		}

	}

}
?>