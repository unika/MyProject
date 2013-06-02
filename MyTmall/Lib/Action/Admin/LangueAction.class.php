<?php
/*
 * 文件名: 语言管理模块
 * 功能:添加一些消息提示多语言,便于网站国际化
 * 日期:2013-04-19
 * 作者:邱银乐
 * qq:563712987
 *
 */
class LangueAction extends Action {
	public function index() {
		$this -> display();
	}

	public function insert() {
		$lang =
		require (LANG_PATH . "Home/zh-cn/" . "common.php");
		$zh = array($_POST['label'] => $_POST['zh']);
		$en = array($_POST['label'] => $_POST['en']);
		$zh = array_merge($lang, $zh);
		$str = var_export($zh, TRUE);
		$data = "<?php \n return " . $str . ";\n?>";
		if (file_put_contents(LANG_PATH . "Home/zh-cn/" . "common.php", $data)) {
			$this -> success("标签保存成功");
		} else {
			$this -> error("标签保存失败");
		}
	}

}
