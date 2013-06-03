<?php
import("ORG.Util.Image");
import("ORG.Net.UploadFile");
class UploadAction extends  Action {
	//上传路径
	public $savePath;
	//保存规则
	public $saveRule;
	//ajax使用的路径
	public $path;
	//默认不生成缩略图片
	public $thumb = false;
	//默认无水印
	public $imagewater = false;
	//默认替换相同名称图片
	public $uploadReplace = true;
	//缩略宽度前缀
	public $thumbPrefix;
	//缩略宽度,可以用,来分割几张小图宽度
	public $thumbMaxWidth = "200";
	//缩略高度,可以用,来分割几张小图高度
	public $thumbMaxHeight = "200";
	//上传后要显示的文件名和路径
	public $fullname;
	//隐藏起的文件名
	public $filename;
	public $watername;
	public $alpha = 80;
	function __construct($savePath, $savRule, $Path) {
		$this -> savePath = $savePath;
		$this -> saveRule = $savRule;
		$this -> path = $Path;
	}

	public function checkDir() {
		if (!file_exists($this -> savePath)) {
			mkdir($this -> savePath);
		}

	}

	//如果图片上传失败,请坚持是否开启水印功能,及上传了水印图片
	public function ajaxupload() {	
		$upload = new UploadFile();
		$upload -> savePath = $this -> savePath;
		$upload -> saveRule = $this -> saveRule;
		$upload -> thumb = $this -> thumb;
		$upload -> uploadReplace = $this -> uploadReplace;
		$upload -> thumbPrefix = $this -> thumbPrefix;
		$upload -> thumbMaxWidth = $this -> thumbMaxWidth;
		$upload -> thumbMaxHeight = $this -> thumbMaxHeight;
		$this -> checkDir();
		if ($upload -> upload()) {
			$info = $upload -> getUploadFileInfo();
			//判断开启产品水印, C("image")为用户配置的变量,可以更改
			if ($this -> imagewater) {
				Image::water($this -> savePath . '/' . $info[0]['savename'], CONF_PATH . $this -> watername, $this -> savePath . '/' . $info[0]['savename'], $this -> alpha);
			}
			$this -> fullname = $this -> path . '/' . $info[0]['savename'];
			$this -> filename = $info[0]['savename'];
			echo '<script src="/Public/Js/jquery.js" type="text/javascript"></script>';
			echo "<script>";
			echo <<<end
			$(window.parent.document).find("#image").remove();
 			$(window.parent.document).find(".hidden").attr("style","display:display");
			$(window.parent.document).find("#img").attr("src","$this->fullname").after("<input type='hidden' id='image'  name='image' value='$this->filename' />");
			alert("上传成功");
end;
			echo "</script>";
		} else {
			echo "<script>";
			echo "alert('" . $upload -> getErrorMsg() . "')";
			echo "</script>";
		}

	}

	//用户双层iframe间的ajaxshangch
	public function ajaxToupload() {
		$upload = new UploadFile();
		$upload -> savePath = $this -> savePath;
		$upload -> saveRule = $this -> saveRule;
		$upload -> thumb = $this -> thumb;
		$upload -> uploadReplace = $this -> uploadReplace;
		$upload -> thumbPrefix = $this -> thumbPrefix;
		$upload -> thumbMaxWidth = $this -> thumbMaxWidth;
		$upload -> thumbMaxHeight = $this -> thumbMaxHeight;
		$this -> checkDir();
		if ($upload -> upload()) {
			$info = $upload -> getUploadFileInfo();
			//判断开启产品水印, C("image")为用户配置的变量,可以更改
			if ($this -> imagewater) {
				Image::water($this -> savePath . '/' . $info[0]['savename'], CONF_PATH . $this -> watername, $this -> savePath . '/' . $info[0]['savename'], $this -> alpha);
			}
			$this -> fullname = $this -> path . $info[0]['savename'];
			$this -> filename = $info[0]['savename'];
			$data = array("fullname" => $this -> fullname, "filename" => $this -> filename);
			return $data;
		} else {
			return $upload -> getErrorMsg();
		}

	}

}
?>