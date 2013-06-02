<?php
/**
 * 前台公共模块
 * 日期:2013-03-14
 * 作者:邱银乐
 * qq:563712987
 *
 */
class PublicAction extends Action {
	public function login() {
		$this -> display();
	}

	public function logout() {
		if (session_destroy()) {
			$this -> success("logout success", "__APP__/", 1);
		}
	}

	public function check() {
		$user = D('User');
		// if (md5($_POST['verify']) != $_SESSION['verify']) {
		// $this -> error("验证码错误");
		// }
		$map['username'] = array('like', $this -> _post('username'));
		$info = $user -> where($map) -> find();
		if ($info) {
			if (md5($this -> _post('password')) != $info['password']) {
				$this -> error("密码错误");
			} else {
				$user -> lastLoginIp = get_client_ip();
				$user -> lastLoginTime = date("Y-m-d H:i:s");
				$user -> where('id=' . $info['id']) -> save();
				//可以添加会员等级
				$_SESSION['username'] = $info['username'];
				$_SESSION['uid'] = $info['id'];
				$this -> success("login success", "./User", 1);
			}

		}
	}

	//添加新用户
	public function addUser() {
		$user = D("User");
		if ($user -> create()) {
			if ($uid = $user -> add()) {
				$username = $this -> _post('username');
				$_SESSION['username'] = $username;
				$_SESSION['uid'] = $uid;
				//存放用户uid,和验证码的数据表
				$tmp = M("Temp");
				$code = randstr();
				$url = C("siteUrl") . "/User/checkEmail/uid/";
				$tmp -> uid = $uid;
				$tmp -> code = $code;
				if ($tmp -> add()) {
					$mail = D("Email");
					$mailtemp = D("Mailtemp");
					$data = array("username" => $username, "url" => $url . $uid . "/code/" . $code);
					$temp = $mailtemp -> field("Title,Body") -> getTemp("reg", 1, "#", $data);
					$mail -> setContent($temp['Title'], $temp['Body']);
					if ($mail -> send($this -> _post('email'))) {
						$this -> success("注册成功,系统已经发出一封验证信息到您的邮箱,请前往验证!");
					}
				};
			} else {
				$this -> error("注册失败");
			}
		} else {
			$this -> error($user -> getError());
		}
	}

	//登陆验证
	public function checkUser() {
		$user = D('User');
		$map['email'] = $_POST['email'];
		if ($info = $user -> where($map) -> find()) {
			if (md5($_POST['password']) != $info['password']) {
				$this -> error("密码错误");
			}
			if ($info['status'] == 0) {
				$this -> redirect('User/replayEmail', '', 5, '您注册的邮箱还未验证，5秒后跳转到验证页.....');
			}
			// $user -> lastLoginIp = get_client_ip();
			// $user -> lastLoginTime = date("Y-m-d H:i:s");
			// $user -> where('id=' . $info['id']) -> save();
			//可以添加会员等级
			$_SESSION['username'] = $info['username'];
			$_SESSION['uid'] = $info['id'];
			$this -> success("登陆成功", "/User");
		} else {
			$this -> error("无法找到该用户");
		}
	}

	public function serach() {
		import("ORG.Util.Page");
		$product = D("Product");
		$map['Name'] = array('like', $this -> _post('key'));
		$count = $product -> where($map) -> count();
		$page = new Page($count, 25);
		$list = $product -> where($map) -> limit($page -> firstRow . ',' . $page -> listRows) -> getProduct();
		$show = $page -> show();
		$this -> assign("page", $show);
		$this -> assign("list", $list);
		$this -> display();
	}

	public function productList() {
		$product = D("Product");
		$map['Name'] = array('like', "%" . trim($_GET['term'] . "%"));
		$list = $product -> distinct(true) -> where($map) -> getField("Name", TRUE);
		if ($list) {
			//直接输出json字符形式,,给jquery自动完成传递数据
			echo json_encode($list);
		} else {
			$this -> error("无此产品");
		}
	}

}
?>