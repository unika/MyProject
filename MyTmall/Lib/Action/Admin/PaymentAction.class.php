<?php
/**
 * 文件:物流信息控制器
 * 日期:2013-03-25
 * 作者:邱银乐
 */
import("ORG.Util.Page");
class PaymentAction extends Action {
	public function index() {
		$payment = D("Payment");
		$count = $payment -> count();
		$page = new Page($count, 20);
		$show = $page -> show();
		$list = $payment -> order("id desc") -> limit($page -> firstRow . ',' . $page -> listRows) -> select();
		$this -> assign('page', $show);
		$this -> assign('list', $list);
		$this -> display();
	}

	public function insert() {
		$payment = D("Payment");
		if ($payment -> create()) {
			if ($_POST['image']) {
				$payment -> logo = $this -> _post("image");
			}
			if ($id = $payment -> add()) {
				$list = $payment -> find($id);
				$this -> ajaxReturn($list, "支付信息添加成功", 1);
			} else {
				$this -> ajaxReturn(null, "支付信息添加失败", 0);
			}
		} else {
			$this -> error($payment -> getError());
		}

	}

	public function del() {
		$id = $this -> _post('id');
		$payment = D("Payment");
		$filename = $payment -> where('id=' . $id) -> getField("logo");

		if ($payment -> delete($id)) {
			unlink("./Upload/Payment/" . $filename);
			$this -> success('删除成功');
		} else {
			$this -> error('删除失败');
		}

	}

	public function uploadTofile() {
		$upload = new UploadAction('./Upload/' . MODULE_NAME . '/', 'uniqid', '/Upload/' . MODULE_NAME . '/');
		$upload -> ajaxupload();
	}

}
?>