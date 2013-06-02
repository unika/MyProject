<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends Action {
	public function index() {
		$product = M("Product");
		$field = "shop_Product.id as id,shop_Productimg.id as imgid,DbNum, Name,Img, Price,ProductImgId,Status,MarketPrice";
		$list = $product -> field($field) -> join("shop_Productimg on shop_Product.id=ProductId") -> where('Status=1') -> limit(50) -> select();
		$this -> assign("list", $list);
		$this -> display();
	}

}
