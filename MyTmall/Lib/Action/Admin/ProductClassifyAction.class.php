<?php
/**
 * 产品归类标签
 * 2013-05-30
 * 邱银乐
 */
import("ORG.Util.Page");
class ProductClassifyAction extends Action {
	public function index() {
		import("ORG.Util.Page");
		$classify = M("Productclassify");
		$count = $classify -> count();
		$page = new Page($count, 25);
		$data = $classify -> order("Id desc") -> limit($page -> firstRow . ',' . $page -> listRows) -> select();
		$show = $page -> show();
		$this -> assign('list', $data);
		$this -> assign('page', $show);
		$this -> display();
	}

	public function addClass() {
		$classify = D("Productclassify");
		if ($classify -> create()) {
			if ($Id = $classify -> add()) {
				$data = $classify -> find($Id);
				$this -> ajaxReturn($data, '推荐类型创建成功', 1);
			} else {
				$this -> error("推荐类型创建失败");
			}
		} else {
			$this -> error($classify -> getError());
		}

	}

	public function delClass() {
		$classify = D("Productclassify");
		$Id = $this -> _post("Id");
		if ($classify -> delete($Id)) {
			$this -> success('删除成功');
		} else {
			$this -> error("删除失败");
		}

	}

	public function getClass() {
		$classify = D("Productclassify");
		$Id = $this -> _post("Id");
		$data = $classify -> find($Id);
		if ($data) {
			$this -> ajaxReturn($data, '', 1);
		} else {
			$this -> error("无此推荐类型");
		}

	}

	public function updateClass() {
		$classify = D("Productclassify");
		$map['Id'] = $this -> _post("Id");
		$classify -> create();
		if ($classify -> where($map) -> save() !== false) {
			$this -> success('更新成功');
		} else {
			$this -> error("更新失败");
		}

	}

	/**************************活动产品列表*************************************/
	public function getTypelist() {
		//产品类型
		$type = D("Producttype");
		$data = $type -> select();
		$typelist = arrayPidProcess($data, $res, '0', '0');
		$typeTree = $type -> getTypetree('-', $typelist);
		return $typeTree;
	}

	public function product() {
		$classifyid = $this -> _get("id");
		$product = D("Product");
		$count = $product -> where($map) -> count();
		$page = New Page($count, 25);
		$show = $page -> show();
		$list = $product -> where($map) -> limit($page -> firstRow . ',' . $page -> listRows) -> getProduct();
		$this -> assign("id", $classifyid);
		$this -> assign('data', $this -> getTypelist());
		$this -> assign("page", $show);
		$this -> assign("list", $list);
		$this -> display();
	}

	public function getProduct() {
		//产品类型
		$map["ProductTypeId"] = $_POST['ProductTypeId'];
		$product = D("Product");
		$count = $product -> where($map) -> count();
		$page = New Page($count, 15);
		$field = "id,Name,Price,ProductImgId,DbNum,Status";
		$show = $page -> show();
		$list = $product -> field($field) -> where($map) -> limit($page -> firstRow . ',' . $page -> listRows) -> getProduct();
		$data = array("page" => $show, "result" => $list, );
		if ($list) {
			$this -> ajaxReturn($list, '产品信息列表', 1);
		} else {
			$this -> error("此类型下无产品");
		}
	}

	public function addProduct() {
		$map['Id'] = $this -> _post('id');
		$classify = D("Productclassify");
		$productid = $this -> _post('Productid');
		$data = $classify -> where($map) -> find();
		if ($data['ProductIdList'] == "null") {
			$array[] = $productid;
		} else {
			$array = json_decode($data['ProductIdList'], TRUE);
			$array[] = $productid;
		}
		$result = $classify -> where($map) -> setField('ProductIdList', json_encode(array_values($array)));
		if ($result) {
			$this -> success("添加成功");
		} else {
			$this -> error("添加失败");
		}

	}

	public function delProduct() {
		$map['Id'] = $this -> _post('id');
		$classify = D("Productclassify");
		$Productid = $this -> _post('Productid');
		$result = $classify -> where($map) -> remove($Productid);
		if ($result !== false) {
			$this -> success('删除成功');
		} else {
			$this -> error($classify -> getLastsql());
		}
	}

	public function viewProduct() {
		$map['Id'] = $this -> _post('id');
		$classify = D("Productclassify");
		$product = D("Product");
		$list = $classify -> field("Id,ProductIdList") -> where($map) -> find();
		
		$productlist = json_decode($list['ProductIdList']);
		$field = "Id,Name,Price,ProductImgId,DbNum,Status";
		$condition['Id'] = array('in', $productlist);
		$data = $product -> field($field) -> where($condition) -> getProduct();
		if ($data) {
			$this -> ajaxReturn($data, '', 1);
		} else {
			$this -> error('本归类下还未有产品');
		}
	}

}
?>