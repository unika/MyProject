<?php
/*
 *
 * 商品属性操作控制器
 *
 *
 */
class ProductTypeAttrAction extends Action {
	public function index() {
		$attr = D("Attrvalue");
		import("ORG.Util.Page");
		$count = $attr -> count();
		$page = New Page($count, 25);
		$list = $attr -> order("id desc") -> limit($page -> firstRow . ',' . $page -> listRows) -> getParamValue();
		$this -> assign("page", $page -> show());
		$this -> assign("list", $list);
		$this -> display();
	}

	public function addAttr() {
		$typeid = $_GET['typeid'];
		$this -> assign('typeid', $typeid);
		$this -> display();
	}

	public function view() {
		$map['ProductTypeId'] = $_GET['typeid'];
		$attrValue = M("Attrvalue");
		$list = $attrValue -> where($map) -> select();
		$this -> assign('list', $list);
		$this -> display();
	}

	public function insert() {
		$attrValue = D("Attrvalue");
		$attrValue -> create();
		if ($attrValue -> add()) {
			$this -> success('添加成功');
		} else {
			$this -> error("添加失败");
		}
	}

	public function del() {
		$map['id'] = $_POST['id'];
		$attrValue = D("Attrvalue");
		if ($attrValue -> where($map) -> delete()) {
			$this -> success('属性删除成功');
		} else {
			$this -> error("属性删除成功失败");
		}
	}

	public function getTypeAttr() {
		$map['ProductTypeId'] = $_POST['ProductTypeId'];
		$attrValue = D("Attrvalue");
		$list = $attrValue -> where($map) -> select();
		foreach ($list as $key => $value) {
			$list[$key]['ParamValue'] = json_decode($value['ParamValue'], TRUE);
		}
		if ($list) {
			$this -> ajaxReturn($list, "", 1);
		} else {
			$this -> ajaxReturn($list, "", 0);
		}

	}

	public function getAttrList() {
		$attrValue = D("Attrvalue");
		$map["ProductTypeId"] = $this -> _get("ProductTypeId");
		$list = $attrValue -> where($map) -> getField('Id,Name', TRUE);
		if ($list) {
			$this -> ajaxReturn($list, "", 1);
		} else {
			$this -> error("无");
		}

	}

	public function getAttrValue() {
		$attrValue = D("Productattrvalue");
		$map['TypeAttrId'] = $this -> _post("pid");
		$list = $attrValue -> field('TypeAttrId,ProductId,AttrValue') -> where($map) -> select();
		if ($list) {
			$this -> ajaxReturn($list, "", 1);
		} else {
			$this -> error("无二级目录");
		}

	}

}
?>