<?php
/**
 *文件上传模型
 */
class UploadModel extends Model {
	public function upload($file, $savePath) {
		if ($file['tmp_name']) {
			if (!file_exists($savePath)) {
				mkdir($savePath);
			}
			$savename = time() . '.jpg';
			if (move_uploaded_file($file['tmp_name'], $savePath . '/' . $savename)) {
				return $savename;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	public function unlink($filename) {
		if (file_exists($filename)) {
			unlink($filename);
		} else {
			return false;
		}
	}

}
?>