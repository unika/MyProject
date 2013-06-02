<?php
/*
 *
 *产品图片模型
 *
 */

class ProductimgModel extends Model {
	protected $_auto = array( array('Img', 'fill_image', 3, 'callback'));
	public function fill_image() {
		$upload = new UploadModel();
		$info = $upload -> upload($_FILES['image'], './Upload/Product/');
		return $info;
	}

	//通过id获取产品主图
	public function getMainImg($id) {
		$map['UseType'] = "1";
		$map['ProductId'] = $id;
		$mainImage = $this -> where($map) -> field("Img") -> find();
		return $mainImage;
	}

}
?>