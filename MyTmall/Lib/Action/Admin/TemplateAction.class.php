<?php
/*
 * 模版控制器
 * 日期：2013-03-23
 * 作者：邱银乐：邱银乐
 * 作者
 */
class TemplateAction extends Action {
	public function index() {
		$template = $this -> show(TMPL_PATH . "Home");
		$current = $this -> current_tpl();
		$user =
		require (CONF_PATH . "Home/config.php");
		$this -> assign("theme", $user['DEFAULT_THEME']);
		$this -> assign("list", $template);
		$this -> display();
	}

	//扫描目录下的文件,并显示出图片和them_xml文件中的信息
	public function show($dirname) {
		import("ORG.Io.Dir");
		$dir = new Dir($dirname);
		$tplinfo = $dir -> toArray();
		for ($i = 0; $i < count($tplinfo); $i++) {
			if (file_exists($tplinfo[$i]['pathname'] . '/theme.xml')) {
				$xml = simplexml_load_file($tplinfo[$i]['pathname'] . '/theme.xml');
				$tp_data[$i] = json_decode(json_encode($xml), True);
			}
		}
		return $tp_data;

	}

	//获取当前模板
	public function current_tpl() {
		import("ORG.Io.Dir");
		if (!file_exists(CONF_PATH . "Home/config.php")) {
			mkdir(CONF_PATH . "Home/config.php");
		}
		$user =
		require (CONF_PATH . "Home/config.php");
		$dir = new Dir(TMPL_PATH . 'Home/' . $user['DEFAULT_THEME']);
		$tplinfo = $dir -> toArray();
		if (file_exists($tplinfo[0]['path'] . '/theme.xml')) {
			$xml = simplexml_load_file($tplinfo[0]['path'] . '/theme.xml');
			$tpl_info = json_decode(json_encode($xml), True);
		}
		return $tpl_info;
	}

	//更新模板主题
	public function update() {
		if (file_exists(CONF_PATH . "Home/config.php")) {
			$user =
			require (CONF_PATH . "Home/config.php");
		}
		$user['DEFAULT_THEME'] = $_POST['tpname'];
		$user['TMPL_PARSE_STRING']['__MYSTYLE__'] = '/Tpl/Home/' . $_POST['tpname'] . '/Public/';
		$info = var_export($user, TRUE);

		$data_str = "<?php \n return " . $info . "\n?>";
		file_put_contents(CONF_PATH . "Home/config.php", $data_str);

		if (unlink(RUNTIME_PATH . '~runtime.php')) {
			$msg = "缓存删除成功";
		}
		$this -> success("模板更换成功" . $msg);

	}

	//远程下载模板
	public function downLoad($url, $filename, $templatedir) {
		import("ORG.Net.Http");
		$http = new Http();
		$http -> curl_download($url . '/' . $filename, $templatedir . '/' . $filename);
		$this -> unzipFile($filename);
	}

	public function uploadfile1() {
		$upload = new UploadAction(TMPL_PATH . 'Home/', '', TMPL_PATH . '/Home');
		$upload -> ajaxupload();
		$this -> unzipFile($upload -> filename);
	}

	//上传文件解压..删除压缩包
	public function unzipFile($filename) {
		$Zip = new ZipArchive();
		if (!file_exists(TMPL_PATH . 'Home/' . $filename)) {
			$this -> error("文件不存在");
		}
		list($files, $prefix) = explode('.', $filename);
		if ($Zip -> open(TMPL_PATH . 'Home/' . $filename) === TRUE) {
			$Zip -> extractTo(TMPL_PATH . 'Home/');
			$Zip -> close();
			if (unlink(TMPL_PATH . 'Home/' . $filename)) {
				$this -> success("解压成功");
			}
		} else {
			$this -> error("无法打开要解压的文件");
		}

	}

}
?>