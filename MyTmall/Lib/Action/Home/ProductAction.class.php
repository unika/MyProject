<?php
/**
 * 前台产品模块
 */
class ProductAction extends Action {
	public function index() {
		$product = D("Product");
		$field = "shop_Product.id as id,shop_Productimg.id as imgid, Name,Img, Price,ProductImgId,ProductTypeId,AddTime,Status,MarketPrice";
		$list = $product -> field($field) -> join("shop_Productimg on shop_Product.id=ProductId") -> select();
		$this -> assign("list", $list);
		$this -> display();
	}

	public function show() {
		$product = D("Product");
		$map['Id'] = $this -> _get('Id');
		$list = $product -> where($map) -> getAllinfo();	
		$this -> assign($list);
		$this -> display();
	}

	public function addComment() {
		$comment = D("Productcomment");
		if ($comment -> create()) {
			if ($comment -> add()) {
				$this -> success("感谢参与");
			}
		} else {
			$this -> error($comment -> getError());
		}
	}

}
?>