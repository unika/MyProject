<?php
/**
 * 文件:ProductClassify
 * 功能:产品推荐Widget
 * 创建日期:2013-04-28
 * 修改日期 2013-05-31
 * 作者：邱银乐
 * 调用例子
 * {:W("ProductClassify",array('count'=>12,'Id'=>25,'display'=>'Index','order'=>'desc'))}
 * count为一次几条数据,Id为推荐类型Id,可以在后台查看,display决定调用用那个摸板文件来渲染注意模板名大小写,,
 * order为未产品排序,如不填默认为升序
 */
class ProductClassifyWidget extends Widget {
	public function render($data) {
		$classify = D("Productclassify");
		$product = D("Product");
		$map['Id'] = $data['Id'];
		$productidlist = $classify -> order($data['order']) -> where($map) -> getField("ProductIdList");
		$condition['Id'] = array('in', json_decode($productidlist, TRUE));
		$field = ("Id,Name,Price,score");
		$data['product'] = $product -> field($field) -> where($condition) -> limit($data['count']) -> getProduct();
		$content = $this -> renderFile($data['display'], $data);
		return $content;
	}

}
?>