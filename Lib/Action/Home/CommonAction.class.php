<?php
/**
 * 公告验证模块CommonAction
 */
class CommonAction extends Action {
	public function _initialize() {
		if (!isset($_SESSION['uid'])) {
			$this -> redirect('./Public/login');
		}
	}

}
?>