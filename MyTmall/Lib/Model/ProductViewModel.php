<?php
/**
 * 产品视图
 */

class ProductViewModel extends ViewModel {
	public $viewFields = array(//
	'Product' => array('id', 'Name'), //产品
	'Productimg' => array('id' => 'imgid', 'Img', '_on' => 'Product.id=Productimg.ProductId'), //产品图片
	'Producttype' => array('id' => 'typeid', 'name' => "Type_Name", '_on' => 'Product.id=Producttype.pid'), //产品类型
	);

}
?>