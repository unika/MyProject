<?php
class PublicAction extends Action {
	//网站配置信息
	public function main() {
		$info = array('操作系统' => PHP_OS, //
		'运行环境' => $_SERVER["SERVER_SOFTWARE"], //
		'PHP运行方式' => php_sapi_name(), //
		'ThinkPHP版本' => THINK_VERSION . ' [ <a href="http://thinkphp.cn" target="_blank">查看最新版本</a> ]', //
		'上传附件限制' => ini_get('upload_max_filesize'), //
		'执行时间限制' => ini_get('max_execution_time') . '秒', //
		'服务器时间' => date("Y年n月j日 H:i:s"), //
		'北京时间' => gmdate("Y年n月j日 H:i:s", time() + 8 * 3600), //
		'服务器域名/IP' => $_SERVER['SERVER_NAME'] . ' [ ' . gethostbyname($_SERVER['SERVER_NAME']) . ' ]', //
		'剩余空间' => round((@disk_free_space(".") / (1024 * 1024)), 2) . 'M', //
		'register_globals' => get_cfg_var("register_globals") == "1" ? "ON" : "OFF", //
		'magic_quotes_gpc' => (1 === get_magic_quotes_gpc()) ? 'YES' : 'NO', 'magic_quotes_runtime' => (1 === get_magic_quotes_runtime()) ? 'YES' : 'NO', );
		$this -> assign('info', $info);
		$this -> display();
	}

	//后台框架顶部菜单
	public function top() {
		$this -> display();
	}

	function getMenu() {
		$menu = M('admin_menu');
		$condition['status'] = '1';
		$res_menu = $menu -> where($condition) -> order('sort asc') -> select();
		return arrayPidProcess($res_menu, array(), '0', '2');
	}

	//后台框架左边菜单
	public function leftMenu() {
		$this -> display();
	}

	public function verify() {
		import("ORG.Util.Image");
		Image::buildImageVerify();
	}

	public function uploadfile1() {
		$upload = new UploadAction('./Upload/', 'uniqid', FALSE, '200', '200', FALSE, TRUE);
		$upload -> ajaxupload();
	}

	public function uploadfile() {
		import("ORG.Net.UploadFile");
		if (!file_exists('./Upload/')) {
			mkdir('./Upload/' . MODULE_NAME);
		}

		$upload = new UploadFile();
		$upload -> savePath = "./Upload/" . MODULE_NAME . "/";
		$upload -> uniq = TRUE;
		$upload -> uploadReplace = TRUE;
		if ($upload -> upload()) {
			$info = $upload -> getUploadFileInfo();
			if ($info) {
				$data = array(//
				'image' => $info[0]['savename'], //
				'path' => $info[0]['savaPath'], //
				);
				$image = "/Upload/" . MODULE_NAME . "/" . $info[0]['savename'];
				echo '<script src="/Public/Js/jquery.js" type="text/javascript"></script>';
				echo "<script>";
				echo '$(window.parent.document).find("#img").attr("src","' . $image . '")';
				echo "</script>";
				echo "上传成功";

			}
		} else {
			$this -> error($upload -> getErrorMsg());
			return false;
		}

	}

}
?>