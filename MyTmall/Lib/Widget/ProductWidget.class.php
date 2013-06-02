<?php
/**
 * 文件:产品Productwidget
 * 功能:分类挂件
 * 日期:2013-04-28
 * 作者：邱银乐
 */
class ProductWidget extends Widget {
	public function render($data) {
		$product = D("Product");
		switch ($data['type']) {
			case 'new' :
				$CatId = 1;
				break;
			case 'hot' :
				$CatId = 2;
				break;
			case 'promotion' :
				$CatId = 3;
				break;
			case 'clear' :
				$CatId = 4;
				break;
		}
		$map['CatId'] = $CatId;
		$data['product'] = $product -> where($map) -> limit($data['count']) -> getWidget();
		$content = $this -> renderFile('Product', $data);
		return $content;
	}

}
?>