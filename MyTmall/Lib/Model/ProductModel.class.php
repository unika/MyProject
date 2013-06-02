<?php
/*
 * 产品模型
 * 日期:2013-03-12
 * 作者:邱银乐
 *
 */
class ProductModel extends Model {
	protected $_auto = array(//
	array('AddTime', 'fill_date', 1, 'callback'), //
	array('UpdateTime', 'fill_date', 2, 'callback'), //
	array('AttrValue', 'fill_attrvalue', 3, 'callback'), //
	);
	//后台产品必须选项
	protected $_validate = array(//自动验证
	array('Name', 'require', '产品名称必须'), //
	array('Page_Title', 'require', 'SEO页面标题必须'), //
	array('Page_Keyword', 'require', 'SEO页面关键字必须'), //
	array('Page_Description', 'require', 'SEO页面描述必须'), //
	array('Price', 'require', '产品价格必须'), //
	);

	public function fill_date() {
		$AddTime = date("Y-m-d H:i:s");
		return $AddTime;
	}

	public function fill_attrvalue() {
		return $this -> AttrValue = json_encode($_POST['AttrValue']);
	}

	//返回该产品的类型ID,参数为产品id;
	public function getProductType($id) {
		$map['Id'] = $id;
		$ProductTypeId = $this -> where($map) -> getField('ProductTypeId');
		return $ProductTypeId;
	}

	public function copyToNew($id) {
		$data = $this -> find($id);
		$Img = D("Productimg");
		$data['Img'] = $Img -> where("ProductId=" . $id) -> select();
		unset($data['Id']);
		return $data;
	}

	public function getProduct() {
		$list = $this -> select();
		$image = M("Productimg");
		$type = M("Producttype");
		foreach ($list as $key => $value) {
			//设置一个主图
			//$img = $image -> where('UseType=1 and Id=' . $value['ProductImgId']) -> getField("Img");
			$img = $image -> where('Id=' . $value['ProductImgId']) -> getField('Img');
			$typename = $type -> where('Id=' . $value['ProductTypeId']) -> getField("name");
			$list[$key]['Img'] = $img;
			$list[$key]['Typename'] = $typename;
		}
		return $list;
	}

	//获取产品只含主图信息
	public function getinfo() {
		$list = $this -> find();
		$image = M("Productimg");
		$type = M("Producttype");
		$img = $image -> field('Id,Img') -> where('UseType=1 and ProductId=' . $list['Id']) -> find();
		$typeinfo = $type -> field('Id,name') -> where('Id=' . $list['ProductTypeId']) -> find();
		$list['Img'] = $img;
		$list['Typename'] = $typeinfo;
		return $list;
	}

	//读取产品的全部图片信息
	public function getAllinfo() {
		$list = $this -> find();
		$image = M("Productimg");
		$type = M("Producttype");
		$img = $image -> where('Id=' . $list['ProductImgId']) -> getField('Id,Img,UseType', TRUE);
		$type = $type -> where('Id=' . $list['ProductTypeId']) -> getField('Id,Name');
		$list['AttrValue'] = json_decode($list['AttrValue'], TRUE);
		$list['Img'] = $img;
		$list['Typename'] = $type;
		return $list;
	}

	//挂件产品信息
	public function getWidget() {
		$list = $this -> select();
		$image = M("Productimg");
		$type = M("Producttype");
		foreach ($list as $key => $value) {
			//设置一个主图
			//$img = $image -> where('UseType=1 and Id=' . $value['ProductImgId']) -> getField("Img");
			$img = $image -> where('Id=' . $value['ProductImgId']) -> getField("Img");
			$typeName = $type -> where('Id=' . $value['ProductTypeId']) -> getField("Name");
			$list[$key]['Img'] = $img;
			$list[$key]['Typename'] = $typeName;
		}
		return $list;
	}

}
?>