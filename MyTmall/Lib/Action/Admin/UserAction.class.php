<?php
/*
 *后台会员管理操作
 *日期:2013-03-14
 *作者:邱银乐
 *版本:v1.0
 */

class UserAction extends Action {
	public function index() {
		import("ORG.Util.Page");
		$user = M('User');
		$count = $user -> count();
		$page = new Page($count, 25);
		$field = "password,tel,country,state,city,firstName,secondName,postCode";
		$list = $user -> field($field, TRUE) -> order("id desc") -> limit($page -> firstRow . ',' . $page -> listRows) -> select();
		$this -> assign("list", $list);
		$this -> assign("page", $page -> show());
		$this -> display();
	}

	public function updatePwd() {
		$user = D("User");
		if ($_POST['password'] != $_POST['repassword']) {
			$this -> error("两次密码不一致");
		}
		$map['id'] = $_SESSION['uid'];
		$data['password'] = md5($_POST['password']);
		if ($user -> changeInfo($map, $data) === false) {
			$this -> error("密码修改失败");
		} else {
			$this -> success("修改成功,系统退出,请重新登陆");
		}
	}

	//后台修改邮件页面
	public function email() {
		$uid = $_GET['uid'];
		$this -> assign("uid", $uid);
		$this -> display();
	}

	public function delUser() {
		$map['id'] = $_POST['uid'];
		$user = M('User');
		if ($user -> where($map) -> delete()) {
			$this -> success("会员删除成功");
		} else {
			$this -> error("删除失败");
		}
	}

	public function updateEmail() {
		$user = D("User");
		if ($user -> create()) {
			$map['id'] = $_POST['uid'];
			//未检查email地址有效
			$data['email'] = $_POST['email'];
			if ($user -> changeInfo($map, $data) === false) {
				$this -> error("邮箱修改失败");
			} else {
				$this -> success("邮箱修改成功");
			}
		} else {
			$this -> error($user -> getError());
		}

	}

	public function addUser() {
		$user = D("User");
		if ($user -> create()) {
			if ($id = $user -> add()) {
				$field = "password,tel,country,state,city,firstName,secondName,postCode";
				$data = $user -> field($field, TRUE) -> find($id);
				$this -> ajaxReturn($data, "会员添加成功", 1);
			} else {
				$this -> error("会员添加失败");
			}
		} else {
			$this -> error($user -> getError());
		}

	}

	public function info() {
		$map['username'] = $_POST['username'];
		$user = D("User");
		$field = "email,address,tel,country,state,city";
		$list = $user -> field($field) -> where($map) -> find();
		if ($list) {
			$this -> ajaxReturn($list, '', 1);
		} else {
			$this -> error("查无此用户");
		}

	}

}
?>