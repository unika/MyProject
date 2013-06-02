<?php
/**
 * 用户注册模块
 * 2013-06-01
 * 功能用户注册
 *
 */
class RegisterAction extends Action {
	public function addUser() {
		$user = D("User");
		if ($user -> create()) {
			if (md5($_POST['verify']) != $_SESSION['verify']) {
				$this -> error("验证码错误");
			}
			$username = trim($_POST['username']);
			$user -> username = $username;
			if ($uid = $user -> add()) {
				// $_SESSION['username'] = $username;
				// $_SESSION['uid'] = $uid;
				//存放用户uid,和验证码的数据表
				$tmp = M("temp");
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
					if ($mail -> send(trim($_POST['email']))) {
						$this -> success("注册成功,系统已经发出一封验证信息到您的邮箱,请前往验证!", "login");
					}
				};
			} else {
				$this -> error("注册失败");
			}
		} else {
			$this -> error($user -> getError());
		}
	}

}
?>