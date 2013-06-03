<?php
/**
 * 文件:前台用户模块
 * 功能:显示修改用户基本信息,购物车,订单查看
 * 作者:邱银乐
 * QQ:563712987
 * 日期:2013/03/11
 * 版本:V1.0
 */
class UserAction extends CommonAction {
	public function index() {
		$user = D("User");
		$list = $user -> find($_SESSION['uid']);
		$this -> assign($list);
		$this -> display();
	}
	//用户登录后更新密码
	public function updatePwd() {
		$user = D("User");
		$map['id'] = $_SESSION['uid'];
		$map['password'] = md5($this -> _post("oldPwd"));
		$info = $user -> where($map) -> find();
		if ($info) {
			if ($user -> create()) {
				$password = md5($this -> _post('password'));
				$result = $user -> where($info['id']) -> setField("password", $password);
				if ($result !== false) {
					session_destroy();
					$this -> success("修改成功,请重新登陆", U("/Public/login"));
				} else {
					$this -> error("密码修改失败");
				}
			} else {
				$this -> error($user -> getError());
			}
		} else {
			$this -> error("旧密码错误");
		}
	}

	//用户未登录后更新密码
	public function password() {
		$uid = $this -> _get('uid');
		if ($uid) {
			$user = D("User");
			$user -> find($uid);
		} else {

		}

	}

	//调试
	public function info() {
		$user = D("User");
		$map['id'] = $_SESSION['uid'];
		$info = $user -> where($map) -> find();
		$this -> assign($info);
		$this -> display();
	}

	public function updateInfo() {
		$user = D("User");
		$map['id'] = $_SESSION['uid'];
		if ($user -> where($map) -> save($this -> _post()) !== false) {
			$this -> success("用户信息更新成功!");
		} else {
			$this -> error("用户信息更新失败!");
		}
	}

	//找回用户名
	public function backUsername() {
		$user = D("User");
		$map['email'] = $this -> _post('email');
		if ($user -> create()) {
			$info = $user -> where($map) -> find();
			$mail = D("Email");
			$mail -> subject = "This is System email,don't replay!";
			$mail -> AltBody = "Forget passowrd";
			$mail -> Body = "This is you send sslsl" . $info['username'];
			$mail -> sendEmail($info['email']);
		} else {
			$this -> error($user -> getError());
		}
	}

	//找回密码 输入邮箱发送邮件链接
	public function backPassword() {
		$user = D("User");
		$map['email'] = $this -> _post('email');
		$info = $user -> where($map) -> find();
		$url = C("siteUrl") . "/User/password";
		if ($info) {
			$mail = D("Email");
			$mailtemp = D("Mailtemp");
			$data = array("username" => $username, "url" => $url . "/uid/" . md5($info['id']));
			$temp = $mailtemp -> field("Title,Body") -> getTemp("backpass", 1, "#", $data);
			$mail -> setContent($temp['Title'], $temp['Body']);
			if ($mail -> send($this -> _post('email'))) {
				$this -> success("邮件已发出");
			}
		} else {
			$this -> error("没有此用户邮箱");
		}
	}

	//重新请求验证邮箱
	public function applyEmail() {
		$user = D("User");
		$map['email'] = $this -> _post('email');
		$list = $user -> where($map) -> find();
		if ($list) {
			$code = randstr();
			$url = C("siteUrl") . "/User/checkEmail/uid/";
			$uid = $list['id'];
			$tmp = M("temp");
			$tmp -> uid = $uid;
			$tmp -> code = $code;
			if ($tmp -> add()) {
				$mail = D("Email");
				$mailtemp = D("Mailtemp");
				$data = array("username" => $username, "url" => $url . $uid . "/code/" . $code);
				$temp = $mailtemp -> field("Title,Body") -> getTemp("vaildemail", 1, "#", $data);
				$mail -> setContent($temp['Title'], $temp['Body']);
				if ($mail -> send($this -> _post('email'))) {
					$this -> success("邮件已经发出,请检查邮箱");
				}
			}

		}
	}

	//验证邮箱
	public function checkEmail() {
		$map['id'] = $this -> _get('uid');
		$user = D("User");
		$info = $user -> where($map) -> find();
		if ($info['status'] == 0) {
			$map['code'] = $this -> _get('code');
			$temp = D("Temp");
			if ($result = $temp -> where($map) -> find()) {
				if ($user -> where("id=" . $this -> _get('uid')) -> setField('status', 1) !== FALSE) {
					$temp -> where($map) -> delete();
					//$this -> success("邮箱验证成功", "login");
					$this -> redirect('./Public/login', '', 5, '您的邮箱验证成功，5秒后跳转到登陆页面.....');
				}
			} else {
				$this -> redirect('./User/replayEmail', '', 5, '您的邮箱未验证，5秒后跳转到验证页面.....');
				//echo "<a href='" . __URL__ . "/replayEmail'>点击验证邮箱</a>";
			}
		} else {
			//$this -> success("您的邮箱已经激活过了", "./login");
			$this -> redirect('./Public/login', '', 5, '您的邮箱已经激活过了，5秒后跳转到登陆页面.....');
		}
	}

	//更新邮箱
	public function updateEmail() {
		$user = D("User");
		$map['id'] = $_SESSION['uid'];
		//未检查email地址有效
		$email = $this -> _post('email');
		if ($user -> where($map) -> setField('email', $email) !== false) {
			$this -> error("邮箱修改失败");
		} else {
			$this -> success("邮箱修改成功");
		}
	}

	public function myorder() {
		$order = D("Orderinfo");
		$map['C_Id'] = $_SESSION['uid'];
		$data = $order -> where($map) -> getField("OrderId,OrderPrice,OrderTime,CompleteTime", TRUE);
		$this -> assign("list", $data);

	}

}
?>