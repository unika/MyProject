<?php
/*
 * 邮件设置模块
 * 功能：包括模板设置、群发邮件、smtp服务器添加、用户邮件订阅管理
 * 作者:邱银乐
 * qq:56371287
 * 日期：2013-04-11
 */
import("ORG.Util.Page");
class EmailAction extends Action {
	public function template() {
		$mailtemp = D("Mailtemp");
		$count = $mailtemp -> count();
		$page = new Page($count, 25);
		$list = $mailtemp -> limit($page -> firstRow . ',' . $page -> listRows) -> select();
		$this -> assign('page', $page -> show());
		$this -> assign('list', $list);
		$this -> display();
	}

	public function delTemplate() {
		$map['id'] = $this -> _post('id');
		$mailtemp = D("Mailtemp");
		if ($mailtemp -> where($map) -> delete()) {
			$this -> success("模板删除成功");
		} else {
			$this -> error("无此模板");
		}
	}

	public function Smtp() {
		$param =
		require (CONF_PATH . "smtp.php");
		$this -> assign("param", $param);
		$this -> display();
	}

	public function setSmtp() {
		$str = var_export($this -> _post(), TRUE);
		$data = "<?php \n return " . $str . ";\n?>";
		if (file_put_contents(CONF_PATH . "smtp.php", $data)) {
			$this -> success("SMTP服务器配置保存成功");
		} else {
			$this -> error("SMTP服务器配置保存失败");
		}
	}

	public function getTemplate() {
		$map['Id'] = $this -> _post('id');
		$mailtemp = D("Mailtemp");
		$list = $mailtemp -> where($map) -> find();
		if ($list) {
			$this -> ajaxReturn($list, null, 1);
		} else {
			$this -> error("无此模板");
		}

	}

	public function upTemplate() {
		$map['Id'] = $this -> _post('id');
		$mailtemp = D("Mailtemp");
		$mailtemp -> create();
		if ($mailtemp -> where($map) -> save() !== false) {
			$this -> success("邮件模板更新成功");
		} else {
			$this -> error("邮件模板更新失败");
		}

	}

	public function insert() {
		$mailtemp = D("Mailtemp");
		$mailtemp -> create();
		if ($id = $mailtemp -> add()) {
			$data = $mailtemp -> find($id);
			$this -> ajaxReturn($data, "邮件模板添加成功", 1);
		} else {
			$this -> error("邮件模板添加失败");
		}
	}

}
?>