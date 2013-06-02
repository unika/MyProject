<?php
/*
 *
 * 商品类型操作控制器
 *
 *
 */
class ProductTypeAction extends Action {
	public function index() {
		import("ORG.Util.Page");
		$type = D("Producttype");
		$count = $type -> count();
		$page = new Page($count, 25);
		$list = $type -> select();
		$data = arrayPidProcess($list, $res, '0', '0');
		$list = $type -> getListtree('-', $data);
		$this -> assign('list', $list);
		$this -> assign('page', $page -> show());
		$this -> display();
	}

	public function getType() {
		$type = D("Producttype");
		$list = $type -> order('PId desc') -> select();
		$list = arrayPIdProcess($list, $res, '0', '0');
		$type -> getTypetree('-', $list);
	}

	public function info() {
		$type = D("Producttype");
		$list = $type -> order('PId desc') -> select();
		$list = arrayPIdProcess($list, $res, '0', '0');
		$typetree = $type -> getTypetree('-', $list);
		if ($typetree) {
			$this -> ajaxReturn($typetree, '', 1);
		} else {
			$this -> error("无类型");
		}
	}

	public function insert() {
		$type = M("Producttype");
		if ($type -> create()) {
			if ($Id = $type -> add()) {
				$list = $type -> find($Id);
				$this -> ajaxReturn($list, "添加成功", 1);
			} else {
				$this -> error("添加失败");
			}
		} else {
			$this -> error($type -> getError());
		}

	}

	public function del() {
		$type = M('Producttype');
		$map['Id'] = $this -> _post('Id');
		if ($type -> where($map) -> delete()) {
			$this -> success('删除成功');
		} else {
			$this -> error('删除失败');
		}
	}

	public function getlist1() {
		$map['Id'] = $this -> _post('Id');
		$type = D('Producttype');
		$list = $type -> select();
		$list = arrayPIdProcess($list, $res, '0', '0');
		//改进选中项目
		$typetree = $type -> getTypetree('-', $list);
		$list = $type -> where($map) -> find();
		$list['typetree'] = $typetree;

		//$data = array('list' => $list, 'typetree' => $typetree);
		if ($list) {
			$this -> ajaxReturn($list, '', 1);
		} else {
			$this -> error('无此类型');
		}
	}

	public function update() {
		$type = D('Producttype');
		$data['PId'] = $this -> _post("pid");
		$data['Name'] = $this -> _post("name");
		$result = $type -> where("Id=" . $this -> _post("Id")) -> save($data);
		if ($result != false) {
			$this -> success("更新成功");
		} else {
			$this -> error($type -> getLastsql());
		}
	}

	public function addAttr() {
		$typeId = $_GET['typeId'];
		$this -> assign('typeId', $typeId);
		$this -> display();
	}

	public function insertAttr() {
		$attrValue = D("Attrvalue");
		if ($attrValue -> create()) {
			if ($attrValue -> add()) {
				$this -> success('添加成功');
			} else {
				$this -> error('添加失败');
			}
		} else {
			$this -> error($attrValue -> getError());
		}

	}

	public function delAttr() {
		$map['Id'] = $this -> _post('Id');
		$attrValue = D("Attrvalue");
		if ($attrValue -> where($map) -> delete()) {
			$this -> success("属性删除成功");
		} else {
			$this -> error("属性删除失败");
		}
	}

	public function viewAttr() {
		$map['ProductTypeId'] = $this -> _post('Id');
		$attrValue = D("Attrvalue");
		$list = $attrValue -> where($map) -> getParamValue();
		if ($list) {
			$this -> ajaxReturn($list, '', 1);
		} else {
			$this -> error('此分类暂无属性');
		}

	}

}
?>