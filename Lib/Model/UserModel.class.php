<?php
/**
 *  @module  用户信息模型
 * 	@athour	邱银乐
 * 	@version	1.0.0
 *	@copyright 谷德网络技术有限公司
 */
class UserModel extends Model {
	protected $_auto = array(//自动完成 ,和填充
	array('password', 'md5', 1, 'function'), //密码加密
	array('regIp', 'get_client_ip', 1, 'function'), //填充注册
	array('regTime', 'fill_date', 1, 'callback'), //填充注册时间
	array('lastLoginIp', 'get_client_ip', 3, 'function'), //最后登陆ip
	array('lastLoginTime', 'fill_date', 3, 'callback'), //最后登陆时间
	//array('lastLoginTime', 'fill_date', 3, 'callback') //最后登陆ip
	);
	//array(验证字段,验证规则,错误提示,[验证条件,附加规则,验证时间])
	//包括：require 字段必须、email 邮箱、url URL地址、currency 货币、number 数字。

	protected $_validate = array(
	//用户名 是否为空 ,唯一性,
	array('username', 'require', '账户未填', 0, 'regex', 1), //
	array('username', '', '账户已经存在', 0, 'unique', 1),
	//邮箱唯一性 	格式的正确性
	array('email', 'require', '邮箱未填', 0, 'regex', 1), //
	array('email', '', '邮箱已经存在', 1, 'unique', 1), //
	array('email', 'email', '邮箱格式不正确', 0, 'regex', 1),
	//密码是否已填写
	array('password', 'require', '密码未填', 0, 'regex', 1),
	//密码长度须为8-32位
	array('password', '/[a-zA-Z0-9]{8,32}/', '密码长度必须为8至32位字符', 1, 'regex', 1),
	//确认密码
	array('repassword', 'require', '确认密码未填', 0, 'reqex', 1),
	//两次密码是否一致
	array('repassword', 'password', '两次密码不正确', 0, 'confirm', 1),
	//验证码是否填写
	array('verify', 'require', '验证码必须'), //
	//检验验证码是否正确
	array('verify', 'checkVerify', '验证码不正确', 0, 'callback', 1),
	//电话 号码长度 必须为11位
	array('tel', '[0-9]{11}', '电话号码长度必须11位', 0, 'regex', 1), );
	public function fill_date() {
		return date("Y-m-d H:i:s");
	}

	public function checkVerify() {
		if (md5($_POST['verify']) != $_SESSION['verify']) {
			return false;
		}
	}

	public function changeInfo($map, $data) {
		return $this -> where($map) -> save($data);
	}

	public function backInfo() {
		if ($list = $this -> where($map) -> find()) {
			return $list;
		} else {
			return false;
		}
	}

	public function getUserList() {
		$list = $this -> select();
		return $list;
	}

}
?>