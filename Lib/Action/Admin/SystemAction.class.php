<?php
/*
 * 文件：网站基本信息设置模块
 * 功能：网站基本信息编辑
 * 作者:邱银乐
 * qq:56371287
 * 日期：2013-03-11
 */
class SystemAction extends Action {
	public function index() {
		$param =
		require (CONF_PATH . "user.php");
		$this -> assign("param", $param);
		$this -> display();
	}

	public function insert() {
		if ($_POST['water']) {
			$_POST['water'] = TRUE;
		} else {
			$_POST['water'] = FALSE;
		}
		if ($_POST['thumb']) {
			$_POST['thumb'] = TRUE;
		} else {
			$_POST['thumb'] = FALSE;
		}

		$str = var_export($_POST, TRUE);
		$data = "<?php\n return " . $str . ";\n?>";
		if (file_put_contents(CONF_PATH . "user.php", $data)) {
			$this -> success("基本信息保存成功");
		} else {
			$this -> error("基本信息保存失败");
		}
	}

	public function uploadfile() {
		$upload = new UploadAction('./Conf/', "water", '/Conf');
		$upload -> ajaxupload();
	}

}
?>